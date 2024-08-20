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
                        @can('access_dirty_area')
                            <div class="col-md-6 col-lg-3">
                                <div class="card border-0">
                                    <div class="card-body p-0 d-flex align-items-center shadow-sm">
                                        <div class="bg-gradient-primary p-4 mfe-3 rounded-left">
                                            <i class="bi bi-caret-down-square font-4xl"></i>
                                        </div>
                                        <div>
                                            <div class="text-muted text-uppercase font-weight-bold small">Módulo Recepción</div>
                                            <div class="text-value text-primary"><a href="{{ route('receptions.index') }}">Ver todos
                                                    los ingresos</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endcan
                        @can('access_zne_area')
                            <div class="col-md-6 col-lg-3">
                                <div class="card border-0">
                                    <div class="card-body p-0 d-flex align-items-center shadow-sm">
                                        <div class="bg-gradient-warning-primary p-4 mfe-3 rounded-left">
                                            <img src="{{ URL::to('assets/img/logos_equipos/LOGO-STEAM.png') }}" height="60">
                                        </div>
                                        <div>
                                            <div class="text-muted text-uppercase font-weight-bold small"> MÓDULO PREPARACIÓN</div>
                                            <div class="text-value text-primary"><a href="{{ route('preparations.index') }}">Stock
                                                    en Preparación</a>
                                            </div>
                                            @can('access_labelqrs')
                                                <div class="text-value text-primary"><a href="{{ route('labelqrs.create') }}">Generar
                                                        Etiqueta</a>
                                                </div>
                                            @endcan
                                            @can('create_Testbds')
                                                <div class="text-muted text-uppercase font-weight-bold small"> MÓDULO TEST DE BOWIE &
                                                    DICK</div>
                                                <div class="text-value text-primary"><a href="{{ route('testbds.index') }}">Ver
                                                        Test de B&D</a>
                                                </div>
                                            @endcan
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-3">
                                <div class="card border-0">
                                    <div class="card-body p-0 d-flex align-items-center shadow-sm">
                                        <div class="bg-gradient-primary p-4 mfe-3 rounded-left">
                                            <h1>HPO</h1>
                                        </div>

                                        <div>
                                            <div class="text-muted text-uppercase font-weight-bold small"> MÓDULO PREPARACIÓN</div>
                                            <div class="text-value text-primary"><a
                                                    href="{{ route('preparations.index') }}">Instrumental en Preparación</a>
                                            </div>
                                            @can('access_labelqrs')
                                                <div class="text-value text-primary"><a href="{{ route('labelqrshpo.create') }}">Generar
                                                        Etiqueta</a>
                                                </div>
                                            @endcan

                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endcan
                        @can('access_esteril_area')
                            <div class="col-md-6 col-lg-3">
                                <div class="card border-0">
                                    <div class="card-body p-0 d-flex align-items-center shadow-sm">
                                        <div class="bg-gradient-primary p-4 mfe-3 rounded-left">
                                            <h1>DES</h1>
                                        </div>

                                        <div>
                                            @can('create_discharges')
                                                <div class="text-muted text-uppercase font-weight-bold small">MÓDULO DE DESCARGA
                                                </div>
                                                <div class="text-value text-primary"><a
                                                        href="{{ route('discharges.index') }}">Liberación de Ciclos</a>
                                                </div>
                                            @endcan
                                            @can('access_almacen_area')
                                                <div>
                                                    <div class="text-muted text-uppercase font-weight-bold small">MÓDULO DE
                                                        ALMACÉN Y DESPACHO.
                                                    </div>
                                                    <div class="text-value text-primary"><a href="{{ route('stocks.index') }}">Stock
                                                            Esteril</a>
                                                    </div>
                                                    @can('access_expedition')
                                                        <div class="text-value text-primary"><a href="{{ route('expeditions.index') }}">VER
                                                                DESPACHOS</a>
                                                        </div>
                                                    @endcan

                                                </div>
                                            @endcan
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endcan

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
                                Resultado de Test de Bowie & Dick  / Vacío (7 días Últimos)
                            </div>
                            <div class="card-body">
                                <canvas id="testBowiesChart"></canvas>
                            </div>
                        </div>
                    </div>
                @endcan
                @can('show_test_vacuum')
                    <div class="col-lg-6">
                        <div class="card border-0 shadow-sm h-100">
                            <div class="card-header">
                                Overview of Tests {{ now()->format('F, Y') }}
                            </div>
                            <div class="card-body d-flex justify-content-center">
                                <div class="chart-container" style="position: relative; height:auto; width:280px">
                                    <canvas id="currentMonthChart"></canvas>
                                </div>
                                <div class="chart-container" style="position: relative; height:auto; width:290px">
                                    <canvas id="currentMonthChart2"></canvas>
                                </div>
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
                                Producción Mensual Esterilización.
                            </div>
                            <div class="card-body">
                                <canvas id="ProductionsChart"></canvas>
                            </div>
                            
                        </div>
                    </div>
                @endcan
                @can('show_production_hpo')
                    <div class="col-lg-6">
                        <div class="card border-0 shadow-sm h-100">
                            <div class="card-header">
                                Instrumental Procesado ( Etiquetas Generadas).
                            </div>
                            <div class="card-body">
                                <canvas id="ProductionlabelsChart"></canvas>
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
                                Resultado de liberación del Biologicos.
                            </div>
                            <div class="card-body">
                                <canvas id="BiologicChart"></canvas>
                            </div>
                        </div>
                    </div>
                @endcan
                @can('show_biologic_hpo')
                    <div class="col-lg-6">
                        <div class="card border-0 shadow-sm h-100">
                            <div class="card-header">
                                Rendimiento Areas Central.
                            </div>
                            <div class="card-body">
                                <canvas id="CentralChart"></canvas>
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
