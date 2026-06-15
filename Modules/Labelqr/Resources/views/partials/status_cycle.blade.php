@if ($data->status_cycle == 'Cargar')
    <span class="badge badge-warning" style="font-size:.8rem;padding:5px 10px;border-radius:20px;">
        <i class="bi bi-hourglass-split mr-1"></i> {{ $data->status_cycle }}
    </span>
@elseif ($data->status_cycle == 'En Curso')
    <span class="badge badge-primary" style="font-size:.8rem;padding:5px 10px;border-radius:20px;">
        <i class="bi bi-arrow-repeat mr-1"></i> {{ $data->status_cycle }}
    </span>
@elseif ($data->status_cycle == 'Pendiente')
    <span class="badge badge-dark" style="font-size:.8rem;padding:5px 10px;border-radius:20px;">
        <i class="bi bi-clock mr-1"></i> {{ $data->status_cycle }}
    </span>
@elseif ($data->status_cycle == 'Ciclo Aprobado')
    <span class="badge badge-success" style="font-size:.8rem;padding:5px 10px;border-radius:20px;">
        <i class="bi bi-check-circle mr-1"></i> Ciclo Aprobado
    </span>
@elseif ($data->status_cycle == 'Ciclo Falla')
    <span class="badge badge-danger" style="font-size:.8rem;padding:5px 10px;border-radius:20px;">
        <i class="bi bi-x-circle mr-1"></i> Ciclo Falla
    </span>
@endif
