<?php $__env->startSection('title', 'Editar Prelavado'); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>">Home</a></li>
        <li class="breadcrumb-item"><a href="<?php echo e(route('prelavado.index')); ?>">Instrumental a Lavar</a></li>
        <li class="breadcrumb-item active">Editar Ingreso #<?php echo e($reception_id); ?></li>
    </ol>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Editar Prelavado — Ingreso #<?php echo e($reception_id); ?>

                        <small class="text-muted">(<?php echo e($detalles->first()->reception_reference); ?>)</small>
                    </h5>
                    <a href="<?php echo e(route('prelavado.index')); ?>" class="btn btn-sm btn-secondary">Volver</a>
                </div>
                <div class="card-body">
                    <form action="<?php echo e(route('prelavado.update', $reception_id)); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('PUT'); ?>

                        <?php if($errors->any()): ?>
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li><?php echo e($error); ?></li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </div>
                        <?php endif; ?>

                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>Código</th>
                                        <th>Producto</th>
                                        <th>Cantidad</th>
                                        <th>Paciente</th>
                                        <th>Área</th>
                                        <th>Info</th>
                                        <th>Empresa externa</th>
                                        <th>Tipo proceso</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $detalles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $detalle): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($detalle->product_code); ?></td>
                                            <td><?php echo e($detalle->product_name); ?></td>
                                            <td>
                                                <input type="number" min="1"
                                                    name="detalles[<?php echo e($detalle->id); ?>][product_quantity]"
                                                    value="<?php echo e(old('detalles.' . $detalle->id . '.product_quantity', $detalle->product_quantity)); ?>"
                                                    class="form-control form-control-sm" style="min-width:70px" readonly>
                                            </td>
                                            <td>
                                                <input type="text"
                                                    name="detalles[<?php echo e($detalle->id); ?>][product_patient]"
                                                    value="<?php echo e(old('detalles.' . $detalle->id . '.product_patient', $detalle->product_patient)); ?>"
                                                    class="form-control form-control-sm" style="min-width:120px">
                                            </td>
                                            <td>
                                                <input type="text"
                                                    name="detalles[<?php echo e($detalle->id); ?>][product_area]"
                                                    value="<?php echo e(old('detalles.' . $detalle->id . '.product_area', $detalle->product_area)); ?>"
                                                    class="form-control form-control-sm" style="min-width:100px">
                                            </td>
                                            <td>
                                                <input type="text"
                                                    name="detalles[<?php echo e($detalle->id); ?>][product_info]"
                                                    value="<?php echo e(old('detalles.' . $detalle->id . '.product_info', $detalle->product_info)); ?>"
                                                    class="form-control form-control-sm" style="min-width:100px">
                                            </td>
                                            <td>
                                                <input type="text"
                                                    name="detalles[<?php echo e($detalle->id); ?>][product_outside_company]"
                                                    value="<?php echo e(old('detalles.' . $detalle->id . '.product_outside_company', $detalle->product_outside_company)); ?>"
                                                    class="form-control form-control-sm" style="min-width:120px">
                                            </td>
                                            <td>
                                                <input type="text"
                                                    name="detalles[<?php echo e($detalle->id); ?>][product_type_process]"
                                                    value="<?php echo e(old('detalles.' . $detalle->id . '.product_type_process', $detalle->product_type_process)); ?>"
                                                    class="form-control form-control-sm" style="min-width:120px" readonly>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-3">
                            <button type="submit" class="btn btn-warning">
                                <i class="bi bi-save"></i> Guardar cambios
                            </button>
                            <a href="<?php echo e(route('prelavado.index')); ?>" class="btn btn-secondary">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/Modules/Lavado/Resources/views/prelavado/edit.blade.php ENDPATH**/ ?>