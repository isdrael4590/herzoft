

@can('edit_labelqrDetails')
    <a href="{{ route('labelqrDetails.edit', $data->id) }}" class="dropdown-item">
        <i class="bi bi-pencil mr-2 text-primary" style="line-height: 1;"></i> Editar
    </a>
@endcan

@can('delete_labelqrDetails')
    <button id="delete" class="dropdown-item"
        onclick="
                event.preventDefault();
                if (confirm('Are you sure? It will delete the data permanently!')) {
                document.getElementById('destroy{{ $data->id }}').submit()
                }">
        <i class="bi bi-trash mr-2 text-danger" style="line-height: 1;"></i> Eliminar
        <form id="destroy{{ $data->id }}" class="d-none" action="{{ route('labelqrDetails.destroy', $data->id) }}"
            method="POST">
            @csrf
            @method('delete')
        </form>
    </button>
@endcan

