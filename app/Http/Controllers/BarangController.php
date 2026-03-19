<?php
namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Kategori;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    public function index(Request $request)
    {
        $query = Barang::query();

    if ($request->search) {
        $query->where(function ($q) use ($request) {
            $q->where('kode_barang', 'like', '%'.$request->search.'%')
              ->orWhere('nama', 'like', '%'.$request->search.'%')
              ->orWhere('barcode', 'like', '%'.$request->search.'%');
        });
    }

    $barang = $query->latest()->paginate(10);
    return view('barang.index', compact('barang'));
    }

    public function create()
    {
        $kategoris = Kategori::all();
        return view('barang.create', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_barang' => 'required|unique:barang',
            'id_kategori' => 'required',
            'barcode'     => 'nullable|unique:barang',
            'nama'        => 'required',
            'harga_beli'  => 'required|numeric',
            'harga_jual'  => 'required|numeric',
            'stok'        => 'required|numeric'
        ]);

        Barang::create($request->all());

        return redirect()->route('barang.index')
                         ->with('success', 'Barang berhasil ditambahkan');
    }

    public function edit(Barang $barang)
    {
        $kategori = Kategori::all();
        return view('barang.edit', compact('barang', 'kategori'));
    }

    public function update(Request $request, Barang $barang)
    {
        $request->validate([
            'kode_barang' => 'required|unique:barang,kode_barang,' . $barang->id,
            'barcode'     => 'nullable|unique:barang,barcode,' . $barang->id,
            'nama'        => 'required',
            'harga_beli'  => 'required|numeric',
            'harga_jual'  => 'required|numeric',
            'stok'        => 'required|numeric'
        ]);

        $barang->update($request->all());

        return redirect()->route('barang.index')
                         ->with('success', 'Barang berhasil diupdate');
    }

    public function destroy(Barang $barang)
    {
        $barang->delete();
        return back()->with('success', 'Barang berhasil dihapus');
    }
}
