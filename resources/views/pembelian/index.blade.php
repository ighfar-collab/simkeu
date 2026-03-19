@extends('layouts.admin.main')

@section('content')

<div class="card">
<div class="card-header">

<h4>Data Pembelian</h4>

<a href="{{ route('pembelian.create') }}" class="btn btn-primary">
Tambah Pembelian
</a>

</div>

<div class="card-body">

<table class="table table-bordered">
<thead>
<tr>
<th>No</th>
<th>Kode</th>
<th>Supplier</th>
<th>Tanggal</th>
<th>Total</th>
<th>Aksi</th>
</tr>
</thead>

<tbody>

@foreach($data as $d)

<tr>
<td>{{ $loop->iteration }}</td>
<td>{{ $d->kode }}</td>
<td>{{ $d->supplier->nama }}</td>
<td>{{ $d->tanggal }}</td>
<td>Rp {{ number_format($d->total) }}</td>

<td>

<a href="{{ route('pembelian.show',$d->id) }}"
class="btn btn-info btn-sm">
Detail
</a>

</td>

</tr>

@endforeach

</tbody>
</table>

</div>
</div>

@endsection