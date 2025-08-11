<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Recepciones - {{ $selected_count }} registros</title>
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

        .status-procesado {
            background-color: #28a745;
        }

        .status-pendiente {
            background-color: #ffc107;
            color: #333;
        }

        .status-registrado {
            background-color: #6c757d;
        }

        .packages-badge {
            background-color: #007bff;
            color: white;
            padding: {{ $selected_count > 5000 ? '1px 3px' : '2px 6px' }};
            border-radius: 2px;
            font-size: {{ $selected_count > 5000 ? '6px' : '8px' }};
            font-weight: bold;
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
            @endif
        }

        /* Para landscape en volúmenes muy grandes */
        @if ($selected_count > 10000)
            @page {
                size: A4 landscape;
                margin: 10mm;
            }

            .table th:first-child,
            .table td:first-child {
                width: 10%;
            }

            .table th:nth-child(2),
            .table td:nth-child(2) {
                width: 12%;
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
                width: 22%;
            }

            .table th:nth-child(6),
            .table td:nth-child(6) {
                width: 22%;
            }

            .table th:nth-child(7),
            .table td:nth-child(7) {
                width: 8%;
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
            <BR>
            <h1>REPORTE MENSUAL DE RECEPCIONES</h1>
        @endif
    </div>

    <!-- Report Info -->
    <div class="report-info">
        <div>
            <strong>Reporte:</strong> Físico de Ingresos en esterilización<br>
            <strong>Fecha Generado:</strong> {{ $print_date }}
        </div>
        <div style="text-align: left;">
            <strong>Registros:</strong> {{ number_format($selected_count) }}<br>
            <strong>Paquetes:</strong> {{ number_format($total_packages) }}
        </div>
        <div style="text-align: right;">
            <strong>Versión:</strong> 01<br>
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
                <th>Área</th>
                <th>Estado</th>
                <th>Persona Entrega</th>
                <th>Persona que Recibe</th>
                <th>Cant. Paq</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($receptions as $index => $reception)
                <tr>
                    <td>{{ \Carbon\Carbon::parse($reception->updated_at)->format('d/m/y') }}</td>
                    <td><strong>{{ $reception->reference }}</strong></td>
                    <td>{{ Str::limit($reception->area, 15) }}</td>
                    <td>
                        <span class="status-badge status-{{ strtolower($reception->status) }}">
                            {{ substr($reception->status, 0, 3) }}
                        </span>
                    </td>
                    <td>{{ Str::limit($reception->delivery_staff, 18) }}</td>
                    <td>{{ Str::limit($reception->operator, 18) }}</td>
                    <td>
                        <span class="packages-badge">
                            {{ $reception->receptionDetails->count() }}
                        </span>
                    </td>
                    <td class="products-cell">
                        @if ($reception->receptionDetails->count() > 0)
                            @php
                                $productNames = $reception->receptionDetails->pluck('product_name')->filter()->unique();
                            @endphp
                            @if ($productNames->count() > 0)
                                @foreach ($productNames as $productName)
                                    <span class="product-item">{{ $productName }}</span>
                                @endforeach
                            @else
                                <span style="font-size: {{ $selected_count > 5000 ? '5px' : '7px' }}; color: #999;">Sin
                                    productos</span>
                            @endif
                        @else
                            <span
                                style="font-size: {{ $selected_count > 5000 ? '5px' : '7px' }}; color: #999;">-</span>
                        @endif
                    </td>
                </tr>

                {{-- Page break every 50 rows for large volumes --}}
                @if ($selected_count > 5000 && ($index + 1) % 50 == 0 && $index + 1 < $receptions->count())
        </tbody>
    </table>
    <div class="page-break"></div>
    <table class="table">
        <thead>
            <tr>
                <th>Fecha</th>
                <th>Referencia</th>
                <th>Área</th>
                <th>Estado</th>
                <th>Persona Entrega</th>
                <th>Persona que Recibe</th>
                <th>Cant. Paq</th>
                <th>Paquetes</th>
            </tr>
        </thead>
        <tbody>
            {{-- Page break every 25 rows for normal volumes --}}
        @elseif($selected_count <= 5000 && ($index + 1) % 25 == 0 && $index + 1 < $receptions->count())
        </tbody>
    </table>
    <div class="page-break"></div>
    <table class="table">
        <thead>
            <tr>
                <th>Fecha</th>
                <th>Referencia</th>
                <th>Área</th>
                <th>Estado</th>
                <th>Persona Entrega</th>
                <th>Persona que Recibe</th>
                <th>Cant. Paq</th>
                <th>Paquetes</th>
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
                <br><em>Formato optimizado para gran volumen de datos</em>
            @endif
        </div>
    </div>

</body>

</html>
