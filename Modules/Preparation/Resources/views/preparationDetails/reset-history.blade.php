@extends('layouts.app')

@section('title', 'Historial de Reseteos')

@section('breadcrumb')
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('preparationDetails.index') }}">Preparación</a></li>
        <li class="breadcrumb-item active">Historial de Reseteos</li>
    </ol>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Historial de Reseteos de Cantidades</h3>
                        <div class="card-tools">
                            <a href="{{ route('preparationDetails.index') }}" class="btn btn-sm btn-primary">
                                <i class="bi bi-arrow-left"></i> Volver
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Fecha y Hora</th>
                                        <th>Usuario</th>
                                        <th>Producto</th>
                                        <th>Código</th>
                                        <th>Área</th>
                                        <th>Cantidad Anterior</th>
                                        <th>Nueva Cantidad</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($resets as $reset)
                                        <tr>
                                            <td>{{ $reset->reset_at->format('d/m/Y H:i:s') }}</td>
                                            <td>{{ $reset->user->name }}</td>
                                            <td>{{ $reset->product_name }}</td>
                                            <td>{{ $reset->product_code }}</td>
                                            <td>{{ $reset->product_area }}</td>
                                            <td><span class="badge badge-warning">{{ $reset->previous_quantity }}</span></td>
                                            <td><span class="badge badge-success">{{ $reset->new_quantity }}</span></td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center">No hay registros de reseteos</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        
                        <div class="mt-3">
                            {{ $resets->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection