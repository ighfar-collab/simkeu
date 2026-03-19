@extends('layouts.admin.main')

@section('content')
<div class="container-fluid">
<div class="row">

{{-- ===== KIRI : LIST BARANG ===== --}}
<div class="col-md-8">
    <div class="card">
        <div class="card-header">
            <h4>Daftar Barang</h4></div>
        <div class="card-body">

            {{-- SEARCH / BARCODE --}}
            <input type="text" id="search"
                   class="form-control mb-3"
                   placeholder="Scan barcode / cari barang...">

            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>Kode</th>
                    <th>Nama</th>
                    <th>Harga</th>
                    <th>Aksi</th>
                </tr>
                </thead>
                <tbody id="barang-list">
                @foreach($items as $item)
                <tr data-kode="{{ $item->kode_barang }}">
                    <td>{{ $item->kode_barang }}</td>
                    <td>{{ $item->nama }}</td>
                    <td>{{ number_format($item->harga_jual) }}</td>
                    <td>
                        <button class="btn btn-sm btn-success"
                                onclick="addToCart(
                                    {{ $item->id }},
                                    '{{ $item->nama }}',
                                    {{ $item->harga_jual }},
                                    {{ $item->stok }}
                                )">
                            + Tambah
                        </button>
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>

        </div>
    </div>
</div>

{{-- ===== KANAN : CART ===== --}}
<div class="col-md-4">
    <div class="card">
        <div class="card-header"><h4>Keranjang</h4></div>
        <div class="card-body">

<form method="POST" action="{{ route('pos.store') }}">
@csrf

<table class="table table-sm">
<thead>
<tr>
<th>Barang</th>
<th>Qty</th>
<th>Subtotal</th>
<th></th>
</tr>
</thead>
<tbody id="cart-body"></tbody>
</table>

<hr>

<h4>Total: Rp <span id="total">0</span></h4>


<input type="hidden" name="total" id="totalInput">

<div class="mb-2">
<label>Bayar</label>
<input type="number" name="bayar" id="bayar"
       class="form-control" required>
</div>

<div class="mb-2">
<label>Kembalian</label>
<input type="text" id="kembalian"
       class="form-control" readonly>
</div>
<div class="mb-2">
<label>Metode Pembayaran</label>
<select name="metode" class="form-control" id="metode">
<option value="tunai">Tunai</option>
<option value="kredit">Kredit</option>
</select>
</div>

<button class="btn btn-primary w-100">
Bayar
</button>

</form>
        </div>
    </div>
</div>

<div class="col-md-12">
    <div class="card">
        <div class="card-header">
<h4>Riwayat Transaksi</h4>
</div>

<div class="card-body">

<table class="table table-bordered">
<thead>
<tr>
<th>No</th>
<th>Invoice</th>
<th>Tanggal</th>
<th>Total</th>
<th>Bayar</th>
<th>Kembali</th>
<th>Aksi</th>
</tr>
</thead>

<tbody>

@foreach($transactions as $trx)
<tr>
<td>{{ $loop->iteration }}</td>
<td>{{ $trx->invoice }}</td>
<td>{{ $trx->created_at }}</td>
<td>Rp {{ number_format($trx->total) }}</td>
<td>Rp {{ number_format($trx->bayar) }}</td>
<td>Rp {{ number_format($trx->kembali) }}</td>
<td>


<form action="{{ route('pos.destroy',$trx->id) }}" method="POST" style="display:inline">
@csrf
@method('DELETE')

<button class="btn btn-danger btn-sm"
onclick="return confirm('Hapus transaksi?')">
Hapus
</button>

</form>
</td>
</tr>
@endforeach

</tbody>
</table>

{{ $transactions->links() }}

</div>
</div>
</div>


</div>
</div>
@endsection
@push('scripts')
<script>
let cart = {};

function addToCart(id, nama, harga, stok) {
    if (!cart[id]) {
        cart[id] = { id, nama, harga, qty: 1, stok };
    } else {
        if (cart[id].qty >= stok) {
            alert('Stok tidak cukup');
            return;
        }
        cart[id].qty++;
    }
    renderCart();
}

function removeItem(id) {
    delete cart[id];
    renderCart();
}

function updateQty(id, qty) {
    if (qty > cart[id].stok) {
        alert('Stok tidak cukup');
        return;
    }
    cart[id].qty = qty;
    renderCart();
}

function renderCart() {
    let tbody = '';
    let total = 0;

    Object.values(cart).forEach(item => {
        let subtotal = item.qty * item.harga;
        total += subtotal;

        tbody += `
        <tr>
            <td>
                ${item.nama}
                
<input type="hidden" name="items[barang_id][]" value="${item.id}">
<input type="hidden" name="items[price][]" value="${item.harga}">

            </td>
            <td>
                <input type="number"
                       name="items[qty][]"
                       value="${item.qty}"
                       min="1"
                       class="form-control form-control-sm"
                       onchange="updateQty(${item.id}, this.value)">
            </td>
            <td>${subtotal.toLocaleString()}</td>
            <td>
                <button type="button"
                        class="btn btn-danger btn-sm"
                        onclick="removeItem(${item.id})">×</button>
            </td>
        </tr>`;
    });

    document.getElementById('cart-body').innerHTML = tbody;
    document.getElementById('total').innerText = total.toLocaleString();
    document.getElementById('totalInput').value = total;
}

// HITUNG KEMBALIAN
document.getElementById('bayar').addEventListener('input', function () {
    let bayar = this.value;
    let total = document.getElementById('totalInput').value;
    document.getElementById('kembalian').value =
        parseInt(bayar) - parseInt(total)
});

// SEARCH / BARCODE
document.getElementById('search').addEventListener('keyup', function () {
    let keyword = this.value.toLowerCase();
    document.querySelectorAll('#barang-list tr').forEach(row => {
        row.style.display =
            row.innerText.toLowerCase().includes(keyword)
            ? '' : 'none';
    });
});
</script>
@endpush