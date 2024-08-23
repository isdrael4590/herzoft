<?php $__env->startSection('title', 'Importar Product'); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>">Home</a></li>
        <li class="breadcrumb-item"><a href="<?php echo e(route('products.index')); ?>">Base Datos RUMED</a></li>
        <li class="breadcrumb-item active">Añadir</li>
    </ol>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <form id="product-form" action="<?php echo e(route('import-products.store')); ?>" method="POST" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <div class="row">
                <div class="col-lg-12">
                    <?php echo $__env->make('utils.alerts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <div class="form-group">
                        <button class="btn btn-primary">Crear Paquetes <i class="bi bi-check"></i></button>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Ingresar Archivo de Paquetes <span
                                                class="text-danger">*</span></label>
                                        <input type="file" class="form-control" name="file" required>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>


<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/Modules/Product/Resources/views/ImportProducts/create.blade.php ENDPATH**/ ?>