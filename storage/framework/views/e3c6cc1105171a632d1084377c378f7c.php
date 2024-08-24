<!DOCTYPE html>
<html lang="en">

<head>
    <title>Liberar Descarga</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">

    <!-- External CSS libraries -->
    <link type="text/css" rel="stylesheet" href="<?php echo e(asset('assets/printer/css/bootstrap.min.css')); ?>">

    <!-- Google fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <!-- Custom Stylesheet -->
    <link type="text/css" rel="stylesheet" href="<?php echo e(asset('assets/printer/css/style.css')); ?>">
    <style>
        /* default for all pages */
        @page {
            size: A4 portrait;
        }

        p {
            font-size: 1.5em;
        }
    </style>
</head>

<body>
    <div class="printer-16 printer-content">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="printer-inner-9" id="printer_wrapper">
                        <div class="printer-top">
                            <div class="row">
                                <div class="col-lg-4 col-sm-4">
                                    <div class="logo">
                                        <img src="<?php echo e($institute->getFirstMediaUrl('institutes')); ?>"
                                            alt="Institute Image" class="img-fluid  mb-1">
                                    </div>
                                </div>
                                <div class="col-lg-4 col-sm-4">
                                    <div class="printer">
                                        <h1># <span><?php echo e($discharge->reference); ?></span></h1>
                                        <h4> <span><?php echo e($discharge->machine_name); ?></span></h4>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-sm-4">
                                    <div class="printer">
                                        <div>Versión: <strong> 01</strong></div>
                                        <div>Vigente: <strong> Junio 2024</strong></div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="printer-info">
                            <div class="row">

                                <div class="printer-number">
                                    <h6 class="print-title-2">Registro Físico del proceso de esterilización:</h6>
                                    <p class="printo-addr"> Fecha:
                                        <?php echo e(\Carbon\Carbon::parse($discharge->updated_at)->format('d M, Y')); ?>

                                    </p>
                                </div>
                            </div>

                        </div>
                        <div class="printer-info">
                            <div class="row mb-4">
                                <div class="col-sm-3 mb-3 mb-md-0">
                                    <h4 class="print-title-1 border-bottom">Institución:</h4>
                                    <div><?php echo e(Institutes()->institute_name); ?></div>
                                    <div>Dirección: <?php echo e(Institutes()->institute_address); ?></div>
                                    <div>Área: <?php echo e(Institutes()->institute_area); ?></div>
                                    <div>Ciudad: <?php echo e(Institutes()->institute_city); ?></div>
                                    <div>País: <?php echo e(Institutes()->institute_country); ?></div>
                                </div>
                                <div class="col-sm-3 mb-3 mb-md-0">
                                    <h4 class="print-title-1 border-bottom">Información de Proceso:</h4>
                                    <div><strong>Proceso N°:</strong> <?php echo e($labelqr->reference); ?></div>
                                    <div><strong>Equipo:</strong> <?php echo e($discharge->machine_name); ?></div>
                                    <div><strong>Lote del Equipo:</strong> <?php echo e($discharge->lote_machine); ?></div>
                                    <div><strong>Temperatura del equipo:</strong> <?php echo e($discharge->temp_machine); ?></div>
                                    <div><strong>Tipo de Programa:</strong> <?php echo e($discharge->type_program); ?></div>
                                    <div><strong>Temperatura del Ambiente: </strong> <?php echo e($discharge->temp_ambiente); ?>

                                    </div>
                                    <div><strong>Operario:</strong> <?php echo e($discharge->operator); ?></div>
                                </div>
                                <div class="col-sm-3 mb-3 mb-md-0">
                                    <h5 class="print-title-1 border-bottom">Registro INFO:</h5>
                                    <div>Número: <strong><?php echo e($discharge->reference); ?></strong></div>
                                    <div><strong>Fecha Proceso:
                                        </strong><?php echo e(\Carbon\Carbon::parse($discharge->created_up)->format('d M, Y')); ?>

                                    </div>
                                    <div><strong>Estado del Ciclo: </strong> <?php echo e($discharge->status_cycle); ?></div>
                                    <div><strong>Lote del Biológico: </strong> <?php echo e($discharge->lote_biologic); ?></div>
                                    <div><strong>Validación Biológico: </strong> <?php echo e($discharge->validation_biologic); ?>

                                    </div>
                                    <div><strong>Fecha de Expiración: </strong> <?php echo e($discharge->expiration); ?></div>
                                </div>
                                <div class="col-sm-3 mb-3 mb-md-0">
                                    <h4 class="mb-2 border-bottom pb-2">QR de Proceso:</h4>
                                <?php echo QrCode::size(150)->style('square')->generate( "Ref. Proces: "."$discharge->labelqr_id"." // Ref. Des: "."$discharge->reference"." // Equipo: "."$discharge->machine_name"." // Lote: "."$discharge->lote_machine"." // Fecha: "."$discharge->updated_at"); ?>

                                    <h6>#<span><?php echo e($discharge->reference); ?></span></h6>
                                </div>
                            </div>
                        </div>

                        <div class="product-summary">
                            <div>
                                <table class="default-table printer-table">
                                    <thead>
                                        <tr>
                                            <th>Código </th>
                                            <th>Descripción</th>
                                            <th>Envoltura</th>
                                            <th>Validación</th>
                                            <th>Tipo. Químico</th>
                                            <th>Fecha Expiración</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php $__currentLoopData = $discharge->dischargeDetails; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td>
                                                    <?php echo e($item->product_code); ?> <br>
                                                </td>
                                                <td>
                                                    <?php echo e($item->product_name); ?>

                                                </td>
                                                <td>
                                                    <?php echo e($item->product_package_wrap); ?>

                                                </td>
                                                <td>
                                                    <?php echo e($item->product_eval_package); ?>

                                                </td>
                                                <td>
                                                    <?php echo e($item->product_eval_indicator); ?>

                                                </td>
                                                <td>
                                                    <?php echo Carbon\Carbon::parse(($item->updated_at))->addMonth($item->product_expiration)->format('d M, Y'); ?>

                                                </td>

                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            </div>
                            <br>
                            <div>
                                <?php if(@empty($discharge->note)): ?>
                                    Notas: N/A
                                <?php else: ?>
                                    Notas: <?php echo e($discharge->note); ?>

                                <?php endif; ?>
                            </div>
                            <br>
                            <div>
                                <table class="default-table ">
                                    <thead>
                                        <tr>
                                            <th> Resultado Etiqueta Biologico:</th>
                                            <th>Impresión Inc. Biológico</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <br><br><br><br><br><br>
                                            </td>
                                            <td></td>
                                        </tr>



                                    </tbody>


                                </table>
                            </div>
                            <table class="default-table ">
                                <tr>
                                    <br><br><br>
                                    <td>Responsable: <span> <?php echo e($discharge->operator); ?></span></td>
                                </tr>
                            </table>
                        </div>
                        <div class="printer-informeshon-footer">
                            <ul>
                                <li><strong>Nota:</strong> Asegurarse que el producto entregado sea el correcto.</li>
                            </ul>
                            <ul>
                                <li><a href="#"> <?php echo e(Settings()->company_name); ?></a></li>
                                <li><a href="#"><?php echo e(Settings()->company_email); ?></a></li>
                                <li><a href="#"><?php echo e(Settings()->company_phone); ?></a></li>
                            </ul>
                        </div>
                    </div>

                </div>

            </div>
            <div class="printer-btn-section clearfix d-print-none">
                <a href="javascript:window.print()" class="btn btn-lg btn-print">
                    Imprimir
                </a>
            </div>
        </div>
    </div>
    </div>
    </div>

</body>

</html>
<?php /**PATH /var/www/html/Modules/Discharge/Resources/views/discharges/print.blade.php ENDPATH**/ ?>