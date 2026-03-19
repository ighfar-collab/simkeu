@extends('layouts.admin.main')

@section('title','Data Customer')

@section('content')
<div class="container-fluid">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">Data Customer</h4>
        <a href="{{ route('customers.create') }}" class="btn btn-primary">
            + Tambah Customer
        </a>
    </div>

    {{-- Alert --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Search --}}
    <div class="card mb-3">
        <div class="card-body">
            <form method="GET">
                <div class="row g-2">
                    <div class="col-md-4">
                        <input type="text" name="q" value="{{ request('q') }}"
                               class="form-control" placeholder="Cari nama customer...">
                    </div>
                    <div class="col-md-2">
                        <button class="btn btn-primary">Cari</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- Table --}}
    <div class="card">
        <div class="card-body table-responsive">
            <table class="table table-bordered table-striped align-middle">
                <thead class="table-blue">
                    <tr>
                        <th width="5%">No</th>
                        <th>Nama</th>
                        <th>No HP</th>
                        <th>Alamat</th>
                        <th class="text-end">Utang Aktif</th>
                        <th width="18%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                @forelse($customers as $i => $c)
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td>{{ $c->nama }}</td>
                        <td>{{ $c->no_hp ?? '-' }}</td>
                        <td>{{ $c->alamat ?? '-' }}</td>
                        <td class="text-end">
                            Rp {{ number_format(
                                $c->loans->where('status','belum')->sum('sisa')
                            ) }}
                        </td>
                        <td>
                            <a href="{{ route('customers.edit',$c->id) }}"
                               class="btn btn-sm btn-warning">Edit</a>

                            <form action="{{ route('customers.destroy',$c->id) }}"
                                  method="POST" class="d-inline"
                                  onsubmit="return confirm('Hapus customer ini?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-danger">Hapus</button>
                            </form>
     

                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted">
                            Data customer belum ada
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection