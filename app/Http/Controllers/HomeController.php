<?php

namespace App\Http\Controllers;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Modules\Discharge\Entities\Discharge;
use Modules\Discharge\Entities\DischargeDetails;
use Modules\Expedition\Entities\Expedition;
use Modules\Informat\Entities\Machine;
use Modules\Labelqr\Entities\Labelqr;
use Modules\Labelqr\Entities\LabelqrDetails;
use Modules\Reception\Entities\Reception;
use Modules\Setting\Entities\Setting;
use Modules\Testbd\Entities\Testbd;
use Modules\Testbd\Entities\Testvacuum;

class HomeController extends Controller
{

    public function index()
    {


        return view('home');
    }

    // Años disponibles en la BD — alimenta los selectores del dashboard.
    public function chartYears()
    {
        abort_if(!request()->ajax(), 404);

        $tables = [
            'labelqr_details', 'discharges', 'labelqrs',
            'receptions', 'expeditions', 'testbds', 'testvacuums',
        ];

        $minYear = (int) date('Y');
        $maxYear = (int) date('Y');

        foreach ($tables as $table) {
            try {
                $row = DB::table($table)
                    ->selectRaw('MIN(YEAR(updated_at)) as mn, MAX(YEAR(updated_at)) as mx')
                    ->first();
                if ($row && $row->mn) {
                    $minYear = min($minYear, (int) $row->mn);
                    $maxYear = max($maxYear, (int) $row->mx);
                }
            } catch (\Exception $e) {
                // tabla inexistente — ignorar
            }
        }

        $years = range($minYear, $maxYear);

        return response()->json($years);
    }

    // ── Shared helper: builds period labels + grouping expression ──────────────
    private function buildPeriodLabels(string $period): array
    {
        $year  = (int) request()->input('year',  date('Y'));
        $month = (int) request()->input('month', date('n'));
        $sem   = request()->input('sem', date('n') <= 6 ? 'S1' : 'S2');

        switch ($period) {
            case 'semester':
                $anchorEnd = $sem === 'S1'
                    ? Carbon::createFromDate($year, 6, 1)->endOfMonth()
                    : Carbon::createFromDate($year, 12, 1)->endOfMonth();
                $from   = $anchorEnd->copy()->subYears(2)->startOfYear();
                $labels = collect();
                for ($y = $from->year; $y <= $anchorEnd->year; $y++) {
                    foreach (['S1', 'S2'] as $s) {
                        $end = $s === 'S1'
                            ? Carbon::createFromDate($y, 6, 1)->endOfMonth()
                            : Carbon::createFromDate($y, 12, 1)->endOfMonth();
                        if ($end->lte($anchorEnd)) {
                            $labels->push("$s-$y");
                        }
                    }
                }
                return ['from' => $from, 'to' => $anchorEnd, 'labels' => $labels,
                        'groupExpr' => "CONCAT(IF(MONTH(updated_at)<=6,'S1','S2'),'-',YEAR(updated_at))"];

            case 'year':
                $from   = Carbon::createFromDate($year - 3, 1, 1)->startOfYear();
                $to     = Carbon::createFromDate($year, 12, 1)->endOfMonth();
                $labels = collect();
                for ($y = $from->year; $y <= $year; $y++) {
                    $labels->push((string) $y);
                }
                return ['from' => $from, 'to' => $to, 'labels' => $labels,
                        'groupExpr' => "YEAR(updated_at)"];

            default: // month — 12 meses terminando en el mes/año seleccionado
                $anchor = Carbon::createFromDate($year, $month, 1)->endOfMonth();
                $from   = $anchor->copy()->subMonths(11)->startOfMonth();
                $labels = collect();
                $cur    = $from->copy();
                while ($cur->lte($anchor)) {
                    $labels->push($cur->format('m-Y'));
                    $cur->addMonth();
                }
                return ['from' => $from, 'to' => $anchor, 'labels' => $labels,
                        'groupExpr' => "DATE_FORMAT(updated_at,'%m-%Y')"];
        }
    }

