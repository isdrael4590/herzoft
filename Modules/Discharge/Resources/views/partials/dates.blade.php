<span>Ciclo Enviado</span><br>
{{ $data->created_at->format('d M, Y') }} {{ $data->created_at->isoFormat('H:mm:ss A')}}
<br>
@if ( $data->updated_at != $data->created_at)
<span>Ciclo Liberado </span><br>
{{ $data->updated_at->format('d M, Y') }} {{ $data->updated_at->isoFormat('H:mm:ss A')}}
    
@else
    
@endif
