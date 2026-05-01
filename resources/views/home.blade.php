@extends('layouts.app')

@section('title', 'Dashboard')

@section('breadcrumb')
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item active">Inicio</li>
    </ol>
@endsection

@section('content')
<?php
$hour = (int) date('G');
if ($hour >= 6 && $hour < 12) {
    $greet     = 'Buenos días';
    $greetIcon = 'bi-brightness-high-fill';
    $greetColor = '#f59e0b';
} elseif ($hour >= 12 && $hour < 19) {
    $greet     = 'Buenas tardes';
    $greetIcon = 'bi-sun-fill';
    $greetColor = '#f97316';
} else {
    $greet     = 'Buenas noches';
    $greetIcon = 'bi-moon-stars-fill';
    $greetColor = '#818cf8';
}
$today = \Carbon\Carbon::now();
?>

<div class="hz-dashboard px-3 px-md-4 pb-5">

    {{-- ══════════════════════════════════════
         HERO / BIENVENIDA
    ══════════════════════════════════════ --}}
    <div class="hz-hero mb-4">
        <div class="hz-hero__inner">
            <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">

                <div class="hz-hero__left">
                    <div class="hz-hero__greeting">
                        <i class="bi {{ $greetIcon }}" style="color:{{ $greetColor }}"></i>
                        {{ $greet }},
                    </div>
                    <h2 class="hz-hero__name">{{ Auth::user()->name }}</h2>
                    <p class="hz-hero__date" id="heroDate">
                        {{ $today->translatedFormat('l, d \d\e F \d\e Y') }}
                    </p>
                </div>

                <div class="hz-clock-box">
                    <div class="hz-clock" id="heroClock">{{ $today->format('H:i:s') }}</div>
                    <div class="hz-clock__label">Hora actual</div>
                </div>

            </div>
        </div>
    </div>

    {{-- ══════════════════════════════════════
         ACCESO RÁPIDO POR ÁREA
    ══════════════════════════════════════ --}}
    @can('show_total_stats')
        <div class="hz-section-label mb-3">
            <i class="bi bi-grid-1x2-fill"></i> Acceso Rápido por Área
        </div>

        <div class="row g-3 mb-4">

            @can('access_dirty_area')
                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="hz-module hz-module--red">
                        <div class="hz-module__top-bar"></div>
                        <div class="hz-module__icon-wrap">
                            <i class="bi bi-inbox-fill"></i>
                        </div>
                        <div class="hz-module__zone">Zona Sucia</div>
                        <div class="hz-module__title">Recepción</div>
                        <p class="hz-module__desc">Gestión de ingreso de instrumental sucia</p>
                        @can('access_receptions')
                            <div class="hz-module__links">
                                @can('create_receptions')
                                    <a href="{{ route('receptions.create') }}" class="hz-pill">
                                        <i class="bi bi-plus-circle"></i> Nuevo Ingreso
                                    </a>
                                @endcan
                                <a href="{{ route('receptions.index') }}" class="hz-pill">
                                    <i class="bi bi-list-ul"></i> Ver Todos
                                </a>
                            </div>
                        @endcan
                        <i class="bi bi-arrow-right-circle-fill hz-module__watermark"></i>
                    </div>
                </div>
            @endcan

            @can('access_zne_area')
                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="hz-module hz-module--blue">
                        <div class="hz-module__top-bar"></div>
                        <div class="hz-module__icon-wrap">
                            <i class="bi bi-activity"></i>
                        </div>
                        <div class="hz-module__zone">Zona No Estéril</div>
                        <div class="hz-module__title">Tests & Preparación</div>
                        <p class="hz-module__desc">Tests de equipos, preparación y carga de ciclos</p>
                        <div class="hz-module__links">
                            @can('access_testbds')
                                <a href="{{ route('testbds.index') }}" class="hz-pill">
                                    <i class="bi bi-patch-check"></i> Test B&amp;D
                                </a>
                            @endcan
                            @can('access_preparations')
                                <a href="{{ route('preparationDetails.index') }}" class="hz-pill">
                                    <i class="bi bi-grid-3x3-gap"></i> Stock
                                </a>
                            @endcan
                            @can('access_labelqrs')
                                <a href="{{ route('labelqrs.index') }}" class="hz-pill">
                                    <i class="bi bi-qr-code-scan"></i> Producción
                                </a>
                            @endcan
                        </div>
                        <i class="bi bi-arrow-right-circle-fill hz-module__watermark"></i>
                    </div>
                </div>
            @endcan

            @can('access_esteril_area')
                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="hz-module hz-module--green">
                        <div class="hz-module__top-bar"></div>
                        <div class="hz-module__icon-wrap">
                            <i class="bi bi-shield-fill-check"></i>
                        </div>
                        <div class="hz-module__zone">Zona Estéril</div>
                        <div class="hz-module__title">Descarga</div>
                        <p class="hz-module__desc">Liberación y validación de ciclos esterilizados</p>
                        @can('access_discharges')
                            <div class="hz-module__links">
                                <a href="{{ route('discharges.index') }}" class="hz-pill">
                                    <i class="bi bi-unlock-fill"></i> Liberar Ciclos
                                </a>
                            </div>
                        @endcan
                        <i class="bi bi-arrow-right-circle-fill hz-module__watermark"></i>
                    </div>
                </div>
            @endcan

            @can('access_almacen_area')
                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="hz-module hz-module--purple">
                        <div class="hz-module__top-bar"></div>
                        <div class="hz-module__icon-wrap">
                            <i class="bi bi-archive-fill"></i>
                        </div>
                        <div class="hz-module__zone">Almacén</div>
                        <div class="hz-module__title">Stock & Despacho</div>
                        <p class="hz-module__desc">Control de stock estéril y despacho a servicios</p>
                        <div class="hz-module__links">
                            @can('access_stocks')
                                <a href="{{ route('stockDetails.index') }}" class="hz-pill">
                                    <i class="bi bi-boxes"></i> Stock
                                </a>
                            @endcan
                            @can('access_expeditions')
                                <a href="{{ route('expeditions.index') }}" class="hz-pill">
                                    <i class="bi bi-truck"></i> Despachos
                                </a>
                            @endcan
                        </div>
                        <i class="bi bi-arrow-right-circle-fill hz-module__watermark"></i>
                    </div>
                </div>
            @endcan

        </div>
    @endcan

    {{-- ══════════════════════════════════════
         GRÁFICOS — TESTS
    ══════════════════════════════════════ --}}
    @can('show_test')
        <div class="hz-section-label mb-3">
            <i class="bi bi-bar-chart-fill"></i> Resultados de Tests
        </div>
        <div class="row g-3 mb-4">
            <div class="col-lg-7">
                <div class="hz-chart-card">
                    <div class="hz-chart-card__head">
                        <div>
                            <div class="hz-chart-card__title">Test Bowie &amp; Dick / Vacío — Mensual</div>
                            <div class="hz-chart-card__sub">Distribución de resultados por día del mes</div>
                        </div>
                        <span class="hz-badge hz-badge--blue"><i class="bi bi-activity"></i> Mensual</span>
                    </div>
                    <div class="hz-chart-card__body">
                        <canvas id="testBowiesChart" height="120"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="hz-chart-card h-100">
                    <div class="hz-chart-card__head">
                        <div>
                            <div class="hz-chart-card__title">Totales del Mes</div>
                            <div class="hz-chart-card__sub">Acumulado B&amp;D y Vacío</div>
                        </div>
                        <span class="hz-badge hz-badge--indigo"><i class="bi bi-pie-chart-fill"></i> Total</span>
                    </div>
                    <div class="hz-chart-card__body d-flex align-items-center justify-content-center gap-4 flex-wrap">
                        <div class="hz-donut-wrap">
                            <div class="hz-donut-label">Test B&amp;D</div>
                            <canvas id="currentMonthChart" width="150" height="150"></canvas>
                        </div>
                        <div class="hz-donut-wrap">
                            <div class="hz-donut-label">Test Vacío</div>
                            <canvas id="currentMonthChart2" width="150" height="150"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endcan

    {{-- ══════════════════════════════════════
         GRÁFICOS — PRODUCCIÓN
    ══════════════════════════════════════ --}}
    @can('show_production')
        <div class="hz-section-label mb-3">
            <i class="bi bi-graph-up-arrow"></i> Producción
        </div>
        <div class="row g-3 mb-4">
            <div class="col-lg-7">
                <div class="hz-chart-card">
                    <div class="hz-chart-card__head">
                        <div>
                            <div class="hz-chart-card__title">Producción Mensual — Esterilización</div>
                            <div class="hz-chart-card__sub">Ciclos procesados por día del mes actual</div>
                        </div>
                        <span class="hz-badge hz-badge--green"><i class="bi bi-bar-chart"></i> Mensual</span>
                    </div>
                    <div class="hz-chart-card__body">
                        <canvas id="ProductionsChart" height="120"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="hz-chart-card h-100">
                    <div class="hz-chart-card__head">
                        <div>
                            <div class="hz-chart-card__title">Producción Total</div>
                            <div class="hz-chart-card__sub">Vapor vs Peróxido acumulado</div>
                        </div>
                        <span class="hz-badge hz-badge--teal"><i class="bi bi-pie-chart"></i> Total</span>
                    </div>
                    <div class="hz-chart-card__body d-flex align-items-center justify-content-center gap-4 flex-wrap">
                        <div class="hz-donut-wrap">
                            <div class="hz-donut-label">Vapor</div>
                            <canvas id="currentMonthProductionChart" width="150" height="150"></canvas>
                        </div>
                        <div class="hz-donut-wrap">
                            <div class="hz-donut-label">Peróxido</div>
                            <canvas id="currentMonthProductionChart2" width="150" height="150"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endcan

    {{-- ══════════════════════════════════════
         GRÁFICOS — INSTRUMENTAL & RENDIMIENTO
    ══════════════════════════════════════ --}}
    @can('show_types_rumed')
        <div class="hz-section-label mb-3">
            <i class="bi bi-clipboard2-data-fill"></i> Instrumental &amp; Rendimiento
        </div>
        <div class="row g-3 mb-4">
            <div class="col-lg-6">
                <div class="hz-chart-card">
                    <div class="hz-chart-card__head">
                        <div>
                            <div class="hz-chart-card__title">Instrumental Procesado</div>
                            <div class="hz-chart-card__sub">Tipos de paquetes procesados en el período</div>
                        </div>
                        <span class="hz-badge hz-badge--amber"><i class="bi bi-scissors"></i></span>
                    </div>
                    <div class="hz-chart-card__body">
                        <canvas id="ProductionlabelsChart" height="140"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="hz-chart-card">
                    <div class="hz-chart-card__head">
                        <div>
                            <div class="hz-chart-card__title">Rendimiento de Paquetes</div>
                            <div class="hz-chart-card__sub">Eficiencia del proceso por categoría</div>
                        </div>
                        <span class="hz-badge hz-badge--purple"><i class="bi bi-speedometer2"></i></span>
                    </div>
                    <div class="hz-chart-card__body">
                        <canvas id="ResultProductionChart" height="140"></canvas>
                    </div>
                </div>
            </div>
        </div>
    @endcan

    {{-- ══════════════════════════════════════
         GRÁFICOS — BIOLÓGICOS & ÁREAS
    ══════════════════════════════════════ --}}
    <div class="row g-3 mb-4">
        @can('show_result_biologic')
            <div class="col-lg-6">
                <div class="hz-chart-card">
                    <div class="hz-chart-card__head">
                        <div>
                            <div class="hz-chart-card__title">Liberación Biológicos</div>
                            <div class="hz-chart-card__sub">Resultado de indicadores biológicos</div>
                        </div>
                        <span class="hz-badge hz-badge--red"><i class="bi bi-eyedropper"></i></span>
                    </div>
                    <div class="hz-chart-card__body">
                        <canvas id="BiologicChart" height="140"></canvas>
                    </div>
                </div>
            </div>
        @endcan
        @can('show_production_areas')
            <div class="col-lg-6">
                <div class="hz-chart-card">
                    <div class="hz-chart-card__head">
                        <div>
                            <div class="hz-chart-card__title">Rendimiento por Área</div>
                            <div class="hz-chart-card__sub">Producción comparativa entre áreas centrales</div>
                        </div>
                        <span class="hz-badge hz-badge--cyan"><i class="bi bi-map-fill"></i></span>
                    </div>
                    <div class="hz-chart-card__body">
                        <canvas id="CentralChart" height="140"></canvas>
                    </div>
                </div>
            </div>
        @endcan
    </div>

