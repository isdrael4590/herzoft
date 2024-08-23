<?php $__env->startSection('title', 'Editar Ingreso'); ?>


<?php $__env->startSection('breadcrumb'); ?>
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>">Home</a></li>
        <li class="breadcrumb-item"><a href="<?php echo e(route('receptions.index')); ?>">Recepción Instrumental</a></li>
        <li class="breadcrumb-item active">Editar</li>
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
[$__name, $__params] = $__split('search-product', []);

$__html = app('livewire')->mount($__name, $__params, 'lw-2009328524-0', $__slots ?? [], get_defined_vars());

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
                        <form id="reception-form" action="<?php echo e(route('receptions.update', $reception)); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('patch'); ?>
                            <div class="form-row">
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="reference">Referencia <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="reference" required value="<?php echo e($reception->reference); ?>" readonly>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label>Área Procedente</label>
                                        <input class="form-control" type="text" id="area" name="area"
                                        value="<?php echo e($reception->area); ?>" required>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label>Persona que entrega</label>
                                        <input class="form-control" type="text" id="delivery_staff" name="delivery_staff"
                                        value="<?php echo e($reception->delivery_staff); ?>" required>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="from-group">
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
[$__name, $__params] = $__split('product-cart', ['cartInstance' => 'reception','data' => $reception]);

$__html = app('livewire')->mount($__name, $__params, 'lw-2009328524-1', $__slots ?? [], get_defined_vars());

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>

                            <div class="form-row">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="status">Estado de Ingreso <span class="text-danger">*</span></label>
                                        <select class="form-control" name="status" id="status" required>
                                            <option <?php echo e($reception->status == 'Pendiente' ? 'selected' : ''); ?> value="Pendiente">Pendiente</option>
                                            <option <?php echo e($reception->status == 'Registrado' ? 'selected' : ''); ?> value="Registrado">Registrado</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="note">Nota (Si se necesita)</label>
                                <textarea name="note" id="note" rows="5" class="form-control"><?php echo e($reception->note); ?></textarea>
                            </div>

                            <div class="mt-3">
                                <button type="submit" class="btn btn-primary">
                                    Actualización Ingreso <i class="bi bi-check"></i>
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

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/Modules/Reception/Resources/views/receptions/edit.blade.php ENDPATH**/ ?>