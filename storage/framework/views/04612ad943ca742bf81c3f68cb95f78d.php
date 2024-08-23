<?php $__env->startSection('title', 'Liberar Ciclo'); ?>


<?php $__env->startSection('breadcrumb'); ?>
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>">Home</a></li>
        <li class="breadcrumb-item"><a href="<?php echo e(route('discharges.index')); ?>">Descargar Ciclo</a></li>
        <li class="breadcrumb-item active">Liberar</li>
    </ol>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="container-fluid mb-4">
        <div class="row mt-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <?php echo $__env->make('utils.alerts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <form id="discharge-form" action="<?php echo e(route('discharges.update', $discharge)); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('patch'); ?>
                            <div class="form-row">
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="reference">Ref.Descarga <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="reference" required
                                            value="<?php echo e($discharge->reference); ?>" readonly>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="reference">Ref.Proceso <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="labelqr_id" required 
                                            value="<?php echo e($discharge->labelqr_id); ?>" readonly>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="machine_type">Tipo de Esterilización <span
                                                class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="machine_type" required readonly
                                                value="<?php echo e($discharge->machine_type); ?>" >
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="machine_name">Nombre del Equipo <span
                                                class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="machine_name" required readonly
                                                value="<?php echo e($discharge->machine_name); ?>" >
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="lote_machine">Lote del Equipo <span class="text-danger">*</span></label>
                                        <input type="number" class="form-control" name="lote_machine" required
                                            value="<?php echo e($discharge->lote_machine); ?>" readonly>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="temp_machine">Temperatura del Equipo <span
                                                class="text-danger">*</span></label>
                                        <input type="number" class="form-control" name="temp_machine" required
                                            value="<?php echo e($discharge->temp_machine); ?>" readonly>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="type_program">TIPO DE PROGRAMA</label>
                                        <input type="text" class="form-control" name="type_program" required
                                        value="<?php echo e($discharge->type_program); ?>" readonly>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="lote_bd">Lote del Insumo Biológico <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="lote_biologic" required
                                            value="<?php echo e($discharge->lote_biologic); ?>" readonly>
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="temp_ambiente">Temperatura del Ambiente <span
                                                class="text-danger">*</span></label>
                                        <input type="number" class="form-control" name="temp_ambiente" required
                                            value="<?php echo e($discharge->temp_ambiente); ?>" readonly>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="validation_biologic">Validación Ciclo Biológico</label>
                                        <select class="form-control" name="validation_biologic" id="validation_biologic" >
                                            <option <?php echo e($discharge->validation_biologic == 'sin_validar' ? 'selected' : ''); ?>

                                                value="Sin Validar" >
                                                Sin Validar</option>
                                           <option <?php echo e($discharge->validation_biologic == 'Correcto' ? 'selected' : ''); ?>

                                                value="Correcto">
                                                Correcto</option>
                                            <option <?php echo e($discharge->validation_biologic == 'Falla' ? 'selected' : ''); ?>

                                                value="Falla">
                                                Falla</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="status_cycle">Estado del Proceso <span
                                                class="text-danger">*</span></label>
                                        <select class="form-control" name="status_cycle" id="status_cycle" required >
                                            
                                            <option <?php echo e($discharge->status_cycle == 'Pendiente' ? 'selected' : ''); ?> value="Pendiente">Pendiente</option>
                                            <option <?php echo e($discharge->status_cycle == 'En Curso' ? 'selected' : ''); ?>

                                                value="En Curso">En curso</option>
                                            
                                            <option <?php echo e($discharge->status_cycle == 'Ciclo Aprobado' ? 'selected' : ''); ?> value="Ciclo Aprobado">Ciclo Aprobado</option>
                                            <option <?php echo e($discharge->status_cycle == 'Ciclo Falla' ? 'selected' : ''); ?> value="Ciclo Falla">Ciclo Falla</option> 
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label>Operador Descarga</label>
                                        <input class="form-control" type="text" id="operator" name="operator"
                                            placeholder= "<?php echo e(Auth::user()->name); ?>" value="<?php echo e(Auth::user()->name); ?>">
                                    </div>
                                </div>
                              

                            </div>


                            <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('product-carttoDES', ['cartInstance' => 'discharge','data' => $discharge]);

$__html = app('livewire')->mount($__name, $__params, 'lw-2123744569-0', $__slots ?? [], get_defined_vars());

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>



                            <div class="form-group">
                                <label for="note">Nota (Si se necesita)</label>
                                <textarea name="note" id="note" rows="5" class="form-control"><?php echo e($discharge->note); ?></textarea>
                            </div>

                            <div class="mt-3">
                                <button type="submit" class="btn btn-primary">
                                    Liberar Proceso <i class="bi bi-check"></i>
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

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/Modules/Discharge/Resources/views/discharges/edit.blade.php ENDPATH**/ ?>