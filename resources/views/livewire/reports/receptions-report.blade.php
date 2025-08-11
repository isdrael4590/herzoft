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

    <!-- Formulario oculto para POST (método de respaldo) -->
    <form id="printForm" method="POST" action="{{ route('printreception.post') }}" style="display: none;"
        target="_blank">
        @csrf
        <input type="hidden" name="items" id="printItems">
    </form>

    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="form-row">
                        <div class="col-md-4">
                            <label for="startDate">Fecha Inicio</label>
                            <input type="date" wire:model="startDate" id="startDate" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label for="endDate">Fecha Fin</label>
                            <input type="date" wire:model="endDate" id="endDate" class="form-control">
                        </div>
                        <div class="col-md-4 d-flex align-items-end">
                            <button class="btn btn-primary btn-block" wire:click="loadData">
                                <i class="fas fa-search"></i> Buscar
                            </button>
                        </div>
                    </div>

                    <div class="form-row mt-3">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Área</label>
                                <select wire:model="area" class="form-control" name="area">
                                    <option value="">Seleccione el área</option>
                                    @foreach (\Modules\Informat\Entities\Area::all() as $area)
                                        <option value="{{ $area->area_name }}">{{ $area->area_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <!-- Información de selección -->
                    <div class="row mb-3">
                        <div class="col-md-8">
                            <div class="btn-group mb-2" role="group">
                                <button type="button" class="btn btn-outline-secondary btn-sm"
                                    wire:click="selectByStatus('Registrado')">
                                    Seleccionar Registrados
                                </button>
                                <button type="button" class="btn btn-outline-secondary btn-sm"
                                    wire:click="selectByStatus('Pendiente')">
                                    Seleccionar Pendientes
                                </button>
                                <button type="button" class="btn btn-outline-secondary btn-sm"
                                    wire:click="selectByStatus('Procesado')">
                                    Seleccionar Procesados
                                </button>
                                <button type="button" class="btn btn-outline-primary btn-sm"
                                    wire:click="selectByStatus('All')">
                                    <i class="fas fa-check-double"></i> Seleccionar Todo
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
                                        <i class="fas fa-box"></i> Paquetes: {{ $this->totalPackages }}
                                    </span>
                                </div>

                                @if ($this->selectedCount > 2000)
                                    <div class="alert alert-warning alert-sm mb-0 py-1 px-2">
                                        <i class="fas fa-exclamation-triangle"></i>
                                        <small>Gran volumen detectado ({{ $this->selectedCount }} items)</small>
                                    </div>
                                @endif
                            </div>

                            <!-- BOTONES DE IMPRESIÓN -->
                            <div class="d-flex flex-wrap align-items-center" style="gap: 0.5rem;">
                                <!-- Botón principal - Método por sesión -->
                                <button type="button" wire:click="print" class="btn btn-success"
                                    wire:loading.attr="disabled" @if ($this->selectedCount === 0) disabled @endif>
                                    <span wire:loading.remove wire:target="print">
                                        <i class="fas fa-print"></i>
                                        Imprimir ({{ $this->selectedCount }})
                                    </span>
                                    <span wire:loading wire:target="print">
                                        <i class="fas fa-spinner fa-spin"></i> Preparando...
                                    </span>
                                </button>

                                <!-- Botón método original (respaldo) -->
                                <button type="button" onclick="printSelectedLegacy()" class="btn btn-secondary btn-sm"
                                    @if ($this->selectedCount === 0) disabled @endif>
                                    <i class="fas fa-print"></i>
                                    Legacy
                                </button>
                            </div>

                            <!-- Información adicional para grandes volúmenes -->
                            @if ($this->selectedCount > 5000)
                                <div class="alert alert-info mt-3 mb-0">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-info-circle text-info mr-2"></i>
                                        <div>
                                            <strong>Volumen muy grande detectado ({{ $this->selectedCount }}
                                                elementos)</strong>
                                            <br>
                                            <small>
                                                La generación puede tomar varios minutos. Se recomienda filtrar los
                                                datos.
                                            </small>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Tabla -->
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped text-center mb-0">
                            <div wire:loading.flex
                                class="col-12 position-absolute justify-content-center align-items-center"
                                style="top:0;right:0;left:0;bottom:0;background-color: rgba(255,255,255,0.8);z-index: 99;">
                                <div class="spinner-border text-primary" role="status">
                                    <span class="sr-only">Cargando...</span>
                                </div>
                            </div>
                            <thead class="thead-dark">
                                <tr>
                                    <th style="width: 50px;">

                                    </th>
                                    <th>Fecha</th>
                                    <th>Referencia</th>
                                    <th>Área</th>
                                    <th>Estado</th>
                                    <th>Persona Entrega</th>
                                    <th>Persona que Recibe</th>
                                    <th>Cant. de Paquetes</th>
                                    <th style="min-width: 200px;">Paquetes</th>
                                    <th>Observaciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($data as $reception)
                                    <tr
                                        class="{{ in_array($reception['id'], $selectedItems) ? 'table-success' : '' }}">
                                        <td>
                                            <input type="checkbox" wire:model="selectedItems"
                                                value="{{ $reception['id'] }}" class="form-check-input">
                                        </td>
                                        <td>{{ \Carbon\Carbon::parse($reception['updated_at'])->format('d M, Y') }}
                                        </td>
                                        <td>
                                            <span class="font-weight-bold">{{ $reception['reference'] }}</span>
                                        </td>
                                        <td>{{ $reception['area'] }}</td>
                                        <td>
                                            <span
                                                class="badge 
                                                @if ($reception['status'] == 'Procesado') badge-success
                                                @elseif($reception['status'] == 'Pendiente') badge-warning
                                                @else badge-secondary @endif">
                                                {{ $reception['status'] }}
                                            </span>
                                        </td>
                                        <td>{{ $reception['delivery_staff'] }}</td>
                                        <td>{{ $reception['operator'] }}</td>
                                        <td>
                                            <span class="badge badge-primary">
                                                {{ $reception['details_count'] }}
                                            </span>
                                        </td>
                                         <td style="text-align: left; max-width: 250px;">
                                            @if (!empty($reception['product_names']))
                                                <div class="product-names-container">
                                                    @foreach ($reception['product_names'] as $productName)
                                                        <span class="badge badge-info badge-sm mr-1 mb-1">
                                                            {{ $productName }}
                                                        </span>
                                                    @endforeach
                                                </div>
                                            @else
                                                <small class="text-muted">Sin productos</small>
                                            @endif
                                        </td>
                                        <td>
                                            @if (!empty($reception['note']))
                                                <span class="text-muted">{{ $reception['note'] }}</span>
                                            @else
                                                <small class="text-muted">Sin observaciones</small>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8">
                                            <div class="text-center py-3">
                                                <i class="fas fa-inbox fa-2x text-muted mb-2"></i>
                                                <p class="text-muted">No hay datos disponibles para mostrar</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Footer con información -->
                    <div class="mt-3 d-flex justify-content-between align-items-center">
                        <div>
                            <small class="text-muted">
                                Mostrando {{ count($data) }} registros
                                @if ($this->selectedCount > 0)
                                    | <span class="text-success font-weight-bold">{{ $this->selectedCount }}
                                        seleccionados</span>
                                    | <span class="text-primary font-weight-bold">{{ $this->totalPackages }} paquetes
                                        totales</span>
                                @endif
                            </small>
                        </div>
                        <div>
                            <small class="text-muted">
                                Límite actual: <span class="badge badge-secondary">{{ $maxPrintItems }}</span>
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            console.log('ReceptionReport: Vista cargada');

            // Función legacy para compatibilidad
            window.printSelectedLegacy = function() {
                const selectedItems = @json($this->selectedItems);
                const maxItems = {{ $maxPrintItems }};

                if (selectedItems.length === 0) {
                    alert('Por favor seleccione al menos un elemento para imprimir.');
                    return;
                }

                if (selectedItems.length > maxItems) {
                    alert(`Demasiados elementos seleccionados. El límite actual es ${maxItems} elementos.`);
                    return;
                }

                if (!confirm(`¿Está seguro de que desea imprimir ${selectedItems.length} elementos?`)) {
                    return;
                }

                console.log('Legacy Print: Procesando', selectedItems.length, 'elementos');

                try {
                    document.getElementById('printItems').value = JSON.stringify(selectedItems);
                    document.getElementById('printForm').submit();
                } catch (error) {
                    console.error('Error en método legacy:', error);
                    alert('Error preparando impresión: ' + error.message);
                }
            }

            // Manejar eventos de Livewire
            document.addEventListener('livewire:init', () => {
                console.log('Livewire inicializado');

                Livewire.on('submitPrintForm', (items) => {
                    console.log('Evento submitPrintForm recibido:', items[0]?.length || 0,
                        'elementos');

                    if (items[0] && items[0].length > 0) {
                        try {
                            document.getElementById('printItems').value = JSON.stringify(items[0]);
                            document.getElementById('printForm').submit();
                        } catch (error) {
                            console.error('Error procesando evento submitPrintForm:', error);
                            alert('Error enviando formulario: ' + error.message);
                        }
                    } else {
                        alert('No se recibieron elementos válidos para imprimir.');
                    }
                });
            });
        });
    </script>
@endpush

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
    </style>
@endpush
