<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stoklog extends Model
{
    use HasFactory;
     protected $table = 'stok_logs';
    protected $fillable = ['barang_id','tipe','jumlah','keterangan'];
}
