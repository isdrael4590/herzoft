<?php
    $Lavado_max_id = \Modules\Lavado\Entities\Lavado::max('id') + 1;
    $lavado_code = 'LAV_' . str_pad($Lavado_max_id, 5, '0', STR_PAD_LEFT);
?>



<?php $__env->startSection('title', 'Registrar Lavado'); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>">Home</a></li>
        <li class="breadcrumb-item"><a href="<?php echo e(route('lavados.index')); ?>">Lavados</a></li>
        <li class="breadcrumb-item active">Registrar Lavado</li>
    </ol>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid mb-4">

        
        <div class="d-flex align-items-center justify-content-between mb-4">
            <div class="d-flex align-items-center">
                <div class="rounded-circle d-flex align-items-center justify-content-center mr-3"
                    style="width:48px;height:48px;background:linear-gradient(135deg,#3b82f6,#1d4ed8);">
                    <i class="bi bi-droplet text-white" style="font-size:1.4rem;"></i>
                </div>

            </div>
            <a href="<?php echo e(route('lavados.index')); ?>" class="btn btn-outline-secondary d-flex align-items-center"
                style="border-radius:8px;padding:9px 18px;font-weight:600;">
                <i class="bi bi-arrow-left mr-2"></i> Volver
            </a>
        </div>

        
        <div class="card border-0 mb-4" style="border-radius:12px;box-shadow:0 2px 20px rgba(0,0,0,0.08);">
            <div class="card-header border-0 d-flex align-items-center"
                style="background:linear-gradient(135deg,#f8fafc,#f1f5f9);border-radius:12px 12px 0 0;padding:14px 24px;border-left:4px solid #0ea5e9;">
                <i class="bi bi-search text-info mr-2"></i>
                <span class="font-weight-bold text-secondary"
                    style="font-size:.85rem;letter-spacing:.5px;text-transform:uppercase;">
                    Búsqueda de Instrumental
                </span>
            </div>
            <div class="card-body" style="padding:24px;">
                <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('search-product-washer', []);

$__key = null;

$__key ??= \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::generateKey('lw-2634960435-0', $__key);

$__html = app('livewire')->mount($__name, $__params, $__key);

echo $__html;

unset($__html);
unset($__key);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
            </div>
        </div>

        
        <div class="card border-0 mb-4" style="border-radius:12px;box-shadow:0 2px 20px rgba(0,0,0,0.08);">
            <div class="card-header border-0 d-flex align-items-center"
                style="background:linear-gradient(135deg,#f8fafc,#f1f5f9);border-radius:12px 12px 0 0;padding:14px 24px;border-left:4px solid #3b82f6;">
                <i class="bi bi-droplet text-primary mr-2"></i>
                <span class="font-weight-bold text-secondary"
                    style="font-size:.85rem;letter-spacing:.5px;text-transform:uppercase;">
                    Datos del Lavado
                </span>
            </div>
            <div class="card-body" style="padding:24px;">

                <?php echo $__env->make('utils.alerts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                <form id="lavado-form" action="<?php echo e(route('lavados.store')); ?>" method="POST"
                    onsubmit="return handleFormSubmit(event)">
                    <?php echo csrf_field(); ?>


                    
                    <div class="form-row mb-3">
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label class="text-dark font-weight-semibold" style="font-size:.875rem;">
                                    <i class="bi bi-person-badge text-primary mr-1"></i>
                                    Operador <span class="text-danger">*</span>
                                </label>
                                <input class="form-control" type="text" name="operator" value="<?php echo e(Auth::user()->name); ?>"
                                    required readonly
                                    style="border-radius:8px;border-color:#e2e8f0;padding:10px 14px;background:#f8fafc;">
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label class="text-dark font-weight-semibold" style="font-size:.875rem;">
                                    <i class="bi bi-cpu text-primary mr-1"></i>
                                    Equipo Lavadora
                                </label>
                                <select class="form-control" id="machine_name" name="machine_name">
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = \Modules\Informat\Entities\Machine::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $machines): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($machines->machine_type == 'Lavadora'): ?>
                                            <option value="<?php echo e($machines->machine_name); ?>">
                                                <?php echo e($machines->machine_name); ?></option>
                                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label class="text-dark font-weight-semibold" style="font-size:.875rem;">
                                    <i class="bi bi-hash text-primary mr-1"></i>
                                    Lote
                                </label>
                                <input type="text" name="lote" class="form-control" placeholder="N° de lote"
                                    value="<?php echo e(old('lote')); ?>" required
                                    style="border-radius:8px;border-color:#e2e8f0;padding:10px 14px;">
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label class="text-dark font-weight-semibold" style="font-size:.875rem;">
                                    <i class="bi bi-list-check text-primary mr-1"></i>
                                    Programa de Lavado
                                </label>
                                <select class="form-control" id="type_program" name="type_program" required>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = \Modules\Informat\Entities\Proceso::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $proceso): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($proceso->proceso_type == 'LAVADO'): ?>
                                            <option value="<?php echo e($proceso->proceso_name); ?>">
                                                <?php echo e($proceso->proceso_name); ?></option>
                                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label class="text-dark font-weight-semibold" style="font-size:.875rem;">
                                    <i class="bi bi-thermometer-half text-primary mr-1"></i>
                                    Temperatura (°C)
                                </label>
                                <input type="number" step="0.1" name="temperatura" class="form-control"
                                    placeholder="Ej: 18.5" value="<?php echo e(old('temperatura')); ?>" required
                                    style="border-radius:8px;border-color:#e2e8f0;padding:10px 14px;">
                            </div>
                        </div>
                    </div>

                    
                    <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('product-cart-washer', ['cartInstance' => 'lavados']);

$__key = null;

$__key ??= \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::generateKey('lw-2634960435-1', $__key);

