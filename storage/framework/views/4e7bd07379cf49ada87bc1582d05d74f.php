<div>
    <!-- Filtros -->
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="fas fa-history"></i> Historial de Ingresos por Producto</h5>
                </div>
                <div class="card-body">
                    <!-- Fila 1: Búsqueda por producto -->
                    <div class="form-row mb-3">
                        <div class="col-md-4">
                            <label>Nombre del Producto</label>
                            <input type="text" wire:model="searchName" class="form-control"
                                placeholder="Buscar por nombre...">
                        </div>
                        <div class="col-md-3">
                            <label>Código del Producto</label>
                            <input type="text" wire:model="searchCode" class="form-control"
                                placeholder="Buscar por código...">
                        </div>
                        <div class="col-md-3">
                            <label>Casa Comercial</label>
                            <input type="text" wire:model="filterCasaComercial" class="form-control"
                                placeholder="Filtrar por casa comercial...">
                        </div>
                        <div class="col-md-2 d-flex align-items-end">
                            <button class="btn btn-secondary btn-block" wire:click="clearFilters">
                                <i class="fas fa-times"></i> Limpiar
                            </button>
                        </div>
                    </div>

                    <!-- Fila 2: Filtros de fecha, área y estado -->
                    <div class="form-row">
                        <div class="col-md-2">
                            <label>Fecha Inicio</label>
                            <input type="date" wire:model="startDate" class="form-control">
                        </div>
                        <div class="col-md-2">
                            <label>Fecha Fin</label>
                            <input type="date" wire:model="endDate" class="form-control">
                        </div>
                        <div class="col-md-3">
                            <label>Área</label>
                            <select wire:model="filterArea" class="form-control">
                                <option value="">Todas las Áreas</option>
                                <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $areas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $area): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($area->name); ?>"><?php echo e($area->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label>Nivel de Infección</label>
                            <select wire:model="filterTipoDirt" class="form-control">
                                <option value="">Todos</option>
                                <option value="Bajo">Bajo</option>
                                <option value="Medio">Medio</option>
                                <option value="Alto">Alto</option>
                                <option value="Crítico">Crítico</option>
                            </select>
                        </div>
                        <div class="col-md-2 d-flex align-items-end">
                            <button class="btn btn-primary btn-block" wire:click="search">
                                <i class="fas fa-search"></i> Buscar
                            </button>
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

                    <!-- Estadísticas -->
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div>
                            <span class="badge badge-info mr-2">
                                <i class="fas fa-list"></i> Total registros: <?php echo e($totalRecords); ?>

                            </span>
                            <span class="badge badge-primary mr-2">
                                <i class="fas fa-cubes"></i> Cantidad total: <?php echo e($totalQuantity); ?>

                            </span>
                        </div>
                        <div wire:loading class="text-muted">
                            <i class="fas fa-spinner fa-spin"></i> Cargando...
                        </div>
                    </div>

                    <!-- Tabla historial -->
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-sm text-center mb-0">
                            <thead class="thead-dark">
                                <tr>
                                    <th>#Ingreso</th>
                                    <th>Fecha</th>
                                    <th>Producto</th>
                                    <th>Código</th>
                                    <th>Área</th>
                                    <th>Casa Comercial</th>
                                    <th>Cantidad</th>
                                    <th>Paciente</th>
                                    <th>Nivel Infección</th>
                                    <th>Temp. Proceso</th>
                                    <th>Estado Inst.</th>
                                    <th>Operador</th>
                                    <th>Estado</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!--[if BLOCK]><![endif]--><?php $__empty_1 = true; $__currentLoopData = $history; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $detail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <tr>
                                        <td>
                                            <strong class="text-primary">
                                                <?php echo e($detail->reception->reference ?? '—'); ?>

                                            </strong>
                                        </td>
                                        <td>
                                            <?php echo e($detail->reception
                                                ? \Carbon\Carbon::parse($detail->reception->created_at)->format('d/m/Y H:i')
                                                : '—'); ?>

                                        </td>
                                        <td class="text-left">
                                            <strong><?php echo e($detail->product_name); ?></strong>
                                        </td>
                                        <td>
                                            <span class="badge badge-secondary"><?php echo e($detail->product_code); ?></span>
                                        </td>
                                        <td>
                                            <span class="badge badge-info">
                                                <?php echo e($detail->reception->area ?? '—'); ?>

                                            </span>
                                        </td>
                                        <td><?php echo e($detail->product_outside_company ?? '—'); ?></td>
                                        <td>
                                            <span class="badge badge-primary"><?php echo e($detail->product_quantity); ?></span>
                                        </td>
                                        <td><?php echo e($detail->product_patient ?? '—'); ?></td>
                                        <td>
                                            <!--[if BLOCK]><![endif]--><?php if($detail->product_type_dirt): ?>
                                                <?php
                                                    $dirtColors = [
                                                        'Bajo'     => 'success',
                                                        'Medio'    => 'warning',
                                                        'Alto'     => 'orange',
                                                        'Crítico'  => 'danger',
                                                    ];
                                                    $color = $dirtColors[$detail->product_type_dirt] ?? 'secondary';
                                                ?>
                                                <span class="badge badge-<?php echo e($color); ?>">
                                                    <?php echo e($detail->product_type_dirt); ?>

                                                </span>
                                            <?php else: ?>
                                                —
                                            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                        </td>
                                        <td><?php echo e($detail->product_type_process ?? '—'); ?></td>
                                        <td><?php echo e($detail->product_state_rumed ?? '—'); ?></td>
                                        <td><?php echo e($detail->reception->operator ?? '—'); ?></td>
                                        <td>
                                            <!--[if BLOCK]><![endif]--><?php if($detail->reception): ?>
                                                <?php
                                                    $statusColors = [
                                                        'Pendiente'   => 'warning',
                                                        'Registrado'  => 'info',
                                                        'Completado'  => 'success',
                                                        'Cancelado'   => 'danger',
                                                    ];
                                                    $sc = $statusColors[$detail->reception->status] ?? 'secondary';
                                                ?>
                                                <span class="badge badge-<?php echo e($sc); ?>">
                                                    <?php echo e($detail->reception->status); ?>

                                                </span>
                                            <?php else: ?>
                                                —
                                            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <tr>
                                        <td colspan="13">
                                            <div class="text-center py-4">
                                                <i class="fas fa-inbox fa-3x text-muted mb-2"></i>
                                                <p class="text-muted mb-0">No hay registros para los filtros seleccionados</p>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                            </tbody>
                        </table>
                    </div>

                    <!-- Paginación -->
                    <div class="mt-3">
                        <?php echo e($history->links()); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $__env->startPush('styles'); ?>
<style>
    .badge-orange {
        background-color: #fd7e14;
        color: #fff;
    }
    .table th {
        font-size: 0.8rem;
        white-space: nowrap;
    }
    .table td {
        font-size: 0.85rem;
        vertical-align: middle;
    }
</style>
<?php $__env->stopPush(); ?>
<?php /**PATH /var/www/html/resources/views/livewire/reports/product-history.blade.php ENDPATH**/ ?>