    // ── Resultado Mensual Test de Bowie & Dick / Vacío ──────────────────────
    public function testBowiesChart()
    {
        abort_if(!request()->ajax(), 404);
        $cfg    = $this->buildPeriodLabels(request()->input('period', 'month'));
        $from   = $cfg['from'];
        $labels = $cfg['labels'];
        $expr   = $cfg['groupExpr'];

        $fetch = fn($model, $field, $value) =>
            $model::where('updated_at', '>=', $from)->where($field, $value)
                ->select([DB::raw("$expr as pk"), DB::raw("count(*) as count")])
                ->groupBy('pk')->get()->pluck('count', 'pk');

        $map = fn($raw) => $labels->map(fn($l) => (int) ($raw[$l] ?? 0))->values()->all();

        return response()->json([
            'labels'      => $labels->values(),
            'testvacNeg'  => $map($fetch(Testvacuum::class, 'validation_vacuum', 'Correcto')),
            'testvacPosi' => $map($fetch(Testvacuum::class, 'validation_vacuum', 'Falla')),
            'TBDNeg'      => $map($fetch(Testbd::class,     'validation_bd',     'Correcto')),
            'TBDPosi'     => $map($fetch(Testbd::class,     'validation_bd',     'Falla')),
        ]);
    }



    // Resultado de Test de Bowie & Dick / Vacío PIECHART
    public function currentMonthChart()
    {
        abort_if(!request()->ajax(), 404);

        $date_range = Carbon::today()->subYear()->format('Y-m-d');

        $currentMonthTestbdoks = Testbd::where('validation_bd', 'Correcto')
            ->where('updated_at', '>=', $date_range)
            ->count();
        $currentMonthTestbdfails = Testbd::where('validation_bd', 'Falla')
            ->where('updated_at', '>=', $date_range)
            ->count();
        $currentMonthTestvacuumoks = Testvacuum::where('validation_vacuum', 'Correcto')
            ->where('updated_at', '>=', $date_range)
            ->count();
        $currentMonthTestvacuumfails = Testvacuum::where('validation_vacuum', 'Falla')
            ->where('updated_at', '>=', $date_range)
            ->count();

        return response()->json([
            'testbdoks'     => $currentMonthTestbdoks,
            'testbdfails'     => $currentMonthTestbdfails,
            'testvacuumoks' => $currentMonthTestvacuumoks,
            'testvacuumfails'  => $currentMonthTestvacuumfails
        ]);
    }


    // Producción Mensual Esterilización.


    public function ProductionsChart()
    {
        abort_if(!request()->ajax(), 404);
        $cfg    = $this->buildPeriodLabels(request()->input('period', 'month'));
        $from   = $cfg['from'];
        $labels = $cfg['labels'];
        $expr   = $cfg['groupExpr'];

        $fetch = fn($where) => Discharge::where('updated_at', '>=', $from)->where($where)
            ->select([DB::raw("$expr as pk"), DB::raw('SUM(total_amount) as total')])
            ->groupBy('pk')->get()->pluck('total', 'pk');

        $map = fn($raw) => $labels->map(fn($l) => (int) ($raw[$l] ?? 0))->values()->all();

        return response()->json([
            'labels'          => $labels->values(),
            'Ciclos_ok1'      => $map($fetch(['machine_name' => 'MATACHANA',     'machine_type' => 'Autoclave', 'status_cycle' => 'Ciclo Aprobado'])),
            'Ciclos_Fails1'   => $map($fetch(['machine_name' => 'MATACHANA',     'machine_type' => 'Autoclave', 'status_cycle' => 'Ciclo Falla'])),
            'Ciclos_ok2'      => $map($fetch(['machine_name' => 'CISA',          'machine_type' => 'Autoclave', 'status_cycle' => 'Ciclo Aprobado'])),
            'Ciclos_Fails2'   => $map($fetch(['machine_name' => 'CISA',          'machine_type' => 'Autoclave', 'status_cycle' => 'Ciclo Falla'])),
            'Ciclos_HPO_ok'   => $map($fetch(['machine_name' => 'MATACHANA HPO', 'machine_type' => 'Peroxido',  'status_cycle' => 'Ciclo Aprobado'])),
            'Ciclos_HPO_fail' => $map($fetch(['machine_name' => 'MATACHANA HPO', 'machine_type' => 'Peroxido',  'status_cycle' => 'Ciclo Falla'])),
        ]);
    }


