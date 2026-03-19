<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sumber extends Model
{
    use HasFactory;
    protected $table = 'sumber';
    protected $fillable = ['nama','saldo'];

    public function pemasukan() {
        return $this->hasMany(Pemasukan::class);
    }

    public function pengeluaran() {
        return $this->hasMany(Pengeluaran::class);
    }
}
