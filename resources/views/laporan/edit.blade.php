@extends('layouts.admin.main')

@section('content')
<div class="section-header">
<div class="container">
<div class="card">
    <div class="card-header">
        <h4>Edit Mitra</h4>
    </div>

    <div class="card-body">
        <form action="{{ route('mitra.update', $mitra->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label>Nama Mitra</label>
                <input type="text" name="nama_mitra" class="form-control"
                       value="{{ $mitra->nama_mitra }}" required>
            </div>
             <div class="form-group">
         <label>User</label>
    <select name="user_id" class="form-control">
        @foreach ($users as $user)
            <option value="{{ $user->id }}" {{ $mitra->user_id == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
        @endforeach
    </select>
</div>


            <button class="btn btn-success">Update</button>
            <a href="{{ route('mitra.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>
@endsection