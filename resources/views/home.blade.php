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
        @can('show_total_stats')
            <div class="row">
                <div class="col-sm-12">
                    <h8 class="page-title">{{ $greet }}{{ Session::get('name') }}!</h8>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item active">Panel Principal</li>
                    </ul>
                </div>
            </div>
        @endcan

        @can('show_total_stats')
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-6 text-center">
                            <div class="card">
                                <div class="card-body">
                                    <h6>EQUIPOS VAPOR <img src="{{ URL::to('assets/img/logos_equipos/LOGO-STEAM.png') }}"
                                            height="100"> </h6>
                                    <h8>LOTE ACTUAL : </h8>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 text-center">
                            <div class="card">
                                <div class="card-body">
                                    <h6>EQUIPOS BAJA TEMPERATURA <img src="{{ URL::to('assets/img/logos_equipos/130HPO.png') }}"
                                            height="60"></h6>
                                    <h8>LOTE ACTUAL : </h8>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endcan

        @can('show_test')
            <div class="row">
                <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                    <div class="card dash-widget">
                        <h8 class="text-center">NUMERO DE TEST DE BOWIE </h8>
                        <div class="card-body"> <span class="dash-widget-icon"><i class="fa fa-cubes"></i></span>
                            <div class="dash-widget-info">
                                <h8>112</h8>
                                <h1><img src="{{ URL::to('assets/img/logos_equipos/logo_matachana.png') }}" height="20"> 
                                </h1>
                            </div>
                        </div>

                        <div class="card-body"> <span class="dash-widget-icon"><i class="fa fa-cubes"></i></span>
                            <div class="dash-widget-info">
                                <h8>1112</h8>
                                <h1><img src="{{ URL::to('assets/img/logos_equipos/logo_matachana.png') }}" height="20"> 
                                </h1>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">

                    <div class="card dash-widget">
                        <h8 class="text-center">NUMERO DE CICLOS </h8>
                        <div class="card-body"> <span class="dash-widget-icon"><i class="fa fa-usd"></i></span>
                            <div class="dash-widget-info">
                                <h8>1112</h8>
                                <h1><img src="{{ URL::to('assets/img/logos_equipos/logo_matachana.png') }}" height="20"> 
                                </h1>
                            </div>
                        </div>
                        <div class="card-body"> <span class="dash-widget-icon"><i class="fa fa-usd"></i></span>
                            <div class="dash-widget-info">
                                <h8>1112</h8>
                                <h1><img src="{{ URL::to('assets/img/logos_equipos/logo_matachana.png') }}" height="20"> 
                                </h1>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                    <div class="card dash-widget">
                        <h8 class="text-center">NUMERO DE TEST DE VACIO </h8>

                        <div class="card-body"> <span class="dash-widget-icon"><i class="fa fa-cubes"></i></span>
                            <div class="dash-widget-info">
                                <h8>1112</h8>
                                <h2><img src="{{ URL::to('assets/img/logos_equipos/130HPO.png') }}" height="40"> </h2>
                            </div>
                        </div>

                        <div class="card-body"> <span class="dash-widget-icon"><i class="fa fa-cubes"></i></span>
                            <div class="dash-widget-info">
                                <h8>1112</h8>
                                <h2><img src="{{ URL::to('assets/img/logos_equipos/LOGO_130LF.png') }}" height="30"></h2>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">

                    <div class="card dash-widget">
                        <h8 class="text-center">NUMERO DE CICLOS </h8>
                        <div class="card-body"> <span class="dash-widget-icon"><i class="fa fa-usd"></i></span>
                            <div class="dash-widget-info">
                                <h8>1112</h8>
                                <h2><img src="{{ URL::to('assets/img/logos_equipos/130HPO.png') }}" height="40"> </h2>
                            </div>
                        </div>
                        <div class="card-body"> <span class="dash-widget-icon"><i class="fa fa-usd"></i></span>
                            <div class="dash-widget-info">
                                <h8>1112</h8>
                                <h2><img src="{{ URL::to('assets/img/logos_equipos/LOGO_130LF.png') }}" height="30"></h2>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        @endcan
        @can('show_rendimiento')
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-6 text-center">
                            <div class="card">
                                <div class="card-body">
                                    <h8 class="card-title">Rendimiento de Funcionalidad <img
                                            src="{{ URL::to('assets/img/logos_equipos/LOGO-STEAM.png') }}" height="100"></h8>
                                    <div id="bar-charts"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 text-center">
                            <div class="card">
                                <div class="card-body">
                                    <h8 class="card-title">PRODUCCION <img
                                            src="{{ URL::to('assets/img/logos_equipos/LOGO-STEAM.png') }}" height="100"></h8>
                                    <div id="line-charts"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-6 text-center">
                            <div class="card">
                                <div class="card-body">
                                    <h8 class="card-title">Rendimiento de Incubacion <img
                                            src="{{ URL::to('assets/img/logos_equipos/LOGO-STEAM.png') }}" height="100">
                                    </h8>
                                    <div id="bar-charts2"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 text-center">
                            <div class="card">
                                <div class="card-body">
                                    <h8 class="card-title">Rendimiento de Incubacion <img
                                            src="{{ URL::to('assets/img/logos_equipos/130HPO.png') }}" height="50"></h8>
                                    <div id="line-charts2"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
   {{-- @vite('resources/js/chart-config.js')--}}
@endpush
