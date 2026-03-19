<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\StokLog;

use Illuminate\Http\Request;

class StokController extends Controller
{
    public function masuk(Request $request, $id)
{
    $barang = Barang::findOrFail($id);

    $request->validate(['jumlah' => 'required|numeric|min:1']);

    $barang->increment('stok', $request->jumlah);

    StokLog::create([
        'barang_id' => $barang->id,
        'tipe' => 'masuk',
        'jumlah' => $request->jumlah
    ]);

    return back()->with('success','Stok masuk berhasil');
}

public function keluar(Request $request, $id)
{
    $barang = Barang::findOrFail($id);

    if ($barang->stok < $request->jumlah) {
        return back()->with('error','Stok tidak cukup');
    }

    $barang->decrement('stok', $request->jumlah);

    StokLog::create([
        'barang_id' => $barang->id,
        'tipe' => 'keluar',
        'jumlah' => $request->jumlah
    ]);

    return back()->with('success','Stok keluar berhasil');
}

}
