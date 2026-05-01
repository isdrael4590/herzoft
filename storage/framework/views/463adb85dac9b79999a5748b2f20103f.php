<?php $__env->startSection('title', 'Editar Proceso — ' . $labelqr->reference); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>">Home</a></li>
        <li class="breadcrumb-item"><a href="<?php echo e(route('labelqrs.index')); ?>">Generador Etiquetas</a></li>
        <li class="breadcrumb-item active">Editar Proceso</li>
    </ol>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid mb-4">

        <?php
            $isSteam = $labelqr->machine_type == 'Autoclave';
            $isHpo   = $labelqr->machine_type == 'Peroxido';
            $headerBg    = $isSteam ? 'bg-warning text-dark' : 'bg-info text-white';
            $headerIcon  = $isSteam ? 'bi-thermometer-sun' : 'bi-droplet-half';
            $headerTitle = $isSteam
                ? 'Editar Proceso STEAM — Alta Temperatura (Autoclave)'
                : 'Editar Proceso HPO — Baja Temperatura (Peróxido)';
        ?>

        <div class="row">
            <div class="col-md-12">
                <div class="card shadow-sm">
                    <div class="card-header <?php echo e($headerBg); ?> d-flex align-items-center">
                        <i class="bi <?php echo e($headerIcon); ?> mr-2" style="font-size:1.3rem;"></i>
                        <div>
                            <h5 class="mb-0"><?php echo e($headerTitle); ?></h5>
                            <small class="opacity-75">Referencia: <strong><?php echo e($labelqr->reference); ?></strong></small>
                        </div>
                    </div>
                    <div class="card-body">
                        <?php echo $__env->make('utils.alerts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                        <form id="labelqr-form" action="<?php echo e(route('labelqrs.update', $labelqr)); ?>" method="POST"
                            onsubmit="return handleFormSubmit(event)">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('patch'); ?>
                            <input type="hidden" name="form_token" value="<?php echo e(uniqid('labelqr_edit_', true)); ?>">

                            
                            <?php if($isSteam): ?>

                                
                                <div class="card mb-4" style="border-left: 4px solid #ffc107;">
                                    <div class="card-header bg-light py-2">
                                        <strong><i class="bi bi-gear mr-1"></i> Datos del Equipo</strong>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-row">
                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label>Tipo Esterilización <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" name="machine_type"
                                                        required readonly value="<?php echo e($labelqr->machine_type); ?>">
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label>Referencia <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" name="reference"
                                                        required readonly value="<?php echo e($labelqr->reference); ?>">
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label>Nombre del Equipo <span class="text-danger">*</span></label>
                                                    <select class="form-control" name="machine_name">
                                                        <?php $__currentLoopData = \Modules\Informat\Entities\Machine::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $machines): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <?php if($machines->machine_type == 'Autoclave'): ?>
                                                                <option value="<?php echo e($machines->machine_name); ?>"
                                                                    <?php echo e($labelqr->machine_name == $machines->machine_name ? 'selected' : ''); ?>>
                                                                    <?php echo e($machines->machine_name); ?>

                                                                </option>
                                                            <?php endif; ?>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label>Lote del Equipo <span class="text-danger">*</span></label>
                                                    <input type="number" class="form-control" name="lote_machine"
                                                        required value="<?php echo e($labelqr->lote_machine); ?>">
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label>Temperatura del Equipo <span class="text-danger">*</span></label>
                                                    <select class="form-control" name="temp_machine">
                                                        <option <?php echo e($labelqr->temp_machine == '134' ? 'selected' : ''); ?> value="134">134ºC</option>
                                                        <option <?php echo e($labelqr->temp_machine == '121' ? 'selected' : ''); ?> value="121">121ºC</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label>Temperatura del Ambiente <span class="text-danger">*</span></label>
                                                    <input type="number" class="form-control" name="temp_ambiente"
                                                        required value="<?php echo e($labelqr->temp_ambiente); ?>" min="1" step="0.1">
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
                                                    <select class="form-control" name="type_program">
                                                        <?php $__currentLoopData = \Modules\Informat\Entities\Proceso::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $proceso): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <?php if($proceso->proceso_type == 'ALTA TEMPERATURA'): ?>
                                                                <option
                                                                    <?php echo e($labelqr->type_program == $proceso->proceso_name ? 'selected' : ''); ?>

                                                                    value="<?php echo e($proceso->proceso_name); ?>">
                                                                    <?php echo e($proceso->proceso_name); ?></option>
                                                            <?php endif; ?>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label>Lote del Insumo Biológico <span class="text-danger">*</span></label>
                                                    <select class="form-control" name="lote_biologic" required>
                                                        <?php $__currentLoopData = \Modules\Informat\Entities\Informat::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $informat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <?php if(
                                                                $informat->insumo_type == 'INDICADORES BIOLOGICOS' &&
                                                                $informat->insumo_status == 'Activo' &&
                                                                $informat->insumo_temp == 'ALTA TEMPERATURA'): ?>
                                                                <option
                                                                    <?php echo e($labelqr->lote_biologic == $informat->insumo_lot ? 'selected' : ''); ?>

                                                                    value="<?php echo e($informat->insumo_lot); ?>">
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
                                                        <option <?php echo e($labelqr->validation_biologic == 'sin_validar' ? 'selected' : ''); ?> value="sin_validar">Sin Validar</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label>Estado del Proceso <span class="text-danger">*</span></label>
                                                    <select class="form-control" name="status_cycle" required>
                                                        <option <?php echo e($labelqr->status_cycle == 'Pendiente' ? 'selected' : ''); ?> value="Pendiente">Pendiente</option>
                                                        <option <?php echo e($labelqr->status_cycle == 'Cargar' ? 'selected' : ''); ?> value="Cargar">Cargar</option>
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
                                        <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('search-producttoQR', []);

