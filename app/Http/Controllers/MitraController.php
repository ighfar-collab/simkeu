<?php

namespace App\Http\Controllers;

use App\Models\Mitra;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
class MitraController extends Controller
{
    /**
     * Tampilkan semua data mitra
     */
    public function index()
    {
        $mitras = Mitra::with('user')->paginate(10);
        return view('mitra.index', compact('mitras'));
    }

    /**
     * Form tambah mitra
     */
    public function create()
    {
        $users = User::all();
        return view('mitra.create', compact('users'));
    }

    /**
     * Simpan data mitra
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_mitra' => 'required|string|max:255',
            'user_id'    => 'required|exists:users,id',
        ]);

        Mitra::create([
            'nama_mitra' => $request->nama_mitra,
            'user_id'    => $request->user_id,
        ]);

        return redirect()
            ->route('mitra.index')
            ->with('success', 'Mitra berhasil ditambahkan');
    }

    /**
     * Form edit mitra
     */
    public function edit(Mitra $mitra)
    {
        $users = User::all();
        return view('mitra.edit', compact('mitra', 'users'));
    }

    /**
     * Update data mitra
     */
    public function update(Request $request, Mitra $mitra)
    {
        $request->validate([
            'nama_mitra' => 'required|string|max:255',
            'user_id'    => 'required|exists:users,id',
        ]);

        $mitra->update([
            'nama_mitra' => $request->nama_mitra,
            'user_id'    => $request->user_id,
        ]);

        return redirect()
            ->route('mitra.index')
            ->with('success', 'Mitra berhasil diupdate');
    }

    /**
     * Hapus data mitra
     */
    public function destroy(Mitra $mitra)
    {
        $mitra->delete();

        return redirect()
            ->route('mitra.index')
            ->with('success', 'Mitra berhasil dihapus');
    }
}
