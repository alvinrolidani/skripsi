<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KriteriaModel extends Model
{
    use HasFactory;

    protected $table = 'kriteria';
    protected $fillable = ['kode_kriteria', 'nama_kriteria', 'atribut_kriteria', 'bobot_kriteria'];
    public $timestamps = false;



    public function atribut_penilaian()
    {
        return $this->hasMany(AtributPenilaianModel::class, 'kriteria_id', 'id');
    }
    public function penilaian()
    {
        return $this->hasMany(PenilaianModel::class, 'kriteria_id', 'id');
    }
}
