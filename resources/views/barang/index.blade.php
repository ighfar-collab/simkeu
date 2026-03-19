@extends('layouts.admin.main')

@section('content')
<div class="section-header">
<div class="container">
    <h1>Data Barang</h1><p><br>


    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif<a href="{{ route('barang.create') }}" class="btn btn-primary mb-3">Tambah Barang</a>
<div class="table-responsive" style="max-height:400px; overflow-y:auto">
    <form method="GET" action="{{ route('barang.index') }}" class="mb-3">
    <div class="input-group">
        <input
            type="text"
            name="search"
            class="form-control"
            placeholder="Cari kode / nama / barcode..."
            value="{{ request('search') }}"
        >
        <button class="btn btn-primary" type="submit">Cari</button>
    </div>
</form>

<table class="table table-bordered">
  <tr>
      <th>No</th>
        <th>Kode</th>
        <th>Nama</th>
        <th>Kategori</th>
         <th>Barcode</th>
         <th>Harga Beli</th>
            <th>Harga Jual</th>
        <th>Stok</th>
        <th>Aksi</th>
    </tr>
    @foreach($barang as $b)
    <tr>
        <td>{{ $loop->iteration + ($barang->currentPage() - 1) * $barang->perPage() }}</td>
        <td>{{ $b->kode_barang }}</td>
        <td>{{ $b->nama }}</td>
        <td>{{ $b->kategori->nama }}</td>
        <td>{{ $b->barcode }}</td>
        <td>{{ $b->harga_beli }}</td>
        <td>{{ $b->harga_jual }}</td>
        <td>{{ $b->stok }}</td>
        <td>
            <a href="{{ route('barang.edit', $b->id) }}" class="btn btn-warning">Edit</a>
              <a href="{{ route('barang.barcode') }}" class="btn btn-success">Barcode</a>
            <form action="{{ route('barang.destroy', $b->id) }}" method="POST" style="display:inline" onsubmit="return confirm('Hapus data?')">
                @csrf
                @method('DELETE')
                <button onclick="return confirm('Hapus data?')" class="btn btn-danger">Hapus</button><p>
            </form>
           
        </td>
    </tr>
    @endforeach
</table>{{ $barang->withQueryString()->links() }}


</div>
</div>
@endsection