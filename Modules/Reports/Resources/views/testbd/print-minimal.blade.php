<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Reporte TestBD</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 8px; margin: 5px; }
        h1 { font-size: 14px; text-align: center; margin: 10px 0; }
        .info { background: #f0f0f0; padding: 5px; margin: 5px 0; font-size: 7px; }
        table { width: 100%; border-collapse: collapse; font-size: 7px; }
        th, td { border: 1px solid #ddd; padding: 2px; }
        th { background: #ddd; font-weight: bold; text-align: center; }
        .c { text-align: center; }
    </style>
</head>
<body>
    <h1>REPORTE TESTBD - ULTRA COMPACTO</h1>
    
    <div class="info">
        <strong>Total:</strong> {{ $selected_count }} | 
        <strong>Válidos:</strong> {{ $valid_count }} | 
        <strong>Inválidos:</strong> {{ $invalid_count }} | 
        <strong>Fecha:</strong> {{ $print_date }}
    </div>

    <table>
        <tr>
            <th>ID</th>
            <th>Fecha</th>
            <th>Máquina</th>
            <th>Valid</th>
            <th>Estado</th>
        </tr>
        @foreach($testbds as $t)
            <tr>
                <td class="c">{{ $t->id }}</td>
                <td>{{ $t->updated_at ? $t->updated_at->format('d/m H:i') : 'N/A' }}</td>
                <td>{{ $t->machine_name ?: 'N/A' }}</td>
                <td class="c">
                    @if($t->validation_bd === 'valid')
                        ✓
                    @elseif($t->validation_bd === 'invalid')
                        ✗
                    @elseif($t->validation_bd === 'pending')
                        ?
                    @else
                        -
                    @endif
                </td>
                <td>{{ $t->status ?: 'A' }}</td>
            </tr>
        @endforeach
    </table>

    <div style="margin-top: 10px; font-size: 6px; text-align: center; color: #666;">
        {{ $testbds->count() }} registros | {{ now()->format('d/m/Y H:i') }}
    </div>
</body>
</html>