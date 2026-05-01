<?php $__env->startSection('title', 'Create Instrumental'); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>">Home</a></li>
        <li class="breadcrumb-item"><a href="<?php echo e(route('instrumental.index')); ?>">Base Datos Instrumental</a></li>
        <li class="breadcrumb-item active">Añadir</li>
    </ol>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <form id="Instrumental-form" action="<?php echo e(route('instrumental.store')); ?>" method="POST" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>


            <div class="row">
                <div class="col-lg-12">
                    <?php echo $__env->make('utils.alerts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary" id="submitBtn">
                            Crear Instrumental <i class="bi bi-check"></i>
                        </button>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-row">



                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nombre_generico">Descripción <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="nombre_generico" required
                                            value="<?php echo e(old('nombre_generico')); ?>" maxlength="255">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="codigo_unico_ud">Código Único <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="codigo_unico_ud" required
                                            value="<?php echo e(old('codigo_unico_ud')); ?>">
                                    </div>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="tipo_familia">Familia <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="tipo_familia" required
                                            value="<?php echo e(old('tipo_familia')); ?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="marca_fabricante">Fabricante <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="marca_fabricante" required
                                            value="<?php echo e(old('marca_fabricante')); ?>">
                                    </div>
                                </div>

                            </div>
                            <div class="form-row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="fecha_compra">FECHA DE COMPRA <span class="text-danger">*</span></label>
                                        <input type="date" class="form-control" name="fecha_compra" required
                                            value="<?php echo e(old('fecha_compra')); ?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="estado_actual">Selección De estado <span
                                                class="text-danger">*</span></label>
                                        <select class="form-control" name="estado_actual" id="estado_actual" required>
                                            <option value="">Selección de Estado</option>
                                            <option value="DISPONIBLE"
                                                <?php echo e(old('estado_actual') == 'DISPONIBLE' ? 'selected' : ''); ?>>DISPONIBLE
                                            </option>
                                            <option value="EN_USO" <?php echo e(old('estado_actual') == 'EN_USO' ? 'selected' : ''); ?>>
                                                EN USO</option>
                                            <option value="MANTENIMIENTO"
                                                <?php echo e(old('estado_actual') == 'MANTENIMIENTO' ? 'selected' : ''); ?>>
                                                MANTENIMIENTO</option>
                                            <option value="BAJA" <?php echo e(old('estado_actual') == 'BAJA' ? 'selected' : ''); ?>>
                                                BAJA</option>
                                        </select>
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
<?php $__env->stopSection(); ?>

<?php $__env->startSection('third_party_scripts'); ?>
    <script src="<?php echo e(asset('js/dropzone.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('page_scripts'); ?>
    <script src="<?php echo e(asset('js/jquery-mask-money.js')); ?>"></script>
e
    <script>
        $(document).ready(function() {
            $('#Instrumental-form').on('submit', function(e) {
                // Deshabilitar el botón para evitar múltiples envíos
                $('#submitBtn').prop('disabled', true).html(
                    'Guardando... <i class="bi bi-hourglass-split"></i>');
            });
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/Modules/Product/Resources/views/instrumental/create.blade.php ENDPATH**/ ?>