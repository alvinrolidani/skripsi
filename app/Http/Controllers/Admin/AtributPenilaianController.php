<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\KriteriaModel;
use App\Models\PenilaianModel;
use App\Http\Controllers\Controller;
use App\Models\AtributPenilaianModel;

class AtributPenilaianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $data = [
            'title' => 'Atribut Penilaian',
            'atribut_penilaian' => AtributPenilaianModel::where('kriteria_id', $id)->get(),
            'kriteria' => KriteriaModel::findorfail($id),

        ];


        // return response()->json($data['crips']);
        return view('admin.atribut_penilaian.index', $data, compact('id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $data = [
            'title' => 'Tambah Data Atribut Penilaian',
            'kriteria' => KriteriaModel::findorfail($id),
            'allkriteria' => KriteriaModel::with('atribut_penilaian')->orderByDesc('bobot_kriteria')->get(),
            'id' => $id
        ];
        $count = [];
        $hitung = [];

        // dd($data['kriteria']);
        foreach ($data['allkriteria'] as $key => $value) {
            foreach ($value->atribut_penilaian as $key_2 => $value_2) {
                $count[$value->id][] = $value_2->id;
            }
        }
        // dd($count);
        foreach ($count as $key => $value) {
            $hitung[$key][] = count($value);
        }
        // dd($hitung);
        $total = $data['kriteria']->sum('bobot_kriteria');
        return view('admin.atribut_penilaian.create', $data, compact('hitung'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        AtributPenilaianModel::create([
            'kriteria_id' => $id,
            'nama_atribut' => $request->nama_atribut,
            'bobot' => $request->bobot
        ]);

        $atribut = AtributPenilaianModel::orderBy('id', 'DESC')->first();
        $penilaian = PenilaianModel::all();
        if ($penilaian->isNotEmpty()) {

            foreach ($penilaian as $key => $value) {
                $coba[$value->alternatif_id][] = $value;
            }

            foreach ($coba as $key => $value) {
                foreach ($value as $key1 => $value1) {

                    PenilaianModel::updateOrCreate(
                        [
                            'alternatif_id' => $key,
                            'kriteria_id' => $atribut->kriteria_id
                        ],
                        [

                            'alternatif_id' => $key,
                            'kriteria_id' => $atribut->kriteria_id,
                            'tahun_awal' => $value1->tahun_awal,
                            'tahun_akhir' => $value1->tahun_akhir,
                            'value' => $request->bobot,
                        ]
                    );
                }
            }
        }

        return redirect()->route('atribut_penilaian.index', $id)->with('toast_success', 'Data berhasil ditambahkan');
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
            'title' => 'Detail Data Atribut Penilaian',
            'crips' => AtributPenilaianModel::findorfail($id),
            'id' => $id
        ];
        return view('admin.atribut_penilaian.show', $data);
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
            'title' => 'Edit Data Atribut Penilaian',
            'atribut_penilaian' => AtributPenilaianModel::findorfail($id)
        ];
        return view('admin.atribut_penilaian.edit', $data);
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
        $atribut_penilaian = AtributPenilaianModel::findorfail($id);
        $atribut_penilaian->update($request->all());
        return redirect()->route('atribut_penilaian.index', $atribut_penilaian->kriteria_id)->with('toast_success', 'Data berhasil diedit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $atribut_penilaian = AtributPenilaianModel::findorfail($id);
        $atribut_penilaian->delete();
        return redirect()->route('atribut_penilaian.index', $atribut_penilaian->kriteria_id)->with('toast_success', 'Data berhasil diedit');
    }
}
