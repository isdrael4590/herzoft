@if($data->status_ciclo === 'Ciclo Correcto')
    <span class="badge badge-success">{{ $data->status_ciclo }}</span>
@elseif($data->status_ciclo === 'Ciclo con Falla')
    <span class="badge badge-warning">{{ $data->status_ciclo }}</span>
@else
    <span class="badge badge-secondary">{{ $data->status_ciclo }}</span>
@endif
