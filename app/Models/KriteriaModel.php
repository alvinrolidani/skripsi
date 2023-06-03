<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KriteriaModel extends Model
{
    use HasFactory;

    protected $table = 'kriteria';
    protected $fillable = ['kode_kriteria', 'nama_kriteria'];

    public function aturan()
    {
        return $this->belongsTo(AturanModel::class);
    }
}
