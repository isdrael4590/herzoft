<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        @page { margin: 0; }

        body { font-family: sans-serif; font-size: 6pt; }

        .label      { width: 100%; page-break-after: always; page-break-inside: avoid; }
        .label-last { width: 100%; page-break-after: avoid;  page-break-inside: avoid; }

        table {
            width: 100%;
            border-collapse: collapse;
            border: 0.3pt solid #000;
        }

        td, th {
            border: 0.3pt solid #000;
            padding: 1.5pt;
            vertical-align: top;
        }

        .header th {
            text-align: center;
            font-size: 7pt;
        }

        .header-sub { font-size: 5pt; font-weight: normal; }

        .col { width: 50%; font-size: 5.5pt; }
        .col p { margin: 0.8pt 0; line-height: 1.2; }
        .venc  { font-size: 7.5pt; font-weight: bold; }
        .elab  { font-size: 6pt; }
        .bold  { font-weight: bold; }
    </style>
</head>
<body>
    @php
        $allLabels = [];
        foreach ($details as $item) {
            for ($i = 0; $i < $item->product_quantity; $i++) {
                $allLabels[] = $item;
            }
        }
        $lastIdx = count($allLabels) - 1;
    @endphp

    @foreach ($allLabels as $idx => $item)
    <div class="{{ $idx === $lastIdx ? 'label-last' : 'label' }}">
        <table>
            <tr class="header">
                <th colspan="2">
                    {{ institutes()->institute_name }}
                    <br><span class="header-sub">{{ institutes()->institute_area }} — {{ institutes()->institute_city }}</span>
                </th>
            </tr>
            <tr>
                <td class="col">
                    <p class="elab">Elab. {!! \Carbon\Carbon::parse($item->updated_at)->format('d-m-Y') !!}</p>
                    <p class="bold">{{ $labelqr->machine_name }} → Lote: {{ $labelqr->lote_machine }}</p>
                    <p class="bold">{{ $item->product_name }}</p>
                    <p>{{ $item->product_info }}</p>
                    <p>{{ $item->product_outside_company }} / {{ $item->product_patient }}</p>
                </td>
                <td class="col">
                    <p class="venc">Venc. {!! \Carbon\Carbon::parse($item->updated_at)->addDays((int)$item->product_expiration)->format('d-m-Y') !!}</p>
                    @if(isset($productAreas[$item->product_code]))
                        <p class="bold">{{ $productAreas[$item->product_code] }}</p>
                    @endif
                    <p><span class="bold">{{ $labelqr->reference }}</span> / {{ $labelqr->type_program }}</p>
                    <p>Op: {{ $labelqr->operator }}</p>
                    <p>Op.Emp: {{ $item->product_operator_package }}</p>
                </td>
            </tr>
        </table>
    </div>
    @endforeach
</body>
</html>
