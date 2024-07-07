<?php

namespace App\Http\Controllers;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Modules\Testbd\Entities\Testbd;

class HomeController extends Controller
{

    public function index()
    {


        return view('home');
    }

    public function testBowieChart()
    {
        abort_if(!request()->ajax(), 404);

        $TBD_Correcto = $this->TBD_CorrectoChart();
        $TBD_Falla = $this->TBD_FallaChart();
        return response()->json(['TBD_Correcto' => $TBD_Correcto, 'TBD_Falla' => $TBD_Falla]);
    }

    public function TBD_FallaChart()
    {
        $dates = collect();
        foreach (range(-6, 0) as $i) {
            $date = Carbon::now()->addDays($i)->format('d-m-y');
            $dates->put($date, 0);
        }
        $date_range = Carbon::today()->subDays(6);

        $TBD_Falla = Testbd::where('validation_bd', 'Falla')
            ->where('updated_at', '>=', $date_range)
            ->groupBy(DB::raw("DATE_FORMAT(updated_at,'%d-%m-%y')"))
            ->orderBy('updated_at')
            ->get([
                DB::raw(DB::raw("DATE_FORMAT(updated_at,'%d-%m-%y') as updated_at")),
                DB::raw('count(*) as count_tdb_falla'),
            ])
            ->pluck('count_tdb_falla', 'updated_at');
       dd($TBD_Falla);
        $dates = $dates->merge($TBD_Falla);
 
        $data = [];
        $days = [];
        foreach ($dates as $key => $value) {
            $data[] = $value;
            $days[] = $key;
        }

        return response()->json(['data' => $data, 'days' => $days]);
    }

    public function TBD_CorrectoChart()
    {
        $dates = collect();
        foreach (range(-6, 0) as $i) {
            $date = Carbon::now()->addDays($i)->format('d-m-y');
            $dates->put($date, 0);
        }
        $date_range = Carbon::today()->subDays(6);

        $TBD_Correcto = Testbd::where('validation_bd', 'Correcto')
            ->where('updated_at', '>=', $date_range)
            ->groupBy(DB::raw("DATE_FORMAT(updated_at,'%d-%m-%y')"))
            ->orderBy('updated_at')
            ->get([
                DB::raw(DB::raw("DATE_FORMAT(updated_at,'%d-%m-%y') as updated_at")),
                DB::raw('count(*) as count_tdb_correct'),
            ])
            ->pluck('count_tdb_correct', 'updated_at');

        $dates = $dates->merge($TBD_Correcto);

        $data = [];
        $days = [];
        foreach ($dates as $key => $value) {
            $data[] = $value;
            $days[] = $key;
        }

        return response()->json(['data' => $data, 'days' => $days]);
    }
}
