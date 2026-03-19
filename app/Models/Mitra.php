<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mitra extends Model
{
    use HasFactory;
    protected $table = 'mitra';
    protected $fillable = ['nama','kontak','alamat'];

    public function hutang() {
        return $this->hasMany(Hutang::class);
    }

    public function piutang() {
        return $this->hasMany(Piutang::class);
    }
}

