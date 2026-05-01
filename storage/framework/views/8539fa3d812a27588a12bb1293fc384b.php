<?php $__env->startSection('title', 'Editar Instrumental'); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>">Home</a></li>
        <li class="breadcrumb-item"><a href="<?php echo e(route('instrumental.index')); ?>">Base Datos Instrumental</a></li>
        <li class="breadcrumb-item active">Editar</li>
    </ol>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <form id="Instrumental-form" action="<?php echo e(route('instrumental.update', $instrumental->id)); ?>" method="POST" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>

            <div class="row">
                <div class="col-lg-12">
                    <?php echo $__env->make('utils.alerts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary" id="submitBtn">
                            Actualizar Instrumental <i class="bi bi-check"></i>
                        </button>
                        <a href="<?php echo e(route('instrumental.index')); ?>" class="btn btn-secondary">
                            Cancelar <i class="bi bi-x-circle"></i>
                        </a>
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
                                            value="<?php echo e(old('nombre_generico', $instrumental->nombre_generico)); ?>" maxlength="255">
                                        <?php $__errorArgs = ['nombre_generico'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="text-danger"><?php echo e($message); ?></span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="codigo_unico_ud">Código Único <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="codigo_unico_ud" required
                                            value="<?php echo e(old('codigo_unico_ud', $instrumental->codigo_unico_ud)); ?>">
                                        <?php $__errorArgs = ['codigo_unico_ud'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="text-danger"><?php echo e($message); ?></span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="tipo_familia">Familia <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="tipo_familia" required
                                            value="<?php echo e(old('tipo_familia', $instrumental->tipo_familia)); ?>">
                                        <?php $__errorArgs = ['tipo_familia'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="text-danger"><?php echo e($message); ?></span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="marca_fabricante">Fabricante <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="marca_fabricante" required
                                            value="<?php echo e(old('marca_fabricante', $instrumental->marca_fabricante)); ?>">
                                        <?php $__errorArgs = ['marca_fabricante'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="text-danger"><?php echo e($message); ?></span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="fecha_compra">FECHA DE COMPRA <span class="text-danger">*</span></label>
                                        <input type="date" class="form-control" name="fecha_compra" required
                                            value="<?php echo e(old('fecha_compra', $instrumental->fecha_compra ? $instrumental->fecha_compra->format('Y-m-d') : '')); ?>">
                                        <?php $__errorArgs = ['fecha_compra'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="text-danger"><?php echo e($message); ?></span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="estado_actual">Selección De estado <span class="text-danger">*</span></label>
                                        <select class="form-control" name="estado_actual" id="estado_actual" required>
                                            <option value="">Selección de Estado</option>
                                            <option value="DISPONIBLE" 
                                                <?php echo e(old('estado_actual', $instrumental->estado_actual) == 'DISPONIBLE' ? 'selected' : ''); ?>>
                                                DISPONIBLE
                                            </option>
                                            <option value="EN_USO" 
                                                <?php echo e(old('estado_actual', $instrumental->estado_actual) == 'EN_USO' ? 'selected' : ''); ?>>
                                                EN USO
                                            </option>
                                            <option value="MANTENIMIENTO" 
                                                <?php echo e(old('estado_actual', $instrumental->estado_actual) == 'MANTENIMIENTO' ? 'selected' : ''); ?>>
                                                MANTENIMIENTO
                                            </option>
                                            <option value="BAJA" 
                                                <?php echo e(old('estado_actual', $instrumental->estado_actual) == 'BAJA' ? 'selected' : ''); ?>>
                                                BAJA
                                            </option>
                                        </select>
                                        <?php $__errorArgs = ['estado_actual'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="text-danger"><?php echo e($message); ?></span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                </div>
                            </div>

                            <!-- Información adicional (solo lectura) -->
                            <div class="form-row mt-3">
                                <div class="col-md-12">
                                    <hr>
                                    <h5>Información del Registro</h5>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>ID</label>
                                        <input type="text" class="form-control" value="<?php echo e($instrumental->id); ?>" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Fecha de Creación</label>
                                        <input type="text" class="form-control" 
                                            value="<?php echo e($instrumental->created_at->format('d/m/Y H:i')); ?>" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Última Actualización</label>
                                        <input type="text" class="form-control" 
                                            value="<?php echo e($instrumental->updated_at->format('d/m/Y H:i')); ?>" readonly>
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

<?php $__env->startSection('third_party_scripts'); ?>
    <script src="<?php echo e(asset('js/dropzone.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('page_scripts'); ?>
    <script src="<?php echo e(asset('js/jquery-mask-money.js')); ?>"></script>
    
    <script>
        $(document).ready(function() {
            $('#Instrumental-form').on('submit', function(e) {
                // Deshabilitar el botón para evitar múltiples envíos
                $('#submitBtn').prop('disabled', true).html(
                    'Actualizando... <i class="bi bi-hourglass-split"></i>');
            });
        });
    </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/Modules/Product/Resources/views/instrumental/edit.blade.php ENDPATH**/ ?>