<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Calc\Electre;
use Illuminate\Support\Facades\DB;

class ResultController extends Controller
{
    public function index()
    {
        $scores = DB::table('scores')->get();
        $criterias = DB::table('criterias')->get();
        $alternatives = DB::table('alternatives')->get();

        $weights = $criterias->pluck('weight', 'code')->toArray();

        $data = [];

        foreach ($scores as $score) {
            $data[$score->alternative_code][$score->criteria_code] = $score->value;
        }

        $data['electre'] = new Electre($data, $weights);
        $data['alternative'] = $alternatives->pluck('name', 'code')->toArray();
        $data['criteria'] = $criterias->pluck('name', 'code')->toArray();
        // dd($data['alternative'], $data['criteria']);

        return view('admin.result.index', $data);
    }
}
