<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\Admin\StaffController;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PenilaianModel extends Model
{
    use HasFactory;
    protected $table = 'penilaian';
    protected $fillable = ['alternatif_id', 'kriteria_id', 'value', 'tahun_awal', 'tahun_akhir'];
    public $timestamps = false;


    public function kriteria()
    {
        return $this->hasMany(KriteriaModel::class, 'id', 'kriteria_id');
    }
    public function atribut_penilaian()
    {
        return $this->hasOne(AtributPenilaianModel::class, 'kriteria_id', 'kriteria_id');
    }
}
