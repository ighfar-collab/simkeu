<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use App\Models\CashFlow;
use App\Models\Loan; // optional jika ada tabel angsuran
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PosController extends Controller
{
    public function index()
    {
        $items = Barang::all();
        $transactions = Transaction::latest()->paginate(10);

        return view('barang.barcode', compact('items','transactions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'items.barang_id' => 'required|array',
            'items.qty'       => 'required|array',
            'items.price'     => 'required|array',
            'total'           => 'required|numeric|min:1',
            'metode'          => 'required|in:tunai,kredit',
            'bayar'           => 'nullable|numeric|min:0',
        ]);

        DB::beginTransaction();

        try {
            $metode = $request->metode;
            $total  = (int) $request->total;
            $bayar  = (int) ($request->bayar ?? 0);

            // Hitung kembali & sisa
            $kembali = 0;
            $sisa    = 0;

            if ($metode === 'tunai') {
                if ($bayar < $total) {
                    throw new \Exception("Pembayaran tunai kurang dari total.");
                }
                $kembali = $bayar - $total;
                $sisa = 0;
            } else { // kredit
                if ($bayar > $total) {
                    // kalau bayar lebih saat kredit, tetap boleh tapi sisanya jadi kembali
                    $kembali = $bayar - $total;
                    $sisa = 0;
                } else {
                    $sisa = $total - $bayar; // hutang
                }
            }

            // 1️⃣ Simpan transaksi
            $transaction = Transaction::create([
                'invoice' => 'INV-'.date('Ymd').'-'.Str::random(5),
                'tanggal' => now(),
                'total'   => $total,
                'bayar'   => $bayar,
                'kembali' => $kembali,
                'metode'  => $metode,
                'sisa'    => $sisa
            ]);

            // 2️⃣ Simpan detail + update stok
            foreach ($request->items['barang_id'] as $index => $itemId) {
                if (!$itemId) continue;

                $item  = Barang::lockForUpdate()->findOrFail($itemId);
                $qty   = (int) $request->items['qty'][$index];
                $harga = (int) $request->items['price'][$index];

                if ($item->stok < $qty) {
                    throw new \Exception("Stok {$item->nama} tidak cukup");
                }

                TransactionDetail::create([
                    'transaction_id' => $transaction->id,
                    'barang_id'      => $item->id,
                    'qty'            => $qty,
                    'price'          => $harga,
                    'subtotal'       => $qty * $harga,
                ]);

                $item->decrement('stok', $qty);
            }

            // 3️⃣ Cashflow jika ada uang masuk
            if ($bayar > 0) {
                CashFlow::create([
                    'tanggal'    => now(),
                    'jenis'      => 'masuk',
                    'nominal'    => $total,
                    'sumber'     => $metode === 'tunai' ? 'penjualan tunai' : 'dp kredit',
                    'ref_id'     => $transaction->id,
                    'keterangan' => $transaction->invoice,
                ]);
            }

            // 4️⃣ Jika kredit dan ada bayar awal, catat sebagai angsuran
            if ($metode === 'kredit' && $bayar > 0 && class_exists(Loan::class)) {
                Loan::create([
                    'transaction_id' => $transaction->id,
                    'nominal'        => $bayar,
                    'sisa'           => $sisa,
                    'keterangan'     => 'DP / Bayar awal'
                ]);
            }

            DB::commit();

            return redirect()->route('barang.barcode')
                ->with('success','Transaksi berhasil disimpan');

        } catch (\Exception $e) {
            DB::rollBack();
            dd($e->getMessage());
            return back()->with('error',$e->getMessage());
        }
    }
    public function destroy($id)
{

    DB::beginTransaction();

    try {

        $transaction = Transaction::with('details')->findOrFail($id);

        foreach ($transaction->details as $detail) {

            $barang = Barang::find($detail->barang_id);

            if ($barang) {
                $barang->stok += $detail->qty;
                $barang->save();
            }

        }

        $transaction->details()->delete();

        $transaction->delete();

        DB::commit();

        return redirect()->back()->with('success','Transaksi berhasil dihapus');

    } catch (\Exception $e) {

        DB::rollBack();

        return back()->with('error',$e->getMessage());

    }

}
}