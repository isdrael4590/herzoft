<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Expediciones</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            line-height: 1.4;
            margin: 0;
            padding: 15px;
        }
        
        .header {
            text-align: center;
            margin-bottom: 20px;
            border-bottom: 2px solid #333;
            padding-bottom: 15px;
        }
        
        .logo {
            max-height: 60px;
            margin-bottom: 10px;
        }
        
        .title {
            font-size: 18px;
            font-weight: bold;
            margin: 10px 0;
            color: #333;
        }
        
        .info-section {
            display: flex;
            justify-content: space-between;
            margin-bottom: 15px;
            background-color: #f8f9fa;
            padding: 10px;
            border: 1px solid #dee2e6;
        }
        
        .info-item {
            font-size: 11px;
        }
        
        .info-item strong {
            color: #495057;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            font-size: 10px;
        }
        
        th, td {
            border: 1px solid #ddd;
            padding: 6px;
            text-align: left;
        }
        
        th {
            background-color: #343a40;
            color: white;
            font-weight: bold;
            text-align: center;
        }
        
        tr:nth-child(even) {
            background-color: #f8f9fa;
        }
        
        .badge {
            padding: 2px 6px;
            border-radius: 3px;
            font-size: 9px;
            font-weight: bold;
            text-align: center;
            display: inline-block;
            min-width: 60px;
        }
        
        .badge-pendiente {
            background-color: #17a2b8;
            color: white;
        }
        
        .badge-despachado {
            background-color: #007bff;
            color: white;
        }
        
        .footer {
            margin-top: 20px;
            text-align: center;
            font-size: 10px;
            color: #666;
            border-top: 1px solid #ddd;
            padding-top: 10px;
        }
        
        .stats {
            margin: 15px 0;
            font-size: 11px;
        }
        
        .stats-row {
            display: flex;
            justify-content: space-around;
            background-color: #e9ecef;
            padding: 8px;
            border-radius: 4px;
        }
        
        .stat-item {
            text-align: center;
        }
        
        .stat-number {
            font-size: 14px;
            font-weight: bold;
            color: #495057;
        }
        
        .page-break {
            page-break-before: always;
        }
        
        @media print {
            body {
                margin: 0;
                padding: 10px;
            }
        }
    </style>
</head>
<body>
    <div class="header">
        @if($dataUrl)
            <img src="{{ $dataUrl }}" alt="Logo Instituto" class="logo">
        @endif
        
        @if($institute)
            <div style="font-size: 14px; font-weight: bold;">{{ $institute->institute_name }}</div>
            <div style="font-size: 11px; color: #666;">{{ $institute->address ?? '' }}</div>
        @endif
        
        <div class="title">REPORTE DE EXPEDICIONES</div>
    </div>

    <div class="info-section">
        <div class="info-item">
            <strong>Fecha de generación:</strong> {{ $print_date }}
        </div>
        <div class="info-item">
            <strong>Total registros:</strong> {{ $selected_count }}
        </div>
        <div class="info-item">
            <strong>Elementos solicitados:</strong> {{ $total_items }}
        </div>
    </div>

    @if(isset($status_stats) && $status_stats->count() > 0)
        <div class="stats">
            <strong>Estadísticas por Estado:</strong>
            <div class="stats-row">
                @foreach($status_stats as $status => $count)
                    <div class="stat-item">
                        <div class="stat-number">{{ $count }}</div>
                        <div>{{ $status }}</div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    @if(isset($area_stats) && $area_stats->count() > 0)
        <div class="stats">
            <strong>Estadísticas por Área:</strong>
            <div class="stats-row">
                @foreach($area_stats as $area => $count)
                    <div class="stat-item">
                        <div class="stat-number">{{ $count }}</div>
                        <div>{{ $area ?: 'Sin área' }}</div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    <table>
        <thead>
            <tr>
                <th style="width: 8%;">Fecha</th>
                <th style="width: 15%;">Referencia</th>
                <th style="width: 12%;">Área</th>
                <th style="width: 10%;">Estado</th>
                <th style="width: 10%;">Persona Entrega</th>
                <th style="width: 10%;">Persona Recibe</th>
                <th style="width: 5%;">Paquetes</th>
                <th style="width: 37%;">Detalles</th>
            </tr>
        </thead>
        <tbody>
            @forelse($expeditions as $expedition)
                <tr>
                    <td>{{ \Carbon\Carbon::parse($expedition->updated_at)->format('d/m/Y') }}</td>
                    <td><strong>{{ $expedition->reference }}</strong></td>
                    <td>{{ $expedition->area_expedition ?? 'N/A' }}</td>
                    <td>
                        @if($expedition->status_expedition == 'Pendiente')
                            <span class="badge badge-pendiente">{{ $expedition->status_expedition }}</span>
                        @elseif($expedition->status_expedition == 'Despachado')
                            <span class="badge badge-despachado">{{ $expedition->status_expedition }}</span>
                        @else
                            <span class="badge">{{ $expedition->status_expedition ?? 'N/A' }}</span>
                        @endif
                    </td>
                    <td>{{ $expedition->operator ?? 'N/A' }}</td>
                    <td>{{ $expedition->staff_expedition ?? 'N/A' }}</td>
                    <td style="text-align: center;">
                        {{ $expedition->expeditionDetails ? $expedition->expeditionDetails->count() : 0 }}
                    </td>
                    <td style="font-size: 8px;">
                        @if($expedition->expeditionDetails && $expedition->expeditionDetails->count() > 0)
                            @foreach($expedition->expeditionDetails->take(3) as $detail)
                                {{ $detail->product_name ?? 'Producto' }}{{ !$loop->last ? ', ' : '' }}
                            @endforeach
                            @if($expedition->expeditionDetails->count() > 3)
                                <br><em>+{{ $expedition->expeditionDetails->count() - 3 }} más...</em>
                            @endif
                        @else
                            <em>Sin detalles</em>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" style="text-align: center; color: #666; font-style: italic;">
                        No se encontraron expediciones para mostrar
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        <div>
            Reporte generado el {{ now()->format('d/m/Y H:i:s') }} 
            @if($setting)
                | {{ $setting->company_name ?? 'Sistema de Gestión' }}
            @endif
        </div>
        <div style="margin-top: 5px; font-size: 9px;">
            Total de expediciones en el reporte: {{ $expeditions->count() }}
            @if(isset($total_packages) && $total_packages > 0)
                | Total de paquetes: {{ $total_packages }}
            @endif
        </div>
    </div>
</body>
</html>