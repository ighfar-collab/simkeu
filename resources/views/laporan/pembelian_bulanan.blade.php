@extends('layouts.admin.main')

@section('content')
<div class="section-header">
<div class="container">

    <h3 class="mb-3">📊 Laporan Pembelian Bulanan</h3>

    {{-- FILTER --}}
    <form method="GET" class="mb-4">
        <div class="row">

            {{-- BULAN --}}
            <div class="col-md-3">
                <label>Bulan</label>
                <select name="bulan" class="form-control">
                    @for ($i = 1; $i <= 12; $i++)
                        @php $val = str_pad($i, 2, '0', STR_PAD_LEFT); @endphp
                        <option value="{{ $val }}"
                            {{ $bulan == $val ? 'selected' : '' }}>
                            {{ \Carbon\Carbon::create()->month($i)->translatedFormat('F') }}
                        </option>
                    @endfor
                </select>
            </div>

            {{-- TAHUN --}}
            <div class="col-md-3">
                <label>Tahun</label>
                <input type="number" name="tahun"
                       value="{{ $tahun }}"
                       class="form-control">
            </div>

            <div class="col-md-2 d-flex align-items-end">
                <button class="btn btn-primary w-100">Filter</button>
            </div>

        </div>
    </form>

    {{-- SUMMARY --}}
    <div class="row mb-4">
        <div class="col-md-6">
            <div class="card p-3 shadow-sm">
                <h6>Total Transaksi</h6>
                <h3>{{ $totalTransaksi }}</h3>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card p-3 shadow-sm">
                <h6>Total Pembelian</h6>
                <h3>Rp {{ number_format($totalPembelian) }}</h3>
            </div>
        </div>
    </div>

    {{-- REKAP HARIAN --}}
    <div class="card mb-4 shadow-sm">
        <div class="card-body">
            <h5>📅 Rekap Harian</h5>

            <table class="table table-bordered">
                <tr>
                    <th>Tanggal</th>
                    <th>Transaksi</th>
                    <th>Total</th>
                </tr>

                @foreach($rekapHarian as $r)
                <tr>
                    <td>{{ $r->tanggal }}</td>
                    <td>{{ $r->total_transaksi }}</td>
                    <td>Rp {{ number_format($r->total_pembelian) }}</td>
                </tr>
                @endforeach

            </table>
        </div>
    </div>

    {{-- DETAIL --}}
    <div class="card shadow-sm">
        <div class="card-body table-responsive">

            <h5>📋 Detail Pembelian</h5>

            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode</th>
                        <th>Tanggal</th>
                        <th>Total</th>
                        <th>Metode</th>
                        <th>Dibayar</th>
                        <th>Sisa</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($data as $i => $row)
                    <tr>
                        <td>{{ $i+1 }}</td>
                        <td>{{ $row->kode }}</td>
                        <td>{{ $row->tanggal }}</td>
                        <td>Rp {{ number_format($row->total) }}</td>
                        <td>{{ $row->metode_bayar }}</td>
                        <td>{{ number_format($row->dibayar) }}</td>
                        <td>{{ number_format($row->sisa) }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center">Tidak ada data</td>
                    </tr>
                    @endforelse
                </tbody>

            </table>

        </div>
    </div>

</div>
@endsection