    // OLD / Producción Mensual Esterilización.
    public function ProductionsChartOLD()
    {
        abort_if(!request()->ajax(), 404);

        $dates = collect();
        foreach (range(-6, 0) as $i) {
            $date = Carbon::now()->addMonths($i)->format('m-Y');
            $dates->put($date, 0);
        }


        $date_range = Carbon::today()->subYear()->format('Y-m-d');

        $search_steamok1 = ['machine_name' =>  'MATACHANA', 'machine_type' => 'Autoclave', 'status_cycle' => 'Ciclo Aprobado'];
        $Steam1ok = Discharge::where('updated_at', '>=', $date_range)
            ->where($search_steamok1)
            ->select([
                DB::raw("DATE_FORMAT(updated_at, '%m-%Y') as month"),
                DB::raw("count('*') as count")
            ])
            ->groupBy('month')->orderBy('month')
            ->get()->pluck('count', 'month');

        $search_steamFail1 = ['machine_name' =>  'MATACHANA', 'machine_type' => 'Autoclave', 'status_cycle' => 'Ciclo Falla'];
        $Steam1fail = Discharge::where('updated_at', '>=', $date_range)
            ->where($search_steamFail1)
            ->select([
                DB::raw("DATE_FORMAT(updated_at, '%m-%Y') as month"),
                DB::raw("count('*') as count")
            ])
            ->groupBy('month')->orderBy('month')
            ->get()->pluck('count', 'month');

        $search_steamok2 = ['machine_name' => 'CISA', 'machine_type' => 'Autoclave', 'status_cycle' => 'Ciclo Aprobado'];
        $Steam2ok = Discharge::where('updated_at', '>=', $date_range)
            ->where($search_steamok2)
            ->select([
                DB::raw("DATE_FORMAT(updated_at, '%m-%Y') as month"),
                DB::raw("count('*') as count")
            ])
            ->groupBy('month')->orderBy('month')
            ->get()->pluck('count', 'month');

        $search_steamFail2 = ['machine_name' => 'CISA', 'machine_type' => 'Autoclave', 'status_cycle' => 'Ciclo Falla'];
        $Steam2fail = Discharge::where('updated_at', '>=', $date_range)
            ->where($search_steamFail2)
            ->select([
                DB::raw("DATE_FORMAT(updated_at, '%m-%Y') as month"),
                DB::raw("count('*') as count")
            ])
            ->groupBy('month')->orderBy('month')
            ->get()->pluck('count', 'month');

        $search_HPOOK = ['machine_name' => 'MATACHANA HPO', 'machine_type' => 'Peroxido', 'status_cycle' => 'Ciclo Aprobado'];
        $HPO_OK = Discharge::where('updated_at', '>=', $date_range)
            ->where($search_HPOOK)
            ->select([
                DB::raw("DATE_FORMAT(updated_at, '%m-%Y') as month"),
                DB::raw("count('*') as count")
            ])
            ->groupBy('month')->orderBy('month')
            ->get()->pluck('count', 'month');

        $search_HPOFAIL = ['machine_name' => 'MATACHANA HPO', 'machine_type' => 'Peroxido', 'status_cycle' => 'Ciclo Falla'];
        $HPO_FAIL = Discharge::where('updated_at', '>=', $date_range)
            ->where($search_HPOFAIL)
            ->select([
                DB::raw("DATE_FORMAT(updated_at, '%m-%Y') as month"),
                DB::raw("count('*') as count")
            ])
            ->groupBy('month')->orderBy('month')
            ->get()->pluck('count', 'month');



        $ciclo_ok1 = array_merge_numeric_values($Steam1ok);
        $ciclo_ok2 = array_merge_numeric_values($Steam2ok);
        $ciclo_HPO_OK = array_merge_numeric_values($HPO_OK);
        $ciclo_HPO_FAIL = array_merge_numeric_values($HPO_FAIL);

        $ciclo_fail1 = array_merge_numeric_values($Steam1fail);
        $ciclo_fail2 = array_merge_numeric_values($Steam2fail);

        $dates_ok1 = $dates->merge($ciclo_ok1);
        $dates_ok2 = $dates->merge($ciclo_ok2);
        $dates_HPO_OK = $dates->merge($ciclo_HPO_OK);

        $dates_fail1 = $dates->merge($ciclo_fail1);
        $dates_fail2 = $dates->merge($ciclo_fail2);
        $dates_HPO_FAIL = $dates->merge($ciclo_HPO_FAIL);


        $Ciclos_ok1 = [];
        $Ciclos_Fails1 = [];
        $Ciclos_ok2 = [];
        $Ciclos_Fails2 = [];
        $Ciclos_HPO_ok = [];
        $Ciclos_HPO_fail = [];
        $months = [];

        foreach ($dates_ok1 as $key => $value) {
            $Ciclos_ok1[] = $value;
            $months[] = $key;
        }

        foreach ($dates_ok2 as $key => $value) {
            $Ciclos_ok2[] = $value;
        }

        foreach ($dates_fail1 as $key => $value) {
            $Ciclos_Fails1[] = $value;
        }
        foreach ($dates_fail2 as $key => $value) {
            $Ciclos_Fails2[] = $value;
        }
        foreach ($dates_HPO_OK as $key => $value) {
            $Ciclos_HPO_ok[] = $value;
        }
        foreach ($dates_HPO_FAIL as $key => $value) {
            $Ciclos_HPO_fail[] = $value;
        }

        return response()->json([
            'Ciclos_ok1' => $Ciclos_ok1,
            'Ciclos_Fails1' => $Ciclos_Fails1,
            'Ciclos_ok2' => $Ciclos_ok2,
            'Ciclos_Fails2' => $Ciclos_Fails2,
            'Ciclos_HPO_ok' => $Ciclos_HPO_ok,
            'Ciclos_HPO_fail' => $Ciclos_HPO_fail,
            'months' => $months,
        ]);
    }
    // Producción Total Esterilización.

