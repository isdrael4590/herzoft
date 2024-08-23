<?php $__env->startSection('title', 'Product Details'); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>">Home</a></li>
        <li class="breadcrumb-item"><a href="<?php echo e(route('products.index')); ?>">Base Datos RUMED</a></li>
        <li class="breadcrumb-item active">Detalles</li>
    </ol>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid mb-4">
        <div class="row mb-3">
            <div class="col-md-12">
                <?php echo \Milon\Barcode\Facades\DNS1DFacade::getBarCodeSVG($product->product_code, $product->product_barcode_symbology, 2, 110); ?>

            </div>
        </div>
        <div class="row">
            <div class="col-lg-9">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped mb-0">
                                <tr>
                                    <th>Código del producto</th>
                                    <td><?php echo e($product->product_code); ?></td>
                                </tr>
                                <tr>
                                    <th>Barcode simbología</th>
                                    <td><?php echo e($product->product_barcode_symbology); ?></td>
                                </tr>
                                <tr>
                                    <th>Nombre</th>
                                    <td><?php echo e($product->product_name); ?></td>
                                </tr>
                                <tr>
                                    <th>Categoria</th>
                                    <td><?php echo e($product->category->category_name); ?></td>
                                </tr>
                                <tr>
                                    <th>Área</th>
                                    <td><?php echo e($product->area); ?></td>
                                </tr>
                                <tr>
                                    <th>Temperatura de Trabajo</th>
                                    <td><?php echo e($product->product_type_process); ?></td>
                                </tr>
                                <tr>
                                    <th>Note</th>
                                    <td><?php echo e($product->product_note ?? 'N/A'); ?></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3">
                <div class="card h-100">
                    <div class="card-body">
                        <?php $__empty_1 = true; $__currentLoopData = $product->getMedia('images'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $media): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <img src="<?php echo e($media->getUrl()); ?>" alt="Product Image" class="img-fluid img-thumbnail mb-2">
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <img src="<?php echo e($product->getFirstMediaUrl('images')); ?>" alt="Product Image" class="img-fluid img-thumbnail mb-2">
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>




<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/Modules/Product/Resources/views/products/show.blade.php ENDPATH**/ ?>