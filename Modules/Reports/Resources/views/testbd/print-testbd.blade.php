<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de TestBD</title>
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

        th,
        td {
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

        .badge-valid {
            background-color: #28a745;
            color: white;
        }

        .badge-invalid {
            background-color: #dc3545;
            color: white;
        }

        .badge-pending {
            background-color: #ffc107;
            color: #212529;
        }

        .badge-machine {
            background-color: #17a2b8;
            color: white;
        }

        .badge-unknown {
            background-color: #6c757d;
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

        .text-center {
            text-align: center;
        }

        .success-rate {
            background-color: #d4edda;
            border: 1px solid #c3e6cb;
            padding: 8px;
            border-radius: 4px;
            margin: 10px 0;
            font-size: 11px;
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
        @if ($dataUrl)
            <img src="{{ $dataUrl }}" alt="Logo Instituto" class="logo">
        @endif


        @if ($institute)
            <h1>{{ $institute->institute_name ?? 'Hospital de Especialidades FF.AA N°1' }}</h1>
            <div class="institute-info">
                <strong>Dirección:</strong> {{ $institute->address ?? 'Av. Gran Colombia &, Quito 170136' }} |
                <strong>Área:</strong> {{ $institute->area ?? 'Central Esterilización' }} |
                <strong>Ciudad:</strong> {{ $institute->city ?? 'Quito' }}
            </div>
        @endif

        <div class="title">REPORTE DE TESTBD</div>
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

    {{-- Estadísticas de Validación --}}
    <div class="stats">
        <div class="stats-row">

            @if (isset($validation_stats) && $validation_stats->count() > 0)
                <strong>Estadísticas por Validación ok:</strong>
                @foreach ($validation_stats as $validation => $count)
                    <div class="stat-item">
                        <div class="stat-number">{{ $count }}</div>
                        <div>
                            @if ($validation === 'Correcto')
                                Correcto
                            @elseif($validation === 'Falla')
                                Falla
                            @else
                                {{ ucfirst($validation ?: 'Sin validación') }}
                            @endif
                        </div>
                    </div>
                @endforeach
            @endif

            {{-- Estadísticas por Máquina --}}
            @if (isset($machine_stats) && $machine_stats->count() > 0)
                <strong>Estadísticas por Máquina:</strong>
                @foreach ($machine_stats->take(5) as $machine => $count)
                    <div class="stat-item">
                        <div class="stat-number">{{ $count }}</div>
                        <div>{{ $machine ?: 'Sin asignar' }}</div>
                    </div>
                @endforeach
                @if ($machine_stats->count() > 5)
                    <div class="stat-item">
                        <div class="stat-number">+{{ $machine_stats->count() - 5 }}</div>
                        <div>Más máquinas</div>
                    </div>
                @endif
            @endif
        </div>
    </div>


    {{-- Tasa de Éxito --}}
    @if (isset($success_rate) && $success_rate > 0)
        <div class="success-rate">
            <strong>Tasa de Éxito:</strong> {{ $success_rate }}%
            ({{ $valid_count }} Correctos de {{ $selected_count }} total)
        </div>
    @endif

    <table>
        <thead>
            <tr>
                <th style="width: 8%;">ID</th>
                <th style="width: 12%;">Fecha</th>
                <th style="width: 15%;">Máquina</th>
                <th style="width: 12%;">Validación</th>

                <th style="width: 20%;">Observaciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($testbds as $testbd)
                <tr>
                    <td class="text-center">
                        <strong>{{ $testbd->testbd_reference }}</strong>
                    </td>
                    <td>
                        @if ($testbd->updated_at)
                            {{ $testbd->updated_at->format('d/m/Y') }}<br>
                            <small style="color: #666;">{{ $testbd->updated_at->format('H:i:s') }}</small>
                        @else
                            N/A
                        @endif
                    </td>
                    <td class="text-center">
                        @if ($testbd->machine_name)
                            <span class="badge badge-machine">{{ $testbd->machine_name }}</span>
                        @else
                            <span class="badge badge-unknown">N/A</span>
                        @endif
                    </td>
                    <td class="text-center">
                        @if ($testbd->validation_bd === 'Correcto')
                            <span class="badge badge-valid">Correcto</span>
                        @elseif($testbd->validation_bd === 'Falla')
                            <span class="badge badge-invalid">Falla</span>
                        @else
                            <span class="badge badge-unknown">{{ $testbd->validation_bd ?: 'N/A' }}</span>
                        @endif
                    </td>


                    <td style="font-size: 8px;">
                        @if (isset($testbd->observations) && $testbd->observations)
                            {{ Str::limit($testbd->observations, 100) }}
                        @elseif(isset($testbd->notes) && $testbd->notes)
                            {{ Str::limit($testbd->notes, 100) }}
                        @elseif(isset($testbd->comments) && $testbd->comments)
                            {{ Str::limit($testbd->comments, 100) }}
                        @else
                            <em style="color: #666;">Sin observaciones</em>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" style="text-align: center; color: #666; font-style: italic;">
                        No se encontraron registros de TestBD para mostrar
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{-- Resumen adicional si hay muchos registros --}}
    @if ($selected_count > 20)
        <div style="margin-top: 15px; font-size: 11px; background-color: #f8f9fa; padding: 10px; border-radius: 4px;">
            <strong>Resumen del reporte:</strong><br>
            • Total de tests procesados: {{ $selected_count }}<br>
            • Tests Correctos: {{ $valid_count }} ({{ $success_rate }}%)<br>
            • Tests Fallas: {{ $invalid_count }}<br>
            • Tests pendientes: {{ $pending_count }}<br>
            @if (isset($machine_stats) && $machine_stats->count() > 0)
                • Número de máquinas diferentes: {{ $machine_stats->count() }}<br>
            @endif
            • Período del reporte:
            {{ $testbds->first() && $testbds->first()->updated_at ? $testbds->first()->updated_at->format('d/m/Y') : 'N/A' }}
            -
            {{ $testbds->last() && $testbds->last()->updated_at ? $testbds->last()->updated_at->format('d/m/Y') : 'N/A' }}
        </div>
    @endif

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
