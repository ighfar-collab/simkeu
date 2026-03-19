<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransactionDetail extends Model
{
    protected $table = 'transaction_details';

    protected $fillable = [
        'transaction_id',
        'barang_id',
        'qty',
        'price',
        'subtotal',
    ];

    /**
     * Relasi ke transaksi (header)
     */
    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }

    /**
     * Relasi ke produk
     */
    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }
}