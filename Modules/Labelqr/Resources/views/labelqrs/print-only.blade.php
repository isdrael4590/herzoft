<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/printer/css/style.css') }}">
</head>

<body>
    <div class="printer-16 printer-content">
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
                        <small>Venc. {!! Carbon\Carbon::parse($item->updated_at->format('d-m-Y'))->addMonth($item->product_expiration) !!}</small>
                        <strong>Elab.: {{ $item->updated_at }}</strong>
                    </div>

                </section>

                <section class="infos">
                    <div class="detalls_cycle">
                        <div class="box">
                            <strong><em>{{ $item->product_name }}</em></strong>
                            <strong><em>{{ $item->product_code }}</em></strong>
                            <small>Operario: {{ $labelqr->operator }} </small>

                        </div>
                    </div>
                    <div class="detalls_cycle">

                        <div class="qrcode">
                            <div class="box">
                                {!! QrCode::size(60)->style('square')->generate(
                                        "$labelqr->reference" .
                                            ' // Lote: ' .
                                            "$labelqr->lote_machine" .
                                            ' // Cod: ' .
                                            "$item->product_code " .
                                            ' // Elab: ' .
                                            "$item->updated_at " .
                                            ' // Venc: ' .
                                            "$item->updated_at",
                                    ) !!}
                                <span>
                                    <small>
                                        Lote: {{ $labelqr->lote_machine }} <br> Código: {{ $item->product_code }}
                                    </small>
                                </span>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="strap">
                    <div class="box">
                        <div class="">
                            <small>El producto no se considera ESTERIL, si el empaque esta ABIERTO o HUMEDO</small>
                        </div>
                    </div>
                </section>
            </div>
        @endforeach
    </div>
    </div>

</body>

</html>
