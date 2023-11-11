<?php

namespace App\Http\Controllers;

use App\Models\Criteria;
use Illuminate\Http\Request;

class CriteriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $criterias = Criteria::orderBy('code')->get();
        return view('admin.criteria.index', ['criterias' => $criterias]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['is_add'] = true;
        $data['criteria'] = new Criteria();
        return view('admin.criteria.form', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // detect request weight, replace comma with dot
        if($request->has('weight'))
            $request->merge(['weight' => str_replace(',', '.', $request->weight)]);

        // validate request
        $criteria_data = $request->validate([
            'code' => 'required|regex:/^C[0-9]+$/|unique:criterias,code',
            'name' => 'required',
            'weight' => 'required|numeric|min:0|max:5',
        ], [
            'code.regex' => 'Format kode salah',
        ], [
            'code' => 'Kode',
            'name' => 'Nama',
            'weight' => 'Bobot',
        ]);

        Criteria::create($criteria_data);

        return redirect()->route('criteria.index')->with('success', 'Kriteria berhasil ditambahkan!');
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
        Criteria::findOrFail($id);
        $data['is_add'] = false;
        $data['criteria'] = Criteria::findOrFail($id);
        return view('admin.criteria.form', $data);
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
        Criteria::findOrFail($id);

        if($request->has('weight'))
            $request->merge(['weight' => str_replace(',', '.', $request->weight)]);

        $criteria_data = $request->validate([
            'name' => 'required',
            'weight' => 'required|numeric|min:0|max:5',
        ], [], [
            'name' => 'Nama',
            'weight' => 'Bobot',
        ]);

        Criteria::where('id', $id)->update($criteria_data);

        return redirect()->route('criteria.index')->with('success', 'Kriteria berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Criteria::findOrFail($id)->delete();
        return redirect()->route('criteria.index')->with('success', 'Kriteria berhasil dihapus!');
    }
}
