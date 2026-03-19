@extends('layouts.admin.main')
@section('title','Detail Customer')

@section('content')
<div class="container-fluid">

<h4>Detail Loan</h4>

<div class="card mb-3">
<div class="card-body">

<p>Customer / Supplier :
{{ $loan->customer->nama ?? $loan->supplier->nama }}</p>

<p>Nominal : Rp {{ number_format($loan->nominal) }}</p>

<p>Sisa : Rp {{ number_format($loan->sisa) }}</p>

<p>Status : {{ ucfirst($loan->status) }}</p>

</div>
</div>


<h5>Daftar Angsuran</h5>

<table class="table table-bordered">
<thead>
<tr>
<th>No</th>
<th>Tanggal</th>
<th>Nominal</th>
</tr>
</thead>

<tbody>

@foreach($loan->installments as $i => $angsuran)

<tr>
<td>{{ $i+1 }}</td>
<td>{{ $angsuran->created_at->format('d-m-Y') }}</td>
<td>Rp {{ number_format($angsuran->nominal) }}</td>
</tr>

@endforeach

</tbody>

</table>


<a href="{{ route('loans.index') }}" class="btn btn-secondary mt-3">
    Kembali
</a>

</div>
@endsection