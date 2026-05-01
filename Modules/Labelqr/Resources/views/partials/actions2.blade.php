@can('edit_admin')
    <a href="{{ route('labelqrDetails.edit', $data->id) }}" class="dropdown-item">
        <i class="bi bi-pencil mr-2 text-primary" style="line-height: 1;"></i> Editar
    </a>
@endcan

@can('delete_admin')
    <button class="dropdown-item"
        onclick="
            event.preventDefault();
            if (confirm('¿Está seguro? Desea eliminar permanentemente este registro.')) {
                document.getElementById('destroy{{ $data->id }}').submit()
            }">
        <i class="bi bi-trash mr-2 text-danger" style="line-height: 1;"></i> Eliminar
        <form id="destroy{{ $data->id }}" class="d-none" action="{{ route('labelqrDetails.destroy', $data->id) }}"
            method="POST">
            @csrf
            @method('DELETE')
        </form>
    </button>
@endcan
