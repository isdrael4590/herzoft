<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>A5 Registro Instrumental</title>
    <style>
        /* A5 Size (148mm x 210mm) */
        @page {
            size: A5;
            margin: 0;
        }

        body {
            width: 148mm;
            height: 210mm;
            margin: 3mm;
            font-family: Arial, sans-serif;
            box-sizing: border-box;
        }

        /* Avoid page breaks inside elements */
        .avoid-break {
            page-break-inside: avoid;
        }

        /* Force a new page */
        .new-page {
            page-break-before: always;
        }

        .container {
            width: 128mm;
            padding: 4mm;
            font-size: 14px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 4mm;
        }

        th,
        td {
            padding: 3px;
            text-align: center;
            vertical-align: top;
            border: 1px solid #ddd;
        }

        th {
            background-color: #f8f6f6;
            font-weight: bold;
        }

        .header-table {
            border: none;
            margin-bottom: 10px;
        }

        .header-table th {
            background-color: transparent;
            border: none;
            vertical-align: middle;
        }

        .text-left {
            text-align: left;
        }

        .text-right {
            text-align: right;
        }

        .no-border {
            border: none;
        }

        @media print {
            .no-print {
                display: none;
            }

            body {
                padding: 0;
            }
        }

        /* Print-specific adjustments */
        @media print {
            body {
                padding: 0;
            }

            .no-print {
                display: none !important;
            }
        }

        @page {
            margin-top: 2mm;
            margin-bottom: 5mm;
            /* Make room for footer */
        }


        /* Only show the second-page header on pages after first */
        .second-page-header {
            display: none;
        }

        @page :not(:first) {
            /* Additional space on pages after first */
            margin-top: 100mm;
        }
    </style>
</head>

<body>
    <div class="container">


        <div class="row">

            <table style="width: 100%; border-collapse: collapse;">
                <tr>
                    <td style="width: 30%;" rowspan="2">
                        <img src="{{ $dataUrl }}" alt="Institute Image" class="img-fluid mb-2" width="120px">
                    </td>
                    <td colspan="2" style="text-align: center;">
                        <h3>Registro Físico ingreso de instrumental.
                        </h3>
                    </td>
                </tr>
                <tr>
                    <td style="width: 30%;" style="text-align: center;">
                        <h4>{{ $reception->reference }}</h4>
                        <h5> <small>
                                {{ \Carbon\Carbon::parse($reception->created_up)->format('d M, Y') }}</small>
                        </h5>
                    </td>

                    <td style="width: 40%;"> <small style="text-align: center;">
                            Versión: <strong> 01</strong> <br>
                            Vigente: <strong> Septiembre 2024</strong>
                        </small>
                    </td>
                </tr>

        </div>
        <div class="row">
            <table>
                <thead>
                    <tr>
                        <th style="width: 40%;"><strong>Institución:</strong></h4>
                        </th>
                        <th style="width: 40%;"><strong>Información de Recepción:</strong></h4>
                        </th>
                        <th style="width: 30%;"><strong>Registro INFO:</strong></h5>
                        </th>

                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <div>
                                <div>{{ Institutes()->institute_name }}</div>
                                <div>Dirección: {{ Institutes()->institute_address }}</div>
                                <div>Área: {{ Institutes()->institute_area }}</div>
                                <div>Ciudad: {{ Institutes()->institute_city }}</div>
                                <div>País: {{ Institutes()->institute_country }}</div>
                            </div>
                        </td>
                        <td>
                            <div>
                                <div>Persona que entrega: <strong>
                                        {{ $reception->delivery_staff }}</strong>
                                </div>
                                <div>Área Procedente: <strong>{{ $reception->area }}</strong></div>
                                <div>Persona que recibe:<strong>
                                        {{ $reception->operator }}</strong></div>
                            </div>
                        </td>
                        <td>
                            <div>
                                <div>Número: <strong>{{ $reception->reference }}</strong></div>
                                <div>Fecha:
                                    {{ $reception->updated_at->format('d M, Y H:i') }}
                                </div>
                                <div>
                                    Status: <strong>{{ $reception->status }}</strong>
                                </div>

                            </div>
                        </td>

                    </tr>
                </tbody>
            </table>
        </div>
        <br>
        <div class="row">
            <table class="default-table printer-table">
                <thead>
                    <tr>
                        <th style="width: 10%;">Código </th>
                        <th style="width: 30%;">Descripción Rumed</th>
                        <th style="width: 10%;">Cant</th>
                        <th style="width: 15%;">Nivel infección</th>
                        <th style="width: 20%;">Temp. Proceso</th>
                        <th style="width: 10%;">Estado</th>
                        <th style="width: 15%;">Paciente</th>
                        <th style="width: 10%;">Casa Comer.</th>

                </thead>
                <tbody>
                    @foreach ($reception->receptionDetails as $item)
                        <tr>
                            <td style= "text-align:center">
                                {{ $item->product_code }}
                            </td>
                            <td style= "text-align:center">
                                {{ $item->product_name }}
                            </td>
                            <td style= "text-align:center">
                                {{ $item->product_quantity }}
                            </td>
                            <td style= "text-align:center">
                                {{ $item->product_type_dirt }}
                            </td>
                             <td style= "text-align:center">
                                {{ $item->product_type_process }}
                            </td>
                            <td style= "text-align:center">
                                {{ $item->product_state_rumed }}
                            </td>
                            @if (@empty($item->product_patient))
                            @else
                                <td> {{ $item->product_patient }}</td>
                            @endif
                            @if (@empty($item->product_outside_company))
                            @else
                                <td> {{ $item->product_outside_company }}</td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <br>
            <div>
                @if (@empty($reception->note))
                    Notas: N/A
                @else
                    Notas: {{ $reception->note }}
                @endif
            </div>
            <br>


        </div>
        <div class="row">
            <table class="default-table ">
                <tr>
                    <th style= " font-size: 10px; text-align: center;">
                        RECIBE: <span> {{ $reception->operator }}</span>
                        <br><br><br><br><br><br>
                    </th>
                    <th style= " font-size: 10px; text-align: center;">
                        ENTREGA: <span> {{ $reception->delivery_staff }}</span>
                        <br><br><br><br><br><br>

                    </th>
                    </th>
                </tr>
            </table>
        </div>
        <div class="row" style= " font-size: 10px; text-align: center;">
            <ul>
                <li><strong>Nota:</strong> Asegurarse los productos sean los correctos previo al registro.
                </li>
            </ul>
            <ul>

                <li>

                    <img src="{{ $dataUrlogo }}" alt="Institute Image" class="img-fluid mb-2" width="80px">
                    <br>
                    {{ Settings()->company_name }} -
                    {{ Settings()->company_email }} -
                    {{ Settings()->company_phone }}

                </li>
            </ul>
        </div>
    </div>

</body>

</html>
