@extends('layouts.admin.main')

@section('content')

<div class="container-fluid">

<div class="card">
<div class="card-header">
<h4>Daftar Cashflow</h4>
</div>

<div class="card-body">
	<form action="{{ route('cashflow.deleteAll') }}" method="POST">
@csrf
@method('DELETE')

<button class="btn btn-danger"
onclick="return confirm('Hapus semua data cashflow?')">
Delete All
</button>

</form>
<p>

<table class="table table-bordered">
<thead>
<tr>
<th>No</th>
<th>Tanggal</th>
<th>Jenis</th>
<th>Nominal</th>
<th>Sumber</th>
<th>Keterangan</th>
<th>Aksi</th>
</tr>
</thead>

<tbody>

@foreach($cashflows as $cf)
<tr>

<td>{{ $loop->iteration }}</td>

<td>{{ $cf->tanggal }}</td>

<td>
@if($cf->jenis == 'masuk')
<span class="badge bg-success">Masuk</span>
@else
<span class="badge bg-danger">Keluar</span>
@endif
</td>

<td>Rp {{ number_format($cf->nominal) }}</td>

<td>{{ $cf->sumber }}</td>

<td>{{ $cf->keterangan }}</td>
<td><form action="{{ route('cashflow.destroy',$cf->id) }}" method="POST" style="display:inline">
    @csrf
    @method('DELETE')

    <button class="btn btn-danger btn-sm"
        onclick="return confirm('Hapus data cashflow?')">
        Hapus
    </button>
</form></td>
</tr>
@endforeach

</tbody>
</table>

{{ $cashflows->links() }}

</div>
</div>

</div>

@endsection