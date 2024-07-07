<!DOCTYPE html>
<html lang="zxx">

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
        <div class="container">
    
            <div class="row">
                @foreach ($labelqr->labelqrDetails as $item)
                    <div class="cabecera-ticket ">
                        <header>
                            <div class="upper-ticket">
                                <strong>{{ institutes()->institute_name }}</strong>
                                <small> {{ institutes()->institute_area }}</small>
                                <small> {{ institutes()->institute_city }} - {{ institutes()->institute_country }}</small>
                            </div>
                            <div class="upper-ticket2">
                                <small>{{ $labelqr->machine_name }}</small>
                                <small>{{ $labelqr->type_program }}</small>
                                <strong>Lote: {{ $labelqr->lote_machine }}</strong>
                            </div>
                        </header>
                        <section class="machine-info">
                            <div class="machine-info2">
                                <small>Venc. {!!Carbon\Carbon::parse(($item->updated_at)->format('d-m-Y'))->addMonth($item->product_expiration)!!}</small>
                                <strong>Elab.: {{$item->updated_at }}</strong>
                            </div>

                        </section>

                        <section class="infos">
                            <div class="detalls_cycle">
                                <div class="box">
                                    <strong><em>{{$item->product_name }}</em></strong>
                                    <strong><em>{{$item->product_code }}</em></strong>
                                    <small>Operario: {{ $labelqr->operator }} </small>
                                    
                                </div>
                            </div>
                            <div class="detalls_cycle">
                              
                                <div class="qrcode">
                                    <div class="box">
                                    {!! QrCode::size(60)->style('square')->generate( "$labelqr->reference"." // Lote: "."$labelqr->lote_machine"." // Cod: "."$item->product_code "." // Elab: "."$item->updated_at "." // Venc: "."$item->updated_at") !!}
                                    <span>
                                        <small>
                                            Lote: {{ $labelqr->lote_machine }}  <br> Código: {{ $item->product_code }}
                                        </small>
                                     </span>
                                    </div>
                                </div>
                            </div>
                        </section>
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



                <div class="printer-btn-section clearfix d-print-none">
                    <a href="javascript:window.print()" class="btn btn-lg btn-print">
                        Imprimir
                    </a>

                </div>
            </div>
        </div>
    </div>


</body>

</html>
