<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PerbandinganKriteriaModel extends Model
{
    use HasFactory;

    protected $table = 'perbandingan_kriteria';
    protected $fillable = ['kriteria_pertama', 'kriteria_kedua', 'kepentingan', 'nilai'];
    public $timestamps = false;
}
