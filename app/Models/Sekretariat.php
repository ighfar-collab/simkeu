<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sekretariat extends Model
{
    use HasFactory;

    protected $fillable = [
        'month',
        'year',
        'nilai_sakip',
    ];

    protected $casts = [
        'tahun' => 'integer',
        'nilai_sakip' => 'float',
    ];
}