    public function currentMonthProductionChart()
    {
        abort_if(!request()->ajax(), 404);

        $date_range = Carbon::today()->subYear()->format('Y-m-d');

        $search_steamok1 = ['machine_name' =>  'MATACHANA', 'machine_type' => 'Autoclave', 'status_cycle' => 'Ciclo Aprobado'];
        $search_steamFail1 = ['machine_name' =>  'MATACHANA', 'machine_type' => 'Autoclave', 'status_cycle' => 'Ciclo Falla'];
        $search_steamok2 = ['machine_name' => 'CISA', 'machine_type' => 'Autoclave', 'status_cycle' => 'Ciclo Aprobado'];
        $search_steamFail2 = ['machine_name' => 'CISA', 'machine_type' => 'Autoclave', 'status_cycle' => 'Ciclo Falla'];
        $search_HPOOK = ['machine_name' => 'MATACHANA HPO', 'machine_type' => 'Peroxido', 'status_cycle' => 'Ciclo Aprobado'];
        $search_HPOFAIL = ['machine_name' => 'MATACHANA HPO', 'machine_type' => 'Peroxido', 'status_cycle' => 'Ciclo Falla'];
        $Steam1ok = Discharge::where($search_steamok1)
            ->where('updated_at', '>=', $date_range)
            ->count();
        $Steam1fail = Discharge::where($search_steamFail1)
            ->where('updated_at', '>=', $date_range)
            ->count();
        $Steam2ok = Discharge::where($search_steamok2)
            ->where('updated_at', '>=', $date_range)
            ->count();
        $Steam2fail = Discharge::where($search_steamFail2)
            ->where('updated_at', '>=', $date_range)
            ->count();
        $HPO_OK = Discharge::where($search_HPOOK)
            ->where('updated_at', '>=', $date_range)
            ->count();
        $HPO_FAIL = Discharge::where($search_HPOFAIL)
            ->where('updated_at', '>=', $date_range)
            ->count();


        return response()->json([
            'Steam1ok'     => $Steam1ok,
            'Steam1fail'     => $Steam1fail,
            'Steam2ok' => $Steam2ok,
            'Steam2fail'  => $Steam2fail,
            'HPO_OK' => $HPO_OK,
            'HPO_FAIL'  => $HPO_FAIL,
        ]);
    }


