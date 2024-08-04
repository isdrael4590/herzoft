<!DOCTYPE html>
<html lang="es">

<head>
    <title>QR ETIQUETAS</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">

    <!-- External CSS libraries -->
    <link type="text/css" rel="stylesheet" href="{{ asset('assets/printer/css/bootstrap.min.css') }}">

    <!-- Google fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <!-- Custom Stylesheet -->
    <link type="text/css" rel="stylesheet" href="{{ asset('assets/printer/css/style.css') }}">
</head>

<body>
    <div class="printer-16 printer-content">



        @foreach ($labelqr->labelqrDetails as $item)
            <div class="cabecera-ticket ">
                <header>
                    <div class="upper-ticket col-xs-12 text-center">
                        <strong>{{ institutes()->institute_name }}</strong>
                        <small> {{ institutes()->institute_area }} - {{ institutes()->institute_city }} -
                            {{ institutes()->institute_country }}</small>
                    </div>




                    <div class="upper-ticket col-xs-4 text-center">
                        <div class="box">
                            {!! QrCode::size(80)->style('square')->generate(
                                    "$labelqr->reference" .
                                        ' // Lote: ' .
                                        "$labelqr->lote_machine" .
                                        ' // Elab: ' .
                                        Carbon\Carbon::parse($item->updated_at)->format('d M, Y') .
                                        ' // Venc: ' .
                                        Carbon\Carbon::parse($item->updated_at)->addMonth($item->product_expiration)->format('d M, Y'),
                                ) !!}

                            <strong> {{ $labelqr->reference }}</strong>
                        </div>
                    </div>
                    <div class="upper-ticket col-xs-4 text-center">

                        <strong>Venc. {!! Carbon\Carbon::parse($item->updated_at)->addMonth($item->product_expiration)->format('d M, Y') !!}</strong>
                        <small>Elab. {!! Carbon\Carbon::parse($item->updated_at)->format('d M, Y') !!}</small>
                        <small>{{ $labelqr->machine_name }}</small>
                        <small>{{ $labelqr->type_program }}</small>
                        <strong>Lote: {{ $labelqr->lote_machine }}</strong>
                        <strong><em>{{ $item->product_name }}</em></strong>
                        <small><em>{{ $item->product_code }}</em></small>
                        <small>Operario: {{ $labelqr->operator }} </small>


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
        @endforeach






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
    </script>