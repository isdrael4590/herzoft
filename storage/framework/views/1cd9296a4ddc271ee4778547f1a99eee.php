<?php $__env->startSection('title', ' Envio Etiquetas Generadas'); ?>

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
                    <div class="card-body">
                        <?php echo $__env->make('utils.alerts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <form id="discharge-form" action="<?php echo e(route('discharges.store')); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <div class="mt-3">
                                <button type="submit" class="btn btn-primary">
                                    Envío de Cíclo Esterilizador<i class="bi bi-check"></i>
                                </button>
                            </div>
                            <br>
                            <div class="form-row">
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="reference">Referencia Descarga <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="reference" required readonly
                                            value="DES">
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="machine_type">Tipo de esterilización <span
                                                class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="machine_type" required
                                                value="<?php echo e($discharge->machine_type); ?>" readonly>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="machine_name">Nombre del Equipo <span
                                                class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="machine_name" required
                                                value="<?php echo e($discharge->machine_name); ?>" readonly>
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
                                        <label for="validation_biologic">Validación Ciclo Biológico</label>
                                        <select class="form-control" name="validation_biologic" id="validation_biologic"
                                            readonly>
                                            <option
                                                <?php echo e($discharge->validation_biologic == 'sin_validar' ? 'selected' : ''); ?>

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
                                            <option <?php echo e($discharge->status_cycle == 'Cargar' ? 'selected' : ''); ?>

                                                value="En Curso">En Curso</option>
                                        </select>
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
[$__name, $__params] = $__split('product-carttoQR', ['cartInstance' => 'discharge','data' => $discharge]);

$__html = app('livewire')->mount($__name, $__params, 'lw-2949243258-0', $__slots ?? [], get_defined_vars());

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

                            <input type="hidden" name="labelqr_id" value="<?php echo e($labelqr_id); ?>">

                            <div class="mt-3">
                                <button type="submit" class="btn btn-primary">
                                    Envío de Cíclo<i class="bi bi-check"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/Modules/Labelqr/Resources/views/labelqr-discharges/create.blade.php ENDPATH**/ ?>