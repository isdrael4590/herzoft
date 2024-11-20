<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Recepción</title>

    <style>
        /** printer 16 start **/
        .printer-16 {
            background: #fff;
            min-height: 100vh;
            position: relative;
            display: baseline;
            justify-content: center;
            align-items: center;
            padding: 27px 0 30px;
            font-family: Arial, Helvetica, sans-serif;
        }

        .printer-16 .mb-30 {
            margin-bottom: 30px;
        }

        .printer-16 .printer-inner-9 {
            background: #fff;
            max-width: 1296px;
            margin: 0;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }

        .printer-16 .printer-info p {
            margin-bottom: 5px;
        }

        .printer-16 .fw-bold {
            font-weight: 400 !important;
        }

        .printer-16 .printo-addr-1 {
            margin-bottom: 0;
        }

        .printer-16 .default-table {
            position: relative;
            background: #ffffff;
            border: 0;
            border-radius: 5px;
            overflow: hidden;
            width: 100%;
            min-width: 550px;
        }

        .printer-16 .default-table thead {
            background: #F5F7FC;
            border-radius: 8px;
            color: #ffffff;
        }

        .printer-16 .mb-50 {
            margin-bottom: 50px;
        }

        .printer-16 .table-outer {
            overflow-y: hidden;
            overflow-x: auto;
        }

        .printer-16 .default-table thead th {
            position: relative;
            padding: 3px 3px;
            font-size: 18px;
            color: #000000;
            font-weight: 500;
            line-height: 30px;
            white-space: nowrap;
        }

        .printer-16 .default-table tbody tr {
            position: relative;
        }

        .printer-16 .default-table tr td {
            position: relative;
            padding: 3px 3px;
            font-size: 14px;
            color: #000000;
        }

        .printer-16 .mb-30 {
            margin-bottom: 30px;
        }

        .printer-16 h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        .h1,
        .h2,
        .h3,
        .h4,
        .h5,
        .h6 {
            color: #000000;
        }

        .printer-16 .printer-top .logo img {
            height: 150px;
        }

        .printer-16 .printer-top {
            padding: 20px 80px 20px;
        }

        .printer-16 .printer-top .printer {
            float: right;
        }

        .printer-16 .printer-top .printer h1 {
            font-weight: 600;
            margin-bottom: 0;
            color: #0a3ad8;
            font-size: 22px;
        }

        .printer-16 .printer-info {
            padding: 0 10px 10px;
        }

        .printer-16 .printer-info .print-from-2 {
            margin-bottom: 0;
            font-weight: 400;
        }

        .printer-16 .product-summary {
            padding: 0 10px 10px;
        }

        .printer-16 .printer-informeshon-footer {
            position: relative;
            padding: 10px 50px 40px;
            border-top: 1px solid #ECEDF2;
        }

        .printer-16 .printer-informeshon-footer ul {
            display: -ms-flexbox;
            display: flex;
            -ms-flex-align: center;
            -webkit-box-pack: center;
            -ms-flex-pack: center;
            justify-content: center;
            marker: none;
            padding: 0;
            margin: 0;
            list-style: none;
        }

        .printer-16 .printer-informeshon-footer ul li {
            position: relative;
            margin: 0 20px 10px;
            text-align: center;
            font-size: 10px;
            marker: none;
            line-height: 20px;
        }

        .printer-16 .printer-informeshon-footer li a {
            color: #000000;
        }

        .printer-16 .text-muted {
            color: #535353 !important;
        }

        .printer-16 .printer-footer {
            padding: 50px 150px;
        }

        .printer-16 .social-list {
            float: left;
        }

        .printer-16 .social-list span {
            margin-right: 5px;
            font-weight: 500;
            font-size: 12px;
            color: #171717;
        }

        .printer-16 .social-list a {
            width: 50px;
            height: 50px;
            line-height: 50px;
            text-align: center;
            display: inline-block;
            font-size: 12px;
            margin: 0 2px 2px 0;
            color: #3dd5f3;
            background: #f1f1f1;
            border-radius: 50%;
        }

        .printer-16 .social-list a:hover {
            background: #3dd5f3;
            color: #fff;
        }

        .container {
            max-width: 1120px;
            margin: 0 auto;
        }

        @media (max-width: 992px) {
            .printer-16 .printer-top {
                padding: 50px;
            }

            .printer-16 .printer-info {
                padding: 0px 50px;
            }

            .printer-16 .product-summary {
                padding: 0 50px 50px;
            }

            .printer-16 .printer-footer {
                padding: 50px;
            }

            .printer-16 .printer-informeshon-footer {
                padding: 50px 50px 40px;
            }

            .printer-16 .printer-informeshon-footer ul li {
                margin: 10px 10px 10px;
            }
        }

        @media (max-width: 768px) {
            .printer-16 .printer-top {
                padding: 30px;
            }

            .printer-16 .printer-top .logo img {
                height: 20px;
            }

            .printer-16 .printer-top .printer h1 {
                font-size: 20px;
            }

            .printer-16 .printer-info {
                padding: 0px 30px 0;
            }

            .printer-16 .mb-50 {
                margin-bottom: 30px;
            }

            .printer-16 .social-list {
                margin-bottom: 20px;
            }

            .printer-titel {
                padding: 30px;
            }

            .printer-16 .product-summary {
                padding: 0 30px 30px;
            }

            .printer-16 .printer-informeshon-footer {
                padding: 30px 20px 20px;
            }

            .printer-16 .printer-titel {
                background: #fbf8f8;
            }

            .printer-16 .printer-footer {
                padding: 30px;
            }

            .btn-lg {
                height: 45px;
                padding: 0 25px;
                line-height: 45px;
            }
        }

        @media (max-width: 600px) {
            .printer-16 .printer-top .printer {
                float: left;
            }

            .printer-16 .printer-informeshon-footer ul {
                display: initial;
            }

            .printer-16 .printer-top .logo img {
                margin-bottom: 10px;
            }

            .printer-content .important-notes-list-1 {
                margin-bottom: 25px;
            }

            .text-end {
                text-align: left !important;
            }

            .printer-3 .printer-name {
                margin-top: 20px;
                margin-bottom: 30px;
            }
        }

        /** GLOBAL CLASSES **/

        .table {
            color: #535353;
        }

        .printer-content {
            font-family: 'Poppins', sans-serif;
            color: #535353;
            font-size: 12px;
        }

        .container {
            max-width: 1120px;
            margin: 0 auto;
        }

        .printer-content a {
            text-decoration: none;
        }

        .printer-content .img-fluid {
            max-width: 100% !important;
            height: auto;
        }

        .printer-content .form-control:focus {
            box-shadow: none;
        }

        .printer-content h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        .h1,
        .h2,
        .h3,
        .h4,
        .h5,
        .h6 {
            font-family: 'Poppins', sans-serif;
            color: #535353;
        }

        /** BTN LG **/
        .btn-lg {
            font-size: 15px;
            height: 50px;
            padding: 0 35px;
            line-height: 50px;
            border-radius: 3px;
            color: #ffffff;
            border: none;
            margin: 3px;
        }

        .btn-lg {
            display: inline-block;
            vertical-align: middle;
            -webkit-appearance: none;
            text-transform: capitalize;
            transition: all 0.3s linear;
            z-index: 1;
            position: relative;
            overflow: hidden;
            text-align: center;
        }

        .btn-lg:hover {
            color: #ffffff;
        }

        .btn-lg:hover:after {
            transform: perspective(200px) scaleX(1.05) rotateX(0deg) translateZ(0);
            transition: transform 0.9s linear, transform 0.4s linear;
        }

        .btn-lg:after {
            position: absolute;
            top: 0;
            left: 0;
            bottom: 0;
            right: 0;
            content: "";
            transform: perspective(200px) scaleX(0.1) rotateX(90deg) translateZ(-10px);
            transform-origin: bottom center;
            transition: transform 0.9s linear, transform 0.4s linear;
            z-index: -1;
        }

        .btn-check:focus+.btn,
        .btn:focus {
            outline: 0;
            box-shadow: none;
        }

        .btn-download {
            background: #0a3ad8 !important;
        }

        .btn-download:after {
            background: #1eb770;
        }

        .btn-print {
            background: #3a3939;
        }

        .btn-print:after {
            background: #1d1c1c;
        }

        .printer-content .f-w-600 {
            font-weight: 600 !important;
        }

        .printer-content .text-13 {
            font-size: 13px;
        }

        .printer-content .printer-table th:first-child,
        .printer-content .printer-table td:first-child {
            text-align: center;
        }

        .printer-content .color-white {
            color: #fff !important;
        }

        .printer-content .print-header-1 {
            text-transform: uppercase;
            font-weight: 700;
            font-size: 24px;
            color: #262525;
        }

        .printer-content .print-header-2 {
            text-transform: uppercase;
            font-weight: 600;
            font-size: 20px;
        }

        .printer-content .print-title-1 {
            font-weight: 500;
            font-size: 20px;
            text-align: center;
            text-transform: uppercase;

        }

        .printer-content .printo-addr-1 {
            font-size: 15px;
            margin-bottom: 20px;
        }

        .printer-content .item-desc-1 {
            text-align: left;
        }

        .printer-content .item-desc-1 span {
            display: block;
        }

        .printer-content .item-desc-1 small {
            display: block;
        }

        .printer-content .important-notes-list-1 {
            font-size: 13px !important;
            padding-left: 15px;
            margin-bottom: 15px;
        }

        .printer-content .important-notes-list-1 li {
            margin-bottom: 5px;
        }

        .printer-content .bank-transfer-list-1 {
            font-size: 13px !important;
            padding-left: 0px;
        }

        .printer-content .important-notes {
            font-size: 12px !important;
        }

        .printer-content .printer-btn-section {
            text-align: center;
            margin-top: 30px;
        }

        .printer-16 .product-summary tbody,
        td,
        tfoot,
        th,
        thead,
        tr {
            border: solid 2px #f3f2f2;
        }

        table th {
            font-weight: 500;

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
                            <div class="printer-info">
                                <div class="row">
                                    <div class="printer-number">
                                        <h1 class="print-title-1">Registro Físico ingreso de instrumental.
                                        </h1>

                                    </div>
                                </div>
                            </div>
                            <div>
                                <table class="default-table">
                                    <thead>
                                        <tr>
                                            <th>
                                                <div class="logo">
                                                    <img src="{{ $dataUrl }}" alt="Institute Image"
                                                        class="img-fluid mb-2">

                                                </div>
                                            </th>
                                            <th>
                                                <h2>{{ $reception->reference }}</h2>
                                                <h3> <span>
                                                        {{ \Carbon\Carbon::parse($reception->created_up)->format('d M, Y') }}</span>
                                                </h3>

                                            </th>
                                            <th>
                                                <div>Versión: <strong> 01</strong></div>
                                                <div>Vigente: <strong> Septiembre 2024</strong></div>
                                                </h5>
                                            </th>
                                        </tr>
                                    </thead>
                            </div>

                        </div>

                        <div class="product-summary">
                            <div>
                                <table class="default-table">
                                    <thead>
                                        <tr>
                                            <th><strong>Institución:</strong></h4>
                                            </th>
                                            <th><strong>Información de Recepción:</strong></h4>
                                            </th>
                                            <th><strong>Registro INFO:</strong></h5>
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
                                                        {{ \Carbon\Carbon::parse($reception->created_up)->format('d M, Y') }}
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
                            <div class="product-summary">
                                <div>
                                    <table class="default-table printer-table">
                                        <thead>
                                            <tr>
                                                <th>Código </th>
                                                <th>Descripción Rumed</th>
                                                <th>Cantidad</th>
                                                <th>Nivel infección</th>
                                                <th>Estado</th>
                                                <th>Paciente</th>
                                                <th>Casa Comer.</th>

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
                                </div>
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
                        </div>
                    </div>

                    <table class="default-table ">
                        <tr>
                            <th style= " font-size: 15px; text-align: justify;">
                                RECIBE: <span> {{ $reception->operator }}</span>
                                <br><br><br><br><br><br>
                            </th>
                            <th style= " font-size: 15px; text-align: justify;">
                                ENTREGA: <span> {{ $reception->delivery_staff }}</span>
                                <br><br><br><br><br><br>

                            </th>
                            </th>
                        </tr>
                    </table>

                    <div class="printer-informeshon-footer">
                        <ul>
                            <li><strong>Nota:</strong> Asegurarse los productos sean los correctos previo al registro.
                            </li>
                        </ul>
                        <ul>

                            <li>

                                <img src="{{ $dataUrlogo }}" alt="Institute Image" class="img-fluid mb-2"
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
</body>

</html>
