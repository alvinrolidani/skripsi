<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AlternatifModel;
use App\Models\KriteriaCripsModel;
use App\Models\PenilaianModel;
use App\Models\ResultModel;
use Illuminate\Http\Request;

class AlternatifController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $data = [
            'title' => 'Toko',
            'toko' => AlternatifModel::orderbyDesc('lokasi_toko')->get()
        ];

        return view('admin.toko.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'title' => 'Tambah Toko',
            'toko' => AlternatifModel::get()
        ];
        return view('admin.toko.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        AlternatifModel::create($request->except('_token'));
        return redirect()->route('toko.index')->with('toast_success', 'Data berhasil ditambahkan');
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
            'title' => 'Detail Toko',
            'toko' => AlternatifModel::findorfail($id)
        ];
        return view('admin.toko.show', $data);
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
            'title' => 'Edit Toko',
            'toko' => AlternatifModel::findorfail($id)
        ];
        return view('admin.toko.edit', $data);
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
        AlternatifModel::findorfail($id)->update($request->all());
        return redirect()->route('toko.index')->with('toast_success', 'Data berhasil diedit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        ResultModel::where('alternatif_id', $id)->delete();
        PenilaianModel::where('alternatif_id', $id)->delete();
        AlternatifModel::destroy($id);
        $penilaian_get = PenilaianModel::with('kriteria')->get();
        if ($penilaian_get->isNotEmpty()) {

            Hitung();
            return redirect()->route('toko.index')->with('toast_success', 'Data berhasil dihapus');
        } else {

            return redirect()->route('toko.index')->with('toast_success', 'Data berhasil dihapus');
        }
    }
}
