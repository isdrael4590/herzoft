<!DOCTYPE html>
<html lang="es">

<head>
    <title>QR ETIQUETAS</title>
    <meta name="viewport" >
    <meta charset="UTF-8">

    <!-- External CSS libraries -->
   <style>

/** Print ticket **/
@media print {
    .cabecera-ticket {
    }
        }
    

/*css para etiquetas */
   /*Informacion equipo tickets */
   table, th, td {
    border: 1px solid black;
    border-style:  dotted;
    border-collapse: collapse;
    padding-top: 1px;
    padding-right: 1px;
    padding-bottom: 1px;
    padding-left: 1px;
}
 


@page {
		margin-left: 1cm;
		margin-right: 0.3cm;
        margin-top: 0.2cm;
		margin-bottom: 0.2cm;

	}
    .verticalText {
transform: rotate(90deg);
}



p{
font-size: 7px;
line-height:1;

}

   </style>


    <!-- Custom Stylesheet -->
</head>
<body>
    <?php $__currentLoopData = $labelqr->labelqrDetails; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div>
            <table style="width:100%">
                <head>
                    <tr style="font-size: 11px;">
                    <th colspan="2"> <?php echo e(institutes()->institute_name); ?><br>
                            <p style="font-size: 8px;"> <?php echo e(institutes()->institute_area); ?> - <?php echo e(institutes()->institute_city); ?> -<?php echo e(institutes()->institute_country); ?></p>
                    </th>
                 
                    </tr>
                    <tr style="text-align: center;">
                        <td><img src="data:image/png;base64, <?php echo e(base64_encode(QrCode::format('png')->size(120)->generate($dataqr. $item->product_code ))); ?>">
                        </td>
                        <td>
                        <i style="font-size: 16px;">
                        <strong >Venc. <?php echo Carbon\Carbon::parse($item->updated_at)->addMonth($item->product_expiration)->format('d M, Y'); ?></strong><br>
                        </i>
                        <i style="font-size: 8px;">
                            <small>Elab. <?php echo Carbon\Carbon::parse($item->updated_at)->format('d M, Y'); ?></small><br>
                        </i>
                        <i style="font-size: 8px;">
                        <strong><?php echo e($labelqr->machine_name); ?> Lote: <?php echo e($labelqr->lote_machine); ?> </strong><br>
                        </i>
                        <i style="font-size: 8px;">
                        <small><?php echo e($labelqr->type_program); ?></small><br>
                        </i>
                        <i style="font-size: 10px;">
                        <strong><?php echo e($labelqr->reference); ?></strong><br>
                        </i>
                        <i style="font-size: 8px;">
                        <strong><?php echo e($item->product_name); ?></strong><br>
                        </i>
                        <i style="font-size: 15px;">
                        <small><?php echo e($item->product_code); ?></small><br>
                        </i>
                        <i style="font-size: 8px;">
                        <small>Operario: <?php echo e($labelqr->operator); ?> </small>
                        </i>
                        </td>
                    </tr>
                    <tr style="font-size: 6px;">
                            <td  style="text-align: center;" colspan="2">
                            <i style="font-size: 8px;">
                                <small>El producto no se considera ESTERIL, si el empaque esta ABIERTO o
                                HUMEDO</small>
                            </i>   
                            
                        </td>
                       
                    </tr>
                   
                </head>
            </table>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</body>

</html>
  <?php /**PATH /var/www/html/Modules/Labelqr/Resources/views/labelqrs/print.blade.php ENDPATH**/ ?>