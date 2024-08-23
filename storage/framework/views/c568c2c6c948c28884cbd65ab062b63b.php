<?php $__env->startSection('title', 'reception Detalles'); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>">Home</a></li>
        <li class="breadcrumb-item"><a href="<?php echo e(route('receptions.index')); ?>">Recepción de instrumental</a></li>
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
                            Reference: <strong><?php echo e($reception->reference); ?></strong>
                        </div>
                        <a target="_blank" class="btn btn-sm btn-secondary mfs-auto mfe-1 d-print-none"
                            href="<?php echo e(route('receptions.pdf', $reception->id)); ?>">
                            <i class="bi bi-printer"></i> Imprimir
                        </a>
                        <a target="_blank" class="btn btn-sm btn-info mfe-1 d-print-none"
                            href="<?php echo e(route('receptions.pdf', $reception->id)); ?>">
                            <i class="bi bi-save"></i> Guardar
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="row mb-4">
                            <div class="col-sm-4 mb-3 mb-md-0">
                                <h5 class="mb-2 border-bottom pb-2">Institución:</h5>
                                <div><strong><?php echo e(institutes()->institute_code); ?></strong></div>
                                <div><?php echo e(Institutes()->institute_name); ?></div>
                                <div>Dirección: <?php echo e(Institutes()->institute_address); ?></div>
                                <div>Área: <?php echo e(Institutes()->institute_area); ?></div>
                                <div>Ciudad: <?php echo e(Institutes()->institute_city); ?></div>
                                <div>País: <?php echo e(Institutes()->institute_country); ?></div>
                            </div>

                            <div class="col-sm-4 mb-3 mb-md-0">
                                <h5 class="mb-2 border-bottom pb-2">Información de ingreso:</h5>
                                <div>Persona que entrega: <?php echo e($reception->delivery_staff); ?></div>
                                <div>Área Procedente: <?php echo e($reception->area); ?></div>
                                <div>Persona que recibe: <?php echo e($reception->operator); ?></div>
                            </div>

                            <div class="col-sm-4 mb-3 mb-md-0">
                                <h5 class="mb-2 border-bottom pb-2">Registro INFO:</h5>
                                <div>Número: <strong><?php echo e($reception->reference); ?></strong></div>
                                <div>Fecha: <?php echo e(\Carbon\Carbon::parse($reception->created_up)->format('d M, Y')); ?></div>
                                <div>
                                    Status: <strong><?php echo e($reception->status); ?></strong>
                                </div>
                            
                            </div>

                        </div>

                        <div class="table-responsive-sm">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th class="align-middle">Códigop del Instrumental</th>
                                        <th class="align-middle">Descripción</th>
                                        <th class="align-middle">Nivel de infección</th>
                                        <th class="align-middle">Estado</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $reception->receptionDetails; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td class="align-middle">
                                                <?php echo e($item->product_name); ?> <br>
                                               
                                            </td>

                                            <td class="align-middle"> <span class="badge badge-success">
                                                <?php echo e($item->product_code); ?>

                                            </span></td>

                                            <td class="align-middle">
                                                <?php echo e($item->product_type_dirt); ?>

                                            </td>

                                            <td class="align-middle">
                                                <?php echo e(($item->product_state_rumed)); ?>

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

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/Modules/Reception/Resources/views/receptions/show.blade.php ENDPATH**/ ?>