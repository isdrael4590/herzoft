<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Reporte de Recepciones</title>
<style>
    @page {
        size: A4 portrait;
        margin: 14mm 12mm 12mm 12mm;
    }

    * { box-sizing: border-box; margin: 0; padding: 0; }

    body {
        font-family: Arial, sans-serif;
        font-size: 7pt;
        color: #1a1a2e;
        line-height: 1.25;
        background: #fff;
        width: 100%;
    }

    /* ── UTILIDADES ── */
    table  { width: 100%; border-collapse: collapse; table-layout: fixed; }
    .mb2   { margin-bottom: 2mm; }
    .mb4   { margin-bottom: 4mm; }
    .avoid { page-break-inside: avoid; }
    .break { page-break-before: always; }
    .right { text-align: right !important; }
    .center{ text-align: center !important; }
    .left  { text-align: left !important; }
    .bold  { font-weight: 700; }
    .mono  { font-family: 'Courier New', monospace; font-size: 6.5pt; }

    /* ── HEADER ── */
    .header-wrap {
        border: 1.5px solid #1a1a2e;
        border-radius: 2px;
        overflow: hidden;
    }
    .header-wrap table { table-layout: fixed; }

    .col-logo {
        width: 22mm;
        text-align: center;
        vertical-align: middle;
        padding: 2.5mm;
        background: #f0f3fa;
        border-right: 1.5px solid #1a1a2e;
    }
    .col-logo img { max-width: 19mm; max-height: 15mm; object-fit: contain; }

    .col-title {
        vertical-align: middle;
        text-align: center;
        padding: 2mm 3mm;
        border-right: 1.5px solid #1a1a2e;
    }
    .col-title h1 {
        font-size: 9.5pt; font-weight: 700;
        text-transform: uppercase; color: #1a1a2e; line-height: 1.3;
    }
    .col-title h2 {
        font-size: 6.5pt; font-weight: 400; color: #666; margin-top: 1mm;
    }

    .col-meta {
        width: 46mm;
        vertical-align: top;
        background: #f0f3fa;
    }
    .meta-item {
        display: block;
        padding: 1.2mm 2.5mm;
        border-bottom: 1px solid #d8dce8;
    }
    .meta-item:last-child { border-bottom: none; }
    .meta-lbl { display: block; font-size: 4.5pt; font-weight: 700; text-transform: uppercase; color: #888; letter-spacing: 0.4px; }
    .meta-val { display: block; font-size: 6.5pt; font-weight: 700; color: #1a1a2e; }

    /* ── KPIs ── */
    .kpi-bar { width: 100%; border-collapse: collapse; table-layout: fixed; }
    .kpi-bar td {
        background: #1a1a2e;
        text-align: center;
        vertical-align: middle;
        padding: 2.5mm 1mm;
        border-right: 1px solid #2d3a50;
    }
    .kpi-bar td:last-child { border-right: none; }
    .kpi-num { font-size: 12pt; font-weight: 700; color: #5b9bd5; line-height: 1; }
    .kpi-lbl { font-size: 5pt; text-transform: uppercase; color: #bdc3c7; margin-top: 0.8mm; letter-spacing: 0.3px; }

    /* ── SECTION TITLE ── */
    .sec-title {
        font-size: 6.5pt; font-weight: 700; text-transform: uppercase;
        letter-spacing: 0.6px; color: #1a1a2e;
        border-left: 3px solid #1a1a2e;
        padding: 0.5mm 0 0.5mm 2mm;
        margin-bottom: 1.5mm;
    }

    /* ── DOS COLUMNAS ── */
    .two-col { width: 100%; border-collapse: collapse; table-layout: fixed; }
    .two-col > tbody > tr > td {
        vertical-align: top;
        padding: 0;
    }
    .two-col > tbody > tr > td:first-child { padding-right: 2mm; }

    /* ── TABLA DATOS ── */
    .tbl { width: 100%; border-collapse: collapse; table-layout: fixed; }
    .tbl thead tr { background: #1a1a2e; }
    .tbl thead th {
        color: #fff; font-size: 6pt; font-weight: 700;
        text-transform: uppercase; text-align: center;
        padding: 1.5mm 1mm; border: none; vertical-align: middle;
        letter-spacing: 0.3px;
    }
    .tbl thead th.left-h { text-align: left; padding-left: 2mm; }

    .tbl tbody tr:nth-child(even) { background: #f2f4fa; }
    .tbl tbody tr:nth-child(odd)  { background: #fff; }
    .tbl tbody td {
        padding: 1.2mm 1mm; font-size: 6.5pt;
        text-align: center; vertical-align: middle;
        border-bottom: 1px solid #e8eaf0;
        overflow: hidden; text-overflow: ellipsis; white-space: nowrap;
    }
    .tbl tbody td.td-left { text-align: left; padding-left: 2mm; }
    .tbl tbody tr:last-child td { border-bottom: 2px solid #1a1a2e; }

    /* ── BADGES ── */
    .b {
        display: inline-block; padding: 0.4mm 2.5px;
        border-radius: 2px; font-size: 6pt; font-weight: 700; color: #fff;
        white-space: nowrap;
    }
    .b-dark   { background: #1a1a2e; }
    .b-blue   { background: #2980b9; }
    .b-green  { background: #27ae60; }
    .b-orange { background: #e67e22; }
    .b-purple { background: #8e44ad; }
    .b-red    { background: #c0392b; }

    /* ── FILTROS ── */
    .filter-bar {
        background: #f8f9fc;
        border: 1px solid #d0d5e8;
        border-radius: 2px;
        padding: 1.5mm 2mm;
        font-size: 6pt;
        color: #444;
    }
    .filter-bar strong { color: #1a1a2e; }

    /* ── TOTALS ROW ── */
    .tbl tfoot tr { background: #edf0f8; }
    .tbl tfoot td {
        padding: 1.2mm 1mm; font-size: 6.5pt; font-weight: 700;
        text-align: center; vertical-align: middle;
        border-top: 2px solid #1a1a2e;
        color: #1a1a2e;
    }
    .tbl tfoot td.td-left { text-align: left; padding-left: 2mm; }

    /* ── FOOTER ── */
    .footer {
        border-top: 1.5px solid #1a1a2e;
        padding-top: 2mm;
        margin-top: 3mm;
        text-align: center;
    }
    .footer table { table-layout: auto; width: auto; margin: 0 auto; }
    .footer td { padding: 0 2mm; vertical-align: middle; border: none; }
    .footer img { height: 6mm; object-fit: contain; }
    .footer-txt { font-size: 5.5pt; color: #555; line-height: 1.4; }
    .footer-txt strong { font-size: 6pt; color: #1a1a2e; }
</style>
</head>
<body>

{{-- ══════════════════════════════════════════
     PÁGINA 1 — CABECERA + KPIs + RESÚMENES
     ══════════════════════════════════════════ --}}

{{-- HEADER --}}
<div class="header-wrap mb4 avoid">
    <table>
        <colgroup>
            <col style="width:22mm">
            <col>
            <col style="width:46mm">
        </colgroup>
        <tbody>
        <tr>
            <td class="col-logo">
                @if($dataUrl)
                    <img src="{{ $dataUrl }}" alt="Logo">
                @else
                    <div style="font-size:5pt;color:#999;">LOGO</div>
                @endif
            </td>
            <td class="col-title">
                <h1>{{ $institute->institute_name ?? 'Reporte de Recepciones' }}</h1>
                <h2>Central de Esterilización &mdash; Reporte de Recepciones</h2>
            </td>
            <td class="col-meta">
                <span class="meta-item">
                    <span class="meta-lbl">Generado</span>
                    <span class="meta-val">{{ $print_date }}</span>
                </span>
                @if(!empty($filters['startDate']))
                <span class="meta-item">
                    <span class="meta-lbl">Período</span>
                    <span class="meta-val">{{ $filters['startDate'] }} → {{ $filters['endDate'] }}</span>
                </span>
                @endif
                <span class="meta-item">
                    <span class="meta-lbl">Agrupado por</span>
                    <span class="meta-val">{{ ['date'=>'Fecha','product'=>'Producto','area'=>'Área','code_date'=>'Código + Fecha'][$group_by] ?? $group_by }}</span>
                </span>
                <span class="meta-item">
                    <span class="meta-lbl">Versión &nbsp;|&nbsp; Vigente</span>
                    <span class="meta-val">01 &nbsp;|&nbsp; {{ now()->format('m/Y') }}</span>
                </span>
            </td>
        </tr>
        </tbody>
    </table>
</div>

{{-- KPIs --}}
<table class="kpi-bar mb4 avoid">
    <tbody>
    <tr>
        <td>
            <div class="kpi-num">{{ number_format($total_receptions) }}</div>
            <div class="kpi-lbl">Recepciones</div>
        </td>
        <td>
            <div class="kpi-num">{{ number_format($total_packages) }}</div>
            <div class="kpi-lbl">Paquetes</div>
        </td>
        @foreach($status_stats as $st => $cnt)
        <td>
            <div class="kpi-num">{{ number_format($cnt) }}</div>
            <div class="kpi-lbl">{{ strtoupper($st ?: 'Sin estado') }}</div>
        </td>
        @endforeach
        <td>
            <div class="kpi-num">{{ $area_summary->count() }}</div>
            <div class="kpi-lbl">Áreas</div>
        </td>
        <td>
            <div class="kpi-num">{{ $date_summary->count() }}</div>
            <div class="kpi-lbl">Días</div>
        </td>
    </tr>
    </tbody>
</table>

{{-- FILTROS ACTIVOS --}}
@if(!empty($filters['area']) || !empty($filters['status']))
<div class="filter-bar mb4 avoid">
    Filtros activos:
    @if(!empty($filters['area'])) &nbsp;<strong>Área:</strong> {{ $filters['area'] }} @endif
    @if(!empty($filters['status'])) &nbsp;<strong>Estado:</strong> {{ ucfirst($filters['status']) }} @endif
</div>
@endif

{{-- RESÚMENES EN DOS COLUMNAS --}}
<table class="two-col mb4 avoid">
    <colgroup><col style="width:49%"><col style="width:51%"></colgroup>
    <tbody>
    <tr>
        {{-- Resumen por Área --}}
        <td>
            @if($area_summary->count() > 0)
            <p class="sec-title">Resumen por Área</p>
            <table class="tbl">
                <colgroup>
                    <col style="width:42%">
                    <col style="width:19%">
                    <col style="width:19%">
                    <col style="width:20%">
                </colgroup>
                <thead>
                    <tr>
                        <th class="left-h">Área</th>
                        <th>Recep.</th>
                        <th>Paquetes</th>
                        <th>Cant.</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($area_summary as $row)
                    <tr>
                        <td class="td-left">{{ $row->area ?: '(Sin área)' }}</td>
                        <td><span class="b b-dark">{{ number_format($row->records_count) }}</span></td>
                        <td><span class="b b-blue">{{ number_format($row->packages_count) }}</span></td>
                        <td><span class="b b-green">{{ number_format($row->total_quantity) }}</span></td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td class="td-left bold">TOTAL</td>
                        <td><span class="b b-dark">{{ number_format($area_summary->sum('records_count')) }}</span></td>
                        <td><span class="b b-blue">{{ number_format($area_summary->sum('packages_count')) }}</span></td>
                        <td><span class="b b-green">{{ number_format($area_summary->sum('total_quantity')) }}</span></td>
                    </tr>
                </tfoot>
            </table>
            @endif
        </td>

        {{-- Resumen por Fecha --}}
        <td>
            @if($date_summary->count() > 0)
            <p class="sec-title">Resumen por Fecha</p>
            <table class="tbl">
                <colgroup>
                    <col style="width:30%">
                    <col style="width:23%">
                    <col style="width:23%">
                    <col style="width:24%">
                </colgroup>
                <thead>
                    <tr>
                        <th>Fecha</th>
                        <th>Recep.</th>
                        <th>Paquetes</th>
                        <th>Cant.</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($date_summary as $row)
                    <tr>
                        <td class="bold">{{ \Carbon\Carbon::parse($row->date)->format('d/m/Y') }}</td>
                        <td><span class="b b-dark">{{ number_format($row->records_count) }}</span></td>
                        <td><span class="b b-blue">{{ number_format($row->packages_count) }}</span></td>
                        <td><span class="b b-green">{{ number_format($row->total_quantity) }}</span></td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td class="td-left bold">TOTAL</td>
                        <td><span class="b b-dark">{{ number_format($date_summary->sum('records_count')) }}</span></td>
                        <td><span class="b b-blue">{{ number_format($date_summary->sum('packages_count')) }}</span></td>
                        <td><span class="b b-green">{{ number_format($date_summary->sum('total_quantity')) }}</span></td>
                    </tr>
                </tfoot>
            </table>
            @endif
        </td>
    </tr>
    </tbody>
</table>

{{-- ══════════════════════════════════════════
     PÁGINA 2 — DETALLE AGRUPADO
     ══════════════════════════════════════════ --}}
<div class="break"></div>

{{-- HEADER página 2 --}}
<div class="header-wrap mb4 avoid">
    <table>
        <colgroup>
            <col style="width:22mm">
            <col>
            <col style="width:46mm">
        </colgroup>
        <tbody>
        <tr>
            <td class="col-logo">
                @if($dataUrl)
                    <img src="{{ $dataUrl }}" alt="Logo">
                @endif
            </td>
            <td class="col-title">
                <h1>Detalle — Agrupado por {{ ['date'=>'Fecha','product'=>'Producto','area'=>'Área','code_date'=>'Código + Fecha'][$group_by] ?? $group_by }}</h1>
                <h2>{{ $print_date }} &nbsp;|&nbsp; {{ number_format($total_receptions) }} recepciones &nbsp;|&nbsp; {{ number_format($total_packages) }} paquetes</h2>
            </td>
            <td class="col-meta">
                <span class="meta-item">
                    <span class="meta-lbl">Versión &nbsp;|&nbsp; Vigente</span>
                    <span class="meta-val">01 &nbsp;|&nbsp; {{ now()->format('m/Y') }}</span>
                </span>
                @if(!empty($filters['startDate']))
                <span class="meta-item">
                    <span class="meta-lbl">Período</span>
                    <span class="meta-val">{{ $filters['startDate'] }} → {{ $filters['endDate'] }}</span>
                </span>
                @endif
            </td>
        </tr>
        </tbody>
    </table>
</div>

{{-- ── DETALLE POR FECHA ── --}}
@if($group_by === 'date')
<p class="sec-title mb2">Detalle por Fecha</p>
<table class="tbl mb4">
    <colgroup>
        <col style="width:16%">
        <col style="width:17%">
        <col style="width:17%">
        <col style="width:17%">
        <col style="width:16%">
        <col style="width:17%">
    </colgroup>
    <thead>
        <tr>
            <th>Fecha</th>
            <th>Recepciones</th>
            <th>Prod. Únicos</th>
            <th>Áreas</th>
            <th>Cant. Total</th>
            <th>Paquetes</th>
        </tr>
    </thead>
    <tbody>
        @foreach($grouped_data as $row)
        <tr>
            <td class="bold">{{ \Carbon\Carbon::parse($row->date)->format('d/m/Y') }}</td>
            <td><span class="b b-dark">{{ number_format($row->records_count) }}</span></td>
            <td><span class="b b-purple">{{ number_format($row->products_count) }}</span></td>
            <td><span class="b b-orange">{{ number_format($row->areas_count) }}</span></td>
            <td><span class="b b-green">{{ number_format($row->total_quantity) }}</span></td>
            <td><span class="b b-blue">{{ number_format($row->total_packages) }}</span></td>
        </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <td class="td-left bold">TOTAL</td>
            <td><span class="b b-dark">{{ number_format($grouped_data->sum('records_count')) }}</span></td>
            <td>—</td>
            <td>—</td>
            <td><span class="b b-green">{{ number_format($grouped_data->sum('total_quantity')) }}</span></td>
            <td><span class="b b-blue">{{ number_format($grouped_data->sum('total_packages')) }}</span></td>
        </tr>
    </tfoot>
</table>

{{-- ── DETALLE POR PRODUCTO ── --}}
@elseif($group_by === 'product')
<p class="sec-title mb2">Detalle por Producto</p>
<table class="tbl mb4">
    <colgroup>
        <col style="width:45%">
        <col style="width:20%">
        <col style="width:12%">
        <col style="width:12%">
        <col style="width:11%">
    </colgroup>
    <thead>
        <tr>
            <th class="left-h">Producto</th>
            <th class="left-h">Código</th>
            <th>Cant. Total</th>
            <th>Paquetes</th>
            <th>Recep.</th>
        </tr>
    </thead>
    <tbody>
        @foreach($grouped_data as $row)
        <tr>
            <td class="td-left bold">{{ $row->product_name ?: '—' }}</td>
            <td class="td-left mono">{{ $row->product_code ?: '—' }}</td>
            <td><span class="b b-green">{{ number_format($row->total_quantity) }}</span></td>
            <td><span class="b b-blue">{{ number_format($row->total_packages) }}</span></td>
            <td><span class="b b-dark">{{ number_format($row->records_count) }}</span></td>
        </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <td class="td-left bold" colspan="2">TOTAL</td>
            <td><span class="b b-green">{{ number_format($grouped_data->sum('total_quantity')) }}</span></td>
            <td><span class="b b-blue">{{ number_format($grouped_data->sum('total_packages')) }}</span></td>
            <td><span class="b b-dark">{{ number_format($grouped_data->sum('records_count')) }}</span></td>
        </tr>
    </tfoot>
</table>

{{-- ── DETALLE POR ÁREA ── --}}
@elseif($group_by === 'area')
<p class="sec-title mb2">Detalle por Área</p>
<table class="tbl mb4">
    <colgroup>
        <col style="width:35%">
        <col style="width:16%">
        <col style="width:17%">
        <col style="width:16%">
        <col style="width:16%">
    </colgroup>
    <thead>
        <tr>
            <th class="left-h">Área</th>
            <th>Recepciones</th>
            <th>Prod. Únicos</th>
            <th>Cant. Total</th>
            <th>Paquetes</th>
        </tr>
    </thead>
    <tbody>
        @foreach($grouped_data as $row)
        <tr>
            <td class="td-left">{{ $row->area ?: '(Sin área)' }}</td>
            <td><span class="b b-dark">{{ number_format($row->records_count) }}</span></td>
            <td><span class="b b-purple">{{ number_format($row->products_count) }}</span></td>
            <td><span class="b b-green">{{ number_format($row->total_quantity) }}</span></td>
            <td><span class="b b-blue">{{ number_format($row->total_packages) }}</span></td>
        </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <td class="td-left bold">TOTAL</td>
            <td><span class="b b-dark">{{ number_format($grouped_data->sum('records_count')) }}</span></td>
            <td>—</td>
            <td><span class="b b-green">{{ number_format($grouped_data->sum('total_quantity')) }}</span></td>
            <td><span class="b b-blue">{{ number_format($grouped_data->sum('total_packages')) }}</span></td>
        </tr>
    </tfoot>
</table>

{{-- ── DETALLE POR CÓDIGO + FECHA ── --}}
@else
<p class="sec-title mb2">Detalle por Código + Fecha</p>
<table class="tbl mb4">
    <colgroup>
        <col style="width:13%">
        <col style="width:17%">
        <col style="width:38%">
        <col style="width:11%">
        <col style="width:11%">
        <col style="width:10%">
    </colgroup>
    <thead>
        <tr>
            <th>Fecha</th>
            <th class="left-h">Código</th>
            <th class="left-h">Descripción</th>
            <th>Cant.</th>
            <th>Paquetes</th>
            <th>Recep.</th>
        </tr>
    </thead>
    <tbody>
        @foreach($grouped_data as $row)
        <tr>
            <td class="bold">{{ \Carbon\Carbon::parse($row->date)->format('d/m/Y') }}</td>
            <td class="td-left mono">{{ $row->product_code ?: '—' }}</td>
            <td class="td-left">{{ $row->product_name ?: '—' }}</td>
            <td><span class="b b-green">{{ number_format($row->total_quantity) }}</span></td>
            <td><span class="b b-blue">{{ number_format($row->total_packages) }}</span></td>
            <td><span class="b b-dark">{{ number_format($row->records_count) }}</span></td>
        </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <td colspan="3" class="td-left bold">TOTAL</td>
            <td><span class="b b-green">{{ number_format($grouped_data->sum('total_quantity')) }}</span></td>
            <td><span class="b b-blue">{{ number_format($grouped_data->sum('total_packages')) }}</span></td>
            <td><span class="b b-dark">{{ number_format($grouped_data->sum('records_count')) }}</span></td>
        </tr>
    </tfoot>
</table>
@endif

{{-- FOOTER --}}
<div class="footer avoid">
    <table>
        <tbody>
        <tr>
            @if($dataUrlogo)
            <td><img src="{{ $dataUrlogo }}" alt="Logo empresa"></td>
            @endif
            <td>
                <div class="footer-txt">
                    <strong>{{ Settings()->company_name ?? '' }}</strong>
                    @if(Settings()->company_email) &nbsp;·&nbsp; {{ Settings()->company_email }} @endif
                    @if(Settings()->company_phone) &nbsp;·&nbsp; {{ Settings()->company_phone }} @endif
                </div>
            </td>
        </tr>
        </tbody>
    </table>
</div>

</body>
</html>
