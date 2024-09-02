<?php $__env->startSection('title', 'Editar Institución'); ?>

<?php $__env->startSection('third_party_stylesheets'); ?>
    <link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet"/>
    <link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css"
          rel="stylesheet">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>">Home</a></li>
        <li class="breadcrumb-item"><a href="<?php echo e(route('informats.index')); ?>">Información</a></li>
        <li class="breadcrumb-item"><a href="<?php echo e(route('institute.index')); ?>">Institución</a></li>
        <li class="breadcrumb-item active">Editar</li>
    </ol>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <?php echo $__env->make('utils.alerts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <div class="card">
                    <div class="card-body">
                        <form action="<?php echo e(route('institute.update', $institute->id)); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('patch'); ?>
                            <div class="row">
                                <div class="col-lg-12">
                                    <?php echo $__env->make('utils.alerts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                    <div class="form-group">
                                        <button class="btn btn-primary">Actualizar Institución <i class="bi bi-check"></i></button>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="card">
                                        <div class="card-body">
                                                <div class="form-row">
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label class="font-weight-bold" for="institute_code">Institución
                                                                Código <span class="text-danger">*</span></label>
                                                            <input class="form-control" type="text" name="institute_code"
                                                                required
                                                                value="<?php echo e($institute->institute_code); ?>

                                                    ">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label class="font-weight-bold" for="institute_name">Nombre de
                                                                la
                                                                Institución <span class="text-danger">*</span></label>
                                                            <input class="form-control" type="text" name="institute_name"
                                                                required value="<?php echo e($institute->institute_name); ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label class="font-weight-bold"
                                                                for="institute_address">Dirección
                                                                Institución <span class="text-danger">*</span></label>
                                                            <input class="form-control" type="text"
                                                                name="institute_address" required
                                                                value="<?php echo e($institute->institute_address); ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label class="font-weight-bold" for="institute_area">Área del
                                                                Hospital<span class="text-danger">*</span></label>
                                                            <input class="form-control" type="text" name="institute_area"
                                                                required value="<?php echo e($institute->institute_area); ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="font-weight-bold" for="institute_city">Ciudad <span
                                                            class="text-danger">*</span></label>
                                                    <input class="form-control" type="text" name="institute_city"
                                                        required value="<?php echo e($institute->institute_city); ?>">
                                                </div>

                                                <div class="form-group">
                                                    <label class="font-weight-bold" for="institute_country">País<span
                                                            class="text-danger">*</span></label>
                                                    <input class="form-control" type="text" name="institute_country"
                                                        required value="<?php echo e($institute->institute_country); ?>">
                                                </div>

                                        </div>

                                    </div>
                                </div>
                               
                                <div class="col-lg-4">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label for="image">Logo de la Institución. <i class="bi bi-question-circle-fill text-info" data-toggle="tooltip" data-placement="top" title="Max Files: 3, Max File Size: 1MB, Image Size: 400x400"></i></label>
                                                <div class="dropzone d-flex flex-wrap align-items-center justify-content-center" id="document-dropzone">
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
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('third_party_scripts'); ?>
    <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
    <script
        src="https://unpkg.com/filepond-plugin-file-validate-size/dist/filepond-plugin-file-validate-size.js"></script>
    <script
        src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.js"></script>
    <script src="https://unpkg.com/filepond/dist/filepond.js"></script>
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
            <?php if(isset($institute) && $institute->getMedia('institutes')): ?>
                var files = <?php echo json_encode($institute->getMedia('institutes')); ?>;
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
<?php $__env->stopPush(); ?>



<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/Modules/Informat/Resources/views/institutes/edit.blade.php ENDPATH**/ ?>