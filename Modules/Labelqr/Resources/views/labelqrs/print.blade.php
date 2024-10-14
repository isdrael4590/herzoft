<!DOCTYPE html>
<html lang="es">

<head>
    <title>QR ETIQUETAS</title>
    <meta name="viewport" >
    <meta charset="UTF-8">

    <!-- External CSS libraries -->
   <style>

/** Print ticket **/
@media print {
    .cabecera-ticket {
    }
        }
    

/*css para etiquetas */
   /*Informacion equipo tickets */
   table, th, td {
    border: 1px solid black;
    border-style:  dotted;
    border-collapse: collapse;
    padding-top: 1px;
    padding-right: 1px;
    padding-bottom: 1px;
    padding-left: 1px;
}
 


@page {
		margin-left: 1cm;
		margin-right: 0.3cm;
        margin-top: 0.2cm;
		margin-bottom: 0.2cm;

	}
    .verticalText {
transform: rotate(90deg);
}



p{
font-size: 7px;
margin-top:0; 
margin-bottom:0;

}



   </style>


    <!-- Custom Stylesheet -->
</head>
<body>
    @foreach ($labelqr->labelqrDetails as $item)
        <div>
            <table style="width:100%">
                <head>
                    <tr style="font-size: 14px;">
                    <th colspan="2"> {{ institutes()->institute_name }}<br>
                            <p style="font-size: 10px;"> {{ institutes()->institute_area }} - {{ institutes()->institute_city }} -{{ institutes()->institute_country }}</p>
                    </th>
                 
                    </tr>
                    <tr style="text-align: center;">
                        
                        <td><img src="data:image/png;base64, {{ base64_encode(QrCode::format('png')->size(110)->generate($dataqr.$item->product_code)) }}">
                            <p style="font-size: 10px;">
                                <small>HERZOFT GROUP</small><br>
                            </p>
                        </td>
                        <td>
                        <p style="font-size: 15px;">
                        <strong >Venc. {!! Carbon\Carbon::parse($item->updated_at)->addMonth($item->product_expiration)->format('d M, Y') !!}</strong><br>
                        </p>
                        <p style="font-size: 10px;">
                            <small>Elab. {!! Carbon\Carbon::parse($item->updated_at)->format('d M, Y') !!}</small><br>
                        </p>
                        <p style="font-size: 10px;">
                        <strong>{{ $labelqr->machine_name }} Lote: {{ $labelqr->lote_machine }} </strong><br>
                        </p>
                        <p style="font-size: 10px;">
                        <small>{{ $labelqr->type_program }}</small><br>
                        </p>
                        <p style="font-size: 10px;">
                        <strong>{{ $labelqr->reference }}</strong><br>
                        </p>
                        <p style="font-size: 10px;">
                        <strong>{{ $item->product_name }}</strong><br>
                        </p>
                        <p style="font-size: 15px;">
                        <small>{{ $item->product_code }}</small><br>
                        </p>
                        <p style="font-size: 10px;">
                        <small>Operario: {{ $labelqr->operator }} </small>
                        </p>
                        </td>
                    </tr>
                    <tr style="font-size: 10px;">
                            <td  style="text-align: center;" colspan="2">
                            <p style="font-size: 10px;">
                                <small>El producto no ESTERIL, si el empaque esta ABIERTO o
                                HUMEDO</small>
                            </p>   
                            
                        </td>
                       
                    </tr>
                   
                </head>
            </table>
        </div>
    @endforeach
</body>

</html>
  