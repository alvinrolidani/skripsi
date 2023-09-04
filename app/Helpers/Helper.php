<?php

use App\Models\ResultModel;
use App\Models\KriteriaModel;
use App\Models\PenilaianModel;
use Clockwork\Request\Request;
use App\Models\AlternatifModel;

function penilaian($kriteria, $alternatif_id, $tahun_awal, $tahun_akhir, $value)
{


    return PenilaianModel::updateOrCreate(
        [
            'alternatif_id' => $alternatif_id,
            'kriteria_id' => $kriteria,
            'tahun_awal' => $tahun_awal,
            'tahun_akhir' => $tahun_akhir
        ],
        [

            'alternatif_id' => $alternatif_id,
            'kriteria_id' => $kriteria,
            'value' => $value,
            'tahun_awal' => $tahun_awal,
            'tahun_akhir' => $tahun_akhir
        ]
    );
}
function Hitung($tahun_awal = null, $tahun_akhir = null)
{

    $kriteria = KriteriaModel::all();

    $penilaian = null;

    $result = null;

    if ($tahun_awal == null && $tahun_akhir == null) {
        $penilaian = PenilaianModel::with('kriteria')->get();
    } else {
        $penilaian = PenilaianModel::with('kriteria')->where('tahun_awal', $tahun_awal)->where('tahun_akhir', $tahun_akhir)->get();
    }




    //MATRIX KEPUTUSAN
    foreach ($kriteria as $key1 => $value1) {
        foreach (collect($penilaian) as $key2 => $value_2) {
            if ($value1->id == $value_2->kriteria_id) {
                $keputusan[$value1->id][$value_2->alternatif_id] = $value_2->value;
            }
        }
    }
    // dd($keputusan);



    //NORMALISASI TERHADAP MATRIX
    foreach ($keputusan as $key => $value) {
        $normalisasi[$key] = array_sum($keputusan[$key]);
    }
    // dd($keputusan, $normalisasi);
    // dd($keputusan);

    //MATRIX NORMALISASI TERBOBOT
    foreach ($keputusan as $key => $value) {
        foreach (collect($penilaian) as $key1 => $value2) {
            $hasilNormalisasi[$key][$value2->alternatif_id] =  $value[$value2->alternatif_id] / $normalisasi[$key];
        }
    }


    // dd($hasilNormalisasi);
    //MATRIX PERKALIAN DENGANB BOBOT KRITERIA

    foreach ($kriteria as $key1 => $value1) {
        foreach (collect($penilaian) as $key2 => $value_2) {
            if ($value1->id == $value_2->kriteria_id) {
                $normalisasiTerbobot[$value1->id][$value_2->alternatif_id] = $hasilNormalisasi[$value1->id][$value_2->alternatif_id] * $value1->bobot_kriteria;
            }
        }
    }
    // dd($normalisasiTerbobot);

    foreach ($normalisasiTerbobot as $key => $value) {
        $alterCost = $value;
    }
    // dd($alterCost);
    //MENENTUKAN S-i dan S+i
    foreach ($alterCost as $key => $value) {
        foreach ($kriteria as $key1 => $value1) {
            if ($value1->atribut_kriteria == 'benefit') {
                $hasilPlus[$key][$value1->id] = $normalisasiTerbobot[$value1->id][$key];
            } elseif ($value1->atribut_kriteria == 'cost') {
                $hasilMin[$key][$value1->id] = $normalisasiTerbobot[$value1->id][$key];
            }
        }
    }
    // dd($hasilPlus);
    // dd($hasilMin);
    foreach ($hasilPlus as $key => $value) {
        $Splus[$key] = array_sum($value);
    }
    foreach ($hasilMin as $key => $value) {
        $Smin[$key] = array_sum($value);
    }

    // dd($Splus);
    // dd($Smin);

    //Mencari S-min

    $S_min = min($Smin);

    // dd($S_min);



    //Jumlah S-i(Sigma S-i)
    $JmlSmin = array_sum($Smin);
    // dd($JmlSmin);



    //MENENTUKAN SIGNFIKANSI ALTERNATIF atau Qi (Bobot relatif)
    //S-min/S-i
    foreach ($Smin as $key => $value) {
        $SminTerbagi[$key] = $S_min / $value;
    }
    // dd($SminTerbagi);



    //Jumlah sigma(S-min/S-i) Terbagi
    $JmlSigmaSmin = array_sum($SminTerbagi);

    // dd($JmlSigmaSmin);



    //S-i dikali JmlhSminTerbagi
    //JUMLAH S-I KALI SIGMA (S-min/S-i)
    foreach ($Smin as $key => $value) {
        $hasilSminKali[$key] = $value * $JmlSigmaSmin;
    }
    // dd($hasilSminKali);


    //Jumlah Sigma S-i dibagi hasilS-min
    foreach ($hasilSminKali as $key => $value) {
        $hasilSminTerbagi[$key] =   $S_min * $JmlSmin / $value;
    }
    // dd($hasilSminTerbagi);


    //HASIL Qi


    foreach ($hasilSminTerbagi as $key => $value) {
        $qi[$key] = round($Splus[$key] + $value, 14);
    }
    // dd($qi);



    //QMAX
    $qmax = max($qi);
    // dd($qmax);


    //Hasil Nilai utilitas
    foreach ($qi as $key => $value) {
        $hasilUi[$key] = round(($value / $qmax) * 100, 8);
    }

    foreach ($hasilUi as $key => $value) {
        if ($tahun_awal == null && $tahun_akhir == null) {
            $result = ResultModel::whereIn('alternatif_id', [$key])->update(['hasil' => $value]);
        } else {
            $result = ResultModel::updateOrCreate(
                [
                    'alternatif_id' => $key,
                    'tahun_awal' => $tahun_awal,
                    'tahun_akhir' => $tahun_akhir,

                ],
                [
                    'alternatif_id' => $key,
                    'tahun_awal' => $tahun_awal,
                    'tahun_akhir' => $tahun_akhir,
                    'hasil' => $value,
                ]
            );
        }
    }




    return $result;
}
