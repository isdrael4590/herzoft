<tr style="font-size: 13px;">
    <th colspan="2"> {{ institutes()->institute_name }}<br>
        <p style="font-size: 10px;"> {{ institutes()->institute_area }} -
            {{ institutes()->institute_city }} -{{ institutes()->institute_country }}</p>
    </th>
</tr>
<tr style="text-align: center; vertical-align: middle;">
    <td style="text-align: center; vertical-align: middle;" colspan="2">
        <p style="font-size: 12px;">
            <strong>Venc. {!! Carbon\Carbon::parse($item->updated_at)->addDays((int) $item->product_expiration)->format('d M, Y') !!}</strong><br>
        </p>
        <p style="font-size: 9px;">
            <small>Elab. {!! Carbon\Carbon::parse($item->updated_at)->format('d M, Y') !!}</small><br>
        </p>
        <p>
            <strong style="font-size: 10px;">{{ $labelqr->machine_name }} -> Lote: {{ $labelqr->lote_machine }}
            </strong> - <strong style="font-size: 9px;">{{ $labelqr->reference }}</strong>
            / <small>{{ $labelqr->type_program }}</small><br>
        </p>
        <p>
            <strong style="font-size: 9px;">{{ $item->product_name }} - </strong>
            <small style="font-size: 9px;">{{ $item->product_code }} - </small>
            <small style="font-size: 7px;">{{ $item->product_info }} <br></small>
        </p>
        <p style="font-size: 10px;">
            <small>{{ $item->product_outside_company }} / {{ $item->product_patient }}<br></small>
        </p>
        <p style="font-size: 9px;">
            <small>Operario: {{ $labelqr->operator }} </small>
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
<tr style="font-size: 8px;">
    <td style="text-align: center;" colspan="2">
        <p style="font-size: 8px;">
            <small>El producto no ESTERIL, si el empaque esta ABIERTO o
                HUMEDO</small>
        </p>
    </td>
</tr>
