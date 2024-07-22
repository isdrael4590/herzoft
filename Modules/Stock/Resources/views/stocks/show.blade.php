@extends('layouts.app')

@section('title', ' Detalles Etiquetas Generadas' )

@section('breadcrumb')
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('stocks.index') }}">Stocks Generadas</a></li>
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
                            Referencia: <strong>{{ $stock->reference }}</strong>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row mb-4">
                            <div class="col-sm-3 mb-3 mb-md-0">
                                <h5 class="mb-2 border-bottom pb-2">Institución:</h5>
                                <div><strong>{{ Institutes()->institute_code }}</strong></div>
                                <div> <strong>Hospital:</strong> {{ Institutes()->institute_name }}</div>
                                <div><strong>Dirección:</strong>  {{ Institutes()->institute_address }}</div>
                                <div><strong>Área:</strong>  {{ Institutes()->institute_area }}</div>
                                <div><strong>Ciudad:</strong> {{ Institutes()->institute_city }}</div>
                                <div> <strong>País:</strong>{{ Institutes()->institute_country }}</div>
                            </div>

                            <div class="col-sm-3 mb-3 mb-md-0">
                                <h4 class="mb-2 border-bottom pb-2">Información de Proceso:</h4>
                                
                                <div><strong>Equipo:</strong> {{ $stock->machine_name }}</div>
                                <div><strong>Lote del Equipo:</strong> {{ $stock->lote_machine }}</div>
                                <div><strong>Lote del Biológico:</strong> {{ $stock->lote_biologic }}</div>
                                <div><strong>Temperatura del Ambiente: </strong> {{ $stock->temp_ambiente }}</div>
                                <div><strong>Operario:</strong> {{ $stock->operator }}</div>
                            </div>

                            <div class="col-sm-3 mb-3 mb-md-0">
                                <h5 class="mb-2 border-bottom pb-2">Registro INFO:</h5>
                                <div>Número: <strong>{{ $stock->reference }}</strong></div>
                                <div><strong>Fecha Stock: </strong>{{ \Carbon\Carbon::parse($stock->created_up)->format('d M, Y') }}</div>
                               
                            </div>
                            <div class="col-sm-3 mb-3 mb-md-0">
                                <h4 class="mb-2 border-bottom pb-2">QR de Stock:</h4>
                                {!! QrCode::size(150)->style('square')->generate( "$stock->reference"." // Equipo: "."$stock->machine_name"." // Lote: "."$stock->lote_machine"." // Fecha: "."$stock->created_up") !!}
                            </div>
                        </div>

                        <div class="table-responsive-sm">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th class="align-middle">Código del Instrumental</th>
                                        <th class="align-middle">Descripción</th>
                                        <th class="align-middle">Tipo de Envoltura</th>
                                        <th class="align-middle">Disponibilidad</th>
                                        <th class="align-middle">Fecha de esterilización </th>
                                        <th class="align-middle">Fecha de Vencimiento</th>
                                        <th class="align-middle">Tipo de Esterilización</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($stock->stockDetails as $item)
                                        <tr>
                                            <td class="align-middle">
                                                {{ $item->product_name }} <br>
                                            </td>
                                            <td class="align-middle"> <span class="badge badge-success">
                                                {{ $item->product_code }}
                                            </span></td>
                                            <td class="align-middle">
                                                {{ $item->product_package_wrap }}
                                            </td>
                                            <td class="align-middle">
                                                {{ $item->product_status_stock}}
                                            </td>
                                            <td class="align-middle">
                                                {{ $item->product_date_sterilized }}
                                            </td>
                                            <td class="align-middle">
                                                {{ $item->product_expiration }}
                                            </td>
                                            <td class="align-middle">
                                                {{ $item->product_type_process }}
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
