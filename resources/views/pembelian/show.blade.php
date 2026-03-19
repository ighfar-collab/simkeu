@extends('layouts.admin.main')

@section('content')

<div class="card">

<div class="card-body">

<h4>Detail Pembelian</h4>

<div>Kode : {{ $pembelian->kode }}</div>
<div>Supplier : {{ $pembelian->supplier->nama }}</div>
<div>Tanggal : {{ $pembelian->tanggal }}</div>

<hr>

<table class="table table-bordered">

<thead>

<tr>
<th>No</th>
<th>Barang</th>
<th>Qty</th>
<th>Harga</th>
<th>Subtotal</th>
</tr>

</thead>

<tbody>

@foreach($pembelian->details as $item)

<tr>

<td>{{ $loop->iteration }}</td>
<td>{{ $item->barang->nama }}</td>
<td>{{ $item->qty }}</td>
<td>Rp {{ number_format($item->harga) }}</td>
<td>Rp {{ number_format($item->subtotal) }}</td>

</tr>

@endforeach

</tbody>

</table>

<h5>Total : Rp {{ number_format($pembelian->total) }}</h5>

</div>

</div>

@endsection