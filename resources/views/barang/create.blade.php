@extends('layouts.admin.main')

@section('content')
<div class="section-header">
<div class="container">
<div class="card">
    <div class="card-header">
        <h4>Tambah Data Barang</h4>
    </div>

    <div class="card-body">
        <form action="{{ route('barang.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="kode_barang">Kode Barang</label>
                <input type="text" class="form-control" id="kode_barang" name="kode_barang" required>
                </div>
                 <div class="form-group">
         <label>Nama Barang</label>
    <input type="text" name="nama" class="form-control" required>
</div>
                 <div class="form-group">
         <label>Kategori</label>
    <select name="kategori_id">
        @foreach ($kategoris as $kategori)
            <option value="{{ $kategori->id }}">{{ $kategori->nama }}</option>
        @endforeach
    </select>
</div>
<div class="form-group">
         <label>Barcode</label>
 <input type="text" name="barcode" id="barcode" autofocus>
<button type="button" onclick="startScan()">Scan</button>
</div>

                 <div class="form-group">
         <label>Harga Beli</label>
    <input type="number" name="harga_beli" class="form-control" required>
</div>
                    
                 <div class="form-group">
         <label>Harga Jual</label>
    <input type="number" name="harga_jual" class="form-control" required>
</div>
                    <div class="form-group">
         <label>Stok</label>
    <input type="number" name="stok" class="form-control" required>
</div>
               <button type="submit" class="btn btn-primary">Simpan</button>
</form>
    </div>
</div>
@endsection
<script src="https://unpkg.com/html5-qrcode"></script>

<div id="reader" style="width:300px"></div>

<script>
function startScan() {
    const qr = new Html5Qrcode("reader");
    qr.start(
        { facingMode: "environment" },
        { fps: 10, qrbox: 250 },
        (text) => {
            document.getElementById('barcode').value = text;
            qr.stop();
        }
    );
}
</script>
