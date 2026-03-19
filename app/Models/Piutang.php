<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Piutang extends Model
{
    use HasFactory;
     protected $table = 'piutang';
    protected $fillable = ['tanggal','mitra_id','total','sisa','keterangan','status'];

    public function mitra() {
        return $this->belongsTo(Mitra::class);
    }

    public function angsuran() {
        return $this->hasMany(Angsuran::class,'relasi_id')
            ->where('tipe','piutang');
    }
}
