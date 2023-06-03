<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AturanModel;
use App\Models\KriteriaModel;
use Illuminate\Http\Request;

class AturanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'title' => 'Aturan',
            'aturan' => AturanModel::with('kriteria')->paginate(10),
            'kriteria' => KriteriaModel::all()
        ];
        // return response()->json($data['aturan']);
        return view('admin.aturan.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'title' => 'Aturan',

            'kriteria' => KriteriaModel::all()
        ];
        // return response()->json($data['aturan']);
        return view('admin.aturan.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $aturan = new AturanModel();
        $aturan->nama_aturan = $request->nama_aturan;
        $aturan->save();
        foreach ($request->kriteria as $key => $value) {
            $data[$key]['value'] = $value;
        }

        $aturan->kriteria()->sync($data);

        return redirect()->route('aturan.index')->with('toast_success', 'Data berhasil ditambahkan');
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
        //
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

        $aturan = AturanModel::findOrFail($id);
        $aturan->delete();
        return redirect()->route('aturan.index')->with('toast_success', 'Data berhasil dihapus');
    }
}
