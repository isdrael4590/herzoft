<?php
    $Labelqr_max_id = \Modules\Labelqr\Entities\Labelqr::max('id') + 1;
    $labelqr_code = 'Proceso_' . str_pad($Labelqr_max_id, 5, '0', STR_PAD_LEFT);
?>


<?php $__env->startSection('title', 'Registrar Ingreso'); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>">Home</a></li>
        <li class="breadcrumb-item"><a href="<?php echo e(route('labelqrs.index')); ?>">Generador Etiquetas</a></li>
        <li class="breadcrumb-item active">Añadir STEAM Etiquetas</li>
    </ol>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid mb-4">
        <div >
            <a href="<?php echo e(route('labelqrshpo.create')); ?>" class="btn btn-primary">
                Generación de Etiquetas HPO <i class="bi bi-plus"></i>
            </a>
        </div>
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

        <div class="row mt-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <?php echo $__env->make('utils.alerts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <form id="labelqr-form" action="<?php echo e(route('labelqrs.store')); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <div class="form-row">
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="machine_type">Tipo Esterilización <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="machine_type" required readonly
                                            value="Autoclave">
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="reference">Referencia <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="reference" required readonly
                                            value="<?php echo e($labelqr_code); ?>">
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="machine_name">Nombre del Equipo <span
                                                class="text-danger">*</span></label>
                                        <select class="form-control" id="machine_name" name="machine_name">
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
                                        <label for="lote_machine">Lote del Equipo <span class="text-danger">*</span></label>
                                        <input type="number" class="form-control" name="lote_machine" required
                                            value="<?php echo e(old('lote_machine')); ?>">
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="temp_machine">Temperatura del Equipo <span
                                                class="text-danger">*</span></label>
                                        <select class="form-control" id="temp_machine" name="temp_machine">
                                            <option selected value="134"> 134ºC </option>
                                            <option value="121"> 121ºC </option>


                                        </select>
                                    </div>
                                </div>



                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="type_program">TIPO DE PROGRAMA</label>
                                        <select class="form-control" id="type_program" name="type_program">
                                            <option selected value="134C ESTANDAR"> 134C ESTANDAR </option>
                                            <option value="121C ESTANDAR"> 121C ESTANDAR </option>
                                            <option value="CONTENEDORES"> CONTENEDORES</option>
                                            <option value=" RAPID"> RAPID </option>
                                            <option value=" ESPORAS"> ESPORAS </option>

                                        </select>
                                    </div>
                                </div>


                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="lote_biologic">Lote Insumo Biológico <span
                                                class="text-danger">*</span></label>

                                        <select class="form-control" id="lote_biologic" name="lote_biologic" required>
                                            <?php $__currentLoopData = \Modules\Informat\Entities\Informat::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $informat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php if(
                                                    ($informat->insumo_type == 'INDICADORES BIOLOGICOS') &
                                                        ($informat->insumo_status == 'Activo') &
                                                        ($informat->insumo_temp == 'ALTA TEMPERATURA')): ?>
                                                    <option value="<?php echo e($informat->insumo_lot); ?>">
                                                        <?php echo e($informat->insumo_lot); ?></option>
                                                <?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="validation_biologic">Validación Ciclo Biologic</label>
                                        <select class="form-control" name="validation_biologic" id="validation_biologic"
                                            readonly>
                                            <option value="sin_validar" selected>Sin Validar</option>
                                            
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="status_cycle">Estado del Proceso <span
                                                class="text-danger">*</span></label>
                                        <select class="form-control" name="status_cycle" id="status_cycle" required>
                                            <option value="Pendiente">Pendiente</option>
                                            <option selected value="Cargar">Cargar</option>

                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="temp_ambiente">Temperatura del Ambiente <span
                                                class="text-danger">*</span></label>
                                        <input type="number" class="form-control" name="temp_ambiente" required
                                            value="<?php echo e(old('temp_ambiente')); ?>">
                                    </div>
                                </div>


                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label>Operador</label>
                                        <input class="form-control" type="text" id="operator" name="operator"
                                            placeholder= "<?php echo e(Auth::user()->name); ?>" value="<?php echo e(Auth::user()->name); ?>">
                                    </div>
                                </div>
                            </div>


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

                            <div class="form-row">

                            </div>
                            <div class="form-group">
                                <label for="note_labelqr">Nota (Si se necesita)</label>
                                <textarea name="note_labelqr" id="note_labelqr" rows="5" class="form-control"></textarea>
                            </div>

                            <div class="mt-3">
                                <button type="submit" class="btn btn-primary">
                                    Guardar proceso <i class="bi bi-sd-card"></i>
                                </button>

                            </div>

                            <div class="mt-3">

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('page_scripts'); ?>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/Modules/Labelqr/Resources/views/labelqrs/create.blade.php ENDPATH**/ ?>