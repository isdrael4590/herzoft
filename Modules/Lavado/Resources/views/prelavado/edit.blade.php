@extends('layouts.app')

@section('title', 'Editar Prelavado')

@section('breadcrumb')
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('prelavado.index') }}">Instrumental a Lavar</a></li>
        <li class="breadcrumb-item active">Editar Ingreso #{{ $reception_id }}</li>
    </ol>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Editar Prelavado — Ingreso #{{ $reception_id }}
                        <small class="text-muted">({{ $detalles->first()->reception_reference }})</small>
                    </h5>
                    <a href="{{ route('prelavado.index') }}" class="btn btn-sm btn-secondary">Volver</a>
                </div>
                <div class="card-body">
                    <form action="{{ route('prelavado.update', $reception_id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>Código</th>
                                        <th>Producto</th>
                                        <th>Cantidad</th>
                                        <th>Paciente</th>
                                        <th>Área</th>
                                        <th>Info</th>
                                        <th>Empresa externa</th>
                                        <th>Tipo proceso</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($detalles as $detalle)
                                        <tr>
                                            <td>{{ $detalle->product_code }}</td>
                                            <td>{{ $detalle->product_name }}</td>
                                            <td>
                                                <input type="number" min="1"
                                                    name="detalles[{{ $detalle->id }}][product_quantity]"
                                                    value="{{ old('detalles.' . $detalle->id . '.product_quantity', $detalle->product_quantity) }}"
                                                    class="form-control form-control-sm" style="min-width:70px" readonly>
                                            </td>
                                            <td>
                                                <input type="text"
                                                    name="detalles[{{ $detalle->id }}][product_patient]"
                                                    value="{{ old('detalles.' . $detalle->id . '.product_patient', $detalle->product_patient) }}"
                                                    class="form-control form-control-sm" style="min-width:120px">
                                            </td>
                                            <td>
                                                <input type="text"
                                                    name="detalles[{{ $detalle->id }}][product_area]"
                                                    value="{{ old('detalles.' . $detalle->id . '.product_area', $detalle->product_area) }}"
                                                    class="form-control form-control-sm" style="min-width:100px">
                                            </td>
                                            <td>
                                                <input type="text"
                                                    name="detalles[{{ $detalle->id }}][product_info]"
                                                    value="{{ old('detalles.' . $detalle->id . '.product_info', $detalle->product_info) }}"
                                                    class="form-control form-control-sm" style="min-width:100px">
                                            </td>
                                            <td>
                                                <input type="text"
                                                    name="detalles[{{ $detalle->id }}][product_outside_company]"
                                                    value="{{ old('detalles.' . $detalle->id . '.product_outside_company', $detalle->product_outside_company) }}"
                                                    class="form-control form-control-sm" style="min-width:120px">
                                            </td>
                                            <td>
                                                <input type="text"
                                                    name="detalles[{{ $detalle->id }}][product_type_process]"
                                                    value="{{ old('detalles.' . $detalle->id . '.product_type_process', $detalle->product_type_process) }}"
                                                    class="form-control form-control-sm" style="min-width:120px" readonly>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-3">
                            <button type="submit" class="btn btn-warning">
                                <i class="bi bi-save"></i> Guardar cambios
                            </button>
                            <a href="{{ route('prelavado.index') }}" class="btn btn-secondary">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
