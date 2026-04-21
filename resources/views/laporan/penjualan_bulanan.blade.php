@extends('layouts.admin.main')

@section('content')
<div class="section-header">
<div class="container">

<h3>Laporan Penjualan Bulanan</h3>

<form method="GET">
   <div class="col-md-3">
    <label>Pilih Bulan</label>
    <select name="bulan" class="form-control">
        <option value="">-- Pilih Bulan --</option>

        @php
            $bulanList = [
                '01' => 'Januari',
                '02' => 'Februari',
                '03' => 'Maret',
                '04' => 'April',
                '05' => 'Mei',
                '06' => 'Juni',
                '07' => 'Juli',
                '08' => 'Agustus',
                '09' => 'September',
                '10' => 'Oktober',
                '11' => 'November',
                '12' => 'Desember',
            ];
        @endphp

        @foreach($bulanList as $key => $nama)
            <option value="{{ $key }}"
                {{ request('bulan') == $key ? 'selected' : '' }}>
                {{ $nama }}
            </option>
        @endforeach

    </select>
</div>
<div class="col-md-3">
    <label>Pilih Tahun</label>
    <input type="number" name="tahun"
           value="{{ request('tahun', date('Y')) }}"
           class="form-control">
</div>
    <button class="btn btn-primary">Filter</button>
      <button class="btn btn-success">Print</button>
</form>

<hr>

<p>Total Transaksi: <b>{{ $totalTransaksi }}</b></p>
<p>Total Penjualan: <b>Rp {{ number_format($totalPenjualan) }}</b></p>

<table class="table table-bordered">
<tr>
    <th>Bulan</th>
    <th>Transaksi</th>
    <th>Penjualan</th>
</tr>

@foreach($rekapHarian as $r)
<tr>
    <td>{{ $r->bulan }}</td>
    <td>{{ $r->total_transaksi }}</td>
    <td>{{ number_format($r->total_penjualan) }}</td>
</tr>
@endforeach
</table>

</table>

</div>
@endsection