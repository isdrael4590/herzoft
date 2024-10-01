{{-- <div class="btn-group dropleft">
    <button type="button" class="btn btn-ghost-primary dropdown rounded" data-toggle="dropdown" aria-expanded="false">
        <i class="bi bi-three-dots-vertical"></i>
    </button>
    <div class="dropdown-menu"> --}}
@can('print_admin')
    <a href="{{ route('receptions.pdf', $data->id) }}" class="dropdown-item">
        <i target="_blank" class="bi bi-cursor mr-2 text-warning" style="line-height: 1;"></i> Imprimir
    </a>
    @can('print_receptionsticket')
        <a href="{{ route('receptiontickets.pdf', $data->id) }}" class="dropdown-item">
            <i class="bi bi-cursor mr-2 text-warning" style="line-height: 1;"></i> Imprimir Ticket
        </a>
    @endcan
@endcan

@can('edit_receptions')
    @if ($data->status != 'Procesado')
        <a href="{{ route('receptions.edit', $data->id) }}" class="dropdown-item">
            <i class="bi bi-pencil mr-2 text-primary" style="line-height: 1;"></i> Editar Operario
        </a>
    @endif
@endcan
@can('edit_admin')
    <a href="{{ route('receptions.edit', $data->id) }}" class="dropdown-item">
        <i class="bi bi-pencil mr-2 text-primary" style="line-height: 1;"></i> Editar Admin
    </a>
@endcan
@can('show_receptions')
    <a href="{{ route('receptions.show', $data->id) }}" class="dropdown-item">
        <i class="bi bi-eye mr-2 text-info" style="line-height: 1;"></i> Detalles
    </a>
@endcan
@can('create_reception_preparations')
    @if ($data->status == 'Registrado')
        <a href="{{ route('reception-preparations.create', $data) }}" class="dropdown-item">
            <i class="bi bi-check2-circle mr-2 text-success" style="line-height: 1;"></i> Enviar a ZNE Preparación.
        </a>
    @endif
@endcan
@can('delete_receptions')
    <button id="delete" class="dropdown-item"
        onclick="
                event.preventDefault();
                if (confirm('Are you sure? It will delete the data permanently!')) {
                document.getElementById('destroy{{ $data->id }}').submit()
                }">
        <i class="bi bi-trash mr-2 text-danger" style="line-height: 1;"></i> Eliminar
        <form id="destroy{{ $data->id }}" class="d-none" action="{{ route('receptions.destroy', $data->id) }}"
            method="POST">
            @csrf
            @method('delete')
        </form>
    </button>
@endcan
{{-- </div>
</div> --}}