$__html = app('livewire')->mount($__name, $__params, 'lw-1728631701-0', $__slots ?? [], get_defined_vars());

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
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
[$__name, $__params] = $__split('product-carttoQR', ['cartInstance' => 'labelqr','data' => $labelqr]);

$__html = app('livewire')->mount($__name, $__params, 'lw-1728631701-1', $__slots ?? [], get_defined_vars());

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
                                    </div>
                                </div>

                            
                            <?php elseif($isHpo): ?>

                                
                                <div class="card mb-4" style="border-left: 4px solid #17a2b8;">
                                    <div class="card-header bg-light py-2">
                                        <strong><i class="bi bi-gear mr-1"></i> Datos del Equipo</strong>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-row">
                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label>Tipo Esterilización <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" name="machine_type"
                                                        required readonly value="<?php echo e($labelqr->machine_type); ?>">
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label>Referencia <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" name="reference"
                                                        required readonly value="<?php echo e($labelqr->reference); ?>">
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label>Nombre del Equipo <span class="text-danger">*</span></label>
                                                    <select class="form-control" name="machine_name">
                                                        <?php $__currentLoopData = \Modules\Informat\Entities\Machine::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $machines): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <?php if($machines->machine_type == 'Peroxido'): ?>
                                                                <option value="<?php echo e($machines->machine_name); ?>"
                                                                    <?php echo e($labelqr->machine_name == $machines->machine_name ? 'selected' : ''); ?>>
                                                                    <?php echo e($machines->machine_name); ?>

                                                                </option>
                                                            <?php endif; ?>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label>Lote del Equipo <span class="text-danger">*</span></label>
                                                    <input type="number" class="form-control" name="lote_machine"
                                                        required value="<?php echo e($labelqr->lote_machine); ?>">
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label>Temperatura del Equipo <span class="text-danger">*</span></label>
                                                    <select class="form-control" name="temp_machine">
                                                        <option <?php echo e($labelqr->temp_machine == '52' ? 'selected' : ''); ?> value="52">52ºC</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label>Temperatura del Ambiente <span class="text-danger">*</span></label>
                                                    <input type="number" class="form-control" name="temp_ambiente"
                                                        required value="<?php echo e($labelqr->temp_ambiente); ?>" min="1" step="0.1">
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

                                
                                <div class="card mb-4" style="border-left: 4px solid #ffc107;">
                                    <div class="card-header bg-light py-2">
                                        <strong><i class="bi bi-droplet mr-1"></i> Insumos del Proceso</strong>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-row">
                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label>Lote Agente Esterilizante <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" name="lote_agente"
                                                        required value="<?php echo e($labelqr->lote_agente); ?>" readonly>
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label>Tipo de Programa <span class="text-danger">*</span></label>
                                                    <select class="form-control" name="type_program">
                                                        <?php $__currentLoopData = \Modules\Informat\Entities\Proceso::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $proceso): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <?php if($proceso->proceso_type == 'BAJA TEMPERATURA'): ?>
                                                                <option
                                                                    <?php echo e($labelqr->type_program == $proceso->proceso_name ? 'selected' : ''); ?>

                                                                    value="<?php echo e($proceso->proceso_name); ?>">
                                                                    <?php echo e($proceso->proceso_name); ?></option>
                                                            <?php endif; ?>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label>Lote del Insumo Biológico <span class="text-danger">*</span></label>
                                                    <select class="form-control" name="lote_biologic" required>
                                                        <?php $__currentLoopData = \Modules\Informat\Entities\Informat::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $informat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <?php if(
                                                                $informat->insumo_type == 'INDICADORES BIOLOGICOS' &&
                                                                $informat->insumo_status == 'Activo' &&
                                                                $informat->insumo_temp == 'BAJA TEMPERATURA'): ?>
                                                                <option
                                                                    <?php echo e($labelqr->lote_biologic == $informat->insumo_lot ? 'selected' : ''); ?>

                                                                    value="<?php echo e($informat->insumo_lot); ?>">
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
                                                        <option <?php echo e($labelqr->validation_biologic == 'sin_validar' ? 'selected' : ''); ?> value="sin_validar">Sin Validar</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label>Estado del Proceso <span class="text-danger">*</span></label>
                                                    <select class="form-control" name="status_cycle" required>
                                                        <option <?php echo e($labelqr->status_cycle == 'Pendiente' ? 'selected' : ''); ?> value="Pendiente">Pendiente</option>
                                                        <option <?php echo e($labelqr->status_cycle == 'Cargar' ? 'selected' : ''); ?> value="Cargar">Cargar</option>
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
                                        <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('search-producttoQRHPO', []);

