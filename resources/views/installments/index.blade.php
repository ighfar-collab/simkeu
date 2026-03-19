@extends('layouts.admin.main')
@section('title','Daftar Angsuran')

@section('content')
<div class="container-fluid">

<div class="card">
    <div class="card-header">
        <strong>Daftar Angsuran</strong>
    </div>

    <div class="card-body table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Id Transaks</th>
                    <th>Invoice</th>
                    <th>Bayar</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
            @forelse($installments as $i)
                <tr>
                    <td>{{ $loop->iteration + ($installments->firstItem() - 1) }}</td>
                    <td>{{ $i->tanggal }}</td>
                    <td>{{ $i->loan->transaction_id }}</td>
                    <td>{{ $i->loan->transaction->invoice ?? '-' }}</td>
                    <td>Rp {{ number_format($i->bayar) }}</td>
                    <td>
                        <a href="{{ route('installments.edit',$i->id) }}"
                           class="btn btn-sm btn-warning">Edit</a>

                        <form action="{{ route('installments.destroy',$i->id) }}"
                              method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger"
                              onclick="return confirm('Hapus angsuran?')">
                              Hapus
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center text-muted">
                        Belum ada angsuran
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

    <div class="card-footer">
        {{ $installments->links() }}
    </div>
</div>

</div>
@endsection