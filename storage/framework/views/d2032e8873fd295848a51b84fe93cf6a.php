<?php
    $Proceso_max_id = \Modules\Informat\Entities\Proceso::max('id') + 1;
    $Proceso_code = "Proceso_" . str_pad($Proceso_max_id, 2, '0', STR_PAD_LEFT);
?>


<?php $__env->startSection('title', 'Nuevo Proceso'); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>">Home</a></li>
        <li class="breadcrumb-item"><a href="<?php echo e(route('proceso.index')); ?>">Tipo Procesos</a></li>
        <li class="breadcrumb-item active">Nuevo</li>
    </ol>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid mb-4">
        <form action="<?php echo e(route('proceso.store')); ?>" method="POST" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>

            
            <div class="d-flex align-items-center justify-content-between mb-4">
                <div class="d-flex align-items-center">
                    <div class="rounded-circle d-flex align-items-center justify-content-center mr-3"
                        style="width:48px;height:48px;background:linear-gradient(135deg,#10b981,#059669);">
                        <i class="bi bi-plus-circle text-white" style="font-size:1.4rem;"></i>
                    </div>
                    <div>
                        <h4 class="mb-0 font-weight-bold text-dark">Nuevo Proceso</h4>
                        <small class="text-muted">Complete los campos para registrar un tipo de proceso</small>
                    </div>
                </div>
                <div class="d-flex" style="gap:10px;">
                    <a href="<?php echo e(route('proceso.index')); ?>"
                        class="btn btn-outline-secondary d-flex align-items-center"
                        style="border-radius:8px;padding:9px 18px;font-weight:600;">
                        <i class="bi bi-arrow-left mr-2"></i> Volver
                    </a>
                    <button type="submit"
                        class="btn btn-success d-flex align-items-center"
                        style="border-radius:8px;padding:9px 20px;font-weight:600;box-shadow:0 4px 12px rgba(16,185,129,0.35);">
                        <i class="bi bi-check-lg mr-2"></i> Crear Proceso
                    </button>
                </div>
            </div>

            <?php echo $__env->make('utils.alerts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

            
            <div class="card border-0 mb-4" style="border-radius:12px;box-shadow:0 2px 20px rgba(0,0,0,0.08);">
                <div class="card-header border-0 d-flex align-items-center"
                    style="background:linear-gradient(135deg,#f8fafc,#f1f5f9);border-radius:12px 12px 0 0;padding:14px 24px;border-left:4px solid #14b8a6;">
                    <i class="bi bi-hash text-info mr-2"></i>
                    <span class="font-weight-bold text-secondary" style="font-size:.85rem;letter-spacing:.5px;text-transform:uppercase;">
                        Identificador (Generado automáticamente)
                    </span>
                </div>
                <div class="card-body" style="padding:24px;">
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="form-group mb-0">
                                <label class="text-dark font-weight-semibold" style="font-size:.875rem;">
                                    <i class="bi bi-upc text-info mr-1"></i>
                                    Código del Proceso
                                </label>
                                <input class="form-control" type="text" name="proceso_code" required
                                    value="<?php echo e($Proceso_code); ?>"
                                    style="border-radius:8px;border-color:#e2e8f0;padding:10px 14px;background:#f8fafc;">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            
            <div class="card border-0 mb-4" style="border-radius:12px;box-shadow:0 2px 20px rgba(0,0,0,0.08);">
                <div class="card-header border-0 d-flex align-items-center"
                    style="background:linear-gradient(135deg,#f8fafc,#f1f5f9);border-radius:12px 12px 0 0;padding:14px 24px;border-left:4px solid #3b82f6;">
                    <i class="bi bi-arrow-repeat text-primary mr-2"></i>
                    <span class="font-weight-bold text-secondary" style="font-size:.85rem;letter-spacing:.5px;text-transform:uppercase;">
                        Información del Proceso
                    </span>
                </div>
                <div class="card-body" style="padding:24px;">
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="text-dark font-weight-semibold" style="font-size:.875rem;">
                                    <i class="bi bi-tag text-primary mr-1"></i>
                                    Nombre del Proceso <span class="text-danger">*</span>
                                </label>
                                <input class="form-control <?php $__errorArgs = ['proceso_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                    type="text" name="proceso_name" required
                                    placeholder="Ej: Esterilización Vapor"
                                    value="<?php echo e(old('proceso_name')); ?>"
                                    style="border-radius:8px;border-color:#e2e8f0;padding:10px 14px;">
                                <?php $__errorArgs = ['proceso_name'];
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
                                    <i class="bi bi-layers text-primary mr-1"></i>
                                    Tipo de Proceso <span class="text-danger">*</span>
                                </label>
                                <select class="form-control <?php $__errorArgs = ['proceso_type'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                    name="proceso_type" id="proceso_type" required
                                    style="border-radius:8px;border-color:#e2e8f0;padding:10px 14px;">
                                    <option value="" selected disabled>-- Seleccionar tipo --</option>
                                    <option value="ALTA TEMPERATURA" <?php echo e(old('proceso_type') == 'ALTA TEMPERATURA' ? 'selected' : ''); ?>>ALTA TEMPERATURA</option>
                                    <option value="BAJA TEMPERATURA" <?php echo e(old('proceso_type') == 'BAJA TEMPERATURA' ? 'selected' : ''); ?>>BAJA TEMPERATURA</option>
                                    <option value="LAVADO" <?php echo e(old('proceso_type') == 'LAVADO' ? 'selected' : ''); ?>>LAVADO</option>
                                </select>
                                <?php $__errorArgs = ['proceso_type'];
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
                            <div class="form-group mb-0">
                                <label class="text-dark font-weight-semibold" style="font-size:.875rem;">
                                    <i class="bi bi-thermometer-half text-primary mr-1"></i>
                                    Temperatura de Proceso <span class="text-danger">*</span>
                                </label>
                                <input class="form-control <?php $__errorArgs = ['proceso_temp'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                    type="text" name="proceso_temp" required
                                    placeholder="Ej: 134°C"
                                    value="<?php echo e(old('proceso_temp')); ?>"
                                    style="border-radius:8px;border-color:#e2e8f0;padding:10px 14px;">
                                <?php $__errorArgs = ['proceso_temp'];
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

            
            <div class="d-flex justify-content-end mb-4" style="gap:10px;">
                <a href="<?php echo e(route('proceso.index')); ?>"
                    class="btn btn-outline-secondary d-flex align-items-center"
                    style="border-radius:8px;padding:10px 22px;font-weight:600;">
                    <i class="bi bi-x-circle mr-2"></i> Cancelar
                </a>
                <button type="submit"
                    class="btn btn-success d-flex align-items-center"
                    style="border-radius:8px;padding:10px 24px;font-weight:600;box-shadow:0 4px 12px rgba(16,185,129,0.35);">
                    <i class="bi bi-check-lg mr-2"></i> Crear Proceso
                </button>
            </div>

        </form>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/Modules/Informat/Resources/views/procesos/create.blade.php ENDPATH**/ ?>