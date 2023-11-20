<?php

namespace App\Http\Controllers;

use App\Models\Alternative;
use App\Models\Criteria;
use App\Models\Entity;
use App\Models\Score;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ScoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $alternatives = Alternative::orderBy('code')->get();
        $criterias = Criteria::orderBy('code')->get();
        $data_skor = Score::all();

        $scores = [];
        foreach ($data_skor as $skor)
            $scores[$skor->alternative_code][$skor->criteria_code] = $skor->value;

        $data['scores'] = $scores;
        $data['alternatives'] = $alternatives;
        $data['criterias'] = $criterias;

        // empty data check
        if ($alternatives->isEmpty() || $criterias->isEmpty()) {
            $warningMessage = '';

            if ($alternatives->isEmpty() && $criterias->isEmpty())
                $warningMessage = 'Data kriteria dan alternatif tidak boleh kosong';
            else if ($alternatives->isEmpty())
                $warningMessage = 'Data alternatif tidak boleh kosong';
            else if ($criterias->isEmpty())
                $warningMessage = 'Data kriteria tidak boleh kosong';

            return view('admin.score.index', $data)->with('warning', $warningMessage);
        }

        // there's all fine
        return view('admin.score.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $alternative = Alternative::where('code', $request->alt_code)->first();
        if(!$alternative)
            abort(404);

        $criterias = Criteria::orderBy('code')->get();
        $scores = Score::where('alternative_code', $alternative->code)->pluck('value', 'criteria_code')->toArray();

        return view('admin.score.form', ['alternative' => $alternative, 'criterias' => $criterias, 'scores' => $scores]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->has('criteria') && is_array($request->criteria)) {
            // replace comma with dot
            $arr_criteria = [];
            foreach ($request->criteria as $criteria_code => $value) {
                $arr_criteria[$criteria_code] = str_replace(',', '.', $value);
            }
            $request->merge(['criteria' => $arr_criteria]);
        }

        $validated_values = $request->validate([
            'alternative_code' => 'required|exists:alternatives,code',
            'criteria' => 'required|array',
            'criteria.*' => 'required|numeric|min:0|max:5',
        ], [], [
            'alternative_code' => 'Alternatif',
            'criteria' => 'Skor',
            'criteria.*' => 'Skor',
        ]);

        $update_values = [];
        foreach ($validated_values['criteria'] as $criteria_code => $value) {
            $update_values[] = [
                'alternative_code' => $validated_values['alternative_code'],
                'criteria_code' => $criteria_code,
                'value' => $value
            ];
        }

        Score::upsert($update_values, ['alternative_code', 'criteria_code'], ['value']);

        return redirect()->route('score.index')->with('success', 'Data skor berhasil disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        /**
        $data['is_add'] = false;
        $data['score'] = Score::findOrFail($id);
        return view('admin.score.form', $data);
         */
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    }
}