$__html = app('livewire')->mount($__name, $__params, $__key);

echo $__html;

unset($__html);
unset($__key);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>

                    
                    <div class="form-row mt-3">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="text-dark font-weight-semibold" style="font-size:.875rem;">
                                    <i class="bi bi-toggle-on text-primary mr-1"></i>
                                    Estado Indicador <span class="text-danger">*</span>
                                </label>
                                <select class="form-control" name="status_indicador" required readonly
                                    style="border-radius:8px;border-color:#e2e8f0;padding:10px 14px;">
                                    <option value="Sin Validar" <?php echo e(old('status_indicador') == 'Sin Validar' ? 'selected' : ''); ?>>
                                        Sin Validar</option>
                                    <option value="Ciclo Correcto" <?php echo e(old('status_indicador') == 'Ciclo Correcto' ? 'selected' : ''); ?>>
                                        Ciclo Correcto</option>
                                    <option value="Ciclo Falla" <?php echo e(old('status_indicador') == 'Ciclo Falla' ? 'selected' : ''); ?>>
                                        Ciclo Falla
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="text-dark font-weight-semibold" style="font-size:.875rem;">
                                    <i class="bi bi-check2-circle text-primary mr-1"></i>
                                    Estado del Ciclo <span class="text-danger">*</span>
                                </label>
                                <select class="form-control" name="status_ciclo" required
                                    style="border-radius:8px;border-color:#e2e8f0;padding:10px 14px;">
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = ['Pendiente', 'Cargar']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ciclo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($ciclo); ?>" <?php echo e(old('status_ciclo', 'Pendiente') == $ciclo ? 'selected' : ''); ?>>
                                            <?php echo e($ciclo); ?>

                                        </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="text-dark font-weight-semibold" style="font-size:.875rem;">
                                    <i class="bi bi-chat-text text-secondary mr-1"></i>
                                    Nota (opcional)
                                </label>
                                <textarea name="note" rows="4" class="form-control" maxlength="400" onkeyup="updateCounter()"
                                    placeholder="Observaciones adicionales..."
                                    style="border-radius:8px;border-color:#e2e8f0;padding:10px 14px;resize:vertical;"><?php echo e(old('note')); ?></textarea>
                                <small class="text-muted">
                                    <span id="charCount"><?php echo e(strlen(old('note', ''))); ?></span>/400 caracteres
                                </small>
                            </div>
                        </div>
                    </div>

                    
                    <div class="d-flex align-items-center justify-content-between mt-2">
                        <div id="loading-indicator" class="d-none d-flex align-items-center text-primary">
                            <div class="spinner-border spinner-border-sm mr-2" role="status">
                                <span class="sr-only">Procesando...</span>
                            </div>
                            <span style="font-size:.875rem;">Guardando registro...</span>
                        </div>
                        <div class="d-flex ml-auto" style="gap:10px;">
                            <a href="<?php echo e(route('lavados.index')); ?>"
                                class="btn btn-outline-secondary d-flex align-items-center"
                                style="border-radius:8px;padding:10px 20px;font-weight:600;">
                                <i class="bi bi-x-circle mr-2"></i> Cancelar
                            </a>
                            <button type="submit" class="btn btn-primary d-flex align-items-center" id="submit-btn"
                                style="border-radius:8px;padding:10px 24px;font-weight:600;box-shadow:0 4px 12px rgba(59,130,246,0.35);">
                                <span id="submit-text">Registrar Lavado</span>
                                <i class="bi bi-check-lg ml-2" id="submit-icon"></i>
                            </button>
                        </div>
                    </div>

                </form>
            </div>
        </div>

    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('page_scripts'); ?>
    <script>
        let isSubmitting = false;
        let submitTimestamp = null;
        const SUBMIT_COOLDOWN = 3000;

        function updateCounter() {
            const textarea = document.querySelector('textarea[name="note"]');
            const counter = document.getElementById('charCount');
            if (textarea && counter) {
                counter.textContent = textarea.value.length;
            }
        }

        function handleFormSubmit(event) {
            const now = Date.now();
            const submitBtn = document.getElementById('submit-btn');
            const submitText = document.getElementById('submit-text');
            const submitIcon = document.getElementById('submit-icon');
            const loadingIndicator = document.getElementById('loading-indicator');

            if (isSubmitting) {
                event.preventDefault();
                return false;
            }

            if (submitTimestamp && (now - submitTimestamp) < SUBMIT_COOLDOWN) {
                event.preventDefault();
                return false;
            }

            isSubmitting = true;
            submitTimestamp = now;

            submitBtn.disabled = true;
            submitBtn.classList.add('btn-secondary');
            submitBtn.classList.remove('btn-primary');

            submitText.textContent = 'Procesando...';
            submitIcon.className = 'bi bi-hourglass-split ml-2';

            loadingIndicator.classList.remove('d-none');

            setTimeout(() => {
                if (isSubmitting) resetSubmitButton();
            }, 10000);

            return true;
        }

        function resetSubmitButton() {
            const submitBtn = document.getElementById('submit-btn');
            const submitText = document.getElementById('submit-text');
            const submitIcon = document.getElementById('submit-icon');
            const loadingIndicator = document.getElementById('loading-indicator');

            isSubmitting = false;
            submitTimestamp = null;

            submitBtn.disabled = false;
            submitBtn.classList.remove('btn-secondary');
            submitBtn.classList.add('btn-primary');

            submitText.textContent = 'Registrar Lavado';
            submitIcon.className = 'bi bi-check-lg ml-2';

            loadingIndicator.classList.add('d-none');
        }

        document.addEventListener('DOMContentLoaded', function() {
            updateCounter();
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/Modules/Lavado/Resources/views/lavados/create.blade.php ENDPATH**/ ?>