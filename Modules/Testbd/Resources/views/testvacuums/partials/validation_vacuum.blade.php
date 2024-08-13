@if ($data->validation_vacuum == 'Falla')
    <span class="badge badge-danger">
        {{ $data->validation_vacuum }}
    </span>
@else
    <span class="badge badge-success">
        {{ $data->validation_vacuum }}
    </span>
@endif