    // Instrumental Procesado.

    public function ProductionlabelsChart()
    {
        abort_if(!request()->ajax(), 404);
        $cfg    = $this->buildPeriodLabels(request()->input('period', 'month'));
        $from   = $cfg['from'];
        $labels = $cfg['labels'];
        $expr   = $cfg['groupExpr'];

        $fetch = fn($where) => LabelqrDetails::where('updated_at', '>=', $from)->where($where)
            ->select([DB::raw("$expr as pk"), DB::raw('SUM(product_quantity) as total')])
            ->groupBy('pk')->get()->pluck('total', 'pk');

        $map = fn($raw) => $labels->map(fn($l) => (int) ($raw[$l] ?? 0))->values()->all();

        return response()->json([
            'labels'       => $labels->values(),
            'label_steams' => $map($fetch(['product_type_process' => 'Alta Temperatura'])),
            'label_hpos'   => $map($fetch(['product_type_process' => 'Baja Temperatura'])),
        ]);
    }


    // Instrumental Procesado.  old versioon

    public function ProductionlabelsChartOLD()
    {
        abort_if(!request()->ajax(), 404);

        $dates = collect();
        foreach (range(-6, 0) as $i) {
            $date = Carbon::now()->addMonths($i)->format('m-Y');
            $dates->put($date, 0);
        }

        $date_range = Carbon::today()->subYear()->format('Y-m-d');
        $search_Labelsteam = ['product_type_process' => 'Alta Temperatura'];
        $SteamLabel = LabelqrDetails::where('updated_at', '>=', $date_range)
            ->where($search_Labelsteam)
            ->select([
                DB::raw("DATE_FORMAT(updated_at, '%m-%Y') as month"),
                DB::raw("count('*') as count")
            ])
            ->groupBy('month')->orderBy('month')
            ->get()->pluck('count', 'month');

        $search_LabelHPO = ['product_type_process' => 'Baja Temperatura'];
        $HPOLabel = LabelqrDetails::where('updated_at', '>=', $date_range)
            ->where($search_LabelHPO)
            ->select([
                DB::raw("DATE_FORMAT(updated_at, '%m-%Y') as month"),
                DB::raw("count('*') as count")
            ])
            ->groupBy('month')->orderBy('month')
            ->get()->pluck('count', 'month');



        $label_steam = array_merge_numeric_values($SteamLabel);
        $label_hpo = array_merge_numeric_values($HPOLabel);


        $dates_steam = $dates->merge($label_steam);
        $dates_hpo = $dates->merge($label_hpo);

        $label_steams = [];
        $label_hpos = [];

        $months = [];

        foreach ($dates_steam as $key => $value) {
            $label_steams[] = $value;
            $months[] = $key;
        }

        foreach ($dates_hpo as $key => $value) {
            $label_hpos[] = $value;
        }



        return response()->json([
            'label_steams' => $label_steams,
            'label_hpos' => $label_hpos,

            'months' => $months,
        ]);
    }


    // Rendimiento Paquetes

    public function ResultProductionChart()
    {
        abort_if(!request()->ajax(), 404);
        $cfg    = $this->buildPeriodLabels(request()->input('period', 'month'));
        $from   = $cfg['from'];
        $labels = $cfg['labels'];
        $expr   = $cfg['groupExpr'];

        $fetchSum = fn($model) => $model::where('updated_at', '>=', $from)
            ->select([DB::raw("$expr as pk"), DB::raw('SUM(total_amount) as total')])
            ->groupBy('pk')->get()->pluck('total', 'pk');

        $map = fn($raw) => $labels->map(fn($l) => (int) ($raw[$l] ?? 0))->values()->all();

        return response()->json([
            'labels'        => $labels->values(),
            'procesado_all' => $map($fetchSum(Labelqr::class)),
            'esteril_all'   => $map($fetchSum(Discharge::class)),
        ]);
    }


