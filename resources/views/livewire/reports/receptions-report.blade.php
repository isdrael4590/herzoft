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
                            <input type="text" wire:model="productName" id="productName" class="form-control"
                                placeholder="Buscar por nombre...">
                        </div>
                        <div class="col-md-4">
                            <label for="productCode">Código del Producto</label>
                            <input type="text" wire:model="productCode" id="productCode" class="form-control"
                                placeholder="Buscar por código...">
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

                    <!-- Tabla según agrupación -->
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped text-center mb-0">
                            <div wire:loading.flex
                                class="col-12 position-absolute justify-content-center align-items-center"
                                style="top:0;right:0;left:0;bottom:0;background-color: rgba(255,255,255,0.8);z-index: 99;">
                                <div class="spinner-border text-primary" role="status">
                                    <span class="sr-only">Cargando...</span>
                                </div>
                            </div>

                            @if ($groupBy === 'product')
                                <!-- Vista agrupada por producto -->
                                <thead class="thead-dark">
                                    <tr>
                                        <th style="width: 50px;"></th>
                                        <th>Producto</th>
                                        <th>Código</th>
                                        <th>Cantidad Total</th>
                                        <th>Zonas</th>
                                        <th>Registros</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($data as $index => $item)
                                        <tr class="{{ in_array($item['id'], $selectedItems) ? 'table-success' : '' }}">
                                            <td>
                                                <input type="checkbox" wire:model="selectedItems"
                                                    value="{{ $item['id'] }}" class="form-check-input">
                                            </td>
                                            <td class="text-left">
                                                <strong>{{ $item['product_name'] }}</strong>
                                            </td>
                                            <td>{{ $item['product_code'] }}</td>
                                            <td>
                                                <span class="badge badge-primary">{{ $item['total_quantity'] }}</span>
                                            </td>
                                            <td>
                                                <small>{{ $item['zonas'] }}</small>
                                                <br>
                                                <span class="badge badge-info">{{ $item['zonas_count'] }} Zonas</span>
                                            </td>
                                            <td>
                                                <span class="badge badge-secondary">{{ $item['records_count'] }}</span>
                                            </td>
                                            <td>
                                                <button class="btn btn-sm btn-outline-info toggle-details" 
                                                        type="button"
                                                        data-target="details-{{ $index }}">
                                                    <i class="fas fa-eye"></i> Ver Detalles
                                                </button>
                                            </td>
                                        </tr>
                                        <tr class="detail-row" id="details-{{ $index }}" style="display: none;">
                                            <td colspan="7" class="bg-light">
                                                <div class="p-3">
                                                    <h6>Detalles de movimientos:</h6>
                                                    <table class="table table-sm table-bordered">
                                                        <thead>
                                                            <tr>
                                                                <th>Fecha</th>
                                                                <th>Zona</th>
                                                                <th>Referencia</th>
                                                                <th>Cantidad</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($item['items'] as $detail)
                                                                <tr>
                                                                    <td>{{ \Carbon\Carbon::parse($detail['date'])->format('d/m/Y H:i') }}</td>
                                                                    <td>
                                                                        <span class="badge badge-{{ 
                                                                            $detail['zona'] === 'reception' ? 'primary' :
                                                                            ($detail['zona'] === 'labelqr' ? 'info' :
                                                                            ($detail['zona'] === 'discharge' ? 'success' : 'warning'))
                                                                        }}">
                                                                            {{ $detail['zona_name'] }}
                                                                        </span>
                                                                    </td>
                                                                    <td>{{ $detail['reference'] }}</td>
                                                                    <td>
                                                                        <span class="badge badge-primary">{{ $detail['quantity'] }}</span>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7">
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
                                        <tr class="{{ in_array($item['id'], $selectedItems) ? 'table-success' : '' }}">
                                            <td>
                                                <input type="checkbox" wire:model="selectedItems"
                                                    value="{{ $item['id'] }}" class="form-check-input">
                                            </td>
                                            <td>
                                                <span class="badge badge-{{ 
                                                    $item['zona'] === 'reception' ? 'primary' :
                                                    ($item['zona'] === 'labelqr' ? 'info' :
                                                    ($item['zona'] === 'discharge' ? 'success' : 'warning'))
                                                }}">
                                                    <i class="fas fa-{{ 
                                                        $item['zona'] === 'reception' ? 'inbox' :
                                                        ($item['zona'] === 'labelqr' ? 'qrcode' :
                                                        ($item['zona'] === 'discharge' ? 'box-open' : 'shipping-fast'))
                                                    }}"></i>
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
                                                <span class="badge badge-secondary">{{ $item['records_count'] }}</span>
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
                                        <tr class="{{ in_array($item['id'], $selectedItems) ? 'table-success' : '' }}">
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
                                                <span class="badge badge-secondary">{{ $item['records_count'] }}</span>
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
                                    | <span class="text-success font-weight-bold">{{ $this->selectedCount }} seleccionados</span>
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

        .detail-row {
            transition: all 0.3s ease;
        }
    </style>
@endpush

@push('scripts')
    <script>
        // Usar delegación de eventos para manejar clics incluso después de actualizaciones de Livewire
        document.addEventListener('click', function(e) {
            if (e.target && e.target.closest('.toggle-details')) {
                e.preventDefault();
                e.stopPropagation();
                
                const button = e.target.closest('.toggle-details');
                const targetId = button.getAttribute('data-target');
                const detailRow = document.getElementById(targetId);
                
                if (detailRow) {
                    if (detailRow.style.display === 'none' || detailRow.style.display === '') {
                        detailRow.style.display = 'table-row';
                        button.innerHTML = '<i class="fas fa-eye-slash"></i> Ocultar Detalles';
                    } else {
                        detailRow.style.display = 'none';
                        button.innerHTML = '<i class="fas fa-eye"></i> Ver Detalles';
                    }
                }
            }
        });
    </script>
@endpush