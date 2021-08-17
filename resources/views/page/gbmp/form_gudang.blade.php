@extends('adminlte.page')

@section('title', 'Beta Version')

@section('content_header')
<h1 class="m-0 text-dark">Input Data Stok GBMP</h1>
@stop

@section('content')
<div hidden>
    <div id="data-product">{{ $data_product }}</div>
</div>

<div class="card-secondary">
    <div class='card-header text-center'>
        <div class="custom-control custom-radio custom-control-inline">
            <input type="radio" id="old-data" name="type-data" class="custom-control-input" checked>
            <label class="custom-control-label" for="old-data">Data Lama</label>
        </div>
        <div class="custom-control custom-radio custom-control-inline">
            <input type="radio" id="new-data" name="type-data" class="custom-control-input">
            <label class="custom-control-label" for="new-data">Data Baru</label>
        </div>
    </div>
    <div class="card-body text-center">
        <div id="form-old-data">
            <div class="row form-group">
                <label for="product-name" class="col-sm-4 text-right col-form-label mr-2">Produk</label>
                <select name="product-name" id="product-name" class="select2 col-sm-5" data-placeholder="Nama produk" data-value="name2">
                    <option value=""></option>
                    @foreach ($data_product as $d)
                    <option value="{{ $d->kode }}">{{ $d->nama }}</option>
                    @endforeach
                </select>
            </div>
            <div class="row form-group">
                <label for="product-code" class="col-sm-4 text-right col-form-label mr-2">Kode</label>
                <select name="product-code" id="product-code" class="select2 col-sm-5" data-placeholder="Kode produk">
                    <option value=""></option>
                    @foreach ($data_product as $d)
                    <option value="{{ $d->kode }}">{{ $d->kode }}</option>
                    @endforeach
                </select>
            </div>
            <div class="row form-group">
                <label for="product-quantity" class="col-sm-4 text-right col-form-label mr-2">Jumlah</label>
                <input type="number" id="product-quantity" name="product-quantity" disabled>
            </div>
        </div>
    </div>
    <div class="card-footer">
        test3
    </div>
</div>
@stop
@section('adminlte_js')
<script>
    let data = JSON.parse($("#data-product").html());
    console.log(data);
    $('input[type=radio][name=type-data]').change(function() {
        alert("data change");
    });



    $('#product-name, #product-code').val(null).trigger('change');
    let prev_val = null
    $('#product-name').change(function() {
        if (prev_val != this.value) {
            prev_val = this.value;
            $('#product-code').val(this.value).trigger('change');
        }
        if (this.value != null) {
            console.log('test');
            $('#product-quantity').prop('disabled', false);
        }
    });
    $('#product-code').change(function(event) {
        if (prev_val != this.value) {
            prev_val = this.value;
            $('#product-name').val(this.value).trigger('change');
        }
    });
</script>
@endsection