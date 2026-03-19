<?php

namespace App\Http\Controllers;

use App\Models\Pembelian;
use App\Models\PembelianDetail;
use App\Models\Barang;
use App\Models\Supplier;
use App\Models\Loan;
use App\Models\Installment;
use App\Models\CashFlow;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PembelianController extends Controller
{

    public function index()
    {
        $data = Pembelian::with('supplier')->latest()->get();
        return view('pembelian.index', compact('data'));
    }

    public function create()
    {
        $supplier = Supplier::all();
        $barang = Barang::all();

        return view('pembelian.create', compact('supplier','barang'));
    }
public function store(Request $request)
{

    DB::beginTransaction();

    try {

        $dibayar = $request->dibayar ?? 0;
        $sisa = $request->total - $dibayar;

        $pembelian = Pembelian::create([
            'kode' => 'PB'.time(),
            'supplier_id' => $request->supplier_id,
            'tanggal' => $request->tanggal,
            'total' => $request->total,
            'metode_bayar' => $request->metode_bayar,
            'dibayar' => $dibayar,
            'sisa' => $sisa
        ]);

        foreach($request->barang_id as $key => $barang_id){

            $qty = $request->qty[$key];
            $harga = $request->harga[$key];
            $subtotal = $qty * $harga;

            PembelianDetail::create([
                'pembelian_id' => $pembelian->id,
                'barang_id' => $barang_id,
                'qty' => $qty,
                'harga' => $harga,
                'subtotal' => $subtotal
            ]);

            // update stok barang
            $barang = Barang::find($barang_id);
            $barang->stok += $qty;
            $barang->save();
        }

        // ===============================
        // JIKA PEMBELIAN KREDIT
        // ===============================

        if($request->metode_bayar == 'kredit'){

            $loan = Loan::create([
                'kode' => 'LN'.time(),
                'supplier_id' => $request->supplier_id,
                'pembelian_id' => $pembelian->id,
                'nominal' => $request->total,
                'dibayar' => $dibayar,
                'sisa' => $sisa,
                'jenis' => 'utang',
                'tanggal' => $request->tanggal
            ]);

            // jika ada DP
            if($dibayar > 0){

                Installment::create([
                    'loan_id' => $loan->id,
                    'bayar' => $sisa,
                    'tanggal' => $request->tanggal
                ]);

                CashFlow::create([
                    'keterangan' => 'DP Pembelian '.$pembelian->kode,
                    'jenis' => 'keluar',
                    'nominal' => $dibayar,
                    'sumber'  => '-',
                    'tanggal' => $request->tanggal
                ]);
            }

        }

        // ===============================
        // JIKA CASH
        // ===============================

        if($request->metode_bayar == 'cash'){

            CashFlow::create([
                'keterangan' => 'Pembelian Barang '.$pembelian->kode,
                'keluar' => $request->total,
                'tanggal' => $request->tanggal
            ]);

        }

        DB::commit();

        return redirect()->route('pembelian.index')
            ->with('success','Pembelian berhasil disimpan');

    } catch (\Exception $e){

        DB::rollBack();
        dd($e->getMessage());
        return back()->with('error',$e->getMessage());

    }

}
    public function show($id)
{
    $pembelian = Pembelian::with('supplier','details.barang')->findOrFail($id);

    return view('pembelian.show', compact('pembelian'));
}

}