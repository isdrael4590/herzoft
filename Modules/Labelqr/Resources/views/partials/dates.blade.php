<span>
    Fecha Elab.
</span>
{{ $data->created_at->format('d M, Y') }} {{ $data->created_at->isoFormat('H:mm:ss A')}}
<span>
    Fecha Exp.
</span>
{{ $data->created_at->format('d M, Y')}}