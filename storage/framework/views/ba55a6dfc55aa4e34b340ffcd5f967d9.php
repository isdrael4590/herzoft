<?php $__env->startSection('title', 'Historial de Prelavado'); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>">Home</a></li>
        <li class="breadcrumb-item"><a href="<?php echo e(route('prelavado.index')); ?>">Instrumental a Lavar</a></li>
        <li class="breadcrumb-item active">Historial <?php echo e($product_code); ?></li>
    </ol>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid mb-4">

        <div class="d-flex align-items-center justify-content-between mb-4">
            <div class="d-flex align-items-center">
                <div class="rounded-circle d-flex align-items-center justify-content-center mr-3"
                    style="width:48px;height:48px;background:linear-gradient(135deg,#0ea5e9,#0284c7);">
                    <i class="bi bi-clock-history text-white" style="font-size:1.4rem;"></i>
                </div>
                <div>
                    <h5 class="mb-0 font-weight-bold text-dark">Historial de Prelavado</h5>
                    <small class="text-muted">
                        <strong><?php echo e($product_name); ?></strong>
                        <span class="badge badge-info ml-1"><?php echo e($product_code); ?></span>
                    </small>
                </div>
            </div>
            <a href="<?php echo e(route('prelavado.index')); ?>" class="btn btn-outline-secondary d-flex align-items-center"
                style="border-radius:8px;padding:9px 18px;font-weight:600;">
                <i class="bi bi-arrow-left mr-2"></i> Volver
            </a>
        </div>

        <div class="card border-0" style="border-radius:12px;box-shadow:0 2px 20px rgba(0,0,0,0.08);">
            <div class="card-header border-0 d-flex align-items-center"
                style="background:linear-gradient(135deg,#f8fafc,#f1f5f9);border-radius:12px 12px 0 0;padding:14px 24px;border-left:4px solid #0ea5e9;">
                <i class="bi bi-list-ul text-info mr-2"></i>
                <span class="font-weight-bold text-secondary"
                    style="font-size:.85rem;letter-spacing:.5px;text-transform:uppercase;">
                    Registros de Prelavado
                </span>
                <span class="badge badge-info ml-2"><?php echo e($detalles->count()); ?> registro(s)</span>
                <span class="badge ml-2" style="background:#0f172a;color:#fff;">
                    Total: <?php echo e($detalles->sum('product_quantity')); ?> uds.
                </span>
            </div>
            <div class="card-body" style="padding:24px;">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead style="background:#f8fafc;">
                            <tr>
                                <th style="font-size:.8rem;font-weight:700;color:#64748b;">Fecha</th>
                                <th style="font-size:.8rem;font-weight:700;color:#64748b;">Referencia Recepción</th>
                                <th class="text-center" style="font-size:.8rem;font-weight:700;color:#64748b;">Cantidad</th>
                                <th style="font-size:.8rem;font-weight:700;color:#64748b;">Área</th>
                                <th style="font-size:.8rem;font-weight:700;color:#64748b;">Proceso</th>
                                <th style="font-size:.8rem;font-weight:700;color:#64748b;">Paciente</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $detalles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $detalle): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr>
                                    <td class="align-middle" style="font-size:.85rem;">
                                        <?php echo e($detalle->created_at->format('d/m/Y H:i')); ?>

                                    </td>
                                    <td class="align-middle" style="font-size:.85rem;">
                                        <span class="badge badge-light border">
                                            <?php echo e($detalle->reception_reference ?? optional($detalle->reception)->reference ?? '-'); ?>

                                        </span>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="badge badge-secondary" style="font-size:.85rem;padding:5px 10px;">
                                            <?php echo e($detalle->product_quantity); ?>

                                        </span>
                                    </td>
                                    <td class="align-middle" style="font-size:.85rem;"><?php echo e($detalle->product_area ?? '-'); ?></td>
                                    <td class="align-middle" style="font-size:.85rem;"><?php echo e($detalle->product_type_process ?? '-'); ?></td>
                                    <td class="align-middle" style="font-size:.85rem;"><?php echo e($detalle->product_patient ?? '-'); ?></td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td colspan="6" class="text-center text-muted py-4">Sin registros.</td>
                                </tr>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/Modules/Lavado/Resources/views/prelavado/historial.blade.php ENDPATH**/ ?>