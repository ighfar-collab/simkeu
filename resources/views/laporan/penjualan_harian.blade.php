@extends('layouts.admin.main')

@section('content')
<div class="section-header">
<div class="container">

<h3>Laporan Penjualan Harian</h3>

<form method="GET">
    <input type="date" name="tanggal" value="{{ $tanggal }}">
    <button class="btn btn-primary">Filter</button>
</form>

<hr>

<p>Total Transaksi: <b>{{ $totalTransaksi }}</b></p>
<p>Total Penjualan: <b>Rp {{ number_format($totalPenjualan) }}</b></p>

<table class="table table-bordered">
<tr>
    <th>No</th>
    <th>Invoice</th>
    <th>Total</th>
    <th>Bayar</th>
    <th>Tanggal</th>
</tr>

@foreach($data as $i => $row)
<tr>
    <td>{{ $i+1 }}</td>
    <td>{{ $row->invoice }}</td>
    <td>{{ number_format($row->total) }}</td>
    <td>{{ number_format($row->bayar) }}</td>
    <td>{{ $row->created_at }}</td>
</tr>
@endforeach

</table>

</div>
@endsection