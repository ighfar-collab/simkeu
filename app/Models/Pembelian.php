<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pembelian extends Model
{
    protected $fillable = [
        'kode',
        'supplier_id',
        'tanggal',
        'total',
          'metode_bayar',
    'dibayar',
    'sisa'
    ];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function details()
    {
        return $this->hasMany(PembelianDetail::class);
    }
    public function loan()
{
    return $this->hasOne(Loan::class);
}
}