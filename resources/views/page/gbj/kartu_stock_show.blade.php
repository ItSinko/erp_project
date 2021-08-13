@extends('adminlte.page')

@section('title', 'Beta Version')

@section('content_header')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Kartu Stok</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Kartu Stok</li>
                </ol>
            </div>
        </div>
    </div>
</section>
@stop

@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="form-horizontal">
                            <div class="form-group row">
                                <label for="detail_produk_id" class="col-sm-5 col-form-label" style="text-align:right;">Tampilan</label>
                                <div class="col-sm-2 col-form-label">
                                    <div class="icheck-primary d-inline">
                                        <input type="radio" id="tampilan1" name="tampilan" value="hari_ini" checked>
                                        <label for="tampilan1">
                                            Tampilkan Hari Ini
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-2 col-form-label">
                                    <div class="icheck-primary d-inline">
                                        <input type="radio" id="tampilan2" name="tampilan" value="produk">
                                        <label for="tampilan2">
                                            Tampilkan Per Produk
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="produk" class="col-sm-5 col-form-label" style="text-align:right;">Pilih Produk</label>
                                <div class="col-sm-4">
                                    <div class="select2-info">
                                        <select class="select2 custom-select form-control @error('produk') is-invalid @enderror produk" data-placeholder="Pilih Produk" data-dropdown-css-class="select2-info" style="width: 80%;" name="produk" id="produk" disabled>
                                            <option value=""></option>
                                            @foreach($p as $i)
                                            <option value="{{$i->id}}">{{$i->nama}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row" id="produktable">
            <div class="col-lg-3">
                <div class="card">
                    <div class="card-body">

                    </div>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="card">
                    <div class="card-body">

                    </div>
                </div>
            </div>
        </div>

        <div class="row" id="hariinitable">
            <div class="col-lg-12">
                <div id="card">
                    <div class="card-body">

                    </div>
                </div>
            </div>
        </div>

    </div>
</section>
@stop

@section('adminlte_js')
<script>
    $(function() {
        $('input[type="radio"][name="tampilan"]').on('change', function() {
            console.log($(this).val());
            if ($(this).val() == "hari_ini") {
                $('#produk').attr('disabled', true);
            } else if ($(this).val() == "produk") {
                $('#produk').removeAttr('disabled');
            }
        })
    });
</script>
@stop