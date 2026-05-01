<?php
    $discharge_max_id = \Modules\Discharge\Entities\Discharge::max('id') + 1;
    $discharge_code   = 'DES-' . str_pad($discharge_max_id, 5, '0', STR_PAD_LEFT);
    $isSteam          = $discharge->machine_type == 'Autoclave';
    $isHpo            = $discharge->machine_type == 'Peroxido';
?>



<?php $__env->startSection('title', 'Envío Etiquetas Generadas'); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>">Home</a></li>
        <li class="breadcrumb-item"><a href="<?php echo e(route('labelqrs.index')); ?>">Etiquetas Generadas</a></li>
        <li class="breadcrumb-item active">Registro de envío de ciclo</li>
    </ol>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <div class="row mt-4">
            <div class="col-md-12">
                <div class="card">

                    
                    <div class="card-header d-flex align-items-center" style="gap:10px;">
                        <strong>Enviar a Ciclo &mdash; <?php echo e($discharge->reference); ?></strong>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($isSteam): ?>
                            <span class="badge badge-pill"
                                  style="background-color:#a46c05; color:#fff; font-size:.82rem; padding:5px 12px;">
                                <i class="bi bi-thermometer-high"></i> STEAM — Alta Temperatura (Autoclave)
                            </span>
                        <?php elseif($isHpo): ?>
                            <span class="badge badge-pill"
                                  style="background-color:#4990e1; color:#fff; font-size:.82rem; padding:5px 12px;">
                                <i class="bi bi-wind"></i> HPO — Baja Temperatura (Peróxido)
                            </span>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>

                    <div class="card-body">
                        <?php echo $__env->make('utils.alerts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                        <form onsubmit="return handleFormSubmit(event)" id="discharge-form"
                              action="<?php echo e(route('discharges.store')); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" name="form_token" value="<?php echo e(uniqid('discharge_', true)); ?>">

                            
                            <div class="d-flex align-items-center mb-3" style="gap:12px;">
                                <button type="submit" id="submit-btn"
                                        class="btn <?php echo e($isHpo ? 'btn-primary' : 'btn-warning'); ?>"
                                        style="<?php echo e($isHpo ? 'background-color:#4990e1; border-color:#4990e1; color:#fff;' : 'background-color:#a46c05; border-color:#a46c05; color:#fff;'); ?>">
                                    <span id="submit-text">Enviar a Ciclo</span>
                                    <i class="bi bi-check" id="submit-icon"></i>
                                </button>
                                <div id="loading-indicator" class="d-none align-items-center" style="gap:6px; display:flex;">
                                    <div class="spinner-border spinner-border-sm text-primary" role="status">
                                        <span class="sr-only">Procesando...</span>
                                    </div>
                                    <span class="ml-1 text-muted">Enviando a Descargas...</span>
                                </div>
                            </div>

                            
                            <div class="card mb-3"
                                 style="border-left: 4px solid <?php echo e($isHpo ? '#4990e1' : '#a46c05'); ?>;">
                                <div class="card-header py-2"
                                     style="background-color: <?php echo e($isHpo ? '#e8f4ff' : '#fff8ee'); ?>;">
                                    <strong>
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($isSteam): ?>
                                            <i class="bi bi-thermometer-high" style="color:#a46c05;"></i> Datos del Proceso STEAM
                                        <?php elseif($isHpo): ?>
                                            <i class="bi bi-wind" style="color:#4990e1;"></i> Datos del Proceso HPO
                                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    </strong>
                                </div>
                                <div class="card-body py-3">
                                    <div class="form-row">
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label>Referencia Descarga <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="reference"
                                                       required readonly value="<?php echo e($discharge_code); ?>">
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label>Tipo de esterilización <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="machine_type"
                                                       required readonly value="<?php echo e($discharge->machine_type); ?>">
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label>Nombre del Equipo <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="machine_name"
                                                       required readonly value="<?php echo e($discharge->machine_name); ?>">
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label>Lote del Equipo <span class="text-danger">*</span></label>
                                                <input type="number" class="form-control" name="lote_machine"
                                                       required readonly value="<?php echo e($discharge->lote_machine); ?>">
                                            </div>
                                        </div>

                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($isHpo): ?>
                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label>Lote del Agente <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" name="lote_agente"
                                                           required readonly value="<?php echo e($discharge->lote_agente); ?>">
                                                </div>
                                            </div>
                                        <?php else: ?>
                                            <input type="hidden" name="lote_agente" value="NA">
                                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label>Temperatura del Equipo <span class="text-danger">*</span></label>
                                                <input type="number" class="form-control" name="temp_machine"
                                                       required readonly value="<?php echo e($discharge->temp_machine); ?>">
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label>Tipo de Programa</label>
                                                <input type="text" class="form-control" name="type_program"
                                                       required readonly value="<?php echo e($discharge->type_program); ?>">
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label>Lote del Insumo Biológico <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="lote_biologic"
                                                       required readonly value="<?php echo e($discharge->lote_biologic); ?>">
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label>Validación Ciclo Biológico</label>
                                                <select class="form-control" name="validation_biologic" readonly>
                                                    <option value="sin_validar" selected>Sin Validar</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label>Estado del Proceso <span class="text-danger">*</span></label>
                                                <select class="form-control" name="status_cycle" required readonly>
                                                    <option value="En Curso" selected>En Curso</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label>Temperatura del Ambiente <span class="text-danger">*</span></label>
                                                <input type="number" class="form-control" name="temp_ambiente"
                                                       required readonly value="<?php echo e($discharge->temp_ambiente); ?>">
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label>Operador</label>
                                                <input class="form-control" type="text" name="operator"
                                                       value="<?php echo e(Auth::user()->name); ?>" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            
                            <div class="card mb-3"
                                 style="border-left: 4px solid <?php echo e($isHpo ? '#4990e1' : '#a46c05'); ?>;">
                                <div class="card-header py-2"
                                     style="background-color: <?php echo e($isHpo ? '#e8f4ff' : '#fff8ee'); ?>;">
                                    <strong>
                                        <i class="bi bi-cart3"></i> Instrumentos en el Proceso
                                    </strong>
                                </div>
                                <div class="card-body py-3">
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($isSteam): ?>
                                        <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('product-carttoQR', ['cartInstance' => 'discharge','data' => $discharge]);

$__key = null;

$__key ??= \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::generateKey('lw-2949243258-0', $__key);

$__html = app('livewire')->mount($__name, $__params, $__key);

echo $__html;

unset($__html);
unset($__key);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
                                    <?php elseif($isHpo): ?>
                                        <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('product-carttoQRHPO', ['cartInstance' => 'discharge_hpo','data' => $discharge]);

$__key = null;

$__key ??= \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::generateKey('lw-2949243258-1', $__key);

$__html = app('livewire')->mount($__name, $__params, $__key);

echo $__html;

unset($__html);
unset($__key);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </div>
                            </div>

                            
                            <div class="form-group">
                                <label for="note">Nota (Si se necesita)</label>
                                <textarea name="note" id="note" rows="4" class="form-control" maxlength="400"
                                          onkeyup="updateCounter()"
                                          placeholder="Escriba aquí cualquier observación adicional..."><?php echo e($discharge->note); ?></textarea>
                                <small class="text-muted">
                                    <span id="charCount"><?php echo e(strlen($discharge->note ?? '')); ?></span>/400 caracteres
                                </small>
                            </div>

                            <input type="hidden" name="labelqr_id" value="<?php echo e($labelqr_id); ?>">

                            
                            <div class="d-flex align-items-center mt-3" style="gap:12px;">
                                <button type="submit" id="submit-btn-bottom"
                                        class="btn"
                                        style="<?php echo e($isHpo ? 'background-color:#4990e1; border-color:#4990e1; color:#fff;' : 'background-color:#a46c05; border-color:#a46c05; color:#fff;'); ?>"
                                        onclick="document.getElementById('submit-btn').click(); return false;">
                                    <i class="bi bi-check"></i> Enviar a Ciclo
                                </button>
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
            const counter  = document.getElementById('charCount');
            if (textarea && counter) counter.textContent = textarea.value.length;
        }

        function handleFormSubmit(event) {
            const now              = Date.now();
            const submitBtn        = document.getElementById('submit-btn');
            const submitText       = document.getElementById('submit-text');
            const submitIcon       = document.getElementById('submit-icon');
            const loadingIndicator = document.getElementById('loading-indicator');

            if (isSubmitting) {
                event.preventDefault();
                return false;
            }
            if (submitTimestamp && (now - submitTimestamp) < SUBMIT_COOLDOWN) {
                event.preventDefault();
                return false;
            }

            isSubmitting    = true;
            submitTimestamp = now;

            submitBtn.disabled = true;
            submitBtn.classList.add('btn-secondary');
            submitBtn.classList.remove('btn-primary');
            submitBtn.style.backgroundColor = '';
            submitBtn.style.borderColor     = '';

            submitText.textContent  = 'Procesando...';
            submitIcon.className    = 'bi bi-hourglass-split';
            loadingIndicator.classList.remove('d-none');

            setTimeout(() => { if (isSubmitting) resetSubmitButton(); }, 10000);

            return true;
        }

        function resetSubmitButton() {
            const submitBtn        = document.getElementById('submit-btn');
            const submitText       = document.getElementById('submit-text');
            const submitIcon       = document.getElementById('submit-icon');
            const loadingIndicator = document.getElementById('loading-indicator');

            isSubmitting    = false;
            submitTimestamp = null;

            submitBtn.disabled = false;
            submitBtn.classList.remove('btn-secondary');
            submitBtn.classList.add('btn-primary');

            submitText.textContent = 'Enviar a Ciclo';
            submitIcon.className   = 'bi bi-check';
            loadingIndicator.classList.add('d-none');
        }

        document.addEventListener('DOMContentLoaded', function () {
            const form   = document.getElementById('discharge-form');
            const inputs = form.querySelectorAll('input[type="text"], input[type="number"], select');

            inputs.forEach(input => {
                input.addEventListener('keypress', function (e) {
                    if (e.key === 'Enter') {
                        e.preventDefault();
                        const els   = Array.from(form.elements);
                        const next  = els[els.indexOf(this) + 1];
                        if (next && next.focus) next.focus();
                    }
                });
            });

            updateCounter();
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/Modules/Labelqr/Resources/views/labelqr-discharges/create.blade.php ENDPATH**/ ?>