@if($data->status === 'Procesado')
    <span class="badge badge-success">{{ $data->status }}</span>
@elseif($data->status === 'Pendiente')
    <span class="badge badge-warning">{{ $data->status }}</span>
@else
    <span class="badge badge-secondary">{{ $data->status }}</span>
@endif
