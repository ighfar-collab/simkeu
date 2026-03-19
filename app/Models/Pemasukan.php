<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemasukan extends Model
{
    use HasFactory;
    protected $table = 'pemasukan';
    protected $fillable = [
        'tanggal','sumber_dana_id','kategori_id',
        'nominal','keterangan','user_id'
    ];

    public function sumber() {
        return $this->belongsTo(SumberDana::class,'sumber_dana_id');
    }

    public function kategori() {
        return $this->belongsTo(Kategori::class);
    }
}
