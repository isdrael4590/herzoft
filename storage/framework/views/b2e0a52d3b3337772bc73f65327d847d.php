<?php $__env->startSection('title', 'Editar Insumo'); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>">Home</a></li>
        <li class="breadcrumb-item"><a href="<?php echo e(route('informats.index')); ?>">Insumos</a></li>
        <li class="breadcrumb-item active">Editar</li>
    </ol>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid mb-4">
        <form id="informat-form" action="<?php echo e(route('informats.update', $informat->id)); ?>" method="POST" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <?php echo method_field('patch'); ?>

            
            <div class="d-flex align-items-center justify-content-between mb-4">
                <div class="d-flex align-items-center">
                    <div class="rounded-circle d-flex align-items-center justify-content-center mr-3"
                        style="width:48px;height:48px;background:linear-gradient(135deg,#f59e0b,#d97706);">
                        <i class="bi bi-pencil-square text-white" style="font-size:1.3rem;"></i>
                    </div>
                    <div>
                        <h4 class="mb-0 font-weight-bold text-dark">Editar Insumo</h4>
                        <small class="text-muted">
                            Modificando: <strong class="text-dark"><?php echo e($informat->insumo_name); ?></strong>
                        </small>
                    </div>
                </div>
                <div class="d-flex" style="gap:10px;">
                    <a href="<?php echo e(route('informats.index')); ?>"
                        class="btn btn-outline-secondary d-flex align-items-center"
                        style="border-radius:8px;padding:9px 18px;font-weight:600;">
                        <i class="bi bi-arrow-left mr-2"></i> Volver
                    </a>
                    <button type="submit"
                        class="btn btn-warning d-flex align-items-center text-dark"
                        style="border-radius:8px;padding:9px 20px;font-weight:600;box-shadow:0 4px 12px rgba(245,158,11,0.35);">
                        <i class="bi bi-check-lg mr-2"></i> Actualizar Insumo
                    </button>
                </div>
            </div>

            <?php echo $__env->make('utils.alerts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

            
            <div class="card border-0 mb-4" style="border-radius:12px;box-shadow:0 2px 20px rgba(0,0,0,0.08);">
                <div class="card-header border-0 d-flex align-items-center"
                    style="background:linear-gradient(135deg,#f8fafc,#f1f5f9);border-radius:12px 12px 0 0;padding:14px 24px;border-left:4px solid #3b82f6;">
                    <i class="bi bi-info-circle text-primary mr-2"></i>
                    <span class="font-weight-bold text-secondary" style="font-size:.85rem;letter-spacing:.5px;text-transform:uppercase;">
                        Información del Insumo
                    </span>
                </div>
                <div class="card-body" style="padding:24px;">
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="text-dark font-weight-semibold" style="font-size:.875rem;">
                                    <i class="bi bi-tag text-primary mr-1"></i>
                                    Nombre del Insumo <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control <?php $__errorArgs = ['insumo_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                    name="insumo_name" required
                                    value="<?php echo e(old('insumo_name', $informat->insumo_name)); ?>"
                                    style="border-radius:8px;border-color:#e2e8f0;padding:10px 14px;">
                                <?php $__errorArgs = ['insumo_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="invalid-feedback"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="text-dark font-weight-semibold" style="font-size:.875rem;">
                                    <i class="bi bi-upc text-primary mr-1"></i>
                                    Código del Insumo <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control <?php $__errorArgs = ['insumo_code'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                    name="insumo_code" required
                                    value="<?php echo e(old('insumo_code', $informat->insumo_code)); ?>"
                                    style="border-radius:8px;border-color:#e2e8f0;padding:10px 14px;">
                                <?php $__errorArgs = ['insumo_code'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="invalid-feedback"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="text-dark font-weight-semibold" style="font-size:.875rem;">
                                    <i class="bi bi-layers text-primary mr-1"></i>
                                    Tipo de Insumo <span class="text-danger">*</span>
                                </label>
                                <select class="form-control <?php $__errorArgs = ['insumo_type'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                    name="insumo_type" id="insumo_type" required
                                    style="border-radius:8px;border-color:#e2e8f0;padding:10px 14px;">
                                    <option value="" disabled>-- Seleccionar tipo --</option>
                                    <?php $__currentLoopData = ['INDICADORES QUIMICOS' => 'INDICADORES QUÍMICOS', 'INDICADORES BIOLOGICOS' => 'INDICADORES BIOLÓGICOS', 'ROLLOS TYVEK' => 'ROLLOS TYVEK', 'ROLLOS MIXTOS' => 'ROLLOS MIXTOS', 'AGENTE ESTERILIZANTE' => 'AGENTE ESTERILIZANTE', 'TEST BOWIE & DICK' => 'TEST BOWIE & DICK']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($value); ?>" <?php echo e(old('insumo_type', $informat->insumo_type) == $value ? 'selected' : ''); ?>>
                                            <?php echo e($label); ?>

                                        </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <?php $__errorArgs = ['insumo_type'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="invalid-feedback"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="text-dark font-weight-semibold" style="font-size:.875rem;">
                                    <i class="bi bi-thermometer-half text-primary mr-1"></i>
                                    Temperatura de Uso <span class="text-danger">*</span>
                                </label>
                                <select class="form-control <?php $__errorArgs = ['insumo_temp'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                    name="insumo_temp" id="insumo_temp" required
                                    style="border-radius:8px;border-color:#e2e8f0;padding:10px 14px;">
                                    <option value="" disabled>-- Seleccionar temperatura --</option>
                                    <option value="ALTA TEMPERATURA" <?php echo e(old('insumo_temp', $informat->insumo_temp) == 'ALTA TEMPERATURA' ? 'selected' : ''); ?>>ALTA TEMPERATURA</option>
                                    <option value="BAJA TEMPERATURA" <?php echo e(old('insumo_temp', $informat->insumo_temp) == 'BAJA TEMPERATURA' ? 'selected' : ''); ?>>BAJA TEMPERATURA</option>
                                </select>
                                <?php $__errorArgs = ['insumo_temp'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="invalid-feedback"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            
            <div class="card border-0 mb-4" style="border-radius:12px;box-shadow:0 2px 20px rgba(0,0,0,0.08);">
                <div class="card-header border-0 d-flex align-items-center"
                    style="background:linear-gradient(135deg,#f8fafc,#f1f5f9);border-radius:12px 12px 0 0;padding:14px 24px;border-left:4px solid #f59e0b;">
                    <i class="bi bi-calendar3 text-warning mr-2"></i>
                    <span class="font-weight-bold text-secondary" style="font-size:.85rem;letter-spacing:.5px;text-transform:uppercase;">
                        Lote y Vencimiento
                    </span>
                </div>
                <div class="card-body" style="padding:24px;">
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="text-dark font-weight-semibold" style="font-size:.875rem;">
                                    <i class="bi bi-archive text-warning mr-1"></i>
                                    Lote del Insumo <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control <?php $__errorArgs = ['insumo_lot'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                    name="insumo_lot" required
                                    value="<?php echo e(old('insumo_lot', $informat->insumo_lot)); ?>"
                                    style="border-radius:8px;border-color:#e2e8f0;padding:10px 14px;">
                                <?php $__errorArgs = ['insumo_lot'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="invalid-feedback"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="text-dark font-weight-semibold" style="font-size:.875rem;">
                                    <i class="bi bi-calendar-x text-warning mr-1"></i>
                                    Fecha de Expiración <span class="text-danger">*</span>
                                </label>
                                <input type="date" class="form-control <?php $__errorArgs = ['insumo_exp'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                    name="insumo_exp" required
                                    value="<?php echo e(old('insumo_exp', $informat->getAttributes()['insumo_exp'])); ?>"
                                    style="border-radius:8px;border-color:#e2e8f0;padding:10px 14px;">
                                <?php $__errorArgs = ['insumo_exp'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="invalid-feedback"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            
            <div class="card border-0 mb-4" style="border-radius:12px;box-shadow:0 2px 20px rgba(0,0,0,0.08);">
                <div class="card-header border-0 d-flex align-items-center"
                    style="background:linear-gradient(135deg,#f8fafc,#f1f5f9);border-radius:12px 12px 0 0;padding:14px 24px;border-left:4px solid #8b5cf6;">
                    <i class="bi bi-bar-chart mr-2" style="color:#8b5cf6;"></i>
                    <span class="font-weight-bold text-secondary" style="font-size:.85rem;letter-spacing:.5px;text-transform:uppercase;">
                        Cantidad y Estado
                    </span>
                </div>
                <div class="card-body" style="padding:24px;">
                    <div class="form-row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="text-dark font-weight-semibold" style="font-size:.875rem;">
                                    <i class="bi bi-123" style="color:#8b5cf6;margin-right:4px;"></i>
                                    Cantidad <span class="text-danger">*</span>
                                </label>
                                <input type="number" class="form-control <?php $__errorArgs = ['insumo_quantity'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                    name="insumo_quantity" min="1" required
                                    value="<?php echo e(old('insumo_quantity', $informat->insumo_quantity)); ?>"
                                    style="border-radius:8px;border-color:#e2e8f0;padding:10px 14px;">
                                <?php $__errorArgs = ['insumo_quantity'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="invalid-feedback"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="text-dark font-weight-semibold" style="font-size:.875rem;">
                                    <i class="bi bi-rulers" style="color:#8b5cf6;margin-right:4px;"></i>
                                    Presentación <span class="text-danger">*</span>
                                    <i class="bi bi-question-circle-fill text-info ml-1"
                                        data-toggle="tooltip" data-placement="top"
                                        title="Unidad de presentación del insumo"></i>
                                </label>
                                <select class="form-control <?php $__errorArgs = ['insumo_unit'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                    name="insumo_unit" id="insumo_unit" required
                                    style="border-radius:8px;border-color:#e2e8f0;padding:10px 14px;">
                                    <option value="">-- Seleccionar presentación --</option>
                                    <?php $__currentLoopData = \Modules\Informat\Entities\Unit::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $unit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($unit->short_name); ?>"
                                            <?php echo e(old('insumo_unit', $informat->insumo_unit) == $unit->short_name ? 'selected' : ''); ?>>
                                            <?php echo e($unit->name . ' | ' . $unit->short_name); ?>

                                        </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <?php $__errorArgs = ['insumo_unit'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="invalid-feedback"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="text-dark font-weight-semibold" style="font-size:.875rem;">
                                    <i class="bi bi-toggle-on" style="color:#8b5cf6;margin-right:4px;"></i>
                                    Estado del Insumo <span class="text-danger">*</span>
                                </label>
                                <select class="form-control <?php $__errorArgs = ['insumo_status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                    name="insumo_status" id="insumo_status" required
                                    style="border-radius:8px;border-color:#e2e8f0;padding:10px 14px;">
                                    <option value="" disabled>-- Seleccionar estado --</option>
                                    <option value="Activo" <?php echo e(old('insumo_status', $informat->insumo_status) == 'Activo' ? 'selected' : ''); ?>>Activo</option>
                                    <option value="Desactivado" <?php echo e(old('insumo_status', $informat->insumo_status) == 'Desactivado' ? 'selected' : ''); ?>>Desactivado</option>
                                </select>
                                <?php $__errorArgs = ['insumo_status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="invalid-feedback"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            
            <div class="card border-0 mb-4" style="border-radius:12px;box-shadow:0 2px 20px rgba(0,0,0,0.08);">
                <div class="card-header border-0 d-flex align-items-center"
                    style="background:linear-gradient(135deg,#f8fafc,#f1f5f9);border-radius:12px 12px 0 0;padding:14px 24px;border-left:4px solid #64748b;">
                    <i class="bi bi-chat-text text-secondary mr-2"></i>
                    <span class="font-weight-bold text-secondary" style="font-size:.85rem;letter-spacing:.5px;text-transform:uppercase;">
                        Observaciones
                    </span>
                </div>
                <div class="card-body" style="padding:24px;">
                    <div class="form-group mb-0">
                        <label class="text-dark font-weight-semibold" style="font-size:.875rem;">
                            <i class="bi bi-pencil-square text-secondary mr-1"></i>
                            Nota / Observaciones
                        </label>
                        <textarea name="insumo_note" id="insumo_note" rows="4" class="form-control"
                            placeholder="Observaciones adicionales..."
                            style="border-radius:8px;border-color:#e2e8f0;padding:10px 14px;resize:vertical;"><?php echo e(old('insumo_note', $informat->insumo_note)); ?></textarea>
                    </div>
                </div>
            </div>

            
            <div class="d-flex justify-content-end mb-4" style="gap:10px;">
                <a href="<?php echo e(route('informats.index')); ?>"
                    class="btn btn-outline-secondary d-flex align-items-center"
                    style="border-radius:8px;padding:10px 22px;font-weight:600;">
                    <i class="bi bi-x-circle mr-2"></i> Cancelar
                </a>
                <button type="submit"
                    class="btn btn-warning d-flex align-items-center text-dark"
                    style="border-radius:8px;padding:10px 24px;font-weight:600;box-shadow:0 4px 12px rgba(245,158,11,0.35);">
                    <i class="bi bi-check-lg mr-2"></i> Actualizar Insumo
                </button>
            </div>

        </form>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('page_scripts'); ?>
    <script src="<?php echo e(asset('js/jquery-mask-money.js')); ?>"></script>
    <script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/Modules/Informat/Resources/views/informats/edit.blade.php ENDPATH**/ ?>