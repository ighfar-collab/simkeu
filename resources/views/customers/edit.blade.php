@extends('layouts.admin.main')

@section('title','Edit Customer')

@section('content')
<div class="container-fluid">

    <div class="card col-md-6">
        <div class="card-header">
            <h5 class="mb-0">Edit Customer</h5>
        </div>

        <div class="card-body">
            <form action="{{ route('customers.update',$customer->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Nama Customer</label>
                    <input type="text" name="nama"
                           class="form-control @error('nama') is-invalid @enderror"
                           value="{{ old('nama',$customer->nama) }}" required>
                    @error('nama')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">No HP</label>
                    <input type="text" name="no_hp"
                           class="form-control"
                           value="{{ old('no_hp',$customer->no_hp) }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Alamat</label>
                    <textarea name="alamat" rows="3"
                              class="form-control">{{ old('alamat',$customer->alamat) }}</textarea>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('customers.index') }}"
                       class="btn btn-secondary">Kembali</a>
                    <button class="btn btn-warning">Update</button>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection