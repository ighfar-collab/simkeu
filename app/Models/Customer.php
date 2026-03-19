<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Customer extends Model
{
    use HasFactory;
    protected $fillable = ['nama','no_hp','alamat'];

   public function transactions()
{
    return $this->hasMany(Transaction::class);
}

public function loans()
{
    return $this->hasMany(Loan::class);
}
}