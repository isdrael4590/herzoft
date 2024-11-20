<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <title>Recepción</title>

    <style>
        /** printer 16 start **/

        table {
            border-collapse: collapse;
            border: 0.5px solid rgb(140 140 140);
            font-family: sans-serif;
            font-size: 0.8rem;
            letter-spacing: 0.5px;
        }

        /** Print ticket **/
        @media print {
            .cabecera-ticket {}
        }


        /*css para etiquetas */
        /*Informacion equipo tickets */
        table,
        th,
        td {
            border: 1px solid black;
            border-style: dotted;
            border-collapse: collapse;
            padding-top: 1px;
            padding-right: 1px;
            padding-bottom: 1px;
            padding-left: 1px;
        }



        @page {
            margin-left: 5mm;
            margin-right: 5mm;
            margin-top: 0.2cm;
            margin-bottom: 0.1cm;

        }

        .verticalText {
            transform: rotate(90deg);
        }



        p {
            font-size: 7px;
            line-height: 1;

        }
    </style>
</head>

<body>
    <div style="font-size: 11px; ">
        <div class="row">
            <div>
                <div class="row">
                    <div style="text-align: center;">
                        <h2>Registro Físico ingreso de instrumental.
                        </h2>

                    </div>
                </div>
                <table style="width:100%">
                    <thead>
                        <tr style="font-size: 9px;">
                            <th>
                                <div>
                                    <img src="{{ $institute->getFirstMediaUrl('institutes') }}" alt="Institute Image">
                                </div>
                            </th>
                            <th>
                                <h2>{{ $reception->reference }}</h2>
                                <h4> <span>
                                        {{ \Carbon\Carbon::parse($reception->created_up)->format('d M, Y') }}</span>
                                </h4>

                            </th>
                            <th style="font-size: 7px;">
                                <div>Versión: <strong> 01</strong></div>
                                <div>Vigente: <strong> Septiembre 2024</strong></div>

                            </th>
                        </tr>
                    </thead>

            </div>

            <div class="product-summary">
                <div>
                    <table class="default-table">
                        <thead style="font-size: 9px;">
                            <tr>
                                <th><strong>Institución:</strong></h4>
                                </th>
                                <th><strong>Información de Recepción:</strong></h4>
                                </th>
                                <th><strong>Registro INFO:</strong></h5>
                                </th>

                            </tr>
                        </thead>
                        <tbody style="font-size: 7px;">
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
                                                {{ $reception->delivery_staff }}</strong></div>
                                        <div>Área Procedente: <strong>{{ $reception->area }}</strong></div>
                                        <div>Persona que recibe:<strong>
                                                {{ $reception->operator }}</strong></div>
                                    </div>
                                </td>
                                <td>
                                    <div>
                                        <div>Número: <strong>{{ $reception->reference }}</strong></div>
                                        <div>Fecha:
                                            {{ \Carbon\Carbon::parse($reception->created_up)->format('d M, Y') }}
                                        </div>
                                        <div>
                                            Estado: <strong>{{ $reception->status }}</strong>
                                        </div>

                                    </div>
                                </td>

                            </tr>
                        </tbody>
                    </table>
                </div>
                <br>
                <div class="product-summary">
                    <div>
                        <table style="font-size: 8px;">
                            <thead>
                                <tr>
                                    <th>Código </th>
                                    <th>Descripción Rumed</th>
                                    <th>Cantidad</th>
                                    <th>Nivel infección</th>
                                    <th>Estado</th>
                                    <th>
                                        @if (@empty($reception->product_patient))
                                        @else
                                            Paciente
                                        @endif
                                    </th>

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
                                            {{ $item->product_state_rumed }}
                                        </td>

                                        @if (@empty($reception->product_patient))
                                            <td></td>
                                        @else
                                            <td>{{ $reception->product_patient }}
                                            </td>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <br>
                    <div style="font-size: 7px;">
                        @if (@empty($reception->note))
                            Notas: N/A
                        @else
                            Notas: {{ $reception->note }}
                        @endif
                    </div>
                    <br>


                </div>
            </div>

            <table style="width:100%">
                <tr style="font-size: 8px;">
                    <th> <br><br><br><br><br><br>
                        RECIBE: <span> {{ $reception->operator }}</span>

                    </th>

                </tr>
                <tr style="font-size: 8px;">
                    <th> <br><br><br><br><br><br>
                        ENTREGA: <span> {{ $reception->delivery_staff }}</span>
                    </th>
                </tr>
            </table>

            <div style="font-size: 7px;">
                <ul>
                    <li><strong>Nota:</strong> Asegurarse los productos sean los correctos previo al registro.</li>
                </ul>
                <ul>
                    <a> {{ Settings()->company_name }} - {{ Settings()->company_email }} -
                        {{ Settings()->company_phone }}</a>
                </ul>
            </div>

        </div>
    </div>
</body>

</html>
