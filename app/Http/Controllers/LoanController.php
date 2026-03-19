<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use App\Models\Customer;
use App\Models\Supplier;
use Illuminate\Http\Request;

class LoanController extends Controller
{
 public function index(Request $request)
{
    $search = $request->search;

    $loans = Loan::with('customer','supplier')
        ->when($search, function ($query) use ($search) {

            $query->where(function($q) use ($search){

                $q->whereHas('customer', function ($c) use ($search) {
                    $c->where('nama', 'like', '%' . $search . '%');
                })

                ->orWhereHas('supplier', function ($s) use ($search) {
                    $s->where('nama', 'like', '%' . $search . '%');
                });

            });

        })
        ->latest()
        ->paginate(10);

    return view('loans.index', compact('loans','search'));
}
    public function create()
    {
        $customers = Customer::all();
        return view('loans.create', compact('customers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_id'=>'required',
            'jenis'=>'required',
            'nominal'=>'required|numeric|min:1',
                  'sisa'=>'required|numeric|min:0',
                  'status'=>'required',
        ]);

        Loan::create([
            'customer_id'=>$request->customer_id,
            'jenis'=>$request->jenis,
            'nominal'=>$request->nominal,
            'sisa'=>$request->sisa,
              'status'=>$request->status,
            'keterangan'=>$request->keterangan
        ]);

        return redirect()->route('loans.index')
            ->with('success','Loan berhasil ditambahkan');
    }




    public function edit(Loan $loan)
    {
        $customers = Customer::all();
        return view('loans.edit', compact('loan','customers'));
    }

    public function update(Request $request, Loan $loan)
    {
        $loan->update([
            'customer_id'=>$request->customer_id,
            'keterangan'=>$request->keterangan
        ]);

        return redirect()->route('loans.index')
            ->with('success','Loan diperbarui');
    }
    public function show($id)
{
    $loan = Loan::with(['customer','supplier','installments'])
            ->findOrFail($id);

    return view('loans.show', compact('loan'));
}

    public function destroy(Loan $loan)
    {
        if($loan->installments()->count()){
            return back()->with('error','Loan punya angsuran');
        }
        $loan->delete();
        return back()->with('success','Loan dihapus');
    }
}

