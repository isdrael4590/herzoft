<div>
    @if (session()->has('message'))
        <div class="alert alert-info alert-dismissible fade show" role="alert">
            {{ session('message') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if (session()->has('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <!-- Filtros -->
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="form-row">
                        <div class="col-md-3">
                            <label for="startDate">Fecha Inicio</label>
                            <input type="date" wire:model="startDate" id="startDate" class="form-control">
                        </div>
                        <div class="col-md-3">
                            <label for="endDate">Fecha Fin</label>
                            <input type="date" wire:model="endDate" id="endDate" class="form-control">
                        </div>
                        <div class="col-md-3">
                            <label for="zona">Zona</label>
                            <select wire:model="zona" id="zona" class="form-control">
                                <option value="all">Todas las Zonas</option>
                                <option value="reception">Recepción</option>
                                <option value="labelqr">Etiquetado QR</option>
                                <option value="discharge">Descarga</option>
                                <option value="expedition">Expedición</option>
                            </select>
                        </div>
                        <div class="col-md-3 d-flex align-items-end">
                            <button class="btn btn-primary btn-block" wire:click="loadData">
                                <i class="fas fa-search"></i> Buscar
                            </button>
                        </div>
                    </div>

                    <div class="form-row mt-3">
                        <div class="col-md-4">
                            <label for="productName">Nombre del Producto</label>
                            <input type="text" wire:model="productName" id="productName"
                                class="form-control @error('productName') is-invalid @enderror"
                                placeholder="Buscar por nombre...">
                            @error('productName')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="productCode">Código del Producto</label>
                            <input type="text" wire:model="productCode" id="productCode"
                                class="form-control @error('productCode') is-invalid @enderror"
                                placeholder="Buscar por código...">
                            @error('productCode')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Resultados -->
    <div class="row mt-3">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <!-- Botones de selección -->
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <div class="btn-group mb-2 flex-wrap" role="group">
                                <button type="button" class="btn btn-outline-primary btn-sm"
                                    wire:click="selectByzona('reception')">
                                    <i class="fas fa-inbox"></i> Recepción
                                </button>
                                <button type="button" class="btn btn-outline-info btn-sm"
                                    wire:click="selectByzona('labelqr')">
                                    <i class="fas fa-qrcode"></i> Etiquetado
                                </button>
                                <button type="button" class="btn btn-outline-success btn-sm"
                                    wire:click="selectByzona('discharge')">
                                    <i class="fas fa-box-open"></i> Descarga
                                </button>
                                <button type="button" class="btn btn-outline-warning btn-sm"
                                    wire:click="selectByzona('expedition')">
                                    <i class="fas fa-shipping-fast"></i> Expedición
                                </button>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <!-- Estadísticas -->
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div>
                                    <span class="badge badge-info mr-2">
                                        <i class="fas fa-list"></i> Total: {{ count($data) }} registros
                                    </span>
                                    <span class="badge badge-success mr-2">
                                        <i class="fas fa-check-circle"></i> Seleccionados: {{ $this->selectedCount }}
                                    </span>
                                    <span class="badge badge-primary">
                                        <i class="fas fa-cubes"></i> Cantidad Total: {{ $this->totalQuantity }}
                                    </span>
                                </div>
                            </div>

                            <!-- Botón de impresión -->
                            <button type="button" wire:click="print" class="btn btn-success"
                                wire:loading.attr="disabled" @if ($this->selectedCount === 0) disabled @endif>
                                <span wire:loading.remove wire:target="print">
                                    <i class="fas fa-print"></i>
                                    Imprimir Reporte ({{ $this->selectedCount }})
                                </span>
                                <span wire:loading wire:target="print">
                                    <i class="fas fa-spinner fa-spin"></i> Preparando...
                                </span>
                            </button>
                        </div>
                    </div>

                    <!-- Tabla con columnas dinámicas por fecha -->
                    <div class="table-responsive">
                        @php
                            // Obtener todas las fechas únicas
                            $allDates = collect($data)
                                ->flatMap(function ($item) {
                                    return collect($item['items'] ?? [])->pluck('date');
                                })
                                ->map(function ($date) {
                                    return \Carbon\Carbon::parse($date)->format('Y-m-d');
                                })
                                ->unique()
                                ->sort()
                                ->values();
                        @endphp

                        <table class="table table-bordered table-striped text-center mb-0">
                            <div wire:loading.flex
                                class="col-12 position-absolute justify-content-center align-items-center"
                                style="top:0;right:0;left:0;bottom:0;background-color: rgba(255,255,255,0.8);z-index: 99;">
                                <div class="spinner-border text-primary" role="status">
                                    <span class="sr-only">Cargando...</span>
                                </div>
                            </div>

                            @if ($groupBy === 'product')
                                <thead class="thead-dark">
                                    <tr>
                                        <th style="width: 50px;" rowspan="2"></th>
                                        <th rowspan="2">Producto</th>
                                        <th rowspan="2">Código</th>
                                        <th rowspan="2">Cantidad<br>Total</th>
                                        <th colspan="{{ $allDates->count() }}" class="bg-secondary">Movimientos por
                                            Fecha</th>
                                    </tr>
                                    <tr>
                                        @foreach ($allDates as $date)
                                            <th class="bg-info text-white" style="min-width: 200px;">
                                                {{ \Carbon\Carbon::parse($date)->format('d/m/Y') }}
                                            </th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($data as $item)
                                        <tr
                                            class="{{ in_array($item['id'], $selectedItems) ? 'table-success' : '' }}">
                                            <td>
                                                <input type="checkbox" wire:model="selectedItems"
                                                    value="{{ $item['id'] }}" class="form-check-input">
                                            </td>
                                            <td class="text-left">
                                                <strong>{{ $item['product_name'] }}</strong>
                                            </td>
                                            <td>{{ $item['product_code'] }}</td>
                                            <td>
                                                <span
                                                    class="badge badge-primary badge-lg">{{ $item['total_quantity'] }}</span>
                                            </td>

                                            @php
                                                // Agrupar items por fecha
                                                $itemsByDate = collect($item['items'] ?? [])->groupBy(function (
                                                    $detail,
                                                ) {
                                                    return \Carbon\Carbon::parse($detail['date'])->format('Y-m-d');
                                                });
                                            @endphp

                                            @foreach ($allDates as $date)
                                                <td class="text-left align-top bg-light">
                                                    @if ($itemsByDate->has($date))
                                                        @foreach ($itemsByDate[$date] as $detail)
                                                            <div class="mb-1 p-1 bg-white rounded border">
                                                                <small>
                                                                    <i class="fas fa-hashtag text-muted"></i>
                                                                    <strong>{{ $detail['reference'] }}</strong>
                                                                    <br>
                                                                    <span
                                                                        class="badge badge-{{ $detail['zona'] === 'reception'
                                                                            ? 'primary'
                                                                            : ($detail['zona'] === 'labelqr'
                                                                                ? 'info'
                                                                                : ($detail['zona'] === 'discharge'
                                                                                    ? 'success'
                                                                                    : 'warning')) }} badge-sm">
                                                                        {{ $detail['zona_name'] }}
                                                                    </span>
                                                                    <span class="badge badge-secondary badge-sm ml-1">
                                                                        {{ $detail['quantity'] }} unid.
                                                                    </span>
                                                                </small>
                                                            </div>
                                                        @endforeach
                                                    @else
                                                        <small class="text-muted">-</small>
                                                    @endif
                                                </td>
                                            @endforeach
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="{{ 4 + $allDates->count() }}">
                                                <div class="text-center py-3">
                                                    <i class="fas fa-inbox fa-2x text-muted mb-2"></i>
                                                    <p class="text-muted">No hay datos disponibles</p>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            @elseif($groupBy === 'zona')
                                <!-- Vista agrupada por Zona -->
                                <thead class="thead-dark">
                                    <tr>
                                        <th style="width: 50px;"></th>
                                        <th>Zona</th>
                                        <th>Productos Únicos</th>
                                        <th>Cantidad Total</th>
                                        <th>Registros</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($data as $item)
                                        <tr
                                            class="{{ in_array($item['id'], $selectedItems) ? 'table-success' : '' }}">
                                            <td>
                                                <input type="checkbox" wire:model="selectedItems"
                                                    value="{{ $item['id'] }}" class="form-check-input">
                                            </td>
                                            <td>
                                                <span
                                                    class="badge badge-{{ $item['zona'] === 'reception'
                                                        ? 'primary'
                                                        : ($item['zona'] === 'labelqr'
                                                            ? 'info'
                                                            : ($item['zona'] === 'discharge'
                                                                ? 'success'
                                                                : 'warning')) }}">
                                                    <i
                                                        class="fas fa-{{ $item['zona'] === 'reception'
                                                            ? 'inbox'
                                                            : ($item['zona'] === 'labelqr'
                                                                ? 'qrcode'
                                                                : ($item['zona'] === 'discharge'
                                                                    ? 'box-open'
                                                                    : 'shipping-fast')) }}"></i>
                                                    {{ $item['zona_name'] }}
                                                </span>
                                            </td>
                                            <td>
                                                <span class="badge badge-info">{{ $item['products_count'] }}</span>
                                            </td>
                                            <td>
                                                <span class="badge badge-primary">{{ $item['total_quantity'] }}</span>
                                            </td>
                                            <td>
                                                <span
                                                    class="badge badge-secondary">{{ $item['records_count'] }}</span>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5">
                                                <div class="text-center py-3">
                                                    <i class="fas fa-inbox fa-2x text-muted mb-2"></i>
                                                    <p class="text-muted">No hay datos disponibles</p>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            @else
                                <!-- Vista agrupada por fecha -->
                                <thead class="thead-dark">
                                    <tr>
                                        <th style="width: 50px;"></th>
                                        <th>Fecha</th>
                                        <th>Productos</th>
                                        <th>Zonas</th>
                                        <th>Cantidad Total</th>
                                        <th>Registros</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($data as $item)
                                        <tr
                                            class="{{ in_array($item['id'], $selectedItems) ? 'table-success' : '' }}">
                                            <td>
                                                <input type="checkbox" wire:model="selectedItems"
                                                    value="{{ $item['id'] }}" class="form-check-input">
                                            </td>
                                            <td>
                                                <strong>{{ \Carbon\Carbon::parse($item['date'])->format('d M, Y') }}</strong>
                                            </td>
                                            <td>
                                                <span class="badge badge-info">{{ $item['products_count'] }}</span>
                                            </td>
                                            <td>
                                                <span class="badge badge-warning">{{ $item['zonas_count'] }}</span>
                                            </td>
                                            <td>
                                                <span class="badge badge-primary">{{ $item['total_quantity'] }}</span>
                                            </td>
                                            <td>
                                                <span
                                                    class="badge badge-secondary">{{ $item['records_count'] }}</span>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6">
                                                <div class="text-center py-3">
                                                    <i class="fas fa-inbox fa-2x text-muted mb-2"></i>
                                                    <p class="text-muted">No hay datos disponibles</p>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            @endif
                        </table>
                    </div>

                    <!-- Footer -->
                    <div class="mt-3 d-flex justify-content-between align-items-center">
                        <div>
                            <small class="text-muted">
                                Mostrando {{ count($data) }} registros agrupados por {{ $groupBy }}
                                @if ($this->selectedCount > 0)
                                    | <span class="text-success font-weight-bold">{{ $this->selectedCount }}
                                        seleccionados</span>
                                @endif
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
    <style>
        .table-success {
            background-color: rgba(40, 167, 69, 0.1) !important;
        }

        .btn .fa-spinner {
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            from {
                transform: rotate(0deg);
            }

            to {
                transform: rotate(360deg);
            }
        }

        .btn-group.flex-wrap {
            flex-wrap: wrap;
        }

        .btn-group.flex-wrap .btn {
            margin-bottom: 0.25rem;
        }

        .badge {
            font-size: 0.85rem;
            padding: 0.35em 0.65em;
        }

        .badge-lg {
            font-size: 1.1rem;
            padding: 0.5em 0.8em;
        }

        .badge-sm {
            font-size: 0.75rem;
            padding: 0.25em 0.5em;
        }

        .table th {
            white-space: nowrap;
        }

        .table td {
            vertical-align: middle;
        }
    </style>
@endpush
