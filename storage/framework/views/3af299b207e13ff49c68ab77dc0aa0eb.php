<?php $__env->startSection('title', 'Detalles Stock Generado'); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>">Home</a></li>
        <li class="breadcrumb-item"><a href="<?php echo e(route('stocks.index')); ?>">Stocks Generados</a></li>
        <li class="breadcrumb-item active">Detalles</li>
    </ol>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid mb-4">

        
        <div class="d-flex align-items-center justify-content-between mb-4">
            <div class="d-flex align-items-center">
                <div class="rounded-circle d-flex align-items-center justify-content-center mr-3"
                    style="width:48px;height:48px;background:linear-gradient(135deg,#0ea5e9,#0284c7);">
                    <i class="bi bi-box-seam text-white" style="font-size:1.3rem;"></i>
                </div>
                <div>
                    <h4 class="mb-0 font-weight-bold text-dark">Stock #<?php echo e($stock->reference); ?></h4>
                    <small class="text-muted">
                        <?php echo e(\Carbon\Carbon::parse($stock->created_up)->format('d M, Y')); ?>

                        &nbsp;&bull;&nbsp;
                        <span class="badge badge-info" style="font-size:.75rem;padding:4px 10px;border-radius:20px;">
                            <i class="bi bi-box-seam mr-1"></i> <?php echo e($stock->machine_name); ?>

                        </span>
                    </small>
                </div>
            </div>
            <a href="<?php echo e(route('stocks.index')); ?>"
                class="btn btn-outline-secondary d-flex align-items-center"
                style="border-radius:8px;padding:9px 18px;font-weight:600;">
                <i class="bi bi-arrow-left mr-2"></i> Volver
            </a>
        </div>

        
        <div class="row mb-4">

            
            <div class="col-md-3 mb-3">
                <div class="card border-0 h-100" style="border-radius:12px;box-shadow:0 2px 20px rgba(0,0,0,0.08);">
                    <div class="card-header border-0 d-flex align-items-center"
                        style="background:linear-gradient(135deg,#f8fafc,#f1f5f9);border-radius:12px 12px 0 0;padding:14px 20px;border-left:4px solid #4f46e5;">
                        <i class="bi bi-hospital mr-2" style="color:#4f46e5;"></i>
                        <span class="font-weight-bold text-secondary" style="font-size:.8rem;letter-spacing:.5px;text-transform:uppercase;">Institución</span>
                    </div>
                    <div class="card-body" style="padding:20px;">
                        <p class="font-weight-bold text-dark mb-1" style="font-size:.95rem;"><?php echo e(Institutes()->institute_name); ?></p>
                        <p class="text-muted mb-1" style="font-size:.82rem;">
                            <i class="bi bi-upc mr-1"></i> <?php echo e(Institutes()->institute_code); ?>

                        </p>
                        <p class="text-muted mb-1" style="font-size:.82rem;">
                            <i class="bi bi-diagram-3 mr-1"></i> <?php echo e(Institutes()->institute_area); ?>

                        </p>
                        <p class="text-muted mb-1" style="font-size:.82rem;">
                            <i class="bi bi-geo-alt mr-1"></i> <?php echo e(Institutes()->institute_address); ?>

                        </p>
                        <p class="text-muted mb-0" style="font-size:.82rem;">
                            <i class="bi bi-globe mr-1"></i> <?php echo e(Institutes()->institute_city); ?>, <?php echo e(Institutes()->institute_country); ?>

                        </p>
                    </div>
                </div>
            </div>

            
            <div class="col-md-3 mb-3">
                <div class="card border-0 h-100" style="border-radius:12px;box-shadow:0 2px 20px rgba(0,0,0,0.08);">
                    <div class="card-header border-0 d-flex align-items-center"
                        style="background:linear-gradient(135deg,#f8fafc,#f1f5f9);border-radius:12px 12px 0 0;padding:14px 20px;border-left:4px solid #0ea5e9;">
                        <i class="bi bi-gear mr-2" style="color:#0ea5e9;"></i>
                        <span class="font-weight-bold text-secondary" style="font-size:.8rem;letter-spacing:.5px;text-transform:uppercase;">Información del Proceso</span>
                    </div>
                    <div class="card-body" style="padding:20px;">
                        <?php
                            $items = [
                                ['icon' => 'bi-cpu',           'label' => 'Equipo',           'value' => $stock->machine_name],
                                ['icon' => 'bi-box-seam',      'label' => 'Lote del Equipo',  'value' => $stock->lote_machine],
                                ['icon' => 'bi-virus',         'label' => 'Lote Biológico',   'value' => $stock->lote_biologic],
                                ['icon' => 'bi-thermometer',   'label' => 'Temp. Ambiente',   'value' => $stock->temp_ambiente],
                                ['icon' => 'bi-person-badge',  'label' => 'Operario',         'value' => $stock->operator],
                            ];
                        ?>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="d-flex justify-content-between align-items-center mb-2" style="font-size:.82rem;">
                                <span class="text-muted">
                                    <i class="bi <?php echo e($item['icon']); ?> mr-1" style="color:#0ea5e9;"></i><?php echo e($item['label']); ?>

                                </span>
                                <span class="font-weight-semibold text-dark"><?php echo e($item['value']); ?></span>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>
                </div>
            </div>

            
            <div class="col-md-3 mb-3">
                <div class="card border-0 h-100" style="border-radius:12px;box-shadow:0 2px 20px rgba(0,0,0,0.08);">
                    <div class="card-header border-0 d-flex align-items-center"
                        style="background:linear-gradient(135deg,#f8fafc,#f1f5f9);border-radius:12px 12px 0 0;padding:14px 20px;border-left:4px solid #10b981;">
                        <i class="bi bi-info-circle text-success mr-2"></i>
                        <span class="font-weight-bold text-secondary" style="font-size:.8rem;letter-spacing:.5px;text-transform:uppercase;">Registro</span>
                    </div>
                    <div class="card-body" style="padding:20px;">
                        <div class="d-flex align-items-start mb-3">
                            <div class="rounded mr-3 d-flex align-items-center justify-content-center flex-shrink-0"
                                style="width:34px;height:34px;background:rgba(16,185,129,0.1);">
                                <i class="bi bi-hash text-success" style="font-size:.9rem;"></i>
                            </div>
                            <div>
                                <p class="text-muted mb-0" style="font-size:.75rem;text-transform:uppercase;letter-spacing:.4px;">Número</p>
                                <p class="mb-0 font-weight-bold text-dark" style="font-size:.95rem;"><?php echo e($stock->reference); ?></p>
                            </div>
                        </div>
                        <div class="d-flex align-items-start mb-3">
                            <div class="rounded mr-3 d-flex align-items-center justify-content-center flex-shrink-0"
                                style="width:34px;height:34px;background:rgba(16,185,129,0.1);">
                                <i class="bi bi-calendar-check text-success" style="font-size:.9rem;"></i>
                            </div>
                            <div>
                                <p class="text-muted mb-0" style="font-size:.75rem;text-transform:uppercase;letter-spacing:.4px;">Fecha de Stock</p>
                                <p class="mb-0 font-weight-semibold text-dark" style="font-size:.875rem;">
                                    <?php echo e(\Carbon\Carbon::parse($stock->created_up)->format('d M, Y')); ?>

                                </p>
                            </div>
                        </div>
                        <div class="d-flex align-items-start">
                            <div class="rounded mr-3 d-flex align-items-center justify-content-center flex-shrink-0"
                                style="width:34px;height:34px;background:rgba(16,185,129,0.1);">
                                <i class="bi bi-layers text-success" style="font-size:.9rem;"></i>
                            </div>
                            <div>
                                <p class="text-muted mb-0" style="font-size:.75rem;text-transform:uppercase;letter-spacing:.4px;">Total Ítems</p>
                                <p class="mb-0 font-weight-semibold text-dark" style="font-size:.875rem;">
                                    <?php echo e($stock->stockDetails->count()); ?> <?php echo e($stock->stockDetails->count() === 1 ? 'ítem' : 'ítems'); ?>

                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            
            <div class="col-md-3 mb-3">
                <div class="card border-0 h-100" style="border-radius:12px;box-shadow:0 2px 20px rgba(0,0,0,0.08);">
                    <div class="card-header border-0 d-flex align-items-center"
                        style="background:linear-gradient(135deg,#f8fafc,#f1f5f9);border-radius:12px 12px 0 0;padding:14px 20px;border-left:4px solid #f59e0b;">
                        <i class="bi bi-qr-code mr-2" style="color:#f59e0b;"></i>
                        <span class="font-weight-bold text-secondary" style="font-size:.8rem;letter-spacing:.5px;text-transform:uppercase;">QR del Stock</span>
                    </div>
                    <div class="card-body d-flex flex-column align-items-center justify-content-center" style="padding:20px;">
                        <div class="mb-3">
                            <?php echo QrCode::size(130)->style('square')->generate(
                                'Ref. Stock: ' . $stock->reference .
                                ' // Equipo: ' . $stock->machine_name .
                                ' // Lote: ' . $stock->lote_machine .
                                ' // Fecha: ' . $stock->created_up
                            ); ?>

                        </div>
                        <p class="text-muted mb-1 text-center" style="font-size:.8rem;">
                            <strong><?php echo e($stock->reference); ?></strong>
                        </p>
                        <p class="text-muted mb-0 text-center" style="font-size:.75rem;">
                            <?php echo e(\Carbon\Carbon::parse($stock->created_up)->format('d M, Y')); ?>

                        </p>
                    </div>
                </div>
            </div>

        </div>

        
        <div class="card border-0" style="border-radius:12px;box-shadow:0 2px 20px rgba(0,0,0,0.08);">
            <div class="card-header border-0 d-flex align-items-center justify-content-between"
                style="background:linear-gradient(135deg,#f8fafc,#f1f5f9);border-radius:12px 12px 0 0;padding:16px 24px;">
                <div class="d-flex align-items-center">
                    <i class="bi bi-list-ul mr-2" style="font-size:1.1rem;color:#0ea5e9;"></i>
                    <span class="font-weight-semibold text-secondary" style="font-size:.9rem;letter-spacing:.3px;">INSTRUMENTAL EN STOCK</span>
                </div>
                <span class="badge" style="font-size:.75rem;padding:5px 12px;border-radius:20px;background:rgba(14,165,233,0.12);color:#0284c7;">
                    <?php echo e($stock->stockDetails->count()); ?> <?php echo e($stock->stockDetails->count() === 1 ? 'ítem' : 'ítems'); ?>

                </span>
            </div>
            <div class="card-body" style="padding:0;">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead style="background:#f8fafc;">
                            <tr>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = [
                                    'Instrumental', 'Código', 'Tipo de Envoltura',
                                    'Disponibilidad', 'Tipo de Esterilización',
                                    'Fecha Esterilización', 'Fecha Vencimiento'
                                ]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $col): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <th class="align-middle border-0"
                                        style="font-size:.75rem;text-transform:uppercase;letter-spacing:.5px;color:#64748b;font-weight:600;padding:14px 12px;white-space:nowrap;">
                                        <?php echo e($col); ?>

                                    </th>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $stock->stockDetails; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr style="border-color:#f1f5f9;">
                                    <td class="align-middle" style="padding:14px 12px;">
                                        <span class="font-weight-semibold text-dark" style="font-size:.875rem;"><?php echo e($item->product_name); ?></span>
                                    </td>
                                    <td class="align-middle" style="padding:14px 12px;">
                                        <span class="badge badge-primary" style="font-size:.75rem;padding:4px 10px;border-radius:20px;">
                                            <?php echo e($item->product_code); ?>

                                        </span>
                                    </td>
                                    <td class="align-middle" style="padding:14px 12px;font-size:.85rem;">
                                        <?php echo e($item->product_package_wrap); ?>

                                    </td>
                                    <td class="align-middle" style="padding:14px 12px;">
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($item->product_status_stock == 'Disponible'): ?>
                                            <span class="badge badge-success" style="font-size:.75rem;padding:4px 10px;border-radius:20px;">
                                                <i class="bi bi-check-circle mr-1"></i><?php echo e($item->product_status_stock); ?>

                                            </span>
                                        <?php elseif($item->product_status_stock == 'Despachado'): ?>
                                            <span class="badge badge-secondary" style="font-size:.75rem;padding:4px 10px;border-radius:20px;">
                                                <i class="bi bi-box-arrow-right mr-1"></i><?php echo e($item->product_status_stock); ?>

                                            </span>
                                        <?php else: ?>
                                            <span class="badge badge-dark" style="font-size:.75rem;padding:4px 10px;border-radius:20px;">
                                                <?php echo e($item->product_status_stock); ?>

                                            </span>
                                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    </td>
                                    <td class="align-middle" style="padding:14px 12px;font-size:.85rem;">
                                        <?php echo e($item->product_type_process); ?>

                                    </td>
                                    <td class="align-middle" style="padding:14px 12px;font-size:.85rem;color:#64748b;">
                                        <?php echo e($item->product_date_sterilized); ?>

                                    </td>
                                    <td class="align-middle" style="padding:14px 12px;font-size:.85rem;color:#64748b;">
                                        <?php echo e($item->product_expiration); ?>

                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/Modules/Stock/Resources/views/stocks/show.blade.php ENDPATH**/ ?>