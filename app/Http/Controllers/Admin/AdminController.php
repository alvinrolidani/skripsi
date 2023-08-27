<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\SiswaModel;
use App\Models\ResultModel;
use Illuminate\Http\Request;
use App\Models\KriteriaModel;
use App\Models\PenilaianModel;
use App\Models\AlternatifModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function index()
    {

        $data = [
            'title' => 'Dashboard',
            'alternatif' => AlternatifModel::all()->count(),
            'kriteria' => KriteriaModel::all()->count(),
            'bobot_kriteria' => round(KriteriaModel::sum('bobot_kriteria') * 100, 4),
            'penilaian' => ResultModel::with('toko')->get()->groupBy('tahun_awal')
        ];
        $tess = [];
        if ($data['penilaian']->isNotEmpty()) {

            foreach ($data['penilaian'] as $key => $value) {
                foreach ($value as $key1 => $value1) {

                    $tes[$key . ' - ' . $value1->tahun_akhir][] = ['hasil' => $value1->hasil, 'toko' => $value1->toko->nama_toko,];
                }
            }

            foreach ($tes as $key2 => $value2) {
                $tess[$key2] = min($value2);
                return view('admin.dashboard.index', $data, compact('tess'));
            }
        } else {;
            return view('admin.dashboard.index', $data, compact('tess'));
        }



        // dd($tess);

    }
}
