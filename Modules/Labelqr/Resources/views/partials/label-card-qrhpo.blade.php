<tr style="font-size: 14px;">
    <th colspan="2"> {{ institutes()->institute_name }}<br>
        <p style="font-size: 10px;"> {{ institutes()->institute_area }} - {{ institutes()->institute_city }} -{{ institutes()->institute_country }}</p>
    </th>
</tr>
<tr style="text-align: center;">
    <td><img src="data:image/png;base64, {{ base64_encode(QrCode::format('png')->size(110)->generate($item->product_code.$dataqr)) }}">
        <p style="font-size: 10px;">
            <small>HERZGROUP</small><br>
        </p>
    </td>
    <td>
        <p style="font-size: 15px;">
            <strong>Venc. {!! Carbon\Carbon::parse($item->updated_at)->addMonths((int) $item->product_expiration)->format('d M, Y') !!}</strong><br>
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
    <td style="text-align: center;" colspan="2">
        <p style="font-size: 10px;">
            <small>El producto no ESTERIL, si el empaque esta ABIERTO o
                HUMEDO</small>
        </p>
    </td>
</tr>
