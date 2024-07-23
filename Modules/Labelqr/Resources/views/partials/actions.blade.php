{{-- <div class="btn-group dropleft">
    <button type="button" class="btn btn-ghost-primary dropdown rounded" data-toggle="dropdown" aria-expanded="false">
        <i class="bi bi-three-dots-vertical"></i>
    </button>
    <div class="dropdown-menu"> --}}
        
@can('create_labelqr_discharges')
    @if ($data->status_cycle == 'Cargar')
        <a href="{{ route('labelqr-discharges.create', $data) }}" class="dropdown-item">
            <i class="bi bi-check2-circle mr-2 text-success" style="line-height: 1;"></i> Enviar Proceso.
        </a>
    @endif
@endcan


@can('edit_labelqrs')

    @if (($data->status_cycle == 'Cargar' || $data->status_cycle == 'Pendiente' ) & ($data->machine_type == 'Autoclave'))
        <a href="{{ route('labelqrs.edit', $data->id) }}" class="dropdown-item">
            <i class="bi bi-pencil mr-2 text-primary" style="line-height: 1;"></i> Editar STEAM
        </a>
       @elseif (($data->status_cycle == 'Cargar' || $data->status_cycle == 'Pendiente' )& ($data->machine_type == 'Peroxido'))
        <a href="{{ route('labelqrs.edit', [($data->id)])}}" class="dropdown-item">
            <i class="bi bi-pencil mr-2 text-primary" style="line-height: 1;"></i> Editar HPO
        </a>
      
    @endif
@endcan
@can('show_labelqrs')
    <a href="{{ route('labelqrs.show', $data->id) }}" class="dropdown-item">
        <i class="bi bi-eye mr-2 text-info" style="line-height: 1;"></i> Detalles
    </a>
@endcan
@can('delete_labelqrs')
    <button id="delete" class="dropdown-item"
        onclick="
                event.preventDefault();
                if (confirm('Are you sure? It will delete the data permanently!')) {
                document.getElementById('destroy{{ $data->id }}').submit()
                }">
        <i class="bi bi-trash mr-2 text-danger" style="line-height: 1;"></i> Eliminar
        <form id="destroy{{ $data->id }}" class="d-none" action="{{ route('labelqrs.destroy', $data->id) }}"
            method="POST">
            @csrf
            @method('delete')
        </form>
    </button>
@endcan
{{--    </div>
</div> --}}