$__html = app('livewire')->mount($__name, $__params, 'lw-1728631701-2', $__slots ?? [], get_defined_vars());

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
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
[$__name, $__params] = $__split('product-carttoQRHPO', ['cartInstance' => 'labelqrhpo','data' => $labelqr]);

$__html = app('livewire')->mount($__name, $__params, 'lw-1728631701-3', $__slots ?? [], get_defined_vars());

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
                                    </div>
                                </div>

                            <?php endif; ?>

                            
                            <div class="form-group">
                                <label for="note_labelqr">Nota (Opcional)</label>
                                <textarea name="note_labelqr" id="note_labelqr" rows="4" class="form-control"
                                    maxlength="400" onkeyup="updateCounter()"
                                    placeholder="Escriba aquí cualquier observación adicional..."><?php echo e($labelqr->note_labelqr); ?></textarea>
                                <small class="text-muted">
                                    <span id="charCount"><?php echo e(strlen($labelqr->note_labelqr ?? '')); ?></span>/400 caracteres
                                </small>
                            </div>

                            <div class="d-flex justify-content-between align-items-center">
                                <button type="submit" class="btn btn-primary btn-lg" id="submit-btn">
                                    <span id="submit-text"><i class="bi bi-check mr-1"></i> Actualizar Proceso</span>
                                </button>
                                <div id="loading-indicator" class="d-none">
                                    <div class="spinner-border spinner-border-sm text-primary" role="status">
                                        <span class="sr-only">Procesando...</span>
                                    </div>
                                    <span class="ml-2">Actualizando proceso...</span>
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
            submitText.innerHTML = '<i class="bi bi-hourglass-split mr-1"></i> Actualizando...';
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
            submitText.innerHTML = '<i class="bi bi-check mr-1"></i> Actualizar Proceso';
            loadingIndicator.classList.add('d-none');
        }

        document.addEventListener('DOMContentLoaded', function () {
            updateCounter();
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/Modules/Labelqr/Resources/views/labelqrs/edit.blade.php ENDPATH**/ ?>