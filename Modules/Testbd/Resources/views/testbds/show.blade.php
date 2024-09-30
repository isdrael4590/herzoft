@extends('layouts.app')

@section('title', 'Testbd Details')

@section('breadcrumb')
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('testbds.index') }}">Test Bd & Dick</a></li>
        <li class="breadcrumb-item active">Detalles</li>
    </ol>
@endsection

@section('content')
    <div class="container-fluid mb-4">

        <div class="row">

            <div class="col-lg-9">

                <div class="card h-100">

                    <div class="card-body">
                        @can('print_testbds')
                            <a target="_blank" class="btn btn-sm btn-secondary mfs-auto mfe-1 d-print-none"
                                href="{{ route('testbds.pdf', $testbd->id) }}">
                                <i class="bi bi-printer"></i> Imprimir
                            </a>
                        @endcan
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped mb-0">
                                <tr>
                                    <th>Referencia del Test de Bd & Dick</th>
                                    <td>{{ $testbd->testbd_reference }}</td>
                                </tr>
                                <tr>
                                    <th>Nombre del Equipo</th>
                                    <td>{{ $testbd->machine_name }}</td>
                                </tr>
                                <tr>
                                    <th>Lote del Equipo</th>
                                    <td>{{ $testbd->lote_machine }}</td>
                                </tr>
                                <tr>
                                    <th>Temperatura del Equipo</th>
                                    <td>{{ $testbd->temp_machine }}</td>
                                </tr>

                                <tr>
                                    <th>Lote del insumo </th>
                                    <td>{{ $testbd->lote_bd }}</td>
                                </tr>

                                <tr>
                                    <th>RESULTADO DEL PROCESO</th>
                                    <td>{{ $testbd->validation_bd }}</td>
                                </tr>
                                <tr>
                                    <th>Temperatura del ambiente</th>
                                    <td>{{ $testbd->temp_ambiente }}</td>
                                </tr>
                                <tr>
                                    <th>Operario</th>
                                    <td>{{ $testbd->operator }}</td>
                                </tr>
                                <tr>
                                    <th>Nota</th>
                                    <td>{{ $testbd->observation ?? 'N/A' }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
