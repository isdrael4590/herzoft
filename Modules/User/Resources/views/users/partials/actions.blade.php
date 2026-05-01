@can('edit_user_management')
    <a href="{{ route('users.edit', $data->id) }}" class="btn btn-info btn-sm" title="Editar">
        <i class="bi bi-pencil"></i>
    </a>
@endcan
@can('delete_user_management')
    <button class="btn btn-danger btn-sm" title="Eliminar"
        onclick="event.preventDefault();
        if (confirm('¿Está seguro de que desea eliminar este usuario? Esta acción no se puede deshacer.')) {
            document.getElementById('destroy{{ $data->id }}').submit();
        }">
        <i class="bi bi-trash"></i>
        <form id="destroy{{ $data->id }}" class="d-none" action="{{ route('users.destroy', $data->id) }}" method="POST">
            @csrf
            @method('delete')
        </form>
    </button>
@endcan
