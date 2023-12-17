<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Calc\Electre;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\DB;

class ResultController extends Controller
{
    public function index(Request $request)
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

        if ($criterias->isEmpty() && $alternatives->isEmpty()) {
            // jika kriteria dan alternatif kosong
            return view('admin.result.index')->with('warning', 'Data kriteria dan alternatif tidak boleh kosong');
        } elseif ($criterias->isEmpty()) {
            // jika kriteria kosong
            return view('admin.result.index')->with('warning', 'Data kriteria tidak boleh kosong');
        } elseif ($alternatives->isEmpty()) {
            // jika alternatif kosong
            return view('admin.result.index')->with('warning', 'Data alternatif tidak boleh kosong');
        } elseif ($scores->isEmpty()) {
            // jika nilai kosong
            return view('admin.result.index')->with('warning', 'Data nilai tidak boleh kosong');
        } elseif ($alternatives->count() < 2) {
            // jika alternatif kurang dari 2
            return view('admin.result.index')->with('warning', 'Data alternatif minimal 2');
        }

        $data_score = [];
        foreach ($scores as $score) {
            $data_score[$score->alternative_code][$score->criteria_code] = $score->value;
        }

        $data['electre'] = new Electre($data_score, $weights);
        $data['alternative'] = $alternatives->pluck('name', 'code')->toArray();
        $data['criteria'] = $criterias->pluck('name', 'code')->toArray();
        if($request->get('dump'))
        {
            dd($data['electre']);
        }
        return view('admin.result.index', $data);
    }
}
