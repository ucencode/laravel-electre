<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Calc\Electre;
use Illuminate\Support\Facades\DB;

class ResultController extends Controller
{
    public function index()
    {
        $scores = DB::table('scores', 's')
            ->select([
                's.id',
                's.alternative_code',
                's.criteria_code',
                's.value',
                'a.name as alternative_name',
                'c.name as criteria_name',
            ])
            ->join('alternatives as a', 'a.code', '=', 's.alternative_code')
            ->join('criterias as c', 'c.code', '=', 's.criteria_code')
            ->orderBy('s.alternative_code', 'asc')
            ->orderBy('s.criteria_code', 'asc')
            ->get();
        $criterias = DB::table('criterias')->get();
        $alternatives = DB::table('alternatives')->get();

        $weights = $criterias->pluck('weight', 'code')->toArray();

        $data = [];

        foreach ($scores as $score) {
            $data[$score->alternative_code][$score->criteria_code] = $score->value;
        }

        // dd($scores, $criterias, $alternatives, $weights);

        $data['electre'] = new Electre($data, $weights);
        $data['alternative'] = $alternatives->pluck('name', 'code')->toArray();
        $data['criteria'] = $criterias->pluck('name', 'code')->toArray();
        // dd($data['alternative'], $data['criteria']);

        return view('admin.result.index', $data);
    }
}
