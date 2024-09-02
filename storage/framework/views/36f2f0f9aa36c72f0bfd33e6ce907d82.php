<?php $__env->startSection('title', ' Detalles Despacho' ); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>">Home</a></li>
        <li class="breadcrumb-item"><a href="<?php echo e(route('expeditions.index')); ?>">Resumen del despacho</a></li>
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
                            Referencia: <strong><?php echo e($expedition->reference); ?></strong>
                        </div>
                        
                        <a target="_blank" class="btn btn-sm btn-secondary mfs-auto mfe-1 d-print-none"
                            href="<?php echo e(route('expeditions.pdf', $expedition->id)); ?>">
                            <i class="bi bi-printer"></i> Imprimir
                        </a>
                        <a target="_blank" class="btn btn-sm btn-info mfe-1 d-print-none"
                            href="<?php echo e(route('expeditions.pdf', $expedition->id)); ?>">
                            <i class="bi bi-save"></i> Guardar
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="row mb-4">
                            <div class="col-sm-3 mb-3 mb-md-0">
                                <h5 class="mb-2 border-bottom pb-2">Institución:</h5>
                                <div><strong><?php echo e(institutes()->institute_code); ?></strong></div>
                                <div> <strong>Hospital:</strong> <?php echo e(institutes()->institute_name); ?></div>
                                <div><strong>Dirección:</strong>  <?php echo e(institutes()->institute_address); ?></div>
                                <div><strong>Área:</strong>  <?php echo e(institutes()->institute_area); ?></div>
                                <div><strong>Ciudad:</strong> <?php echo e(institutes()->institute_city); ?></div>
                                <div> <strong>País:</strong><?php echo e(institutes()->institute_country); ?></div>
                            </div>

                            <div class="col-sm-3 mb-3 mb-md-0">
                                <h4 class="mb-2 border-bottom pb-2">Información de Proceso:</h4>
                                
                                <div><strong>Temperatura del Ambiente: </strong> <?php echo e($expedition->temp_ambiente); ?></div>
                                <div><strong>Operario:</strong> <?php echo e($expedition->operator); ?></div>
                            </div>

                            <div class="col-sm-3 mb-3 mb-md-0">
                                <h5 class="mb-2 border-bottom pb-2">Registro INFO:</h5>
                                <div>Número: <strong><?php echo e($expedition->reference); ?></strong></div>
                                <div><strong>Fecha Despacho: </strong><?php echo e(\Carbon\Carbon::parse($expedition->created_up)->format('d M, Y')); ?></div>
                                <div><strong>Estado del Despacho: </strong> <?php echo e($expedition->status_expedition); ?></div>
                                <div><strong>Persona quién Recibe: </strong> <?php echo e($expedition->staff_expedition); ?></div>

                            </div>
                            
                        </div>

                        <div class="table-responsive-sm">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Código </th>
                                        <th>Descripción</th>
                                        <th>Envoltura</th>
                                        <th>Expiración</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $expedition->expeditionDetails; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td class="align-middle">
                                                <?php echo e($item->product_code); ?> <br>
                                            </td>
                                            <td class="align-middle"> <span class="badge badge-success">
                                                <?php echo e($item->product_name); ?>

                                            </span></td>
                                            <td class="align-middle">
                                                <?php echo e($item->product_package_wrap); ?>

                                            </td>
                                            <td class="align-middle">
                                                <?php echo e($item->product_expiration); ?>

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
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/Modules/Expedition/Resources/views/expeditions/show.blade.php ENDPATH**/ ?>