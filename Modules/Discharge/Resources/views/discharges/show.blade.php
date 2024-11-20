@extends('layouts.app')

@section('title', ' Detalles Ciclo Procesado')

@section('breadcrumb')
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('discharges.index') }}">Resumen del ciclo</a></li>
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
                            Referencia: <strong>{{ $discharge->reference }}</strong>
                        </div>
                        @can('print_discharges')
                            <a target="_blank" class="btn btn-sm btn-secondary mfs-auto mfe-1 d-print-none"
                                href="{{ route('discharges.pdf', $discharge->id) }}">
                                <i class="bi bi-printer"></i> Imprimir
                            </a>
                            <a target="_blank" class="btn btn-sm btn-info mfe-1 d-print-none"
                                href="{{ route('discharges.pdf', $discharge->id) }}">
                                <i class="bi bi-save"></i> Guardar
                            </a>
                        @endcan
                    </div>
                    <div class="card-body">
                        <div class="row mb-4">
                            <div class="col-sm-3 mb-3 mb-md-0">
                                <h5 class="mb-2 border-bottom pb-2">Institución:</h5>
                                <div><strong>{{ institutes()->institute_code }}</strong></div>
                                <div> <strong>Hospital:</strong> {{ institutes()->institute_name }}</div>
                                <div><strong>Dirección:</strong> {{ institutes()->institute_address }}</div>
                                <div><strong>Área:</strong> {{ institutes()->institute_area }}</div>
                                <div><strong>Ciudad:</strong> {{ institutes()->institute_city }}</div>
                                <div> <strong>País:</strong>{{ institutes()->institute_country }}</div>
                            </div>

                            <div class="col-sm-3 mb-3 mb-md-0">
                                <h4 class="mb-2 border-bottom pb-2">Información de Proceso:</h4>
                                <div><strong>Ref. Proceso:</strong> {{ $labelqr->reference }}</div>
                                <div><strong>Equipo:</strong> {{ $discharge->machine_name }}</div>
                                <div><strong>Lote del Equipo:</strong> {{ $discharge->lote_machine }}</div>
                                <div><strong>Lote Agente Esterilizante:</strong> {{ $discharge->lote_agente }}</div>
                                <div><strong>Temperatura del equipo:</strong> {{ $discharge->temp_machine }}</div>
                                <div><strong>Tipo de Programa:</strong> {{ $discharge->type_program }}</div>
                                <div><strong>Temperatura del Ambiente: </strong> {{ $discharge->temp_ambiente }}</div>
                                <div><strong>Operario:</strong> {{ $discharge->operator }}</div>
                            </div>

                            <div class="col-sm-3 mb-3 mb-md-0">
                                <h5 class="mb-2 border-bottom pb-2">Registro INFO:</h5>
                                <div>Número: <strong>{{ $discharge->reference }}</strong></div>
                                <div><strong>Fecha Proceso:
                                    </strong>{{ \Carbon\Carbon::parse($discharge->created_up)->format('d M, Y') }}</div>
                                <div><strong>Estado del Ciclo: </strong> {{ $discharge->status_cycle }}</div>
                                <div><strong>Lote del Biológico: </strong> {{ $discharge->lote_biologic }}</div>
                                <div><strong>Validación Biológico: </strong> {{ $discharge->validation_biologic }}</div>
                            </div>
                            <div class="col-sm-3 mb-3 mb-md-0">
                                <h4 class="mb-2 border-bottom pb-2">QR de Proceso:</h4>
                                {!! QrCode::size(150)->style('square')->generate(
                                        'Ref. Proces: ' .
                                            "$discharge->labelqr_id" .
                                            ' // Ref. Des: ' .
                                            "$discharge->reference" .
                                            ' // Equipo: ' .
                                            "$discharge->machine_name" .
                                            ' // Lote: ' .
                                            "$discharge->lote_machine" .
                                            ' // Fecha: ' .
                                            "$discharge->updated_at",
                                    ) !!}
                            </div>
                        </div>

                        <div class="table-responsive-sm">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th class="align-middle">Código del Instrumental</th>
                                        <th class="align-middle">Descripción</th>
                                        <th> Cantidad Procesada</th>
                                        <th class="align-middle">Cantidad Validad</th>
                                        <th class="align-middle">Tipo de Envoltura</th>
                                        <th class="align-middle">Validación Embalaje</th>
                                        <th class="align-middle">Tipo Ind. Químico</th>
                                        <th class="align-middle">Vencimiento</th>
                                        <th class="align-middle">Otra Info.</th>
                                        <th class="align-middle">QR Paquete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($discharge->dischargeDetails as $item)
                                        <tr>
                                            <td class="align-middle">
                                                {{ $item->product_name }} <br>
                                            </td>
                                            <td class="align-middle"> <span class="badge badge-success">
                                                    {{ $item->product_code }}
                                                </span></td>
                                            <td class="align-middle">
                                                {{ $item->product_quantity }}
                                            </td>
                                            <td class="align-middle">
                                                {{ $item->product_quantity }}
                                            </td>
                                            <td class="align-middle">
                                                {{ $item->product_package_wrap }}
                                            </td>
                                            <td class="align-middle">
                                                {{ $item->product_eval_package }}
                                            </td>
                                            <td class="align-middle">
                                                {{ $item->product_eval_indicator }}
                                            </td>
                                            <td class="align-middle">
                                                @if ($item->product_expiration >= 15)
                                                    @if ($item->product_expiration == 180)
                                                        6 Meses <br>
                                                    @elseif ($item->product_expiration == 270)
                                                    9 Meses <br>
                                                    @elseif ($item->product_expiration == 365)
                                                    12 Meses <br>
                                                    @elseif ($item->product_expiration == 545)
                                                    18 Meses <br>
                                                    @endif
                                                @else
                                                    {{ $item->product_expiration }} Días <br>
                                                @endif
                                                {!! Carbon\Carbon::parse($item->updated_at)->addDays($item->product_expiration)->format('d M, Y') !!}
                                            </td>
                                            <td class="align-middle">
                                                {{ $item->product_patient }} / [
                                                    {{ $item->product_outside_company }} 
                                                ]
                                            </td>
                                            <td class="align-middle">

                                                <div>
                                                    {!! QrCode::size(50)->style('square')->generate(
                                                            "$discharge->reference" .
                                                                ' // Lote: ' .
                                                                "$discharge->lote_machine" .
                                                                ' // Cod: ' .
                                                                "$item->product_code " .
                                                                ' // Elab: ' .
                                                                "$item->updated_at " .
                                                                ' // Venc: ' .
                                                                Carbon\Carbon::parse($item->updated_at)->addMonth($item->product_expiration),
                                                        ) !!}
                                                </div>
                                                <span>
                                                    Lote: {{ $discharge->lote_machine }} <br> Código:
                                                    {{ $item->product_code }}
                                                </span>


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
