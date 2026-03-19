<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'transaction_id',
        'supplier_id',
        'pembelian_id',
        'jenis',
        'nominal',
        'sisa',
        'status',
        'keterangan'
    ];

    /*
    Relasi ke Customer
    */
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    /*
    Relasi ke Transaction (POS)
    */
    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }
public function supplier()
{
    return $this->belongsTo(Supplier::class);
}
    /*
    Relasi ke Installments (angsuran)
    */
    public function installments()
    {
        return $this->hasMany(Installment::class);
    }
    public function pembelian()
{
    return $this->belongsTo(Pembelian::class);
}

}