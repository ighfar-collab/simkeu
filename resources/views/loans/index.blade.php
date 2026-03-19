@extends('layouts.admin.main')

@section('title','Data Loan')

@section('content')
<div class="container-fluid">

    <div class="card col-md-12">
       
        <div class="card-body">

<div class="d-flex justify-content-between mb-3">
      @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <h4>Data Utang Piutang</h4>
   
</div>
    {{-- Search --}}
   <form method="GET" action="{{ route('loans.index') }}" class="mb-3">
<div class="row">

<div class="col-md-4">
<input type="text" name="search" value="{{ $search ?? '' }}" 
class="form-control" placeholder="Cari nama customer...">
</div>

<div class="col-md-2">
<button class="btn btn-primary">Cari</button>
</div>

</div>
</form>
<table class="table table-bordered table-striped">
<thead class="table-blue">
<tr>
    <th>No</th>
    <th>Id Transaksi/Pembelian</th>
      <th>Costumer/Supplier</th>
    <th>Jenis</th>
    <th>Nominal</th>
    <th>Sisa</th>
    <th>Status</th>
    <th>Aksi</th>
</tr>
</thead>
<tbody>
@foreach($loans as $i=>$l)
<tr>
    <td>{{ $i+1 }}</td>
    <td>{{ $l->transaction_id }} {{ $l->pembelian_id }}</td>
        <td>
{{ $l->customer->nama ?? $l->supplier->nama ?? '-' }}
</td>
    <td>{{ ucfirst($l->jenis) }}</td>
    <td>Rp {{ number_format($l->nominal) }}</td>
    <td>
Rp {{ number_format($l->nominal - $l->installments->sum('bayar')) }}</td>
    <td>
        <span class="badge bg-{{ $l->status=='lunas'?'success':'danger' }}">
            {{ ucfirst($l->status) }}
        </span>
    </td>
    <td>
           <a href="{{ route('installments.create',$l->id) }}" class="btn btn-sm btn-info">Angsuran</a>
            <a href="{{ route('loans.edit',$l->id) }}" class="btn btn-sm btn-warning">Edit</a>
        <form method="POST" action="{{ route('loans.destroy',$l->id) }}"
              class="d-inline" onsubmit="return confirm('Hapus?')">
            @csrf @method('DELETE')
            <button class="btn btn-sm btn-danger">Hapus</button>
        </form>
      
    </td>
</tr>
@endforeach
</tbody>
</table>

</div>
@endsection