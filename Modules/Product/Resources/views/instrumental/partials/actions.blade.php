@can('edit_products')
    <a href="{{ route('instrumental.edit', $data->id) }}" class="btn btn-info btn-sm" title="Editar">
        <i class="bi bi-pencil"></i>
    </a>
@endcan

@can('show_products')
    <a href="{{ route('instrumental.show', $data->id) }}" class="btn btn-primary btn-sm" title="Ver detalles">
        <i class="bi bi-eye"></i>
    </a>
@endcan

@can('delete_products')
    @if(is_null($data->product_id))
        {{-- ✅ Solo se puede eliminar si NO está enlazado a un producto --}}
        <button 
            id="delete" 
            class="btn btn-danger btn-sm" 
            title="Eliminar instrumental"
            onclick="
                event.preventDefault();
                if (confirm('¿Está seguro de eliminar este instrumental?\n\nCódigo: {{ $data->codigo_unico_ud }}\nNombre: {{ $data->nombre_generico }}\n\n⚠️ Esta acción es permanente y no se puede deshacer.')) {
                    document.getElementById('destroy{{ $data->id }}').submit()
                }
            ">
            <i class="bi bi-trash"></i>
        </button>
        <form id="destroy{{ $data->id }}" class="d-none" action="{{ route('instrumental.destroy', $data->id) }}" method="POST">
            @csrf
            @method('delete')
        </form>
    @else
        {{-- ❌ No se puede eliminar si está enlazado a un producto --}}
        <button 
            class="btn btn-secondary btn-sm" 
            title="🔒 Bloqueado: Este instrumental está asignado al paquete '{{ $data->product->product_name ?? 'Desconocido' }}'. Para eliminarlo, primero debe removerlo del paquete."
            disabled
            data-bs-toggle="tooltip"
            data-bs-placement="left"
            data-bs-html="true"
            data-bs-title="<strong>🔒 No se puede eliminar</strong><br><br>Este instrumental está asignado al paquete:<br><em>{{ $data->product->product_name ?? 'Desconocido' }}</em><br><br>Para eliminarlo, primero debe:<br>1. Editar el paquete<br>2. Remover este instrumental<br>3. Guardar cambios">
            <i class="bi bi-lock-fill"></i>
        </button>
    @endif
@endcan