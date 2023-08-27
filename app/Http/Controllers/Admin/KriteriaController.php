<?php

namespace App\Http\Controllers\Admin;

use App\Models\AturanModel;
use App\Models\ResultModel;
use Illuminate\Http\Request;
use App\Models\KriteriaModel;
use App\Models\PenilaianModel;
use App\Http\Controllers\Controller;
use App\Models\AtributPenilaianModel;
use App\Models\PerbandinganKriteriaModel;

class KriteriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $data = [
            'title' => 'Kriteria',
            'kriteria' => KriteriaModel::with('atribut_penilaian')->orderByDesc('bobot_kriteria')->get()
        ];
        $count = [];
        $hitung = [];

        // dd($data['kriteria']);
        foreach ($data['kriteria'] as $key => $value) {
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


        // return response()->json($hitung);
        return view('admin.kriteria.index', $data, compact('hitung', 'total'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $data = [
            'title' => 'Tambah Kriteria',
            'kriteria' => KriteriaModel::get()
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

        KriteriaModel::create([

            'nama_kriteria' => $request->nama_kriteria,
            'atribut_kriteria' => $request->atribut_kriteria,
            'bobot_kriteria' => 0,
        ]);

        $kriteria = KriteriaModel::orderBy('id', 'DESC')->first();
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
                            'kriteria_id' => $kriteria->id
                        ],
                        [

                            'alternatif_id' => $key,
                            'kriteria_id' => $kriteria->id,
                            'tahun_awal' => $value1->tahun_awal,
                            'tahun_akhir' => $value1->tahun_akhir,
                            'value' => 1,
                        ]
                    );
                }
            }
            return redirect()->route('kriteria.index')->with('toast_success', 'Data berhasil ditambahkan');
        } else {
            return redirect()->route('kriteria.index')->with('toast_success', 'Data berhasil ditambahkan');
        }

        // dd($result);
        // return redirect()->route('kriteria.index')->with('toast_success', 'Data berhasil ditambahkan');
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
            'title' => 'Lihat Detail Kriteria',
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
            'title' => 'Edit Kriteria',
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

        KriteriaModel::findOrFail($id)->update([

            'nama_kriteria' => $request->nama_kriteria,
            'atribut_kriteria' => $request->atribut_kriteria,

        ]);
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
        PerbandinganKriteriaModel::where('kriteria_pertama', $id)->orWhere('kriteria_kedua', $id)->delete();

        $penilaian_get = PenilaianModel::with('kriteria')->get();

        $hitungKriteria = [
            'benefit' => KriteriaModel::where('atribut_kriteria', 'benefit')->count(),
            'cost' => KriteriaModel::where('atribut_kriteria', 'cost')->count(),
        ];
        if ($penilaian_get->isNotEmpty() && $hitungKriteria['benefit'] >= 2 && $hitungKriteria['cost'] >= 1) {
            Hitung();
            return redirect()->route('kriteria.index')->with('toast_success', 'Data berhasil dihapus');
        } else {
            return redirect()->route('kriteria.index')->with('toast_success', 'Data berhasil dihapus');
        }
    }


    public function bobot_kriteria()
    {
        $data = [
            'title' => 'Hitung Bobot Kriteria',
            'kriteria' => KriteriaModel::all(),
            'perbandingan' => PerbandinganKriteriaModel::all()
        ];

        $pilihan = [];
        // $rowId = [];
        // $tingkatkepentingan = [];
        $hitungKriteria = [
            'benefit' => KriteriaModel::where('atribut_kriteria', 'benefit')->count(),
            'cost' => KriteriaModel::where('atribut_kriteria', 'cost')->count(),
        ];

        $kriteria = $data['kriteria'];
        if ($kriteria->isNotEmpty() && $hitungKriteria['benefit'] >= 2 && $hitungKriteria['cost'] >= 1) {


            $count = $kriteria->count();
            // dd($count);
            foreach ($kriteria as $item) {
                $pilihan[] = $item->nama_kriteria;
                $rowId[] = $item->id;
            }

            $tingkatkepentingan = [
                9 => 'Mutlak lebih penting',
                8 => 'Sangat lebih dan mutlak lebih penting',
                7 => 'Sangat lebih penting',
                6 => 'Lebih dan sangat lebih penting',
                5 => 'Lebih penting',
                4 => 'Sedikit lebih dan lebih penting',
                3 => 'Sedikit lebih penting',
                2 => 'Sama dan sedikit lebih penting',
                1 => 'Sama Penting',

            ];


            return view('admin.bobot.index', $data, compact('pilihan', 'count', 'tingkatkepentingan', 'rowId'));
        } else {

            return redirect()->back()->with('toast_error', 'Silahkan Input Minimal 2 Kriteria Benefit dan 1 Kriteria Cost Untuk Melanjutkan');
        }
    }

    public function hitungbobot(Request $request)
    {
        $data = [
            'title' => 'Hitung Bobot Kriteria',
            'kriteria' => KriteriaModel::all()
        ];
        //Jumlah Ratio Index
        $ir = [
            1 => 0,
            2 => 0.00,
            3 => 0.58,
            4 => 0.90,
            5 => 1.12,
            6 => 1.24,
            7 => 1.32,
            8 => 1.41,
            9 => 1.45,
            10 => 1.49,
            11 => 1.51,
            12 => 1.48,
            13 => 1.56,
            14 => 1.57,
            15 => 1.59,
        ];
        $kriteria = $data['kriteria'];
        $tes = 0;
        foreach ($kriteria as $item) {
            $listId[$tes++] = $item->id;
        }
        //Jumlah Matriks
        $count = $kriteria->count();
        $urut = 0;
        for ($x = 0; $x <= ($count - 2); $x++) {
            for ($y = ($x + 1); $y <= ($count - 1); $y++) {
                $urut++;
                $pilih    = "pilih" . $urut;
                $bobot     = "bobot" . $urut;

                if ($request->$pilih == 1) {
                    $matrik[$x][$y] = $request->$bobot;
                    $matrik[$y][$x] = 1 / $request->$bobot;
                } else {
                    $matrik[$x][$y] = 1 / $request->$bobot;
                    $matrik[$y][$x] = $request->$bobot;
                }

                $pp[$x][$y] = $request->$bobot;
                $pp[$y][$x] = $request->$bobot;

                PerbandinganKriteriaModel::updateOrCreate(
                    [
                        'kriteria_pertama' => $listId[$x],
                        'kriteria_kedua' => $listId[$y],

                    ],
                    [

                        'kriteria_pertama' => $listId[$x],
                        'kriteria_kedua' => $listId[$y],
                        'nilai' => $matrik[$x][$y],
                        'kepentingan' => $pp[$x][$y],
                    ]
                );
            }
        }
        // diagonal --> bernilai 1
        for ($i = 0; $i <= ($count - 1); $i++) {
            $matrik[$i][$i] = 1;
        }

        // inisialisasi jumlah tiap kolom dan baris kriteria
        $jmlmpb = [];
        $jmlmnk = [];
        $sumweighted = [];
        $Cm = [];
        for ($i = 0; $i <= ($count - 1); $i++) {
            $jmlmpb[$i] = 0;
            $jmlmnk[$i] = 0;
        }

        // menghitung jumlah pada kolom kriteria tabel perbandingan berpasangan
        for ($x = 0; $x <= ($count - 1); $x++) {
            for ($y = 0; $y <= ($count - 1); $y++) {
                $value        = $matrik[$x][$y];
                $jmlmpb[$y] += $value;
            }
        }


        // Menghitung jumlah pada baris kriteria tabel nilai kriteria
        // Matrikb merupakan matrik yang telah dinormalisasi
        for ($x = 0; $x <= ($count - 1); $x++) {
            for ($y = 0; $y <= ($count - 1); $y++) {
                $matrikb[$x][$y] = $matrik[$x][$y] / $jmlmpb[$y];
                $value    = $matrikb[$x][$y];
                $jmlmnk[$x] += $value;
            }

            // nilai priority vektor
            $pv[$x]     = $jmlmnk[$x] / $count;
            $persentase[$x] = round($jmlmnk[$x] / $count, 4);
        }



        //Mencari Weighted Sum Matrix
        for ($x = 0; $x <= ($count - 1); $x++) {
            for ($y = 0; $y <= ($count - 1); $y++) {
                $weighted[$x][$y] = $matrik[$x][$y] * $pv[$y];
                $sumweighted[$x] = array_sum($weighted[$x]);
            }
        }


        //Mencari Consistency Measure
        for ($x = 0; $x <= ($count - 1); $x++) {

            $Cm[$x] = $sumweighted[$x] / $pv[$x];
        }
        //Mencari Lamda Max
        $lamdamax = array_sum($Cm) / $count;

        //Mencari Consistency Index

        $Ci = ($lamdamax - $count) / ($count - 1);

        //Mencari Consistency Ratio

        $Cr = $Ci / $ir[$count];


        //Konsisten Jika CR <=0.1
        $penilaian = PenilaianModel::all();
        if ($Cr <= 0.1) {
            for ($x = 0; $x <= ($count - 1); $x++) {

                KriteriaModel::whereIn('id', [$listId[$x]])->update(['bobot_kriteria' => $persentase[$x]]);
            }
            if ($penilaian->isNotEmpty()) {
                Hitung();
            }

            return redirect()->route('kriteria.index')->with('toast_success', 'Bobot Berhasil Diupdate');
        } else {
            return redirect()->route('kriteria.index')->with('toast_error', 'CR Melebihi 0,1, Bobot Gagal Diupdate');
        }
    }
}
