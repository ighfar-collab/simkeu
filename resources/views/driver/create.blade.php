@extends('layouts.admin.main')

@section('content')
<div class="section-header">
<div class="container">
    <h1>Tambah Data Driver</h1>
    <div class="card">
    <div class="card-body">
<form action="{{ route('driver.store') }}" method="POST">
    @csrf

    <div class="form-group">
        <label>Nama Driver</label>
        <input type="text" name="nama" class="form-control">
    </div>

    <div class="form-group">
        <label>User</label>
        <select name="user_id" class="form-control">
            <option value="">-- Pilih User --</option>
            @foreach ($users as $user)
                <option value="{{ $user->id }}">{{ $user->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label>No HP</label>
        <input type="text" name="no_hp" class="form-control">
    </div>

    <div class="form-group">
        <label>Alamat</label>
        <textarea name="alamat" class="form-control"></textarea>
    </div>

    <div class="form-group">
        <label>No SIM</label>
        <input type="text" name="no_sim" class="form-control">
    </div>

    <div class="form-group">
        <label>Status</label>
        <select name="status" class="form-control">
            <option value="available">Available</option>
            <option value="unavailable">Unavailable</option>
        </select>
    </div>

    <button class="btn btn-primary">Simpan</button>
</form>
</div>
</div>
</div>
</div>
@endsection