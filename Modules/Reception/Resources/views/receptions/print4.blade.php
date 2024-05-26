<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        * {
            font-size: 12px;
            line-height: 18px;
            font-family: 'Ubuntu', sans-serif;
        }

        h2 {
            font-size: 16px;
        }

        td,
        th,
        tr,
        table {
            border-collapse: collapse;
        }

        tr {
            border-bottom: 1px dashed #ddd;
        }

        td,
        th {
            padding: 5px 0;
            width: 20%;
        }

        table {
            width: 100%;
        }

        tfoot tr th:first-child {
            text-align: center;
        }

        .centered {
            text-align: center;
            align-content: center;
        }

        small {
            font-size: 11px;
        }

        @media print {
            * {
                font-size: 12px;
                line-height: 20px;
            }

            td,
            th {
                padding: 5px 0;
            }

            .hidden-print {
                display: none !important;
            }

            tbody::after {
                content: '';
                display: block;
                page-break-after: always;
                page-break-inside: auto;
                page-break-before: avoid;
            }
        }
    </style>
</head>

<body>

    <div style="max-width:500px;margin:0 auto">
        <div id="receipt-data">
            <div class="centered">
                <h2 style="margin-bottom: 5px">{{ institutes()->institute_name }}</h2>

                <p style="font-size: 11px;line-height: 15px;margin-top: 0">
                    {{ institutes()->institute_address }}, {{ institutes()->institute_area }}
                    <br>{{ institutes()->institute_city }}
                    <span> - </span>{{ institutes()->institute_country }}
                </p>
            </div>
            <div class="col-sm-4 mb-3 mb-md-0">
                <h5 class="mb-2 border-bottom pb-2">Información de Recepción:</h5>
                <div>Ingreso: <strong>{{ $reception->reference }}</strong></div>
                <div>Fecha: {{ \Carbon\Carbon::parse($reception->created_up)->format('d M, Y') }}</div>
                <div>
                    Status: <strong>{{ $reception->status }}</strong>
                </div>

            </div>
            <div class="col-sm-4 mb-3 mb-md-0">
                <br>
                <div>Persona que entrega: {{ $reception->delivery_staff }}</div>
                <div>Área Procedente: {{ $reception->area }}</div>
                <div>Persona que recibe: {{ $reception->operator }}</div>
                <div>Nota: {{ $reception->note }}</div>
                <br>
            </div>


            <table class="table-data">
                <thead>
                    <tr>
                        <th>Código </th>
                        <th>Descripción</th>
                        <th>Nivel de infección</th>
                        <th>Estado</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($reception->receptionDetails as $item)
                        <tr>
                            <td class="text-align: center">
                                {{ $item->product_code }}
                            </td>
                            <td>
                                {{ $item->product_name }}
                            </td>
                            <td>
                                {{ $item->product_type_dirt }}
                            </td>
                            <td>
                                {{ $item->product_state_rumed }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>


            </table>
 

            <div class="col-sm-4 mb-3 mb-md-0">
            <ul>
                <li><a href="#">www.alem.com.ec</a></li>
                <li><a href="ferisdra@hotmail.com">ferisdra@hotmail.com</a></li>
                <li><a href="#">++593 998484190</a></li>
            </ul>
        </div>
        </div>
        <div class="print-btn-section clearfix d-print-none">
            <a href="javascript:window.print()" class="btn btn-lg btn-print">
                Imprimir
            </a>
            <a id="print_download_btn" class="btn btn-lg btn-download">
                Descarga
            </a>
        </div>
    </div>

</body>

</html>
