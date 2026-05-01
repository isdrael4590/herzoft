<?php
    $Labelqr_max_id = \Modules\Labelqr\Entities\Labelqr::max('id') + 1;
    $labelqr_code = 'Proceso_' . str_pad($Labelqr_max_id, 5, '0', STR_PAD_LEFT);
?>


<?php $__env->startSection('title', 'Registrar Proceso STEAM - Alta Temperatura'); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>">Home</a></li>
        <li class="breadcrumb-item"><a href="<?php echo e(route('labelqrs.index')); ?>">Generador Etiquetas</a></li>
        <li class="breadcrumb-item active">Añadir STEAM / Alta Temperatura</li>
    </ol>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid mb-4">

        
        <div class="mb-3">
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create_labelqrshpo')): ?>
                <a href="<?php echo e(route('labelqrshpo.create')); ?>" class="btn btn-info">
                    <i class="bi bi-droplet-half mr-1"></i> Cambiar a HPO / Baja Temperatura
                </a>
            <?php endif; ?>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card shadow-sm">
                    <div class="card-header bg-warning text-dark d-flex align-items-center">
                        <i class="bi bi-thermometer-sun mr-2" style="font-size:1.3rem;"></i>
                        <div>
                            <h5 class="mb-0">Nuevo Proceso STEAM — Alta Temperatura (Autoclave)</h5>
                            <small class="opacity-75">Referencia: <strong><?php echo e($labelqr_code); ?></strong></small>
                        </div>
                    </div>
                    <div class="card-body">
                        <?php echo $__env->make('utils.alerts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                        <form id="labelqr-form" action="<?php echo e(route('labelqrs.store')); ?>" method="POST"
                            onsubmit="return handleFormSubmit(event)">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" name="form_token" value="<?php echo e(uniqid('labelqr_', true)); ?>">

                            
                            <div class="card mb-4" style="border-left: 4px solid #ffc107;">
                                <div class="card-header bg-light py-2">
                                    <strong><i class="bi bi-gear mr-1"></i> Datos del Equipo</strong>
                                </div>
                                <div class="card-body">
                                    <div class="form-row">
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label>Tipo Esterilización <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="machine_type" required readonly
                                                    value="Autoclave">
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label>Referencia <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="reference" required readonly
                                                    value="<?php echo e($labelqr_code); ?>">
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label>Nombre del Equipo <span class="text-danger">*</span></label>
                                                <select class="form-control" name="machine_name">
                                                    <?php $__currentLoopData = \Modules\Informat\Entities\Machine::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $machines): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <?php if($machines->machine_type == 'Autoclave'): ?>
                                                            <option value="<?php echo e($machines->machine_name); ?>">
                                                                <?php echo e($machines->machine_name); ?></option>
                                                        <?php endif; ?>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label>Lote del Equipo <span class="text-danger">*</span></label>
                                                <input type="number" class="form-control" name="lote_machine" required
                                                    value="<?php echo e(old('lote_machine')); ?>">
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label>Temperatura del Equipo <span class="text-danger">*</span></label>
                                                <select class="form-control" name="temp_machine">
                                                    <option selected value="134"> 134ºC </option>
                                                    <option value="121"> 121ºC </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label>Temperatura del Ambiente <span class="text-danger">*</span></label>
                                                <input type="number" class="form-control" name="temp_ambiente" required
                                                    value="<?php echo e(old('temp_ambiente')); ?>" min="1" step="0.1">
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

                            
                            <div class="card mb-4" style="border-left: 4px solid #dc3545;">
                                <div class="card-header bg-light py-2">
                                    <strong><i class="bi bi-thermometer mr-1"></i> Insumos del Proceso</strong>
                                </div>
                                <div class="card-body">
                                    <div class="form-row">
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label>Tipo de Programa <span class="text-danger">*</span></label>
                                                <select class="form-control" name="type_program" required>
                                                    <?php $__currentLoopData = \Modules\Informat\Entities\Proceso::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $proceso): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <?php if($proceso->proceso_type == 'ALTA TEMPERATURA'): ?>
                                                            <option value="<?php echo e($proceso->proceso_name); ?>">
                                                                <?php echo e($proceso->proceso_name); ?></option>
                                                        <?php endif; ?>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label>Lote Insumo Biológico <span class="text-danger">*</span></label>
                                                <select class="form-control" name="lote_biologic" required>
                                                    <?php $__currentLoopData = \Modules\Informat\Entities\Informat::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $informat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <?php if(
                                                            $informat->insumo_type == 'INDICADORES BIOLOGICOS' &&
                                                            $informat->insumo_status == 'Activo' &&
                                                            $informat->insumo_temp == 'ALTA TEMPERATURA'): ?>
                                                            <option value="<?php echo e($informat->insumo_lot); ?>">
                                                                <?php echo e($informat->insumo_lot); ?></option>
                                                        <?php endif; ?>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
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
                                                <select class="form-control" name="status_cycle" required>
                                                    <option value="Pendiente">Pendiente</option>
                                                    <option selected value="Cargar">Cargar</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            
                            <div class="card mb-4" style="border-left: 4px solid #007bff;">
                                <div class="card-header bg-light py-2">
                                    <strong><i class="bi bi-search mr-1"></i> Buscar y Agregar Instrumentos</strong>
                                    <small class="text-muted ml-2">Use ↑↓ para navegar, Enter para seleccionar</small>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('search-producttoQR', []);

