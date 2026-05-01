@can('edit_roles')
    <a href="{{ route('roles.edit', $data->id) }}" class="btn btn-info btn-sm" title="Editar">
        <i class="bi bi-pencil"></i>
    </a>
@endcan

@can('delete_roles')
    <button class="btn btn-danger btn-sm" title="Eliminar"
        onclick="event.preventDefault();
        if (confirm('¿Está seguro de que desea eliminar este rol? Esta acción no se puede deshacer.')) {
            document.getElementById('destroy{{ $data->id }}').submit();
        }">
        <i class="bi bi-trash"></i>
        <form id="destroy{{ $data->id }}" class="d-none" action="{{ route('roles.destroy', $data->id) }}" method="POST">
            @csrf
            @method('delete')
        </form>
    </button>
@endcan
