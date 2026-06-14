<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        @page {
            margin: 0;
        }

        body {
            font-family: sans-serif;
            font-size: 6pt;
        }

        .label {
            width: 100%;
            page-break-after: always;
            page-break-inside: avoid;
        }

        .label-last {
            width: 100%;
            page-break-after: avoid;
            page-break-inside: avoid;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            border: 0.3pt solid #000;
        }

        td, th {
            border: 0.3pt solid #000;
            padding: 1pt;
            vertical-align: middle;
        }

        .header-row th {
            text-align: center;
            font-size: 6.5pt;
            padding: 1pt;
        }

        .header-sub {
            font-size: 5pt;
            font-weight: normal;
        }

        .qr-cell {
            width: 36%;
            text-align: center;
            vertical-align: middle;
        }

        .info-cell {
            width: 64%;
            vertical-align: top;
            font-size: 5.5pt;
            padding: 1.5pt;
        }

        .info-cell p { margin: 0.5pt 0; line-height: 1.1; }
        .info-cell .venc { font-size: 7pt; font-weight: bold; }
        .footer-row td {
            text-align: center;
            font-size: 4.5pt;
            padding: 1pt;
        }
    </style>
</head>
<body>
    @php
        $allLabels = [];
        foreach ($labelqr->labelqrDetails as $item) {
            for ($i = 0; $i < $item->product_quantity; $i++) {
                $allLabels[] = $item;
            }
        }
        $lastIdx = count($allLabels) - 1;
    @endphp

    @foreach ($allLabels as $idx => $item)
    <div class="{{ $idx === $lastIdx ? 'label-last' : 'label' }}">
        <table>
            <tr class="header-row">
                <th colspan="2">
                    {{ institutes()->institute_name }}
                    <br><span class="header-sub">{{ institutes()->institute_area }} — {{ institutes()->institute_city }}</span>
                </th>
            </tr>
            <tr>
                <td class="qr-cell">
                    <img src="{{ $qrCodes[$item->product_code] }}" style="width:52pt;height:52pt;">
                    <div style="font-size:4pt;">HERZGROUP</div>
                </td>
                <td class="info-cell">
                    <p class="venc">Venc. {!! \Carbon\Carbon::parse($item->updated_at)->addDays((int)$item->product_expiration)->format('d M, Y') !!}</p>
                    <p>Elab. {!! \Carbon\Carbon::parse($item->updated_at)->format('d M, Y') !!}</p>
                    <p><strong>{{ $labelqr->machine_name }}</strong> — Lote: {{ $labelqr->lote_machine }}</p>
                    <p>{{ $labelqr->reference }} / {{ $labelqr->type_program }}</p>
                    <p><strong>{{ $item->product_name }}</strong> · {{ $item->product_code }}</p>
                    <p>{{ $item->product_patient }}</p>
                    <p>Op: {{ $labelqr->operator }}</p>
                </td>
            </tr>
            <tr class="footer-row">
                <td colspan="2">No ESTERIL si empaque ABIERTO o HÚMEDO</td>
            </tr>
        </table>
    </div>
    @endforeach
</body>
</html>
