<?php

namespace App\Http\Controllers;

use App\Models\CashFlow;

class CashFlowController extends Controller
{
    public function index()
    {
        $cashflows = CashFlow::latest()->paginate(10);

        return view('cashflow.index', compact('cashflows'));
    }
    public function destroy($id)
{
    $cashflow = CashFlow::findOrFail($id);

    $cashflow->delete();

    return redirect()->route('cashflow.index')
        ->with('success','Cashflow berhasil dihapus');
}
public function deleteAll()
{
    CashFlow::truncate();

    return redirect()->route('cashflow.index')
        ->with('success','Semua data cashflow berhasil dihapus');
}
}