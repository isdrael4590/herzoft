<?php $__env->startSection('title', ' Envio Produccion al Stock'); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>">Home</a></li>
        <li class="breadcrumb-item"><a href="<?php echo e(route('discharges.index')); ?>">Ciclos Liberados</a></li>
        <li class="breadcrumb-item active">Envío Al Almacén</li>
    </ol>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid">

        <div class="row mt-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <?php echo $__env->make('utils.alerts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <form id="stock -form" action="<?php echo e(route('stocks.store')); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <div class="form-row">
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="reference">Referencia <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="reference" required readonly
                                            value="STOCK">
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="machine_type">Tipo de Esterilización <span
                                                class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="machine_type" required readonly
                                                value="<?php echo e($stock->machine_type); ?>" >
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="lote_machine">Lote del Equipo <span class="text-danger">*</span></label>
                                        <input type="number" class="form-control" name="lote_machine" required
                                            value="<?php echo e($stock->lote_machine); ?>" readonly>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="machine_name">Equipo <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="machine_name" required
                                            value="<?php echo e($stock->machine_name); ?>" readonly>
                                    </div>
                                </div>
                     
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="lote_bd">Lote del Insumo Biológico <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="lote_biologic" required
                                            value="<?php echo e($stock->lote_biologic); ?>" readonly>
                                    </div>
                                </div>

                    
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="temp_ambiente">Temperatura del Ambiente <span
                                                class="text-danger">*</span></label>
                                        <input type="number" class="form-control" name="temp_ambiente" required
                                            value="<?php echo e($stock->temp_ambiente); ?>" >
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
[$__name, $__params] = $__split('product-carttoStock', ['cartInstance' => 'stock','data' => $stock]);

$__html = app('livewire')->mount($__name, $__params, 'lw-3294325886-0', $__slots ?? [], get_defined_vars());

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>

                           <div class="form-group">
                                <label for="note">Nota (Si se necesita)</label>
                                <textarea name="note" id="note" rows="5" class="form-control"><?php echo e($stock->note); ?></textarea>
                            </div>

                            <input type="hidden" name="discharge_id" value="<?php echo e($discharge_id); ?>">

                            <div class="mt-3">
                                <button type="submit" class="btn btn-primary">
                                    Envío al Almacen<i class="bi bi-check"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/Modules/Discharge/Resources/views/discharges-stock/create.blade.php ENDPATH**/ ?>