    // Resultado de liberación de Biológicos.
    public function BiologicChart()
    {
        abort_if(!request()->ajax(), 404);
        $cfg    = $this->buildPeriodLabels(request()->input('period', 'month'));
        $from   = $cfg['from'];
        $labels = $cfg['labels'];
        $expr   = $cfg['groupExpr'];

        $fetch = fn($where) => Discharge::where('updated_at', '>=', $from)->where($where)
            ->select([DB::raw("$expr as pk"), DB::raw("count(*) as count")])
            ->groupBy('pk')->get()->pluck('count', 'pk');

        $map = fn($raw) => $labels->map(fn($l) => (int) ($raw[$l] ?? 0))->values()->all();

        return response()->json([
            'labels'               => $labels->values(),
            'Ciclos_BioSteam_OK'   => $map($fetch(['machine_type' => 'Autoclave', 'validation_biologic' => 'Correcto'])),
            'Ciclos_BioSteam_FAIL' => $map($fetch(['machine_type' => 'Autoclave', 'validation_biologic' => 'Falla'])),
            'Ciclos_BioHPO_OK'     => $map($fetch(['machine_type' => 'Peroxido',  'validation_biologic' => 'Correcto'])),
            'Ciclos_BioHPO_fail'   => $map($fetch(['machine_type' => 'Peroxido',  'validation_biologic' => 'Falla'])),
        ]);
    }

    // Top 20 equipos — segmentado por el período seleccionado (igual que los demás gráficos).
    public function EquipmentSemesterChart()
    {
        abort_if(!request()->ajax(), 404);

        $cfg    = $this->buildPeriodLabels(request()->input('period', 'semester'));
        $from   = $cfg['from'];
        $to     = $cfg['to'];
        $labels = $cfg['labels'];
        $expr   = $cfg['groupExpr'];

        // Top 20 por cantidad total en el rango
        $top20names = DB::table('labelqr_details')
            ->whereBetween('updated_at', [$from, $to])
            ->select('product_name', DB::raw('SUM(product_quantity) as total'))
            ->groupBy('product_name')
            ->orderByRaw('SUM(product_quantity) DESC')
            ->limit(20)
            ->pluck('product_name');

        if ($top20names->isEmpty()) {
            return response()->json(['labels' => $labels->values(), 'datasets' => []]);
        }

        // Una sola consulta para todos los datos por período
        $raw = DB::table('labelqr_details')
            ->whereBetween('updated_at', [$from, $to])
            ->whereIn('product_name', $top20names)
            ->select(['product_name', DB::raw("$expr as pk"), DB::raw('SUM(product_quantity) as total')])
            ->groupBy('product_name', 'pk')
            ->get()
            ->groupBy('product_name');

        $datasets = $top20names->map(function ($name) use ($raw, $labels) {
            $periodData = $raw->get($name, collect())->pluck('total', 'pk');
            return [
                'label' => $name,
                'data'  => $labels->map(fn($l) => (int) ($periodData[$l] ?? 0))->values()->all(),
            ];
        })->values();

        return response()->json([
            'labels'   => $labels->values(),
            'datasets' => $datasets,
        ]);
    }

    // Rendimiento Áreas Central.
    public function CentralChart()
    {
        abort_if(!request()->ajax(), 404);
        $cfg    = $this->buildPeriodLabels(request()->input('period', 'month'));
        $from   = $cfg['from'];
        $labels = $cfg['labels'];
        $expr   = $cfg['groupExpr'];

        $fetchCount = fn($model) => $model::where('updated_at', '>=', $from)
            ->select([DB::raw("$expr as pk"), DB::raw("count(*) as count")])
            ->groupBy('pk')->get()->pluck('count', 'pk');

        $map = fn($raw) => $labels->map(fn($l) => (int) ($raw[$l] ?? 0))->values()->all();

        return response()->json([
            'labels'             => $labels->values(),
            'Ciclos_Receptions'  => $map($fetchCount(Reception::class)),
            'Ciclos_Labelqr'     => $map($fetchCount(Labelqr::class)),
            'Ciclos_Expeditions' => $map($fetchCount(Expedition::class)),
        ]);
    }
}
