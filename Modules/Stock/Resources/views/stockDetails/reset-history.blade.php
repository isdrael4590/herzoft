@extends('layouts.app')

@section('title', 'Historial de Reseteos - Stock')

@section('breadcrumb')
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('stockDetails.index') }}">Disponibilidad Stock</a></li>
        <li class="breadcrumb-item active">Historial de Reseteos</li>
    </ol>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-header bg-white border-bottom d-flex align-items-center justify-content-between">
                        <h5 class="mb-0">
                            <i class="bi bi-clock-history"></i> Historial de Reseteos de Stock
                        </h5>
                        <a href="{{ route('stockDetails.index') }}" class="btn btn-secondary btn-sm">
                            <i class="bi bi-arrow-left"></i> Volver
                        </a>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-striped align-middle">
                                <thead class="table-dark">
                                    <tr>
                                        <th class="text-center">Fecha Reset</th>
                                        <th class="text-center">Usuario</th>
                                        <th class="text-center">Nombre del Producto</th>
                                        <th class="text-center">Código</th>
                                        <th class="text-center">Área</th>
                                        <th class="text-center">Embalaje</th>
                                        <th class="text-center">Cant. Anterior</th>
                                        <th class="text-center">Cant. Nueva</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($resets as $reset)
                                        <tr>
                                            <td class="text-center">
                                                {{ \Carbon\Carbon::parse($reset->reset_at)->format('d M, Y H:i:s') }}
                                            </td>
                                            <td class="text-center">
                                                <span class="badge bg-primary">
                                                    <i class="bi bi-person-fill"></i>
                                                    {{ optional($reset->user)->name ?? 'N/A' }}
                                                </span>
                                            </td>
                                            <td class="text-center">{{ $reset->product_name }}</td>
                                            <td class="text-center"><code>{{ $reset->product_code }}</code></td>
                                            <td class="text-center">{{ $reset->product_area ?? '-' }}</td>
                                            <td class="text-center">{{ $reset->product_package_wrap ?? '-' }}</td>
                                            <td class="text-center">
                                                <span class="badge bg-warning text-dark">{{ $reset->previous_quantity }}</span>
                                            </td>
                                            <td class="text-center">
                                                <span class="badge bg-secondary">{{ $reset->new_quantity }}</span>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="8" class="text-center text-muted py-4">
                                                No hay historial de reseteos registrado.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <div class="d-flex justify-content-center mt-3">
                            {{ $resets->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
