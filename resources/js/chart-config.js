
$(document).ready(function () {

    // ── Global defaults ────────────────────────────────────────
    Chart.defaults.font.family = "'Inter','Segoe UI',system-ui,sans-serif";
    Chart.defaults.font.size   = 11;
    Chart.defaults.color       = '#64748b';
    Chart.defaults.animation   = { duration: 600, easing: 'easeInOutQuart' };

    // ── Shared style helpers ───────────────────────────────────
    const GRID = { color: 'rgba(0,0,0,0.045)', drawBorder: false };
    const TICK = { padding: 7, color: '#94a3b8' };
    const TOOLTIP = {
        backgroundColor : '#1e293b',
        titleColor      : '#f1f5f9',
        bodyColor       : '#cbd5e1',
        padding         : 10,
        cornerRadius    : 8,
        boxPadding      : 4,
        usePointStyle   : true,
    };
    const LEGEND = {
        position : 'bottom',
        labels   : { boxWidth: 9, boxHeight: 9, padding: 14, font: { size: 11 } },
    };

    function lineOptions(yMax) {
        return {
            responsive          : true,
            maintainAspectRatio : true,
            interaction         : { mode: 'index', intersect: false },
            plugins             : { legend: LEGEND, tooltip: TOOLTIP },
            scales              : {
                x: { grid: { ...GRID, display: false }, ticks: TICK },
                y: {
                    beginAtZero : true,
                    max         : yMax,
                    grid        : GRID,
                    ticks       : { ...TICK, stepSize: 1, precision: 0 },
                },
            },
        };
    }

    function doughnutOptions() {
        return {
            responsive          : true,
            maintainAspectRatio : true,
            cutout              : '68%',
            plugins             : {
                legend  : LEGEND,
                tooltip : {
                    ...TOOLTIP,
                    callbacks: {
                        label(ctx) {
                            const total = ctx.dataset.data.reduce((a, b) => a + b, 0);
                            const pct   = total ? Math.round(ctx.parsed / total * 100) : 0;
                            return `  ${ctx.label}: ${ctx.parsed}  (${pct}%)`;
                        },
                    },
                },
            },
        };
    }

    // Build a line dataset with consistent styling
    function lds(label, data, color, fill) {
        return {
            label,
            data,
            borderColor     : color,
            backgroundColor : fill ? color + '28' : 'transparent',
            fill            : !!fill,
            tension         : 0.35,
            borderWidth     : 2.5,
            pointRadius     : 3.5,
            pointHoverRadius: 6,
            pointBackgroundColor : color,
            pointBorderColor     : '#fff',
            pointBorderWidth     : 2,
        };
    }

    // Build a doughnut dataset
    function dds(data, colors) {
        return [{
            data,
            backgroundColor     : colors,
            hoverBackgroundColor: colors.map(c => c + 'cc'),
            borderWidth         : 0,
            hoverOffset         : 6,
        }];
    }

    // Loading overlay helpers
    function showLoader(canvas) {
        const loader = document.createElement('div');
        loader.className = 'hz-chart-loader';
        canvas.parentElement.style.position = 'relative';
        canvas.parentElement.appendChild(loader);
        return loader;
    }
    function hideLoader(loader) {
        if (loader && loader.parentNode) loader.parentNode.removeChild(loader);
    }

    // ── 1. Test B&D / Vacío — Mensual (line) ──────────────────
    const eBowies = document.getElementById('testBowiesChart');
    if (eBowies) {
        const ldr = showLoader(eBowies);
        $.get('/testbowies/chart-data', function (a) {
            hideLoader(ldr);
            new Chart(eBowies, {
                type : 'line',
                data : {
                    labels  : a.months,
                    datasets: [
                        lds('TBD —',      a.TBDNeg,      '#2563EB'),
                        lds('TBD +',      a.TBDPosi,     '#ef4444'),
                        lds('Test V OK',  a.testvacNeg,  '#10b981'),
                        lds('Test V Falla', a.testvacPosi, '#f59e0b'),
                    ],
                },
                options: lineOptions(),
            });
        });
    }

    // ── 2a. Totales mes — Test B&D (doughnut) ─────────────────
    const tBD = document.getElementById('currentMonthChart');
    if (tBD) {
        const ldr = showLoader(tBD);
        $.get('/current-month/chart-data', function (a) {
            hideLoader(ldr);
            new Chart(tBD, {
                type : 'doughnut',
                data : {
                    labels  : ['TBD —', 'TBD +'],
                    datasets: dds([a.testbdoks, a.testbdfails], ['#10b981', '#ef4444']),
                },
                options: doughnutOptions(),
            });
        });
    }

    // ── 2b. Totales mes — Test Vacío (doughnut) ───────────────
    const tVac = document.getElementById('currentMonthChart2');
    if (tVac) {
        const ldr = showLoader(tVac);
        $.get('/current-month/chart-data', function (a) {
            hideLoader(ldr);
            new Chart(tVac, {
                type : 'doughnut',
                data : {
                    labels  : ['Test V OK', 'Test V Falla'],
                    datasets: dds([a.testvacuumoks, a.testvacuumfails], ['#3b82f6', '#f97316']),
                },
                options: doughnutOptions(),
            });
        });
    }

    // ── 3. Producción Mensual Esterilización (line) ───────────
    const rProd = document.getElementById('ProductionsChart');
    if (rProd) {
        const ldr = showLoader(rProd);
        $.get('/productions/chart-data', function (a) {
            hideLoader(ldr);
            new Chart(rProd, {
                type : 'line',
                data : {
                    labels  : a.months,
                    datasets: [
                        lds('V1 OK',     a.Ciclos_ok1,      '#2563EB'),
                        lds('V1 Falla',  a.Ciclos_Fails1,   '#ef4444'),
                        lds('V2 OK',     a.Ciclos_ok2,      '#10b981'),
                        lds('V2 Falla',  a.Ciclos_Fails2,   '#f59e0b'),
                        lds('HPO OK',    a.Ciclos_HPO_ok,   '#0891b2'),
                        lds('HPO Falla', a.Ciclos_HPO_fail, '#8b5cf6'),
                    ],
                },
                options: lineOptions(),
            });
        });
    }

    // ── 4a. Producción Total — Vapor (doughnut) ───────────────
    const cVapor = document.getElementById('currentMonthProductionChart');
    if (cVapor) {
        const ldr = showLoader(cVapor);
        $.get('/currentProducMonth/chart-data', function (a) {
            hideLoader(ldr);
            new Chart(cVapor, {
                type : 'doughnut',
                data : {
                    labels  : ['V1 OK', 'V1 Falla', 'V2 OK', 'V2 Falla'],
                    datasets: dds(
                        [a.Steam1ok, a.Steam1fail, a.Steam2ok, a.Steam2fail],
                        ['#2563EB', '#ef4444', '#10b981', '#f59e0b'],
                    ),
                },
                options: doughnutOptions(),
            });
        });
    }

    // ── 4b. Producción Total — HPO (doughnut) ─────────────────
    const dHPO = document.getElementById('currentMonthProductionChart2');
    if (dHPO) {
        const ldr = showLoader(dHPO);
        $.get('/currentProducMonth/chart-data', function (a) {
            hideLoader(ldr);
            new Chart(dHPO, {
                type : 'doughnut',
                data : {
                    labels  : ['HPO OK', 'HPO Falla'],
                    datasets: dds([a.HPO_OK, a.HPO_FAIL], ['#0891b2', '#8b5cf6']),
                },
                options: doughnutOptions(),
            });
        });
    }

    // ── 5. Instrumental Procesado (area line) ─────────────────
    const sLabels = document.getElementById('ProductionlabelsChart');
    if (sLabels) {
        const ldr = showLoader(sLabels);
        $.get('/productionlabels/chart-data', function (a) {
            hideLoader(ldr);
            new Chart(sLabels, {
                type : 'line',
                data : {
                    labels  : a.months,
                    datasets: [
                        lds('Inst. Vapor',    a.label_steams, '#f97316', true),
                        lds('Inst. Peróxido', a.label_hpos,   '#0891b2', true),
                    ],
                },
                options: lineOptions(),
            });
        });
    }

    // ── 6. Rendimiento de Paquetes (area line) ────────────────
    const ssResult = document.getElementById('ResultProductionChart');
    if (ssResult) {
        const ldr = showLoader(ssResult);
        $.get('/resultproductions/chart-data', function (a) {
            hideLoader(ldr);
            new Chart(ssResult, {
                type : 'line',
                data : {
                    labels  : a.months,
                    datasets: [
                        lds('Inst. Procesado', a.procesado_all, '#f97316', true),
                        lds('Inst. Estéril',   a.esteril_all,  '#0891b2', true),
                    ],
                },
                options: lineOptions(),
            });
        });
    }

    // ── 7. Liberación Biológicos (line) ───────────────────────
    const uBio = document.getElementById('BiologicChart');
    if (uBio) {
        const ldr = showLoader(uBio);
        $.get('/biologics/chart-data', function (a) {
            hideLoader(ldr);
            new Chart(uBio, {
                type : 'line',
                data : {
                    labels  : a.months,
                    datasets: [
                        lds('Steam Bio OK',    a.Ciclos_BioSteam_OK,   '#2563EB'),
                        lds('Steam Bio Falla', a.Ciclos_BioSteam_FAIL, '#ef4444'),
                        lds('HPO Bio OK',      a.Ciclos_BioHPO_OK,     '#10b981'),
                        lds('HPO Bio Falla',   a.Ciclos_BioHPO_fail,   '#f59e0b'),
                    ],
                },
                options: lineOptions(),
            });
        });
    }

    // ── 8. Rendimiento por Área Central (area line) ───────────
    const vCentral = document.getElementById('CentralChart');
    if (vCentral) {
        const ldr = showLoader(vCentral);
        $.get('/central/chart-data', function (a) {
            hideLoader(ldr);
            new Chart(vCentral, {
                type : 'line',
                data : {
                    labels  : a.months,
                    datasets: [
                        lds('Recepción',  a.Ciclos_Receptions, '#2563EB', true),
                        lds('Producción', a.Ciclos_Labelqr,    '#ef4444', true),
                        lds('Despachos',  a.Ciclos_Expeditions,'#10b981', true),
                    ],
                },
                options: lineOptions(),
            });
        });
    }

});
