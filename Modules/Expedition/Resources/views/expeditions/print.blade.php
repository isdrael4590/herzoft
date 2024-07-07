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
    <style>
        /* default for all pages */
        @page {
            size: A4 portrait;
        }

        p {
            font-size: 1.5em;
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
                            <div class="row">
                                <div class="col-lg-4 col-sm-4">
                                    <div class="logo">
                                        <img src="{{ $institute->getFirstMediaUrl('institutes') }}"
                                            alt="Institute Image" class="img-fluid mb-2">
                                    </div>
                                </div>
                                <div class="col-lg-4 col-sm-4">
                                    <div class="printer">
                                        <h1># <span>{{ $expedition->reference }}</span></h1>

                                    </div>
                                </div>
                                <div class="col-lg-4 col-sm-4">
                                    <div class="printer">
                                        <div>Versión: <strong> 01</strong></div>
                                        <div>Vigente: <strong> Junio 2024</strong></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="printer-info">
                            <div class="row">

                                <div class="printer-number">
                                    <h1 class="print-title-1">Registro Físico del proceso de Despacho de instrumental.
                                    </h1>
                                    <p class="printo-addr-1">
                                        {{ \Carbon\Carbon::parse($expedition->created_up)->format('d M, Y') }}
                                    </p>
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
                                    <div><strong>Temperatura del Ambiente: </strong> {{ $expedition->temp_ambiente }}
                                    </div>
                                    <div><strong>Operario:</strong> {{ $expedition->operator }}</div>
                                    <div><strong>Personal Retiro: </strong> {{ $expedition->staff_expedition }}</div>
                                </div>
                                <div class="col-sm-4 mb-3 mb-md-0">
                                    <h5 class="print-title-1 border-bottom">Registro INFO:</h5>
                                    <div>Número: <strong>{{ $expedition->reference }}</strong></div>
                                    <div><strong>Fecha Despacho:
                                        </strong>{{ \Carbon\Carbon::parse($expedition->created_up)->format('d M, Y') }}
                                    </div>
                                    <div><strong>Estado de la expedición: </strong>
                                        {{ $expedition->status_expedition }}</div>


                                    <div><strong>Area Expedido: </strong> {{ $expedition->area_expedition }}</div>
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
                                    <th>
                                        <br><br>
                                        Emisor: <span> {{ $expedition->operator }}</span>
                                        <br><br><br>
                                    </th>
                                    <th><br><br>Receptor: <span> {{ $expedition->staff_expedition }}</span><br><br><br>
                                    </th>
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
                        <li><a href="#"> {{ Settings()->company_name }}</a></li>
                        <li><a href="#">{{ Settings()->company_email }}</a></li>
                        <li><a href="#">{{ Settings()->company_phone }}</a></li>
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
</body>

</html>
