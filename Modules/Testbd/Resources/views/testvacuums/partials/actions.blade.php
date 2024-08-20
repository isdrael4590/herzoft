@can('print_testvacuums')
<a href="{{ route('testvacuums.pdf', $data->id) }}" class="dropdown-item">
    <i class="bi bi-cursor mr-2 text-warning" style="line-height: 1;"></i> Imprimir
</a>
@endcan
@can('edit_testvacuums')
<a href="{{ route('testvacuums.edit', $data->id) }}" class="dropdown-item">
    <i class="bi bi-pencil mr-2 text-primary" style="line-height: 1;"></i> Editar
</a>
@endcan
@can('show_testvacuums')
<a href="{{ route('testvacuums.show', $data->id) }}" class="dropdown-item">
    <i class="bi bi-eye mr-2 text-info" style="line-height: 1;"></i> Detalles
</a>
@endcan
@can('delete_testvacuums')
<button id="delete" class="dropdown-item" onclick="
    event.preventDefault();
    if (confirm('Are you sure? It will delete the data permanently!')) {
        document.getElementById('destroy{{ $data->id }}').submit()
    }
    ">
        <i class="bi bi-trash mr-2 text-danger" style="line-height: 1;"></i> Eliminar
        <form id="destroy{{ $data->id }}" class="d-none" action="{{ route('testvacuums.destroy', $data->id) }}" method="POST">
        @csrf
        @method('delete')
    </form>
</button>
@endcan
