<?php $__env->startSection('title', 'Detalles Ciclo Procesado'); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>">Home</a></li>
        <li class="breadcrumb-item"><a href="<?php echo e(route('discharges.index')); ?>">Descarga de Ciclos</a></li>
        <li class="breadcrumb-item active">Detalles</li>
    </ol>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid mb-4">

        
        <div class="d-flex align-items-center justify-content-between mb-4">
            <div class="d-flex align-items-center">
                <div class="rounded-circle d-flex align-items-center justify-content-center mr-3"
                    style="width:48px;height:48px;background:linear-gradient(135deg,#8b5cf6,#7c3aed);">
                    <i class="bi bi-eye text-white" style="font-size:1.3rem;"></i>
                </div>
                <div>
                    <h4 class="mb-0 font-weight-bold text-dark">Ciclo #<?php echo e($discharge->reference); ?></h4>
                    <small class="text-muted">
                        <?php echo e(\Carbon\Carbon::parse($discharge->updated_at)->format('d M, Y H:i')); ?>

                        &nbsp;&bull;&nbsp;
                        <?php if($discharge->status_cycle == 'Ciclo Aprobado'): ?>
                            <span class="badge badge-success" style="font-size:.75rem;padding:4px 10px;border-radius:20px;">
                                <i class="bi bi-check-circle mr-1"></i> Ciclo Aprobado
                            </span>
                        <?php elseif($discharge->status_cycle == 'Ciclo Falla'): ?>
                            <span class="badge badge-danger" style="font-size:.75rem;padding:4px 10px;border-radius:20px;">
                                <i class="bi bi-x-circle mr-1"></i> Ciclo Falla
                            </span>
                        <?php elseif($discharge->status_cycle == 'En Curso'): ?>
                            <span class="badge badge-primary" style="font-size:.75rem;padding:4px 10px;border-radius:20px;">
                                <i class="bi bi-arrow-repeat mr-1"></i> En Curso
                            </span>
                        <?php else: ?>
                            <span class="badge badge-dark" style="font-size:.75rem;padding:4px 10px;border-radius:20px;">
                                <i class="bi bi-clock mr-1"></i> <?php echo e($discharge->status_cycle); ?>

                            </span>
                        <?php endif; ?>
                    </small>
                </div>
            </div>
            <div class="d-flex" style="gap:10px;">
                <a href="<?php echo e(route('discharges.index')); ?>"
                    class="btn btn-outline-secondary d-flex align-items-center"
                    style="border-radius:8px;padding:9px 18px;font-weight:600;">
                    <i class="bi bi-arrow-left mr-2"></i> Volver
                </a>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('print_discharges')): ?>
                    <a target="_blank" href="<?php echo e(route('discharges.pdf', $discharge->id)); ?>"
                        class="btn btn-outline-secondary d-flex align-items-center d-print-none"
                        style="border-radius:8px;padding:9px 18px;font-weight:600;">
                        <i class="bi bi-printer mr-2"></i> Imprimir
                    </a>
                    <a target="_blank" href="<?php echo e(route('discharges.pdf', $discharge->id)); ?>"
                        class="btn d-flex align-items-center text-white d-print-none"
                        style="border-radius:8px;padding:9px 18px;font-weight:600;background:linear-gradient(135deg,#8b5cf6,#7c3aed);border:none;box-shadow:0 4px 12px rgba(139,92,246,0.35);">
                        <i class="bi bi-file-earmark-pdf mr-2"></i> Guardar PDF
                    </a>
                <?php endif; ?>
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
                        style="background:linear-gradient(135deg,#f8fafc,#f1f5f9);border-radius:12px 12px 0 0;padding:14px 20px;border-left:4px solid #8b5cf6;">
                        <i class="bi bi-gear mr-2" style="color:#8b5cf6;"></i>
                        <span class="font-weight-bold text-secondary" style="font-size:.8rem;letter-spacing:.5px;text-transform:uppercase;">Información del Proceso</span>
                    </div>
                    <div class="card-body" style="padding:20px;">
                        <?php
                            $items = [
                                ['icon' => 'bi-tag',           'label' => 'Ref. Proceso',            'value' => $labelqr->reference],
                                ['icon' => 'bi-cpu',           'label' => 'Equipo',                  'value' => $discharge->machine_name],
                                ['icon' => 'bi-box-seam',      'label' => 'Lote del Equipo',          'value' => $discharge->lote_machine],
                                ['icon' => 'bi-droplet',       'label' => 'Lote Agente Esteril.',    'value' => $discharge->lote_agente],
                                ['icon' => 'bi-thermometer',   'label' => 'Temp. Equipo',            'value' => $discharge->temp_machine],
                                ['icon' => 'bi-sliders',       'label' => 'Tipo de Programa',        'value' => $discharge->type_program],
                                ['icon' => 'bi-thermometer-half', 'label' => 'Temp. Ambiente',       'value' => $discharge->temp_ambiente],
                            ];
                        ?>
                        <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="d-flex justify-content-between align-items-center mb-2" style="font-size:.82rem;">
                                <span class="text-muted">
                                    <i class="bi <?php echo e($item['icon']); ?> mr-1" style="color:#8b5cf6;"></i><?php echo e($item['label']); ?>

                                </span>
                                <span class="font-weight-semibold text-dark"><?php echo e($item['value']); ?></span>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
                                <p class="mb-0 font-weight-bold text-dark" style="font-size:.95rem;"><?php echo e($discharge->reference); ?></p>
                            </div>
                        </div>
                        <div class="d-flex align-items-start mb-3">
                            <div class="rounded mr-3 d-flex align-items-center justify-content-center flex-shrink-0"
                                style="width:34px;height:34px;background:rgba(16,185,129,0.1);">
                                <i class="bi bi-virus text-success" style="font-size:.9rem;"></i>
                            </div>
                            <div>
                                <p class="text-muted mb-0" style="font-size:.75rem;text-transform:uppercase;letter-spacing:.4px;">Lote Biológico</p>
                                <p class="mb-0 font-weight-semibold text-dark" style="font-size:.875rem;"><?php echo e($discharge->lote_biologic); ?></p>
                            </div>
                        </div>
                        <div class="d-flex align-items-start mb-3">
                            <div class="rounded mr-3 d-flex align-items-center justify-content-center flex-shrink-0"
                                style="width:34px;height:34px;background:rgba(16,185,129,0.1);">
                                <i class="bi bi-check2-all text-success" style="font-size:.9rem;"></i>
                            </div>
                            <div>
                                <p class="text-muted mb-0" style="font-size:.75rem;text-transform:uppercase;letter-spacing:.4px;">Validación Biológica</p>
                                <p class="mb-0 font-weight-semibold text-dark" style="font-size:.875rem;"><?php echo e($discharge->validation_biologic); ?></p>
                            </div>
                        </div>
                        <div class="d-flex align-items-start mb-3">
                            <div class="rounded mr-3 d-flex align-items-center justify-content-center flex-shrink-0"
                                style="width:34px;height:34px;background:rgba(16,185,129,0.1);">
                                <i class="bi bi-person-badge text-success" style="font-size:.9rem;"></i>
                            </div>
                            <div>
                                <p class="text-muted mb-0" style="font-size:.75rem;text-transform:uppercase;letter-spacing:.4px;">
                                    <?php echo e($discharge->operator == $discharge->operator_discharge ? 'Operario Carga/Descarga' : 'Operario Carga'); ?>

                                </p>
                                <p class="mb-0 font-weight-semibold text-dark" style="font-size:.875rem;"><?php echo e($discharge->operator); ?></p>
                            </div>
                        </div>
                        <?php if($discharge->operator != $discharge->operator_discharge): ?>
                            <div class="d-flex align-items-start">
                                <div class="rounded mr-3 d-flex align-items-center justify-content-center flex-shrink-0"
                                    style="width:34px;height:34px;background:rgba(16,185,129,0.1);">
                                    <i class="bi bi-person-check text-success" style="font-size:.9rem;"></i>
                                </div>
                                <div>
                                    <p class="text-muted mb-0" style="font-size:.75rem;text-transform:uppercase;letter-spacing:.4px;">Operario Descarga</p>
                                    <p class="mb-0 font-weight-semibold text-dark" style="font-size:.875rem;"><?php echo e($discharge->operator_discharge); ?></p>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            
            <div class="col-md-3 mb-3">
                <div class="card border-0 h-100" style="border-radius:12px;box-shadow:0 2px 20px rgba(0,0,0,0.08);">
                    <div class="card-header border-0 d-flex align-items-center"
                        style="background:linear-gradient(135deg,#f8fafc,#f1f5f9);border-radius:12px 12px 0 0;padding:14px 20px;border-left:4px solid #f59e0b;">
                        <i class="bi bi-qr-code mr-2" style="color:#f59e0b;"></i>
                        <span class="font-weight-bold text-secondary" style="font-size:.8rem;letter-spacing:.5px;text-transform:uppercase;">QR del Proceso</span>
                    </div>
                    <div class="card-body d-flex flex-column align-items-center justify-content-center" style="padding:20px;">
                        <div class="mb-3">
                            <?php echo QrCode::size(130)->style('square')->generate(
                                'Ref. Proceso: ' . $discharge->labelqr_id .
                                ' // Ref. Des: ' . $discharge->reference .
                                ' // Equipo: ' . $discharge->machine_name .
                                ' // Lote: ' . $discharge->lote_machine .
                                ' // Fecha: ' . $discharge->updated_at
                            ); ?>

                        </div>
                        <p class="text-muted mb-1 text-center" style="font-size:.8rem;">
                            <strong><?php echo e($discharge->reference); ?></strong>
                        </p>
                        <p class="text-muted mb-0 text-center" style="font-size:.75rem;">
                            <?php echo e(\Carbon\Carbon::parse($discharge->updated_at)->format('d M, Y')); ?>

                        </p>
                    </div>
                </div>
            </div>

        </div>

        
        <div class="card border-0" style="border-radius:12px;box-shadow:0 2px 20px rgba(0,0,0,0.08);">
            <div class="card-header border-0 d-flex align-items-center justify-content-between"
                style="background:linear-gradient(135deg,#f8fafc,#f1f5f9);border-radius:12px 12px 0 0;padding:16px 24px;">
                <div class="d-flex align-items-center">
                    <i class="bi bi-list-ul mr-2" style="font-size:1.1rem;color:#8b5cf6;"></i>
                    <span class="font-weight-semibold text-secondary" style="font-size:.9rem;letter-spacing:.3px;">INSTRUMENTAL PROCESADO</span>
                </div>
                <span class="badge" style="font-size:.75rem;padding:5px 12px;border-radius:20px;background:rgba(139,92,246,0.12);color:#7c3aed;">
                    <?php echo e($discharge->dischargeDetails->count()); ?> <?php echo e($discharge->dischargeDetails->count() === 1 ? 'ítem' : 'ítems'); ?>

                </span>
            </div>
            <div class="card-body" style="padding:0;">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead style="background:#f8fafc;">
                            <tr>
                                <?php $__currentLoopData = [
                                    'Instrumental', 'Código', 'Cant. Procesada', 'Cant. Validada',
                                    'Envoltura', 'Valid. Embalaje', 'Ind. Químico',
                                    'Vencimiento', 'Paciente / Casa Com.', 'QR Paquete'
                                ]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $col): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <th class="align-middle border-0"
                                        style="font-size:.75rem;text-transform:uppercase;letter-spacing:.5px;color:#64748b;font-weight:600;padding:14px 12px;white-space:nowrap;">
                                        <?php echo e($col); ?>

                                    </th>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $discharge->dischargeDetails; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr style="border-color:#f1f5f9;">
                                    <td class="align-middle" style="padding:14px 12px;">
                                        <span class="font-weight-semibold text-dark" style="font-size:.875rem;"><?php echo e($item->product_name); ?></span>
                                    </td>
                                    <td class="align-middle" style="padding:14px 12px;">
                                        <span class="badge badge-primary" style="font-size:.75rem;padding:4px 10px;border-radius:20px;">
                                            <?php echo e($item->product_code); ?>

                                        </span>
                                    </td>
                                    <td class="align-middle text-center" style="padding:14px 12px;">
                                        <span class="font-weight-semibold"><?php echo e($item->product_quantity); ?></span>
                                    </td>
                                    <td class="align-middle text-center" style="padding:14px 12px;">
                                        <span class="font-weight-semibold"><?php echo e($item->product_quantity); ?></span>
                                    </td>
                                    <td class="align-middle" style="padding:14px 12px;font-size:.85rem;">
                                        <?php echo e($item->product_package_wrap); ?>

                                    </td>
                                    <td class="align-middle text-center" style="padding:14px 12px;">
                                        <?php if($item->product_eval_package == 'Correcto' || $item->product_eval_package == 'Aprobado'): ?>
                                            <span class="badge badge-success" style="font-size:.75rem;padding:4px 10px;border-radius:20px;"><?php echo e($item->product_eval_package); ?></span>
                                        <?php else: ?>
                                            <span class="badge badge-warning" style="font-size:.75rem;padding:4px 10px;border-radius:20px;"><?php echo e($item->product_eval_package); ?></span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="align-middle" style="padding:14px 12px;font-size:.85rem;">
                                        <?php echo e($item->product_eval_indicator); ?>

                                    </td>
                                    <td class="align-middle" style="padding:14px 12px;">
                                        <span class="text-muted" style="font-size:.8rem;">
                                            <?php if($item->product_expiration == 180): ?> 6 Meses
                                            <?php elseif($item->product_expiration == 270): ?> 9 Meses
                                            <?php elseif($item->product_expiration == 365): ?> 12 Meses
                                            <?php elseif($item->product_expiration == 545): ?> 18 Meses
                                            <?php else: ?> <?php echo e($item->product_expiration); ?> Días
                                            <?php endif; ?>
                                        </span>
                                        <br>
                                        <span class="font-weight-semibold text-dark" style="font-size:.8rem;">
                                            <?php echo e(\Carbon\Carbon::parse($item->updated_at)->addDays($item->product_expiration)->format('d M, Y')); ?>

                                        </span>
                                    </td>
                                    <td class="align-middle" style="padding:14px 12px;font-size:.85rem;">
                                        <span><?php echo e($item->product_patient ?: '—'); ?></span>
                                        <?php if($item->product_outside_company): ?>
                                            <br><span class="text-muted" style="font-size:.78rem;"><?php echo e($item->product_outside_company); ?></span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="align-middle text-center" style="padding:14px 12px;">
                                        <?php echo QrCode::size(50)->style('square')->generate(
                                            $discharge->reference .
                                            ' // Lote: ' . $discharge->lote_machine .
                                            ' // Cod: ' . $item->product_code .
                                            ' // Elab: ' . $item->updated_at .
                                            ' // Venc: ' . \Carbon\Carbon::parse($item->updated_at)->addDays($item->product_expiration)->format('d M, Y')
                                        ); ?>

                                        <div style="font-size:.7rem;color:#64748b;margin-top:4px;">
                                            Lote: <?php echo e($discharge->lote_machine); ?><br>
                                            Cód: <?php echo e($item->product_code); ?>

                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/Modules/Discharge/Resources/views/discharges/show.blade.php ENDPATH**/ ?>