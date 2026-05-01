<?php $__env->startSection('title', 'Envío a Preparación desde Lavado'); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>">Home</a></li>
        <li class="breadcrumb-item"><a href="<?php echo e(route('lavados.index')); ?>">Lavados</a></li>
        <li class="breadcrumb-item active">Envío área preparación</li>
    </ol>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <div class="row mt-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <?php echo $__env->make('utils.alerts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                        <form id="preparation-form" action="<?php echo e(route('preparations.store')); ?>" method="POST"
                            onsubmit="return handleFormSubmit(event)">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" name="form_token" value="<?php echo e(uniqid('lavado_preparation_', true)); ?>">

                            <div class="form-row">
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="reference">Referencia <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="reference" required readonly
                                            value="PRE">
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label>Operador</label>
                                        <input class="form-control" type="text" id="operator" name="operator"
                                            placeholder="<?php echo e(Auth::user()->name); ?>" value="<?php echo e(Auth::user()->name); ?>"
                                            readonly>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <h6 class="font-weight-bold text-primary">
                                    <i class="bi bi-box-arrow-in-right mr-1"></i>
                                    Va a Preparación (desde Lavado)
                                    <span class="badge badge-primary ml-1"><?php echo e(Cart::instance('preparation')->count()); ?></span>
                                </h6>
                            </div>

                            <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('product-carttoPRE', ['cartInstance' => 'preparation','data' => $preparation]);

$__html = app('livewire')->mount($__name, $__params, 'lw-2666229801-0', $__slots ?? [], get_defined_vars());

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>

                            <div class="form-group mt-3">
                                <label for="note">Nota (Si se necesita)</label>
                                <textarea name="note" id="note" rows="5" class="form-control" maxlength="400"
                                    onkeyup="updateCounter()"><?php echo e($preparation->note); ?></textarea>
                                <small class="text-muted">
                                    <span id="charCount"><?php echo e(strlen($preparation->note ?? '')); ?></span>/400 caracteres
                                </small>
                            </div>

                            <input type="hidden" name="lavado_id" value="<?php echo e($lavado_id); ?>">

                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <button type="submit" class="btn btn-primary" id="submit-btn">
                                    <span id="submit-text">Enviar a preparación</span>
                                    <i class="bi bi-check" id="submit-icon"></i>
                                </button>

                                <div id="loading-indicator" class="d-none">
                                    <div class="spinner-border spinner-border-sm text-primary" role="status">
                                        <span class="sr-only">Procesando...</span>
                                    </div>
                                    <span class="ml-2">Enviando a preparación...</span>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
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
            const textarea = document.getElementById('note');
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
            submitIcon.className = 'bi bi-hourglass-split';
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
            submitText.textContent = 'Enviar a preparación';
            submitIcon.className = 'bi bi-check';
            loadingIndicator.classList.add('d-none');
        }

        document.addEventListener('DOMContentLoaded', function () {
            const form = document.getElementById('preparation-form');
            const inputs = form.querySelectorAll('input[type="text"], select');

            inputs.forEach(input => {
                input.addEventListener('keypress', function (e) {
                    if (e.key === 'Enter') {
                        e.preventDefault();
                        const formElements = Array.from(form.elements);
                        const nextElement = formElements[formElements.indexOf(this) + 1];
                        if (nextElement && nextElement.focus) nextElement.focus();
                    }
                });
            });

            updateCounter();
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/Modules/Lavado/Resources/views/lavado-preparations/create.blade.php ENDPATH**/ ?>