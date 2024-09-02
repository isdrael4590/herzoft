<?php $__env->startSection('title', 'Edit informat Category'); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>">Home</a></li>
        <li class="breadcrumb-item"><a href="<?php echo e(route('informats.index')); ?>">Información</a></li>
        <li class="breadcrumb-item"><a href="<?php echo e(route('machine.index')); ?>">Equipos </a></li>
        <li class="breadcrumb-item active">Editar</li>
    </ol>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-7">
                <?php echo $__env->make('utils.alerts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <div class="card">
                    <div class="card-body">
                        <form action="<?php echo e(route('machine.update', $Machines->id)); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('patch'); ?>
                            <div class="form-group">
                                <label class="font-weight-bold" for="machine_code">Código Equipo <span
                                        class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="machine_code" required readonly
                                    value="<?php echo e($Machines->machine_code); ?>">
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold" for="machine_name">Nombre del Equipo <span
                                        class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="machine_name" required
                                    value="<?php echo e($Machines->machine_name); ?>">
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold" for="machine_model">Modelo Equipo <span
                                        class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="machine_model" required
                                    value="<?php echo e($Machines->machine_model); ?>">
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold" for="machine_type">Tipo de Equipo
                                        <select class="form-control" name="machine_type" id="machine_type" required>
                                            <option <?php echo e($Machines->machine_type == 'Autoclave' ? 'selected' : ''); ?>

                                                value="Autoclave">Autoclave</option>
                                            <option <?php echo e($Machines->machine_type == 'Peroxido' ? 'selected' : ''); ?>

                                                value="Peroxido">Esterilizador de Peroxido</option>
                                        </select>
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold" for="machine_serial">Serie del Equipo <span
                                        class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="machine_serial" required
                                    value="<?php echo e($Machines->machine_serial); ?>">
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold" for="machine_factory">Marca del esterilizador <span
                                        class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="machine_factory" required
                                    value="<?php echo e($Machines->machine_factory); ?>">
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold" for="machine_country">País de fabricación <span
                                        class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="machine_country" required
                                    value="<?php echo e($Machines->machine_country); ?>">
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Actualizar <i
                                        class="bi bi-check"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/Modules/Informat/Resources/views/machines/edit.blade.php ENDPATH**/ ?>