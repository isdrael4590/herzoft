@foreach ($data->getPermissionNames() as $permission)
    <span class="badge badge-light border mr-1 mb-1"
        style="font-size:.72rem;padding:4px 8px;border-radius:20px;color:#4f46e5;border-color:#c7d2fe !important;background:#eef2ff;">
        <i class="bi bi-key mr-1" style="font-size:.65rem;"></i>{{ $permission }}
    </span>
@endforeach
@can('edit_roles')
    <a class="btn btn-outline-primary btn-sm ml-1" href="{{ route('roles.edit', $data->id) }}" title="Editar permisos"
        style="border-radius:6px;font-size:.75rem;padding:2px 8px;">
        <i class="bi bi-pencil"></i>
    </a>
@endcan
