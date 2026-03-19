@extends('layouts.admin.main')

@section('content')
<div class="section-header">
<div class="container">
<div class="card">
    <div class="card-header">
        <h4>Edit Barang</h4>
    </div>

    <div class="card-body">
        <form action="{{ route('barang.update', $barang->id) }}" method="POST">
            @csrf
            @method('PUT')
<div class="mb-3">
                <label>Kode Barang</label>
                <input type="text" name="kode_barang" class="form-control"
                       value="{{ $barang->kode_barang }}" required>
            </div>
            <div class="mb-3">
                <label>Nama Barang</label>
                <input type="text" name="nama" class="form-control"
                       value="{{ $barang->nama }}" required>
            </div>
             <div class="form-group">
         <label>Kategori</label>
    <select name="kategori_id" class="form-control">
        @foreach ($kategoris as $kategori)
            <option value="{{ $kategori->id }}" {{ $barang->kategori_id == $kategori->id ? 'selected' : '' }}>{{ $kategori->nama }}</option>
        @endforeach
    </select>
</div>
<div class="mb-3">
                <label>Harga Beli</label>
                <input type="number" name="harga_beli" class="form-control"
                       value="{{ $barang->harga_beli }}" required>
            </div>
             <div class="mb-3">
                <label>Harga Jual</label>
                <input type="number" name="harga_jual" class="form-control"
                       value="{{ $barang->harga_jual }}" required>
            </div>
<div class="mb-3">
                <label>Stok</label>
                <input type="number" name="stok" class="form-control"
                       value="{{ $barang->stok }}" required>
            </div>

            <button class="btn btn-success">Update</button>
            <a href="{{ route('barang.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>
@endsection