<?php
    $Expedition_max_id = \Modules\Expedition\Entities\Expedition::max('id') + 1;
    $expedition_code = 'EXP_' . str_pad($Expedition_max_id, 5, '0', STR_PAD_LEFT);
?>



<?php $__env->startSection('title', 'Nuevo Despacho'); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>">Home</a></li>
        <li class="breadcrumb-item"><a href="<?php echo e(route('expeditions.index')); ?>">Despacho de Productos</a></li>
        <li class="breadcrumb-item active">Nuevo Despacho</li>
    </ol>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid mb-4">

        
        <div class="d-flex align-items-center justify-content-between mb-4">
            <div class="d-flex align-items-center">
                <div class="rounded-circle d-flex align-items-center justify-content-center mr-3"
                    style="width:48px;height:48px;background:linear-gradient(135deg,#10b981,#059669);">
                    <i class="bi bi-box-arrow-right text-white" style="font-size:1.4rem;"></i>
                </div>
                <div>
                    <h4 class="mb-0 font-weight-bold text-dark">Nuevo Despacho</h4>
                    <small class="text-muted">
                        Referencia: <strong class="text-dark"><?php echo e($expedition_code); ?></strong>
                        &nbsp;&bull;&nbsp; Operador: <strong class="text-dark"><?php echo e(Auth::user()->name); ?></strong>
                    </small>
                </div>
            </div>
            <a href="<?php echo e(route('expeditions.index')); ?>"
                class="btn btn-outline-secondary d-flex align-items-center"
                style="border-radius:8px;padding:9px 18px;font-weight:600;">
                <i class="bi bi-arrow-left mr-2"></i> Volver
            </a>
        </div>

        <?php echo $__env->make('utils.alerts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        
        <div class="card border-0 mb-4" style="border-radius:12px;box-shadow:0 2px 20px rgba(0,0,0,0.08);">
            <div class="card-header border-0 d-flex align-items-center"
                style="background:linear-gradient(135deg,#f8fafc,#f1f5f9);border-radius:12px 12px 0 0;padding:14px 24px;border-left:4px solid #0ea5e9;">
                <i class="bi bi-search mr-2" style="color:#0ea5e9;"></i>
                <span class="font-weight-bold text-secondary" style="font-size:.85rem;letter-spacing:.5px;text-transform:uppercase;">
                    Buscar Instrumental
                </span>
            </div>
            <div class="card-body" style="padding:24px;">
                <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('search-producttoEXP', []);

$__key = null;

$__key ??= \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::generateKey('lw-2296577695-0', $__key);

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

        <form id="expedition-form" action="<?php echo e(route('expeditions.store')); ?>" method="POST"
            onsubmit="return handleFormSubmit(event)">
            <?php echo csrf_field(); ?>
            <input type="hidden" name="form_token" value="<?php echo e(uniqid('expedition_', true)); ?>">
            <input type="hidden" name="reference" value="<?php echo e($expedition_code); ?>">

            
            <div class="card border-0 mb-4" style="border-radius:12px;box-shadow:0 2px 20px rgba(0,0,0,0.08);">
                <div class="card-header border-0 d-flex align-items-center"
                    style="background:linear-gradient(135deg,#f8fafc,#f1f5f9);border-radius:12px 12px 0 0;padding:14px 24px;border-left:4px solid #10b981;">
                    <i class="bi bi-clipboard-check text-success mr-2"></i>
                    <span class="font-weight-bold text-secondary" style="font-size:.85rem;letter-spacing:.5px;text-transform:uppercase;">
                        Datos del Despacho
                    </span>
                </div>
                <div class="card-body" style="padding:24px;">
                    <div class="form-row">

                        <div class="col-lg-2 col-md-4 mb-3">
                            <label class="text-muted" style="font-size:.8rem;font-weight:600;text-transform:uppercase;letter-spacing:.4px;">
                                Referencia
                            </label>
                            <input type="text" class="form-control form-control-sm" name="reference_display"
                                value="<?php echo e($expedition_code); ?>" readonly
                                style="background:#f8fafc;border-color:#e2e8f0;border-radius:8px;">
                        </div>

                        <div class="col-lg-2 col-md-4 mb-3">
                            <label class="text-muted" style="font-size:.8rem;font-weight:600;text-transform:uppercase;letter-spacing:.4px;">
                                Estado <span class="text-danger">*</span>
                            </label>
                            <select class="form-control form-control-sm" name="status_expedition" id="status_expedition"
                                required style="border-radius:8px;">
                                <option selected value="Pendiente">Pendiente</option>
                                <option value="Despachado">Despachar</option>
                            </select>
                        </div>

                        <div class="col-lg-2 col-md-4 mb-3">
                            <label class="text-muted" style="font-size:.8rem;font-weight:600;text-transform:uppercase;letter-spacing:.4px;">
                                Temp. Ambiente <span class="text-danger">*</span>
                            </label>
                            <input type="number" class="form-control form-control-sm" name="temp_ambiente" required
                                value="<?php echo e(old('temp_ambiente')); ?>" min="1" step="0.1"
                                style="border-radius:8px;">
                        </div>

                        <div class="col-lg-3 col-md-6 mb-3">
                            <label class="text-muted" style="font-size:.8rem;font-weight:600;text-transform:uppercase;letter-spacing:.4px;">
                                Área de Expedición <span class="text-danger">*</span>
                            </label>
                            <select class="form-control form-control-sm" id="area_expedition" name="area_expedition"
                                required style="border-radius:8px;">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = \Modules\Informat\Entities\Area::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $area): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($area->area_name); ?>"><?php echo e($area->area_name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </select>
                        </div>

                        <div class="col-lg-3 col-md-6 mb-3">
                            <label class="text-muted" style="font-size:.8rem;font-weight:600;text-transform:uppercase;letter-spacing:.4px;">
                                Persona que Recibe <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control form-control-sm" name="staff_expedition" required
                                value="<?php echo e(old('staff_expedition')); ?>" style="border-radius:8px;">
                        </div>

                        <div class="col-lg-2 col-md-4 mb-3">
                            <label class="text-muted" style="font-size:.8rem;font-weight:600;text-transform:uppercase;letter-spacing:.4px;">
                                Operador
                            </label>
                            <input type="text" class="form-control form-control-sm" name="operator"
                                value="<?php echo e(Auth::user()->name); ?>" readonly
                                style="background:#f8fafc;border-color:#e2e8f0;border-radius:8px;">
                        </div>

                    </div>
                </div>
            </div>

            
            <div class="card border-0 mb-4" style="border-radius:12px;box-shadow:0 2px 20px rgba(0,0,0,0.08);">
                <div class="card-header border-0 d-flex align-items-center"
                    style="background:linear-gradient(135deg,#f8fafc,#f1f5f9);border-radius:12px 12px 0 0;padding:14px 24px;border-left:4px solid #0ea5e9;">
                    <i class="bi bi-cart3 text-info mr-2"></i>
                    <span class="font-weight-bold text-secondary" style="font-size:.85rem;letter-spacing:.5px;text-transform:uppercase;">
                        Instrumental a Despachar
                    </span>
                </div>
                <div class="card-body" style="padding:24px;">
                    <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('product-carttoEXP', ['cartInstance' => 'expedition']);

