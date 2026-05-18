<div>
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session()->has('message')): ?>
        <div class="alert alert-info alert-dismissible fade show" role="alert">
            <?php echo e(session('message')); ?>

            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session()->has('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?php echo e(session('error')); ?>

            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <!-- Formulario oculto para POST (método de respaldo) -->
    <form id="printForm" method="POST" action="<?php echo e(route('printdisch.post')); ?>" style="display: none;" target="_blank">
        <?php echo csrf_field(); ?>
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
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>Equipo</label>
                                <select wire:model="machine_name" class="form-control" name="machine_name">
                                    <option value="">Seleccione el Equipo</option>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = \Modules\Informat\Entities\Machine::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $machine): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($machine->machine_name); ?>"><?php echo e($machine->machine_name); ?>

                                        </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
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
                    <!-- Botones de selección por categoría -->
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <div class="btn-group mb-2 flex-wrap" role="group">
                                <button type="button" class="btn btn-outline-secondary btn-sm"
                                    wire:click="selectByStatus('Ciclo Aprobado')">
                                    Seleccionar Aprobados
                                </button>
                                <button type="button" class="btn btn-outline-secondary btn-sm"
                                    wire:click="selectByStatus('Ciclo Falla')">
                                    Seleccionar Fallas
                                </button>
                                <button type="button" class="btn btn-outline-info btn-sm"
                                    wire:click="selectByBiologic('Correcto')">
                                    Biológico Correcto
                                </button>
                                <button type="button" class="btn btn-outline-warning btn-sm"
                                    wire:click="selectByBiologic('Falla')">
                                    Biológico Falla
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
                                        <i class="fas fa-list"></i> Total: <?php echo e(count($data)); ?> registros
                                    </span>
                                    <span class="badge badge-success mr-2">
                                        <i class="fas fa-check-circle"></i> Seleccionados: <?php echo e($this->selectedCount); ?>

                                    </span>
                                    <span class="badge badge-primary">
                                        <i class="fas fa-box"></i> Paquetes: <?php echo e($this->totalPackages); ?>

                                    </span>
                                </div>

                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($this->selectedCount > 2000): ?>
                                    <div class="alert alert-warning alert-sm mb-0 py-1 px-2">
                                        <i class="fas fa-exclamation-triangle"></i>
                                        <small>Gran volumen detectado (<?php echo e($this->selectedCount); ?> items)</small>
                                    </div>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>

                            <!-- BOTONES DE IMPRESIÓN -->
                            <div class="d-flex flex-wrap align-items-center" style="gap: 0.5rem;">
                                <!-- Botón principal - Método por sesión -->
                                <button type="button" wire:click="print" class="btn btn-success"
                                    wire:loading.attr="disabled" <?php if($this->selectedCount === 0): ?> disabled <?php endif; ?>>
                                    <span wire:loading.remove wire:target="print">
                                        <i class="fas fa-print"></i>
                                        Imprimir (<?php echo e($this->selectedCount); ?>)
                                    </span>
                                    <span wire:loading wire:target="print">
                                        <i class="fas fa-spinner fa-spin"></i> Preparando...
                                    </span>
                                </button>

                                
                            </div>

                            <!-- Información adicional para grandes volúmenes -->
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($this->selectedCount > 5000): ?>
                                <div class="alert alert-info mt-3 mb-0">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-info-circle text-info mr-2"></i>
                                        <div>
                                            <strong>Volumen muy grande detectado (<?php echo e($this->selectedCount); ?>

                                                elementos)</strong>
                                            <br>
                                            <small>
                                                La generación puede tomar varios minutos. Se recomienda usar el método
                                                "Por Lotes".
                                            </small>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
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
                                    <th>Equipo</th>
                                    <th>Lote Equipo</th>
                                    <th>Validación Proceso</th>
                                    <th>Validación Biológico</th>
                                    <th>Cantidad de Paquetes</th>
                                    <th style="min-width: 200px;">Paquetes</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $discharge): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <tr
                                        class="<?php echo e(in_array($discharge['id'], $selectedItems) ? 'table-success' : ''); ?>">
                                        <td>
                                            <input type="checkbox" wire:model="selectedItems"
                                                value="<?php echo e($discharge['id']); ?>" class="form-check-input">
                                        </td>
                                        <td><?php echo e(\Carbon\Carbon::parse($discharge['updated_at'])->format('d M, Y')); ?>

                                        </td>
                                        <td>
                                            <span class="font-weight-bold"><?php echo e($discharge['reference']); ?></span>
                                        </td>
                                        <td><?php echo e($discharge['machine_name']); ?></td>
                                        <td><?php echo e($discharge['lote_machine']); ?></td>
                                        <td>
                                            <span
                                                class="badge 
                                                <?php if($discharge['status_cycle'] == 'Ciclo Aprobado'): ?> badge-success
                                                <?php elseif($discharge['status_cycle'] == 'Ciclo Falla'): ?> badge-danger
                                                <?php else: ?> badge-secondary <?php endif; ?>">
                                                <?php echo e($discharge['status_cycle']); ?>

                                            </span>
                                        </td>
                                        <td>
                                            <span
                                                class="badge 
                                                <?php if($discharge['validation_biologic'] == 'Correcto'): ?> badge-success
                                                <?php elseif($discharge['validation_biologic'] == 'Falla'): ?> badge-warning
                                                <?php else: ?> badge-secondary <?php endif; ?>">
                                                <?php echo e($discharge['validation_biologic']); ?>

                                            </span>
                                        </td>
                                        <td>
                                            <span class="badge badge-primary">
                                                <?php echo e($discharge['details_count']); ?>

                                            </span>
                                        </td>
                                        <td style="text-align: left; max-width: 250px;">
                                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!empty($discharge['product_names'])): ?>
                                                <div class="product-names-container">
                                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $discharge['product_names']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $productName): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <span class="badge badge-info badge-sm mr-1 mb-1">
                                                            <?php echo e($productName); ?>

                                                        </span>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                                </div>
                                            <?php else: ?>
                                                <small class="text-muted">Sin productos</small>
                                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <tr>
                                        <td colspan="8">
                                            <div class="text-center py-3">
                                                <i class="fas fa-inbox fa-2x text-muted mb-2"></i>
                                                <p class="text-muted">No hay datos disponibles de descarga</p>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </tbody>
                        </table>
                    </div>

                    <!-- Footer con información -->
                    <div class="mt-3 d-flex justify-content-between align-items-center">
                        <div>
                            <small class="text-muted">
                                Mostrando <?php echo e(count($data)); ?> registros
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($this->selectedCount > 0): ?>
                                    | <span class="text-success font-weight-bold"><?php echo e($this->selectedCount); ?>

                                        seleccionados</span>
                                    | <span class="text-primary font-weight-bold"><?php echo e($this->totalPackages); ?> paquetes
                                        totales</span>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </small>
                        </div>
                        <div>
                            <small class="text-muted">
                                Límite actual: <span class="badge badge-secondary"><?php echo e($maxPrintItems); ?></span>
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $__env->startPush('scripts'); ?>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            console.log('DischargeReport: Vista cargada');

            // Función legacy para compatibilidad
            window.printSelectedLegacy = function() {
                const selectedItems = <?php echo json_encode($this->selectedItems, 15, 512) ?>;
                const maxItems = <?php echo e($maxPrintItems); ?>;

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
                console.log('Livewire inicializado para DischargeReport');

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
<?php $__env->stopPush(); ?>

<?php $__env->startPush('styles'); ?>
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
    </style>
<?php $__env->stopPush(); ?>
<?php /**PATH /var/www/html/resources/views/livewire/reports/discharges-report.blade.php ENDPATH**/ ?>