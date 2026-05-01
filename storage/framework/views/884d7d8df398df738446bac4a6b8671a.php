<div>
    <!--[if BLOCK]><![endif]--><?php if(session()->has('message')): ?>
        <div class="alert alert-info alert-dismissible fade show" role="alert">
            <?php echo e(session('message')); ?>

            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

    <?php if(session()->has('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?php echo e(session('error')); ?>

            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

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
                                class="form-control <?php $__errorArgs = ['productName'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                placeholder="Buscar por nombre...">
                            <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['productName'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
                        </div>
                        <div class="col-md-4">
                            <label for="productCode">Código del Producto</label>
                            <input type="text" wire:model="productCode" id="productCode"
                                class="form-control <?php $__errorArgs = ['productCode'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                placeholder="Buscar por código...">
                            <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['productCode'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
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
                                        <i class="fas fa-list"></i> Total: <?php echo e(count($data)); ?> registros
                                    </span>
                                    <span class="badge badge-success mr-2">
                                        <i class="fas fa-check-circle"></i> Seleccionados: <?php echo e($this->selectedCount); ?>

                                    </span>
                                    <span class="badge badge-primary">
                                        <i class="fas fa-cubes"></i> Cantidad Total: <?php echo e($this->totalQuantity); ?>

                                    </span>
                                </div>
                            </div>

                            <!-- Botón de impresión -->
                            <button type="button" wire:click="print" class="btn btn-success"
                                wire:loading.attr="disabled" <?php if($this->selectedCount === 0): ?> disabled <?php endif; ?>>
                                <span wire:loading.remove wire:target="print">
                                    <i class="fas fa-print"></i>
                                    Imprimir Reporte (<?php echo e($this->selectedCount); ?>)
                                </span>
                                <span wire:loading wire:target="print">
                                    <i class="fas fa-spinner fa-spin"></i> Preparando...
                                </span>
                            </button>
                        </div>
                    </div>

                    <!-- Tabla con columnas dinámicas por fecha -->
                    <div class="table-responsive">
                        <?php
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
                        ?>

                        <table class="table table-bordered table-striped text-center mb-0">
                            <div wire:loading.flex
                                class="col-12 position-absolute justify-content-center align-items-center"
                                style="top:0;right:0;left:0;bottom:0;background-color: rgba(255,255,255,0.8);z-index: 99;">
                                <div class="spinner-border text-primary" role="status">
                                    <span class="sr-only">Cargando...</span>
                                </div>
                            </div>

                            <!--[if BLOCK]><![endif]--><?php if($groupBy === 'product'): ?>
                                <thead class="thead-dark">
                                    <tr>
                                        <th style="width: 50px;" rowspan="2"></th>
                                        <th rowspan="2">Producto</th>
                                        <th rowspan="2">Código</th>
                                        <th rowspan="2">Cantidad<br>Total</th>
                                        <th colspan="<?php echo e($allDates->count()); ?>" class="bg-secondary">Movimientos por
                                            Fecha</th>
                                    </tr>
                                    <tr>
                                        <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $allDates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $date): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <th class="bg-info text-white" style="min-width: 200px;">
                                                <?php echo e(\Carbon\Carbon::parse($date)->format('d/m/Y')); ?>

                                            </th>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                                    </tr>
                                </thead>
                                <tbody>
                                    <!--[if BLOCK]><![endif]--><?php $__empty_1 = true; $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                        <tr
                                            class="<?php echo e(in_array($item['id'], $selectedItems) ? 'table-success' : ''); ?>">
                                            <td>
                                                <input type="checkbox" wire:model="selectedItems"
                                                    value="<?php echo e($item['id']); ?>" class="form-check-input">
                                            </td>
                                            <td class="text-left">
                                                <strong><?php echo e($item['product_name']); ?></strong>
                                            </td>
                                            <td><?php echo e($item['product_code']); ?></td>
                                            <td>
                                                <span
                                                    class="badge badge-primary badge-lg"><?php echo e($item['total_quantity']); ?></span>
                                            </td>

                                            <?php
                                                // Agrupar items por fecha
                                                $itemsByDate = collect($item['items'] ?? [])->groupBy(function (
                                                    $detail,
                                                ) {
                                                    return \Carbon\Carbon::parse($detail['date'])->format('Y-m-d');
                                                });
                                            ?>

                                            <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $allDates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $date): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <td class="text-left align-top bg-light">
                                                    <!--[if BLOCK]><![endif]--><?php if($itemsByDate->has($date)): ?>
                                                        <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $itemsByDate[$date]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $detail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <div class="mb-1 p-1 bg-white rounded border">
                                                                <small>
                                                                    <i class="fas fa-hashtag text-muted"></i>
                                                                    <strong><?php echo e($detail['reference']); ?></strong>
                                                                    <br>
                                                                    <span
                                                                        class="badge badge-<?php echo e($detail['zona'] === 'reception'
                                                                            ? 'primary'
                                                                            : ($detail['zona'] === 'labelqr'
                                                                                ? 'info'
                                                                                : ($detail['zona'] === 'discharge'
                                                                                    ? 'success'
                                                                                    : 'warning'))); ?> badge-sm">
                                                                        <?php echo e($detail['zona_name']); ?>

                                                                    </span>
                                                                    <span class="badge badge-secondary badge-sm ml-1">
                                                                        <?php echo e($detail['quantity']); ?> unid.
                                                                    </span>
                                                                </small>
                                                            </div>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                                                    <?php else: ?>
                                                        <small class="text-muted">-</small>
                                                    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                                </td>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                        <tr>
                                            <td colspan="<?php echo e(4 + $allDates->count()); ?>">
                                                <div class="text-center py-3">
                                                    <i class="fas fa-inbox fa-2x text-muted mb-2"></i>
                                                    <p class="text-muted">No hay datos disponibles</p>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                </tbody>
                            <?php elseif($groupBy === 'zona'): ?>
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
                                    <!--[if BLOCK]><![endif]--><?php $__empty_1 = true; $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                        <tr
                                            class="<?php echo e(in_array($item['id'], $selectedItems) ? 'table-success' : ''); ?>">
                                            <td>
                                                <input type="checkbox" wire:model="selectedItems"
                                                    value="<?php echo e($item['id']); ?>" class="form-check-input">
                                            </td>
                                            <td>
                                                <span
                                                    class="badge badge-<?php echo e($item['zona'] === 'reception'
                                                        ? 'primary'
                                                        : ($item['zona'] === 'labelqr'
                                                            ? 'info'
                                                            : ($item['zona'] === 'discharge'
                                                                ? 'success'
                                                                : 'warning'))); ?>">
                                                    <i
                                                        class="fas fa-<?php echo e($item['zona'] === 'reception'
                                                            ? 'inbox'
                                                            : ($item['zona'] === 'labelqr'
                                                                ? 'qrcode'
                                                                : ($item['zona'] === 'discharge'
                                                                    ? 'box-open'
                                                                    : 'shipping-fast'))); ?>"></i>
                                                    <?php echo e($item['zona_name']); ?>

                                                </span>
                                            </td>
                                            <td>
                                                <span class="badge badge-info"><?php echo e($item['products_count']); ?></span>
                                            </td>
                                            <td>
                                                <span class="badge badge-primary"><?php echo e($item['total_quantity']); ?></span>
                                            </td>
                                            <td>
                                                <span
                                                    class="badge badge-secondary"><?php echo e($item['records_count']); ?></span>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                        <tr>
                                            <td colspan="5">
                                                <div class="text-center py-3">
                                                    <i class="fas fa-inbox fa-2x text-muted mb-2"></i>
                                                    <p class="text-muted">No hay datos disponibles</p>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                </tbody>
                            <?php else: ?>
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
                                    <!--[if BLOCK]><![endif]--><?php $__empty_1 = true; $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                        <tr
                                            class="<?php echo e(in_array($item['id'], $selectedItems) ? 'table-success' : ''); ?>">
                                            <td>
                                                <input type="checkbox" wire:model="selectedItems"
                                                    value="<?php echo e($item['id']); ?>" class="form-check-input">
                                            </td>
                                            <td>
                                                <strong><?php echo e(\Carbon\Carbon::parse($item['date'])->format('d M, Y')); ?></strong>
                                            </td>
                                            <td>
                                                <span class="badge badge-info"><?php echo e($item['products_count']); ?></span>
                                            </td>
                                            <td>
                                                <span class="badge badge-warning"><?php echo e($item['zonas_count']); ?></span>
                                            </td>
                                            <td>
                                                <span class="badge badge-primary"><?php echo e($item['total_quantity']); ?></span>
                                            </td>
                                            <td>
                                                <span
                                                    class="badge badge-secondary"><?php echo e($item['records_count']); ?></span>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                        <tr>
                                            <td colspan="6">
                                                <div class="text-center py-3">
                                                    <i class="fas fa-inbox fa-2x text-muted mb-2"></i>
                                                    <p class="text-muted">No hay datos disponibles</p>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                </tbody>
                            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                        </table>
                    </div>

                    <!-- Footer -->
                    <div class="mt-3 d-flex justify-content-between align-items-center">
                        <div>
                            <small class="text-muted">
                                Mostrando <?php echo e(count($data)); ?> registros agrupados por <?php echo e($groupBy); ?>

                                <!--[if BLOCK]><![endif]--><?php if($this->selectedCount > 0): ?>
                                    | <span class="text-success font-weight-bold"><?php echo e($this->selectedCount); ?>

                                        seleccionados</span>
                                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
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
<?php $__env->stopPush(); ?>
<?php /**PATH /var/www/html/resources/views/livewire/reports/products-zona-report.blade.php ENDPATH**/ ?>