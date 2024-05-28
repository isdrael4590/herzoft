@if ($data->status_expedition == 'Despachado')
    <span class="badge badge-dark">
        {{ $data->status_expedition }}
    </span>
@else
    <span class="badge badge-warning">
        {{ $data->status_expedition }}
    </span>

@endif
