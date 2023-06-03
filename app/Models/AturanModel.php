<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AturanModel extends Model
{
    use HasFactory;

    protected $table = 'aturan';
    protected $fillable = ['value'];

    public function kriteria()
    {
        return $this->belongsToMany(KriteriaModel::class, 'aturan_kriteria', 'aturan_id', 'kriteria_id')->withPivot(['value']);
    }
}
