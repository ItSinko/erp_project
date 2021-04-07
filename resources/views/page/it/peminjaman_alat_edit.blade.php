@extends('adminlte.page')

@section('title', 'Beta Version')

@section('content_header')
<h1 class="m-0 text-dark">Dashboard</h1>
@stop


@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Peminjaman Alat</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">DataTables</li>
                </ol>
            </div>
        </div>
    </div>
</section>
<section class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="col-lg-12">
                <form id="create-inventory" method="POST" action="{{route('peminjaman.alat.update', ['id' => $id])}}">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                    @if(session()->has('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong><i class="fas fa-check"></i></strong>&nbsp;{{session()->get('success')}}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @elseif(session()->has('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong><i class="fas fa-times"></i></strong>&nbsp;{{session()->get('error')}}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @elseif(count($errors) > 0)
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong><i class="fas fa-times"></i></strong>&nbsp;Silahkan lengkapi data terlebih dahulu
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif


                    <div class="card">
                        <div class="card-header bg-warning">
                            <div class="card-title"><i class="fas fa-edit"></i>&nbsp;Ubah Peminjaman</div>
                        </div>
                        <div class="card-body">
                            <div class="col-lg-12">
                                <h4>Info Peminjaman</h4>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-horizontal">

                                            <div class="form-group row">
                                                <label for="divisi_inventory_id" class="col-sm-4 col-form-label" style="text-align:right;">Divisi</label>
                                                <div class="col-sm-8">
                                                    <select class="select2 form-control divinvid" name="divisi_inventory_id" id="divisi_inventory_id" data-placeholder="Pilih Inventory Divisi" data-dropdown-css-class="select2-info" style="width: 80%;">
                                                        <option value=""></option>
                                                        @foreach($d as $i)
                                                        <option value="{{$i->id}}" @if($i->id == $s->divisi_inventory_id)
                                                            selected
                                                            @endif>{{$i->divisi->nama}}</option>
                                                        @endforeach
                                                    </select>
                                                    <span id="divisi_inventory_id-message" role="alert"></span>
                                                    @if ($errors->has('divisi_inventory_id'))
                                                    <span class="invalid-feedback" role="alert">{{$errors->first('divisi_inventory_id')}}</span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="inventory_id" class="col-sm-4 col-form-label" style="text-align:right;">Nama Barang</label>
                                                <div class="col-sm-8">
                                                    <select class="select2 form-control invid" name="inventory_id" id="inventory_id" data-placeholder="Pilih Kode Barang" data-dropdown-css-class="select2-info" style="width: 80%;">
                                                        <option value=""></option>
                                                        @foreach($s->DivisiInventory->Inventory as $i)
                                                        <option value="{{$i->id}}" @if($i->id == $s->inventory_id)
                                                            selected
                                                            @endif>{{$i->kode_barang}} - {{$i->nama_barang}}</option>
                                                        @endforeach
                                                    </select>
                                                    <span id="inventory_id-message" role="alert"></span>
                                                    @if ($errors->has('inventory_id'))
                                                    <span class="invalid-feedback" role="alert">{{$errors->first('inventory_id')}}</span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="tanggal_batas_pengembalian" class="col-sm-4 col-form-label" style="text-align:right;">Jumlah</label>
                                                <div class="col-sm-8">
                                                    <input type="number" class="form-control @error('jumlah') is-invalid @enderror" name="jumlah" id="jumlah" placeholder="Masukkan Tanggal Batas Pengembalian" value="{{old('jumlah', $s->jumlah)}}" style="width:45%;">
                                                    <span id="jumlah-message" role="alert"></span>
                                                    @if ($errors->has('jumlah'))
                                                    <span class="invalid-feedback" role="alert">{{$errors->first('jumlah')}}</span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="tanggal_batas_pengembalian" class="col-sm-4 col-form-label" style="text-align:right;">Keterangan</label>
                                                <div class="col-sm-8">
                                                    <textarea name="keteranganinv" id="keteranganinv" class="form-control" placeholder="Masukkan Alasan atau Keterangan lain untuk peminjaman">{{old('keterangan', $s->keterangan)}}</textarea>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <span class="float-left"><button class="btn btn-danger rounded-pill" id=""><i class="fas fa-times"></i>&nbsp;Batal</button></span>
                            <span class="float-right"><button type="submit" class="btn btn-warning rounded-pill" id="button_tambah"><i class="fas fa-edit"></i>&nbsp;Simpan Perubahan</button></span>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

@endsection

@section('adminlte_js')
<script>
    $(function() {
        $('.divinvid').select({
            placeholder: "Pilih Inventory"
        });

        $('.invid').select({
            placeholder: "Pilih Barang"
        });

        $('select[name="divisi_inventory_id"]').on('change', function(e) {
            var id = $(this).val();
            var invid = $('select[name="inventory_id"]');
            if (id) {
                $.ajax({
                    url: 'get_inventory/' + id,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        console.log(data);
                        invid.empty();
                        $.each(data, function(key, value) {
                            invid.append('<option value="' + value['id'] + '">' + value['kode_barang'] + ' - ' + value['nama_barang'] + '</option>');
                        });
                    }
                });
            } else {
                invid.empty();
            }
        });

        $('select[name="divisi_inventory_id"]').on('change', '.invid', function(e) {
            var id = $(this).val();
            var jumlah = $('input[id="jumlah"]');
            if (id) {
                $.ajax({
                    url: 'get_inventory_detail/' + id,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        jumlah.attr("readonly", false);
                        jumlah.val(data['jumlah_tersedia']);
                    }
                });
            } else {
                jumlah.val("");
            }
        });

        $('input[name="jumlah"]').on('keyup change', function(e) {
            var id = $('.invid').val();
            var jumlah = $('input[id="jumlah"]');
            var jumlahmsg = $('span[id="jumlah-message"]');
            if (id) {
                $.ajax({
                    url: 'get_inventory_detail/' + id,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        if (data['jumlah_tersedia'] < jumlah.val()) {
                            jumlahmsg.addClass("invalid-feedback");
                            jumlah.addClass("is-invalid");
                            jumlahmsg.html("Jumlah tidak tersedia");
                        } else {
                            jumlahmsg.removeClass("invalid-feedback");
                            jumlah.removeClass("is-invalid");
                            jumlahmsg.html("");
                        }
                    }
                });
            } else {
                jumlahmsg.removeClass("invalid-feedback");
                jumlah.removeClass("is-invalid");
                jumlahmsg.html("");
            }
        });
    })
</script>
@stop