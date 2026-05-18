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
            margin-left: 0.8cm;
            margin-right: 0.3cm;
            margin-top: 0.3cm;
            margin-bottom: 0.2cm;

        }


        body {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        p {
            font-size: 14px;
            margin-top: 0;
            margin-bottom: 0;

        }
    </style>


    <!-- Custom Stylesheet -->
</head>

<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $labelqr->labelqrDetails; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

    <body>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php for($i = 1; $i <= $item->product_quantity; $i++): ?>
            <div style="align-content: center">
                <table style="width:100%">

                    <head>
                        <tr style="font-size: 16px;">
                            <th colspan="2"> <?php echo e(institutes()->institute_name); ?><br>
                                <p style="font-size: 13px;"> <?php echo e(institutes()->institute_area); ?> -
                                    <?php echo e(institutes()->institute_city); ?> -<?php echo e(institutes()->institute_country); ?></p>
                            </th>
                        </tr>
                        <tr style="text-align: center; vertical-align: top;">
                            <td tyle="text-align: center; vertical-align: top;">
                                <p style="font-size: 17px;">
                                    <small>Elab. <?php echo Carbon\Carbon::parse($item->updated_at)->format('d-m-Y'); ?></small><br>
                                </p>
                                <p>
                                    <strong style="font-size: 15px;"><?php echo e($labelqr->machine_name); ?> -> Lote:
                                        <?php echo e($labelqr->lote_machine); ?>

                                    </strong>
                                </p>


                                <p>
                                    <strong style="font-size: 14px;"><?php echo e($item->product_name); ?> </strong>
                                    <small style="font-size: 12px;"><?php echo e($item->product_info); ?> <br>
                                    </small>
                                </p>

                                <p style="font-size: 13px;">
                                    <small> <?php echo e($item->product_outside_company); ?> / <?php echo e($item->product_patient); ?>

                                    </small>

                                </p>

                            </td>
                            <td tyle="text-align: center; vertical-align: top;">
                                <p style="font-size: 17px;">
                                    <strong>Venc. <?php echo Carbon\Carbon::parse($item->updated_at)->addDays($item->product_expiration)->format('d-m-Y'); ?></strong>


                                </p>
                                <p>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = \Modules\Product\Entities\Product::where('product_code', $item->product_code) ->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product_code): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <strong><?php echo e($product_code->area); ?></strong>

                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                   
                                        
                                </p>
                                <p style="font-size: 14px;">
                                    <strong style="font-size: 14px;"><?php echo e($labelqr->reference); ?></strong>
                                    / <?php echo e($labelqr->type_program); ?>

                                </p>



                                <p style="font-size: 14px;">
                                    <small>Operador: <?php echo e($labelqr->operator); ?> </small>
                                </p>
                                <p style="font-size: 14px;">
                                    <small>Oper Emp: <?php echo e($item->product_operator_package); ?> </small>
                                </p>

                            </td>
                        </tr>



                    </head>
                </table>
            </div>
        <?php endfor; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </body>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

</html>
<?php /**PATH /var/www/html/Modules/Labelqr/Resources/views/labelqrs/printsimple.blade.php ENDPATH**/ ?>