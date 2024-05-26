<!DOCTYPE html>
<html lang="zxx">

<head>
    <title>Expedir Material </title>
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
                                        <h5><span>Registro Físico del proceso de Despacho de instrumental.</span></h5>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="printer-info">
                            <div class="row mb-4">
                                <div class="col-sm-4 mb-3 mb-md-0">
                                    <h4 class="print-title-1 border-bottom">Institución:</h4>
                                    <div>{{ Institutes()->institute_name }}</div>
                                    <div>Dirección: {{ Institutes()->institute_address }}</div>
                                    <div>Área: {{ Institutes()->institute_area }}</div>
                                    <div>Ciudad: {{ Institutes()->institute_city }}</div>
                                    <div>País: {{ Institutes()->institute_country }}</div>
                                </div>
                                <div class="col-sm-4 mb-3 mb-md-0">
                                    <h4 class="print-title-1 border-bottom">Información de Despacho:</h4>


                                    <div><strong>Lote del Equipo:</strong> {{ $expedition->lote_machine }}</div>

                                    <div><strong>Tipo de Programa:</strong> {{ $expedition->type_program }}</div>
                                    <div><strong>Temperatura del Ambiente: </strong> {{ $expedition->temp_ambiente }}
                                    </div>
                                    <div><strong>Lote del Biológico: </strong> {{ $expedition->lote_biologic }}</div>
                                    <div><strong>Operario:</strong> {{ $expedition->operator }}</div>

                                </div>
                                <div class="col-sm-4 mb-3 mb-md-0">
                                    <h5 class="print-title-1 border-bottom">Registro INFO:</h5>
                                    <div>Número: <strong>{{ $expedition->reference }}</strong></div>
                                    <div><strong>Fecha Proceso:
                                        </strong>{{ \Carbon\Carbon::parse($expedition->created_up)->format('d M, Y') }}
                                    </div>
                                    <div><strong>Estado de la expedición: </strong>
                                        {{ $expedition->status_expedition }}</div>


                                    <div><strong>Area Expedido: </strong> {{ $expedition->area_expedition }}</div>
                                </div>
                                <div><strong>Personal Retiro: </strong> {{ $expedition->staff_expedition }}</div>
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
                                        <th>Expiración</th>

                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($expedition->expeditionDetails as $item)
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
                                                {{ $item->product_expiration }}
                                            </td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <br>
                        <div>
                            @if (@empty($expedition->note))
                                Notas: N/A
                            @else
                                Notas: {{ $expedition->note }}
                            @endif
                        </div>
                        <br>

                        <table class="default-table ">
                            <tr>
                                <td>Emisor: <span> {{ $expedition->operator }}</span></td>
                            </tr>
                            <tr>
                                <td>Receptor: <span> {{ $expedition->staff_expedition }}</span></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="printer-informeshon-footer">
                <ul>
                    <li><strong>Nota:</strong> Asegurarse que el producto entregado sea el correcto.</li>
                </ul>
                <ul>

                    <li><a href="#">HerZoft</a></li>
                    <li><a href="ferisdra@hotmail.com">ferisdra@hotmail.com</a></li>
                    <li><a href="#">+593 998484190</a></li>
                </ul>
            </div>
            <div class="printer-btn-section clearfix d-print-none">
                <a href="javascript:window.print()" class="btn btn-lg btn-print">
                    Imprimir
                </a>
    
            </div>
        </div>
       
       
    </div>
   </body>

</html>
