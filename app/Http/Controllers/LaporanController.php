<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Pembelian;
use App\Models\CashFlow;
use Carbon\Carbon;
use DB;

class LaporanController extends Controller
{
    // ======================
    // ✅ HARIAN
    // ======================
    public function harian(Request $request)
    {
        $tanggal = $request->tanggal ?? Carbon::today()->toDateString();

        $data = Transaction::whereDate('created_at', $tanggal)->get();

        $totalTransaksi = $data->count();
        $totalPenjualan = $data->sum('total');
        $totalBayar = $data->sum('bayar');

        return view('laporan.penjualan_harian', compact(
            'data','tanggal','totalTransaksi','totalPenjualan','totalBayar'
        ));
    }

    // ======================
    // ✅ BULANAN
    // ======================
    public function bulanan(Request $request)
    {
        $bulan = $request->bulan ?? Carbon::now()->format('Y-m');

        $tahun = substr($bulan, 0, 4);
        $bulanAngka = substr($bulan, 5, 2);

        $data = Transaction::whereYear('created_at', $tahun)
            ->whereMonth('created_at', $bulanAngka)
            ->get();

        $totalTransaksi = $data->count();
        $totalPenjualan = $data->sum('total');

        $rekapHarian = Transaction::select(
                DB::raw('DATE(created_at) as tanggal'),
                DB::raw('count(*) as total_transaksi'),
                DB::raw('sum(total) as total_penjualan')
            )
            ->whereYear('created_at', $tahun)
            ->whereMonth('created_at', $bulanAngka)
            ->groupBy('tanggal')
            ->get();

        return view('laporan.penjualan_bulanan', compact(
            'data','bulan','totalTransaksi','totalPenjualan','rekapHarian'
        ));
    }

    // ======================
    // ✅ TAHUNAN
    // ======================
    public function tahunan(Request $request)
    {
        $tahun = $request->tahun ?? Carbon::now()->year;

        $data = Transaction::whereYear('created_at', $tahun)->get();

        $totalTransaksi = $data->count();
        $totalPenjualan = $data->sum('total');

        $rekapBulanan = Transaction::select(
                DB::raw('MONTH(created_at) as bulan'),
                DB::raw('count(*) as total_transaksi'),
                DB::raw('sum(total) as total_penjualan')
            )
            ->whereYear('created_at', $tahun)
            ->groupBy('bulan')
            ->get();

        return view('laporan.penjualan_tahunan', compact(
            'data','tahun','totalTransaksi','totalPenjualan','rekapBulanan'
        ));
    }

    public function pembelian(Request $request)
    {
        $bulan = $request->bulan ?? date('m');
        $tahun = $request->tahun ?? date('Y');

        // Data utama
        $data = Pembelian::whereYear('tanggal', $tahun)
            ->whereMonth('tanggal', $bulan)
            ->get();

        $totalTransaksi = $data->count();
        $totalPembelian = $data->sum('total');

        // Rekap harian
        $rekapHarian = Pembelian::select(
                DB::raw('DATE(tanggal) as tanggal'),
                DB::raw('count(*) as total_transaksi'),
                DB::raw('sum(total) as total_pembelian')
            )
            ->whereYear('tanggal', $tahun)
            ->whereMonth('tanggal', $bulan)
            ->groupBy('tanggal')
            ->get();

        return view('laporan.pembelian_bulanan', compact(
            'data',
            'bulan',
            'tahun',
            'totalTransaksi',
            'totalPembelian',
            'rekapHarian'
        ));
    }
  
    public function cashflow(Request $request)
    {
        $bulan = $request->bulan ?? date('m');
        $tahun = $request->tahun ?? date('Y');

        // 💰 Kas Masuk (Penjualan)
        $kasMasuk = Transaction::whereYear('created_at', $tahun)
            ->whereMonth('created_at', $bulan)
            ->sum('total');

        // 💸 Kas Keluar (Pembelian)
        $pembelian = Pembelian::whereYear('tanggal', $tahun)
            ->whereMonth('tanggal', $bulan)
            ->sum('total');

    

        $kasKeluar = $pembelian;

        // 📊 Saldo
        $saldo = $kasMasuk - $kasKeluar;

        // 📅 Rekap harian
        $rekapHarian = DB::table('transactions')
            ->select(
                DB::raw('DATE(created_at) as tanggal'),
                DB::raw('SUM(total) as kas_masuk')
            )
            ->whereYear('created_at', $tahun)
            ->whereMonth('created_at', $bulan)
            ->groupBy('tanggal')
            ->get();

        return view('laporan.cashflow_bulanan', compact(
            'bulan',
            'tahun',
            'kasMasuk',
            'kasKeluar',
            'saldo',
            'rekapHarian'
        ));
    }
}
