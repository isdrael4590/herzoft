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
            margin-left: 0.8cm;
            margin-right: 0.3cm;
            margin-top: 0.3cm;
            margin-bottom: 0.2cm;

        }


        body {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        p {
            font-size: 14px;
            margin-top: 0;
            margin-bottom: 0;

        }
    </style>


    <!-- Custom Stylesheet -->
</head>

@foreach ($labelqr->labelqrDetails as $item)

    <body>

        @for ($i = 1; $i <= $item->product_quantity; $i++)
            <div style="align-content: center">
                <table style="width:100%">

                    <head>
                        <tr style="font-size: 16px;">
                            <th colspan="2"> {{ institutes()->institute_name }}<br>
                                <p style="font-size: 13px;"> {{ institutes()->institute_area }} -
                                    {{ institutes()->institute_city }} -{{ institutes()->institute_country }}</p>
                            </th>
                        </tr>
                        <tr style="text-align: center; vertical-align: top;">
                            <td tyle="text-align: center; vertical-align: top;">
                                <p style="font-size: 17px;">
                                    <small>Elab. {!! Carbon\Carbon::parse($item->updated_at)->format('d-m-Y') !!}</small><br>
                                </p>
                                <p>
                                    <strong style="font-size: 15px;">{{ $labelqr->machine_name }} -> Lote:
                                        {{ $labelqr->lote_machine }}
                                    </strong>
                                </p>


                                <p>
                                    <strong style="font-size: 14px;">{{ $item->product_name }} </strong>
                                    <small style="font-size: 12px;">{{ $item->product_info }} <br>
                                    </small>
                                </p>

                                <p style="font-size: 13px;">
                                    <small> {{ $item->product_outside_company }} / {{ $item->product_patient }}
                                    </small>

                                </p>

                            </td>
                            <td tyle="text-align: center; vertical-align: top;">
                                <p style="font-size: 17px;">
                                    <strong>Venc. {!! Carbon\Carbon::parse($item->updated_at)->addDays($item->product_expiration)->format('d-m-Y') !!}</strong>


                                </p>
                                <p>
                                    @foreach(\Modules\Product\Entities\Product::where('product_code', $item->product_code) ->get() as $product_code)
                                        <strong>{{$product_code->area}}</strong>

                                    @endforeach
                                   
                                        
                                </p>
                                <p style="font-size: 14px;">
                                    <strong style="font-size: 14px;">{{ $labelqr->reference }}</strong>
                                    / {{ $labelqr->type_program }}
                                </p>



                                <p style="font-size: 14px;">
                                    <small>Operador: {{ $labelqr->operator }} </small>
                                </p>
                                <p style="font-size: 14px;">
                                    <small>Oper Emp: {{ $item->product_operator_package }} </small>
                                </p>

                            </td>
                        </tr>



                    </head>
                </table>
            </div>
        @endfor
    </body>
@endforeach

</html>
