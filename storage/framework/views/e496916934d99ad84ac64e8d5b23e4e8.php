<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Liberar Descarga</title>

    <style>
        /** printer 16 start **/
        .printer-16 {
            background: #fff;
            min-height: 100vh;
            position: relative;
            display: baseline;
            justify-content: center;
            align-items: center;
            padding: 27px 0 30px;
            font-family: Arial, Helvetica, sans-serif;
        }

        .printer-16 .mb-30 {
            margin-bottom: 30px;
        }

        .printer-16 .printer-inner-9 {
            background: #fff;
            max-width: 1296px;
            margin: 0;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }

        .printer-16 .printer-info p {
            margin-bottom: 5px;
        }

        .printer-16 .fw-bold {
            font-weight: 400 !important;
        }

        .printer-16 .printo-addr-1 {
            margin-bottom: 0;
        }

        .printer-16 .default-table {
            position: relative;
            background: #ffffff;
            border: 0;
            border-radius: 5px;
            overflow: hidden;
            width: 100%;
            min-width: 550px;
        }

        .printer-16 .default-table thead {
            background: #F5F7FC;
            border-radius: 8px;
            color: #ffffff;
        }

        .printer-16 .mb-50 {
            margin-bottom: 50px;
        }

        .printer-16 .table-outer {
            overflow-y: hidden;
            overflow-x: auto;
        }

        .printer-16 .default-table thead th {
            position: relative;
            padding: 3px 3px;
            font-size: 18px;
            color: #000000;
            font-weight: 500;
            line-height: 30px;
            white-space: nowrap;
        }

        .printer-16 .default-table tbody tr {
            position: relative;
        }

        .printer-16 .default-table tr td {
            position: relative;
            padding: 3px 3px;
            font-size: 14px;
            color: #000000;
        }

        .printer-16 .mb-30 {
            margin-bottom: 30px;
        }

        .printer-16 h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        .h1,
        .h2,
        .h3,
        .h4,
        .h5,
        .h6 {
            color: #000000;
        }

        .printer-16 .printer-top .logo img {
            height: 80px;
        }

        .printer-16 .printer-top {
            padding: 20px 80px 20px;
        }

        .printer-16 .printer-top .printer {
            float: right;
        }

        .printer-16 .printer-top .printer h1 {
            font-weight: 600;
            margin-bottom: 0;
            color: #0a3ad8;
            font-size: 22px;
        }

        .printer-16 .printer-info {
            padding: 0 10px 10px;
        }

        .printer-16 .printer-info .print-from-2 {
            margin-bottom: 0;
            font-weight: 400;
        }

        .printer-16 .product-summary {
            padding: 0 10px 10px;
        }

        .printer-16 .printer-informeshon-footer {
            position: relative;
            padding: 10px 50px 40px;
            border-top: 1px solid #ECEDF2;
        }

        .printer-16 .printer-informeshon-footer ul {
            display: -ms-flexbox;
            display: flex;
            -ms-flex-align: center;
            -webkit-box-pack: center;
            -ms-flex-pack: center;
            justify-content: center;
            marker: none;
            padding: 0;
            margin: 0;
            list-style: none;
        }

        .printer-16 .printer-informeshon-footer ul li {
            position: relative;
            margin: 0 20px 10px;
            text-align: center;
            font-size: 14px;
            marker: none;
            line-height: 20px;
        }

        .printer-16 .printer-informeshon-footer li a {
            color: #535353;
        }

        .printer-16 .text-muted {
            color: #535353 !important;
        }

        .printer-16 .printer-footer {
            padding: 50px 150px;
        }

        .printer-16 .social-list {
            float: left;
        }

        .printer-16 .social-list span {
            margin-right: 5px;
            font-weight: 500;
            font-size: 12px;
            color: #171717;
        }

        .printer-16 .social-list a {
            width: 50px;
            height: 50px;
            line-height: 50px;
            text-align: center;
            display: inline-block;
            font-size: 12px;
            margin: 0 2px 2px 0;
            color: #3dd5f3;
            background: #f1f1f1;
            border-radius: 50%;
        }

        .printer-16 .social-list a:hover {
            background: #3dd5f3;
            color: #fff;
        }

        .container {
            max-width: 1120px;
            margin: 0 auto;
        }

        @media (max-width: 992px) {
            .printer-16 .printer-top {
                padding: 50px;
            }

            .printer-16 .printer-info {
                padding: 0px 50px;
            }

            .printer-16 .product-summary {
                padding: 0 50px 50px;
            }

            .printer-16 .printer-footer {
                padding: 50px;
            }

            .printer-16 .printer-informeshon-footer {
                padding: 50px 50px 40px;
            }

            .printer-16 .printer-informeshon-footer ul li {
                margin: 10px 10px 10px;
            }
        }

        @media (max-width: 768px) {
            .printer-16 .printer-top {
                padding: 30px;
            }

            .printer-16 .printer-top .logo img {
                height: 20px;
            }

            .printer-16 .printer-top .printer h1 {
                font-size: 20px;
            }

            .printer-16 .printer-info {
                padding: 0px 30px 0;
            }

            .printer-16 .mb-50 {
                margin-bottom: 30px;
            }

            .printer-16 .social-list {
                margin-bottom: 20px;
            }

            .printer-titel {
                padding: 30px;
            }

            .printer-16 .product-summary {
                padding: 0 30px 30px;
            }

            .printer-16 .printer-informeshon-footer {
                padding: 30px 20px 20px;
            }

            .printer-16 .printer-titel {
                background: #fbf8f8;
            }

            .printer-16 .printer-footer {
                padding: 30px;
            }

            .btn-lg {
                height: 45px;
                padding: 0 25px;
                line-height: 45px;
            }
        }

        @media (max-width: 600px) {
            .printer-16 .printer-top .printer {
                float: left;
            }

            .printer-16 .printer-informeshon-footer ul {
                display: initial;
            }

            .printer-16 .printer-top .logo img {
                margin-bottom: 10px;
            }

            .printer-content .important-notes-list-1 {
                margin-bottom: 25px;
            }

            .text-end {
                text-align: left !important;
            }

            .printer-3 .printer-name {
                margin-top: 20px;
                margin-bottom: 30px;
            }
        }

        /** GLOBAL CLASSES **/

        .table {
            color: #535353;
        }

        .printer-content {
            font-family: 'Poppins', sans-serif;
            color: #535353;
            font-size: 12px;
        }

        .container {
            max-width: 1120px;
            margin: 0 auto;
        }

        .printer-content a {
            text-decoration: none;
        }

        .printer-content .img-fluid {
            max-width: 100% !important;
            height: auto;
        }

        .printer-content .form-control:focus {
            box-shadow: none;
        }

        .printer-content h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        .h1,
        .h2,
        .h3,
        .h4,
        .h5,
        .h6 {
            font-family: 'Poppins', sans-serif;
            color: #535353;
        }

        /** BTN LG **/
        .btn-lg {
            font-size: 15px;
            height: 50px;
            padding: 0 35px;
            line-height: 50px;
            border-radius: 3px;
            color: #ffffff;
            border: none;
            margin: 3px;
        }

        .btn-lg {
            display: inline-block;
            vertical-align: middle;
            -webkit-appearance: none;
            text-transform: capitalize;
            transition: all 0.3s linear;
            z-index: 1;
            position: relative;
            overflow: hidden;
            text-align: center;
        }

        .btn-lg:hover {
            color: #ffffff;
        }

        .btn-lg:hover:after {
            transform: perspective(200px) scaleX(1.05) rotateX(0deg) translateZ(0);
            transition: transform 0.9s linear, transform 0.4s linear;
        }

        .btn-lg:after {
            position: absolute;
            top: 0;
            left: 0;
            bottom: 0;
            right: 0;
            content: "";
            transform: perspective(200px) scaleX(0.1) rotateX(90deg) translateZ(-10px);
            transform-origin: bottom center;
            transition: transform 0.9s linear, transform 0.4s linear;
            z-index: -1;
        }

        .btn-check:focus+.btn,
        .btn:focus {
            outline: 0;
            box-shadow: none;
        }

        .btn-download {
            background: #0a3ad8 !important;
        }

        .btn-download:after {
            background: #1eb770;
        }

        .btn-print {
            background: #3a3939;
        }

        .btn-print:after {
            background: #1d1c1c;
        }

        .printer-content .f-w-600 {
            font-weight: 600 !important;
        }

        .printer-content .text-13 {
            font-size: 13px;
        }

        .printer-content .printer-table th:first-child,
        .printer-content .printer-table td:first-child {
            text-align: center;
        }

        .printer-content .color-white {
            color: #fff !important;
        }

        .printer-content .print-header-1 {
            text-transform: uppercase;
            font-weight: 700;
            font-size: 24px;
            color: #262525;
        }

        .printer-content .print-header-2 {
            text-transform: uppercase;
            font-weight: 600;
            font-size: 20px;
        }

        .printer-content .print-title-1 {
            font-weight: 500;
            font-size: 20px;
            text-align: center;
            text-transform: uppercase;

        }

        .printer-content .printo-addr-1 {
            font-size: 15px;
            margin-bottom: 20px;
        }

        .printer-content .item-desc-1 {
            text-align: left;
        }

        .printer-content .item-desc-1 span {
            display: block;
        }

        .printer-content .item-desc-1 small {
            display: block;
        }

        .printer-content .important-notes-list-1 {
            font-size: 13px !important;
            padding-left: 15px;
            margin-bottom: 15px;
        }

        .printer-content .important-notes-list-1 li {
            margin-bottom: 5px;
        }

        .printer-content .bank-transfer-list-1 {
            font-size: 13px !important;
            padding-left: 0px;
        }

        .printer-content .important-notes {
            font-size: 12px !important;
        }

        .printer-content .printer-btn-section {
            text-align: center;
            margin-top: 30px;
        }

        .printer-16 .product-summary tbody,
        td,
        tfoot,
        th,
        thead,
        tr {
            border: solid 2px #f3f2f2;
        }

        table th {
            font-weight: 500;

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
                        <div class="printer-info">
                            <div class="row">
                                <div class="printer-number">
                                    <h1 class="print-title-1">Registro Físico del proceso de esterilización.
                                    </h1>
                                    
                                </div>
                            </div>
                        </div>
                            <div> <table class="default-table">
                                    <thead>
                                        <tr>
                                            <th><div class="logo">
                                        <img src="<?php echo e($institute->getFirstMediaUrl('institutes')); ?>"
                                            alt="Institute Image" class="img-fluid mb-2">
                                    </div></h4>
                                            </th>
                                            <th>                                    <h1># <span><?php echo e($discharge->reference); ?></span></h1>
                                            </h4>
                                            </th>
                                            <th>  <div>Versión: <strong> 01</strong></div>
                                            <div>Vigente: <strong> Septiembre 2024</strong></div></h5>
                                            </th>
                                        </tr>
                                    </thead></div>
                     
                        </div>
                  
                        <div class="product-summary">
                            <div>
                                <table class="default-table">
                                    <thead>
                                        <tr>
                                            <th><strong>Institución:</strong></h4>
                                            </th>
                                            <th><strong>Información de Proceso:</strong></h4>
                                            </th>
                                            <th><strong>Registro INFO:</strong></h5>
                                            </th>
                                            <th><h4 class="mb-2 border-bottom pb-2">QR de Proceso:</h4>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <div>
                                                    <div><?php echo e(Institutes()->institute_name); ?></div>
                                                    <div>Dirección: <?php echo e(Institutes()->institute_address); ?></div>
                                                    <div>Área: <?php echo e(Institutes()->institute_area); ?></div>
                                                    <div>Ciudad: <?php echo e(Institutes()->institute_city); ?></div>
                                                    <div>País: <?php echo e(Institutes()->institute_country); ?></div>
                                                </div>
                                            </td>
                                            <td>
                                                <div>
                                                    <div><strong>Proceso N°:</strong> <?php echo e($labelqr->reference); ?></div>
                                                    <div><strong>Equipo:</strong> <?php echo e($discharge->machine_name); ?></div>
                                                    <div><strong>Lote del Equipo:</strong> <?php echo e($discharge->lote_machine); ?></div>
                                                    <div><strong>Temperatura del equipo:</strong> <?php echo e($discharge->temp_machine); ?></div>
                                                    <div><strong>Tipo de Programa:</strong> <?php echo e($discharge->type_program); ?></div>
                                                    <div><strong>Temperatura del Ambiente: </strong> <?php echo e($discharge->temp_ambiente); ?>

                                                    </div>
                                                    <div><strong>Operario:</strong> <?php echo e($discharge->operator); ?></div>
                                                </div>
                                            </td>
                                            <td>
                                                <div>
                                                    <div>Número: <strong><?php echo e($discharge->reference); ?></strong></div>
                                                    <div><strong>Fecha Proceso:
                                                        </strong><?php echo e(\Carbon\Carbon::parse($discharge->created_up)->format('d M, Y')); ?>

                                                    </div>
                                                    <div><strong>Estado del Ciclo: </strong> <?php echo e($discharge->status_cycle); ?></div>
                                                    <div><strong>Lote del Biológico: </strong> <?php echo e($discharge->lote_biologic); ?></div>
                                                    <div><strong>Validación Biológico: </strong> <?php echo e($discharge->validation_biologic); ?>

                                                    </div>
                                                    <div><strong>Inicio proceso: </strong> <?php echo e($discharge->created_at); ?>

                                                    </div>
                                                    <div><strong>Fin de Proceso: </strong> <?php echo e($discharge->updated_at); ?>

                                                    </div>
                                                </div>
                                            </td>
                                            <td style= "text-align:center">
                                            <img src="data:image/png;base64, <?php echo e(base64_encode(QrCode::format('png')->size(150)->generate($data))); ?> ">
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <br>
                            <div class="product-summary">
                                <div>
                                    <table class="default-table printer-table">
                                        <thead>
                                            <tr>
                                                <th>Código </th>
                                                <th>Descripción</th>
                                                <th>Envoltura</th>
                                                <th>Validación</th>
                                                <th>Tipo Químico</th>
                                                <th>F. Expiración</th>
                                                <th>Reporte de Equipo</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $__currentLoopData = $discharge->dischargeDetails; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td style= "text-align:center">
                                                        <?php echo e($item->product_code); ?> <br>
                                                    </td>
                                                    <td style= "text-align:center">
                                                        <?php echo e($item->product_name); ?>

                                                    </td>
                                                    <td style= "text-align:center">
                                                        <?php echo e($item->product_package_wrap); ?>

                                                    </td>
                                                    <td style= "text-align:center">
                                                        <?php echo e($item->product_eval_package); ?>

                                                    </td>
                                                    <td style= "text-align:center">
                                                        <?php echo e($item->product_eval_indicator); ?>

                                                    </td>
                                                    <td style= "text-align:center">
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


                            </div>
                        </div>
                    </div>
                    <table class="default-table ">
                        <tr>
                            <th style= " font-size: 15px; text-align: justify;">
                                
                            Resultado Etiqueta Biologico:
                                <br><br><br><br><br><br>
                            </th>
                            <th style= " font-size: 15px; text-align: justify;">
                            Impresión Inc. Biológico<br><br><br><br><br><br>
                            </th>
                        </tr>
                    </table>
                    <table class="default-table ">
                        <tr>
                            <th style= " font-size: 15px; text-align: justify;">
                                
                                Operario: <span> <?php echo e($discharge->operator); ?></span>
                                <br><br><br><br><br><br>
                            </th>
                            <th style= " font-size: 15px; text-align: justify;">
                                Supervisor: <span> </span><br><br><br><br><br><br>
                            </th>
                        </tr>
                    </table>
                  
                    <div class="printer-informeshon-footer">
                        <ul>
                            <li><strong>Nota:</strong> Asegurarse de la esterilidad del instrumental</li>
                        </ul>
                        <ul>
                            <li><a href="#"> <?php echo e(Settings()->company_name); ?> - <?php echo e(Settings()->company_email); ?> -
                                    <?php echo e(Settings()->company_phone); ?></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
</body>
</html>
<?php /**PATH /var/www/html/Modules/Discharge/Resources/views/discharges/print2.blade.php ENDPATH**/ ?>