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
    // TEST DE BOWIE Y VACIO

    public function testBowiesChart()
    {
        abort_if(!request()->ajax(), 404);
        $dates = collect();
        foreach (range(-6, 0) as $i) {
            $date = Carbon::now()->addMonths($i)->format('m-Y');
            $dates->put($date, 0);
        }

        $date_range = Carbon::today()->subYear()->format('Y-m-d');

        $Negativos = Testvacuum::where('updated_at', '>=', $date_range)
            ->where('validation_vacuum', 'Correcto')
            ->select([
                DB::raw("DATE_FORMAT(updated_at, '%m-%Y') as month"),
                DB::raw("count('*') as count")
            ])
            ->groupBy('month')->orderBy('month')
            ->get()->pluck('count', 'month');

        $Positivos = Testvacuum::where('updated_at', '>=', $date_range)
            ->where('validation_vacuum', 'Falla')
            ->select([
                DB::raw("DATE_FORMAT(updated_at, '%m-%Y') as month"),
                DB::raw("count('*') as count")
            ])
            ->groupBy('month')->orderBy('month')
            ->get()->pluck('count', 'month');

        $NegativosTBD = Testbd::where('updated_at', '>=', $date_range)
            ->where('validation_bd', 'Correcto')
            ->select([
                DB::raw("DATE_FORMAT(updated_at, '%m-%Y') as month"),
                DB::raw("count('*') as count")
            ])
            ->groupBy('month')->orderBy('month')
            ->get()->pluck('count', 'month');

        $PositivosTBD = Testbd::where('updated_at', '>=', $date_range)
            ->where('validation_bd', 'Falla')
            ->select([
                DB::raw("DATE_FORMAT(updated_at, '%m-%Y') as month"),
                DB::raw("count('*') as count")
            ])
            ->groupBy('month')->orderBy('month')
            ->get()->pluck('count', 'month');



        $ciclo_Negativos = array_merge_numeric_values($Negativos);
        $dates_testvacNeg = $dates->merge($ciclo_Negativos);
        $ciclo_Positivos = array_merge_numeric_values($Positivos);
        $dates_testvacPosi = $dates->merge($ciclo_Positivos);
        $ciclo_NegativoTBDs = array_merge_numeric_values($NegativosTBD);
        $dates_TBDNeg = $dates->merge($ciclo_NegativoTBDs);
        $ciclo_PositivoTBDs = array_merge_numeric_values($PositivosTBD);
        $dates_TBDPosi = $dates->merge($ciclo_PositivoTBDs);


        $testvacNeg = [];
        $testvacPosi = [];
        $TBDNeg = [];
        $TBDPosi = [];
        $months = [];

        foreach ($dates_testvacNeg as $key => $value) {
            $testvacNeg[] = $value;
            $months[] = $key;
        }
        foreach ($dates_testvacPosi as $key => $value) {
            $testvacPosi[] = $value;
        }
        foreach ($dates_TBDNeg as $key => $value) {
            $TBDNeg[] = $value;
        }
        foreach ($dates_TBDPosi as $key => $value) {
            $TBDPosi[] = $value;
        }

        return response()->json([
            'testvacNeg' => $testvacNeg,
            'testvacPosi' => $testvacPosi,
            'TBDNeg' => $TBDNeg,
            'TBDPosi' => $TBDPosi,
            'months' => $months,
        ]);
    }
    // ACUMULADO DE DE TEST
    public function currentMonthChart()
    {
        abort_if(!request()->ajax(), 404);

        $currentMonthTestbdoks = Testbd::where('validation_bd', 'Correcto')
            ->whereYear('updated_at', date('Y'))
            ->count();
        $currentMonthTestbdfails = Testbd::where('validation_bd', 'Falla')
            ->whereYear('updated_at', date('Y'))
            ->count();
        $currentMonthTestvacuumoks = Testvacuum::where('validation_vacuum', 'Correcto')
            ->whereYear('updated_at', date('Y'))
            ->count();
        $currentMonthTestvacuumfails = Testvacuum::where('validation_vacuum', 'Falla')
            ->whereYear('updated_at', date('Y'))
            ->count();

        return response()->json([
            'testbdoks'     => $currentMonthTestbdoks,
            'testbdfails'     => $currentMonthTestbdfails,
            'testvacuumoks' => $currentMonthTestvacuumoks,
            'testvacuumfails'  => $currentMonthTestvacuumfails
        ]);
    }


    // ACUMULADO DE PRODUCCION 


    public function ProductionsChart()
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


    // TOTAL DE PRODUCION 

    public function currentMonthProductionChart()
    {
        abort_if(!request()->ajax(), 404);

        $search_steamok1 = ['machine_name' =>  'MATACHANA', 'machine_type' => 'Autoclave', 'status_cycle' => 'Ciclo Aprobado'];
        $search_steamFail1 = ['machine_name' =>  'MATACHANA', 'machine_type' => 'Autoclave', 'status_cycle' => 'Ciclo Falla'];
        $search_steamok2 = ['machine_name' => 'CISA', 'machine_type' => 'Autoclave', 'status_cycle' => 'Ciclo Aprobado'];
        $search_steamFail2 = ['machine_name' => 'CISA', 'machine_type' => 'Autoclave', 'status_cycle' => 'Ciclo Falla'];
        $search_HPOOK = ['machine_name' => 'MATACHANA HPO', 'machine_type' => 'Peroxido', 'status_cycle' => 'Ciclo Aprobado'];
        $search_HPOFAIL = ['machine_name' => 'MATACHANA HPO', 'machine_type' => 'Peroxido', 'status_cycle' => 'Ciclo Falla'];
        $Steam1ok = Discharge::where($search_steamok1)
            ->whereYear('updated_at', date('Y'))
            ->count();
        $Steam1fail = Discharge::where($search_steamFail1)
            ->whereYear('updated_at', date('Y'))
            ->count();
        $Steam2ok = Discharge::where($search_steamok2)
            ->whereYear('updated_at', date('Y'))
            ->count();
        $Steam2fail = Discharge::where($search_steamFail2)
            ->whereYear('updated_at', date('Y'))
            ->count();
        $HPO_OK = Discharge::where($search_HPOOK)
            ->whereYear('updated_at', date('Y'))
            ->count();
        $HPO_FAIL = Discharge::where($search_HPOFAIL)
            ->whereYear('updated_at', date('Y'))
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

    public function ProductionlabelsChart()
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




    public function ResultProductionChart()
    {
        abort_if(!request()->ajax(), 404);

        $dates = collect();
        foreach (range(-6, 0) as $i) {
            $date = Carbon::now()->addMonths($i)->format('m-Y');
            $dates->put($date, 0);
        }
        dd($dates);
        $date_range = Carbon::today()->subYear()->format('Y-m-d');

        $Procesados = Labelqr::where('updated_at', '>=', $date_range)
            ->select([
                DB::raw("DATE_FORMAT(updated_at, '%m-%Y') as month"),
                DB::raw("SUM(total_amount) as amount")
            ])
            ->groupBy('month')->orderBy('month')
            ->get()->pluck('amount', 'month');

        dd($Procesados);

        $esteril = Discharge::where('updated_at', '>=', $date_range)
            ->select([
                DB::raw("DATE_FORMAT(updated_at, '%m-%Y') as month"),
                DB::raw("SUM(total_amount) as amount")
            ])
            ->groupBy('month')->orderBy('month')
            ->get()->pluck('amount', 'month');


        $all_procesados = array_merge_numeric_values($Procesados);
        $all_esteril = array_merge_numeric_values($esteril);

        $dates_procesados = $dates->merge($all_procesados);
        $dates_esteriles = $dates->merge($all_esteril);

        $esteril_all = [];
        $procesado_all = [];
        $months = [];

        foreach ($dates_procesados as $key => $value) {
            $procesado_all[] = $value;
            $months[] = $key;
        }
        foreach ($dates_esteriles as $key => $value) {
            $esteril_all[] = $value;
        }
        return response()->json([
            'esteril' => $esteril_all,
            'procesados' => $procesado_all,
            'months' => $months,
        ]);
    }


    public function BiologicChart()
    {
        abort_if(!request()->ajax(), 404);

        $dates = collect();
        foreach (range(-6, 0) as $i) {
            $date = Carbon::now()->addMonths($i)->format('m-Y');
            $dates->put($date, 0);
        }

        $date_range = Carbon::today()->subYear()->format('Y-m-d');
        $Find_Steam_ok = ['machine_type' => 'Autoclave', 'validation_biologic' => 'Correcto'];
        $Biolog_Steam_ok = Discharge::where('updated_at', '>=', $date_range)
            ->where($Find_Steam_ok)
            ->select([
                DB::raw("DATE_FORMAT(updated_at, '%m-%Y') as month"),
                DB::raw("count('*') as count")
            ])
            ->groupBy('month')->orderBy('month')
            ->get()->pluck('count', 'month');

        $Find_Steam_fail = ['machine_type' => 'Autoclave', 'validation_biologic' => 'Falla'];
        $Biolog_Steam_fail = Discharge::where('updated_at', '>=', $date_range)
            ->where($Find_Steam_fail)
            ->select([
                DB::raw("DATE_FORMAT(updated_at, '%m-%Y') as month"),
                DB::raw("count('*') as count")
            ])
            ->groupBy('month')->orderBy('month')
            ->get()->pluck('count', 'month');

        $Find_HPO_ok = ['machine_type' => 'Peroxido', 'validation_biologic' => 'Correcto'];
        $Biolog_HPO_ok = Discharge::where('updated_at', '>=', $date_range)
            ->where($Find_HPO_ok)
            ->select([
                DB::raw("DATE_FORMAT(updated_at, '%m-%Y') as month"),
                DB::raw("count('*') as count")
            ])
            ->groupBy('month')->orderBy('month')
            ->get()->pluck('count', 'month');

        $Find_HPO_fail = ['machine_type' => 'Peroxido', 'validation_biologic' => 'Falla'];
        $Biolog_HPO_fail = Discharge::where('updated_at', '>=', $date_range)
            ->where($Find_HPO_fail)
            ->select([
                DB::raw("DATE_FORMAT(updated_at, '%m-%Y') as month"),
                DB::raw("count('*') as count")
            ])
            ->groupBy('month')->orderBy('month')
            ->get()->pluck('count', 'month');


        $Bio_Steams_OK = array_merge_numeric_values($Biolog_Steam_ok);
        $Bio_HPOs_OK = array_merge_numeric_values($Biolog_HPO_ok);
        $Bio_Steams_Fail = array_merge_numeric_values($Biolog_Steam_fail);
        $Bio_HPOs_Fail = array_merge_numeric_values($Biolog_HPO_fail);


        $dates_BioSteam_OK = $dates->merge($Bio_Steams_OK);
        $dates_BioHPO_OK = $dates->merge($Bio_HPOs_OK);
        $dates_BioSteam_FAIL = $dates->merge($Bio_Steams_Fail);
        $dates_BioHPO_fail = $dates->merge($Bio_HPOs_Fail);



        $Ciclos_BioSteam_OK = [];
        $Ciclos_BioHPO_OK = [];
        $Ciclos_BioSteam_FAIL = [];
        $Ciclos_BioHPO_fail = [];

        $months = [];

        foreach ($dates_BioSteam_OK as $key => $value) {
            $Ciclos_BioSteam_OK[] = $value;
            $months[] = $key;
        }

        foreach ($dates_BioHPO_OK as $key => $value) {
            $Ciclos_BioHPO_OK[] = $value;
        }

        foreach ($dates_BioSteam_FAIL as $key => $value) {
            $Ciclos_BioSteam_FAIL[] = $value;
        }
        foreach ($dates_BioHPO_fail as $key => $value) {
            $Ciclos_BioHPO_fail[] = $value;
        }


        return response()->json([
            'Ciclos_BioSteam_OK' => $Ciclos_BioSteam_OK,
            'Ciclos_BioHPO_OK' => $Ciclos_BioHPO_OK,
            'Ciclos_BioSteam_FAIL' => $Ciclos_BioSteam_FAIL,
            'Ciclos_BioHPO_fail' => $Ciclos_BioHPO_fail,

            'months' => $months,
        ]);
    }

    public function CentralChart()
    {
        abort_if(!request()->ajax(), 404);

        $dates = collect();
        foreach (range(-6, 0) as $i) {
            $date = Carbon::now()->addMonths($i)->format('m-Y');
            $dates->put($date, 0);
        }

        $date_range = Carbon::today()->subYear()->format('Y-m-d');
        $Find_Reception = ['machine_type' => 'Autoclave', 'validation_biologic' => 'Correcto'];
        $Reception = Reception::where('updated_at', '>=', $date_range)
            ->select([
                DB::raw("DATE_FORMAT(updated_at, '%m-%Y') as month"),
                DB::raw("count('*') as count")
            ])
            ->groupBy('month')->orderBy('month')
            ->get()->pluck('count', 'month');

        $Find_Sterilized = ['machine_type' => 'Autoclave', 'validation_biologic' => 'Falla'];
        $Labelqr = Labelqr::where('updated_at', '>=', $date_range)
            ->select([
                DB::raw("DATE_FORMAT(updated_at, '%m-%Y') as month"),
                DB::raw("count('*') as count")
            ])
            ->groupBy('month')->orderBy('month')
            ->get()->pluck('count', 'month');

        $Find_Expedition = ['machine_type' => 'Peroxido', 'validation_biologic' => 'Correcto'];
        $Expedition = Expedition::where('updated_at', '>=', $date_range)
            ->select([
                DB::raw("DATE_FORMAT(updated_at, '%m-%Y') as month"),
                DB::raw("count('*') as count")
            ])
            ->groupBy('month')->orderBy('month')
            ->get()->pluck('count', 'month');



        $all_receptions = array_merge_numeric_values($Reception);
        $all_labelqrs = array_merge_numeric_values($Labelqr);
        $all_expeditions = array_merge_numeric_values($Expedition);


        $dates_Receptions = $dates->merge($all_receptions);
        $dates_Labelqr = $dates->merge($all_labelqrs);
        $dates_Expeditions = $dates->merge($all_expeditions);

        $Ciclos_Receptions = [];
        $Ciclos_Labelqr = [];
        $Ciclos_Expeditions = [];

        $months = [];

        foreach ($dates_Receptions as $key => $value) {
            $Ciclos_Receptions[] = $value;
            $months[] = $key;
        }

        foreach ($dates_Labelqr as $key => $value) {
            $Ciclos_Labelqr[] = $value;
        }

        foreach ($dates_Expeditions as $key => $value) {
            $Ciclos_Expeditions[] = $value;
        }


        return response()->json([
            'Ciclos_Receptions' => $Ciclos_Receptions,
            'Ciclos_Labelqr' => $Ciclos_Labelqr,
            'Ciclos_Expeditions' => $Ciclos_Expeditions,

            'months' => $months,
        ]);
    }
}
