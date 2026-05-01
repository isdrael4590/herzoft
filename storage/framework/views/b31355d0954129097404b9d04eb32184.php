<?php $__env->startSection('title', 'Instrumental a Lavar'); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>">Home</a></li>
        <li class="breadcrumb-item active">Instrumental a Lavar</li>
    </ol>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card border-0" style="border-radius:12px;box-shadow:0 2px 20px rgba(0,0,0,0.08);">
                    <div class="card-header border-0 d-flex align-items-center justify-content-between"
                        style="background:linear-gradient(135deg,#f8fafc,#f1f5f9);border-radius:12px 12px 0 0;padding:14px 24px;border-left:4px solid #0ea5e9;">
                        <div class="d-flex align-items-center">
                            <i class="bi bi-droplet-half text-info mr-2"></i>
                            <span class="font-weight-bold text-secondary"
                                style="font-size:.85rem;letter-spacing:.5px;text-transform:uppercase;">
                                Instrumental pendiente de prelavado
                            </span>
                        </div>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create_wash_area')): ?>
                            <a href="<?php echo e(route('lavados.create')); ?>" class="btn btn-primary btn-sm"
                                style="border-radius:8px;font-weight:600;">
                                <i class="bi bi-plus mr-1"></i> Registrar Lavado
                            </a>
                        <?php endif; ?>
                    </div>
                    <div class="card-body" style="padding:24px;">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0" id="prelavado-table">
                                <thead style="background:#f8fafc;">
                                    <tr>
                                        <th style="font-size:.8rem;font-weight:700;color:#64748b;">Nombre del Producto</th>
                                        <th class="text-center" style="font-size:.8rem;font-weight:700;color:#64748b;">Código del Producto</th>
                                        <th class="text-center" style="font-size:.8rem;font-weight:700;color:#64748b;">Cantidad Total</th>
                                        <th class="text-center" style="font-size:.8rem;font-weight:700;color:#64748b;">Historial</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $prelavados; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($item->total_quantity == 0 && !auth()->user()->hasAnyRole(['Admin', 'Super Admin', 'supervisor'])): ?>
                                            <?php continue; ?>
                                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                        <tr>
                                            <td class="align-middle" style="font-size:.875rem;"><?php echo e($item->product_name); ?></td>
                                            <td class="align-middle text-center">
                                                <span class="badge badge-info" style="font-size:.8rem;padding:5px 10px;">
                                                    <?php echo e($item->product_code); ?>

                                                </span>
                                            </td>
                                            <td class="align-middle text-center">
                                                <span style="font-weight:700;font-size:.95rem;color:#0f172a;">
                                                    <?php echo e($item->total_quantity); ?>

                                                </span>
                                            </td>
                                            <td class="align-middle text-center">
                                                <a href="<?php echo e(route('prelavado.historial', urlencode($item->product_code))); ?>"
                                                    class="btn btn-sm btn-outline-primary"
                                                    style="border-radius:6px;font-size:.8rem;font-weight:600;">
                                                    <i class="bi bi-clock-history mr-1"></i> Ver Historial
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                        <tr>
                                            <td colspan="4" class="text-center text-muted py-4">
                                                No hay instrumental pendiente de prelavado.
                                            </td>
                                        </tr>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('page_scripts'); ?>
    <script>
        $(document).ready(function () {
            $('#prelavado-table').DataTable({
                order: [[2, 'desc']],
                language: { url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json' }
            });
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/Modules/Lavado/Resources/views/prelavado/index.blade.php ENDPATH**/ ?>