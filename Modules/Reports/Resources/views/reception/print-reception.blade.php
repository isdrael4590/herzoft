<!DOCTYPE html>
<html lang="en">

<head>
    <title>Reporte Ingresos</title>
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

        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        @media print {
            .no-print {
                display: none;
            }
        }
    </style>
</head>

<body>
    <div class="no-print" style="margin-bottom: 20px;">
        <button onclick="window.print()">Print</button>
        <button onclick="window.history.back()">Back</button>
    </div>

    <div class="printer-16 printer-content">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="printer-inner-12" id="printer_wrapper">
                        <div class="printer-top">
                            <div class="row g-3">
                                <div class="col-3">
                                    <img src="{{ $institute->getFirstMediaUrl('institutes') }}" alt="Institute Image" width="80%" height="auto"
                                        class="img-fluid  mb-1">
                                </div>
                                <div class="col-7">
                                    <h6>{{ Institutes()->institute_name }}</h6>
                                    <div>Dirección: {{ Institutes()->institute_address }}</div>
                                    <div>Área: {{ Institutes()->institute_area }}</div>
                                    <div>Ciudad: {{ Institutes()->institute_city }}</div>
                                    <div>País: {{ Institutes()->institute_country }}</div>
                                </div>
                                <div class="col-2">
                                    <div>Versión: <strong> 01</strong></div>
                                    <div>Vigente: <strong> Septiembre 2024</strong></div>
                                </div>

                            </div>
                        </div>
                        <div class="printer-info">
                            <div class="row">

                                <div class="printer-number">
                                    <h6 class="print-title-2">Reporte Físico de Ingresos en esterilización:</h6>
                                    <p class="printo-addr"> Fecha:
                                        {{ \Carbon\Carbon::parse($data[0]['updated_at'])->format('d M, Y') }}
                                    </p>
                                </div>
                            </div>

                        </div>
                        <div class="printer-info">
                            <div class="row mb-12">




                            </div>
                        </div>

                        <div class="product-summary">
                            <div>
                                <table class="default-table printer-table">
                                    <div wire:loading.flex
                                        class="col-12 position-absolute justify-content-center align-items-center"
                                        style="top:0;right:0;left:0;bottom:0;background-color: rgba(255,255,255,0.5);z-index: 99;">
                                        <div class="spinner-border text-primary" role="status">
                                            <span class="sr-only">Loading...</span>
                                        </div>
                                    </div>
                                    <thead>
                                        <tr>

                                            <th>Fecha</th>
                                            <th>Referencia</th>
                                            <th>Área</th>
                                            <th>Estado</th>
                                            <th>Persona Entrega</th>
                                            <th>Persona que recibe</th>

                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($data as $reception)
                                            <tr>

                                                <td>{{ \Carbon\Carbon::parse($reception->updated_at)->format('d M, Y') }}
                                                </td>
                                                <td>{{ $reception->reference }}</td>
                                                <td>{{ $reception->area }}</td>
                                                <td>
                                                    {{ $reception->status }}
                                                </td>
                                                <td>{{ $reception->operator }}</td>
                                                <td>{{ $reception->delivery_staff }}</td>

                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <br>
                            <div class="printer-informeshon">
                                <h6 class="print-title-2">Información de Reporte generado:</h6>
                                <table class="default-table ">
                                    <tr>
                                        <td>Fecha: <span> {{ $reception->updated_at }}</span></td>
                                    </tr>
                                    
                                </table>
                                <table class="default-table ">
                                    <tr>
                                        <br><br><br>
                                        <td>Responsable: <span> {{ $reception->operator }}</span></td>
                                    </tr>
                                </table>
                            </div>
                            <div class="printer-informeshon-footer">
                                <ul>
                                    <li><strong>Nota:</strong> Asegurarse que el producto entregado sea el correcto.
                                    </li>
                                </ul>
                                <ul>
                                    <li>

                                        <img src="{{ $dataUrlLogo }}" alt="Institute Image" class="img-fluid mb-2"
                                            width="80px">
                                        <br>
                                        {{ Settings()->company_name }} -
                                        {{ Settings()->company_email }} -
                                        {{ Settings()->company_phone }}

                                    </li>
                                </ul>
                            </div>
                        </div>

                    </div>

                </div>

            </div>
        </div>
    </div>

</body>

</html>
