<?php $__env->startSection('title', ' Detalles Etiquetas Generadas' ); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>">Home</a></li>
        <li class="breadcrumb-item"><a href="<?php echo e(route('labelqrs.index')); ?>">Etiquetas Generadas</a></li>
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
                            Referencia: <strong><?php echo e($labelqr->reference); ?></strong>
                        </div>
                        <a target="_blank" class="btn btn-sm btn-warning mfs-auto mfe-1 d-print-none"
                            href="<?php echo e(route('labelqr-discharges.create', $labelqr->id)); ?>">
                            <i class="bi bi-printer"></i> Enviar Ciclo
                        </a>
                        <a target="_blank" class="btn btn-sm btn-secondary mfs-auto mfe-1 d-print-none"
                            href="<?php echo e(route('labelqrs_label.pdf', $labelqr->id)); ?>">
                            <i class="bi bi-printer"></i> Imprimir Etiquetas
                        </a>

                    </div>
                    <div class="card-body">
                        <div class="row mb-4">
                            <div class="col-sm-3 mb-3 mb-md-0">
                                <h5 class="mb-2 border-bottom pb-2">Institución:</h5>
                                <div> <strong>Hospital:</strong> <?php echo e(institutes()->institute_name); ?></div>
                                <div><strong>Dirección:</strong>  <?php echo e(institutes()->institute_address); ?></div>
                                <div><strong>Área:</strong>  <?php echo e(institutes()->institute_area); ?></div>
                                <div><strong>Ciudad:</strong> <?php echo e(institutes()->institute_city); ?></div>
                                <div> <strong>País:</strong><?php echo e(institutes()->institute_country); ?></div>
                            </div>

                            <div class="col-sm-3 mb-3 mb-md-0">
                                <h4 class="mb-2 border-bottom pb-2">Información de Proceso:</h4>
                                
                                <div><strong>Equipo:</strong> <?php echo e($labelqr->machine_name); ?></div>
                                <div><strong>Lote del Equipo:</strong> <?php echo e($labelqr->lote_machine); ?></div>
                                <div><strong>Temperatura del equipo:</strong> <?php echo e($labelqr->temp_machine); ?></div>
                                <div><strong>Tipo de Programa:</strong> <?php echo e($labelqr->type_program); ?></div>
                                <div><strong>Temperatura del Ambiente: </strong> <?php echo e($labelqr->temp_ambiente); ?></div>
                                <div><strong>Operario:</strong> <?php echo e($labelqr->operator); ?></div>
                            </div>

                            <div class="col-sm-3 mb-3 mb-md-0">
                                <h5 class="mb-2 border-bottom pb-2">Registro INFO:</h5>
                                <div>Número: <strong><?php echo e($labelqr->reference); ?></strong></div>
                                <div><strong>Fecha Proceso: </strong><?php echo e(\Carbon\Carbon::parse($labelqr->created_up)->format('d M, Y')); ?></div>
                                <div><strong>Estado del Ciclo: </strong> <?php echo e($labelqr->status_cycle); ?></div>
                                <div><strong>Lote del Biológico: </strong> <?php echo e($labelqr->lote_biologic); ?></div>
                                <div><strong>Validación Biológico: </strong> <?php echo e($labelqr->validation_biologic); ?></div>
                            </div>
                            <div class="col-sm-3 mb-3 mb-md-0">
                                <h4 class="mb-2 border-bottom pb-2">QR de Proceso:</h4>
                                <?php echo QrCode::size(150)->style('square')->generate( "$labelqr->reference"." -> Equipo: "."$labelqr->machine_name"." -> Lote: "."$labelqr->lote_machine"." -> Fecha Elabo: "."$labelqr->created_up". " -> Expiracion: ".  "$labelqr->updated_at"); ?>

                            </div>
                        </div>

                        <div class="table-responsive-sm">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th class="align-middle">Código del Instrumental</th>
                                        <th class="align-middle">Descripción</th>
                                        <th class="align-middle">Tipo de Envoltura</th>
                                        <th class="align-middle">Validación Embalaje</th>
                                        <th class="align-middle">Validación Ind. Químico</th>
                                        <th class="align-middle">Fecha de vencimiento</th>
                                        <th class="align-middle">QR Paquete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $labelqr->labelqrDetails; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td class="align-middle">
                                                <?php echo e($item->product_name); ?> <br>
                                            </td>
                                            <td class="align-middle"> <span class="badge badge-success">
                                                <?php echo e($item->product_code); ?>

                                            </span></td>
                                            <td class="align-middle">
                                                <?php echo e($item->product_package_wrap); ?>

                                            </td>
                                            <td class="align-middle">
                                                <?php echo e($item->product_eval_package); ?>

                                            </td>
                                            <td class="align-middle">
                                                <?php echo e($item->product_eval_indicator); ?>

                                            </td>
                                            <td class="align-middle">
                                                <?php echo e($item->product_expiration); ?> Meses
                                            </td>
                                            <td class="align-middle">
                                                <div>
                                                    <?php echo QrCode::size(50)->style('square')->generate( "$labelqr->reference"." // Lote: "."$labelqr->lote_machine"." // Cod: "."$item->product_code "." // Elab: "."$item->updated_at "." // Venc: "."$item->updated_at"); ?>

                                                </div>
                                                <div>
                                                    <span>
                                                       Lote: <?php echo e($labelqr->lote_machine); ?>  <br> Código: <?php echo e($item->product_code); ?>

                                                    </span>
                                                
                                                </div>
                                       
                                             
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

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/Modules/Labelqr/Resources/views/labelqrs/show.blade.php ENDPATH**/ ?>