<?php $__env->startSection('title', 'Detalle de Ingreso'); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>">Home</a></li>
        <li class="breadcrumb-item"><a href="<?php echo e(route('receptions.index')); ?>">Ingreso Instrumental</a></li>
        <li class="breadcrumb-item active">Detalle</li>
    </ol>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid mb-4">

        
        <div class="d-flex align-items-center justify-content-between mb-4">
            <div class="d-flex align-items-center">
                <div class="rounded-circle d-flex align-items-center justify-content-center mr-3"
                    style="width:48px;height:48px;background:linear-gradient(135deg,#0ea5e9,#0284c7);">
                    <i class="bi bi-eye text-white" style="font-size:1.3rem;"></i>
                </div>
                <div>
                    <h4 class="mb-0 font-weight-bold text-dark">Ingreso #<?php echo e($reception->reference); ?></h4>
                    <small class="text-muted">
                        <?php echo e($reception->updated_at->format('d M, Y H:i')); ?>

                        &nbsp;&bull;&nbsp;
                        <?php if($reception->status === 'Registrado'): ?>
                            <span class="badge badge-success" style="font-size:.75rem;padding:4px 10px;border-radius:20px;">
                                <i class="bi bi-check-circle mr-1"></i> Registrado
                            </span>
                        <?php elseif($reception->status === 'Procesado'): ?>
                            <span class="badge badge-info" style="font-size:.75rem;padding:4px 10px;border-radius:20px;">
                                <i class="bi bi-arrow-repeat mr-1"></i> Procesado
                            </span>
                        <?php else: ?>
                            <span class="badge badge-warning" style="font-size:.75rem;padding:4px 10px;border-radius:20px;">
                                <i class="bi bi-clock mr-1"></i> Pendiente
                            </span>
                        <?php endif; ?>
                    </small>
                </div>
            </div>
            <div class="d-flex" style="gap:10px;">
                <a href="<?php echo e(route('receptions.index')); ?>"
                    class="btn btn-outline-secondary d-flex align-items-center"
                    style="border-radius:8px;padding:9px 18px;font-weight:600;">
                    <i class="bi bi-arrow-left mr-2"></i> Volver
                </a>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('print_receptions')): ?>
                    <a target="_blank" href="<?php echo e(route('receptions.pdf', $reception->id)); ?>"
                        class="btn btn-outline-secondary d-flex align-items-center d-print-none"
                        style="border-radius:8px;padding:9px 18px;font-weight:600;">
                        <i class="bi bi-printer mr-2"></i> Imprimir
                    </a>
                    <a target="_blank" href="<?php echo e(route('receptions.pdf', $reception->id)); ?>"
                        class="btn d-flex align-items-center text-white d-print-none"
                        style="border-radius:8px;padding:9px 18px;font-weight:600;background:linear-gradient(135deg,#0ea5e9,#0284c7);border:none;box-shadow:0 4px 12px rgba(14,165,233,0.35);">
                        <i class="bi bi-file-earmark-pdf mr-2"></i> Guardar PDF
                    </a>
                <?php endif; ?>
            </div>
        </div>

        
        <div class="row mb-4">

            
            <div class="col-md-4 mb-3">
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

            
            <div class="col-md-4 mb-3">
                <div class="card border-0 h-100" style="border-radius:12px;box-shadow:0 2px 20px rgba(0,0,0,0.08);">
                    <div class="card-header border-0 d-flex align-items-center"
                        style="background:linear-gradient(135deg,#f8fafc,#f1f5f9);border-radius:12px 12px 0 0;padding:14px 20px;border-left:4px solid #0ea5e9;">
                        <i class="bi bi-box-arrow-in-down text-info mr-2"></i>
                        <span class="font-weight-bold text-secondary" style="font-size:.8rem;letter-spacing:.5px;text-transform:uppercase;">Información de Ingreso</span>
                    </div>
                    <div class="card-body" style="padding:20px;">
                        <div class="d-flex align-items-start mb-3">
                            <div class="rounded mr-3 d-flex align-items-center justify-content-center flex-shrink-0"
                                style="width:34px;height:34px;background:rgba(14,165,233,0.1);">
                                <i class="bi bi-person text-info" style="font-size:.9rem;"></i>
                            </div>
                            <div>
                                <p class="text-muted mb-0" style="font-size:.75rem;text-transform:uppercase;letter-spacing:.4px;">Persona que entrega</p>
                                <p class="mb-0 font-weight-semibold text-dark" style="font-size:.875rem;"><?php echo e($reception->delivery_staff); ?></p>
                            </div>
                        </div>
                        <div class="d-flex align-items-start mb-3">
                            <div class="rounded mr-3 d-flex align-items-center justify-content-center flex-shrink-0"
                                style="width:34px;height:34px;background:rgba(14,165,233,0.1);">
                                <i class="bi bi-diagram-3 text-info" style="font-size:.9rem;"></i>
                            </div>
                            <div>
                                <p class="text-muted mb-0" style="font-size:.75rem;text-transform:uppercase;letter-spacing:.4px;">Área Procedente</p>
                                <p class="mb-0 font-weight-semibold text-dark" style="font-size:.875rem;"><?php echo e($reception->area); ?></p>
                            </div>
                        </div>
                        <div class="d-flex align-items-start">
                            <div class="rounded mr-3 d-flex align-items-center justify-content-center flex-shrink-0"
                                style="width:34px;height:34px;background:rgba(14,165,233,0.1);">
                                <i class="bi bi-person-badge text-info" style="font-size:.9rem;"></i>
                            </div>
                            <div>
                                <p class="text-muted mb-0" style="font-size:.75rem;text-transform:uppercase;letter-spacing:.4px;">Persona que recibe</p>
                                <p class="mb-0 font-weight-semibold text-dark" style="font-size:.875rem;"><?php echo e($reception->operator); ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            
            <div class="col-md-4 mb-3">
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
                                <p class="text-muted mb-0" style="font-size:.75rem;text-transform:uppercase;letter-spacing:.4px;">Número de Referencia</p>
                                <p class="mb-0 font-weight-bold text-dark" style="font-size:.95rem;"><?php echo e($reception->reference); ?></p>
                            </div>
                        </div>
                        <div class="d-flex align-items-start mb-3">
                            <div class="rounded mr-3 d-flex align-items-center justify-content-center flex-shrink-0"
                                style="width:34px;height:34px;background:rgba(16,185,129,0.1);">
                                <i class="bi bi-calendar3 text-success" style="font-size:.9rem;"></i>
                            </div>
                            <div>
                                <p class="text-muted mb-0" style="font-size:.75rem;text-transform:uppercase;letter-spacing:.4px;">Fecha</p>
                                <p class="mb-0 font-weight-semibold text-dark" style="font-size:.875rem;"><?php echo e($reception->updated_at->format('d M, Y H:i')); ?></p>
                            </div>
                        </div>
                        <div class="d-flex align-items-start">
                            <div class="rounded mr-3 d-flex align-items-center justify-content-center flex-shrink-0"
                                style="width:34px;height:34px;background:rgba(16,185,129,0.1);">
                                <i class="bi bi-toggle-on text-success" style="font-size:.9rem;"></i>
                            </div>
                            <div>
                                <p class="text-muted mb-0" style="font-size:.75rem;text-transform:uppercase;letter-spacing:.4px;">Estado</p>
                                <?php if($reception->status === 'Registrado'): ?>
                                    <span class="badge badge-success" style="font-size:.8rem;padding:4px 10px;border-radius:20px;">
                                        <i class="bi bi-check-circle mr-1"></i> Registrado
                                    </span>
                                <?php elseif($reception->status === 'Procesado'): ?>
                                    <span class="badge badge-info" style="font-size:.8rem;padding:4px 10px;border-radius:20px;">
                                        <i class="bi bi-arrow-repeat mr-1"></i> Procesado
                                    </span>
                                <?php else: ?>
                                    <span class="badge badge-warning" style="font-size:.8rem;padding:4px 10px;border-radius:20px;">
                                        <i class="bi bi-clock mr-1"></i> Pendiente
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        
        <div class="card border-0" style="border-radius:12px;box-shadow:0 2px 20px rgba(0,0,0,0.08);">
            <div class="card-header border-0 d-flex align-items-center justify-content-between"
                style="background:linear-gradient(135deg,#f8fafc,#f1f5f9);border-radius:12px 12px 0 0;padding:16px 24px;">
                <div class="d-flex align-items-center">
                    <i class="bi bi-list-ul text-primary mr-2" style="font-size:1.1rem;"></i>
                    <span class="font-weight-semibold text-secondary" style="font-size:.9rem;letter-spacing:.3px;">INSTRUMENTAL INGRESADO</span>
                </div>
                <span class="badge" style="font-size:.75rem;padding:5px 12px;border-radius:20px;background:rgba(14,165,233,0.12);color:#0284c7;">
                    <?php echo e($reception->receptionDetails->count()); ?> <?php echo e($reception->receptionDetails->count() === 1 ? 'ítem' : 'ítems'); ?>

                </span>
            </div>
            <div class="card-body" style="padding:0;">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead style="background:#f8fafc;">
                            <tr>
                                <th class="align-middle border-0 pl-4" style="font-size:.78rem;text-transform:uppercase;letter-spacing:.5px;color:#64748b;font-weight:600;padding:14px 12px;">
                                    Instrumental
                                </th>
                                <th class="align-middle border-0" style="font-size:.78rem;text-transform:uppercase;letter-spacing:.5px;color:#64748b;font-weight:600;padding:14px 12px;">
                                    Código
                                </th>
                                <th class="align-middle border-0" style="font-size:.78rem;text-transform:uppercase;letter-spacing:.5px;color:#64748b;font-weight:600;padding:14px 12px;">
                                    Cantidad
                                </th>
                                <th class="align-middle border-0" style="font-size:.78rem;text-transform:uppercase;letter-spacing:.5px;color:#64748b;font-weight:600;padding:14px 12px;">
                                    Nivel de Infección
                                </th>
                                <th class="align-middle border-0" style="font-size:.78rem;text-transform:uppercase;letter-spacing:.5px;color:#64748b;font-weight:600;padding:14px 12px;">
                                    Temp. Proceso
                                </th>
                                <th class="align-middle border-0" style="font-size:.78rem;text-transform:uppercase;letter-spacing:.5px;color:#64748b;font-weight:600;padding:14px 12px;">
                                    Estado
                                </th>
                                <th class="align-middle border-0" style="font-size:.78rem;text-transform:uppercase;letter-spacing:.5px;color:#64748b;font-weight:600;padding:14px 12px;">
                                    Paciente
                                </th>
                                <th class="align-middle border-0" style="font-size:.78rem;text-transform:uppercase;letter-spacing:.5px;color:#64748b;font-weight:600;padding:14px 12px;">
                                    Casa Comercial
                                </th>
                                <th class="align-middle border-0 pr-4" style="font-size:.78rem;text-transform:uppercase;letter-spacing:.5px;color:#64748b;font-weight:600;padding:14px 12px;">
                                    Lavado
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $reception->receptionDetails; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr style="border-color:#f1f5f9;">
                                    <td class="align-middle pl-4" style="padding:14px 12px;">
                                        <span class="font-weight-semibold text-dark" style="font-size:.875rem;"><?php echo e($item->product_name); ?></span>
                                    </td>
                                    <td class="align-middle" style="padding:14px 12px;">
                                        <span class="badge badge-primary" style="font-size:.75rem;padding:4px 10px;border-radius:20px;">
                                            <?php echo e($item->product_code); ?>

                                        </span>
                                    </td>
                                    <td class="align-middle" style="padding:14px 12px;">
                                        <span class="font-weight-semibold"><?php echo e($item->product_quantity); ?></span>
                                    </td>
                                    <td class="align-middle" style="padding:14px 12px;">
                                        <span class="text-dark" style="font-size:.875rem;"><?php echo e($item->product_type_dirt); ?></span>
                                    </td>
                                    <td class="align-middle" style="padding:14px 12px;">
                                        <span class="text-dark" style="font-size:.875rem;"><?php echo e($item->product_type_process); ?></span>
                                    </td>
                                    <td class="align-middle" style="padding:14px 12px;">
                                        <span class="text-dark" style="font-size:.875rem;"><?php echo e($item->product_state_rumed); ?></span>
                                    </td>
                                    <td class="align-middle" style="padding:14px 12px;">
                                        <span class="text-muted" style="font-size:.875rem;">
                                            <?php echo e(!empty($item->product_patient) ? $item->product_patient : '—'); ?>

                                        </span>
                                    </td>
                                    <td class="align-middle" style="padding:14px 12px;">
                                        <span class="text-muted" style="font-size:.875rem;">
                                            <?php echo e(!empty($item->product_outside_company) ? $item->product_outside_company : '—'); ?>

                                        </span>
                                    </td>
                                    <td class="align-middle pr-4" style="padding:14px 12px;">
                                        <?php if($item->product_lavado): ?>
                                            <span class="badge badge-success" style="font-size:.75rem;padding:4px 10px;border-radius:20px;">SI</span>
                                        <?php else: ?>
                                            <span class="badge badge-secondary" style="font-size:.75rem;padding:4px 10px;border-radius:20px;">NO</span>
                                        <?php endif; ?>
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

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/Modules/Reception/Resources/views/receptions/show.blade.php ENDPATH**/ ?>