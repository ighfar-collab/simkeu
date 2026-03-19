<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CashFlow extends Model
{
    protected $table = 'cash_flows';

    protected $fillable = [
        'tanggal',
        'jenis',
        'nominal',
        'sumber',
        'ref_id',
        'keterangan'
    ];

    protected $casts = [
        'tanggal' => 'datetime',
        'nominal' => 'integer'
    ];

    // relasi ke transaksi
    public function transaction()
    {
        return $this->belongsTo(Transaction::class, 'ref_id');
    }
}