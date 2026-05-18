<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Descargas - {{ $selected_count }} registros</title>
    <style>
        body {
            font-family: 'DejaVu Sans', Arial, sans-serif;
            font-size: {{ $selected_count > 5000 ? '10px' : '12px' }};
            margin: 0;
            padding: {{ $selected_count > 10000 ? '10px' : '20px' }};
            color: #333;
        }

        .header {
            text-align: center;
            margin-bottom: {{ $selected_count > 5000 ? '15px' : '30px' }};
            border-bottom: 2px solid #333;
            padding-bottom: {{ $selected_count > 5000 ? '10px' : '20px' }};
        }

        .header img {
            max-height: {{ $selected_count > 5000 ? '50px' : '80px' }};
            margin-bottom: 5px;
        }

        .header h1 {
            margin: 5px 0;
            font-size: {{ $selected_count > 5000 ? '14px' : '18px' }};
            color: #333;
        }

        .header .institute-info {
            margin: 3px 0;
            font-size: {{ $selected_count > 5000 ? '8px' : '10px' }};
            color: #666;
        }

        .report-info {
            display: flex;
            justify-content: space-between;
            margin-bottom: {{ $selected_count > 5000 ? '10px' : '20px' }};
            padding: {{ $selected_count > 5000 ? '5px' : '10px' }};
            background-color: #f8f9fa;
            border-radius: 3px;
            font-size: {{ $selected_count > 5000 ? '9px' : '11px' }};
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: {{ $selected_count > 5000 ? '10px' : '20px' }};
        }

        .table th {
            background-color: #343a40;
            color: white;
            padding: {{ $selected_count > 5000 ? '4px' : '8px' }};
            text-align: center;
            font-weight: bold;
            font-size: {{ $selected_count > 5000 ? '8px' : '10px' }};
            border: 1px solid #dee2e6;
        }

        .table td {
            padding: {{ $selected_count > 5000 ? '3px' : '6px' }};
            text-align: center;
            font-size: {{ $selected_count > 5000 ? '7px' : '9px' }};
            border: 1px solid #dee2e6;
            vertical-align: top;
            height: auto;
        }

        .table tbody tr:nth-child(even) {
            background-color: #f8f9fa;
        }

        .status-badge {
            padding: {{ $selected_count > 5000 ? '1px 3px' : '2px 6px' }};
            border-radius: 2px;
            color: white;
            font-size: {{ $selected_count > 5000 ? '6px' : '8px' }};
            font-weight: bold;
        }

        .status-aprobado {
            background-color: #28a745;
        }

        .status-rechazado {
            background-color: #dc3545;
        }

        .status-pendiente {
            background-color: #ffc107;
            color: #333;
        }

        .status-procesado {
            background-color: #17a2b8;
        }

        .validation-badge {
            padding: {{ $selected_count > 5000 ? '1px 3px' : '2px 6px' }};
            border-radius: 2px;
            font-size: {{ $selected_count > 5000 ? '6px' : '8px' }};
            font-weight: bold;
        }

        .validation-positivo {
            background-color: #28a745;
            color: white;
        }

        .validation-negativo {
            background-color: #dc3545;
            color: white;
        }

        .validation-pendiente {
            background-color: #ffc107;
            color: #333;
        }

        .packages-badge {
            background-color: #007bff;
            color: white;
            padding: {{ $selected_count > 5000 ? '1px 3px' : '2px 6px' }};
            border-radius: 2px;
            font-size: {{ $selected_count > 5000 ? '6px' : '8px' }};
            font-weight: bold;
        }

        /* Estilos para productos */
        .products-cell {
            text-align: left;
            max-width: {{ $selected_count > 10000 ? '180px' : ($selected_count > 5000 ? '220px' : '300px') }};
            word-wrap: break-word;
            overflow-wrap: break-word;
            hyphens: auto;
            line-height: 1.3;
        }

        .product-item {
            display: inline-block;
            background-color: #e9ecef;
            color: #495057;
            padding: {{ $selected_count > 5000 ? '2px 4px' : '3px 6px' }};
            margin: {{ $selected_count > 5000 ? '1px' : '2px' }};
            border-radius: 3px;
            font-size: {{ $selected_count > 5000 ? '6px' : '8px' }};
            line-height: 1.2;
            max-width: 100%;
            word-break: break-word;
        }

        .summary {
            background-color: #e9ecef;
            padding: {{ $selected_count > 5000 ? '8px' : '15px' }};
            border-radius: 3px;
            margin-bottom: {{ $selected_count > 5000 ? '10px' : '20px' }};
        }

        .summary h3 {
            margin-top: 0;
            color: #495057;
            font-size: {{ $selected_count > 5000 ? '11px' : '14px' }};
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
            font-size: {{ $selected_count > 5000 ? '14px' : '18px' }};
            font-weight: bold;
            color: #007bff;
        }

        .summary-label {
            font-size: {{ $selected_count > 5000 ? '7px' : '10px' }};
            color: #6c757d;
            margin-top: 2px;
        }

        .footer {
            margin-top: {{ $selected_count > 5000 ? '15px' : '30px' }};
            text-align: center;
            font-size: {{ $selected_count > 5000 ? '8px' : '10px' }};
            color: #666;
            border-top: 1px solid #dee2e6;
            padding-top: {{ $selected_count > 5000 ? '5px' : '10px' }};
        }

        .page-break {
            page-break-before: always;
        }

        /* Controlar saltos de página */
        .table {
            page-break-inside: auto;
        }

        .table thead {
            display: table-header-group;
        }

        .table tbody tr {
            page-break-inside: avoid;
            page-break-after: auto;
        }

        .header {
            page-break-after: avoid;
        }

        .report-info {
            page-break-after: avoid;
        }

        .summary {
            page-break-after: avoid;
        }

        /* Para tablas grandes, permitir división */
        @if ($selected_count > 1000)
            .table tbody tr {
                page-break-inside: auto;
            }
        @endif

        /* Estilos específicos para volúmenes muy grandes */
        @media print {
            @if ($selected_count > 10000)
                .table th,
                .table td {
                    padding: 2px !important;
                    font-size: 6px !important;
                }

                .header {
                    margin-bottom: 10px !important;
                }

                .summary {
                    padding: 5px !important;
                    margin-bottom: 5px !important;
                }

                .products-cell {
                    max-width: 100px !important;
                }

                .product-item {
                    font-size: 4px !important;
                    padding: 1px !important;
                    margin: 1px !important;
                }
            @endif
        }

        /* Configuración de página según volumen */
        @if ($selected_count > 10000)
            @page {
                size: A4 landscape;
                margin: 8mm;
            }
        @elseif ($selected_count > 1000)
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

        /* Ajustes específicos para landscape en descargas */
        @if ($selected_count > 10000)
            .table th:first-child,
            .table td:first-child {
                width: 6%;
            }

            .table th:nth-child(2),
            .table td:nth-child(2) {
                width: 8%;
            }

            .table th:nth-child(3),
            .table td:nth-child(3) {
                width: 12%;
            }

            .table th:nth-child(4),
            .table td:nth-child(4) {
                width: 8%;
            }

            .table th:nth-child(5),
            .table td:nth-child(5) {
                width: 8%;
            }

            .table th:nth-child(6),
            .table td:nth-child(6) {
                width: 8%;
            }

            .table th:nth-child(7),
            .table td:nth-child(7) {
                width: 6%;
            }

            /* Columna de productos */
            .table th:nth-child(8),
            .table td:nth-child(8) {
                width: 44%;
            }
        @endif
    </style>
