<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PosisiModel extends Model
{
    use HasFactory;
    protected $table = 'posisi';
    protected $guarded = [];


    public function staff()
    {
        return  $this->hasMany(StaffModel::class, 'posisi_id', 'id');
    }
}
