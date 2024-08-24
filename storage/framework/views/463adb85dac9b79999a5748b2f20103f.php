<?php $__env->startSection('title', 'Editar Etiquetas'); ?>


<?php $__env->startSection('breadcrumb'); ?>
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>">Home</a></li>
        <li class="breadcrumb-item"><a href="<?php echo e(route('labelqrs.index')); ?>">Generador Etiquetas</a></li>
        <li class="breadcrumb-item active">Editar Etiquetas</li>
    </ol>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="container-fluid mb-4">
        <div class="row">
            <div class="col-12">
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

        <div class="row mt-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <?php echo $__env->make('utils.alerts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <form id="labelqr-form" action="<?php echo e(route('labelqrs.update', $labelqr)); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('patch'); ?>
                            <?php if($labelqr->machine_type =='Autoclave'): ?>
                            <div class="form-row">
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="machine_type">Tipo Esterilización <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="machine_type" required readonly
                                        value="<?php echo e($labelqr->machine_type); ?>">
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="reference">Referencia <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="reference" required
                                            value="<?php echo e($labelqr->reference); ?>" readonly>
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="machine_name">Nombre del Equipo <span
                                                class="text-danger">*</span></label>
                                        <select class="form-control" id="machine_name" name="machine_name">
                                            <?php $__currentLoopData = \Modules\Informat\Entities\Machine::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $machines): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php if($machines->machine_type == 'Autoclave'): ?>
                                                    <option
                                                        <?php echo e($labelqr->machine_name == $machines->machine_name ? 'selected' : ''); ?>value="<?php echo e($machines->machine_name); ?>">
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
                                            value="<?php echo e($labelqr->lote_machine); ?>">
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="temp_machine">Temperatura del Equipo <span
                                                class="text-danger">*</span></label>
                                        <input type="number" class="form-control" name="temp_machine" required
                                            value="<?php echo e($labelqr->temp_machine); ?>">
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="expiration">TIPO DE PROGRAMA</label>
                                        <select class="form-control" id="type_program" name="type_program">
                                            <option <?php echo e($labelqr->type_program == '134C ESTANDAR' ? 'selected' : ''); ?>

                                                value="134C ESTANDAR">134C ESTANDAR</option>
                                            <option <?php echo e($labelqr->type_program == '121C ESTANDAR' ? 'selected' : ''); ?>

                                                value="121C ESTANDAR">121C ESTANDAR</option>
                                            <option <?php echo e($labelqr->type_program == 'CONTENEDORES' ? 'selected' : ''); ?>

                                                value="CONTENEDORES">CONTENEDORES</option>
                                            <option <?php echo e($labelqr->type_program == 'RAPID' ? 'selected' : ''); ?>

                                                value="RAPID">RAPID</option>
                                            <option <?php echo e($labelqr->type_program == 'ESPORAS' ? 'selected' : ''); ?>

                                                value="ESPORAS">ESPORAS</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="lote_biologic">Lote del Insumo Biológico <span
                                                class="text-danger">*</span></label>
                                        <select class="form-control" id="lote_biologic" name="lote_biologic" required>
                                            <?php $__currentLoopData = \Modules\Informat\Entities\Informat::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $informat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php if(
                                                    ($informat->insumo_type == 'INDICADORES BIOLOGICOS') &
                                                        ($informat->insumo_status == 'Activo') &
                                                        ($informat->insumo_temp == 'ALTA TEMPERATURA')): ?>
                                                    <option
                                                        <?php echo e($labelqr->lote_biologic == $informat->insumo_lot ? 'selected' : ''); ?>value="<?php echo e($informat->insumo_lot); ?>">
                                                        <?php echo e($informat->insumo_lot); ?></option>
                                                <?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="validation_biologic">Validación Ciclo Biológico</label>
                                        <select class="form-control" name="validation_biologic" id="validation_biologic"
                                            readonly required>
                                            <option
                                                <?php echo e($labelqr->validation_biologic == 'sin_validar' ? 'selected' : ''); ?>value="sin_validar">
                                                Sin Validar</option>
                                          
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="status_cycle">Estado del Proceso <span
                                                class="text-danger">*</span></label>
                                        <select class="form-control" name="status_cycle" id="status_cycle" required>

                                            <option <?php echo e($labelqr->status_cycle == 'Pendiente' ? 'selected' : ''); ?>

                                                value="Pendiente">Pendiente</option>
                                            <option <?php echo e($labelqr->status_cycle == 'Cargar' ? 'selected' : ''); ?>

                                                value="Cargar">Cargar</option>
                                           
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="temp_ambiente">Temperatura del Ambiente <span
                                                class="text-danger">*</span></label>
                                        <input type="number" class="form-control" name="temp_ambiente" required
                                            value="<?php echo e($labelqr->temp_ambiente); ?>">
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
                            <?php elseif($labelqr->machine_type =='Peroxido'): ?>
                            <div class="form-row">
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="machine_type">Tipo Esterilización <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="machine_type" required readonly
                                        value="<?php echo e($labelqr->machine_type); ?>">
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="reference">Referencia <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="reference" required
                                            value="<?php echo e($labelqr->reference); ?>" readonly>
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="machine_name">Nombre del Equipo <span
                                                class="text-danger">*</span></label>
                                        <select class="form-control" id="machine_name" name="machine_name">
                                            <?php $__currentLoopData = \Modules\Informat\Entities\Machine::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $machines): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php if($machines->machine_type == 'Peroxido'): ?>
                                                    <option
                                                        <?php echo e($labelqr->machine_name == $machines->machine_name ? 'selected' : ''); ?>value="<?php echo e($machines->machine_name); ?>">
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
                                            value="<?php echo e($labelqr->lote_machine); ?>">
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="temp_machine">Temperatura del Equipo <span
                                                class="text-danger">*</span></label>
                                        <select class="form-control" name="temp_machine" id="temp_machine" readonly>
                                            <option <?php echo e($labelqr->temp_machine == '52' ? 'selected' : ''); ?> value="52">
                                                52ºC</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="expiration">TIPO DE PROGRAMA</label>
                                        <select class="form-control" id="type_program" name="type_program">
                                            <option <?php echo e($labelqr->type_program == 'ESTANDAR' ? 'selected' : ''); ?>

                                                value="ESTANDAR">ESTANDAR</option>
                                            <option <?php echo e($labelqr->type_program == 'AVANZADO' ? 'selected' : ''); ?>

                                                value="AVANZADO">AVANZADO</option>
                                            <option <?php echo e($labelqr->type_program == 'RAPID' ? 'selected' : ''); ?>

                                                value="RAPID">RAPID</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="lote_biologic">Lote del Insumo Biológico <span
                                                class="text-danger">*</span></label>
                                        <select class="form-control" id="lote_biologic" name="lote_biologic" required>
                                            <?php $__currentLoopData = \Modules\Informat\Entities\Informat::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $informat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php if(
                                                    ($informat->insumo_type == 'INDICADORES BIOLOGICOS') &
                                                        ($informat->insumo_status == 'Activo') &
                                                        ($informat->insumo_temp == 'BAJA TEMPERATURA')): ?>
                                                    <option
                                                        <?php echo e($labelqr->lote_biologic == $informat->insumo_lot ? 'selected' : ''); ?>value="<?php echo e($informat->insumo_lot); ?>">
                                                        <?php echo e($informat->insumo_lot); ?></option>
                                                <?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="validation_biologic">Validación Ciclo Biológico</label>
                                        <select class="form-control" name="validation_biologic" id="validation_biologic"
                                            readonly>
                                            <option <?php echo e($labelqr->validation_biologic == 'sin_validar' ? 'selected' : ''); ?>

                                                value="sin_validar">
                                                Sin Validar</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="status_cycle">Estado del Proceso <span
                                                class="text-danger">*</span></label>
                                        <select class="form-control" name="status_cycle" id="status_cycle" required>

                                            <option <?php echo e($labelqr->status_cycle == 'Pendiente' ? 'selected' : ''); ?>

                                                value="Pendiente">Pendiente</option>
                                            <option <?php echo e($labelqr->status_cycle == 'Cargar' ? 'selected' : ''); ?>

                                                value="Cargar">Cargar</option>

                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="temp_ambiente">Temperatura del Ambiente <span
                                                class="text-danger">*</span></label>
                                        <input type="number" class="form-control" name="temp_ambiente" required
                                            value="<?php echo e($labelqr->temp_ambiente); ?>">
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
                            <?php endif; ?>
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
                            <div class="form-group">
                                <label for="note_labelqr">Nota (Si se necesita)</label>
                                <textarea name="note_labelqr" id="note_labelqr" rows="5" class="form-control"><?php echo e($labelqr->note_labelqr); ?></textarea>
                            </div>

                            <div class="mt-3">
                                <button type="submit" class="btn btn-primary">
                                    Actualización Proceso <i class="bi bi-check"></i>
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
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/Modules/Labelqr/Resources/views/labelqrs/edit.blade.php ENDPATH**/ ?>