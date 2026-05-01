@extends('layouts.app')

@section('title', 'Instrumental a Lavar')

@section('breadcrumb')
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item active">Instrumental a Lavar</li>
    </ol>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card border-0" style="border-radius:12px;box-shadow:0 2px 20px rgba(0,0,0,0.08);">
                    <div class="card-header border-0 d-flex align-items-center justify-content-between"
                        style="background:linear-gradient(135deg,#f8fafc,#f1f5f9);border-radius:12px 12px 0 0;padding:14px 24px;border-left:4px solid #0ea5e9;">
                        <div class="d-flex align-items-center">
                            <i class="bi bi-droplet-half text-info mr-2"></i>
                            <span class="font-weight-bold text-secondary"
                                style="font-size:.85rem;letter-spacing:.5px;text-transform:uppercase;">
                                Instrumental pendiente de prelavado
                            </span>
                        </div>
                        @can('create_wash_area')
                            <a href="{{ route('lavados.create') }}" class="btn btn-primary btn-sm"
                                style="border-radius:8px;font-weight:600;">
                                <i class="bi bi-plus mr-1"></i> Registrar Lavado
                            </a>
                        @endcan
                    </div>
                    <div class="card-body" style="padding:24px;">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0" id="prelavado-table">
                                <thead style="background:#f8fafc;">
                                    <tr>
                                        <th style="font-size:.8rem;font-weight:700;color:#64748b;">Nombre del Producto</th>
                                        <th class="text-center" style="font-size:.8rem;font-weight:700;color:#64748b;">Código del Producto</th>
                                        <th class="text-center" style="font-size:.8rem;font-weight:700;color:#64748b;">Cantidad Total</th>
                                        <th class="text-center" style="font-size:.8rem;font-weight:700;color:#64748b;">Historial</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($prelavados as $item)
                                        @if($item->total_quantity == 0 && !auth()->user()->hasAnyRole(['Admin', 'Super Admin', 'supervisor']))
                                            @continue
                                        @endif
                                        <tr>
                                            <td class="align-middle" style="font-size:.875rem;">{{ $item->product_name }}</td>
                                            <td class="align-middle text-center">
                                                <span class="badge badge-info" style="font-size:.8rem;padding:5px 10px;">
                                                    {{ $item->product_code }}
                                                </span>
                                            </td>
                                            <td class="align-middle text-center">
                                                <span style="font-weight:700;font-size:.95rem;color:#0f172a;">
                                                    {{ $item->total_quantity }}
                                                </span>
                                            </td>
                                            <td class="align-middle text-center">
                                                <a href="{{ route('prelavado.historial', urlencode($item->product_code)) }}"
                                                    class="btn btn-sm btn-outline-primary"
                                                    style="border-radius:6px;font-size:.8rem;font-weight:600;">
                                                    <i class="bi bi-clock-history mr-1"></i> Ver Historial
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center text-muted py-4">
                                                No hay instrumental pendiente de prelavado.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('page_scripts')
    <script>
        $(document).ready(function () {
            $('#prelavado-table').DataTable({
                order: [[2, 'desc']],
                language: { url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json' }
            });
        });
    </script>
@endpush
