<!DOCTYPE html>
<html lang="zxx">

<head>
    <title>Resultado Bowie & Dick</title>
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
                                        <h1>#<span>{{ $testbd->testbd_reference }}</span></h1>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="printer-info">
                            <div class="row">

                                <div class="printer-number">
                                    <h4 class="print-title-1">Fecha de Test de Bowie & Dick:</h4>
                                    <p class="printo-addr-1">
                                        {{ \Carbon\Carbon::parse($testbd->updated_at)->format('d M, Y') }}
                                    </p>
                                </div>
                            </div>

                        </div>
                        <div class="printer-info">
                            <div class="row mb-4">
                                <div class="col-sm-4 mb-3 mb-md-0">
                                    <h4 class="print-title-1">Institución:</h4>
                                    <div>{{ Institutes()->institute_name }}</div>
                                    <div>Dirección: {{ Institutes()->institute_address }}</div>
                                    <div>Área: {{ Institutes()->institute_area }}</div>
                                    <div>Ciudad: {{ Institutes()->institute_city }}</div>
                                    <div>País: {{ Institutes()->institute_country }}</div>
                                </div>
                                <div class="col-sm-4 mb-3 mb-md-0">
                                    <h4 class="print-title-1">Información de Registro</h4>
                                    <div>Lote del equipo: <strong> {{ $testbd->lote_machine }}</strong></div>
                                    <div>Equipo: <strong>{{ $testbd->machine_name }}</strong></div>
                                    <div>Temperatura del Equipo:<strong> {{ $testbd->temp_machine }}</strong></div>
                                    <div>Temperatura Ambiente:<strong> {{ $testbd->temp_ambiente }}</strong></div>
                                </div>
                                <div class="col-sm-4 mb-3 mb-md-0">
                                    <h4 class="print-title-1">Registro INFO:</h4>
                                    <div>Número: <strong>{{ $testbd->testbd_reference }}</strong></div>
                                    <div>Fecha: {{ \Carbon\Carbon::parse($testbd->updated_at)->format('d M, Y') }}
                                    </div>
                                    <div>Hora: {{ \Carbon\Carbon::parse($testbd->updated_at)->isoFormat('H:mm:ss A') }}
                                    </div>
                                    <div>
                                        Lote del Paquete B&D: <strong>{{ $testbd->lote_bd }}</strong>
                                    </div>
                                    <div>
                                        Validación de Test: <h3>{{ $testbd->validation_bd }}</h3>
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
                            <div>Notas: {{ $testbd->note }}</div>
                            <br><br><br><br>
                            <table class="default-table ">
                                <tr>
                                    <th>Operador: <span> {{ $testbd->operator }}</span></th>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="printer-informeshon-footer">
                        <ul>
                            <li><strong>Nota:</strong> Revisar el registro previo a la firma de responsabilidad.</li>
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
