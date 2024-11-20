@if ($data->status_expedition == 'Despachado')
<span>Despachado</span><br>

{{ $data->created_at->format('d M, Y') }} {{ $data->created_at->isoFormat('H:mm:ss A')}}
@else
<span>Pendiente</span><br>
{{ $data->created_at->format('d M, Y') }} {{ $data->created_at->isoFormat('H:mm:ss A')}}

@endif