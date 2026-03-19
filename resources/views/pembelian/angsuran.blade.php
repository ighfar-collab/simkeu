@extends('layouts.admin.main')
@section('title','Tambah Loan')

@section('content')
<div class="section-header">
<div class="container">
     <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Tambah Angsuran</h5>
        </div>

    @if($errors->any())
        <div class="alert alert-danger"><ul>@foreach($errors->all() as $err)<li>{{ $err }}</li>@endforeach</ul></div>
    @endif
<form action="{{ route('installments.store') }}" method="POST" class="row g-2 mt-2">
@csrf
<input type="hidden" name="loan_id" value="{{ $loan->id }}">

<div class="col-md-4">
    <input type="date" name="tanggal" class="form-control" required>
</div>

<div class="col-md-4">
    <input type="number" name="bayar" class="form-control" placeholder="Bayar" required>
</div>

<div class="col-md-4">
    <button class="btn btn-primary">Bayar</button>
</div>
</form>
<div>
</div>
</div>
@endsection