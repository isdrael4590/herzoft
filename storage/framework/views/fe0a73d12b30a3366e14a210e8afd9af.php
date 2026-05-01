<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Productos por Zonas - <?php echo e($stats['total_records']); ?> registros</title>
    <style>
        body {
            font-family: 'DejaVu Sans', Arial, sans-serif;
            font-size: <?php echo e($stats['total_records'] > 5000 ? '10px' : '12px'); ?>;
            margin: 0;
            padding: <?php echo e($stats['total_records'] > 10000 ? '10px' : '20px'); ?>;
            color: #333;
        }

        .header {
            text-align: center;
            margin-bottom: <?php echo e($stats['total_records'] > 5000 ? '15px' : '30px'); ?>;
            border-bottom: 2px solid #333;
            padding-bottom: <?php echo e($stats['total_records'] > 5000 ? '10px' : '20px'); ?>;
        }

        .header img {
            max-height: <?php echo e($stats['total_records'] > 5000 ? '50px' : '80px'); ?>;
            margin-bottom: 5px;
        }

        .header h1 {
            margin: 5px 0;
            font-size: <?php echo e($stats['total_records'] > 5000 ? '14px' : '18px'); ?>;
            color: #333;
        }

        .header .institute-info {
            margin: 3px 0;
            font-size: <?php echo e($stats['total_records'] > 5000 ? '8px' : '10px'); ?>;
            color: #666;
        }

        .report-info {
            display: flex;
            justify-content: space-between;
            margin-bottom: <?php echo e($stats['total_records'] > 5000 ? '10px' : '20px'); ?>;
            padding: <?php echo e($stats['total_records'] > 5000 ? '5px' : '10px'); ?>;
            background-color: #f8f9fa;
            border-radius: 3px;
            font-size: <?php echo e($stats['total_records'] > 5000 ? '9px' : '11px'); ?>;
        }

        .summary {
            background-color: #e9ecef;
            padding: <?php echo e($stats['total_records'] > 5000 ? '8px' : '15px'); ?>;
            border-radius: 3px;
            margin-bottom: <?php echo e($stats['total_records'] > 5000 ? '10px' : '20px'); ?>;
        }

        .summary h3 {
            margin-top: 0;
            color: #495057;
            font-size: <?php echo e($stats['total_records'] > 5000 ? '11px' : '14px'); ?>;
        }

        .summary-grid {
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 5px;
        }

        .summary-item {
            text-align: center;
            min-width: 80px;
        }

        .summary-number {
            font-size: <?php echo e($stats['total_records'] > 5000 ? '14px' : '18px'); ?>;
            font-weight: bold;
            color: #007bff;
        }

        .summary-label {
            font-size: <?php echo e($stats['total_records'] > 5000 ? '7px' : '10px'); ?>;
            color: #6c757d;
            margin-top: 2px;
        }

        /* Sección de producto */
        .product-section {
            margin-bottom: <?php echo e($stats['total_records'] > 5000 ? '15px' : '25px'); ?>;
            page-break-inside: avoid;
        }

        .product-header {
            background-color: #343a40;
            color: white;
            padding: <?php echo e($stats['total_records'] > 5000 ? '6px 10px' : '10px 15px'); ?>;
            border-radius: 3px 3px 0 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: <?php echo e($stats['total_records'] > 5000 ? '9px' : '11px'); ?>;
        }

        .product-name {
            font-weight: bold;
        }

        .product-code {
            background-color: rgba(255,255,255,0.2);
            padding: <?php echo e($stats['total_records'] > 5000 ? '2px 6px' : '3px 8px'); ?>;
            border-radius: 2px;
            font-size: <?php echo e($stats['total_records'] > 5000 ? '8px' : '10px'); ?>;
        }

        .product-total {
            background-color: #007bff;
            padding: <?php echo e($stats['total_records'] > 5000 ? '2px 6px' : '4px 10px'); ?>;
            border-radius: 2px;
            font-weight: bold;
        }

        /* Tabla */
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: <?php echo e($stats['total_records'] > 5000 ? '10px' : '20px'); ?>;
        }

        .table th {
            background-color: #343a40;
            color: white;
            padding: <?php echo e($stats['total_records'] > 5000 ? '4px' : '8px'); ?>;
            text-align: center;
            font-weight: bold;
            font-size: <?php echo e($stats['total_records'] > 5000 ? '8px' : '10px'); ?>;
            border: 1px solid #dee2e6;
        }

        .table td {
            padding: <?php echo e($stats['total_records'] > 5000 ? '3px' : '6px'); ?>;
            text-align: center;
            font-size: <?php echo e($stats['total_records'] > 5000 ? '7px' : '9px'); ?>;
            border: 1px solid #dee2e6;
            vertical-align: middle;
        }

        .table tbody tr:nth-child(even) {
            background-color: #f8f9fa;
        }

        /* Badges */
        .badge {
            padding: <?php echo e($stats['total_records'] > 5000 ? '1px 3px' : '2px 6px'); ?>;
            border-radius: 2px;
            color: white;
            font-size: <?php echo e($stats['total_records'] > 5000 ? '6px' : '8px'); ?>;
            font-weight: bold;
            display: inline-block;
        }

        .badge-reception {
            background-color: #007bff;
        }

        .badge-process {
            background-color: #17a2b8;
        }

        .badge-discharge {
            background-color: #28a745;
        }

        .badge-other {
            background-color: #6c757d;
        }

        .badge-quantity {
            background-color: #ffc107;
            color: #333;
        }

        .reference {
            font-weight: bold;
            color: #495057;
        }

        .footer {
            margin-top: <?php echo e($stats['total_records'] > 5000 ? '15px' : '30px'); ?>;
            text-align: center;
            font-size: <?php echo e($stats['total_records'] > 5000 ? '8px' : '10px'); ?>;
            color: #666;
            border-top: 1px solid #dee2e6;
            padding-top: <?php echo e($stats['total_records'] > 5000 ? '5px' : '10px'); ?>;
        }

        .page-break {
            page-break-before: always;
        }

        /* Control de saltos de página */
        .header {
            page-break-after: avoid;
        }

        .report-info {
            page-break-after: avoid;
        }

        .summary {
            page-break-after: avoid;
        }

        .product-section {
            page-break-inside: avoid;
        }

        .product-header {
            page-break-after: avoid;
        }

        .table thead {
            display: table-header-group;
        }

        /* Solo permitir saltos en volúmenes muy grandes */
        <?php if($stats['total_records'] > 5000): ?>
            .table {
                page-break-inside: auto;
            }

            .table tbody tr {
                page-break-inside: avoid;
                page-break-after: auto;
            }
        <?php else: ?>
            .table {
                page-break-inside: avoid;
            }

            .table tbody tr {
                page-break-inside: avoid;
            }
        <?php endif; ?>

        /* Configuración de página según volumen */
        <?php if($stats['total_records'] > 10000): ?>
            @page {
                size: A4 landscape;
                margin: 8mm;
            }
        <?php elseif($stats['total_records'] > 1000): ?>
            @page {
                size: A4 portrait;
                margin: 12mm;
            }
        <?php else: ?>
            @page {
                size: A4 portrait;
                margin: 15mm;
            }
        <?php endif; ?>

        /* Anchos de columna para landscape */
        <?php if($stats['total_records'] > 10000): ?>
            .table th:nth-child(1), .table td:nth-child(1) { width: 10%; }
            .table th:nth-child(2), .table td:nth-child(2) { width: 12%; }
            .table th:nth-child(3), .table td:nth-child(3) { width: 20%; }
            .table th:nth-child(4), .table td:nth-child(4) { width: 8%; }
            .table th:nth-child(5), .table td:nth-child(5) { width: 50%; }
        <?php endif; ?>
    </style>
