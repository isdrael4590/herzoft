@extends('layouts.app')

@section('title', 'reception Detalles')

@section('breadcrumb')
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('receptions.index') }}">Recepción de instrumental</a></li>
        <li class="breadcrumb-item active">Detalles</li>
    </ol>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
          
                    <div class="card-body">
                        <div class="row mb-4">
                            <div class="col-sm-4 mb-3 mb-md-0">
                                <h5 class="mb-2 border-bottom pb-2">Institución:</h5>
                                <div><strong>{{ institutes()->institute_code }}</strong></div>
                                <div>{{ Institutes()->institute_name }}</div>
                                <div>Dirección: {{ Institutes()->institute_address }}</div>
                                <div>Área: {{ Institutes()->institute_area }}</div>
                                <div>Ciudad: {{ Institutes()->institute_city }}</div>
                                <div>País: {{ Institutes()->institute_country }}</div>
                            </div>

                            <div class="col-sm-4 mb-3 mb-md-0">
                                <h5 class="mb-2 border-bottom pb-2">Información de ingreso:</h5>
                                <div>Persona que entrega: {{ $reception->delivery_staff }}</div>
                                <div>Área Procedente: {{ $reception->area }}</div>
                                <div>Persona que recibe: {{ $reception->operator }}</div>
                            </div>

                            <div class="col-sm-4 mb-3 mb-md-0">
                                <h5 class="mb-2 border-bottom pb-2">Registro INFO:</h5>
                                <div>Número: <strong>{{ $reception->reference }}</strong></div>
                                <div>Fecha: {{ \Carbon\Carbon::parse($reception->created_up)->format('d M, Y') }}</div>
                                <div>
                                    Status: <strong>{{ $reception->status }}</strong>
                                </div>
                            
                            </div>

                        </div>

                        <div class="table-responsive-sm">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th class="align-middle">Códigop del Instrumental</th>
                                        <th class="align-middle">Descripción</th>
                                        <th class="align-middle">Nivel de infección</th>
                                        <th class="align-middle">Estado</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($reception->receptionDetails as $item)
                                        <tr>
                                            <td class="align-middle">
                                                {{ $item->product_name }} <br>
                                               
                                            </td>

                                            <td class="align-middle"> <span class="badge badge-success">
                                                {{ $item->product_code }}
                                            </span></td>

                                            <td class="align-middle">
                                                {{ $item->product_type_dirt }}
                                            </td>

                                            <td class="align-middle">
                                                {{ ($item->product_state_rumed) }}
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
