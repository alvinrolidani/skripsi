<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AturanModel;
use App\Models\KriteriaModel;
use Illuminate\Http\Request;

class KriteriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'title' => 'Kriteria',
            'kriteria' => KriteriaModel::paginate(10)
        ];

        return view('admin.kriteria.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'title' => 'Kriteria',
            'kriteria' => KriteriaModel::paginate(10)
        ];

        return view('admin.kriteria.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $kriteria = new KriteriaModel();
        $kriteria->kode_kriteria = $request->kode_kriteria;
        $kriteria->nama_kriteria = $request->nama_kriteria;
        $kriteria->save();


        $aturan = AturanModel::all();

        foreach ($aturan as $key) {
            $key->kriteria()->attach($kriteria, [
                'value' => ''
            ]);
        }
        return redirect()->route('kriteria.index')->with('toast_success', 'Data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = [
            'title' => 'Lihat Detail Staff',
            'kriteria' => KriteriaModel::findOrFail($id),

        ];

        return view('admin.kriteria.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = [
            'title' => 'Lihat Detail Staff',
            'kriteria' => KriteriaModel::findOrFail($id),

        ];

        return view('admin.kriteria.edit', $data);
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
        KriteriaModel::findOrFail($id)->update($request->all());
        return redirect()->route('kriteria.index')->with('toast_success', 'Data berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        KriteriaModel::destroy($id);
        return redirect()->route('kriteria.index')->with('toast_success', 'Data berhasil diubah');
    }
}
