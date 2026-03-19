@extends('layouts.admin.main')

@section('content')

<div class="card">
<div class="card-body">

<h4>Pembelian Barang</h4>

<form action="{{ route('pembelian.store') }}" method="POST">
@csrf

<div class="mb-2">
<label>Supplier</label>
<select name="supplier_id" class="form-control">
@foreach($supplier as $s)
<option value="{{ $s->id }}">{{ $s->nama }}</option>
@endforeach
</select>
</div>

<div class="mb-2">
<label>Tanggal</label>
<input type="date" name="tanggal" value="{{ date('Y-m-d') }}" class="form-control">
</div>

<hr>

<table class="table table-bordered">
<thead>
<tr>
<th>Barang</th>
<th>Qty</th>
<th>Harga</th>
<th>Subtotal</th>
</tr>
</thead>

<tbody id="tableBarang">

<tr>
<td>
<select name="barang_id[]" class="form-control">
@foreach($barang as $b)
<option value="{{ $b->id }}">{{ $b->nama }}</option>
@endforeach
</select>
</td>

<td>
<input type="number" name="qty[]" class="form-control">
</td>

<td>
<input type="number" name="harga[]" class="form-control">
</td>

<td>
<input type="number" name="subtotal[]" class="form-control">
</td>

</tr>

</tbody>

</table>

<div class="mb-2">
<label>Total</label>
<input type="number" name="total" class="form-control">
</div>
<hr>



<div class="col-md-2">
<label>Metode Bayar</label>
<select name="metode_bayar" id="metode_bayar" class="form-control">

<option value="cash">Cash</option>
<option value="kredit">Kredit</option>

</select>
</div>

<div class="col-md-2">
<label>Bayar</label>
<input type="number" name="dibayar" id="dibayar" class="form-control">
</div>

<div class="col-md-4 mt-2">
<label>Sisa</label>
<input type="number" name="sisa" id="sisa" class="form-control" readonly>
</div>

</div>


<button class="btn btn-primary">Simpan</button>

</form>

</div>
</div>

@endsection

@push('scripts')
<script>

function hitung(){

    let total = 0;

    let qty = document.getElementsByName('qty[]');
    let harga = document.getElementsByName('harga[]');
    let subtotal = document.getElementsByName('subtotal[]');

    for(let i=0;i<qty.length;i++){

        let q = parseFloat(qty[i].value) || 0;
        let h = parseFloat(harga[i].value) || 0;

        let sub = q * h;

        subtotal[i].value = sub;

        total += sub;
    }

    document.querySelector('input[name="total"]').value = total;

    hitungSisa();
}


function hitungSisa(){

    let total = parseFloat(document.querySelector('input[name="total"]').value) || 0;
    let bayar = parseFloat(document.getElementById('dibayar').value) || 0;

    document.getElementById('sisa').value = total - bayar;
}


// trigger saat qty / harga diubah
document.addEventListener('input', function(e){

    if(e.target.name == 'qty[]' || e.target.name == 'harga[]'){
        hitung();
    }

});


// saat bayar diubah
document.getElementById('dibayar').addEventListener('input', function(){
    hitungSisa();
});


// saat metode bayar berubah
document.getElementById('metode_bayar').addEventListener('change', function(){

    let metode = this.value;
    let total = parseFloat(document.querySelector('input[name="total"]').value) || 0;

    if(metode == 'cash'){

        document.getElementById('dibayar').value = total;
        document.getElementById('sisa').value = 0;

    }else{

        document.getElementById('dibayar').value = 0;
        document.getElementById('sisa').value = total;

    }

});

</script>
@endpush