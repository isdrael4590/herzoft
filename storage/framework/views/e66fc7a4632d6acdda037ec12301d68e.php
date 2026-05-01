<?php $__env->startSection('title', 'Envío a Preparación desde Descarga Lavado'); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>">Home</a></li>
        <li class="breadcrumb-item"><a href="<?php echo e(route('descarga-lavado.index')); ?>">Descarga Lavado</a></li>
        <li class="breadcrumb-item active">Envío a Preparación</li>
    </ol>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid mb-4">

        
        <div class="d-flex align-items-center justify-content-between mb-4">
            <div class="d-flex align-items-center">
                <div class="rounded-circle d-flex align-items-center justify-content-center mr-3"
                    style="width:48px;height:48px;background:linear-gradient(135deg,#10b981,#059669);">
                    <i class="bi bi-arrow-right-circle text-white" style="font-size:1.4rem;"></i>
                </div>
                <div>
                    <h5 class="mb-0 font-weight-bold text-dark">Enviar a Preparación</h5>
                    <small class="text-muted">Proveniente de Descarga <strong><?php echo e($preparation->reference); ?></strong></small>
                </div>
            </div>
            <a href="<?php echo e(route('descarga-lavado.index')); ?>" class="btn btn-outline-secondary d-flex align-items-center"
                style="border-radius:8px;padding:9px 18px;font-weight:600;">
                <i class="bi bi-arrow-left mr-2"></i> Volver
            </a>
        </div>

        <div class="card border-0 mb-4" style="border-radius:12px;box-shadow:0 2px 20px rgba(0,0,0,0.08);">
            <div class="card-header border-0 d-flex align-items-center"
                style="background:linear-gradient(135deg,#f8fafc,#f1f5f9);border-radius:12px 12px 0 0;padding:14px 24px;border-left:4px solid #10b981;">
                <i class="bi bi-box-arrow-in-right text-success mr-2"></i>
                <span class="font-weight-bold text-secondary"
                    style="font-size:.85rem;letter-spacing:.5px;text-transform:uppercase;">
                    Va a Preparación (desde Descarga Lavado)
                </span>
                <span class="badge ml-2" style="background:#10b981;color:#fff;">
                    <?php echo e(Cart::instance('preparation')->count()); ?> ítem(s)
                </span>
            </div>
            <div class="card-body" style="padding:24px;">

                <?php echo $__env->make('utils.alerts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                <form id="preparation-form" action="<?php echo e(route('preparations.store')); ?>" method="POST"
                    onsubmit="return handleFormSubmit(event)">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="form_token" value="<?php echo e(uniqid('desc_lavado_preparation_', true)); ?>">
                    <input type="hidden" name="reference" value="PRE">
                    <input type="hidden" name="descargalavado_id" value="<?php echo e($descargalavado_id); ?>">
                    <input type="hidden" name="reception_id" value="<?php echo e($reception_id); ?>">

                    <div class="form-row mb-3">
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label class="text-dark font-weight-semibold" style="font-size:.875rem;">
                                    <i class="bi bi-person-badge text-success mr-1"></i> Operador
                                </label>
                                <input class="form-control" type="text" name="operator"
                                    value="<?php echo e(Auth::user()->name); ?>" readonly
                                    style="border-radius:8px;border-color:#e2e8f0;padding:10px 14px;background:#f8fafc;cursor:not-allowed;">
                            </div>
                        </div>
                    </div>

                    <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('product-carttoPRE', ['cartInstance' => 'preparation','data' => $preparation,'readonlyQty' => true]);

$__key = null;

$__key ??= \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::generateKey('lw-1551087012-0', $__key);

$__html = app('livewire')->mount($__name, $__params, $__key);

echo $__html;

unset($__html);
unset($__key);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>

                    <div class="form-group mt-3">
                        <label class="text-dark font-weight-semibold" style="font-size:.875rem;">
                            <i class="bi bi-chat-text text-secondary mr-1"></i> Nota (opcional)
                        </label>
                        <textarea name="note" rows="4" class="form-control" maxlength="400"
                            onkeyup="updateCounter()"
                            placeholder="Observaciones adicionales..."
                            style="border-radius:8px;border-color:#e2e8f0;padding:10px 14px;resize:vertical;"><?php echo e($preparation->note); ?></textarea>
                        <small class="text-muted">
                            <span id="charCount"><?php echo e(strlen($preparation->note ?? '')); ?></span>/400 caracteres
                        </small>
                    </div>

                    <div class="d-flex align-items-center justify-content-between mt-3">
                        <div id="loading-indicator" class="d-none d-flex align-items-center text-success">
                            <div class="spinner-border spinner-border-sm mr-2" role="status">
                                <span class="sr-only">Procesando...</span>
                            </div>
                            <span style="font-size:.875rem;">Enviando a preparación...</span>
                        </div>
                        <div class="d-flex ml-auto" style="gap:10px;">
                            <a href="<?php echo e(route('descarga-lavado.index')); ?>"
                                class="btn btn-outline-secondary d-flex align-items-center"
                                style="border-radius:8px;padding:10px 20px;font-weight:600;">
                                <i class="bi bi-x-circle mr-2"></i> Cancelar
                            </a>
                            <button type="submit" class="btn d-flex align-items-center text-white" id="submit-btn"
                                style="border-radius:8px;padding:10px 24px;font-weight:600;background:linear-gradient(135deg,#10b981,#059669);border:none;box-shadow:0 4px 12px rgba(16,185,129,0.35);">
                                <span id="submit-text">Enviar a Preparación</span>
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

        function updateCounter() {
            const textarea = document.querySelector('textarea[name="note"]');
            const counter = document.getElementById('charCount');
            if (textarea && counter) counter.textContent = textarea.value.length;
        }

        function handleFormSubmit(event) {
            if (isSubmitting) { event.preventDefault(); return false; }
            isSubmitting = true;
            const btn = document.getElementById('submit-btn');
            document.getElementById('submit-text').textContent = 'Procesando...';
            document.getElementById('submit-icon').className = 'bi bi-hourglass-split ml-2';
            document.getElementById('loading-indicator').classList.remove('d-none');
            btn.disabled = true;
            setTimeout(() => { isSubmitting = false; btn.disabled = false; }, 10000);
            return true;
        }

        document.addEventListener('DOMContentLoaded', updateCounter);
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/Modules/Lavado/Resources/views/lavdestopreparation/create.blade.php ENDPATH**/ ?>