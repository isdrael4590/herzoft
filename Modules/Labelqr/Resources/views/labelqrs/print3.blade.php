<!DOCTYPE html>
<html lang="es">

<head>
    <title>QR ETIQUETAS</title>
    <meta name="viewport">
    <meta charset="UTF-8">

    <!-- External CSS libraries -->
    <style>
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
            margin-left: 1cm;
            margin-right: 0.3cm;
            margin-top: 0.3cm;
            margin-bottom: 0.2cm;

        }




        p {
            font-size: 7px;
            margin-top: 0;
            margin-bottom: 0;

        }
    </style>


    <!-- Custom Stylesheet -->
</head>
@foreach ($labelqr->labelqrDetails as $item)

    <body>
        @for ($i = 1; $i <= $item->product_quantity; $i++)
            <div>
                <table style="width:100%">

                    <head>
                        <tr style="font-size: 14px;">
                            <th colspan="2"> {{ institutes()->institute_name }}<br>
                                <p style="font-size: 11px;"> {{ institutes()->institute_area }} -
                                    {{ institutes()->institute_city }} -{{ institutes()->institute_country }}</p>
                            </th>
                        </tr>
                        <tr style="text-align: center; vertical-align: top;">
                            <td tyle="text-align: center; vertical-align: top;">
                                <p style="font-size: 14px;">
                                    <small>Elab. {!! Carbon\Carbon::parse($item->updated_at)->format('d-m-Y') !!}</small><br>
                                </p>
                                <p>
                                    <strong style="font-size: 10px;">{{ $labelqr->machine_name }} -> Lote:
                                        {{ $labelqr->lote_machine }}
                                    </strong>
                                </p>


                                <p>
                                    <strong style="font-size: 10px;">{{ $item->product_name }} </strong>
                                    <small style="font-size: 9px;">{{ $item->product_info }} <br>
                                    </small>
                                </p>

                                <p style="font-size: 12px;">
                                    <small> {{ $item->product_outside_company }} / {{ $item->product_patient }}
                                    </small>

                                </p>

                            </td>
                            <td tyle="text-align: center; vertical-align: top;">
                                <p style="font-size: 13px;">
                                    <strong>Venc. {!! Carbon\Carbon::parse($item->updated_at)->addDays($item->product_expiration)->format('d-m-Y') !!}</strong>


                                </p>

                                <p style="font-size: 13px;">
                                    <strong style="font-size: 13px;">{{ $labelqr->reference }}</strong>
                                    / {{ $labelqr->type_program }}
                                </p>



                                <p style="font-size: 12px;">
                                    <small>Operador: {{ $labelqr->operator }} </small>
                                </p>
                                <p style="font-size: 12px;">
                                    <small>Oper Emp: {{ $item->product_operator_package }} </small>
                                </p>

                            </td>
                        </tr>

                        <tr>
                            <td colspan="2" style="text-align: center; vertical-align: middle;">
                                <img src="data:image/png;base64,{!! base64_encode(
                                    \Milon\Barcode\Facades\DNS1DFacade::getBarCodeSVG($item->product_code, $barcode->product_barcode_symbology, 2, 45),
                                ) !!}" alt="Código de Barras">
                            </td>
                        </tr>

                    </head>
                </table>
            </div>
        @endfor
    </body>
@endforeach

</html>
