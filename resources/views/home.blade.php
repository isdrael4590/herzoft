@extends('layouts.app')

@section('title', 'Home')

@section('breadcrumb')
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item active">Home</li>
    </ol>
@endsection

@section('content')
    <?php
    $hour = date('G');
    $minute = date('i');
    $second = date('s');
    $msg = ' Today is ' . date('l, M. d, Y.');
    
    if ($hour == 00 && $hour <= 9 && $minute <= 59 && $second <= 59) {
        $greet = 'Buenos dias,';
    } elseif ($hour >= 10 && $hour <= 11 && $minute <= 59 && $second <= 59) {
        $greet = 'Buen dia,';
    } elseif ($hour >= 12 && $hour <= 15 && $minute <= 59 && $second <= 59) {
        $greet = 'Buenas Tardes,';
    } elseif ($hour >= 16 && $hour <= 23 && $minute <= 59 && $second <= 59) {
        $greet = 'Buenas noches,';
    } else {
        $greet = 'Bienvenido,';
    }
    ?>
    <div class="container-fluid">

        <div class="row">
            <div class="col-sm-12">
                <h8 class="page-title">{{ $greet }}{{ Session::get('name') }}!</h8>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item active">Panel Principal</li>
                </ul>
            </div>
        </div>


        @can('show_total_stats')
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-6 col-lg-4">
                            <div class="card border-0">
                                <div class="card-body p-0 d-flex align-items-center shadow-sm">
                                    <div class="bg-gradient-primary p-4 mfe-3 rounded-left">
                                        <i class="bi bi-caret-down-square font-4xl"></i>
                                    </div>
                                    <div>
                                        <div class="text-muted text-uppercase font-weight-bold small">Recepción</div>
                                        <div class="text-value text-primary">Aquí va el valor</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4">
                            <div class="card border-0">
                                <div class="card-body p-0 d-flex align-items-center shadow-sm">
                                    <div class="bg-gradient-warning-primary p-4 mfe-3 rounded-left">
                                        <img src="{{ URL::to('assets/img/logos_equipos/LOGO-STEAM.png') }}" height="60">
                                    </div>
                                    <div>
                                        <div class="text-muted text-uppercase font-weight-bold small">EQUIPOS VAPOR</div>
                                        <div class="text-muted text-uppercase font-weight-bold small">Vapor 1</div>
                                        <div class="text-value text-primary">Aquí va el valor 1</div>
                                        <div class="text-muted text-uppercase font-weight-bold small">Vapor 2</div>
                                        <div class="text-value text-primary">Aquí va el valor 2</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4">
                            <div class="card border-0">
                                <div class="card-body p-0 d-flex align-items-center shadow-sm">
                                    <div class="bg-gradient-primary p-4 mfe-3 rounded-left">
                                        <h1>HPO</h1>
                                    </div>
                                    <div>
                                        <div class="text-muted text-uppercase font-weight-bold small">EQUIPOS BAJA TEMPERATURA
                                        </div>
                                        <div></div>
                                        <div class="text-muted text-uppercase font-weight-bold small"><img
                                                src="{{ URL::to('assets/img/logos_equipos/logo_matachana.png') }}"
                                                height="10"> 130HPO</div>
                                        <div></div>
                                        <div class="text-value text-primary">Aquí va el valor 1</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endcan

        @can('show_test')
            <div class="row mb-4">
                @can('show_test_bd')
                    <div class="col-lg-6">
                        <div class="card border-0 shadow-sm h-100">
                            <div class="card-header">
                                Test de Bowie & Dick
                            </div>
                            <div class="card-body">
                                <canvas id="testBowie"></canvas>
                            </div>
                        </div>
                    </div>
                @endcan
                @can('show_test_vacuum')
                    <div class="col-lg-6">
                        <div class="card border-0 shadow-sm h-100">
                            <div class="card-header">
                                Test de Vacío
                            </div>
                            <div class="card-body">
                                <canvas id="testVacuum"></canvas>
                            </div>
                        </div>
                    </div>
                @endcan
            </div>
        @endcan

        @can('show_production')
            <div class="row mb-4">
                @can('show_production_steam')
                    <div class="col-lg-6">
                        <div class="card border-0 shadow-sm h-100">
                            <div class="card-header">
                                Producción De Equipos de Vapor.
                            </div>
                            <div class="card-body">
                                <canvas id="ProductionSteam"></canvas>
                            </div>
                        </div>
                    </div>
                @endcan
                @can('show_production_hpo')
                    <div class="col-lg-6">
                        <div class="card border-0 shadow-sm h-100">
                            <div class="card-header">
                                Producción De Equipos de Peróxido.
                            </div>
                            <div class="card-body">
                                <canvas id="ProductionHPO"></canvas>
                            </div>
                        </div>
                    </div>
                @endcan
            </div>
        @endcan

        @can('show_biologic')
            <div class="row mb-4">
                @can('show_biologic_steam')
                    <div class="col-lg-6">
                        <div class="card border-0 shadow-sm h-100">
                            <div class="card-header">
                                Resultado de liberación del Biologico Vapor.
                            </div>
                            <div class="card-body">
                                <canvas id="BiologicSteam"></canvas>
                            </div>
                        </div>
                    </div>
                @endcan
                @can('show_biologic_hpo')
                    <div class="col-lg-6">
                        <div class="card border-0 shadow-sm h-100">
                            <div class="card-header">
                                Resultado de liberación del Biologico Peróxido.
                            </div>
                            <div class="card-body">
                                <canvas id="BiologicHPO"></canvas>
                            </div>
                        </div>
                    </div>
                @endcan
            </div>
        @endcan


    </div>
@endsection

@section('third_party_scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.5.0/chart.min.js"
        integrity="sha512-asxKqQghC1oBShyhiBwA+YgotaSYKxGP1rcSYTDrB0U6DxwlJjU59B67U8+5/++uFjcuVM8Hh5cokLjZlhm3Vg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endsection

@push('page_scripts')
    @vite('resources/js/chart-config.js')
@endpush
