<table style="width:100%; border-collapse:collapse; border:0.5px solid #000;">
    <tr>
        <th colspan="2" style="font-size:14px; text-align:center; padding:2mm; border-bottom:0.5px solid #000;">
            {{ institutes()->institute_name }}<br>
            <span style="font-size:11px; font-weight:normal;">
                {{ institutes()->institute_area }} - {{ institutes()->institute_city }} - {{ institutes()->institute_country }}
            </span>
        </th>
    </tr>
    <tr>
        <td style="width:50%; vertical-align:top; padding:2mm; border-right:0.5px solid #000;">
            <p style="font-size:14px; margin:0 0 2px 0;">
                <small>Elab. {!! Carbon\Carbon::parse($item->updated_at)->format('d-m-Y') !!}</small>
            </p>
            <p style="margin:0 0 2px 0;">
                <strong style="font-size:10px;">{{ $labelqr->machine_name }} -> Lote: {{ $labelqr->lote_machine }}</strong>
            </p>
            <p style="margin:0 0 2px 0;">
                <strong style="font-size:10px;">{{ $item->product_name }}</strong>
                <small style="font-size:9px;">{{ $item->product_info }}</small>
            </p>
            <p style="font-size:12px; margin:0;">
                <small>{{ $item->product_outside_company }} / {{ $item->product_patient }}</small>
            </p>
        </td>
        <td style="width:50%; vertical-align:top; padding:2mm;">
            <p style="font-size:13px; margin:0 0 2px 0;">
                <strong>Venc. {!! Carbon\Carbon::parse($item->updated_at)->addDays((int) $item->product_expiration)->format('d-m-Y') !!}</strong>
            </p>
            <p style="font-size:13px; margin:0 0 2px 0;">
                <strong>{{ $labelqr->reference }}</strong> / {{ $labelqr->type_program }}
            </p>
            <p style="font-size:12px; margin:0 0 2px 0;">
                <small>Operador: {{ $labelqr->operator }}</small>
            </p>
            <p style="font-size:12px; margin:0;">
                <small>Oper Emp: {{ $item->product_operator_package }}</small>
            </p>
        </td>
    </tr>
    <tr>
        <td colspan="2" style="text-align:center; vertical-align:middle; border-top:0.5px solid #000;">
            <img src="data:image/png;base64,{!! base64_encode(
                \Milon\Barcode\Facades\DNS1DFacade::getBarCodeSVG($item->product_code, $barcode->product_barcode_symbology, 2, 45),
            ) !!}" alt="Código de Barras">
        </td>
    </tr>
</table>