$__key = null;

$__key ??= \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::generateKey('lw-2296577695-1', $__key);

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
                    style="background:linear-gradient(135deg,#f8fafc,#f1f5f9);border-radius:12px 12px 0 0;padding:14px 24px;border-left:4px solid #94a3b8;">
                    <i class="bi bi-chat-left-text text-secondary mr-2"></i>
                    <span class="font-weight-bold text-secondary" style="font-size:.85rem;letter-spacing:.5px;text-transform:uppercase;">
                        Observaciones
                    </span>
                </div>
                <div class="card-body" style="padding:24px;">
                    <textarea name="note_expedition" id="note_expedition" rows="3" class="form-control"
                        placeholder="Notas u observaciones adicionales (opcional)..."
                        style="border-radius:8px;resize:none;"></textarea>
                    <small class="text-muted" style="font-size:.75rem;">
                        <span id="charCount">0</span> caracteres
                    </small>
                </div>
            </div>

            
            <div class="d-flex align-items-center justify-content-between">
                <div id="loading-indicator" class="d-none d-flex align-items-center text-muted" style="gap:8px;">
                    <div class="spinner-border spinner-border-sm" role="status">
                        <span class="sr-only">Procesando...</span>
                    </div>
                    <span style="font-size:.9rem;">Registrando despacho...</span>
                </div>
                <div></div>
                <button type="submit" id="submit-btn"
                    class="btn d-flex align-items-center text-white"
                    style="border-radius:8px;padding:11px 28px;font-weight:600;background:linear-gradient(135deg,#10b981,#059669);border:none;box-shadow:0 4px 12px rgba(16,185,129,0.35);gap:8px;">
                    <i class="bi bi-check-lg" id="submit-icon"></i>
                    <span id="submit-text">Despachar Producto</span>
                </button>
            </div>

        </form>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('page_scripts'); ?>
    <script>
        let isSubmitting = false;
        let submitTimestamp = null;
        const SUBMIT_COOLDOWN = 3000;

        function updateCounter() {
            const textarea = document.getElementById('note_expedition');
            const counter = document.getElementById('charCount');
            if (textarea && counter) counter.textContent = textarea.value.length;
        }

        function handleFormSubmit(event) {
            const now = Date.now();

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

            const submitBtn = document.getElementById('submit-btn');
            submitBtn.disabled = true;
            submitBtn.style.opacity = '0.7';
            document.getElementById('submit-text').textContent = 'Procesando...';
            document.getElementById('submit-icon').className = 'bi bi-hourglass-split';
            document.getElementById('loading-indicator').classList.remove('d-none');

            setTimeout(() => { if (isSubmitting) resetSubmitButton(); }, 10000);

            return true;
        }

        function resetSubmitButton() {
            isSubmitting = false;
            submitTimestamp = null;

            const submitBtn = document.getElementById('submit-btn');
            submitBtn.disabled = false;
            submitBtn.style.opacity = '1';
            document.getElementById('submit-text').textContent = 'Despachar Producto';
            document.getElementById('submit-icon').className = 'bi bi-check-lg';
            document.getElementById('loading-indicator').classList.add('d-none');
        }

        document.addEventListener('DOMContentLoaded', function () {
            const form = document.getElementById('expedition-form');
            const inputs = form.querySelectorAll('input[type="text"], input[type="number"], select');

            inputs.forEach(input => {
                input.addEventListener('keypress', function (e) {
                    if (e.key === 'Enter') {
                        e.preventDefault();
                        const formElements = Array.from(form.elements);
                        const next = formElements[formElements.indexOf(this) + 1];
                        if (next && next.focus) next.focus();
                    }
                });
            });

            const note = document.getElementById('note_expedition');
            if (note) {
                note.addEventListener('input', updateCounter);
                updateCounter();
            }
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/Modules/Expedition/Resources/views/expeditions/create.blade.php ENDPATH**/ ?>