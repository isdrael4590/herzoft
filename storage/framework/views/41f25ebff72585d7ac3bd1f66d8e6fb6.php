<?php $__env->startSection('title', 'Home'); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item active">Home</li>
    </ol>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
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
                <h8 class="page-title"><?php echo e($greet); ?><?php echo e(Session::get('name')); ?>!</h8>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item active">Panel Principal</li>
                </ul>
            </div>
        </div>


        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('show_total_stats')): ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('access_dirty_area')): ?>
                            <div class="col-md-6 col-lg-2">
                                <div class="card border-0">
                                    <div class="card-body p-0 d-flex align-items-center shadow-sm">
                                        <div class="bg-gradient-primary p-4 mfe-3 rounded-left">
                                            <i class="bi bi-caret-down-square font-4xl"></i>
                                        </div>
                                        <div>
                                            <div class="text-muted text-uppercase font-weight-bold small">Módulo Recepción</div>
                                            <div class="text-value text-primary"><a href="<?php echo e(route('receptions.index')); ?>">Ver todos
                                                    los ingresos</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('access_zne_area')): ?>
                            <div class="col-md-6 col-lg-3">
                                <div class="card border-0">
                                    <div class="card-body p-0 d-flex align-items-center shadow-sm">
                                        <div class="bg-gradient-warning-primary p-4 mfe-3 rounded-left">
                                            <img src="<?php echo e(URL::to('assets/img/logos_equipos/LOGO-STEAM.png')); ?>" height="60">
                                        </div>
                                        <div>
                                            <div class="text-muted text-uppercase font-weight-bold small"> MÓDULO PREPARACIÓN</div>
                                            <div class="text-value text-primary"><a
                                                    href="<?php echo e(route('preparationDetails.index')); ?>">Stock
                                                    en Preparación</a>
                                            </div>
                                            <div class="text-value text-primary"><a
                                                    href="<?php echo e(route('RecepReprocess.create')); ?>">Reprocesar Instrumental</a>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 col-lg-3">
                                <div class="card border-0">
                                    <div class="card-body p-0 d-flex align-items-center shadow-sm">
                                        <div class="bg-gradient-primary p-4 mfe-3 rounded-left">
                                            <h1>PROD</h1>
                                        </div>

                                        <div>
                                            <div class="text-muted text-uppercase font-weight-bold small"> MÓDULO CARGA / DESCARGA
                                            </div>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('access_labelqrs')): ?>
                                                <div class="text-value text-primary"><a href="<?php echo e(route('labelqrs.index')); ?>">GENERAR
                                                        ETIQUETAS</a>
                                                </div>
                                            <?php endif; ?>

                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create_discharges')): ?>
                                                <div class="text-muted text-uppercase font-weight-bold small">MÓDULO DE DESCARGA
                                                </div>
                                                <div class="text-value text-primary"><a
                                                        href="<?php echo e(route('discharges.index')); ?>">LIBERACION </a>
                                                </div>
                                            <?php endif; ?>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('access_esteril_area')): ?>
                            <div class="col-md-6 col-lg-3">
                                <div class="card border-0">
                                    <div class="card-body p-0 d-flex align-items-center shadow-sm">
                                        <div class="bg-gradient-primary p-4 mfe-3 rounded-left">
                                            <h1>DES</h1>
                                        </div>

                                        <div>

                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('access_almacen_area')): ?>
                                                <div>
                                                    <div class="text-muted text-uppercase font-weight-bold small">MÓDULO DE
                                                        ALMACÉN Y DESPACHO.
                                                    </div>
                                                    <div class="text-value text-primary"><a
                                                            href="<?php echo e(route('preparationDetails.index')); ?>">Stock
                                                            Esteril</a>
                                                    </div>
                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('access_expedition')): ?>
                                                        <div class="text-value text-primary"><a href="<?php echo e(route('expeditions.index')); ?>">VER
                                                                DESPACHOS</a>
                                                        </div>
                                                    <?php endif; ?>

                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>

                    </div>
                </div>
            </div>
        <?php endif; ?>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('show_test')): ?>
            <div class="row mb-4">
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('show_test_bd')): ?>
                    <div class="col-lg-6">
                        <div class="card border-0 shadow-sm h-100">
                            <div class="card-header">
                                Resultado de Test de Bowie & Dick / Vacío
                            </div>
                            <div class="card-body d-flex justify-content-center">
                                <div class="chart-container" style="position: relative; height:auto; width:580px">
                                    <strong class="text-align: center">Mensual de Test de Bowie & Dick / Vacío</strong>
                                    <canvas id="testBowiesChart"></canvas>
                                </div>


                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card border-0 shadow-sm h-100">
                            <div class="card-header">
                                Resultado de Test de Bowie & Dick / Vacío
                            </div>
                            <div class="card-body d-flex justify-content-center">

                                <div class="chart-container" style="position: relative; height:auto; width:280px">
                                    <strong># Test Bowie & Dick Total<strong>
                                            <canvas id="currentMonthChart"></canvas>
                                </div>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('show_test_vacuum')): ?>
                                    <div class="chart-container" style="position: relative; height:auto; width:280px">
                                        <strong># Test Vacio Total<strong>
                                                <canvas id="currentMonthChart2"></canvas>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>

            </div>
        <?php endif; ?>

        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('show_production')): ?>
            <div class="row mb-4">
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('show_production_steam')): ?>
                    <div class="col-lg-6">
                        <div class="card border-0 shadow-sm h-100">
                            <div class="card-header">
                                Producción Mensual Esterilización.
                            </div>
                            <div class="card-body d-flex justify-content-center">
                                <div class="chart-container" style="position: relative; height:auto; width:680px">
                                    <canvas id="ProductionsChart"></canvas>
                                </div>
                              
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card border-0 shadow-sm h-100">
                            <div class="card-header">
                                Producción Total Esterilización.
                            </div>
                            <div class="card-body d-flex justify-content-center">
                                <div class="chart-container" style="position: relative; height:auto; width:280px">
                                    <strong># Produccion Vapor<strong>
                                            <canvas id="currentMonthProductionChart"></canvas>
                                </div>
                                <div class="chart-container" style="position: relative; height:auto; width:280px">
                                    <strong># Produccion Peroxido<strong>
                                            <canvas id="currentMonthProductionChart2"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
            <div class="row mb-4">
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('show_production_hpo')): ?>
                    <div class="col-lg-6">
                        <div class="card border-0 shadow-sm h-100">
                            <div class="card-header">
                                Instrumental Procesado.
                            </div>
                            <div class="card-body d-flex justify-content-center">
                                <div class="card-body">
                                    <canvas id="ProductionlabelsChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card border-0 shadow-sm h-100">
                            <div class="card-header">
                                Rendimiento Paquetes.
                            </div>
                            <div class="card-body d-flex justify-content-center">
                                <div class="card-body">
                                    <canvas id="ResultProductionChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        <?php endif; ?>

        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('show_biologic')): ?>
            <div class="row mb-4">
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('show_biologic_steam')): ?>
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
                <?php endif; ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('show_biologic_hpo')): ?>
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
                <?php endif; ?>
            </div>
        <?php endif; ?>


    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('third_party_scripts'); ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.5.0/chart.min.js"
        integrity="sha512-asxKqQghC1oBShyhiBwA+YgotaSYKxGP1rcSYTDrB0U6DxwlJjU59B67U8+5/++uFjcuVM8Hh5cokLjZlhm3Vg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('page_scripts'); ?>
    <?php echo app('Illuminate\Foundation\Vite')('resources/js/chart-config.js'); ?>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/home.blade.php ENDPATH**/ ?>