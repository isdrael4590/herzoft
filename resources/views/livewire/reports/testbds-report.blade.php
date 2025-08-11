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
    <form id="printForm" method="POST" action="{{ route('printtestbd.post') }}" style="display: none;" target="_blank">
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
                                <label>Máquina</label>
                                <select wire:model="machine_name" class="form-control" name="machine_name">
                                    <option value="">Seleccione la máquina</option>
                                    {{-- Aquí puedes agregar las opciones de máquinas disponibles --}}
                                    @foreach (\Modules\Informat\Entities\Machine::all() as $machines)
                                        <option value="{{ $machines->machine_name }}">
                                            {{ $machines->machine_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        {{-- <div class="col-lg-6">
                            <div class="form-group">
                                <label>Validación</label>
                                <select wire:model="validation_bd" class="form-control" name="validation_bd">
                                    <option value="">Seleccione validación</option>
                                    <option value="Correcto">Correcto</option>
                                    <option value="Falla">Falla</option>

                                </select>
                            </div>
                        </div> --}}
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
                                    wire:click="selectByStatus('Correcto')">
                                    Seleccionar Correctos
                                </button>
                                <button type="button" class="btn btn-outline-secondary btn-sm"
                                    wire:click="selectByStatus('Falla')">
                                    Seleccionar Fallas
                                </button>

                                <button type="button" class="btn btn-outline-primary btn-sm"
                                    wire:click="selectByStatus('All')">
                                    <i class="fas fa-check-double"></i> Seleccionar Todo
                                </button>
                            </div>
                            <div class="btn-group mb-2 ml-2" role="group">
                                <button type="button" class="btn btn-outline-info btn-sm dropdown-toggle"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-cogs"></i> Por Máquina
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="#" wire:click="selectByMachine('All')">
                                        <i class="fas fa-check-double"></i> Todas las máquinas
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    {{-- Aquí puedes listar las máquinas disponibles dinámicamente --}}
                                    @foreach (collect($data)->pluck('machine_name')->unique() as $machine)
                                        @if ($machine)
                                            <a class="dropdown-item" href="#"
                                                wire:click="selectByMachine('{{ $machine }}')">
                                                {{ $machine }}
                                            </a>
                                        @endif
                                    @endforeach
                                </div>
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
                                    <span class="badge badge-success mr-2">
                                        <i class="fas fa-check"></i> Válidos: {{ $this->validItemsCount }}
                                    </span>
                                    <span class="badge badge-danger">
                                        <i class="fas fa-times"></i> Inválidos: {{ $this->invalidItemsCount }}
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

                                <!-- Botón método directo -->



                                <!-- Botón método chunks para grandes volúmenes -->
                                @if ($this->selectedCount > 1000)
                                    <button type="button" wire:click="printInChunks" class="btn btn-warning btn-sm"
                                        wire:loading.attr="disabled">
                                        <span wire:loading.remove wire:target="printInChunks">
                                            <i class="fas fa-layer-group"></i> Por Lotes
                                        </span>
                                        <span wire:loading wire:target="printInChunks">
                                            <i class="fas fa-spinner fa-spin"></i> Procesando...
                                        </span>
                                    </button>
                                @endif
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
                                                La generación puede tomar varios minutos. Se recomienda usar "Por Lotes"
                                                o filtrar los datos.
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
                                    <th>
                                    </th>
                                    <th>Fecha</th>
                                    <th>ID INGRESO</th>
                                    <th>Máquina</th>
                                    <th>Validación</th>
                                    <th>Estado</th>
                                    {{-- Agrega más columnas según tu modelo Testbd --}}
                                    <th>Detalles</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($data as $testbd)
                                    <tr class="{{ in_array($testbd['id'], $selectedItems) ? 'table-success' : '' }}">
                                        <td>
                                            <input type="checkbox" wire:model="selectedItems"
                                                value="{{ $testbd['id'] }}" class="form-check-input">
                                        </td>
                                        <td>{{ \Carbon\Carbon::parse($testbd['updated_at'])->format('d M, Y H:i') }}
                                        </td>
                                        <td>
                                            <span class="font-weight-bold">{{ $testbd['testbd_reference'] }}</span>
                                        </td>
                                        <td>
                                            <span
                                                class="badge badge-info">{{ $testbd['machine_name'] ?? 'N/A' }}</span>
                                        </td>
                                        <td>
                                            <span
                                                class="badge 
                                                @if ($testbd['validation_bd'] == 'valid') badge-success
                                                @elseif($testbd['validation_bd'] == 'invalid') badge-danger
                                                @elseif($testbd['validation_bd'] == 'pending') badge-warning
                                                @else badge-secondary @endif">
                                                {{ ucfirst($testbd['validation_bd'] ?? 'Unknown') }}
                                            </span>
                                        </td>
                                        <td>
                                            {{-- Aquí puedes agregar un campo de estado si tu modelo lo tiene --}}
                                            <span class="badge badge-secondary">
                                                {{ $testbd['status'] ?? 'Active' }}
                                            </span>
                                        </td>
                                        <td>
                                            {{-- Aquí puedes mostrar información adicional del testbd --}}
                                            <small class="text-muted">
                                                {{-- Ejemplo: {{ $testbd['additional_info'] ?? 'Sin detalles' }} --}}
                                                Test BD #{{ $testbd['id'] }}
                                            </small>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7">
                                            <div class="text-center py-3">
                                                <i class="fas fa-database fa-2x text-muted mb-2"></i>
                                                <p class="text-muted">No hay datos disponibles para mostrar</p>
                                                <small class="text-muted">Ajuste los filtros de búsqueda e intente
                                                    nuevamente</small>
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
                                    @if ($this->validItemsCount > 0)
                                        | <span class="text-success font-weight-bold">{{ $this->validItemsCount }}
                                            válidos</span>
                                    @endif
                                    @if ($this->invalidItemsCount > 0)
                                        | <span class="text-danger font-weight-bold">{{ $this->invalidItemsCount }}
                                            inválidos</span>
                                    @endif
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
            console.log('TestbdReport: Vista cargada');

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
                    // Usar el método original del componente
                    @this.call('printtbd');
                } catch (error) {
                    console.error('Error en método legacy:', error);
                    alert('Error preparando impresión: ' + error.message);
                }
            }

            // Manejar eventos de Livewire
            document.addEventListener('livewire:init', () => {
                console.log('Livewire TestbdReport inicializado');

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

                // Evento específico para mostrar estadísticas
                Livewire.on('updateStats', (data) => {
                    console.log('Estadísticas actualizadas:', data);
                });
            });

            // Función para manejar selección por máquina dinámicamente
            window.selectByMachineDynamic = function(machineName) {
                @this.call('selectByMachine', machineName);
            }
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

        /* Estilos específicos para TestBD */
        .badge-sm {
            font-size: 0.75em;
        }

        .dropdown-menu {
            max-height: 300px;
            overflow-y: auto;
        }

        /* Indicador de validación */
        .validation-indicator {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            display: inline-block;
            margin-right: 5px;
        }

        .validation-valid {
            background-color: #28a745;
        }

        .validation-invalid {
            background-color: #dc3545;
        }

        .validation-pending {
            background-color: #ffc107;
        }
    </style>
@endpush
