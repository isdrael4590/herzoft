<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Productos por Zonas - {{ $stats['total_records'] }} registros</title>
    <style>
        body {
            font-family: 'DejaVu Sans', Arial, sans-serif;
            font-size: {{ $stats['total_records'] > 5000 ? '10px' : '12px' }};
            margin: 0;
            padding: {{ $stats['total_records'] > 10000 ? '10px' : '20px' }};
            color: #333;
        }

        .header {
            text-align: center;
            margin-bottom: {{ $stats['total_records'] > 5000 ? '15px' : '30px' }};
            border-bottom: 2px solid #333;
            padding-bottom: {{ $stats['total_records'] > 5000 ? '10px' : '20px' }};
        }

        .header img {
            max-height: {{ $stats['total_records'] > 5000 ? '50px' : '80px' }};
            margin-bottom: 5px;
        }

        .header h1 {
            margin: 5px 0;
            font-size: {{ $stats['total_records'] > 5000 ? '14px' : '18px' }};
            color: #333;
        }

        .header .institute-info {
            margin: 3px 0;
            font-size: {{ $stats['total_records'] > 5000 ? '8px' : '10px' }};
            color: #666;
        }

        .report-info {
            display: flex;
            justify-content: space-between;
            margin-bottom: {{ $stats['total_records'] > 5000 ? '10px' : '20px' }};
            padding: {{ $stats['total_records'] > 5000 ? '5px' : '10px' }};
            background-color: #f8f9fa;
            border-radius: 3px;
            font-size: {{ $stats['total_records'] > 5000 ? '9px' : '11px' }};
        }

        .summary {
            background-color: #e9ecef;
            padding: {{ $stats['total_records'] > 5000 ? '8px' : '15px' }};
            border-radius: 3px;
            margin-bottom: {{ $stats['total_records'] > 5000 ? '10px' : '20px' }};
        }

        .summary h3 {
            margin-top: 0;
            color: #495057;
            font-size: {{ $stats['total_records'] > 5000 ? '11px' : '14px' }};
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
            font-size: {{ $stats['total_records'] > 5000 ? '14px' : '18px' }};
            font-weight: bold;
            color: #007bff;
        }

        .summary-label {
            font-size: {{ $stats['total_records'] > 5000 ? '7px' : '10px' }};
            color: #6c757d;
            margin-top: 2px;
        }

        /* Sección de producto */
        .product-section {
            margin-bottom: {{ $stats['total_records'] > 5000 ? '15px' : '25px' }};
            page-break-inside: avoid;
        }

        .product-header {
            background-color: #343a40;
            color: white;
            padding: {{ $stats['total_records'] > 5000 ? '6px 10px' : '10px 15px' }};
            border-radius: 3px 3px 0 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: {{ $stats['total_records'] > 5000 ? '9px' : '11px' }};
        }

        .product-name {
            font-weight: bold;
        }

        .product-code {
            background-color: rgba(255,255,255,0.2);
            padding: {{ $stats['total_records'] > 5000 ? '2px 6px' : '3px 8px' }};
            border-radius: 2px;
            font-size: {{ $stats['total_records'] > 5000 ? '8px' : '10px' }};
        }

        .product-total {
            background-color: #007bff;
            padding: {{ $stats['total_records'] > 5000 ? '2px 6px' : '4px 10px' }};
            border-radius: 2px;
            font-weight: bold;
        }

        /* Tabla */
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: {{ $stats['total_records'] > 5000 ? '10px' : '20px' }};
        }

        .table th {
            background-color: #343a40;
            color: white;
            padding: {{ $stats['total_records'] > 5000 ? '4px' : '8px' }};
            text-align: center;
            font-weight: bold;
            font-size: {{ $stats['total_records'] > 5000 ? '8px' : '10px' }};
            border: 1px solid #dee2e6;
        }

        .table td {
            padding: {{ $stats['total_records'] > 5000 ? '3px' : '6px' }};
            text-align: center;
            font-size: {{ $stats['total_records'] > 5000 ? '7px' : '9px' }};
            border: 1px solid #dee2e6;
            vertical-align: middle;
        }

        .table tbody tr:nth-child(even) {
            background-color: #f8f9fa;
        }

        /* Badges */
        .badge {
            padding: {{ $stats['total_records'] > 5000 ? '1px 3px' : '2px 6px' }};
            border-radius: 2px;
            color: white;
            font-size: {{ $stats['total_records'] > 5000 ? '6px' : '8px' }};
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
            margin-top: {{ $stats['total_records'] > 5000 ? '15px' : '30px' }};
            text-align: center;
            font-size: {{ $stats['total_records'] > 5000 ? '8px' : '10px' }};
            color: #666;
            border-top: 1px solid #dee2e6;
            padding-top: {{ $stats['total_records'] > 5000 ? '5px' : '10px' }};
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
        @if ($stats['total_records'] > 5000)
            .table {
                page-break-inside: auto;
            }

            .table tbody tr {
                page-break-inside: avoid;
                page-break-after: auto;
            }
        @else
            .table {
                page-break-inside: avoid;
            }

            .table tbody tr {
                page-break-inside: avoid;
            }
        @endif

        /* Configuración de página según volumen */
        @if ($stats['total_records'] > 10000)
            @page {
                size: A4 landscape;
                margin: 8mm;
            }
        @elseif ($stats['total_records'] > 1000)
            @page {
                size: A4 portrait;
                margin: 12mm;
            }
        @else
            @page {
                size: A4 portrait;
                margin: 15mm;
            }
        @endif

        /* Anchos de columna para landscape */
        @if ($stats['total_records'] > 10000)
            .table th:nth-child(1), .table td:nth-child(1) { width: 10%; }
            .table th:nth-child(2), .table td:nth-child(2) { width: 12%; }
            .table th:nth-child(3), .table td:nth-child(3) { width: 20%; }
            .table th:nth-child(4), .table td:nth-child(4) { width: 8%; }
            .table th:nth-child(5), .table td:nth-child(5) { width: 50%; }
        @endif
    </style>
</head>
<body>
    <!-- Header -->
    <div class="header">
        @if(isset($dataUrl) && !empty($dataUrl))
            <img src="{{ $dataUrl }}" alt="Instituto">
        @endif
        @if(isset($institute))
            <h1>{{ $institute['name'] ?? 'Hospital de Especialidades' }}</h1>
            <div class="institute-info">
                <strong>Dirección:</strong> {{ $institute['address'] ?? '' }} |
                <strong>Área:</strong> {{ $institute['area'] ?? 'Central Esterilización' }} |
                <strong>Ciudad:</strong> {{ $institute['city'] ?? '' }}
            </div>
        @endif
        <br>
        <h1>REPORTE DE PRODUCTOS POR ZONAS</h1>
    </div>

    <!-- Report Info -->
    <div class="report-info">
        <div>
            <strong>Reporte:</strong> Movimientos de Productos<br>
            <strong>Fecha Generado:</strong> {{ $generated_at }}
        </div>
        <div style="text-align: left;">
            <strong>Registros:</strong> {{ number_format($stats['total_records']) }}<br>
            <strong>Usuario:</strong> {{ $generated_by }}
        </div>
        <div style="text-align: right;">
            <strong>Productos:</strong> {{ $stats['unique_products'] }}<br>
            <strong>Cantidad Total:</strong> {{ number_format($stats['total_quantity']) }}
        </div>
    </div>

    <!-- Summary -->
    @if($stats['total_records'] > 100)
        <div class="summary">
            <h3>Resumen Ejecutivo</h3>
            <div class="summary-grid">
                <div class="summary-item">
                    <div class="summary-number">{{ number_format($stats['total_records']) }}</div>
                    <div class="summary-label">REGISTROS</div>
                </div>
                <div class="summary-item">
                    <div class="summary-number">{{ number_format($stats['total_quantity']) }}</div>
                    <div class="summary-label">CANTIDAD TOTAL</div>
                </div>
                <div class="summary-item">
                    <div class="summary-number">{{ $stats['unique_products'] }}</div>
                    <div class="summary-label">PRODUCTOS ÚNICOS</div>
                </div>
                <div class="summary-item">
                    <div class="summary-number">{{ $stats['unique_zonas'] }}</div>
                    <div class="summary-label">ZONAS</div>
                </div>
            </div>
        </div>
    @endif

    <!-- Contenido Principal -->
    @if($groupType === 'grouped' && !empty($data))
        <!-- Vista agrupada por producto -->
        @foreach($data as $productIndex => $product)
            <div class="product-section">
                <!-- Header del Producto -->
                <div class="product-header">
                    <span class="product-name">{{ $product['product_name'] }}</span>
                    <span class="product-code">Código: {{ $product['product_code'] }}</span>
                    <span class="product-total">Total: {{ number_format($product['total_quantity']) }} unidades</span>
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
                        @php
                            $sortedItems = collect($product['items'] ?? [])->sortBy('date');
                        @endphp

                        @forelse($sortedItems as $itemIndex => $item)
                            <tr>
                                <td>{{ \Carbon\Carbon::parse($item['date'])->format('d/m/y') }}</td>
                                <td><span class="reference">#{{ $item['reference'] }}</span></td>
                                <td>
                                    @php
                                        $badgeClass = 'badge-other';
                                        $zonaLower = strtolower($item['zona'] ?? '');
                                        
                                        if (str_contains($zonaLower, 'reception') || str_contains($zonaLower, 'recepción')) {
                                            $badgeClass = 'badge-reception';
                                        } elseif (str_contains($zonaLower, 'process') || str_contains($zonaLower, 'etiquetado') || str_contains($zonaLower, 'label')) {
                                            $badgeClass = 'badge-process';
                                        } elseif (str_contains($zonaLower, 'discharge') || str_contains($zonaLower, 'descarga')) {
                                            $badgeClass = 'badge-discharge';
                                        }
                                    @endphp
                                    <span class="badge {{ $badgeClass }}">
                                        {{ $item['zona_name'] }}
                                    </span>
                                </td>
                                <td>
                                    <span class="badge badge-quantity">{{ $item['quantity'] }} u.</span>
                                </td>
                                <td style="text-align: left;">
                                    @if(isset($item['observations']) && !empty($item['observations']))
                                        {{ $item['observations'] }}
                                    @else
                                        <span style="color: #999;">-</span>
                                    @endif
                                </td>
                            </tr>

                            {{-- Page breaks solo para volúmenes MUY grandes --}}
                            @if($stats['total_records'] > 10000 && ($itemIndex + 1) % 50 == 0 && $itemIndex + 1 < count($sortedItems))
                                </tbody>
                            </table>
                            <div class="page-break"></div>
                            
                            <!-- Repetir header de producto -->
                            <div class="product-header">
                                <span class="product-name">{{ $product['product_name'] }} (continuación)</span>
                                <span class="product-code">Código: {{ $product['product_code'] }}</span>
                                <span class="product-total">Total: {{ number_format($product['total_quantity']) }} unidades</span>
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
                            @endif
                        @empty
                            <tr>
                                <td colspan="5" style="color: #999;">Sin movimientos registrados</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Page break entre productos solo para volúmenes MUY grandes --}}
            @if($stats['total_records'] > 10000 && $productIndex + 1 < count($data))
                <div class="page-break"></div>
            @endif
        @endforeach

    @elseif(!empty($data))
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
                @foreach($data as $index => $item)
                    <tr>
                        <td>{{ \Carbon\Carbon::parse($item['date'])->format('d/m/y') }}</td>
                        <td style="text-align: left;">{{ $item['product_name'] }}</td>
                        <td>{{ $item['product_code'] }}</td>
                        <td><span class="reference">#{{ $item['reference'] }}</span></td>
                        <td>
                            @php
                                $badgeClass = 'badge-other';
                                $zonaLower = strtolower($item['zona'] ?? '');
                                
                                if (str_contains($zonaLower, 'reception') || str_contains($zonaLower, 'recepción')) {
                                    $badgeClass = 'badge-reception';
                                } elseif (str_contains($zonaLower, 'process') || str_contains($zonaLower, 'etiquetado') || str_contains($zonaLower, 'label')) {
                                    $badgeClass = 'badge-process';
                                } elseif (str_contains($zonaLower, 'discharge') || str_contains($zonaLower, 'descarga')) {
                                    $badgeClass = 'badge-discharge';
                                }
                            @endphp
                            <span class="badge {{ $badgeClass }}">
                                {{ $item['zona_name'] }}
                            </span>
                        </td>
                        <td>
                            <span class="badge badge-quantity">{{ $item['quantity'] }} u.</span>
                        </td>
                        <td style="text-align: left;">
                            {{ $item['observations'] ?? '-' }}
                        </td>
                    </tr>

                    {{-- Page breaks solo para volúmenes MUY grandes --}}
                    @if($stats['total_records'] > 10000 && ($index + 1) % 50 == 0 && $index + 1 < count($data))
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
                    @endif
                @endforeach
            </tbody>
        </table>
    @else
        <div style="text-align: center; padding: 40px; color: #999;">
            No hay datos disponibles para mostrar
        </div>
    @endif

    <!-- Footer -->
    <div class="footer">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 5px;">
            <div>
                @if(isset($dataUrlogo) && !empty($dataUrlogo))
                    <img src="{{ $dataUrlogo }}" alt="Logo" style="height: 40px;">
                @endif
            </div>
            <div style="text-align: center; flex-grow: 1;">
                {{ Settings()->company_name ?? 'Sistema de Gestión' }} -
                {{ Settings()->company_email ?? '' }} -
                {{ Settings()->company_phone ?? '' }}
            </div>
        </div>

        <div style="font-size: {{ $stats['total_records'] > 5000 ? '6px' : '8px' }}; color: #999; text-align: center;">
            Sistema de Gestión de centrales de esterilización CEYE - Reporte automático
            @if($stats['total_records'] > 10000)
                <br><em>Formato optimizado para gran volumen de datos</em>
            @endif
        </div>
    </div>
</body>
</html>