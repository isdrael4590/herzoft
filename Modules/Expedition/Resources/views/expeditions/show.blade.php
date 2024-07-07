@extends('layouts.app')

@section('title', ' Detalles Despacho' )

@section('breadcrumb')
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('expeditions.index') }}">Resumen del despacho</a></li>
        <li class="breadcrumb-item active">Detalles</li>
    </ol>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header d-flex flex-wrap align-items-center">
                        <div>
                            Referencia: <strong>{{ $expedition->reference }}</strong>
                        </div>
                        
                        <a target="_blank" class="btn btn-sm btn-secondary mfs-auto mfe-1 d-print-none"
                            href="{{ route('expeditions.pdf', $expedition->id) }}">
                            <i class="bi bi-printer"></i> Imprimir
                        </a>
                        <a target="_blank" class="btn btn-sm btn-info mfe-1 d-print-none"
                            href="{{ route('expeditions.pdf', $expedition->id) }}">
                            <i class="bi bi-save"></i> Guardar
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="row mb-4">
                            <div class="col-sm-3 mb-3 mb-md-0">
                                <h5 class="mb-2 border-bottom pb-2">Institución:</h5>
                                <div><strong>{{ institutes()->institute_code }}</strong></div>
                                <div> <strong>Hospital:</strong> {{ institutes()->institute_name }}</div>
                                <div><strong>Dirección:</strong>  {{ institutes()->institute_address }}</div>
                                <div><strong>Área:</strong>  {{ institutes()->institute_area }}</div>
                                <div><strong>Ciudad:</strong> {{ institutes()->institute_city }}</div>
                                <div> <strong>País:</strong>{{ institutes()->institute_country }}</div>
                            </div>

                            <div class="col-sm-3 mb-3 mb-md-0">
                                <h4 class="mb-2 border-bottom pb-2">Información de Proceso:</h4>
                                
                                <div><strong>Temperatura del Ambiente: </strong> {{ $expedition->temp_ambiente }}</div>
                                <div><strong>Operario:</strong> {{ $expedition->operator }}</div>
                            </div>

                            <div class="col-sm-3 mb-3 mb-md-0">
                                <h5 class="mb-2 border-bottom pb-2">Registro INFO:</h5>
                                <div>Número: <strong>{{ $expedition->reference }}</strong></div>
                                <div><strong>Fecha Despacho: </strong>{{ \Carbon\Carbon::parse($expedition->created_up)->format('d M, Y') }}</div>
                                <div><strong>Estado del Despacho: </strong> {{ $expedition->status_expedition }}</div>
                                <div><strong>Persona quién Recibe: </strong> {{ $expedition->staff_expedition }}</div>

                            </div>
                            
                        </div>

                        <div class="table-responsive-sm">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Código </th>
                                        <th>Descripción</th>
                                        <th>Envoltura</th>
                                        <th>Expiración</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($expedition->expeditionDetails as $item)
                                        <tr>
                                            <td class="align-middle">
                                                {{ $item->product_code }} <br>
                                            </td>
                                            <td class="align-middle"> <span class="badge badge-success">
                                                {{ $item->product_name }}
                                            </span></td>
                                            <td class="align-middle">
                                                {{ $item->product_package_wrap }}
                                            </td>
                                            <td class="align-middle">
                                                {{ $item->product_expiration}}
                                            </td>
                                        
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
