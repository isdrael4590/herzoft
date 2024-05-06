@if ($data->status_cycle == 'En Curso')
    <span class="badge badge-info">
        {{ $data->status_cycle }}
    </span>
@elseif($data->status_cycle == 'Pendiente')
    <span class="badge badge-dark">
        {{ $data->status_cycle }}
    </span>
@elseif($data->status_cycle == 'Ciclo Aprobado')
    <span class="badge badge-success">
        Ciclo Aprobado
    </span>
@elseif($data->status_cycle == 'Ciclo Falla')
    <span class="badge badge-danger">
        Ciclo Falla    </span>
@endif
