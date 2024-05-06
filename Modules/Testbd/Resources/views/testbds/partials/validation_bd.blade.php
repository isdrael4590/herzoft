@if ($data->validation_bd == 'Falla')
    <span class="badge badge-danger">
        {{ $data->validation_bd }}
    </span>
@else
    <span class="badge badge-success">
        {{ $data->validation_bd }}
    </span>
@endif
