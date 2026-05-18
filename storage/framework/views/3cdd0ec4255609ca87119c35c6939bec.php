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

    
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="form-row">
                        <div class="col-md-2">
                            <label class="small font-weight-bold">Fecha Inicio</label>
                            <input type="date" wire:model="startDate" class="form-control form-control-sm">
                        </div>
                        <div class="col-md-2">
                            <label class="small font-weight-bold">Fecha Fin</label>
                            <input type="date" wire:model="endDate" class="form-control form-control-sm">
                        </div>
                        <div class="col-md-2">
                            <label class="small font-weight-bold">Área</label>
                            <select wire:model="area" class="form-control form-control-sm">
                                <option value="">Todas las Áreas</option>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $areas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $a): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($a->id); ?>"><?php echo e($a->area_name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label class="small font-weight-bold">Estado</label>
                            <select wire:model="status" class="form-control form-control-sm">
                                <option value="">Todos</option>
                                <option value="procesado">Procesado</option>
                                <option value="pendiente">Pendiente</option>
                                <option value="registrado">Registrado</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label class="small font-weight-bold">Producto</label>
                            <input type="text" wire:model="productName" class="form-control form-control-sm"
                                   placeholder="Nombre...">
                        </div>
                        <div class="col-md-2">
                            <label class="small font-weight-bold">Código</label>
                            <input type="text" wire:model="productCode" class="form-control form-control-sm"
                                   placeholder="Código...">
                        </div>
                    </div>

                    <div class="form-row mt-2 align-items-end">
                        <div class="col-md-3">
                            <label class="small font-weight-bold">Agrupar PDF por</label>
                            <select wire:model.defer="groupBy" class="form-control form-control-sm">
                                <option value="date">Fecha</option>
                                <option value="product">Producto</option>
                                <option value="area">Área</option>
                                <option value="code_date">Código + Fecha</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-primary btn-sm btn-block" wire:click="loadData">
                                <span wire:loading.remove wire:target="loadData">
                                    <i class="fas fa-search"></i> Buscar
                                </span>
                                <span wire:loading wire:target="loadData">
                                    <i class="fas fa-spinner fa-spin"></i> Buscando...
                                </span>
                            </button>
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

                    
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <div class="btn-group mb-2 flex-wrap" role="group">
                                <button type="button" class="btn btn-outline-secondary btn-sm"
                                    wire:click="selectByStatus('procesado')">
                                    Procesados
                                </button>
                                <button type="button" class="btn btn-outline-warning btn-sm"
                                    wire:click="selectByStatus('pendiente')">
                                    Pendientes
                                </button>
                                <button type="button" class="btn btn-outline-info btn-sm"
                                    wire:click="selectByStatus('registrado')">
                                    Registrados
                                </button>
                                <button type="button" class="btn btn-outline-primary btn-sm"
                                    wire:click="selectByStatus('All')">
                                    <i class="fas fa-check-double"></i> Seleccionar Todo
                                </button>
                            </div>
                        </div>

                        <div class="col-md-12">
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

                            <div class="d-flex flex-wrap align-items-center" style="gap: 0.5rem;">
                                <button type="button" wire:click="print" class="btn btn-success"
                                    wire:loading.attr="disabled"
                                    <?php if($this->selectedCount === 0): ?> disabled <?php endif; ?>>
                                    <span wire:loading.remove wire:target="print">
                                        <i class="fas fa-print"></i>
                                        Imprimir (<?php echo e($this->selectedCount); ?>)
                                    </span>
                                    <span wire:loading wire:target="print">
                                        <i class="fas fa-spinner fa-spin"></i> Preparando...
                                    </span>
                                </button>
                            </div>

                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($this->selectedCount > 5000): ?>
                                <div class="alert alert-info mt-3 mb-0">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-info-circle text-info mr-2"></i>
                                        <div>
                                            <strong>Volumen muy grande detectado (<?php echo e($this->selectedCount); ?> elementos)</strong>
                                            <br>
                                            <small>La generación puede tomar varios minutos.</small>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>
                    </div>

                    
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped text-center mb-0">
                            <div wire:loading.flex
                                class="col-12 position-absolute justify-content-center align-items-center"
                                style="top:0;right:0;left:0;bottom:0;background-color:rgba(255,255,255,0.8);z-index:99;">
                                <div class="spinner-border text-primary" role="status">
                                    <span class="sr-only">Cargando...</span>
                                </div>
                            </div>
                            <thead class="thead-dark">
                                <tr>
                                    <th style="width:50px;"></th>
                                    <th>Fecha</th>
                                    <th>Referencia</th>
                                    <th>Área</th>
                                    <th>Entrega</th>
                                    <th>Recibe</th>
                                    <th>Estado</th>
                                    <th>Cantidad de Paquetes</th>
                                    <th style="min-width:200px;">Productos</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $reception): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <tr class="<?php echo e(isset($selectedSet[(string)$reception['id']]) ? 'table-success' : ''); ?>">
                                        <td>
                                            <input type="checkbox" wire:model.defer="selectedItems"
                                                value="<?php echo e($reception['id']); ?>" class="form-check-input">
                                        </td>
                                        <td><?php echo e(\Carbon\Carbon::parse($reception['updated_at'])->format('d M, Y')); ?></td>
                                        <td>
                                            <span class="font-weight-bold"><?php echo e($reception['reference']); ?></span>
                                        </td>
                                        <td><?php echo e($reception['area'] ?? '—'); ?></td>
                                        <td><?php echo e($reception['delivery_staff'] ?? '—'); ?></td>
                                        <td><?php echo e($reception['operator'] ?? '—'); ?></td>
                                        <td>
                                            <span class="badge
                                                <?php if($reception['status'] === 'procesado'): ?> badge-success
                                                <?php elseif($reception['status'] === 'pendiente'): ?> badge-warning
                                                <?php elseif($reception['status'] === 'registrado'): ?> badge-info
                                                <?php else: ?> badge-secondary <?php endif; ?>">
                                                <?php echo e(ucfirst($reception['status'] ?? '—')); ?>

                                            </span>
                                        </td>
                                        <td>
                                            <span class="badge badge-primary">
                                                <?php echo e($reception['details_count']); ?>

                                            </span>
                                        </td>
                                        <td style="text-align:left; max-width:250px;">
                                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!empty($reception['product_names'])): ?>
                                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $reception['product_names']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <span class="badge badge-info badge-sm mr-1 mb-1"><?php echo e($name); ?></span>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                            <?php else: ?>
                                                <small class="text-muted">Sin productos</small>
                                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <tr>
                                        <td colspan="9">
                                            <div class="text-center py-3">
                                                <i class="fas fa-inbox fa-2x text-muted mb-2"></i>
                                                <p class="text-muted">No hay datos disponibles de recepciones</p>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </tbody>
                        </table>
                    </div>

                    
                    <div class="mt-3 d-flex justify-content-between align-items-center">
                        <div>
                            <small class="text-muted">
                                Mostrando <?php echo e(count($data)); ?> registros
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($this->selectedCount > 0): ?>
                                    | <span class="text-success font-weight-bold"><?php echo e($this->selectedCount); ?> seleccionados</span>
                                    | <span class="text-primary font-weight-bold"><?php echo e($this->totalPackages); ?> paquetes totales</span>
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

<?php $__env->startPush('styles'); ?>
    <style>
        .table-success {
            background-color: rgba(40, 167, 69, 0.1) !important;
        }

        .btn .fa-spinner {
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            from { transform: rotate(0deg); }
            to   { transform: rotate(360deg); }
        }

        .btn-group.flex-wrap {
            flex-wrap: wrap;
        }

        .btn-group.flex-wrap .btn {
            margin-bottom: 0.25rem;
        }
    </style>
<?php $__env->stopPush(); ?>
<?php /**PATH /var/www/html/resources/views/livewire/reports/receptions-report.blade.php ENDPATH**/ ?>