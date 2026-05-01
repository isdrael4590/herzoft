<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte de Recepciones</title>
    <style>
        @page { size: A4 portrait; margin: 12mm 10mm; }

        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: Arial, sans-serif;
            font-size: 7pt;
            color: #1a1a2e;
            line-height: 1.2;
            background: #fff;
        }

        table { width: 100%; border-collapse: collapse; }

        .mb { margin-bottom: 3mm; }
        .avoid-break { page-break-inside: avoid; }
        .page-break { page-break-before: always; }

        /* ── HEADER ── */
        .tbl-header { border: 1.5px solid #1a1a2e; }
        .tbl-header td { border: none; vertical-align: middle; }

        .hdr-logo {
            width: 22mm; text-align: center; padding: 2mm;
            background: #f4f6fb;
            border-right: 1.5px solid #1a1a2e !important;
        }
        .hdr-logo img { max-width: 20mm; max-height: 16mm; object-fit: contain; }

        .hdr-title { text-align: center; padding: 2mm 3mm; border-right: 1.5px solid #1a1a2e !important; }
        .hdr-title h1 { font-size: 10pt; font-weight: 700; text-transform: uppercase; color: #1a1a2e; line-height: 1.3; }
        .hdr-title h2 { font-size: 7pt; font-weight: 400; color: #555; margin-top: 1mm; }

        .hdr-meta { width: 38mm; padding: 0; vertical-align: top !important; background: #f4f6fb; }
        .meta-row { display: block; padding: 1mm 2mm; border-bottom: 1px solid #d0d5e0; }
        .meta-row:last-child { border-bottom: none; }
        .meta-label { display: block; font-size: 4.5pt; font-weight: 700; text-transform: uppercase; color: #999; letter-spacing: 0.3px; }
        .meta-value { display: block; font-size: 6.5pt; font-weight: 700; color: #1a1a2e; line-height: 1.2; }

        /* ── KPIs ── */
        .tbl-kpi { border-collapse: collapse; width: 100%; }
        .tbl-kpi td {
            background: #1a1a2e;
            text-align: center;
            padding: 2.5mm 2mm;
            border-right: 1px solid #2d3a50;
            vertical-align: middle;
        }
        .tbl-kpi td:last-child { border-right: none; }
        .kpi-number { font-size: 13pt; font-weight: 700; color: #5b9bd5; line-height: 1; }
        .kpi-label  { font-size: 5pt; text-transform: uppercase; color: #bdc3c7; margin-top: 0.8mm; letter-spacing: 0.4px; }

        /* ── SECTION TITLE ── */
        .section-title {
            font-size: 6.5pt; font-weight: 700; text-transform: uppercase;
            letter-spacing: 0.5px;
            border-left: 3px solid #1a1a2e;
            padding-left: 2mm;
            margin-bottom: 1.5mm;
        }

        /* ── PANEL (3-col info) ── */
        .tbl-info td { width: 33.33%; vertical-align: top; border: 1px solid #c8cdd8; padding: 0; }
        .tbl-info td:not(:last-child) { border-right: none; }
        .panel-hdr {
            display: block; background: #1a1a2e; color: #fff;
            padding: 1mm 2mm; font-size: 5.5pt; font-weight: 700;
            text-transform: uppercase; letter-spacing: 0.4px; text-align: center;
        }
        .panel-body { display: block; padding: 1mm 1.5mm; }
        .irow { display: block; padding: 0.5mm 0; border-bottom: 1px dotted #e0e4ed; }
        .irow:last-child { border-bottom: none; }
        .irow-lbl { display: block; font-size: 4.5pt; font-weight: 700; color: #999; text-transform: uppercase; }
        .irow-val { display: block; font-size: 6pt; font-weight: 700; color: #1a1a2e; word-break: break-word; }

        /* ── TABLES ── */
        .tbl-items thead tr { background: #1a1a2e; }
        .tbl-items thead th {
            color: #fff; padding: 1.2mm 1.5mm; font-size: 6pt; font-weight: 700;
            text-align: center; text-transform: uppercase; border: none; vertical-align: middle;
        }
        .tbl-items tbody tr:nth-child(even) { background: #f2f4fa; }
        .tbl-items tbody tr:nth-child(odd)  { background: #fff; }
        .tbl-items tbody td {
            padding: 1mm 1.5mm; font-size: 6.5pt; text-align: center; vertical-align: middle;
            border-bottom: 1px solid #e5e7eb;
        }
        .tbl-items tbody td.text-left { text-align: left !important; padding-left: 2mm; }
        .tbl-items tbody tr:last-child td { border-bottom: 1.5px solid #1a1a2e; }

        /* ── BADGES ── */
        .badge {
            display: inline-block; padding: 0.5mm 3px;
            border-radius: 2px; font-size: 6pt; font-weight: 700; color: #fff;
        }
        .b-dark   { background: #1a1a2e; }
        .b-blue   { background: #2980b9; }
        .b-green  { background: #27ae60; }
        .b-orange { background: #e67e22; }
        .b-purple { background: #8e44ad; }

        /* ── FOOTER ── */
        .doc-footer { border-top: 1.5px solid #1a1a2e; padding-top: 2mm; text-align: center; }
        .footer-inner { display: inline-flex; align-items: center; gap: 2mm; }
        .footer-inner img { height: 6mm; object-fit: contain; }
        .footer-info { font-size: 5.5pt; color: #555; line-height: 1.4; text-align: left; }
        .footer-info strong { font-size: 6pt; color: #1a1a2e; }
    </style>
</head>
<body>


<table class="tbl-header mb avoid-break">
    <tr>
        <td class="hdr-logo">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($dataUrl): ?>
                <img src="<?php echo e($dataUrl); ?>" alt="Logo">
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </td>
        <td class="hdr-title">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($institute): ?>
                <h1><?php echo e($institute->institute_name ?? 'Hospital de Especialidades FF.AA N°1'); ?></h1>
                <h2>Central de Esterilización &mdash; Reporte de Recepciones</h2>
            <?php else: ?>
                <h1>Reporte de Recepciones</h1>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </td>
        <td class="hdr-meta">
            <span class="meta-row">
                <span class="meta-label">Generado</span>
                <span class="meta-value"><?php echo e($print_date); ?></span>
            </span>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!empty($filters['startDate'])): ?>
            <span class="meta-row">
                <span class="meta-label">Período</span>
                <span class="meta-value"><?php echo e($filters['startDate']); ?> → <?php echo e($filters['endDate']); ?></span>
            </span>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            <span class="meta-row">
                <span class="meta-label">Agrupado por</span>
                <span class="meta-value"><?php echo e(['date' => 'Fecha', 'product' => 'Producto', 'area' => 'Área'][$group_by] ?? $group_by); ?></span>
            </span>
            <span class="meta-row">
                <span class="meta-label">Versión &nbsp;|&nbsp; Vigente</span>
                <span class="meta-value">01 &nbsp;|&nbsp; <?php echo e(now()->format('m/Y')); ?></span>
            </span>
        </td>
    </tr>
</table>


<table class="tbl-kpi mb avoid-break">
    <tr>
        <td>
            <div class="kpi-number"><?php echo e(number_format($total_receptions)); ?></div>
            <div class="kpi-label">Recepciones</div>
        </td>
        <td>
            <div class="kpi-number"><?php echo e(number_format($total_packages)); ?></div>
            <div class="kpi-label">Paquetes</div>
        </td>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $status_stats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $st => $cnt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <td>
            <div class="kpi-number"><?php echo e(number_format($cnt)); ?></div>
            <div class="kpi-label"><?php echo e(strtoupper($st ?: 'Sin estado')); ?></div>
        </td>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        <td>
            <div class="kpi-number"><?php echo e($area_summary->count()); ?></div>
            <div class="kpi-label">Áreas</div>
        </td>
    </tr>
</table>


<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!empty($filters['area']) || !empty($filters['status'])): ?>
<table class="tbl-info mb avoid-break">
    <tr>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!empty($filters['area'])): ?>
        <td>
            <span class="panel-hdr">Área</span>
            <span class="panel-body">
                <div class="irow"><span class="irow-val"><?php echo e($filters['area']); ?></span></div>
            </span>
        </td>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!empty($filters['status'])): ?>
        <td>
            <span class="panel-hdr">Estado</span>
            <span class="panel-body">
                <div class="irow"><span class="irow-val"><?php echo e(ucfirst($filters['status'])); ?></span></div>
            </span>
        </td>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </tr>
</table>
<?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>


<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($area_summary->count() > 0): ?>
<div class="mb avoid-break">
    <p class="section-title mb">Resumen por Área</p>
    <table class="tbl-items">
        <thead>
            <tr>
                <th class="text-left" style="text-align:left;padding-left:2mm">Área</th>
                <th>Recepciones</th>
                <th>Paquetes</th>
                <th>Cant. Total</th>
            </tr>
        </thead>
        <tbody>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $area_summary; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td class="text-left"><?php echo e($row->area ?: '(Sin área)'); ?></td>
                <td><span class="badge b-dark"><?php echo e(number_format($row->records_count)); ?></span></td>
                <td><span class="badge b-blue"><?php echo e(number_format($row->packages_count)); ?></span></td>
                <td><span class="badge b-green"><?php echo e(number_format($row->total_quantity)); ?></span></td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </tbody>
    </table>
</div>
<?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>


<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($date_summary->count() > 0 && $group_by !== 'date'): ?>
<div class="mb avoid-break">
    <p class="section-title mb">Resumen por Fecha</p>
    <table class="tbl-items">
        <thead>
            <tr>
                <th>Fecha</th>
                <th>Recepciones</th>
                <th>Paquetes</th>
                <th>Cant. Total</th>
            </tr>
        </thead>
        <tbody>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $date_summary; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><strong><?php echo e(\Carbon\Carbon::parse($row->date)->format('d/m/Y')); ?></strong></td>
                <td><span class="badge b-dark"><?php echo e(number_format($row->records_count)); ?></span></td>
                <td><span class="badge b-blue"><?php echo e(number_format($row->packages_count)); ?></span></td>
                <td><span class="badge b-green"><?php echo e(number_format($row->total_quantity)); ?></span></td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </tbody>
    </table>
</div>
<?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>


<div class="page-break"></div>


<table class="tbl-header mb avoid-break">
    <tr>
        <td class="hdr-logo">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($dataUrl): ?> <img src="<?php echo e($dataUrl); ?>" alt="Logo"> <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </td>
        <td class="hdr-title">
            <h1>Detalle &mdash; Agrupado por <?php echo e(['date'=>'Fecha','product'=>'Producto','area'=>'Área','code_date'=>'Código + Fecha'][$group_by] ?? $group_by); ?></h1>
            <h2><?php echo e($print_date); ?> &nbsp;|&nbsp; <?php echo e(number_format($total_receptions)); ?> recepciones &nbsp;|&nbsp; <?php echo e(number_format($total_packages)); ?> paquetes</h2>
        </td>
        <td class="hdr-meta">
            <span class="meta-row">
                <span class="meta-label">Versión &nbsp;|&nbsp; Vigente</span>
                <span class="meta-value">01 &nbsp;|&nbsp; <?php echo e(now()->format('m/Y')); ?></span>
            </span>
        </td>
    </tr>
</table>

<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($group_by === 'date'): ?>
<div class="mb">
    <p class="section-title mb">Por Fecha</p>
    <table class="tbl-items">
        <thead>
            <tr>
                <th>Fecha</th>
                <th>Recepciones</th>
                <th>Productos Únicos</th>
                <th>Áreas</th>
                <th>Cant. Total</th>
                <th>Paquetes</th>
            </tr>
        </thead>
        <tbody>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $grouped_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><strong><?php echo e(\Carbon\Carbon::parse($row->date)->format('d/m/Y')); ?></strong></td>
                <td><span class="badge b-dark"><?php echo e(number_format($row->records_count)); ?></span></td>
                <td><span class="badge b-purple"><?php echo e(number_format($row->products_count)); ?></span></td>
                <td><span class="badge b-orange"><?php echo e(number_format($row->areas_count)); ?></span></td>
                <td><span class="badge b-green"><?php echo e(number_format($row->total_quantity)); ?></span></td>
                <td><span class="badge b-blue"><?php echo e(number_format($row->total_packages)); ?></span></td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </tbody>
    </table>
</div>

<?php elseif($group_by === 'product'): ?>
<div class="mb">
    <p class="section-title mb">Por Producto</p>
    <table class="tbl-items">
        <thead>
            <tr>
                <th class="text-left" style="text-align:left;padding-left:2mm">Producto</th>
                <th>Código</th>
                <th>Cant. Total</th>
                <th>Paquetes</th>
                <th>Recepciones</th>
            </tr>
        </thead>
        <tbody>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $grouped_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td class="text-left"><strong><?php echo e($row->product_name ?: '—'); ?></strong></td>
                <td style="font-family:monospace;font-size:6pt"><?php echo e($row->product_code ?: '—'); ?></td>
                <td><span class="badge b-green"><?php echo e(number_format($row->total_quantity)); ?></span></td>
                <td><span class="badge b-blue"><?php echo e(number_format($row->total_packages)); ?></span></td>
                <td><span class="badge b-dark"><?php echo e(number_format($row->records_count)); ?></span></td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </tbody>
    </table>
</div>

<?php elseif($group_by === 'area'): ?>
<div class="mb">
    <p class="section-title mb">Por Área</p>
    <table class="tbl-items">
        <thead>
            <tr>
                <th class="text-left" style="text-align:left;padding-left:2mm">Área</th>
                <th>Recepciones</th>
                <th>Productos Únicos</th>
                <th>Cant. Total</th>
                <th>Paquetes</th>
            </tr>
        </thead>
        <tbody>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $grouped_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td class="text-left"><?php echo e($row->area ?: '(Sin área)'); ?></td>
                <td><span class="badge b-dark"><?php echo e(number_format($row->records_count)); ?></span></td>
                <td><span class="badge b-purple"><?php echo e(number_format($row->products_count)); ?></span></td>
                <td><span class="badge b-green"><?php echo e(number_format($row->total_quantity)); ?></span></td>
                <td><span class="badge b-blue"><?php echo e(number_format($row->total_packages)); ?></span></td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </tbody>
    </table>
</div>

<?php else: ?> 
<div class="mb">
    <p class="section-title mb">Por Código + Fecha</p>
    <table class="tbl-items">
        <thead>
            <tr>
                <th>Fecha</th>
                <th>Código</th>
                <th class="text-left" style="text-align:left;padding-left:2mm">Descripción</th>
                <th>Cant. Total</th>
                <th>Paquetes</th>
                <th>Recepciones</th>
            </tr>
        </thead>
        <tbody>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $grouped_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><strong><?php echo e(\Carbon\Carbon::parse($row->date)->format('d/m/Y')); ?></strong></td>
                <td style="font-family:monospace;font-size:6pt"><?php echo e($row->product_code ?: '—'); ?></td>
                <td class="text-left"><?php echo e($row->product_name ?: '—'); ?></td>
                <td><span class="badge b-green"><?php echo e(number_format($row->total_quantity)); ?></span></td>
                <td><span class="badge b-blue"><?php echo e(number_format($row->total_packages)); ?></span></td>
                <td><span class="badge b-dark"><?php echo e(number_format($row->records_count)); ?></span></td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </tbody>
    </table>
</div>
<?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>


<div class="doc-footer avoid-break">
    <div class="footer-inner">
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($dataUrlogo): ?>
            <img src="<?php echo e($dataUrlogo); ?>" alt="Logo empresa">
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        <div class="footer-info">
            <strong><?php echo e(Settings()->company_name ?? ''); ?></strong>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(Settings()->company_email): ?> &nbsp;·&nbsp; <?php echo e(Settings()->company_email); ?> <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(Settings()->company_phone): ?> &nbsp;·&nbsp; <?php echo e(Settings()->company_phone); ?> <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>
    </div>
</div>

</body>
</html>
<?php /**PATH /var/www/html/Modules/Reports/Resources/views/reception/print-aggregated.blade.php ENDPATH**/ ?>