</head>
<body>
    <!-- Header -->
    <div class="header">
        <?php if(isset($dataUrl) && !empty($dataUrl)): ?>
            <img src="<?php echo e($dataUrl); ?>" alt="Instituto">
        <?php endif; ?>
        <?php if(isset($institute)): ?>
            <h1><?php echo e($institute['name'] ?? 'Hospital de Especialidades'); ?></h1>
            <div class="institute-info">
                <strong>Dirección:</strong> <?php echo e($institute['address'] ?? ''); ?> |
                <strong>Área:</strong> <?php echo e($institute['area'] ?? 'Central Esterilización'); ?> |
                <strong>Ciudad:</strong> <?php echo e($institute['city'] ?? ''); ?>

            </div>
        <?php endif; ?>
        <br>
        <h1>REPORTE DE PRODUCTOS POR ZONAS</h1>
    </div>

    <!-- Report Info -->
    <div class="report-info">
        <div>
            <strong>Reporte:</strong> Movimientos de Productos<br>
            <strong>Fecha Generado:</strong> <?php echo e($generated_at); ?>

        </div>
        <div style="text-align: left;">
            <strong>Registros:</strong> <?php echo e(number_format($stats['total_records'])); ?><br>
            <strong>Usuario:</strong> <?php echo e($generated_by); ?>

        </div>
        <div style="text-align: right;">
            <strong>Productos:</strong> <?php echo e($stats['unique_products']); ?><br>
            <strong>Cantidad Total:</strong> <?php echo e(number_format($stats['total_quantity'])); ?>

        </div>
    </div>

    <!-- Summary -->
    <?php if($stats['total_records'] > 100): ?>
        <div class="summary">
            <h3>Resumen Ejecutivo</h3>
            <div class="summary-grid">
                <div class="summary-item">
                    <div class="summary-number"><?php echo e(number_format($stats['total_records'])); ?></div>
                    <div class="summary-label">REGISTROS</div>
                </div>
                <div class="summary-item">
                    <div class="summary-number"><?php echo e(number_format($stats['total_quantity'])); ?></div>
                    <div class="summary-label">CANTIDAD TOTAL</div>
                </div>
                <div class="summary-item">
                    <div class="summary-number"><?php echo e($stats['unique_products']); ?></div>
                    <div class="summary-label">PRODUCTOS ÚNICOS</div>
                </div>
                <div class="summary-item">
                    <div class="summary-number"><?php echo e($stats['unique_zonas']); ?></div>
                    <div class="summary-label">ZONAS</div>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <!-- Contenido Principal -->
    <?php if($groupType === 'grouped' && !empty($data)): ?>
        <!-- Vista agrupada por producto -->
        <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $productIndex => $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="product-section">
                <!-- Header del Producto -->
                <div class="product-header">
                    <span class="product-name"><?php echo e($product['product_name']); ?></span>
                    <span class="product-code">Código: <?php echo e($product['product_code']); ?></span>
                    <span class="product-total">Total: <?php echo e(number_format($product['total_quantity'])); ?> unidades</span>
                </div>

                <!-- Tabla de movimientos -->
                <table class="table">
                    <thead>
                        <tr>
                            <th>Fecha</th>
                            <th>Referencia</th>
                            <th>Zona</th>
                            <th>Cantidad</th>
                            <th>Observaciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $sortedItems = collect($product['items'] ?? [])->sortBy('date');
                        ?>

                        <?php $__empty_1 = true; $__currentLoopData = $sortedItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $itemIndex => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td><?php echo e(\Carbon\Carbon::parse($item['date'])->format('d/m/y')); ?></td>
                                <td><span class="reference">#<?php echo e($item['reference']); ?></span></td>
                                <td>
                                    <?php
                                        $badgeClass = 'badge-other';
                                        $zonaLower = strtolower($item['zona'] ?? '');
                                        
                                        if (str_contains($zonaLower, 'reception') || str_contains($zonaLower, 'recepción')) {
                                            $badgeClass = 'badge-reception';
                                        } elseif (str_contains($zonaLower, 'process') || str_contains($zonaLower, 'etiquetado') || str_contains($zonaLower, 'label')) {
                                            $badgeClass = 'badge-process';
                                        } elseif (str_contains($zonaLower, 'discharge') || str_contains($zonaLower, 'descarga')) {
                                            $badgeClass = 'badge-discharge';
                                        }
                                    ?>
                                    <span class="badge <?php echo e($badgeClass); ?>">
                                        <?php echo e($item['zona_name']); ?>

                                    </span>
                                </td>
                                <td>
                                    <span class="badge badge-quantity"><?php echo e($item['quantity']); ?> u.</span>
                                </td>
                                <td style="text-align: left;">
                                    <?php if(isset($item['observations']) && !empty($item['observations'])): ?>
                                        <?php echo e($item['observations']); ?>

                                    <?php else: ?>
                                        <span style="color: #999;">-</span>
                                    <?php endif; ?>
                                </td>
                            </tr>

                            
                            <?php if($stats['total_records'] > 10000 && ($itemIndex + 1) % 50 == 0 && $itemIndex + 1 < count($sortedItems)): ?>
                                </tbody>
                            </table>
                            <div class="page-break"></div>
                            
                            <!-- Repetir header de producto -->
                            <div class="product-header">
                                <span class="product-name"><?php echo e($product['product_name']); ?> (continuación)</span>
                                <span class="product-code">Código: <?php echo e($product['product_code']); ?></span>
                                <span class="product-total">Total: <?php echo e(number_format($product['total_quantity'])); ?> unidades</span>
                            </div>
                            
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Fecha</th>
                                        <th>Referencia</th>
                                        <th>Zona</th>
                                        <th>Cantidad</th>
                                        <th>Observaciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="5" style="color: #999;">Sin movimientos registrados</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            
            <?php if($stats['total_records'] > 10000 && $productIndex + 1 < count($data)): ?>
                <div class="page-break"></div>
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    <?php elseif(!empty($data)): ?>
        <!-- Vista detallada sin agrupación -->
        <table class="table">
            <thead>
                <tr>
                    <th>Fecha</th>
                    <th>Producto</th>
                    <th>Código</th>
                    <th>Referencia</th>
                    <th>Zona</th>
                    <th>Cantidad</th>
                    <th>Observaciones</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e(\Carbon\Carbon::parse($item['date'])->format('d/m/y')); ?></td>
                        <td style="text-align: left;"><?php echo e($item['product_name']); ?></td>
                        <td><?php echo e($item['product_code']); ?></td>
                        <td><span class="reference">#<?php echo e($item['reference']); ?></span></td>
                        <td>
                            <?php
                                $badgeClass = 'badge-other';
                                $zonaLower = strtolower($item['zona'] ?? '');
                                
                                if (str_contains($zonaLower, 'reception') || str_contains($zonaLower, 'recepción')) {
                                    $badgeClass = 'badge-reception';
                                } elseif (str_contains($zonaLower, 'process') || str_contains($zonaLower, 'etiquetado') || str_contains($zonaLower, 'label')) {
                                    $badgeClass = 'badge-process';
                                } elseif (str_contains($zonaLower, 'discharge') || str_contains($zonaLower, 'descarga')) {
                                    $badgeClass = 'badge-discharge';
                                }
                            ?>
                            <span class="badge <?php echo e($badgeClass); ?>">
                                <?php echo e($item['zona_name']); ?>

                            </span>
                        </td>
                        <td>
                            <span class="badge badge-quantity"><?php echo e($item['quantity']); ?> u.</span>
                        </td>
                        <td style="text-align: left;">
                            <?php echo e($item['observations'] ?? '-'); ?>

                        </td>
                    </tr>

                    
                    <?php if($stats['total_records'] > 10000 && ($index + 1) % 50 == 0 && $index + 1 < count($data)): ?>
                        </tbody>
                    </table>
                    <div class="page-break"></div>
                    
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Fecha</th>
                                <th>Producto</th>
                                <th>Código</th>
                                <th>Referencia</th>
                                <th>Zona</th>
                                <th>Cantidad</th>
                                <th>Observaciones</th>
                            </tr>
                        </thead>
                        <tbody>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    <?php else: ?>
        <div style="text-align: center; padding: 40px; color: #999;">
            No hay datos disponibles para mostrar
        </div>
    <?php endif; ?>

    <!-- Footer -->
    <div class="footer">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 5px;">
            <div>
                <?php if(isset($dataUrlogo) && !empty($dataUrlogo)): ?>
                    <img src="<?php echo e($dataUrlogo); ?>" alt="Logo" style="height: 40px;">
                <?php endif; ?>
            </div>
            <div style="text-align: center; flex-grow: 1;">
                <?php echo e(Settings()->company_name ?? 'Sistema de Gestión'); ?> -
                <?php echo e(Settings()->company_email ?? ''); ?> -
                <?php echo e(Settings()->company_phone ?? ''); ?>

            </div>
        </div>

        <div style="font-size: <?php echo e($stats['total_records'] > 5000 ? '6px' : '8px'); ?>; color: #999; text-align: center;">
            Sistema de Gestión de centrales de esterilización CEYE - Reporte automático
            <?php if($stats['total_records'] > 10000): ?>
                <br><em>Formato optimizado para gran volumen de datos</em>
            <?php endif; ?>
        </div>
    </div>
</body>
</html><?php /**PATH /var/www/html/Modules/Reports/Resources/views/product/products-zona-print.blade.php ENDPATH**/ ?>