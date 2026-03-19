@extends('layouts.admin.main')

@section('content')
<div class="section-header">
<div class="container">
    <h1>Data Driver</h1><p><br>


    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
@if(auth()->user()->hasRole('mitra'))
    <a href="{{ route('driver.create') }}" class="btn btn-primary mb-3">Tambah Data</a>
    @endif
<div class="table-responsive" style="max-height:400px; overflow-y:auto">
    <table class="table table-bordered">
    <thead>
        <tr>
                <th>No</th>
            <th>Nama</th>
            <th>Alamat</th>
            <th>No HP</th>
            <th>No SIM</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($drivers as $driver)
        <tr>
             <td>{{ $loop->iteration }}</td>
            <td>{{ $driver->nama }}</td>
                  <td>{{ $driver->alamat }}</td>
            <td>{{ $driver->no_hp }}</td>
            <td>{{ $driver->no_sim }}</td>
            <td>
                <span class="badge badge-{{ $driver->status == 'available' ? 'success' : 'danger' }}">
                    {{ $driver->status }}
                </span>
            </td>
            <td>
                <a href="{{ route('driver.edit', $driver->id) }}" class="btn btn-warning btn-sm">Edit</a>

                <form action="{{ route('driver.destroy', $driver->id) }}" method="POST" class="d-inline">
                    @csrf @method('DELETE')
                    <button class="btn btn-danger btn-sm" onclick="return confirm('Hapus?')">
                        Hapus
                    </button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

{{ $drivers->links() }}

</div>
</div>
@endsection
