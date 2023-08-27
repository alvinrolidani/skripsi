<?php

namespace App\Http\Controllers\Admin;

use App\Models\ResultModel;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\Models\KriteriaModel;
use App\Models\PenilaianModel;

use App\Models\AlternatifModel;
use App\Http\Controllers\Controller;
use App\Models\AtributPenilaianModel;


class PenilaianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $tAwal = $request->tahun_awal;
        $tAkhir = $request->tahun_akhir;

        $data = [
            'title' => 'Penilaian',

            'penilaian' =>  ResultModel::where('tahun_awal', $tAwal)->where('tahun_akhir', $tAkhir)->with('toko')->get(),
            // 'penilaian' =>  ResultModel::where('tahun_awal', $tAwal)->where('tahun_akhir', $tAkhir)->with('toko')->orderByDesc('hasil')->get()->toArray()
        ];

        $total = [];
        $x = [];
        $y = [];
        $collection = collect($data['penilaian']);
        $collect_penilaian = $collection;

        foreach ($collect_penilaian as $key_1 => $row) {
            $total[$key_1][] = $row['hasil'];
        }

        // dd($grafik);
        arsort($total);

        $result = $collect_penilaian;
        $i = 0;
        $last_value = null;
        foreach ($total as $key => $value) {

            if ($value != $last_value) {
                $i++;
                $last_value = $value;
            }
            $result[$key]['rank'] = $i;
        }


        // dd($result);
        $tess = $result;
        foreach ($result as $key1 => $value1) {

            if ($value1->hasil < 55 && $value1->hasil == $result->min('hasil')) {
                $tess[$key1]['kesimpulan'] = 'Tidak Layak Diberikan Kredit Celana';
            } elseif ($value1->hasil < 55 && $value1->hasil != $result->min('hasil')) {
                $tess[$key1]['kesimpulan'] = 'Sedang Dalam Peninjauan';
            } elseif ($value1->hasil >= 55 && $value1->hasil <= 60) {
                $tess[$key1]['kesimpulan'] = 'Sedang Dalam Peninjauan';
            } else {
                $tess[$key1]['kesimpulan'] = 'Layak Diberikan Kredit Celana';
            }
        }

        // dd($tess);
        foreach ($tess as $key => $value) {
            $x[] = $value['toko']['nama_toko'];
            $y[] = [
                $value['kesimpulan'],
                $value['hasil'],
            ];
        }

        $hasilX = json_encode($x);
        $hasilY = json_encode($y);



        return view('admin.penilaian.index', $data, compact('tAwal', 'tAkhir', 'result', 'hasilX', 'hasilY'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        $data = [
            'title' => 'Penilaian',
            'kriteria' =>  KriteriaModel::with('atribut_penilaian')->get()->sortByDesc('bobot_kriteria'),
            'penilaian' => AtributPenilaianModel::with('kriteria')->get(),
            'alternatif' =>  AlternatifModel::all()->sortBy('lokasi_toko'),
            'result' =>  ResultModel::where('tahun_awal', $request->tahun_awal)->where('tahun_akhir', $request->tahun_akhir)->with('toko')->get(),
            'tAwal' => $request->tahun_awal,
            'tAkhir' => $request->tahun_akhir,
        ];
        // return response()->json($data['kriteria']);


        $count = [];
        $hitung = [];
        $resultCount = [];
        $resulthitung = [];
        $alternatifCount = [];
        $alternatifhitung = [];
        foreach ($data['kriteria'] as $key => $value) {
            foreach ($value->atribut_penilaian as $key_2 => $value_2) {
                $count[$value->id][] = $value_2;
            }
        }
        // dd($count);
        foreach ($count as $key => $value) {
            $hitung[$key][] = count($value);
        }
        // dd($hitung);
        foreach ($data['result'] as $key => $value) {

            $resultCount[$value->alternatif_id][] = $value;
        }
        // dd($resultCount);
        foreach ($resultCount as $key => $value) {
            $resulthitung[$key] = count($value);
        }

        foreach ($data['alternatif'] as $key => $value) {

            $alternatifCount[$value->id][] = $value;
        }
        // dd($alternatifCount);
        foreach ($alternatifCount as $key => $value) {
            $alternatifhitung[$key] = count($value);
        }
        // dd($resulthitung, $alternatifhitung);

        if ($resulthitung == $alternatifhitung) {
            return redirect()->back()->with('toast_error', 'Semua Data Toko Telah Diinput');
        } else {

            return view('admin.penilaian.create', $data, compact('hitung', 'resulthitung', 'alternatifhitung'));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        foreach ($request->kriteria as $key => $value) {
            penilaian($key, $request->alternatif_id, $request->tahun_awal, $request->tahun_akhir, $value);
        }

        $result = Hitung($request->tahun_awal, $request->tahun_akhir);
        // dd($result);
        if ($result->wasRecentlyCreated) {

            return redirect('/penilaian?tahun_awal=' . $request->tahun_awal . '&tahun_akhir=' . $request->tahun_akhir)->with('toast_success', 'Data berhasil ditambahkan');
        } else {

            return redirect('/penilaian?tahun_awal=' . $request->tahun_awal . '&tahun_akhir=' . $request->tahun_akhir)->with('toast_success', 'Data berhasil edit');
        }
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
            'title' => 'Penilaian',
            'kriteria' =>  KriteriaModel::with('atribut_penilaian')->get()->sortByDesc('bobot_kriteria'),
            'alternatif' =>  AlternatifModel::all()->sortBy('lokasi_toko'),
            'result' =>  ResultModel::where('id', $id)->with('toko')->first(),

        ];
        $penilaian = PenilaianModel::where('tahun_awal', $data['result']->tahun_awal)->where('tahun_akhir', $data['result']->tahun_akhir)->where('alternatif_id', $data['result']->alternatif_id)->with('kriteria.atribut_penilaian')->get();

        $count = [];
        $hitung = [];
        $resultCount = [];
        $resulthitung = [];
        $alternatifCount = [];
        $alternatifhitung = [];
        foreach ($data['kriteria'] as $key => $value) {
            foreach ($value->atribut_penilaian as $key_2 => $value_2) {
                $count[$value->id][] = $value_2;
            }
        }
        // dd($count);
        foreach ($count as $key => $value) {
            $hitung[$key][] = count($value);
        }

        $resultCount[$data['result']->alternatif_id][] = $data['result'];

        // dd($resultCount);
        foreach ($resultCount as $key => $value) {
            $resulthitung[$key] = count($value);
        }

        foreach ($data['alternatif'] as $key => $value) {

            $alternatifCount[$value->id][] = $value;
        }
        // dd($alternatifCount);
        foreach ($alternatifCount as $key => $value) {
            $alternatifhitung[$key] = count($value);
        }
        // dd($resulthitung, $alternatifhitung);

        if ($resulthitung == $alternatifhitung) {
            return redirect()->back()->with('toast_error', 'Semua Data Toko Telah Diinput');
        } else {


            return view('admin.penilaian.show', $data, compact('hitung', 'penilaian'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Request $request)
    {

        $data = [
            'title' => 'Penilaian',
            'kriteria' =>  KriteriaModel::with('atribut_penilaian')->get()->sortByDesc('bobot_kriteria'),

            'alternatif' =>  AlternatifModel::all()->sortBy('lokasi_toko'),
            'result' =>  ResultModel::where('id', $id)->with('toko')->first(),

        ];
        // $penilaian = PenilaianModel::where('tahun_awal', $data['result']->tahun_awal)->where('tahun_akhir', $data['result']->tahun_akhir)->where('alternatif_id', $data['result']->alternatif_id)->with('kriteria', 'atribut_penilaian')->get();
        $penilaian = KriteriaModel::with(['penilaian.atribut_penilaian', 'penilaian' => function ($query) use ($data) {
            $query->where([['alternatif_id', $data['result']->alternatif_id], ['tahun_awal', $data['result']->tahun_awal], ['tahun_akhir', $data['result']->tahun_akhir]]);
        }])->get();
        // return ($penilaian);

        $count = [];
        $hitung = [];
        $resultCount = [];
        $resulthitung = [];
        $alternatifCount = [];
        $alternatifhitung = [];
        foreach ($data['kriteria'] as $key => $value) {
            foreach ($value->atribut_penilaian as $key_2 => $value_2) {
                $count[$value->id][] = $value_2;
            }
        }
        // dd($count);
        foreach ($count as $key => $value) {
            $hitung[$key][] = count($value);
        }

        $resultCount[$data['result']->alternatif_id][] = $data['result'];

        // dd($resultCount);
        foreach ($resultCount as $key => $value) {
            $resulthitung[$key] = count($value);
        }

        foreach ($data['alternatif'] as $key => $value) {

            $alternatifCount[$value->id][] = $value;
        }
        // dd($alternatifCount);
        foreach ($alternatifCount as $key => $value) {
            $alternatifhitung[$key] = count($value);
        }
        // dd($hitung);




        return view('admin.penilaian.edit', $data, compact('hitung', 'penilaian'));
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
    public function destroy($id, Request $request)
    {

        $tAwal = $request->tahun_awal;
        $tAkhir = $request->tahun_akhir;


        ResultModel::where('alternatif_id', $id)->where('tahun_awal', $tAwal)->where('tahun_akhir', $tAkhir)->delete();
        PenilaianModel::where('alternatif_id', $id)->where('tahun_awal', $tAwal)->where('tahun_akhir', $tAkhir)->delete();

        $penilaian_get = PenilaianModel::where('tahun_awal', $tAwal)->where('tahun_akhir', $tAkhir)->get();
        // dd($penilaian_get);
        if ($penilaian_get->isNotEmpty()) {
            Hitung($tAwal, $tAkhir);
            return redirect()->back()->with('toast_success', 'Data berhasil dihapus');
        } else {
            return redirect()->back()->with('toast_success', 'Data berhasil dihapus');
        }
    }

    public function filter()
    {
        $data = [
            'title' => 'Filter Penilaian',
        ];
        $kriteria = KriteriaModel::all();
        $hitungKriteria = [
            'benefit' => KriteriaModel::where('atribut_kriteria', 'benefit')->count(),
            'cost' => KriteriaModel::where('atribut_kriteria', 'cost')->count(),
            'nilai' => KriteriaModel::where('bobot_kriteria', '0')->count(),
        ];


        if ($hitungKriteria['nilai'] > 0 || $hitungKriteria['benefit'] < 2 || $hitungKriteria['cost'] < 1) {
            return redirect()->back()->with('toast_error', 'Silahkan Tambahkan 2 Kriteria Benefit dan 1 Kriteria Cost Kemudian Hitung Bobotnya');
        } else {

            return view('admin.penilaian.filter', $data);
        }
    }
    // dd($tes)

}
