@extends('layouts.admin.main')

@section('content')
<div class="section-header">
<div class="container">
    <h1>Edit Data Driver</h1>
    <div class="card">
    <div class="card-body">
<form action="{{ route('driver.update', $driver->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="form-group">
        <label>Nama Driver</label>
        <input type="text" name="nama" class="form-control"
               value="{{ old('nama', $driver->nama) }}" required>
    </div>

    <div class="form-group">
        <label>User (Driver)</label>
        <select name="user_id" class="form-control" required>
            <option value="">-- Pilih Driver --</option>
            @foreach ($users as $user)
                <option value="{{ $user->id }}"
                    {{ old('user_id', $driver->user_id) == $user->id ? 'selected' : '' }}>
                    {{ $user->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label>No HP</label>
        <input type="text" name="no_hp" class="form-control"
               value="{{ old('no_hp', $driver->no_hp) }}" required>
    </div>

    <div class="form-group">
        <label>Alamat</label>
        <textarea name="alamat" class="form-control" required>{{ old('alamat', $driver->alamat) }}</textarea>
    </div>

    <div class="form-group">
        <label>No SIM</label>
        <input type="text" name="no_sim" class="form-control"
               value="{{ old('no_sim', $driver->no_sim) }}" required>
    </div>

    <div class="form-group">
        <label>Status</label>
        <select name="status" class="form-control">
            <option value="available" {{ $driver->status == 'available' ? 'selected' : '' }}>Available</option>
            <option value="unavailable" {{ $driver->status == 'unavailable' ? 'selected' : '' }}>Unavailable</option>
        </select>
    </div>

    <button class="btn btn-primary">Update</button>
    <a href="{{ route('driver.index') }}" class="btn btn-secondary">Kembali</a>
</form>
</div>
</div>
</div>
</div>
@endsection