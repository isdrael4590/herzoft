<?php $__env->startSection('title', 'Ingresar Insumos'); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>">Home</a></li>
        <li class="breadcrumb-item"><a href="<?php echo e(route('informats.index')); ?>">Insumos</a></li>
        <li class="breadcrumb-item active">Añadir</li>
    </ol>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <form id="informat-form" action="<?php echo e(route('informats.store')); ?>" method="POST"
            enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <div class="row">
                <div class="col-lg-12">
                    <div class="form-group">
                        <button class="btn btn-primary">Registro de Insumos <i class="bi bi-check"></i></button>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="insumo_name">Nombre del Insumo <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="insumo_name" required
                                            value="<?php echo e(old('insumo_name')); ?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="insumo_code">Código del insumo <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="insumo_code" required
                                            value="<?php echo e(old('insumo_code')); ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-6">
                                    <label for="insumo_type">Tipo de Insumo<span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <select class="form-control" name="insumo_type" id="insumo_type" required>
                                            <option value="" selected disabled>Selección de Tipo de Insumo</option>
                                            <option value="INDICADORES QUIMICOS">INDICADORES QUÍMICOS</option>
                                            <option value="INDICADORES BIOLOGICOS">INDICADORES BIOLÓGICOS</option>
                                            <option value="ROLLOS TYVEK">ROLLOS TYVEK</option>
                                            <option value="ROLLOS MIXTOS">ROLLOS MIXTOS</option>
                                            <option value="AGENTE ESTERILIZANTE">AGENTE ESTERILIZANTE</option>
                                            <option value="TEST BOWIE & DICK">TEST BOWIE & DICK</option>
                                        </select>
                                     
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="insumo_temp">Temperatura de uso<span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <select class="form-control" name="insumo_temp" id="insumo_temp" required>
                                            <option value="" selected disabled>Selección la temperatura de uso
                                            </option>
                                            <option value="ALTA TEMPERATURA">ALTA TEMPERATURA</option>
                                            <option value="BAJA TEMPERATURA">BAJA TEMPERATURA</option>

                                        </select>
                                      
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="insumo_lot">Lote del insumo <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="insumo_lot" required
                                            value="<?php echo e(old('insumo_lot')); ?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="insumo_exp">Fecha de Expiración<span
                                                class="text-danger">*</span></label>
                                       
                                            <input type="date" class="form-control" name="insumo_exp" required value="<?php echo e(now()->format('Y-m-d')); ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="insumo_quantity">Cantidad <span class="text-danger">*</span></label>
                                        <input type="number" class="form-control" name="insumo_quantity" required
                                            value="<?php echo e(old('insumo_quantity')); ?>" min="1">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="insumo_unit">Presentación <i
                                                class="bi bi-question-circle-fill text-info" data-toggle="tooltip"
                                                data-placement="top" title="This short text will be placed after."></i>
                                            <span class="text-danger">*</span></label>
                                        <select class="form-control" name="insumo_unit" id="insumo_unit" required>
                                            <option value="" selected>Selección Presentación</option>
                                            <?php $__currentLoopData = \Modules\Informat\Entities\Unit::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $unit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($unit->short_name); ?>">
                                                    <?php echo e($unit->name . ' | ' . $unit->short_name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="insumo_status">Estado del Insumo<span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <select class="form-control" name="insumo_status" id="insumo_status" required>
                                            <option value="" selected disabled>Selección Estado del Insumo
                                            </option>
                                            <option value="Activo">Activo</option>
                                            <option value="Desactivado">Desactivado</option>

                                        </select>
                                      
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="insumo_note">Nota / Observaciones</label>
                                <textarea name="insumo_note" id="insumo_note" rows="4 " class="form-control"></textarea>
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
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/Modules/Informat/Resources/views/informats/create.blade.php ENDPATH**/ ?>