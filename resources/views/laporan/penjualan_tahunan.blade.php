@extends('layouts.admin.main')

@section('content')
<div class="section-header">
<div class="container">

    <h3 class="mb-3">📊 Laporan Penjualan Tahunan</h3>

    {{-- FILTER TAHUN --}}
    <form method="GET" class="mb-4">
        <div class="row">
            <div class="col-md-3">
                <label>Tahun</label>
                <input type="number" name="tahun"
                       value="{{ $tahun }}"
                       class="form-control">
            </div>

            <div class="col-md-2 d-flex align-items-end">
                <button class="btn btn-primary w-100">Filter</button>
                  <button class="btn btn-success w-100">Print</button>
            </div>
        </div>
    </form>

    {{-- SUMMARY --}}
    <div class="row mb-4">

        <div class="col-md-6">
            <div class="card shadow-sm p-3">
                <h6>Total Transaksi</h6>
                <h3>{{ $totalTransaksi }}</h3>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card shadow-sm p-3">
                <h6>Total Penjualan</h6>
                <h3>Rp {{ number_format($totalPenjualan) }}</h3>
            </div>
        </div>

    </div>

    {{-- REKAP BULANAN --}}
    <div class="card shadow-sm mb-4">
        <div class="card-body table-responsive">

            <h5>📅 Rekap Penjualan per Bulan</h5>

            <table class="table table-bordered table-striped">
                <thead class="table-light">
                    <tr>
                        <th>Bulan</th>
                        <th>Total Transaksi</th>
                        <th>Total Penjualan</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($rekapBulanan as $r)
                    <tr>
                        <td>
                            {{ \Carbon\Carbon::create()->month($r->bulan)->translatedFormat('F') }}
                        </td>
                        <td>{{ $r->total_transaksi }}</td>
                        <td>Rp {{ number_format($r->total_penjualan) }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="text-center">Tidak ada data</td>
                    </tr>
                    @endforelse
                </tbody>

            </table>

        </div>
    </div>

    {{-- DETAIL TRANSAKSI --}}
    <div class="card shadow-sm">
        <div class="card-body table-responsive">

            <h5>📋 Detail Transaksi</h5>

            <table class="table table-bordered table-striped">
                <thead class="table-secondary">
                    <tr>
                        <th>No</th>
                        <th>Invoice</th>
                        <th>Total</th>
                        <th>Bayar</th>
                        <th>Kembali</th>
                        <th>Metode</th>
                        <th>Tanggal</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($data as $i => $row)
                    <tr>
                        <td>{{ $i+1 }}</td>
                        <td><b>{{ $row->invoice }}</b></td>
                        <td>Rp {{ number_format($row->total) }}</td>
                        <td>Rp {{ number_format($row->bayar) }}</td>
                        <td>Rp {{ number_format($row->kembali) }}</td>
                        <td>{{ $row->metode }}</td>
                        <td>{{ $row->created_at }}</td>
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