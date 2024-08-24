<!DOCTYPE html>
<html lang="es">

<head>
    <title>QR ETIQUETAS</title>
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
</head>

<body>
    <div class="printer-16 printer-content">



        <?php $__currentLoopData = $labelqr->labelqrDetails; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="cabecera-ticket ">
                <header>
                    <div class="upper-ticket col-xs-12 text-center">
                        <strong><?php echo e(institutes()->institute_name); ?></strong>
                        <small> <?php echo e(institutes()->institute_area); ?> - <?php echo e(institutes()->institute_city); ?> -
                            <?php echo e(institutes()->institute_country); ?></small>
                    </div>




                    <div class="upper-ticket col-xs-4 text-center">
                        <div class="box">
                            <?php echo QrCode::size(80)->style('square')->generate(
                                    "$labelqr->reference" .
                                        ' // Lote: ' .
                                        "$labelqr->lote_machine" .
                                        ' // Elab: ' .
                                        Carbon\Carbon::parse($item->updated_at)->format('d M, Y') .
                                        ' // Venc: ' .
                                        Carbon\Carbon::parse($item->updated_at)->addMonth($item->product_expiration)->format('d M, Y'),
                                ); ?>


                            <strong> <?php echo e($labelqr->reference); ?></strong>
                        </div>
                    </div>
                    <div class="upper-ticket col-xs-4 text-center">

                        <strong>Venc. <?php echo Carbon\Carbon::parse($item->updated_at)->addMonth($item->product_expiration)->format('d M, Y'); ?></strong>
                        <small>Elab. <?php echo Carbon\Carbon::parse($item->updated_at)->format('d M, Y'); ?></small>
                        <small><?php echo e($labelqr->machine_name); ?></small>
                        <small><?php echo e($labelqr->type_program); ?></small>
                        <strong>Lote: <?php echo e($labelqr->lote_machine); ?></strong>
                        <strong><em><?php echo e($item->product_name); ?></em></strong>
                        <small><em><?php echo e($item->product_code); ?></em></small>
                        <small>Operario: <?php echo e($labelqr->operator); ?> </small>


                    </div>
                </header>



                <section class="strap">
                    <div class="box">
                        <div class="">
                            <small>El producto no se considera ESTERIL, si el empaque esta ABIERTO o
                                HUMEDO</small>

                        </div>

                    </div>

                </section>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>






        <div>
           
            <button id="download" class="mt-2 btn btn-info text-light" onclick="downloadSVG()">Imprimir</button>

        </div>

    </div>
</body>

</html>
<script>

    function downloadSVG() {
      const svg = document.getElementById('cabecera-ticket').innerHTML;
      const blob = new Blob([svg.toString()]);
      const element = document.createElement("a");
      element.download = "w3c.svg";
      element.href = window.URL.createObjectURL(blob);
      element.click();
      element.remove();
    }
    </script><?php /**PATH /var/www/html/Modules/Labelqr/Resources/views/labelqrs/print.blade.php ENDPATH**/ ?>