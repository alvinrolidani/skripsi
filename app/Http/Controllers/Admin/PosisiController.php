<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PosisiModel;
use Illuminate\Http\Request;

class PosisiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'title' => 'Posisi',
            'posisi' => PosisiModel::paginate(10)
        ];
        return view('admin.posisi.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'title' => 'Posisi',

        ];
        return view('admin.posisi.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        PosisiModel::create([
            'nama_posisi' => $request->nama_posisi,

        ]);
        return redirect()->route('position.index')->with('toast_success', 'Data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PosisiModel  $PosisiModel
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = [
            'title' => 'Lihat Detail Staff',
            'posisi' => PosisiModel::findOrFail($id),

        ];

        return view('admin.posisi.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PosisiModel  $PosisiModel
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = [
            'title' => 'Lihat Detail Staff',
            'posisi' => PosisiModel::findOrFail($id),

        ];

        return view('admin.posisi.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PosisiModel  $PosisiModel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        PosisiModel::where('id', $id)->update([
            'nama_posisi' => $request->nama_posisi,

        ]);
        return redirect()->route('position.index')->with('toast_success', 'Data berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PosisiModel  $PosisiModel
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        PosisiModel::destroy($id);
        return redirect()->route('position.index')->with('toast_success', 'Data berhasil dihapus');
    }
}
