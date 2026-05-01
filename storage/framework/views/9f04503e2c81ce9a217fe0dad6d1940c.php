<?php $__env->startSection('title', 'Detalle Descarga Lavado'); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>">Home</a></li>
        <li class="breadcrumb-item"><a href="<?php echo e(route('descarga-lavado.index')); ?>">Descarga Lavado</a></li>
        <li class="breadcrumb-item active"><?php echo e($descargaLavado->reference); ?></li>
    </ol>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid mb-4">

        
        <div class="d-flex align-items-center justify-content-between mb-4">
            <div class="d-flex align-items-center">
                <div class="rounded-circle d-flex align-items-center justify-content-center mr-3"
                    style="width:48px;height:48px;background:linear-gradient(135deg,#0ea5e9,#0284c7);">
                    <i class="bi bi-droplet-half text-white" style="font-size:1.3rem;"></i>
                </div>
                <div>
                    <h4 class="mb-0 font-weight-bold text-dark">Descarga #<?php echo e($descargaLavado->reference); ?></h4>
                    <small class="text-muted">
                        <?php echo e(\Carbon\Carbon::parse($descargaLavado->created_at)->format('d M, Y H:i')); ?>

                        &nbsp;&bull;&nbsp;
                        Lavado: <strong><?php echo e(optional($descargaLavado->lavado)->reference ?? '-'); ?></strong>
                        &nbsp;&bull;&nbsp;
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($descargaLavado->status === 'Registrado'): ?>
                            <span class="badge badge-success" style="font-size:.75rem;padding:4px 10px;border-radius:20px;">
                                <i class="bi bi-check-circle mr-1"></i> Registrado
                            </span>
                        <?php else: ?>
                            <span class="badge badge-warning" style="font-size:.75rem;padding:4px 10px;border-radius:20px;">
                                <i class="bi bi-clock mr-1"></i> <?php echo e($descargaLavado->status); ?>

                            </span>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </small>
                </div>
            </div>
            <div class="d-flex" style="gap:10px;">
                <a href="<?php echo e(route('descarga-lavado.index')); ?>"
                    class="btn btn-outline-secondary d-flex align-items-center"
                    style="border-radius:8px;padding:9px 18px;font-weight:600;">
                    <i class="bi bi-arrow-left mr-2"></i> Volver
                </a>
            </div>
        </div>

        
        <div class="row mb-4">

            
            <div class="col-md-4 mb-3">
                <div class="card border-0 h-100" style="border-radius:12px;box-shadow:0 2px 20px rgba(0,0,0,0.08);">
                    <div class="card-header border-0 d-flex align-items-center"
                        style="background:linear-gradient(135deg,#f8fafc,#f1f5f9);border-radius:12px 12px 0 0;padding:14px 20px;border-left:4px solid #0ea5e9;">
                        <i class="bi bi-gear mr-2" style="color:#0ea5e9;"></i>
                        <span class="font-weight-bold text-secondary" style="font-size:.8rem;letter-spacing:.5px;text-transform:uppercase;">Proceso</span>
                    </div>
                    <div class="card-body" style="padding:20px;">
                        <?php
                            $statusCiclo = $descargaLavado->status_ciclo ?? 'Pendiente';
                            $cicloBadge = match($statusCiclo) {
                                'Ciclo Correcto' => ['badge-success', 'bi-check-circle'],
                                'Ciclo con Falla' => ['badge-danger', 'bi-x-circle'],
                                'Cargar' => ['badge-info', 'bi-arrow-repeat'],
                                default => ['badge-secondary', 'bi-clock'],
                            };
                            $items = [
                                ['icon' => 'bi-cpu',              'label' => 'Equipo',          'value' => $descargaLavado->equipo ?? '-'],
                                ['icon' => 'bi-hash',             'label' => 'Lote',            'value' => $descargaLavado->lote ?? '-'],
                                ['icon' => 'bi-list-check',       'label' => 'Programa',        'value' => $descargaLavado->programa_lavado ?? '-'],
                                ['icon' => 'bi-thermometer-half', 'label' => 'Temperatura',     'value' => ($descargaLavado->temperatura ?? '-') . ' °C'],
                                ['icon' => 'bi-person-badge',     'label' => 'Operador',        'value' => $descargaLavado->operator],
                            ];
                        ?>
                        <div class="mb-2" style="font-size:.82rem;">
                            <span class="badge <?php echo e($cicloBadge[0]); ?>"
                                style="font-size:.78rem;padding:5px 12px;border-radius:20px;">
                                <i class="bi <?php echo e($cicloBadge[1]); ?> mr-1"></i>
                                <?php echo e($statusCiclo); ?>

                            </span>
                        </div>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="d-flex justify-content-between align-items-center mb-2" style="font-size:.82rem;">
                                <span class="text-muted">
                                    <i class="bi <?php echo e($item['icon']); ?> mr-1"></i> <?php echo e($item['label']); ?>

                                </span>
                                <span class="font-weight-semibold text-dark"><?php echo e($item['value']); ?></span>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>
                </div>
            </div>

            
            <div class="col-md-4 mb-3">
                <div class="card border-0 h-100" style="border-radius:12px;box-shadow:0 2px 20px rgba(0,0,0,0.08);">
                    <div class="card-header border-0 d-flex align-items-center"
                        style="background:linear-gradient(135deg,#f8fafc,#f1f5f9);border-radius:12px 12px 0 0;padding:14px 20px;border-left:4px solid #f97316;">
                        <i class="bi bi-droplet mr-2" style="color:#f97316;"></i>
                        <span class="font-weight-bold text-secondary" style="font-size:.8rem;letter-spacing:.5px;text-transform:uppercase;">Lavado Origen</span>
                    </div>
                    <div class="card-body" style="padding:20px;">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($descargaLavado->lavado): ?>
                            <p class="font-weight-bold text-dark mb-2" style="font-size:.95rem;">
                                <?php echo e($descargaLavado->lavado->reference); ?>

                            </p>
                            <div class="d-flex justify-content-between mb-2" style="font-size:.82rem;">
                                <span class="text-muted"><i class="bi bi-hash mr-1"></i> Lote</span>
                                <span class="font-weight-semibold"><?php echo e($descargaLavado->lavado->lote ?? '-'); ?></span>
                            </div>
                            <div class="d-flex justify-content-between mb-2" style="font-size:.82rem;">
                                <span class="text-muted"><i class="bi bi-cpu mr-1"></i> Equipo</span>
                                <span class="font-weight-semibold"><?php echo e($descargaLavado->lavado->equipo ?? '-'); ?></span>
                            </div>
                            <a href="<?php echo e(route('lavados.show', $descargaLavado->lavado->id)); ?>"
                                class="btn btn-sm btn-outline-warning mt-2"
                                style="border-radius:6px;font-size:.8rem;">
                                <i class="bi bi-box-arrow-up-right mr-1"></i> Ver Lavado
                            </a>
                        <?php else: ?>
                            <span class="text-muted" style="font-size:.85rem;">Sin lavado vinculado</span>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>
                </div>
            </div>

            
            <div class="col-md-4 mb-3">
                <div class="card border-0 h-100" style="border-radius:12px;box-shadow:0 2px 20px rgba(0,0,0,0.08);">
                    <div class="card-header border-0 d-flex align-items-center"
                        style="background:linear-gradient(135deg,#f8fafc,#f1f5f9);border-radius:12px 12px 0 0;padding:14px 20px;border-left:4px solid #94a3b8;">
                        <i class="bi bi-chat-text mr-2 text-secondary"></i>
                        <span class="font-weight-bold text-secondary" style="font-size:.8rem;letter-spacing:.5px;text-transform:uppercase;">Nota</span>
                    </div>
                    <div class="card-body" style="padding:20px;">
                        <p style="font-size:.85rem;color:#475569;line-height:1.6;">
                            <?php echo e($descargaLavado->note ?? 'Sin observaciones.'); ?>

                        </p>
                    </div>
                </div>
            </div>

        </div>

        
        <div class="card border-0" style="border-radius:12px;box-shadow:0 2px 20px rgba(0,0,0,0.08);">
            <div class="card-header border-0 d-flex align-items-center justify-content-between"
                style="background:linear-gradient(135deg,#f8fafc,#f1f5f9);border-radius:12px 12px 0 0;padding:14px 24px;border-left:4px solid #0ea5e9;">
                <div class="d-flex align-items-center">
                    <i class="bi bi-list-ul text-info mr-2"></i>
                    <span class="font-weight-bold text-secondary" style="font-size:.85rem;letter-spacing:.5px;text-transform:uppercase;">
                        Instrumental Descargado
                    </span>
                </div>
                <span class="badge badge-info" style="font-size:.8rem;">
                    <?php echo e($descargaLavado->descargaLavadoDetalles->count()); ?> ítem(s)
                </span>
            </div>
            <div class="card-body" style="padding:24px;">
                <div class="table-responsive">
                    <table class="table table-hover table-sm mb-0">
                        <thead style="background:#f8fafc;">
                            <tr>
                                <th style="font-size:.8rem;font-weight:700;color:#64748b;">#</th>
                                <th style="font-size:.8rem;font-weight:700;color:#64748b;">Código</th>
                                <th style="font-size:.8rem;font-weight:700;color:#64748b;">Nombre</th>
                                <th style="font-size:.8rem;font-weight:700;color:#64748b;" class="text-center">Cantidad</th>
                                <th style="font-size:.8rem;font-weight:700;color:#64748b;">Paciente</th>
                                <th style="font-size:.8rem;font-weight:700;color:#64748b;">Info</th>
                                <th style="font-size:.8rem;font-weight:700;color:#64748b;">Empresa Ext.</th>
                                <th style="font-size:.8rem;font-weight:700;color:#64748b;">Área</th>
                                <th style="font-size:.8rem;font-weight:700;color:#64748b;">Proceso</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $descargaLavado->descargaLavadoDetalles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $det): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr>
                                    <td style="font-size:.82rem;color:#94a3b8;"><?php echo e($index + 1); ?></td>
                                    <td style="font-size:.85rem;">
                                        <span class="badge badge-light border"><?php echo e($det->product_code); ?></span>
                                    </td>
                                    <td style="font-size:.85rem;font-weight:500;"><?php echo e($det->product_name); ?></td>
                                    <td style="font-size:.85rem;" class="text-center">
                                        <span class="badge badge-secondary"><?php echo e($det->product_quantity); ?></span>
                                    </td>
                                    <td style="font-size:.85rem;"><?php echo e($det->product_patient ?? '-'); ?></td>
                                    <td style="font-size:.85rem;"><?php echo e($det->product_info ?? '-'); ?></td>
                                    <td style="font-size:.85rem;"><?php echo e($det->product_outside_company ?? '-'); ?></td>
                                    <td style="font-size:.85rem;"><?php echo e($det->product_area ?? '-'); ?></td>
                                    <td style="font-size:.85rem;"><?php echo e($det->product_type_process ?? '-'); ?></td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td colspan="9" class="text-center text-muted py-4" style="font-size:.85rem;">
                                        Sin ítems registrados
                                    </td>
                                </tr>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/Modules/Lavado/Resources/views/descarga-lavado/show.blade.php ENDPATH**/ ?>