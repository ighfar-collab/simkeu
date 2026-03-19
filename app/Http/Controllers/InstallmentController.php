<?php
namespace App\Http\Controllers;
use App\Models\Installment;
use App\Models\Loan;
use App\Models\Transaction;
use App\Models\CashFlow;
use App\Models\Customer;
use App\Models\Supplier;
use Illuminate\Http\Request;

class InstallmentController extends Controller
{
    public function index()
{
    $installments = Installment::with([
        'loan.customer',
      //  'loan.transaction'
    ])
    ->latest('tanggal')
    ->paginate(15);

    return view('installments.index', compact('installments'));
}
        public function create($loan_id)
    {
    $loan = Loan::with(['customer','supplier','installments'])
            ->findOrFail($loan_id);
        return view('installments.create', compact('loan'));
    }

   public function store(Request $request)
    {
        $request->validate([
            'loan_id' => 'required|exists:loans,id',
            'tanggal' => 'required|date',
            'bayar' => 'required|numeric|min:1'
        ]);

        $loan = Loan::findOrFail($request->loan_id);
         $nominal = $request->bayar;

        Installment::create($request->all());
    CashFlow::create([
            'tanggal' => now(),
            'jenis' => 'masuk',
            'nominal' => $nominal,
            'sumber' => 'angsuran',
            'ref_id' => $request->loan_id,
            'keterangan' => 'Bayar angsuran '
        ]);

        // update sisa & status
        $loan->sisa -= $request->bayar;
        if ($loan->sisa <= 0) {
            $loan->sisa = 0;
            $loan->status = 'lunas';
      
        }
        $loan->save();

          return redirect()
        ->route('loans.index', $request->loan_id)
        ->with('success','Angsuran berhasil dibayar');
    }

    public function edit(Installment $installment)
    {
        return view('installments.edit', compact('installment'));
    }

    public function update(Request $request, Installment $installment)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'bayar' => 'required|numeric|min:1'
        ]);

        $loan = $installment->loan;

        // rollback sisa lama
        $loan->sisa += $installment->bayar;

        // update installment
        $installment->update($request->all());

        // hitung ulang
        $loan->sisa -= $request->bayar;
        $loan->status = $loan->sisa <= 0 ? 'lunas' : 'belum';
        if ($loan->sisa < 0) $loan->sisa = 0;
        $loan->save();

        return redirect()->route('customers.show', $loan->customer_id)
            ->with('success', 'Angsuran berhasil diupdate');
    }

    public function destroy(Installment $installment)
    {
        $loan = $installment->loan;

        $loan->sisa += $installment->bayar;
        $loan->status = 'belum';
        $loan->save();

        $installment->delete();

        return back()->with('success', 'Angsuran dihapus');
    }
}