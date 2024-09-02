<?php
    $Testvacuum_max_id = \Modules\Testbd\Entities\Testvacuum::max('id') + 1;
    $testvacuum_reference = 'Tvac_' . str_pad($Testvacuum_max_id, 5, '0', STR_PAD_LEFT);
?>



<?php $__env->startSection('title', 'Crear Test Vacio'); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>">Home</a></li>
        <li class="breadcrumb-item"><a href="<?php echo e(route('testvacuums.index')); ?>">Test Vacio</a></li>
        <li class="breadcrumb-item active">Añadir</li>
    </ol>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <form id="product-form" action="<?php echo e(route('testvacuums.store')); ?>" method="POST" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <div class="row">
                <div class="col-lg-12">
                    <?php echo $__env->make('utils.alerts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <div class="form-group">
                        <button class="btn btn-primary">Crear Test Vacío <i class="bi bi-check"></i></button>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="font-weight-bold" for="testvacuum_reference">Identificación del Test Vacio
                                            <span class="text-danger"></span></label>
                                        <input class="form-control" type="text" name="testvacuum_reference" required readonly
                                            value="<?php echo e($testvacuum_reference); ?>">
                                    </div>
                                </div>

                            </div>
                            <div class="form-row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="machine_name">Nombre del Equipo <span
                                                class="text-danger">*</span></label>
                                        <select class="form-control" id="machine_name" name="machine_name">
                                            <?php $__currentLoopData = \Modules\Informat\Entities\Machine::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $machines): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($machines->machine_name); ?>">
                                                    <?php echo e($machines->machine_name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="tipo_equipo">Tipo de Equipo</label>
                                        <select class="form-control" name="tipo_equipo" id="tipo_equipo" required>
                                            <option value="" selected>Seleccionar Tipo</option>
                                            <option value="Autoclave">Autoclave</option>
                                            <option value="Peroxido">Peroxido</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="lote_machine">Lote del Equipo <span class="text-danger">*</span></label>
                                        <input type="number" class="form-control" name="lote_machine" required
                                            value="<?php echo e(old('lote_machine')); ?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="validation_vacuum">Validación Ciclo Vacio</label>
                                        <select class="form-control" name="validation_vacuum" id="validation_vacuum" required>
                                            <option value="" selected>Seleccionar Resultado</option>
                                            <option value="Correcto">Correcto</option>
                                            <option value="Falla">Falla</option>
                                        </select>
                                    </div>
                                </div>
                               
                            </div>
                            <div class="form-row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="temp_ambiente">Temperatura del Ambiente <span
                                                class="text-danger">*</span></label>
                                        <input type="number" class="form-control" name="temp_ambiente" required
                                            value="<?php echo e(old('temp_ambiente')); ?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Operador</label>
                                        <input class="form-control" type="text" id="operator" name="operator"
                                            placeholder= "<?php echo e(Auth::user()->name); ?>" value="<?php echo e(Auth::user()->name); ?>">
                                    </div>
                                </div>
                            </div>


                            <div class="form-group">
                                <label for="observation">Nota / Observaciones</label>
                                <textarea name="observation" id="observation" rows="4 " class="form-control"></textarea>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </form>
    </div>

    <!-- Create Category Modal -->
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
                "X-CSRF-TOKEN": "<?php echo e(csrf_token()); ?>"
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
                $.ajax({
                    type: "POST",
                    url: "<?php echo e(route('dropzone.delete')); ?>",
                    data: {
                        '_token': "<?php echo e(csrf_token()); ?>",
                        'file_name': `${name}`
                    },
                });
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

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/Modules/Testbd/Resources/views/testvacuums/create.blade.php ENDPATH**/ ?>