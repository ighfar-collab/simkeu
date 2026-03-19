<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $table = 'Transactions';
     protected $fillable = [
        'invoice',
        'customer_id',
        'total',
        'bayar',
        'kembali',
        
    ];

    public function details() {
        return $this->hasMany(TransactionDetail::class);
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

