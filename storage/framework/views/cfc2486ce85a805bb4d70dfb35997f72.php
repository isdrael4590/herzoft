<?php
    $Testbd_max_id = \Modules\Testbd\Entities\Testbd::max('id') + 1;
    $testbd_reference = 'TBD_' . str_pad($Testbd_max_id, 5, '0', STR_PAD_LEFT);
?>



<?php $__env->startSection('title', 'Nuevo Test Bowie & Dick'); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>">Home</a></li>
        <li class="breadcrumb-item"><a href="<?php echo e(route('testbds.index')); ?>">Test BD</a></li>
        <li class="breadcrumb-item active">Nuevo</li>
    </ol>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <form id="testbd-form" action="<?php echo e(route('testbds.store')); ?>" method="POST" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>

            
            <div class="d-flex align-items-center justify-content-between mb-4">
                <div class="d-flex align-items-center">
                    <div class="rounded-circle d-flex align-items-center justify-content-center mr-3"
                        style="width:48px;height:48px;background:linear-gradient(135deg,#10b981,#059669);">
                        <i class="bi bi-plus-circle text-white" style="font-size:1.4rem;"></i>
                    </div>
                    <div>
                        <h4 class="mb-0 font-weight-bold text-dark">Nuevo Test Bowie & Dick</h4>
                        <small class="text-muted">Complete los campos para registrar el test de ciclo BD</small>
                    </div>
                </div>
                <div class="d-flex" style="gap:10px;">
                    <a href="<?php echo e(route('testbds.index')); ?>"
                        class="btn btn-outline-secondary d-flex align-items-center"
                        style="border-radius:8px;padding:9px 18px;font-weight:600;">
                        <i class="bi bi-arrow-left mr-2"></i> Volver
                    </a>
                    <button type="submit"
                        class="btn btn-success d-flex align-items-center"
                        style="border-radius:8px;padding:9px 20px;font-weight:600;box-shadow:0 4px 12px rgba(16,185,129,0.35);">
                        <i class="bi bi-check-lg mr-2"></i> Registrar Test
                    </button>
                </div>
            </div>

            <?php echo $__env->make('utils.alerts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

            
            <div class="card border-0 mb-4" style="border-radius:12px;box-shadow:0 2px 20px rgba(0,0,0,0.08);">
                <div class="card-header border-0 d-flex align-items-center"
                    style="background:linear-gradient(135deg,#f8fafc,#f1f5f9);border-radius:12px 12px 0 0;padding:14px 24px;border-left:4px solid #3b82f6;">
                    <i class="bi bi-fingerprint text-primary mr-2"></i>
                    <span class="font-weight-bold text-secondary" style="font-size:.85rem;letter-spacing:.5px;text-transform:uppercase;">
                        Identificación
                    </span>
                </div>
                <div class="card-body" style="padding:24px;">
                    <div class="form-row">
                        <div class="col-md-4">
                            <div class="form-group mb-0">
                                <label class="text-dark font-weight-semibold" style="font-size:.875rem;">
                                    <i class="bi bi-hash text-primary mr-1"></i>
                                    Referencia del Test
                                </label>
                                <input class="form-control" type="text" name="testbd_reference" readonly
                                    value="<?php echo e($testbd_reference); ?>"
                                    style="border-radius:8px;border-color:#e2e8f0;padding:10px 14px;background:#f8fafc;font-weight:600;color:#374151;">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            
            <div class="card border-0 mb-4" style="border-radius:12px;box-shadow:0 2px 20px rgba(0,0,0,0.08);">
                <div class="card-header border-0 d-flex align-items-center"
                    style="background:linear-gradient(135deg,#f8fafc,#f1f5f9);border-radius:12px 12px 0 0;padding:14px 24px;border-left:4px solid #10b981;">
                    <i class="bi bi-cpu text-success mr-2"></i>
                    <span class="font-weight-bold text-secondary" style="font-size:.85rem;letter-spacing:.5px;text-transform:uppercase;">
                        Datos del Equipo
                    </span>
                </div>
                <div class="card-body" style="padding:24px;">
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="text-dark font-weight-semibold" style="font-size:.875rem;">
                                    <i class="bi bi-hdd-stack text-success mr-1"></i>
                                    Nombre del Equipo <span class="text-danger">*</span>
                                </label>
                                <select class="form-control" id="machine_name" name="machine_name" required
                                    style="border-radius:8px;border-color:#e2e8f0;padding:10px 14px;">
                                    <option value="" disabled>-- Seleccionar equipo --</option>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = \Modules\Informat\Entities\Machine::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $machine): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($machine->machine_name); ?>"
                                            <?php echo e(old('machine_name') == $machine->machine_name ? 'selected' : ''); ?>>
                                            <?php echo e($machine->machine_name); ?>

                                        </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="text-dark font-weight-semibold" style="font-size:.875rem;">
                                    <i class="bi bi-archive text-success mr-1"></i>
                                    Lote del Equipo <span class="text-danger">*</span>
                                </label>
                                <input type="number" class="form-control <?php $__errorArgs = ['lote_machine'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                    name="lote_machine" required value="<?php echo e(old('lote_machine')); ?>"
                                    placeholder="Ej: 1"
                                    style="border-radius:8px;border-color:#e2e8f0;padding:10px 14px;">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['lote_machine'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="invalid-feedback"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="text-dark font-weight-semibold" style="font-size:.875rem;">
                                    <i class="bi bi-thermometer-half text-success mr-1"></i>
                                    Temperatura del Equipo <span class="text-danger">*</span>
                                </label>
                                <select class="form-control" id="temp_machine" name="temp_machine" required
                                    style="border-radius:8px;border-color:#e2e8f0;padding:10px 14px;">
                                    <option value="134" <?php echo e(old('temp_machine', '134') == '134' ? 'selected' : ''); ?>>134 °C</option>
                                    <option value="121" <?php echo e(old('temp_machine') == '121' ? 'selected' : ''); ?>>121 °C</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            
            <div class="card border-0 mb-4" style="border-radius:12px;box-shadow:0 2px 20px rgba(0,0,0,0.08);">
                <div class="card-header border-0 d-flex align-items-center"
                    style="background:linear-gradient(135deg,#f8fafc,#f1f5f9);border-radius:12px 12px 0 0;padding:14px 24px;border-left:4px solid #f59e0b;">
                    <i class="bi bi-clipboard2-check text-warning mr-2"></i>
                    <span class="font-weight-bold text-secondary" style="font-size:.85rem;letter-spacing:.5px;text-transform:uppercase;">
                        Insumo BD y Validación del Ciclo
                    </span>
                </div>
                <div class="card-body" style="padding:24px;">
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="text-dark font-weight-semibold" style="font-size:.875rem;">
                                    <i class="bi bi-box-seam text-warning mr-1"></i>
                                    Lote del Insumo BD <span class="text-danger">*</span>
                                </label>
                                <select class="form-control" id="lote_bd" name="lote_bd" required
                                    style="border-radius:8px;border-color:#e2e8f0;padding:10px 14px;">
                                    <option value="" disabled>-- Seleccionar lote --</option>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = \Modules\Informat\Entities\Informat::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $informat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($informat->insumo_type == 'TEST BOWIE & DICK' && $informat->insumo_status == 'Activo'): ?>
                                            <option value="<?php echo e($informat->insumo_lot); ?>"
                                                <?php echo e(old('lote_bd') == $informat->insumo_lot ? 'selected' : ''); ?>>
                                                <?php echo e($informat->insumo_lot); ?>

                                            </option>
                                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="text-dark font-weight-semibold" style="font-size:.875rem;">
                                    <i class="bi bi-patch-check text-warning mr-1"></i>
                                    Validación del Ciclo BD <span class="text-danger">*</span>
                                </label>
                                <select class="form-control" name="validation_bd" id="validation_bd" required
                                    style="border-radius:8px;border-color:#e2e8f0;padding:10px 14px;">
                                    <option value="" selected disabled>-- Seleccionar resultado --</option>
                                    <option value="Correcto" <?php echo e(old('validation_bd') == 'Correcto' ? 'selected' : ''); ?>>
                                        Correcto
                                    </option>
                                    <option value="Falla" <?php echo e(old('validation_bd') == 'Falla' ? 'selected' : ''); ?>>
                                        Falla
                                    </option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            
            <div class="card border-0 mb-4" style="border-radius:12px;box-shadow:0 2px 20px rgba(0,0,0,0.08);">
                <div class="card-header border-0 d-flex align-items-center"
                    style="background:linear-gradient(135deg,#f8fafc,#f1f5f9);border-radius:12px 12px 0 0;padding:14px 24px;border-left:4px solid #8b5cf6;">
                    <i class="bi bi-cloud-sun mr-2" style="color:#8b5cf6;"></i>
                    <span class="font-weight-bold text-secondary" style="font-size:.85rem;letter-spacing:.5px;text-transform:uppercase;">
                        Condiciones Ambientales y Operador
                    </span>
                </div>
                <div class="card-body" style="padding:24px;">
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="text-dark font-weight-semibold" style="font-size:.875rem;">
                                    <i class="bi bi-thermometer" style="color:#8b5cf6;margin-right:4px;"></i>
                                    Temperatura Ambiente <span class="text-danger">*</span>
                                </label>
                                <div class="input-group">
                                    <input type="number" class="form-control <?php $__errorArgs = ['temp_ambiente'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                        name="temp_ambiente" required value="<?php echo e(old('temp_ambiente')); ?>"
                                        step="0.1" placeholder="Ej: 22.5"
                                        style="border-radius:8px 0 0 8px;border-color:#e2e8f0;padding:10px 14px;">
                                    <div class="input-group-append">
                                        <span class="input-group-text" style="border-radius:0 8px 8px 0;background:#f1f5f9;border-color:#e2e8f0;font-weight:600;">°C</span>
                                    </div>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['temp_ambiente'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <div class="invalid-feedback"><?php echo e($message); ?></div>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="text-dark font-weight-semibold" style="font-size:.875rem;">
                                    <i class="bi bi-person-badge" style="color:#8b5cf6;margin-right:4px;"></i>
                                    Operador
                                </label>
                                <input class="form-control" type="text" name="operator"
                                    value="<?php echo e(Auth::user()->name); ?>" readonly
                                    style="border-radius:8px;border-color:#e2e8f0;padding:10px 14px;background:#f8fafc;font-weight:600;color:#374151;">
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
                        <textarea name="observation" id="observation" rows="4" class="form-control"
                            placeholder="Ingrese observaciones adicionales sobre este test..."
                            style="border-radius:8px;border-color:#e2e8f0;padding:10px 14px;resize:vertical;"><?php echo e(old('observation')); ?></textarea>
                    </div>
                </div>
            </div>

            
            <div class="d-flex justify-content-end mb-4" style="gap:10px;">
                <a href="<?php echo e(route('testbds.index')); ?>"
                    class="btn btn-outline-secondary d-flex align-items-center"
                    style="border-radius:8px;padding:10px 22px;font-weight:600;">
                    <i class="bi bi-x-circle mr-2"></i> Cancelar
                </a>
                <button type="submit"
                    class="btn btn-success d-flex align-items-center"
                    style="border-radius:8px;padding:10px 24px;font-weight:600;box-shadow:0 4px 12px rgba(16,185,129,0.35);">
                    <i class="bi bi-check-lg mr-2"></i> Registrar Test
                </button>
            </div>

        </form>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/Modules/Testbd/Resources/views/testbds/create.blade.php ENDPATH**/ ?>