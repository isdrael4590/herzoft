
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

    function stackedBarOptions() {
        return {
            responsive          : true,
            maintainAspectRatio : true,
            interaction         : { mode: 'index', intersect: false },
            plugins             : {
                legend  : { ...LEGEND, labels: { boxWidth: 12, boxHeight: 12, padding: 10, font: { size: 10 } } },
                tooltip : TOOLTIP,
            },
            scales: {
                x: { stacked: true, grid: { ...GRID, display: false }, ticks: TICK },
                y: { stacked: true, beginAtZero: true, grid: GRID, ticks: { ...TICK, precision: 0 } },
            },
        };
    }

    // Build a line dataset
    function lds(label, data, color, fill) {
        return {
            label,
            data,
            borderColor          : color,
            backgroundColor      : fill ? color + '28' : 'transparent',
            fill                 : !!fill,
            tension              : 0.35,
            borderWidth          : 2.5,
            pointRadius          : 3.5,
            pointHoverRadius     : 6,
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

    // Auto-generate HSL palette for N items
    function palette(n) {
        return Array.from({ length: n }, (_, i) =>
            'hsl(' + Math.round((i * 137.508) % 360) + ',62%,50%)'
        );
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

    // ── Period toggle + picker helper ─────────────────────────
    // Injects month/semester/year selectors below the toggle and reloads on change.
    // `availableYears` is passed in from the outer scope once loaded from the backend.
    function initPeriodChart(toggleId, canvasId, url, defaultPeriod, buildChart, availableYears) {
        const canvas   = document.getElementById(canvasId);
        const toggleEl = document.getElementById(toggleId);
        if (!canvas || !toggleEl) return;

        const now   = new Date();
        const curY  = now.getFullYear();
        const curM  = now.getMonth() + 1;
        const curS  = curM <= 6 ? 'S1' : 'S2';
        const MONTHS = ['Enero','Febrero','Marzo','Abril','Mayo','Junio',
                        'Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'];
        const years  = availableYears || [curY];

        function yearOpts(sel) {
            return years.slice().reverse().map(function (y) {
                return '<option value="' + y + '"' + (y === sel ? ' selected' : '') + '>' + y + '</option>';
            }).join('');
        }

        // Build picker groups
        const pickersEl = document.createElement('div');
        pickersEl.className = 'hz-period-pickers';
        pickersEl.innerHTML =
            '<div class="hz-picker-group" data-for="month">' +
                '<select class="hz-picker-sel" data-key="month">' +
                    MONTHS.map(function (m, i) {
                        return '<option value="' + (i+1) + '"' + (i+1 === curM ? ' selected' : '') + '>' + m + '</option>';
                    }).join('') +
                '</select>' +
                '<select class="hz-picker-sel" data-key="year">' + yearOpts(curY) + '</select>' +
            '</div>' +
            '<div class="hz-picker-group" data-for="semester" style="display:none">' +
                '<select class="hz-picker-sel" data-key="sem">' +
                    '<option value="S1"' + (curS==='S1'?' selected':'') + '>S1 (Ene–Jun)</option>' +
                    '<option value="S2"' + (curS==='S2'?' selected':'') + '>S2 (Jul–Dic)</option>' +
                '</select>' +
                '<select class="hz-picker-sel" data-key="year">' + yearOpts(curY) + '</select>' +
            '</div>' +
            '<div class="hz-picker-group" data-for="year" style="display:none">' +
                '<select class="hz-picker-sel" data-key="year">' + yearOpts(curY) + '</select>' +
            '</div>';

        // Insert after toggle
        toggleEl.parentNode.insertBefore(pickersEl, toggleEl.nextSibling);

        function showGroup(period) {
            pickersEl.querySelectorAll('.hz-picker-group').forEach(function (g) {
                g.style.display = g.dataset.for === period ? 'flex' : 'none';
            });
        }

        function getParams(period) {
            var params = { period: period };
            var group  = pickersEl.querySelector('[data-for="' + period + '"]');
            if (group) {
                group.querySelectorAll('.hz-picker-sel').forEach(function (sel) {
                    params[sel.dataset.key] = sel.value;
                });
            }
            return params;
        }

        var activePeriod = defaultPeriod;
        var inst = null;

        function load(period) {
            if (inst) { inst.destroy(); inst = null; }
            var ldr = showLoader(canvas);
            $.get(url, getParams(period), function (data) {
                hideLoader(ldr);
                inst = buildChart(canvas, data);
            });
        }

        showGroup(activePeriod);
        load(activePeriod);

        toggleEl.querySelectorAll('.hz-period-btn').forEach(function (btn) {
            btn.addEventListener('click', function () {
                toggleEl.querySelectorAll('.hz-period-btn')
                    .forEach(function (b) { b.classList.remove('hz-period-btn--active'); });
                btn.classList.add('hz-period-btn--active');
                activePeriod = btn.dataset.period;
                showGroup(activePeriod);
                load(activePeriod);
            });
        });

        pickersEl.querySelectorAll('.hz-picker-sel').forEach(function (sel) {
            sel.addEventListener('change', function () { load(activePeriod); });
        });
    }

    // ── Cargar años disponibles y luego inicializar todos los gráficos ────────
    $.get('/chart-years', function (availableYears) {

    // ── 1. Test B&D / Vacío — Mensual ─────────────────────────
    initPeriodChart('toggleTestBowies', 'testBowiesChart', '/testbowies/chart-data', 'month',
        function (canvas, a) {
            return new Chart(canvas, {
                type : 'line',
                data : {
                    labels  : a.labels,
                    datasets: [
                        lds('TBD —',        a.TBDNeg,      '#2563EB'),
                        lds('TBD +',        a.TBDPosi,     '#ef4444'),
                        lds('Test V OK',    a.testvacNeg,  '#10b981'),
                        lds('Test V Falla', a.testvacPosi, '#f59e0b'),
                    ],
                },
                options: lineOptions(),
            });
        }, availableYears
    );

    // ── 2a. Totales — Test B&D (doughnut) ─────────────────────
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

    // ── 2b. Totales — Test Vacío (doughnut) ───────────────────
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

    // ── 3. Producción Esterilización ──────────────────────────
    initPeriodChart('toggleProductions', 'ProductionsChart', '/productions/chart-data', 'month',
        function (canvas, a) {
            return new Chart(canvas, {
                type : 'line',
                data : {
                    labels  : a.labels,
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
        }, availableYears
    );

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

    // ── 5. Instrumental Procesado ─────────────────────────────
    initPeriodChart('toggleProductionLabels', 'ProductionlabelsChart', '/productionlabels/chart-data', 'month',
        function (canvas, a) {
            return new Chart(canvas, {
                type : 'line',
                data : {
                    labels  : a.labels,
                    datasets: [
                        lds('Inst. Vapor',    a.label_steams, '#f97316', true),
                        lds('Inst. Peróxido', a.label_hpos,   '#0891b2', true),
                    ],
                },
                options: lineOptions(),
            });
        }, availableYears
    );

    // ── 6. Rendimiento de Paquetes ────────────────────────────
    initPeriodChart('toggleResultProduction', 'ResultProductionChart', '/resultproductions/chart-data', 'month',
        function (canvas, a) {
            return new Chart(canvas, {
                type : 'line',
                data : {
                    labels  : a.labels,
                    datasets: [
                        lds('Inst. Procesado', a.procesado_all, '#f97316', true),
                        lds('Inst. Estéril',   a.esteril_all,  '#0891b2', true),
                    ],
                },
                options: lineOptions(),
            });
        }, availableYears
    );

    // ── 7. Liberación Biológicos ──────────────────────────────
    initPeriodChart('toggleBiologic', 'BiologicChart', '/biologics/chart-data', 'month',
        function (canvas, a) {
            return new Chart(canvas, {
                type : 'line',
                data : {
                    labels  : a.labels,
                    datasets: [
                        lds('Steam Bio OK',    a.Ciclos_BioSteam_OK,   '#2563EB'),
                        lds('Steam Bio Falla', a.Ciclos_BioSteam_FAIL, '#ef4444'),
                        lds('HPO Bio OK',      a.Ciclos_BioHPO_OK,     '#10b981'),
                        lds('HPO Bio Falla',   a.Ciclos_BioHPO_fail,   '#f59e0b'),
                    ],
                },
                options: lineOptions(),
            });
        }, availableYears
    );

    // ── 8. Rendimiento por Área Central ──────────────────────
    initPeriodChart('toggleCentral', 'CentralChart', '/central/chart-data', 'month',
        function (canvas, a) {
            return new Chart(canvas, {
                type : 'line',
                data : {
                    labels  : a.labels,
                    datasets: [
                        lds('Recepción',  a.Ciclos_Receptions, '#2563EB', true),
                        lds('Producción', a.Ciclos_Labelqr,    '#ef4444', true),
                        lds('Despachos',  a.Ciclos_Expeditions,'#10b981', true),
                    ],
                },
                options: lineOptions(),
            });
        }, availableYears
    );

    // ── 9. Top 20 Equipos — Stacked Bar segmentado por período ──
    initPeriodChart('equipmentPeriodToggle', 'EquipmentSemesterChart', '/equipment-semester/chart-data', 'semester',
        function (canvas, a) {
            const colors = palette(a.datasets.length);
            return new Chart(canvas, {
                type : 'bar',
                data : {
                    labels  : a.labels,
                    datasets: a.datasets.map(function (ds, i) {
                        return {
                            label           : ds.label,
                            data            : ds.data,
                            backgroundColor : colors[i] + 'cc',
                            borderColor     : colors[i],
                            borderWidth     : 1,
                            stack           : 'top20',
                            borderRadius    : 3,
                        };
                    }),
                },
                options: {
                    responsive          : true,
                    maintainAspectRatio : false,
                    interaction         : { mode: 'index', intersect: false },
                    plugins             : {
                        legend: {
                            position : 'bottom',
                            labels   : { boxWidth: 10, boxHeight: 10, padding: 6, font: { size: 9.5 } },
                        },
                        tooltip: TOOLTIP,
                    },
                    scales: {
                        x: { stacked: true, grid: { ...GRID, display: false }, ticks: TICK },
                        y: { stacked: true, beginAtZero: true, grid: GRID, ticks: { ...TICK, precision: 0 } },
                    },
                },
            });
        }, availableYears
    );

    }); // end $.get('/chart-years')

});
