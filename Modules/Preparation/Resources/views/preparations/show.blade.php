@extends('layouts.app')

@section('title', ' Detalles Matertial en preparación')

@section('breadcrumb')
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('preparations.index') }}">Matertial en preparación</a></li>
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
                            Reference: <strong>{{ $preparation->reference }}</strong>
                        </div>

                    </div>


                    <div class="table-responsive-sm">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th class="align-middle">Código del Instrumental</th>
                                    <th class="align-middle">Descripción</th>
                                    <th class="align-middle">Area Proviene</th>
                                    <th class="align-middle">Estado</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($preparation->preparationDetails as $item)
                                    <tr>
                                        <td class="align-middle">
                                            {{ $item->product_name }} <br>
                                        </td>
                                        <td class="align-middle"> <span class="badge badge-success">
                                                {{ $item->product_code }}
                                            </span></td>
                                        <td class="align-middle">
                                            {{ $item->product_coming_zone }}
                                        </td>
                                        <td class="align-middle">
                                            {{ $item->product_state_preparation }}
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

@endsection