$__html = app('livewire')->mount($__name, $__params, 'lw-3663985633-0', $__slots ?? [], get_defined_vars());

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            
                            <div class="card mb-4" style="border-left: 4px solid #28a745;">
                                <div class="card-header bg-light py-2">
                                    <strong><i class="bi bi-cart3 mr-1"></i> Instrumentos en el Proceso</strong>
                                </div>
                                <div class="card-body p-0">
                                    <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('product-carttoQR', ['cartInstance' => 'labelqr']);

$__html = app('livewire')->mount($__name, $__params, 'lw-3663985633-1', $__slots ?? [], get_defined_vars());

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
                                </div>
                            </div>

                            
                            <div class="form-group">
                                <label for="note_labelqr">Nota (Opcional)</label>
                                <textarea name="note_labelqr" id="note_labelqr" rows="4" class="form-control"
                                    maxlength="400" onkeyup="updateCounter()"
                                    placeholder="Escriba aquí cualquier observación adicional..."><?php echo e(old('note_labelqr')); ?></textarea>
                                <small class="text-muted">
                                    <span id="charCount"><?php echo e(strlen(old('note_labelqr', ''))); ?></span>/400 caracteres
                                </small>
                            </div>

                            <div class="d-flex justify-content-between align-items-center">
                                <button type="submit" class="btn btn-primary btn-lg" id="submit-btn">
                                    <span id="submit-text"><i class="bi bi-sd-card mr-1"></i> Guardar Proceso STEAM</span>
                                </button>
                                <div id="loading-indicator" class="d-none">
                                    <div class="spinner-border spinner-border-sm text-primary" role="status">
                                        <span class="sr-only">Procesando...</span>
                                    </div>
                                    <span class="ml-2">Guardando proceso...</span>
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
            const textarea = document.getElementById('note_labelqr');
            const counter = document.getElementById('charCount');
            if (textarea && counter) {
                counter.textContent = textarea.value.length;
            }
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
            const submitText = document.getElementById('submit-text');
            const loadingIndicator = document.getElementById('loading-indicator');

            submitBtn.disabled = true;
            submitBtn.classList.replace('btn-primary', 'btn-secondary');
            submitText.innerHTML = '<i class="bi bi-hourglass-split mr-1"></i> Procesando...';
            loadingIndicator.classList.remove('d-none');

            setTimeout(() => {
                if (isSubmitting) resetSubmitButton();
            }, 10000);

            return true;
        }

        function resetSubmitButton() {
            isSubmitting = false;
            submitTimestamp = null;
            const submitBtn = document.getElementById('submit-btn');
            const submitText = document.getElementById('submit-text');
            const loadingIndicator = document.getElementById('loading-indicator');
            submitBtn.disabled = false;
            submitBtn.classList.replace('btn-secondary', 'btn-primary');
            submitText.innerHTML = '<i class="bi bi-sd-card mr-1"></i> Guardar Proceso STEAM';
            loadingIndicator.classList.add('d-none');
        }

        document.addEventListener('DOMContentLoaded', function () {
            updateCounter();
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/Modules/Labelqr/Resources/views/labelqrs/create.blade.php ENDPATH**/ ?>