</head>

<body>
    <!-- Header -->
    <div class="header">
        @if ($dataUrl)
            <img src="{{ $dataUrl }}" alt="Instituto">
        @endif
        @if ($institute)
            <h1>{{ $institute->institute_name ?? 'Hospital de Especialidades FF.AA N°1' }}</h1>
            <div class="institute-info">
                <strong>Dirección:</strong> {{ $institute->address ?? 'Av. Gran Colombia &, Quito 170136' }} |
                <strong>Área:</strong> {{ $institute->area ?? 'Central Esterilización' }} |
                <strong>Ciudad:</strong> {{ $institute->city ?? 'Quito' }}
            </div>
        @endif
        <BR>
        <h1>REPORTE MENSUAL DE DESCARGAS</h1>
    </div>

    <!-- Report Info -->
    <div class="report-info">
        <div>
            <strong>Reporte:</strong> Físico de Descargas en esterilización<br>
            <strong>Fecha Generado:</strong> {{ $print_date }}
        </div>

        <div style="text-align: left;">
            <strong>Registros:</strong> {{ number_format($selected_count) }}<br>
            <strong>Paquetes:</strong> {{ number_format($total_packages) }}
        </div>
        <div style="text-align: right;">
            <strong>Versión:</strong> 02<br>
            <strong>Vigente:</strong> {{ now()->format('F Y') }}
        </div>
    </div>

    <!-- Summary for large volumes -->
    @if ($selected_count > 1000)
        <div class="summary">
            <h3>Resumen Ejecutivo</h3>
            <div class="summary-grid">
                <div class="summary-item">
                    <div class="summary-number">{{ number_format($selected_count) }}</div>
                    <div class="summary-label">REGISTROS</div>
                </div>
                <div class="summary-item">
                    <div class="summary-number">{{ number_format($total_packages) }}</div>
                    <div class="summary-label">PAQUETES</div>
                </div>
                @if (isset($status_stats))
                    @foreach ($status_stats->take(3) as $status => $count)
                        <div class="summary-item">
                            <div class="summary-number">{{ $count }}</div>
                            <div class="summary-label">{{ strtoupper($status) }}</div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    @endif

    <!-- Data Table -->
    <table class="table">
        <thead>
            <tr>
                <th>Fecha</th>
                <th>Referencia</th>
                <th>Equipo</th>
                <th>Lote Equipo</th>
                <th>Valid. Proceso</th>
                <th>Valid. Biológico</th>
                <th>Cant. Paq</th>
                <!-- Nueva columna: Productos -->
                <th>Paquetes</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($discharges as $index => $discharge)
                <tr>
                    <td>{{ \Carbon\Carbon::parse($discharge->updated_at)->format('d/m/y') }}</td>
                    <td><strong>{{ $discharge->reference }}</strong></td>
                    <td>{{ Str::limit($discharge->machine_name, 15) }}</td>
                    <td>{{ Str::limit($discharge->lote_machine, 12) }}</td>
                    <td>
                        <span class="status-badge status-{{ strtolower($discharge->status_cycle) }}">
                            {{ substr($discharge->status_cycle, 0, 3) }}
                        </span>
                    </td>
                    <td>
                        <span class="validation-badge validation-{{ strtolower($discharge->validation_biologic) }}">
                            {{ substr($discharge->validation_biologic, 0, 3) }}
                        </span>
                    </td>
                    <td>
                        <span class="packages-badge">
                            {{ $discharge->dischargeDetails->count() }}
                        </span>
                    </td>
                    <!-- Nueva celda: Mostrar productos -->
                    <td class="products-cell">
                        @if ($discharge->dischargeDetails->count() > 0)
                            @php
                                $productNames = $discharge->dischargeDetails->pluck('product_name')->filter()->unique();
                            @endphp
                            @if ($productNames->count() > 0)
                                @foreach ($productNames as $productName)
                                    <span class="product-item">{{ $productName }}</span>
                                @endforeach
                            @else
                                <span style="font-size: {{ $selected_count > 5000 ? '5px' : '7px' }}; color: #999;">Sin productos</span>
                            @endif
                        @else
                            <span style="font-size: {{ $selected_count > 5000 ? '5px' : '7px' }}; color: #999;">-</span>
                        @endif
                    </td>
                </tr>

                {{-- Page break every 50 rows for large volumes --}}
                @if ($selected_count > 5000 && ($index + 1) % 40 == 0 && $index + 1 < $discharges->count())
        </tbody>
    </table>
    <div class="page-break"></div>
    
    <!-- Repetir header en nueva página -->
    <table class="table">
        <thead>
            <tr>
                <th>Fecha</th>
                <th>Referencia</th>
                <th>Equipo</th>
                <th>Lote Equipo</th>
                <th>Valid. Proceso</th>
                <th>Valid. Biológico</th>
                <th>Paquetes</th>
                <th>Productos</th>
            </tr>
        </thead>
        <tbody>
            {{-- Page break every 20 rows for normal volumes --}}
        @elseif($selected_count <= 5000 && ($index + 1) % 20 == 0 && $index + 1 < $discharges->count())
        </tbody>
    </table>
    <div class="page-break"></div>
    
    <!-- Repetir header en nueva página -->
    <table class="table">
        <thead>
            <tr>
                <th>Fecha</th>
                <th>Referencia</th>
                <th>Equipo</th>
                <th>Lote Equipo</th>
                <th>Valid. Proceso</th>
                <th>Valid. Biológico</th>
                <th>Paquetes</th>
                <th>Productos</th>
            </tr>
        </thead>
        <tbody>
            @endif
            @endforeach
        </tbody>
    </table>

    <!-- Footer -->
    <div class="footer">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 5px;">
            <div>
                @if ($dataUrlogo)
                    <img src="{{ $dataUrlogo }}" alt="Logo" style="height: 40px;">
                @endif
            </div>
            <div style="text-align: center; flex-grow: 1;">
                {{ Settings()->company_name }} -
                {{ Settings()->company_email }} -
                {{ Settings()->company_phone }}
            </div>
        </div>

        <div style="font-size: {{ $selected_count > 5000 ? '6px' : '8px' }}; color: #999; text-align: center;">
            Sistema de Gestión de centrales de esterilización CEYE - Reporte automático
            @if ($selected_count > 10000)
                <br><em>Formato optimizado para gran volumen de datos (con productos)</em>
            @endif
        </div>
    </div>

</body>

</html>