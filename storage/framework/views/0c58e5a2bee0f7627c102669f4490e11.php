<?php $__env->startSection('title', 'Detalle Lavado'); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>">Home</a></li>
        <li class="breadcrumb-item"><a href="<?php echo e(route('lavados.index')); ?>">Lavados</a></li>
        <li class="breadcrumb-item active">Detalles</li>
    </ol>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid mb-4">

        
        <div class="d-flex align-items-center justify-content-between mb-4">
            <div class="d-flex align-items-center">
                <div class="rounded-circle d-flex align-items-center justify-content-center mr-3"
                    style="width:48px;height:48px;background:linear-gradient(135deg,#f97316,#ea580c);">
                    <i class="bi bi-droplet text-white" style="font-size:1.3rem;"></i>
                </div>
                <div>
                    <h4 class="mb-0 font-weight-bold text-dark">Lavado #<?php echo e($lavado->reference); ?></h4>
                    <small class="text-muted">
                        <?php echo e(\Carbon\Carbon::parse($lavado->created_at)->format('d M, Y H:i')); ?>

                        &nbsp;&bull;&nbsp;
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($lavado->status === 'Lavado'): ?>
                            <span class="badge badge-success" style="font-size:.75rem;padding:4px 10px;border-radius:20px;">
                                <i class="bi bi-check-circle mr-1"></i> Lavado
                            </span>
                        <?php elseif($lavado->status === 'Observado'): ?>
                            <span class="badge badge-warning" style="font-size:.75rem;padding:4px 10px;border-radius:20px;">
                                <i class="bi bi-exclamation-circle mr-1"></i> Observado
                            </span>
                        <?php elseif($lavado->status === 'Procesado'): ?>
                            <span class="badge badge-info" style="font-size:.75rem;padding:4px 10px;border-radius:20px;">
                                <i class="bi bi-arrow-right-circle mr-1"></i> Procesado
                            </span>
                        <?php else: ?>
                            <span class="badge badge-secondary" style="font-size:.75rem;padding:4px 10px;border-radius:20px;">
                                <i class="bi bi-clock mr-1"></i> <?php echo e($lavado->status); ?>

                            </span>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </small>
                </div>
            </div>
            <div class="d-flex" style="gap:10px;">
                <a href="<?php echo e(route('lavados.index')); ?>"
                    class="btn btn-outline-secondary d-flex align-items-center"
                    style="border-radius:8px;padding:9px 18px;font-weight:600;">
                    <i class="bi bi-arrow-left mr-2"></i> Volver
                </a>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($lavado->status !== 'Procesado'): ?>
                    <a href="<?php echo e(route('lavado-descarga.create', $lavado)); ?>"
                        class="btn d-flex align-items-center text-white"
                        style="border-radius:8px;padding:9px 18px;font-weight:600;background:linear-gradient(135deg,#0ea5e9,#0284c7);border:none;box-shadow:0 4px 12px rgba(14,165,233,0.35);">
                        <i class="bi bi-droplet-half mr-2"></i> Enviar a Descarga
                    </a>
                    <a href="<?php echo e(route('lavado-preparations.create', $lavado)); ?>"
                        class="btn d-flex align-items-center text-white"
                        style="border-radius:8px;padding:9px 18px;font-weight:600;background:linear-gradient(135deg,#f97316,#ea580c);border:none;box-shadow:0 4px 12px rgba(249,115,22,0.35);">
                        <i class="bi bi-box-arrow-in-right mr-2"></i> Enviar a Preparación
                    </a>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
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
                        <p class="font-weight-bold text-dark mb-1" style="font-size:.95rem;"><?php echo e(institutes()->institute_name); ?></p>
                        <p class="text-muted mb-1" style="font-size:.82rem;">
                            <i class="bi bi-upc mr-1"></i> <?php echo e(institutes()->institute_code); ?>

                        </p>
                        <p class="text-muted mb-1" style="font-size:.82rem;">
                            <i class="bi bi-diagram-3 mr-1"></i> <?php echo e(institutes()->institute_area); ?>

                        </p>
                        <p class="text-muted mb-1" style="font-size:.82rem;">
                            <i class="bi bi-geo-alt mr-1"></i> <?php echo e(institutes()->institute_address); ?>

                        </p>
                        <p class="text-muted mb-0" style="font-size:.82rem;">
                            <i class="bi bi-globe mr-1"></i> <?php echo e(institutes()->institute_city); ?>, <?php echo e(institutes()->institute_country); ?>

                        </p>
                    </div>
                </div>
            </div>

            
            <div class="col-md-3 mb-3">
                <div class="card border-0 h-100" style="border-radius:12px;box-shadow:0 2px 20px rgba(0,0,0,0.08);">
                    <div class="card-header border-0 d-flex align-items-center"
                        style="background:linear-gradient(135deg,#f8fafc,#f1f5f9);border-radius:12px 12px 0 0;padding:14px 20px;border-left:4px solid #f97316;">
                        <i class="bi bi-gear mr-2" style="color:#f97316;"></i>
                        <span class="font-weight-bold text-secondary" style="font-size:.8rem;letter-spacing:.5px;text-transform:uppercase;">Información del Proceso</span>
                    </div>
                    <div class="card-body" style="padding:20px;">
                        <?php
                            $items = [
                                ['icon' => 'bi-cpu',            'label' => 'Equipo',          'value' => $lavado->equipo ?? '-'],
                                ['icon' => 'bi-box-seam',       'label' => 'Lote',            'value' => $lavado->lote ?? '-'],
                                ['icon' => 'bi-sliders',        'label' => 'Programa',        'value' => $lavado->programa_lavado ?? '-'],
                                ['icon' => 'bi-thermometer',    'label' => 'Temperatura',     'value' => $lavado->temperatura ? $lavado->temperatura . ' °C' : '-'],
                                ['icon' => 'bi-person-badge',   'label' => 'Operador',        'value' => $lavado->operator],
                            ];
                        ?>
                        <?php
                            $statusCiclo = $lavado->status_ciclo ?? 'Pendiente';
                            $cicloBadge = match($statusCiclo) {
                                'Ciclo Correcto' => ['badge-success', 'bi-check-circle'],
                                'Ciclo con Falla' => ['badge-danger', 'bi-x-circle'],
                                'En Proceso' => ['badge-info', 'bi-arrow-repeat'],
                                default => ['badge-secondary', 'bi-clock'],
                            };
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
                                    <i class="bi <?php echo e($item['icon']); ?> mr-1" style="color:#f97316;"></i><?php echo e($item['label']); ?>

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
                        <?php
                            $registros = [
                                ['icon' => 'bi-hash',          'label' => 'Número',        'value' => $lavado->reference],
                                ['icon' => 'bi-calendar-check','label' => 'Fecha Lavado',  'value' => \Carbon\Carbon::parse($lavado->created_at)->format('d M, Y')],
                                ['icon' => 'bi-layers',        'label' => 'Total Ítems',   'value' => $lavado->lavadoDetalles->count() . ' ' . ($lavado->lavadoDetalles->count() === 1 ? 'ítem' : 'ítems')],
                            ];
                        ?>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $registros; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $reg): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="d-flex align-items-start mb-3">
                                <div class="rounded mr-3 d-flex align-items-center justify-content-center flex-shrink-0"
                                    style="width:34px;height:34px;background:rgba(16,185,129,0.1);">
                                    <i class="bi <?php echo e($reg['icon']); ?> text-success" style="font-size:.9rem;"></i>
                                </div>
                                <div>
                                    <p class="text-muted mb-0" style="font-size:.75rem;text-transform:uppercase;letter-spacing:.4px;"><?php echo e($reg['label']); ?></p>
                                    <p class="mb-0 font-weight-semibold text-dark" style="font-size:.875rem;"><?php echo e($reg['value']); ?></p>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($lavado->note): ?>
                            <div class="d-flex align-items-start">
                                <div class="rounded mr-3 d-flex align-items-center justify-content-center flex-shrink-0"
                                    style="width:34px;height:34px;background:rgba(16,185,129,0.1);">
                                    <i class="bi bi-chat-left-text text-success" style="font-size:.9rem;"></i>
                                </div>
                                <div>
                                    <p class="text-muted mb-0" style="font-size:.75rem;text-transform:uppercase;letter-spacing:.4px;">Nota</p>
                                    <p class="mb-0 text-dark" style="font-size:.82rem;font-style:italic;"><?php echo e($lavado->note); ?></p>
                                </div>
                            </div>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>
                </div>
            </div>

            
            <div class="col-md-3 mb-3">
                <div class="card border-0 h-100" style="border-radius:12px;box-shadow:0 2px 20px rgba(0,0,0,0.08);">
                    <div class="card-header border-0 d-flex align-items-center"
                        style="background:linear-gradient(135deg,#f8fafc,#f1f5f9);border-radius:12px 12px 0 0;padding:14px 20px;border-left:4px solid #f59e0b;">
                        <i class="bi bi-qr-code mr-2" style="color:#f59e0b;"></i>
                        <span class="font-weight-bold text-secondary" style="font-size:.8rem;letter-spacing:.5px;text-transform:uppercase;">QR del Lavado</span>
                    </div>
                    <div class="card-body d-flex flex-column align-items-center justify-content-center" style="padding:20px;">
                        <div class="mb-3">
                            <?php echo QrCode::size(130)->style('square')->generate(
                                'Ref: ' . $lavado->reference .
                                ' // Equipo: ' . ($lavado->equipo ?? '-') .
                                ' // Lote: ' . ($lavado->lote ?? '-') .
                                ' // Fecha: ' . $lavado->created_at
                            ); ?>

                        </div>
                        <p class="text-muted mb-1 text-center" style="font-size:.8rem;">
                            <strong><?php echo e($lavado->reference); ?></strong>
                        </p>
                        <p class="text-muted mb-0 text-center" style="font-size:.75rem;">
                            <?php echo e(\Carbon\Carbon::parse($lavado->created_at)->format('d M, Y')); ?>

                        </p>
                    </div>
                </div>
            </div>

        </div>

        
        <div class="card border-0" style="border-radius:12px;box-shadow:0 2px 20px rgba(0,0,0,0.08);">
            <div class="card-header border-0 d-flex align-items-center justify-content-between"
                style="background:linear-gradient(135deg,#f8fafc,#f1f5f9);border-radius:12px 12px 0 0;padding:16px 24px;">
                <div class="d-flex align-items-center">
                    <i class="bi bi-list-ul mr-2" style="font-size:1.1rem;color:#f97316;"></i>
                    <span class="font-weight-semibold text-secondary" style="font-size:.9rem;letter-spacing:.3px;">INSTRUMENTAL LAVADO</span>
                </div>
                <span class="badge" style="font-size:.75rem;padding:5px 12px;border-radius:20px;background:rgba(249,115,22,0.12);color:#ea580c;">
                    <?php echo e($lavado->lavadoDetalles->count()); ?> <?php echo e($lavado->lavadoDetalles->count() === 1 ? 'ítem' : 'ítems'); ?>

                </span>
            </div>
            <div class="card-body" style="padding:0;">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead style="background:#f8fafc;">
                            <tr>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = ['Instrumental', 'Código', 'Cantidad', 'Paciente', 'Área', 'Tipo Proceso']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $col): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <th class="align-middle border-0"
                                        style="font-size:.75rem;text-transform:uppercase;letter-spacing:.5px;color:#64748b;font-weight:600;padding:14px 12px;white-space:nowrap;">
                                        <?php echo e($col); ?>

                                    </th>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $lavado->lavadoDetalles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $detalle): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr style="border-color:#f1f5f9;">
                                    <td class="align-middle" style="padding:14px 12px;">
                                        <span class="font-weight-semibold text-dark" style="font-size:.875rem;"><?php echo e($detalle->product_name); ?></span>
                                    </td>
                                    <td class="align-middle" style="padding:14px 12px;">
                                        <span class="badge badge-warning" style="font-size:.75rem;padding:4px 10px;border-radius:20px;">
                                            <?php echo e($detalle->product_code); ?>

                                        </span>
                                    </td>
                                    <td class="align-middle text-center" style="padding:14px 12px;">
                                        <span class="font-weight-semibold"><?php echo e($detalle->product_quantity); ?></span>
                                    </td>
                                    <td class="align-middle" style="padding:14px 12px;font-size:.85rem;">
                                        <?php echo e($detalle->product_patient ?? '—'); ?>

                                    </td>
                                    <td class="align-middle" style="padding:14px 12px;font-size:.85rem;">
                                        <?php echo e($detalle->product_area ?? '—'); ?>

                                    </td>
                                    <td class="align-middle" style="padding:14px 12px;font-size:.85rem;color:#64748b;">
                                        <?php echo e($detalle->product_type_process ?? '—'); ?>

                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td colspan="6" class="text-center text-muted" style="padding:32px;">
                                        <i class="bi bi-inbox" style="font-size:1.5rem;display:block;margin-bottom:8px;"></i>
                                        Sin detalles registrados.
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

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/Modules/Lavado/Resources/views/lavados/show.blade.php ENDPATH**/ ?>