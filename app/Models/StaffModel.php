<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StaffModel extends Model
{
    use HasFactory;

    protected $table = 'staff';
    protected $guarded = [];

    public function posisi()
    {
        return $this->belongsTo(PosisiModel::class);
    }
}
