<?php $__env->startSection('title', ' Detalles Etiquetas Generadas'); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>">Home</a></li>
        <li class="breadcrumb-item"><a href="<?php echo e(route('labelqrs.index')); ?>">Etiquetas Generadas</a></li>
        <li class="breadcrumb-item active">Detalles</li>
    </ol>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <?php
        $isSteam = $labelqr->machine_type == 'Autoclave';
        $isHpo   = $labelqr->machine_type == 'Peroxido';
    ?>

    <div class="container-fluid">
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session()->has('exito')): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?php echo e(session('exito')); ?>

                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php elseif(session()->has('advertencia')): ?>
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <?php echo e(session('advertencia')); ?>

                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php elseif(session()->has('error')): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?php echo e(session('error')); ?>

                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    
                    <div class="card-header d-flex flex-wrap align-items-center" style="gap:8px;">
                        <div class="mr-2">
                            Referencia: <strong><?php echo e($labelqr->reference); ?></strong>
                        </div>

                        
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($isSteam): ?>
                            <span class="badge badge-pill"
                                  style="background-color:#17a2b8; color:#fff; font-size:.85rem; padding:6px 12px;">
                                <i class="bi bi-thermometer-high"></i> STEAM — Alta Temperatura (Autoclave)
                            </span>
                        <?php elseif($isHpo): ?>
                            <span class="badge badge-pill"
                                  style="background-color:#6f42c1; color:#fff; font-size:.85rem; padding:6px 12px;">
                                <i class="bi bi-wind"></i> HPO — Baja Temperatura (Peróxido)
                            </span>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                        <div class="ml-auto d-flex flex-wrap align-items-center" style="gap:6px;">
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create_labelqr_discharges')): ?>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($labelqr->status_cycle == 'Cargar'): ?>
                                    <a href="<?php echo e(route('labelqr-discharges.create', $labelqr->id)); ?>"
                                       class="btn btn-sm btn-success d-print-none">
                                        <i class="bi bi-check2-circle"></i> Enviar a Ciclo
                                    </a>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            <?php endif; ?>

                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('print_labelqrs')): ?>
                                <a target="_blank" class="btn btn-sm btn-secondary d-print-none"
                                   href="<?php echo e(route('labelqrs_label.pdf', $labelqr->id)); ?>">
                                    <i class="bi bi-tag"></i> Ver Etiquetas Con Barcode
                                </a>
                                <a target="_blank" class="btn btn-sm btn-secondary d-print-none"
                                   href="<?php echo e(route('labelqrs_label.simple', $labelqr->id)); ?>">
                                    <i class="bi bi-tag"></i> Ver Etiquetas Simple
                                </a>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('print_labelqrs_direct')): ?>
                                    <a target="_blank" class="btn btn-sm btn-secondary d-print-none"
                                       href="<?php echo e(route('labelqrs_label.print', $labelqr->id)); ?>">
                                        <i class="bi bi-printer"></i> Imprimir Etiquetas
                                    </a>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="row mb-4">
                            
                            <div class="col-sm-3 mb-3 mb-md-0">
                                <h5 class="mb-2 border-bottom pb-2">Institución:</h5>
                                <div><strong>Hospital:</strong> <?php echo e(institutes()->institute_name); ?></div>
                                <div><strong>Dirección:</strong> <?php echo e(institutes()->institute_address); ?></div>
                                <div><strong>Área:</strong> <?php echo e(institutes()->institute_area); ?></div>
                                <div><strong>Ciudad:</strong> <?php echo e(institutes()->institute_city); ?></div>
                                <div><strong>País:</strong> <?php echo e(institutes()->institute_country); ?></div>
                            </div>

                            
                            <div class="col-sm-3 mb-3 mb-md-0">
                                <h5 class="mb-2 border-bottom pb-2">Información de Proceso:</h5>
                                <div><strong>Tipo:</strong>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($isSteam): ?>
                                        <span class="text-info font-weight-bold">STEAM / Autoclave</span>
                                    <?php elseif($isHpo): ?>
                                        <span style="color:#6f42c1;" class="font-weight-bold">HPO / Peróxido</span>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </div>
                                <div><strong>Equipo:</strong> <?php echo e($labelqr->machine_name); ?></div>
                                <div><strong>Lote del Equipo:</strong> <?php echo e($labelqr->lote_machine); ?></div>
                                <div><strong>Temp. Equipo:</strong> <?php echo e($labelqr->temp_machine); ?>°C</div>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($isHpo && $labelqr->lote_agente): ?>
                                    <div><strong>Lote Agente:</strong> <?php echo e($labelqr->lote_agente); ?></div>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                <div><strong>Tipo de Programa:</strong> <?php echo e($labelqr->type_program); ?></div>
                                <div><strong>Temp. Ambiente:</strong> <?php echo e($labelqr->temp_ambiente); ?></div>
                                <div><strong>Operario:</strong> <?php echo e($labelqr->operator); ?></div>
                            </div>

                            
                            <div class="col-sm-3 mb-3 mb-md-0">
                                <h5 class="mb-2 border-bottom pb-2">Registro INFO:</h5>
                                <div>Número: <strong><?php echo e($labelqr->reference); ?></strong></div>
                                <div><strong>Fecha Proceso:</strong>
                                    <?php echo e(\Carbon\Carbon::parse($labelqr->created_up)->format('d M, Y')); ?>

                                </div>
                                <div><strong>Estado del Ciclo:</strong>
                                    <?php
                                        $statusColors = [
                                            'Cargar'   => 'badge-warning',
                                            'En Curso' => 'badge-primary',
                                            'Cargado'  => 'badge-success',
                                            'Pendiente'=> 'badge-secondary',
                                        ];
                                        $statusClass = $statusColors[$labelqr->status_cycle] ?? 'badge-secondary';
                                    ?>
                                    <span class="badge <?php echo e($statusClass); ?>"><?php echo e($labelqr->status_cycle); ?></span>
                                </div>
                                <div><strong>Lote Biológico:</strong> <?php echo e($labelqr->lote_biologic); ?></div>
                                <div><strong>Validación Biológico:</strong> <?php echo e($labelqr->validation_biologic); ?></div>
                            </div>

                            
                            <div class="col-sm-3 mb-3 mb-md-0">
                                <h5 class="mb-2 border-bottom pb-2">QR de Proceso:</h5>
                                <?php echo QrCode::size(150)->style('square')->generate(
                                    "$labelqr->reference" .
                                    ' -> Equipo: ' . "$labelqr->machine_name" .
                                    ' -> Lote: ' . "$labelqr->lote_machine" .
                                    ' -> Fecha Elabo: ' . "$labelqr->created_up" .
                                    ' -> Expiracion: ' . "$labelqr->updated_at"
                                ); ?>

                            </div>
                        </div>

                        
                        <div class="table-responsive-sm">
                            <table class="table table-striped table-bordered">
                                <thead class="thead-dark">
                                    <tr>
                                        <th class="align-middle">Descripción</th>
                                        <th class="align-middle">Código</th>
                                        <th class="align-middle text-center">Cantidad</th>
                                        <th class="align-middle text-center">Tipo de Envoltura</th>
                                        <th class="align-middle text-center">Embalaje</th>
                                        <th class="align-middle text-center">Ind. Químico</th>
                                        <th class="align-middle text-center">Vencimiento</th>
                                        <th class="align-middle text-center">Paciente / Casa Com.</th>
                                        <th class="align-middle text-center">QR Paquete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $labelqr->labelqrDetails; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                        <tr>
                                            <td class="align-middle"><?php echo e($item->product_name); ?></td>
                                            <td class="align-middle">
                                                <span class="badge badge-success"><?php echo e($item->product_code); ?></span>
                                            </td>
                                            <td class="align-middle text-center"><?php echo e($item->product_quantity); ?></td>
                                            <td class="align-middle text-center"><?php echo e($item->product_package_wrap); ?></td>
                                            <td class="align-middle text-center"><?php echo e($item->product_eval_package); ?></td>
                                            <td class="align-middle text-center"><?php echo e($item->product_eval_indicator); ?></td>
                                            <td class="align-middle text-center">
                                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($item->product_expiration >= 15): ?>
                                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($item->product_expiration == 180): ?>
                                                        6 Meses
                                                    <?php elseif($item->product_expiration == 270): ?>
                                                        9 Meses
                                                    <?php elseif($item->product_expiration == 365): ?>
                                                        12 Meses
                                                    <?php elseif($item->product_expiration == 545): ?>
                                                        18 Meses
                                                    <?php else: ?>
                                                        <?php echo e($item->product_expiration); ?> Días
                                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                                <?php else: ?>
                                                    <?php echo e($item->product_expiration); ?> Días
                                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                                <br>
                                                <small class="text-muted">
                                                    <?php echo e(\Carbon\Carbon::parse($item->updated_at)->addDays($item->product_expiration)->format('d M, Y')); ?>

                                                </small>
                                            </td>
                                            <td class="align-middle text-center">
                                                <?php echo e($item->product_patient); ?> //
                                                <?php echo e($item->product_outside_company); ?>

                                            </td>
                                            <td class="align-middle text-center">
                                                <?php echo QrCode::size(50)->style('square')->generate(
                                                    "$labelqr->reference" .
                                                    ' // Lote: ' . "$labelqr->lote_machine" .
                                                    ' // Cod: ' . "$item->product_code " .
                                                    ' // Elab: ' . "$item->updated_at " .
                                                    ' // Venc: ' . "$item->updated_at"
                                                ); ?>

                                                <div>
                                                    <small>Lote: <?php echo e($labelqr->lote_machine); ?><br>
                                                    Cód: <?php echo e($item->product_code); ?></small>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                        <tr>
                                            <td colspan="9" class="text-center text-muted py-4">
                                                <i class="bi bi-inbox" style="font-size:2rem;"></i><br>
                                                No hay instrumentos registrados en este proceso.
                                            </td>
                                        </tr>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
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