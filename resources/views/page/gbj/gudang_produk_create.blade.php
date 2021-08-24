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
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item"><a href="/kartu_stok_gbj">Kartu Stok</a></li>
                    <li class="breadcrumb-item active">Tambah</li>
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
                    <div class="card-header bg-info">
                        <div class="card-title"><i class="fas fa-plus-circle"></i> Tambah Kartu Stock</div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('kartu_stock_gbj.store') }}" method="post">
                            {{ csrf_field() }}
                            <div class="form-horizontal">
                                <div class="form-group row">
                                    <label for="produk" class="col-sm-5 col-form-label" style="text-align:right;">Pilih Produk</label>
                                    <div class="col-sm-4">
                                        <div class="select2-info">
                                            <select class="select2 custom-select form-control @error('detail_produk_id') is-invalid @enderror detail_produk_id" data-placeholder="Pilih Produk" data-dropdown-css-class="select2-info" style="width: 80%;" name="detail_produk_id" id="detail_produk_id">
                                                <option value=""></option>
                                                @foreach($p as $i)
                                                <option value="{{$i->id}}">{{$i->nama}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-sm-5 col-form-label" style="text-align:right;">No Kartu Stock</label>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control col-form-label @error('produk') is-invalid @enderror" id="nomor" name="nomor" style="width:50%;" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="table-responsive">
                                        <table class="table table-striped" id="tableitem">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Tanggal</th>
                                                    <th>Divisi</th>
                                                    <th>Keterangan</th>
                                                    <th>Jumlah Masuk</th>
                                                    <th>Jumlah Keluar</th>
                                                    <th>Jumlah Saldo</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>1</td>
                                                    <td><input type="date" class="form-control" name="tanggal[]" id="tanggal"></td>
                                                    <td><select class="select2 select-info form-control divisi_id" name="divisi_id[]" id="divisi_id[]">
                                                            <option value=""></option>
                                                            @foreach($d as $i)
                                                            <option value="{{$i->id}}">{{$i->nama}}</option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td><textarea name="keterangan[]" id="keterangan" class="form-control"></textarea></td>
                                                    <td><input type="number" class="form-control" name="jumlah_masuk[]"></td>
                                                    <td><input type="number" class="form-control" name="jumlah_keluar[]"></td>
                                                    <td><input type="number" class="form-control" name="jumlah_saldo[]"></td>
                                                    <td><button type="button" class="btn btn-success" style="border-radius: 50%;" id="tambahitem"><i class="fas fa-plus-circle"></i></button></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </form>
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
        function numberRows($t) {
            var c = 0 - 1;
            $t.find("tr").each(function(ind, el) {
                $(el).find("td:eq(0)").html(++c);
            });
        }

        $("#tableitem").on('#tambahitem', 'click', function() {
            $('#tableitem tr:last').after(`<tr>
                <td></td>
                <td><input type="date" class="form-control" name="tanggal[]" id="tanggal"></td>
                <td><select class="select2 select-info form-control divisi_id" name="divisi_id[]" id="divisi_id[]">
                        <option value=""></option>
                        @foreach($d as $i)
                        <option value="{{$i->id}}">{{$i->nama}}</option>
                        @endforeach
                    </select>
                </td>
                <td><textarea name="keterangan[]" id="keterangan" class="form-control"></textarea></td>
                <td><input type="number" class="form-control" name="jumlah_masuk[]"></td>
                <td><input type="number" class="form-control" name="jumlah_keluar[]"></td>
                <td><input type="number" class="form-control" name="jumlah_saldo[]"></td>
                <td><button type="button" class="btn btn-danger" style="border-radius: 50%;"><i class="fas fa-times-circle"></i></button></td>
            </tr>`);
        })
    });
</script>
@stop