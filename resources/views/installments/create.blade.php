@extends('layouts.admin.main')
@section('title','Tambah Loan')

@section('content')
<div class="section-header">
<div class="container">
     <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Angsuran Utang Piutang</h5>
        </div>

    @if($errors->any())
        <div class="alert alert-danger"><ul>@foreach($errors->all() as $err)<li>{{ $err }}</li>@endforeach</ul></div>
    @endif
<form action="{{ route('installments.store') }}" method="POST" class="row g-2 mt-2">
@csrf
<input type="hidden" name="loan_id" value="{{ $loan->id }}">

<div class="col-md-4">
    <input type="date" name="tanggal" value="{{ date('Y-m-d') }}" class="form-control" required>
</div>

<div class="col-md-4">
    <input type="number" name="bayar" class="form-control" placeholder="Bayar" required>
</div>

<div class="col-md-4">
    <button class="btn btn-primary">Bayar</button>
</div>
</form>
 <div class="card-header">
            <h5 class="mb-0">Detail Angsuran Utang Piutang</h5>
        </div>

<div class="card mb-3">
<div class="card-body">

<p>Customer / Supplier :
{{ $loan->customer->nama ?? $loan->supplier->nama }}</p>

<p>Nominal : Rp {{ number_format($loan->nominal) }}</p>

<p>Sisa : 
Rp {{ number_format($loan->nominal - $loan->installments->sum('bayar')) }}</p>

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
<td>Rp {{ number_format($angsuran->bayar) }}</td>
</tr>

@endforeach

</tbody>

</table>


<a href="{{ route('loans.index') }}" class="btn btn-secondary mt-3">
    Kembali
</a>

<div>
</div>
</div>
@endsection