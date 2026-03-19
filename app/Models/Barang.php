<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Barang extends Model
{
        use HasFactory;
        protected $table = 'barang';
    protected $fillable = [
        'id_barang','id_kategori','barcode','nama_barang','merk','harga_beli',
        'harga_jual','stok'
    ];
      public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }
    public function pembelianDetails()
{
    return $this->hasMany(PembelianDetail::class);
}
}
