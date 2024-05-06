@can('print_testbds')
<a href="#" class="btn btn-primary btn-sm">
    <i class="bi bi-printer"></i>
</a>
@endcan
@can('edit_Testbds')
<a href="{{ route('testbds.edit', $data->id) }}" class="btn btn-info btn-sm">
    <i class="bi bi-pencil"></i>
</a>
@endcan
@can('show_Testbds')
<a href="{{ route('testbds.show', $data->id) }}" class="btn btn-primary btn-sm">
    <i class="bi bi-eye"></i>
</a>
@endcan
@can('delete_Testbds')
<button id="delete" class="btn btn-danger btn-sm" onclick="
    event.preventDefault();
    if (confirm('Are you sure? It will delete the data permanently!')) {
        document.getElementById('destroy{{ $data->id }}').submit()
    }
    ">
    <i class="bi bi-trash"></i>
    <form id="destroy{{ $data->id }}" class="d-none" action="{{ route('testbds.destroy', $data->id) }}" method="POST">
        @csrf
        @method('delete')
    </form>
</button>
@endcan
