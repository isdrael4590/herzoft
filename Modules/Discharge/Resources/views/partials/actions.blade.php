{{-- <div class="btn-group dropleft">
    <button type="button" class="btn btn-ghost-primary dropdown rounded" data-toggle="dropdown" aria-expanded="false">
        <i class="bi bi-three-dots-vertical"></i>
    </button>
    <div class="dropdown-menu"> --}}

@can('edit_discharges')
    <a href="{{ route('discharges.edit', $data->id) }}" class="dropdown-item">
        <i class="bi bi-pencil mr-2 text-primary" style="line-height: 1;"></i> Liberar
    </a>
@endcan
@can('show_discharges')
    @if (($data->status_cycle == 'Ciclo Aprobado') | ($data->status_cycle == 'Ciclo Falla'))
        <a href="{{ route('discharges.show', $data->id) }}" class="dropdown-item">
            <i class="bi bi-eye mr-2 text-info" style="line-height: 1;"></i> Detalles
        </a>
    @endif
@endcan
@can('print_discharges')
    @if (($data->status_cycle == 'Ciclo Aprobado') | ($data->status_cycle == 'Ciclo Falla'))
    <a href="{{ route('discharges.pdf', $data->id) }}" class="dropdown-item">
        <i class="bi bi-cursor mr-2 text-warning" style="line-height: 1;"></i> Imprimir
    </a>
    @endif
@endcan
@can('create_discharges_stock')
    @if (($data->status_cycle == 'Ciclo Aprobado') & ($data->validation_biologic == 'Correcto'))
        <a href="{{ route('discharges-stock.create', $data) }}" class="dropdown-item">
            <i class="bi bi-check2-circle mr-2 text-success" style="line-height: 1;"></i> Enviar a Almacén.
        </a>
    @elseif(($data->status_cycle == 'Ciclo Falla') | ($data->validation_biologic == 'Falla'))
        <a href="{{ route('discharges-preparation.create', $data) }}" class="dropdown-item">
            <i class="bi bi-check2-circle mr-2 text-success" style="line-height: 1;"></i> Enviar a Reprocesamiento.
        </a>
    @endif
@endcan


@can('delete_discharges')
    <button id="delete" class="dropdown-item"
        onclick="
                event.preventDefault();
                if (confirm('Are you sure? It will delete the data permanently!')) {
                document.getElementById('destroy{{ $data->id }}').submit()
                }">
        <i class="bi bi-trash mr-2 text-danger" style="line-height: 1;"></i> Eliminar
        <form id="destroy{{ $data->id }}" class="d-none" action="{{ route('discharges.destroy', $data->id) }}"
            method="POST">
            @csrf
            @method('delete')
        </form>
    </button>
@endcan


{{--    </div>
</div> --}}
