<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro Instrumental.... – <?php echo e($reception->reference); ?></title>
    <style>
        @page { size: A5; margin: 10mm 10mm 10mm 15mm; }

        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: Arial, sans-serif;
            font-size: 6.5pt;
            color: #1a1a2e;
            line-height: 1.2;
            background: #fff;
        }

        .page {
            width: 123mm;
            padding: 8mm 0;
            margin: 0 auto;
            background: #fff;
            overflow: hidden;
        }

        @media print {
            .page { width: 100%; padding: 0; margin: 0; }
            .no-print { display: none !important; }
        }

        .avoid-break { page-break-inside: avoid; }
        .mb { margin-bottom: 1.5mm; }

        /* HEADER */
        table { width: 100%; border-collapse: collapse; }
        .tbl-header { border: 1.5px solid #1a1a2e; border-radius: 3px; }
        .tbl-header td { border: none; vertical-align: middle; }

        .hdr-logo { width: 20mm; text-align: center; padding: 1.5mm; background: #f4f6fb; border-right: 1.5px solid #1a1a2e !important; }
        .hdr-logo img { max-width: 18mm; max-height: 14mm; object-fit: contain; }
        .hdr-title { text-align: center; padding: 1.5mm 2mm; border-right: 1.5px solid #1a1a2e !important; }
        .hdr-title h1 { font-size: 8pt; font-weight: 700; text-transform: uppercase; color: #1a1a2e; line-height: 1.25; }
        .hdr-meta { width: 27mm; padding: 0; vertical-align: top !important; background: #f4f6fb; }
        .meta-row { display: block; padding: 0.9mm 2mm; border-bottom: 1px solid #d0d5e0; }
        .meta-row:last-child { border-bottom: none; }
        .meta-label { display: block; font-size: 4.5pt; font-weight: 700; text-transform: uppercase; color: #999; letter-spacing: 0.3px; }
        .meta-value { display: block; font-size: 6.5pt; font-weight: 700; color: #1a1a2e; line-height: 1.2; }

        /* 3 COLUMNAS INFO */
        .tbl-info td { width: 33.33%; vertical-align: top; border: 1px solid #c8cdd8; padding: 0; }
        .tbl-info td:not(:last-child) { border-right: none; }
        .panel-hdr { display: block; background: #1a1a2e; color: #fff; padding: 0.9mm 2mm; font-size: 5.5pt; font-weight: 700; text-transform: uppercase; letter-spacing: 0.4px; text-align: center; }
        .panel-body { display: block; padding: 0.8mm 1.5mm; }
        .irow { display: block; padding: 0.4mm 0; border-bottom: 1px dotted #e0e4ed; }
        .irow:last-child { border-bottom: none; }
        .irow-lbl { display: block; font-size: 4.5pt; font-weight: 700; color: #999; text-transform: uppercase; line-height: 1.1; }
        .irow-val { display: block; font-size: 6pt; font-weight: 700; color: #1a1a2e; word-break: break-word; line-height: 1.2; }

        /* SECTION TITLE */
        .section-title { font-size: 6pt; font-weight: 700; text-transform: uppercase; letter-spacing: 0.4px; border-left: 2.5px solid #1a1a2e; padding-left: 2mm; margin-bottom: 1mm; }

        /* TABLA ITEMS */
        .tbl-items thead tr { background: #1a1a2e; }
        .tbl-items thead th { color: #fff; padding: 1mm 0.8mm; font-size: 5.5pt; font-weight: 700; text-align: center; text-transform: uppercase; border: none; vertical-align: middle; }
        .tbl-items tbody tr:nth-child(even) { background: #f2f4fa; }
        .tbl-items tbody tr:nth-child(odd)  { background: #fff; }
        .tbl-items tbody td { padding: 0.7mm 0.8mm; font-size: 6pt; text-align: center; vertical-align: middle; border-bottom: 1px solid #e5e7eb; border-left: none; border-right: none; border-top: none; }
        .tbl-items tbody td.desc { text-align: left; padding-left: 1.2mm; }
        .tbl-items tbody tr:last-child td { border-bottom: 1.5px solid #1a1a2e; }

        /* FIRMAS */
        .tbl-signs td { width: 50%; text-align: center; border: 1px solid #c8cdd8; padding: 1.2mm 4mm 1mm; vertical-align: top; }
        .tbl-signs td:first-child { border-right: none; }
        .sign-role  { font-size: 5pt; font-weight: 700; text-transform: uppercase; letter-spacing: 0.4px; color: #aaa; margin-bottom: 0.3mm; }
        .sign-name  { font-size: 7pt; font-weight: 700; color: #1a1a2e; margin-bottom: 0.5mm; }
        .sign-line  { height: 9mm; border-bottom: 1.2px solid #1a1a2e; margin: 0 5mm 0.6mm; }
        .sign-label { font-size: 4.5pt; color: #ccc; text-transform: uppercase; letter-spacing: 0.3px; }

        /* NOTAS */
        .notes-label      { font-size: 5pt; font-weight: 700; text-transform: uppercase; color: #888; letter-spacing: 0.4px; margin-bottom: 0.3mm; }
        .notes-disclaimer { font-size: 5pt; color: #777; font-style: italic; margin-bottom: 0.5mm; }
        .notes-text       { font-size: 6pt; color: #1a1a2e; background: #f4f6fb; border: 1px solid #d0d5e0; border-radius: 2px; padding: 0.7mm 1.5mm; }

        /* FOOTER */
        .doc-footer   { border-top: 1.5px solid #1a1a2e; padding-top: 1.5mm; text-align: center; }
        .footer-inner { display: inline-flex; align-items: center; gap: 2mm; }
        .footer-inner img { height: 5.5mm; object-fit: contain; }
        .footer-info  { font-size: 5.5pt; color: #555; line-height: 1.4; text-align: left; }
        .footer-info strong { font-size: 6pt; color: #1a1a2e; }
    </style>
</head>
<body>
<div class="page">

    
    <table class="tbl-header mb avoid-break">
        <tr>
            <td class="hdr-logo"><img src="<?php echo e($dataUrl); ?>" alt="Logo"></td>
            <td class="hdr-title"><h1>Registro Físico<br>Ingreso de Instrumental</h1></td>
            <td class="hdr-meta">
                <span class="meta-row">
                    <span class="meta-label">N.º Referencia</span>
                    <span class="meta-value"><?php echo e($reception->reference); ?></span>
                </span>
                <span class="meta-row">
                    <span class="meta-label">Fecha</span>
                    <span class="meta-value"><?php echo e(\Carbon\Carbon::parse($reception->created_up)->format('d M Y')); ?></span>
                </span>
                <span class="meta-row">
                    <span class="meta-label">Versión</span>
                    <span class="meta-value">01 – Sep 2024</span>
                </span>
            </td>
        </tr>
    </table>

    
    <table class="tbl-info mb avoid-break">
        <tr>
            <td>
                <span class="panel-hdr">Institución</span>
                <span class="panel-body">
                    <div class="irow"><span class="irow-lbl">Nombre</span><span class="irow-val"><?php echo e(Institutes()->institute_name); ?></span></div>
                    <div class="irow"><span class="irow-lbl">Área</span><span class="irow-val"><?php echo e(Institutes()->institute_area); ?></span></div>
                    <div class="irow"><span class="irow-lbl">Ciudad</span><span class="irow-val"><?php echo e(Institutes()->institute_city); ?></span></div>
                    <div class="irow"><span class="irow-lbl">Dirección</span><span class="irow-val"><?php echo e(Institutes()->institute_address); ?></span></div>
                </span>
            </td>
            <td>
                <span class="panel-hdr">Recepción</span>
                <span class="panel-body">
                    <div class="irow"><span class="irow-lbl">Entrega</span><span class="irow-val"><?php echo e($reception->delivery_staff); ?></span></div>
                    <div class="irow"><span class="irow-lbl">Área</span><span class="irow-val"><?php echo e($reception->area); ?></span></div>
                    <div class="irow"><span class="irow-lbl">Recibe</span><span class="irow-val"><?php echo e($reception->operator); ?></span></div>
                    <div class="irow"><span class="irow-lbl">Estado</span><span class="irow-val"><?php echo e($reception->status); ?></span></div>
                </span>
            </td>
            <td>
                <span class="panel-hdr">Registro</span>
                <span class="panel-body">
                    <div class="irow"><span class="irow-lbl">Número</span><span class="irow-val"><?php echo e($reception->reference); ?></span></div>
                    <div class="irow"><span class="irow-lbl">Fecha</span><span class="irow-val"><?php echo e(\Carbon\Carbon::parse($reception->created_up)->format('d M Y')); ?></span></div>
                    <div class="irow"><span class="irow-lbl">Actualizado</span><span class="irow-val"><?php echo e($reception->updated_at->format('d M Y H:i')); ?></span></div>
                    <div class="irow"><span class="irow-lbl">País</span><span class="irow-val"><?php echo e(Institutes()->institute_country); ?></span></div>
                </span>
            </td>
        </tr>
    </table>

    
    <p class="section-title mb">Detalle de Instrumental</p>
    <table class="tbl-items mb">
        <thead>
            <tr>
                <th style="width:9%">Código</th>
                <th style="width:26%">Descripción</th>
                <th style="width:6%">Cant.</th>
                <th style="width:12%">N. Infección</th>
                <th style="width:14%">T. Proceso</th>
                <th style="width:10%">Estado</th>
                <th style="width:12%">Paciente</th>
                <th style="width:11%">C. Comer.</th>
            </tr>
        </thead>
        <tbody>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $reception->receptionDetails; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($item->product_code); ?></td>
                    <td class="desc"><?php echo e($item->product_name); ?></td>
                    <td><?php echo e($item->product_quantity); ?></td>
                    <td><?php echo e($item->product_type_dirt); ?></td>
                    <td><?php echo e($item->product_type_process); ?></td>
                    <td><?php echo e($item->product_state_rumed); ?></td>
                    <td><?php echo e($item->product_patient ?? '—'); ?></td>
                    <td><?php echo e($item->product_outside_company ?? '—'); ?></td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </tbody>
    </table>

    
    <table class="tbl-signs mb avoid-break">
        <tr>
            <td>
                <div class="sign-role">Entrega</div>
                <div class="sign-name"><?php echo e($reception->delivery_staff); ?></div>
                <div class="sign-line"></div>
                <div class="sign-label">Firma y sello</div>
            </td>
            <td>
                <div class="sign-role">Recibe</div>
                <div class="sign-name"><?php echo e($reception->operator); ?></div>
                <div class="sign-line"></div>
                <div class="sign-label">Firma y sello</div>
            </td>
        </tr>
    </table>

    
    <div class="mb avoid-break">
        <div class="notes-label">Observaciones</div>
        <div class="notes-disclaimer">Verificar que los instrumentos sean correctos antes de firmar.</div>
        <div class="notes-text"><?php echo e(!empty($reception->note) ? $reception->note : 'Sin observaciones.'); ?></div>
    </div>

    
    <div class="doc-footer avoid-break">
        <div class="footer-inner">
            <img src="<?php echo e($dataUrlogo); ?>" alt="Logo empresa">
            <div class="footer-info">
                <strong><?php echo e(Settings()->company_name); ?></strong>
                &nbsp;·&nbsp;<?php echo e(Settings()->company_email); ?>

                &nbsp;·&nbsp;<?php echo e(Settings()->company_phone); ?>

            </div>
        </div>
    </div>

</div>
</body>
</html>
<?php /**PATH /var/www/html/Modules/Reception/Resources/views/receptions/print.blade.php ENDPATH**/ ?>