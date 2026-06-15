@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title">Prelavado - Ingreso #{{ $reception->id }} ({{ $reception->reference }})</h3>
                    <a href="{{ route('prelavado.index') }}" class="btn btn-sm btn-secondary">Volver</a>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Código</th>
                                <th>Producto</th>
                                <th>Cantidad</th>
                                <th>Paciente</th>
                                <th>Área</th>
                                <th>Info</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($detalles as $detalle)
                                <tr>
                                    <td>{{ $detalle->product_code }}</td>
                                    <td>{{ $detalle->product_name }}</td>
                                    <td>{{ $detalle->product_quantity }}</td>
                                    <td>{{ $detalle->product_patient ?? '-' }}</td>
                                    <td>{{ $detalle->product_area ?? '-' }}</td>
                                    <td>{{ $detalle->product_info ?? '-' }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">Sin productos.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
