@if ($data->status_cycle == 'En Curso')
    <span class="badge badge-info">
        {{ $data->status_cycle }}
    </span>
@elseif($data->status_cycle == 'Pendiente')
    <span class="badge badge-dark">
        {{ $data->status_cycle }}
    </span>
@elseif($data->status_cycle == 'cycle_ok')
    <span class="badge badge-success">
        Ciclo Aprobado
    </span>
@elseif($data->status_cycle == 'cycle_fail')
    <span class="badge badge-dark">
        Ciclo Con Falla    </span>
@endif
