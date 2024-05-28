<!DOCTYPE html>
<html lang="en">

<head>
    <title>Liberar Descarga</title>
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
                <div class="col-lg-12">
                    <div class="printer-inner-9" id="printer_wrapper">
                        <div class="printer-top">
                            <div class="row">
                                <div class="col-lg-6 col-sm-6">
                                    <div class="logo">
                                        <img class="logo" src="{{ asset('assets/images/logo.png') }}" alt="logo">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-6">
                                    <div class="printer">
                                        <h5><span>Registro Físico del proceso de esterilización Con el equipo:</span></h5>
                                        <h2 class="print-title-1">{{ $discharge->machine_name }}</h2>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="printer-info">
                            <div class="row mb-4">
                                <div class="col-sm-3 mb-3 mb-md-0">
                                    <h4 class="print-title-1 border-bottom">Institución:</h4>
                                    <div>{{ Institutes()->institute_name }}</div>
                                    <div>Dirección: {{ Institutes()->institute_address }}</div>
                                    <div>Área: {{ Institutes()->institute_area }}</div>
                                    <div>Ciudad: {{ Institutes()->institute_city }}</div>
                                    <div>País: {{ Institutes()->institute_country }}</div>
                                </div>
                                <div class="col-sm-3 mb-3 mb-md-0">
                                    <h4 class="print-title-1 border-bottom">Información de Proceso:</h4>

                                    <div><strong>Equipo:</strong> {{ $discharge->machine_name }}</div>
                                    <div><strong>Lote del Equipo:</strong> {{ $discharge->lote_machine }}</div>
                                    <div><strong>Temperatura del equipo:</strong> {{ $discharge->temp_machine }}</div>
                                    <div><strong>Tipo de Programa:</strong> {{ $discharge->type_program }}</div>
                                    <div><strong>Temperatura del Ambiente: </strong> {{ $discharge->temp_ambiente }}
                                    </div>
                                    <div><strong>Operario:</strong> {{ $discharge->operator }}</div>
                                </div>
                                <div class="col-sm-3 mb-3 mb-md-0">
                                    <h5 class="print-title-1 border-bottom">Registro INFO:</h5>
                                    <div>Número: <strong>{{ $discharge->reference }}</strong></div>
                                    <div><strong>Fecha Proceso:
                                        </strong>{{ \Carbon\Carbon::parse($discharge->created_up)->format('d M, Y') }}
                                    </div>
                                    <div><strong>Estado del Ciclo: </strong> {{ $discharge->status_cycle }}</div>
                                    <div><strong>Lote del Biológico: </strong> {{ $discharge->lote_biologic }}</div>
                                    <div><strong>Validación Biológico: </strong> {{ $discharge->validation_biologic }}
                                    </div>
                                    <div><strong>Fecha de Expiración: </strong> {{ $discharge->expiration }}</div>
                                </div>
                                <div class="col-sm-3 mb-3 mb-md-0">
                                    <h4 class="print-title-1 border-bottom">QR Proceso:</h4>
                                    <span class="aling-middle">{!! QrCode::size(100)->style('square')->generate(
                                        "$discharge->reference" .
                                            ' // Equipo: ' .
                                            "$discharge->machine_name" .
                                            ' // Lote: ' .
                                            "$discharge->lote_machine" .
                                            ' // Fecha: ' .
                                            "$discharge->created_up" .
                                            ' // Expiracion: ' .
                                            "$discharge->expiration",
                                    ) !!}</span>
                                    <h6>#<span>{{ $discharge->reference }}</span></h6>
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
                                            <th>Val. Embalaje</th>
                                            <th>Val. Químico</th>

                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($discharge->dischargeDetails as $item)
                                            <tr>
                                                <td>
                                                    {{ $item->product_code }} <br>
                                                </td>
                                                <td>
                                                    {{ $item->product_name }}
                                                </td>
                                                <td>
                                                    {{ $item->product_package_wrap }}
                                                </td>
                                                <td>
                                                    {{ $item->product_eval_package }}
                                                </td>
                                                <td>
                                                    {{ $item->product_eval_indicator }}
                                                </td>

                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <br>
                            <div>
                                @if (@empty($discharge->note))
                                    Notas: N/A
                                @else
                                    Notas: {{ $discharge->note }}
                                @endif
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
                                            <td></td>
                                            <td></td>
                                        </tr>

                                        <tr>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td></td>

                                        </tr>
                                        <tr>
                                            <td></td>
                                        </tr>

                                    </tbody>


                                </table>
                            </div>
                            <table class="default-table ">
                                <tr>
                                    <td>Responsable: <span> {{ $discharge->operator }}</span></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="printer-informeshon-footer">
                    <ul>
                        <li><strong>Nota:</strong> Asegurarse que el producto tiene una liberación del biológico.</li>
                    </ul>
                    <ul>

                        <li><a href="#">HerZoft</a></li>
                        <li><a href="herzoftgroup@gmail.com">herzoftgroup@gmail.com</a></li>
                        <li><a href="#">+593 998484190</a></li>
                    </ul>
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
