@extends('layouts.admin.main')

@section('content')
<div class="section-header">
<div class="container">
    <h1>Data Mitra</h1><p><br>


    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif<a href="{{ route('mitra.create') }}" class="btn btn-primary mb-3">Tambah Mitra</a>
<div class="table-responsive" style="max-height:400px; overflow-y:auto">
<table class="table table-bordered">
    <tr>
        <th>No</th>
        <th>Nama Mitra</th>
        <th>User</th>
        <th>Aksi</th>
    </tr>
    @foreach ($mitras as $mitra)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $mitra->nama_mitra }}</td>
        <td>{{ $mitra->user->name }}</td>
        <td>
            <a href="{{ route('mitra.edit', $mitra->id) }}">Edit</a>
            <form action="{{ route('mitra.destroy', $mitra->id) }}" method="POST" style="display:inline">
                @csrf
                @method('DELETE')
                <button onclick="return confirm('Hapus data?')">Hapus</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>
{{ $mitras->links() }}

</div>
</div>
@endsection