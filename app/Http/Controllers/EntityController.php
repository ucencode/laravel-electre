<?php

namespace App\Http\Controllers;

use App\Models\Entity;
use Illuminate\Http\Request;

class EntityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $entities = Entity::all();
        return view('admin.entity.index', ['entities' => $entities]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['is_add'] = true;
        $data['entity'] = new Entity();
        return view('admin.entity.form', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $entity_data = $request->validate([
            'name' => 'required',
            'code' => 'required|regex:/^E[0-9]{3}$/|unique:entities,code',
        ], [
            'code.regex' => 'Format kode salah',
        ] ,[
            'name' => 'Nama',
            'code' => 'Kode',
        ]);

        Entity::create($entity_data);

        return redirect()->route('entity.index')->with('success', 'Entitas berhasil ditambahkan!');
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
        $data['entity'] = Entity::findOrFail($id);
        return view('admin.entity.form', $data);
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
        $entity_data = $request->validate([
            'name' => 'required'
        ], [] ,[
            'name' => 'Nama',
        ]);

        Entity::findOrFail($id)->update($entity_data);

        return redirect()->route('entity.index')->with('success', 'Entitas berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $entity = Entity::findOrFail($id);
        $name = $entity->name;
        $entity->delete();
        return redirect()->route('entity.index')->with('success', 'Berhasil menghapus ' . $name);
    }
}
