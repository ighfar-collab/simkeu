@extends('layouts.admin.main')

@section('content')
<div class="section-header">
<div class="container">

    <h3 class="mb-3">💰 Laporan Cashflow Bulanan</h3>

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
                 <button class="btn btn-success w-100">Print</button>
            </div>

        </div>
    </form>

    {{-- SUMMARY --}}
    <div class="row mb-4">

        <div class="col-md-4">
            <div class="card p-3 shadow-sm">
                <h6>💰 Kas Masuk</h6>
                <h4 class="text-success">Rp {{ number_format($kasMasuk) }}</h4>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card p-3 shadow-sm">
                <h6>💸 Kas Keluar</h6>
                <h4 class="text-danger">Rp {{ number_format($kasKeluar) }}</h4>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card p-3 shadow-sm">
                <h6>📊 Saldo</h6>
                <h4 class="{{ $saldo >= 0 ? 'text-success' : 'text-danger' }}">
                    Rp {{ number_format($saldo) }}
                </h4>
            </div>
        </div>

    </div>

    {{-- REKAP HARIAN --}}
    <div class="card shadow-sm">
        <div class="card-body">

            <h5>📅 Arus Kas Harian (Kas Masuk)</h5>

            <table class="table table-bordered">
                <tr>
                    <th>Tanggal</th>
                    <th>Kas Masuk</th>
                </tr>

                @foreach($rekapHarian as $r)
                <tr>
                    <td>{{ $r->tanggal }}</td>
                    <td>Rp {{ number_format($r->kas_masuk) }}</td>
                </tr>
                @endforeach

            </table>

        </div>
    </div>

</div>
@endsection