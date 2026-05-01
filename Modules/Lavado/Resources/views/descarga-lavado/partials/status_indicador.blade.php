@if($data->status_indicador === 'Correcto')
    <span class="badge badge-success">{{ $data->status_indicador }}</span>
@elseif($data->status_indicador === 'Falla')
    <span class="badge badge-warning">{{ $data->status_indicador }}</span>
@else
    <span class="badge badge-secondary">{{ $data->status_indicador }}</span>
@endif
