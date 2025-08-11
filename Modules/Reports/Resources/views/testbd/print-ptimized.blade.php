<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte TestBD - Optimizado</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 10px;
            margin: 10px;
            line-height: 1.2;
        }
        
        .header {
            text-align: center;
            margin-bottom: 15px;
            border-bottom: 1px solid #333;
            padding-bottom: 10px;
        }
        
        .title {
            font-size: 16px;
            font-weight: bold;
            margin: 5px 0;
        }
        
        .info {
            background-color: #f5f5f5;
            padding: 8px;
            margin-bottom: 10px;
            font-size: 9px;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 8px;
        }
        
        th, td {
            border: 1px solid #ccc;
            padding: 3px;
            text-align: left;
        }
        
        th {
            background-color: #e0e0e0;
            font-weight: bold;
            text-align: center;
        }
        
        .badge {
            padding: 1px 4px;
            border-radius: 2px;
            font-size: 7px;
            font-weight: bold;
        }
        
        .badge-valid { background-color: #28a745; color: white; }
        .badge-invalid { background-color: #dc3545; color: white; }
        .badge-pending { background-color: #ffc107; color: black; }
        
        .text-center { text-align: center; }
        
        .footer {
            margin-top: 10px;
            font-size: 8px;
            text-align: center;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="title">REPORTE TESTBD - OPTIMIZADO</div>
        @if($institute)
            <div style="font-size: 12px;">{{ $institute->institute_name ?? $institute->name ?? 'Instituto' }}</div>
        @endif
    </div>

    <div class="info">
        <strong>Generado:</strong> {{ $print_date }} | 
        <strong>Registros:</strong> {{ $selected_count }} | 
        <strong>Válidos:</strong> {{ $valid_count }} | 
        <strong>Inválidos:</strong> {{ $invalid_count }} | 
        <strong>Pendientes:</strong> {{ $pending_count }} | 
        <strong>Éxito:</strong> {{ $success_rate }}%
    </div>

    <table>
        <thead>
            <tr>
                <th style="width: 6%;">ID</th>
                <th style="width: 12%;">Fecha</th>
                <th style="width: 15%;">Máquina</th>
                <th style="width: 12%;">Validación</th>
                <th style="width: 55%;">Datos</th>
            </tr>
        </thead>
        <tbody>
            @forelse($testbds as $testbd)
                <tr>
                    <td class="text-center">{{ $testbd->id }}</td>
                    <td>
                        @if($testbd->updated_at)
                            {{ $testbd->updated_at->format('d/m H:i') }}
                        @else
                            N/A
                        @endif
                    </td>
                    <td>{{ $testbd->machine_name ?: 'N/A' }}</td>
                    <td class="text-center">
                        @if($testbd->validation_bd === 'valid')
                            <span class="badge badge-valid">V</span>
                        @elseif($testbd->validation_bd === 'invalid')
                            <span class="badge badge-invalid">I</span>
                        @elseif($testbd->validation_bd === 'pending')
                            <span class="badge badge-pending">P</span>
                        @else
                            {{ $testbd->validation_bd ?: 'N/A' }}
                        @endif
                    </td>
                    <td style="font-size: 7px;">
                        {{-- Mostrar datos condensados --}}
                        @if(isset($testbd->test_type))
                            <strong>Tipo:</strong> {{ $testbd->test_type }} |
                        @endif
                        @if(isset($testbd->result_value))
                            <strong>Resultado:</strong> {{ $testbd->result_value }} |
                        @endif
                        @if(isset($testbd->duration))
                            <strong>Duración:</strong> {{ $testbd->duration }}s |
                        @endif
                        <strong>Estado:</strong> {{ $testbd->status ?? 'Activo' }}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">No hay datos</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        Reporte TestBD | {{ $testbds->count() }} registros | Generado: {{ now()->format('d/m/Y H:i:s') }}
    </div>
</body>
</html>