@extends('layouts.app')

@section('title', 'Test Vacio Details')

@section('breadcrumb')
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('testvacuums.index') }}">Test vacio</a></li>
        <li class="breadcrumb-item active">Detalles</li>
    </ol>
@endsection

@section('content')
    <div class="container-fluid mb-4">
        
        <div class="row">
            <div class="col-lg-9">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped mb-0">
                                <tr>
                                    <th>Referencia del Test de Vacio</th>
                                    <td>{{ $testvacuum->testvacuum_reference }}</td>
                                </tr>
                                <tr>
                                    <th>Nombre del Equipo</th>
                                    <td>{{ $testvacuum->machine_name }}</td>
                                </tr>
                                <tr>
                                    <th>Lote del Equipo</th>
                                    <td>{{ $testvacuum->lote_machine }}</td>
                                </tr>
                                <tr>
                                    <th>Temperatura del Equipo</th>
                                    <td>{{ $testvacuum->temp_machine}}</td>
                                </tr>
                                
                                <tr>
                                    <th>Lote del insumo </th>
                                    <td>{{ $testvacuum->lote_vacuum }}</td>
                                </tr>
                                
                                <tr>
                                    <th>RESULTADO DEL PROCESO</th>
                                    <td>{{ $testvacuum->validation_vacuum }}</td>
                                </tr>
                                <tr>
                                    <th>Temperatura del ambiente</th>
                                    <td>{{ $testvacuum->temp_ambiente }}</td>
                                </tr>
                                <tr>
                                    <th>Operario</th>
                                    <td>{{ $testvacuum->operator }}</td>
                                </tr>
                                <tr>
                                    <th>Nota</th>
                                    <td>{{ $testvacuum->observation ?? 'N/A' }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection



