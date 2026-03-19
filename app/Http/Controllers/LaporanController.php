<?php

namespace App\Http\Controllers;

use App\Models\Transaction;

use Illuminate\Http\Request;

class LaporanController extends Controller
{
  public function penjualanHarian(Request $request)
{

$tanggal = $request->tanggal ?? date('Y-m-d');

$data = Transaction::whereDate('created_at',$tanggal)
->with('customer')
->get();

return view('laporan.penjualan_harian',compact('data','tanggal'));

}

public function penjualanBulanan()
{
    $data = Transaction::whereMonth('created_at', date('m'))->get();
    return view('laporan.penjualan_bulanan',compact('data'));
}

public function penjualanTahunan()
{
    $data = Transaction::whereYear('created_at', date('Y'))->get();
    return view('laporan.penjualan_tahunan',compact('data'));
}
}
