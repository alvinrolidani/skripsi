<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResultModel extends Model
{
    use HasFactory;

    protected $table = 'result';

    protected $fillable = ['alternatif_id', 'tahun_awal', 'tahun_akhir', 'hasil'];
    public $timestamps = false;

    public function toko()
    {
        return $this->hasOne(AlternatifModel::class, 'id', 'alternatif_id');
    }
    public function kriteria()
    {
        return $this->belongsToMany(KriteriaModel::class, 'penilaian', 'result_id', 'kriteria_id')
            ->withPivot(['value']);
    }
}
