@if ($data->validation_biologic == 'Falla')
    <span class="badge badge-danger">
        {{ $data->validation_biologic }}
    </span>
@elseif ($data->validation_biologic == 'Correcto')
    <span class="badge badge-success">
        {{ $data->validation_biologic }}
    </span>
    @else
    <span class="badge badge-info">
        {{ $data->validation_biologic }}
    </span>
@endif
