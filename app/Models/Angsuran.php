<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Angsuran extends Model
{
    protected $fillable = [
        'tipe','relasi_id','tanggal',
        'nominal','sumber_dana_id'
    ];

    public function sumber() {
        return $this->belongsTo(Sumber::class,'sumber_dana_id');
    }
}

