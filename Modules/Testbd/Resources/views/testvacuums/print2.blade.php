<!DOCTYPE html>
<html lang="zxx">

<head>
    <title>Resultado Vacio</title>
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
                                            alt="Institute Image" class="img-fluid  mb-1">
                                    </div>
                                </div>
                                <div class="col-lg-4 col-sm-4">
                                    <div class="printer">
                                        <h1># <span>{{ $testvacuum->testvacuum_reference }}</span></h1>
                                        <h4> <span>{{ $testvacuum->machine_name }}</span></h4>
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
                                    <h4 class="print-title-2">Resultado de Test de Vacio:</h4>
                                    <p class="printo-addr"> Fecha:
                                        {{ \Carbon\Carbon::parse($testvacuum->updated_at)->format('d M, Y') }}
                                    </p>
                                </div>
                            </div>

                        </div>
                        <div class="printer-info">
                            <div class="row mb-4">
                                <div class="col-sm-4 mb-3 mb-md-0">
                                    <h4 class="print-title-1">Institución:</h4>
                                    <div>{{ Institutes()->institute_name }}</div>
                                    <div><strong>Dirección: </strong>{{ Institutes()->institute_address }}</div>
                                    <div><strong>Área: </strong>{{ Institutes()->institute_area }}</div>
                                    <div><strong>Ciudad: </strong>{{ Institutes()->institute_city }}</div>
                                    <div><strong>País:</strong> {{ Institutes()->institute_country }}</div>
                                </div>
                                <div class="col-sm-4 mb-3 mb-md-0">
                                    <h4 class="print-title-1">Información de Registro</h4>
                                    <div>Lote del equipo: <strong> {{ $testvacuum->lote_machine }}</strong></div>
                                    <div>Equipo: <strong>{{ $testvacuum->machine_name }}</strong></div>
                                    <div>Temperatura Ambiente:<strong> {{ $testvacuum->temp_ambiente }}</strong></div>
                                    <div>Operario:<strong> {{ $testvacuum->operator }}</strong></div>
                                </div>
                                <div class="col-sm-4 mb-3 mb-md-0">
                                    <h4 class="print-title-1">Registro INFO:</h4>
                                    <div>Número: <strong>{{ $testvacuum->testvacuum_reference }}</strong></div>
                                    <div>Fecha: {{ \Carbon\Carbon::parse($testvacuum->updated_at)->format('d M, Y') }}
                                    </div>
                                    <div>Hora: {{ \Carbon\Carbon::parse($testvacuum->updated_at)->isoFormat('H:mm:ss A') }}
                                    </div>
                                    
                                    <div>
                                        Validación de Test: <h3>{{ $testvacuum->validation_vacuum }}</h3>
                                    </div>
                                </div>
                            </div>
                            <br>
                        </div>

                        <div class="product-summary">
                            <div>
                                <div class="align-middle">
                                    <img src="{{ URL::to('assets/img/impresiones/espacio_impresionbd.png') }}"
                                        height="580" IMA>
                                </div>
                            </div>
                            <br><br>
                            <div>
                                @if (@empty($testvacuum->note))
                                    Notas: N/A
                                @else
                                    Notas: {{ $testvacuum->note }}
                                @endif
                            </div>
                            <br><br><br><br>
                            <br><br><br><br> <br><br><br><br> 
                            <table class="default-table ">

                                <tr>
                                    <th rowspan="10"></th>
                                    <th>Firma de Operador: <span> {{ $testvacuum->operator }}</span></th>
                                </tr>
                            </table>
                        </div>
                        <div class="printer-informeshon-footer">
                            <ul>
                                <li><strong>Nota:</strong> Asegurarse la validación del Test.</li>
                            </ul>
                            <ul>
                                <li><a href="#"> {{ Settings()->company_name }}</a></li>
                                <li><a href="#">{{ Settings()->company_email }}</a></li>
                                <li><a href="#">{{ Settings()->company_phone }}</a></li>
                            </ul>
                        </div>
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
