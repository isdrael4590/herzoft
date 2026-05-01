<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte de Recepciones</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: Arial, sans-serif;
            font-size: 9px;
            color: #222;
            padding: 12mm 10mm;
        }

        /* ── Header ── */
        .header {
            display: flex;
            align-items: center;
            border-bottom: 2px solid #333;
            padding-bottom: 8px;
            margin-bottom: 10px;
        }
        .header img { height: 48px; margin-right: 12px; }
        .header-text h1 { font-size: 13px; color: #222; }
        .header-text h2 { font-size: 11px; color: #555; font-weight: normal; }
        .header-text p  { font-size: 8px; color: #777; margin-top: 2px; }

        /* ── Meta del reporte ── */
        .meta-row {
            display: flex;
            justify-content: space-between;
            background: #f4f4f4;
            border: 1px solid #ddd;
            padding: 5px 8px;
            margin-bottom: 10px;
            font-size: 8px;
        }
        .meta-row strong { color: #333; }

        /* ── Resumen ejecutivo ── */
        .summary-box {
            border: 1px solid #ccc;
            border-radius: 3px;
            padding: 8px 10px;
            margin-bottom: 10px;
            background: #fafafa;
        }
        .summary-box h3 {
            font-size: 10px;
            color: #444;
            margin-bottom: 6px;
            border-bottom: 1px solid #ddd;
            padding-bottom: 4px;
        }
        .kpi-row {
            display: flex;
            justify-content: space-around;
            text-align: center;
            margin-bottom: 8px;
        }
        .kpi { min-width: 70px; }
        .kpi-number { font-size: 16px; font-weight: bold; color: #0055aa; }
        .kpi-label  { font-size: 7px; color: #888; text-transform: uppercase; margin-top: 1px; }

        /* ── Tabla de resumen por área ── */
        .area-summary { width: 100%; border-collapse: collapse; margin-bottom: 6px; }
        .area-summary th {
            background: #444;
            color: #fff;
            padding: 3px 6px;
            font-size: 8px;
            text-align: center;
        }
        .area-summary td {
            padding: 3px 6px;
            border: 1px solid #ddd;
            font-size: 8px;
            text-align: center;
        }
        .area-summary tr:nth-child(even) td { background: #f7f7f7; }

        /* ── Tabla de datos ── */
        .data-table { width: 100%; border-collapse: collapse; margin-bottom: 8px; }
        .data-table th {
            background: #2c3e50;
            color: #fff;
            padding: 4px 5px;
            text-align: center;
            font-size: 8px;
            border: 1px solid #1a2535;
        }
        .data-table td {
            padding: 3px 4px;
            text-align: center;
            font-size: 7.5px;
            border: 1px solid #ddd;
        }
        .data-table tr:nth-child(even) td { background: #f8f8f8; }

        .badge {
            display: inline-block;
            padding: 1px 4px;
            border-radius: 2px;
            font-size: 7px;
            font-weight: bold;
            color: #fff;
        }
        .badge-green  { background: #27ae60; }
        .badge-yellow { background: #e67e22; color: #fff; }
        .badge-grey   { background: #7f8c8d; }
        .badge-blue   { background: #2980b9; }

        /* ── Footer ── */
        .footer {
            margin-top: 12px;
            border-top: 1px solid #ccc;
            padding-top: 5px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 7px;
            color: #888;
        }
        .footer img { height: 24px; }

        /* ── Salto de página ── */
        .page-break { page-break-before: always; }

        @page {
            size: A4 <?php echo e($selected_count > 8000 ? 'landscape' : 'portrait'); ?>;
            margin: 10mm;
        }
    </style>
</head>
<body>




<div class="header">
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($dataUrl): ?>
        <img src="<?php echo e($dataUrl); ?>" alt="Logo">
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    <div class="header-text">
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($institute): ?>
            <h1><?php echo e($institute->institute_name ?? 'Hospital de Especialidades FF.AA N°1'); ?></h1>
            <h2>Central de Esterilización — Reporte de Recepciones</h2>
            <p>
                <?php echo e($institute->address ?? ''); ?>

                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($institute->city): ?> | <?php echo e($institute->city); ?> <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </p>
        <?php else: ?>
            <h1>Reporte de Recepciones</h1>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </div>
</div>


<div class="meta-row">
    <div><strong>Generado:</strong> <?php echo e($print_date); ?></div>
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!empty($filters['startDate'])): ?>
        <div><strong>Período:</strong> <?php echo e($filters['startDate']); ?> → <?php echo e($filters['endDate']); ?></div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!empty($filters['area'])): ?>
        <div><strong>Área:</strong> <?php echo e($filters['area']); ?></div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!empty($filters['status'])): ?>
        <div><strong>Estado:</strong> <?php echo e(ucfirst($filters['status'])); ?></div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    <div><strong>Versión:</strong> 01 &nbsp;|&nbsp; <strong>Vigente:</strong> <?php echo e(now()->format('m/Y')); ?></div>
</div>


<div class="summary-box">
    <h3>Resumen Ejecutivo</h3>
    <div class="kpi-row">
        <div class="kpi">
            <div class="kpi-number"><?php echo e(number_format($selected_count)); ?></div>
            <div class="kpi-label">Recepciones</div>
        </div>
        <div class="kpi">
            <div class="kpi-number"><?php echo e(number_format($total_packages)); ?></div>
            <div class="kpi-label">Paquetes</div>
        </div>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $status_stats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $st => $cnt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="kpi">
                <div class="kpi-number"><?php echo e(number_format($cnt)); ?></div>
                <div class="kpi-label"><?php echo e(strtoupper($st)); ?></div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </div>

    
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($area_summary->count() > 0): ?>
        <table class="area-summary">
            <thead>
                <tr>
                    <th>Área</th>
                    <th>Recepciones</th>
                    <th>Paquetes</th>
                </tr>
            </thead>
            <tbody>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $area_summary; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $as): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td style="text-align:left"><?php echo e($as->area); ?></td>
                        <td><?php echo e(number_format($as->records_count)); ?></td>
                        <td><?php echo e(number_format($as->packages_count)); ?></td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </tbody>
        </table>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
</div>


<div class="page-break"></div>


<div class="header" style="margin-bottom:8px;">
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($dataUrl): ?>
        <img src="<?php echo e($dataUrl); ?>" alt="Logo">
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    <div class="header-text">
        <h1>Detalle de Recepciones</h1>
        <p><?php echo e($print_date); ?> &nbsp;|&nbsp; <?php echo e(number_format($selected_count)); ?> registros</p>
    </div>
</div>

<table class="data-table">
    <thead>
        <tr>
            <th style="width:9%">Fecha</th>
            <th style="width:11%">Referencia</th>
            <th style="width:14%">Área</th>
            <th style="width:7%">Estado</th>
            <th style="width:20%">Entrega</th>
            <th style="width:20%">Recibe</th>
            <th style="width:19%">Productos</th>
        </tr>
    </thead>
    <tbody>
        <?php $rowsPerPage = $selected_count > 5000 ? 60 : 40; ?>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $receptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($i > 0 && $i % $rowsPerPage === 0): ?>
                </tbody>
            </table>
            <div class="page-break"></div>
            <table class="data-table">
                <thead>
                    <tr>
                        <th style="width:9%">Fecha</th>
                        <th style="width:11%">Referencia</th>
                        <th style="width:14%">Área</th>
                        <th style="width:7%">Estado</th>
                        <th style="width:20%">Entrega</th>
                        <th style="width:20%">Recibe</th>
                        <th style="width:19%">Productos</th>
                    </tr>
                </thead>
                <tbody>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            <tr>
                <td><?php echo e(\Carbon\Carbon::parse($r->updated_at)->format('d/m/y')); ?></td>
                <td><strong><?php echo e($r->reference); ?></strong></td>
                <td style="text-align:left; font-size:7px"><?php echo e(Str::limit($r->area ?? '', 18)); ?></td>
                <td>
                    <?php
                        $st = strtolower($r->status ?? '');
                        $cls = match($st) {
                            'procesado'  => 'badge-green',
                            'pendiente'  => 'badge-yellow',
                            default      => 'badge-grey',
                        };
                    ?>
                    <span class="badge <?php echo e($cls); ?>"><?php echo e(strtoupper(substr($r->status ?? '-', 0, 3))); ?></span>
                </td>
                <td style="text-align:left; font-size:7px"><?php echo e(Str::limit($r->delivery_staff ?? '', 22)); ?></td>
                <td style="text-align:left; font-size:7px"><?php echo e(Str::limit($r->operator ?? '', 22)); ?></td>
                <td style="text-align:left; font-size:6.5px; line-height:1.3">
                    <?php
                        $names = $r->receptionDetails->pluck('product_name')->filter()->unique()->take(3);
                        $extra = $r->receptionDetails->count() - $names->count();
                    ?>
                    <?php echo e($names->implode(', ')); ?><?php echo e($extra > 0 ? ' +' . $extra : ''); ?>

                </td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </tbody>
</table>


<div class="footer">
    <div>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($dataUrlogo): ?>
            <img src="<?php echo e($dataUrlogo); ?>" alt="Logo">
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </div>
    <div>
        <?php echo e(Settings()->company_name ?? ''); ?>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(Settings()->company_email): ?> &nbsp;|&nbsp; <?php echo e(Settings()->company_email); ?> <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(Settings()->company_phone): ?> &nbsp;|&nbsp; <?php echo e(Settings()->company_phone); ?> <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </div>
    <div>Sistema CEYE &mdash; Reporte automático</div>
</div>

</body>
</html>
<?php /**PATH /var/www/html/Modules/Reports/Resources/views/reception/print-optimized.blade.php ENDPATH**/ ?>