</div>

{{-- ═══════════════════════════════════════════════════════
     ESTILOS DEL DASHBOARD
══════════════════════════════════════════════════════ --}}
<style>
/* ── Contenedor ─────────────────────────────────────────── */
.hz-dashboard { padding-top: 24px; }

/* ── Hero ──────────────────────────────────────────────── */
.hz-hero {
    border-radius: 18px;
    overflow: hidden;
}
.hz-hero__inner {
    background: linear-gradient(135deg, #0f2554 0%, #1a3a7c 50%, #0e4d7a 100%);
    padding: 28px 32px;
    position: relative;
    overflow: hidden;
}
.hz-hero__inner::before {
    content: '';
    position: absolute;
    top: -80px; right: -80px;
    width: 340px; height: 340px;
    border-radius: 50%;
    background: rgba(0, 212, 245, 0.06);
    pointer-events: none;
}
.hz-hero__inner::after {
    content: '';
    position: absolute;
    bottom: -100px; left: 35%;
    width: 420px; height: 200px;
    border-radius: 50%;
    background: rgba(99, 102, 241, 0.07);
    pointer-events: none;
}
.hz-hero__greeting {
    font-size: 12px;
    font-weight: 600;
    color: #93c5fd;
    display: flex;
    align-items: center;
    gap: 8px;
    margin-bottom: 6px;
    text-transform: uppercase;
    letter-spacing: 1.5px;
}
.hz-hero__greeting i { font-size: 17px; }
.hz-hero__name {
    font-size: 26px;
    font-weight: 700;
    color: #ffffff;
    margin: 0 0 5px;
    line-height: 1.2;
}
.hz-hero__date {
    font-size: 12px;
    color: #7dd3fc;
    margin: 0;
    text-transform: capitalize;
}
.hz-clock-box {
    text-align: center;
    background: rgba(255, 255, 255, 0.07);
    border: 1px solid rgba(255, 255, 255, 0.12);
    border-radius: 16px;
    padding: 16px 28px;
    backdrop-filter: blur(8px);
}
.hz-clock {
    font-size: 34px;
    font-weight: 700;
    color: #00d4f5;
    letter-spacing: 3px;
    font-variant-numeric: tabular-nums;
    line-height: 1;
}
.hz-clock__label {
    font-size: 10px;
    color: #7dd3fc;
    text-transform: uppercase;
    letter-spacing: 2px;
    margin-top: 4px;
}

/* ── Section label ─────────────────────────────────────── */
.hz-section-label {
    font-size: 10.5px;
    font-weight: 700;
    color: #94a3b8;
    text-transform: uppercase;
    letter-spacing: 2px;
    display: flex;
    align-items: center;
    gap: 7px;
    padding-left: 2px;
}

/* ── Module cards ──────────────────────────────────────── */
.hz-module {
    background: #ffffff;
    border-radius: 14px;
    border: 1px solid #f1f5f9;
    box-shadow: 0 2px 10px rgba(0,0,0,0.04);
    padding: 20px 18px 18px;
    position: relative;
    overflow: hidden;
    height: 100%;
    display: flex;
    flex-direction: column;
    gap: 10px;
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}
.hz-module:hover {
    transform: translateY(-4px);
    box-shadow: 0 10px 30px rgba(0,0,0,0.10);
}

/* top color bar */
.hz-module__top-bar {
    position: absolute;
    top: 0; left: 0; right: 0;
    height: 4px;
    border-radius: 14px 14px 0 0;
}
.hz-module--red    .hz-module__top-bar { background: linear-gradient(90deg, #e86060, #f87171); }
.hz-module--blue   .hz-module__top-bar { background: linear-gradient(90deg, #3b82f6, #60a5fa); }
.hz-module--green  .hz-module__top-bar { background: linear-gradient(90deg, #10b981, #34d399); }
.hz-module--purple .hz-module__top-bar { background: linear-gradient(90deg, #8b5cf6, #a78bfa); }

/* icon */
.hz-module__icon-wrap {
    width: 44px; height: 44px;
    border-radius: 10px;
    display: flex; align-items: center; justify-content: center;
    font-size: 20px;
    flex-shrink: 0;
}
.hz-module--red    .hz-module__icon-wrap { background: #fef2f2; color: #e86060; }
.hz-module--blue   .hz-module__icon-wrap { background: #eff6ff; color: #3b82f6; }
.hz-module--green  .hz-module__icon-wrap { background: #ecfdf5; color: #10b981; }
.hz-module--purple .hz-module__icon-wrap { background: #f5f3ff; color: #8b5cf6; }

/* zone */
.hz-module__zone {
    font-size: 10px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 1.5px;
}
.hz-module--red    .hz-module__zone { color: #e86060; }
.hz-module--blue   .hz-module__zone { color: #3b82f6; }
.hz-module--green  .hz-module__zone { color: #10b981; }
.hz-module--purple .hz-module__zone { color: #8b5cf6; }

/* title */
.hz-module__title {
    font-size: 15px;
    font-weight: 700;
    color: #1e293b;
    line-height: 1.3;
    margin-top: -4px;
}

/* desc */
.hz-module__desc {
    font-size: 12px;
    color: #64748b;
    margin: 0;
    line-height: 1.5;
}

/* links */
.hz-module__links {
    display: flex;
    flex-wrap: wrap;
    gap: 6px;
    margin-top: auto;
    padding-top: 4px;
}
.hz-pill {
    font-size: 11.5px;
    font-weight: 500;
    padding: 5px 12px;
    border-radius: 20px;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 5px;
    transition: all 0.18s ease;
    border: 1px solid;
    line-height: 1;
}
.hz-module--red    .hz-pill { color: #e86060; border-color: #fecaca; background: #fef2f2; }
.hz-module--red    .hz-pill:hover { background: #e86060; color: #fff; border-color: #e86060; text-decoration: none; }
.hz-module--blue   .hz-pill { color: #3b82f6; border-color: #bfdbfe; background: #eff6ff; }
.hz-module--blue   .hz-pill:hover { background: #3b82f6; color: #fff; border-color: #3b82f6; text-decoration: none; }
.hz-module--green  .hz-pill { color: #10b981; border-color: #a7f3d0; background: #ecfdf5; }
.hz-module--green  .hz-pill:hover { background: #10b981; color: #fff; border-color: #10b981; text-decoration: none; }
.hz-module--purple .hz-pill { color: #8b5cf6; border-color: #ddd6fe; background: #f5f3ff; }
.hz-module--purple .hz-pill:hover { background: #8b5cf6; color: #fff; border-color: #8b5cf6; text-decoration: none; }

/* watermark icon */
.hz-module__watermark {
    position: absolute;
    bottom: 14px; right: 14px;
    font-size: 52px;
    opacity: 0.05;
    line-height: 1;
    pointer-events: none;
}

/* ── Chart cards ───────────────────────────────────────── */
.hz-chart-card {
    background: #ffffff;
    border-radius: 14px;
    border: 1px solid #f1f5f9;
    box-shadow: 0 2px 10px rgba(0,0,0,0.04);
    overflow: hidden;
    display: flex;
    flex-direction: column;
}
.hz-chart-card__head {
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    gap: 12px;
    padding: 18px 20px 0;
}
.hz-chart-card__title {
    font-size: 13.5px;
    font-weight: 700;
    color: #1e293b;
    line-height: 1.3;
}
.hz-chart-card__sub {
    font-size: 11px;
    color: #94a3b8;
    margin-top: 2px;
}
.hz-chart-card__body {
    padding: 16px 20px 20px;
    flex: 1;
}

/* ── Badges ────────────────────────────────────────────── */
.hz-badge {
    font-size: 10px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 1px;
    padding: 4px 10px;
    border-radius: 20px;
    display: inline-flex;
    align-items: center;
    gap: 5px;
    white-space: nowrap;
    flex-shrink: 0;
}
.hz-badge--blue   { background: #eff6ff; color: #3b82f6; }
.hz-badge--indigo { background: #eef2ff; color: #6366f1; }
.hz-badge--green  { background: #ecfdf5; color: #10b981; }
.hz-badge--teal   { background: #f0fdfa; color: #0d9488; }
.hz-badge--amber  { background: #fffbeb; color: #d97706; }
.hz-badge--purple { background: #f5f3ff; color: #8b5cf6; }
.hz-badge--red    { background: #fef2f2; color: #ef4444; }
.hz-badge--cyan   { background: #ecfeff; color: #0891b2; }

/* ── Donut wraps ───────────────────────────────────────── */
.hz-donut-wrap { text-align: center; }
.hz-donut-label {
    font-size: 11px;
    font-weight: 600;
    color: #64748b;
    text-transform: uppercase;
    letter-spacing: 1px;
    margin-bottom: 8px;
}
</style>
@endsection

@section('third_party_scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.5.0/chart.min.js"
        integrity="sha512-asxKqQghC1oBShyhiBwA+YgotaSYKxGP1rcSYTDrB0U6DxwlJjU59B67U8+5/++uFjcuVM8Hh5cokLjZlhm3Vg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endsection

@push('page_scripts')
    @vite('resources/js/chart-config.js')
    <script>
        (function () {
            function updateClock() {
                const now = new Date();
                const hh  = String(now.getHours()).padStart(2, '0');
                const mm  = String(now.getMinutes()).padStart(2, '0');
                const ss  = String(now.getSeconds()).padStart(2, '0');
                const el  = document.getElementById('heroClock');
                if (el) el.textContent = `${hh}:${mm}:${ss}`;
            }
            setInterval(updateClock, 1000);
        })();
    </script>
@endpush
