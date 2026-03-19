@extends('layouts.admin.main')

@section('title','Edit Loan')

@section('content')
<div class="section-header">
<div class="container">
     <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Edit Utang Piutang</h5>
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('loans.update',$loan->id) }}">
                @csrf
                @method('PUT')

                {{-- CUSTOMER --}}
                <div class="mb-3">
                    <label class="form-label">Customer</label>
                    <select name="customer_id" class="form-control" required>
                        @foreach($customers as $c)
                            <option value="{{ $c->id }}"
                                {{ $loan->customer_id==$c->id?'selected':'' }}>
                                {{ $c->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- JENIS --}}
                <div class="mb-3">
                    <label class="form-label">Jenis Loan</label>
                    <input type="text" class="form-control"
                           value="{{ ucfirst($loan->jenis) }}" readonly>
                </div>

                {{-- NOMINAL --}}
                <div class="mb-3">
                    <label class="form-label">Nominal</label>
                    <input type="number" class="form-control"
                           value="{{ $loan->nominal }}" readonly>
                </div>

                {{-- SISA --}}
                <div class="mb-3">
                    <label class="form-label">Sisa</label>
                    <input type="number" name="sisa"
                           class="form-control @error('sisa') is-invalid @enderror"
                           value="{{ old('sisa',$loan->sisa) }}" required>
                    @error('sisa')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <small class="text-muted">
                        Sisa tidak boleh lebih besar dari nominal
                    </small>
                </div>

                {{-- STATUS --}}
                <div class="mb-3">
                    <label class="form-label">Status</label>
                    <select name="status"
                            class="form-control @error('status') is-invalid @enderror">
                        <option value="belum"
                            {{ $loan->status=='belum lunas'?'selected':'' }}>
                            Belum Lunas
                        </option>
                        <option value="lunas"
                            {{ $loan->status=='lunas'?'selected':'' }}>
                            Lunas
                        </option>
                    </select>
                    @error('status')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- KETERANGAN --}}
                <div class="mb-3">
                    <label class="form-label">Keterangan</label>
                    <textarea name="keterangan" rows="3"
                              class="form-control">{{ old('keterangan',$loan->keterangan) }}</textarea>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('loans.index') }}"
                       class="btn btn-secondary">Kembali</a>
                    <button class="btn btn-warning">Update</button>
                </div>

            </form>
        </div>
    </div>

</div>
@endsection