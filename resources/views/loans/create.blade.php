@extends('layouts.admin.main')
@section('title','Tambah Loan')

@section('content')
<div class="section-header">
<div class="container">
     <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Tambah Utang Piutang</h5>
        </div>

    @if($errors->any())
        <div class="alert alert-danger"><ul>@foreach($errors->all() as $err)<li>{{ $err }}</li>@endforeach</ul></div>
    @endif
<form method="POST" action="{{ route('loans.store') }}">
@csrf

<div class="mb-3">
    <label>Customer</label>
    <select name="customer_id" class="form-control" required>
        <option value="">- Pilih -</option>
        @foreach($customers as $c)
            <option value="{{ $c->id }}">{{ $c->nama }}</option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label>Jenis</label>
    <select name="jenis" class="form-control" required>
        <option value="piutang">Piutang</option>
        <option value="utang">Utang</option>
    </select>
</div>

<div class="mb-3">
    <label>Nominal</label>
    <input type="number" name="nominal" class="form-control" required>
</div>
<div class="mb-3">
    <label>Sisa</label>
    <input type="number" name="sisa" class="form-control" required>
</div>

<div class="mb-3">
    <label>Status</label>
    <select name="status" class="form-control" required>
        <option value="lunas">Lunas</option>
        <option value="belum">Belum Lunas</option>
    </select>
</div>
<div class="mb-3">
    <label>Keterangan</label>
    <textarea name="keterangan" class="form-control"></textarea>
</div>

<button class="btn btn-primary">Simpan</button>
<a href="{{ route('loans.index') }}" class="btn btn-secondary">Kembali</a>

</form>
</div>
@endsection