<?php $__env->startSection('title', 'Edit Product'); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>">Home</a></li>
        <li class="breadcrumb-item"><a href="<?php echo e(route('products.index')); ?>">Base Datos RUMED</a></li>
        <li class="breadcrumb-item active">Editar</li>
    </ol>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid mb-4">
        <form id="product-form" action="<?php echo e(route('products.update', $product->id)); ?>" method="POST"
            enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <?php echo method_field('patch'); ?>
            <div class="row">
                <div class="col-lg-12">
                    <?php echo $__env->make('utils.alerts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <div class="form-group">
                        <button class="btn btn-primary">Actualizar Paquete <i class="bi bi-check"></i></button>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-row">
                                <div class="col-md-7">
                                    <div class="form-group">
                                        <label for="product_name">Nombre del Paquete <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="product_name" required
                                            value="<?php echo e($product->product_name); ?>">
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="product_code">Código <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="product_code" required
                                            value="<?php echo e($product->product_code); ?>">
                                    </div>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="category_id">Categoría / Especialidad <span
                                                class="text-danger">*</span></label>
                                        <select class="form-control" name="category_id" id="category_id" required>
                                            <?php $__currentLoopData = \Modules\Product\Entities\Category::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option <?php echo e($category->id == $product->category->id ? 'selected' : ''); ?>

                                                    value="<?php echo e($category->id); ?>"><?php echo e($category->category_name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                        <div class="input-group-append d-flex">
                                            <button data-toggle="modal" data-target="#categoryCreateModal"
                                                class="btn btn-outline-primary" type="button">
                                                Añadir
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="barcode_symbology">SimbologÍa BARCODE <span
                                                class="text-danger">*</span></label>
                                        <select class="form-control" name="product_barcode_symbology" id="barcode_symbology"
                                            required>
                                            <option <?php echo e($product->product_barcode_symbology == 'C128' ? 'selected' : ''); ?>

                                                value="C128">Code 128</option>
                                            <option <?php echo e($product->product_barcode_symbology == 'C39' ? 'selected' : ''); ?>

                                                value="C39">Code 39</option>
                                            <option <?php echo e($product->product_barcode_symbology == 'UPCA' ? 'selected' : ''); ?>

                                                value="UPCA">UPC-A</option>

                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="area">Area <span class="text-danger">*</span></label>
                                        <select class="form-control" id="area" name="area" required>
                                            <?php $__currentLoopData = \Modules\Informat\Entities\Area::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $area): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option <?php echo e($product->area == $area->area_name ? 'selected' : ''); ?>

                                                    value="<?php echo e($area->area_name); ?>">
                                                    <?php echo e($area->area_name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="product_type_process">Paquete procesado en:<span
                                                class="text-danger">*</span></label>
                                        <select class="form-control" name="product_type_process" id="product_type_process"
                                            required>
                                            <option value="" disabled>Seleccion de Temp. Trabajo</option>
                                            <option
                                                <?php echo e($product->product_type_process == 'Alta Temperatura' ? 'selected' : ''); ?>

                                                value="Alta Temperatura">Alta Temperatura</option>
                                            <option
                                                <?php echo e($product->product_type_process == 'Baja Temperatura' ? 'selected' : ''); ?>

                                                value="Baja Temperatura">Baja Temperatura</option>
                                            <option
                                                <?php echo e($product->product_type_process == 'N/A' ? 'selected' : ''); ?>

                                                value="N/A">N/A</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="product_unit">Unidad <i class="bi bi-question-circle-fill text-info"
                                                data-toggle="tooltip" data-placement="top"
                                                title="This short text will be placed after Product Quantity."></i> <span
                                                class="text-danger">*</span></label>
                                        <select class="form-control" name="product_unit" id="product_unit" required>
                                            <option value="" selected>Seleccionar Unidad</option>
                                            <?php $__currentLoopData = \Modules\Informat\Entities\Unit::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $unit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option <?php echo e($product->product_unit == $unit->short_name ? 'selected' : ''); ?>

                                                    value="<?php echo e($unit->short_name); ?>">
                                                    <?php echo e($unit->name . ' | ' . $unit->short_name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="product_note">Note</label>
                                <textarea name="product_note" id="product_note" rows="4 " class="form-control"><?php echo e($product->product_note); ?></textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="image">Imagen del paquete <i class="bi bi-question-circle-fill text-info"
                                        data-toggle="tooltip" data-placement="top"
                                        title="Max Files: 3, Max File Size: 1MB, Image Size: 400x400"></i></label>
                                <div class="dropzone d-flex flex-wrap align-items-center justify-content-center"
                                    id="document-dropzone">
                                    <div class="dz-message" data-dz-message>
                                        <i class="bi bi-cloud-arrow-up"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <!-- Create Category Modal -->
    <?php echo $__env->make('product::includes.category-modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('third_party_scripts'); ?>
    <script src="<?php echo e(asset('js/dropzone.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('page_scripts'); ?>
    <script>
        var uploadedDocumentMap = {}
        Dropzone.options.documentDropzone = {
            url: '<?php echo e(route('dropzone.upload')); ?>',
            maxFilesize: 1,
            acceptedFiles: '.jpg, .jpeg, .png',
            maxFiles: 3,
            addRemoveLinks: true,
            dictRemoveFile: "<i class='bi bi-x-circle text-danger'></i> remove",
            headers: {
                'X-CSRF-TOKEN': "<?php echo e(csrf_token()); ?>"
            },
            success: function(file, response) {
                $('form').append('<input type="hidden" name="document[]" value="' + response.name + '">');
                uploadedDocumentMap[file.name] = response.name;
            },
            removedfile: function(file) {
                file.previewElement.remove();
                var name = '';
                if (typeof file.file_name !== 'undefined') {
                    name = file.file_name;
                } else {
                    name = uploadedDocumentMap[file.name];
                }
                $('form').find('input[name="document[]"][value="' + name + '"]').remove();
            },
            init: function() {
                <?php if(isset($product) && $product->getMedia('images')): ?>
                    var files = <?php echo json_encode($product->getMedia('images')); ?>;
                    for (var i in files) {
                        var file = files[i];
                        this.options.addedfile.call(this, file);
                        this.options.thumbnail.call(this, file, file.original_url);
                        file.previewElement.classList.add('dz-complete');
                        $('form').append('<input type="hidden" name="document[]" value="' + file.file_name + '">');
                    }
                <?php endif; ?>
            }
        }
    </script>

    <script src="<?php echo e(asset('js/jquery-mask-money.js')); ?>"></script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/Modules/Product/Resources/views/products/edit.blade.php ENDPATH**/ ?>