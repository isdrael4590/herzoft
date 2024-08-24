<?php $__env->startSection('title', ' Detalles Matertial en preparación'); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>">Home</a></li>
        <li class="breadcrumb-item"><a href="<?php echo e(route('preparations.index')); ?>">Matertial en preparación</a></li>
        <li class="breadcrumb-item active">Detalles</li>
    </ol>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header d-flex flex-wrap align-items-center">
                        <div>
                            Reference: <strong><?php echo e($preparation->reference); ?></strong>
                        </div>

                    </div>


                    <div class="table-responsive-sm">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th class="align-middle">Código del Instrumental</th>
                                    <th class="align-middle">Descripción</th>
                                    <th class="align-middle">Area Proviene</th>
                                    <th class="align-middle">Estado</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $preparation->preparationDetails; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td class="align-middle">
                                            <?php echo e($item->product_name); ?> <br>
                                        </td>
                                        <td class="align-middle"> <span class="badge badge-success">
                                                <?php echo e($item->product_code); ?>

                                            </span></td>
                                        <td class="align-middle">
                                            <?php echo e($item->product_coming_zone); ?>

                                        </td>
                                        <td class="align-middle">
                                            <?php echo e($item->product_state_preparation); ?>

                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/Modules/Preparation/Resources/views/preparations/show.blade.php ENDPATH**/ ?>