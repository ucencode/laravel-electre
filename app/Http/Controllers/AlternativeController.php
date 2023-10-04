<?php

namespace App\Http\Controllers;

use App\Models\Alternative;
use Illuminate\Http\Request;

class AlternativeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $alternatives = Alternative::all();
        return view('admin.alternative.index', ['alternatives' => $alternatives]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['is_add'] = true;
        $data['alternative'] = new Alternative();
        return view('admin.alternative.form', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $alternative_data = $request->validate([
            'name' => 'required',
            'code' => 'required|regex:/^A[0-9]{3}$/|unique:alternatives,code',
        ], [
            'code.regex' => 'Format kode salah',
        ] ,[
            'name' => 'Nama',
            'code' => 'Kode',
        ]);

        alternative::create($alternative_data);

        return redirect()->route('alternative.index')->with('success', 'Alternatif berhasil ditambahkan!');
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
        $data['is_add'] = false;
        $data['alternative'] = Alternative::findOrFail($id);
        return view('admin.alternative.form', $data);
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
        $alternative_data = $request->validate([
            'name' => 'required'
        ], [] ,[
            'name' => 'Nama',
        ]);

        $alternative = Alternative::findOrFail($id);
        $alternative->update($alternative_data);

        return redirect()->route('alternative.index')->with('success', 'Alternatif berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $alternative = Alternative::findOrFail($id);
        $name = $alternative->name;
        $alternative->delete();
        return redirect()->route('alternative.index')->with('success', 'Berhasil menghapus ' . $name);
    }
}
