<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
 
    public function index(Request $request){
       $customers = Customer::with('loans')
        ->when($request->q, function($q) use ($request){
            $q->where('nama','like','%'.$request->q.'%');
        })
        ->latest()
        ->get();

    return view('customers.index', compact('customers'));
    }

    public function create() {
        return view('customers.create');
    }
            public function show($id)
    {
        $loan = Customer::with([
            'transactions',
            'loans.transactions',
            'loans.installments'
        ])->findOrFail($id);

        return view('customers.show', compact('loan'));
    
    }

    public function store(Request $request) {
        $request->validate(['nama'=>'required']);
        Customer::create($request->all());
        return redirect()->route('customers.index');
    }

    public function edit(Customer $customer) {
        return view('customers.edit', compact('customer'));
    }

    public function update(Request $request, Customer $customer) {
        $customer->update($request->all());
        return redirect()->route('customers.index');
    }

    public function destroy(Customer $customer) {
        $customer->delete();
        return back();
    }
}