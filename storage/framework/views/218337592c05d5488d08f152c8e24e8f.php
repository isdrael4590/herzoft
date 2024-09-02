<?php $__env->startSection('title', 'Registrar Despacho'); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>">Home</a></li>
        <li class="breadcrumb-item"><a href="<?php echo e(route('expeditions.index')); ?>">Generador Despacho</a></li>
        <li class="breadcrumb-item active">Añadir</li>
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
[$__name, $__params] = $__split('search-producttoEXP', []);

$__html = app('livewire')->mount($__name, $__params, 'lw-3823457683-0', $__slots ?? [], get_defined_vars());

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
                        <form id="expedition-form" action="<?php echo e(route('expeditions.update',$expedition)); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('patch'); ?>
                            <div class="form-row">
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="reference">Referencia <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="reference" required 
                                            value="<?php echo e($expedition->reference); ?>" readonly>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="status_expedition">Estado del Despacho <span
                                                class="text-danger">*</span></label>
                                        <select class="form-control" name="status_expedition" id="status_expedition"
                                            required>
                                            <option <?php echo e($expedition->status_expedition == 'Despachado' ? 'selected' : ''); ?>

                                                value="Despachado">
                                                Despachar</option>
                                            <option <?php echo e($expedition->status_expedition == 'Pendiente' ? 'selected' : ''); ?>

                                                value="Pendiente">
                                                Pendiente</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="temp_ambiente">Temperatura del Ambiente <span
                                                class="text-danger">*</span></label>
                                        <input type="number" class="form-control" name="temp_ambiente" required
                                        value="<?php echo e($expedition->temp_ambiente); ?>" >
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="area_expedition">Area de expedición <span
                                                class="text-danger">*</span></label>
                                        <select class="form-control" id="area_expedition" name="area_expedition" required>
                                            <?php $__currentLoopData = \Modules\Informat\Entities\Area::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $area): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option <?php echo e($expedition->area_expedition == $area->area_name ? 'selected' : ''); ?> value="<?php echo e($area->area_name); ?>">
                                                    <?php echo e($area->area_name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="staff_expedition">Persona quién Recibe <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="staff_expedition" required
                                        value="<?php echo e($expedition->staff_expedition); ?>" >
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
                    </div>

                    <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('product-carttoEXP', ['cartInstance' => 'expedition']);

$__html = app('livewire')->mount($__name, $__params, 'lw-3823457683-1', $__slots ?? [], get_defined_vars());

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
                        <label for="note_expedition">Nota (Si se necesita)</label>
                        <textarea name="note_expedition" id="note_expedition" rows="5" class="form-control"></textarea>
                    </div>

                    <div class="mt-3">
                        <button type="submit" class="btn btn-primary">
                            Actualizar despacho <i class="bi bi-check"></i>
                        </button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('page_scripts'); ?>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/Modules/Expedition/Resources/views/expeditions/edit.blade.php ENDPATH**/ ?>