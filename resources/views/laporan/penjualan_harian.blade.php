@extends('layouts.admin.main')

@section('title','Laporan Penjualan Harian')

@section('content')

<div class="section">

<div class="section-header">
<h1>Laporan Penjualan Harian</h1>
</div>

<div class="section-body">

<div class="card">

<div class="card-header">
<h4>Filter Tanggal</h4>
</div>

<div class="card-body">

<form method="GET" action="{{ route('laporan.penjualan.harian') }}">

<div class="row">

<div class="col-md-4">
<label>Tanggal</label>
<input type="date" name="tanggal" class="form-control"
value="{{ request('tanggal') }}">
</div>

<div class="col-md-2 mt-4">
<button class="btn btn-primary">
Filter
</button>
</div>

</div>

</form>

</div>

</div>


<div class="card">

<div class="card-header">
<h4>Data Penjualan</h4>
</div>

<div class="card-body">

<table class="table table-bordered">

<thead>

<tr>
<th>No</th>
<th>Kode Transaksi</th>
<th>Customer</th>
<th>Total</th>
<th>Tanggal</th>
</tr>

</thead>

<tbody>

@php
$total = 0;
@endphp

@foreach($data as $item)

<tr>

<td>{{ $loop->iteration }}</td>

<td>{{ $item->kode }}</td>

<td>{{ $item->customer->nama ?? '-' }}</td>

<td>Rp {{ number_format($item->total) }}</td>

<td>{{ $item->created_at->format('d-m-Y') }}</td>

</tr>

@php
$total += $item->total;
@endphp

@endforeach

</tbody>

<tfoot>

<tr>

<th colspan="3">Total Penjualan</th>

<th colspan="2">
Rp {{ number_format($total) }}
</th>

</tr>

</tfoot>

</table>

</div>

</div>

</div>

</div>

@endsection