<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AtributPenilaianModel extends Model
{
    use HasFactory;

    protected $table = 'atribut_penilaian';
    protected $fillable = ['kriteria_id', 'nama_atribut', 'bobot'];
    public $timestamps = false;



    public function kriteria()
    {
        return $this->belongsTo(KriteriaModel::class);
    }
}
