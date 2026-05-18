<!DOCTYPE html>
<html lang="es">

<head>
    <title>QR ETIQUETAS</title>
    <meta name="viewport">
    <meta charset="UTF-8">

    <!-- External CSS libraries -->
    <style>
        /** Print ticket **/
        @media print {
            .cabecera-ticket {}
        }


        /*css para etiquetas */
        /*Informacion equipo tickets */
        table,
        th,
        td {
            border: 1px solid black;
            border-style: dotted;
            border-collapse: collapse;
            padding-top: 1px;
            padding-right: 1px;
            padding-bottom: 1px;
            padding-left: 1px;
        }



        @page {
            margin-left: 1cm;
            margin-right: 0.3cm;
            margin-top: 0.3cm;
            margin-bottom: 0.2cm;

        }




        p {
            font-size: 7px;
            margin-top: 0;
            margin-bottom: 0;

        }
    </style>


    <!-- Custom Stylesheet -->
</head>
<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $labelqr->labelqrDetails; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

    <body>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php for($i = 1; $i <= $item->product_quantity; $i++): ?>
            <div>
                <table style="width:100%">

                    <head>
                        <tr style="font-size: 14px;">
                            <th colspan="2"> <?php echo e(institutes()->institute_name); ?><br>
                                <p style="font-size: 11px;"> <?php echo e(institutes()->institute_area); ?> -
                                    <?php echo e(institutes()->institute_city); ?> -<?php echo e(institutes()->institute_country); ?></p>
                            </th>
                        </tr>
                        <tr style="text-align: center; vertical-align: top;">
                            <td tyle="text-align: center; vertical-align: top;">
                                <p style="font-size: 14px;">
                                    <small>Elab. <?php echo Carbon\Carbon::parse($item->updated_at)->format('d-m-Y'); ?></small><br>
                                </p>
                                <p>
                                    <strong style="font-size: 10px;"><?php echo e($labelqr->machine_name); ?> -> Lote:
                                        <?php echo e($labelqr->lote_machine); ?>

                                    </strong>
                                </p>


                                <p>
                                    <strong style="font-size: 10px;"><?php echo e($item->product_name); ?> </strong>
                                    <small style="font-size: 9px;"><?php echo e($item->product_info); ?> <br>
                                    </small>
                                </p>

                                <p style="font-size: 12px;">
                                    <small> <?php echo e($item->product_outside_company); ?> / <?php echo e($item->product_patient); ?>

                                    </small>

                                </p>

                            </td>
                            <td tyle="text-align: center; vertical-align: top;">
                                <p style="font-size: 13px;">
                                    <strong>Venc. <?php echo Carbon\Carbon::parse($item->updated_at)->addDays($item->product_expiration)->format('d-m-Y'); ?></strong>


                                </p>

                                <p style="font-size: 13px;">
                                    <strong style="font-size: 13px;"><?php echo e($labelqr->reference); ?></strong>
                                    / <?php echo e($labelqr->type_program); ?>

                                </p>



                                <p style="font-size: 12px;">
                                    <small>Operador: <?php echo e($labelqr->operator); ?> </small>
                                </p>
                                <p style="font-size: 12px;">
                                    <small>Oper Emp: <?php echo e($item->product_operator_package); ?> </small>
                                </p>

                            </td>
                        </tr>

                        <tr>
                            <td colspan="2" style="text-align: center; vertical-align: middle;">
                                <img src="data:image/png;base64,<?php echo base64_encode(
                                    \Milon\Barcode\Facades\DNS1DFacade::getBarCodeSVG($item->product_code, $barcode->product_barcode_symbology, 2, 45),
                                ); ?>" alt="Código de Barras">
                            </td>
                        </tr>

                    </head>
                </table>
            </div>
        <?php endfor; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </body>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

</html>
<?php /**PATH /var/www/html/Modules/Labelqr/Resources/views/labelqrs/print3.blade.php ENDPATH**/ ?>