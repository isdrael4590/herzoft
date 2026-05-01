@can('show_wash_area')
    <a href="{{ route('lavados.show', $data->id) }}" class="dropdown-item">
        <i class="bi bi-eye mr-2 text-info" style="line-height: 1;"></i> Detalles
    </a>
@endcan

@can('create_wash_area')
    @if ($data->status_ciclo === 'Cargar')
        <a href="{{ route('lavado-descarga.create', $data->id) }}" class="dropdown-item">
            <i class="bi bi-droplet-half mr-2 text-info" style="line-height: 1;"></i> Enviar Ciclo lavado
        </a>

    @endif
@endcan

@can('edit_wash_area')
    @if ($data->status !== 'Procesado')
        <a href="{{ route('lavados.edit', $data->id) }}" class="dropdown-item">
            <i class="bi bi-pencil mr-2 text-primary" style="line-height: 1;"></i> Editar
        </a>
    @endif
    @can('access_admin')
        <a href="{{ route('lavados.edit', $data->id) }}" class="dropdown-item">
            <i class="bi bi-clock-history mr-2 text-secondary" style="line-height: 1;"></i> Editar Admin
        </a>
        @endcan
@endcan

@can('delete_wash_area')
    <button class="dropdown-item"
        onclick="
            event.preventDefault();
            if (confirm('¿Está seguro? Desea eliminar permanentemente este lavado.')) {
                document.getElementById('destroy{{ $data->id }}').submit()
            }">
        <i class="bi bi-trash mr-2 text-danger" style="line-height: 1;"></i> Eliminar
        <form id="destroy{{ $data->id }}" class="d-none" action="{{ route('lavados.destroy', $data->id) }}"
            method="POST">
            @csrf
            @method('DELETE')
        </form>
    </button>
@endcan
