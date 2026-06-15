<a href="{{ route('descarga-lavado.show', $data->id) }}" class="dropdown-item">
    <i class="bi bi-eye mr-2 text-info" style="line-height: 1;"></i> Detalles
</a>

@can('edit_wash_area')
    @if (!in_array($data->status_ciclo, ['Ciclo Correcto', 'Ciclo con Falla']))
        <a href="{{ route('descarga-lavado.edit', $data->id) }}" class="dropdown-item">
            <i class="bi bi-pencil mr-2 text-primary" style="line-height: 1;"></i> Liberar Lavado
        </a>
    @endif
@endcan
@can('access_admin')
    <a href="{{ route('descarga-lavado.edit', $data->id) }}" class="dropdown-item">
        <i class="bi bi-clock-history mr-2 text-secondary" style="line-height: 1;"></i> Editar Admin
    </a>
@endcan

@can('create_reception_preparations')
    @if ($data->status_ciclo === 'Ciclo Correcto' && $data->status_indicador !== 'Falla' && $data->status !== 'Procesado')
        <a href="{{ route('lavado-preparations.create', $data->id) }}" class="dropdown-item">
            <i class="bi bi-arrow-right-circle mr-2 text-success" style="line-height: 1;"></i> Enviar a Preparación
        </a>
    @endif
@endcan

<button class="dropdown-item"
    onclick="
        event.preventDefault();
        if (confirm('¿Está seguro? Desea eliminar permanentemente esta descarga.')) {
            document.getElementById('destroy-des{{ $data->id }}').submit()
        }">
    <i class="bi bi-trash mr-2 text-danger" style="line-height: 1;"></i> Eliminar
    <form id="destroy-des{{ $data->id }}" class="d-none" action="{{ route('descarga-lavado.destroy', $data->id) }}"
        method="POST">
        @csrf
        @method('DELETE')
    </form>
</button>
