@extends('adminlte.page')

@section('title', 'Beta Version')

@section('content_header')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>BPPB</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Advanced Form</li>
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
            <!-- left column -->

            <div class="col-3">
                <div class="card">
                    <div class="card-body">
                        <h4>Info</h4><br>
                        <div class="form-horizontal">
                            <div class="row">
                                <label for="no_seri" class="col-sm-6 col-form-label">No BPPB</label>
                                <div class="col-sm-6 col-form-label" style="text-align:right;">
                                    {{$s->Bppb->no_bppb}}
                                </div>
                            </div>

                            <div class="row">
                                <label for="no_seri" class="col-sm-4 col-form-label">Produk</label>
                                <div class="col-sm-8 col-form-label" style="text-align:right;">
                                    {{$s->Bppb->DetailProduk->nama}}
                                </div>
                            </div>

                            <div class="row">
                                <label for="no_seri" class="col-sm-5 col-form-label">Kelompok Produk</label>
                                <div class="col-sm-7 col-form-label" style="text-align:right;">
                                    {{$s->Bppb->DetailProduk->Produk->KelompokProduk->nama}}
                                </div>
                            </div>

                            <div class="row">
                                <label for="tanggal" class="col-sm-6 col-form-label">Tanggal Laporan</label>
                                <div class="col-sm-6 col-form-label" style="text-align:right;">
                                    {{date("d-m-Y", strtotime($s->Bppb->tanggal_bppb))}}
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                @if(session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong><i class="fas fa-check"></i></strong> {{session()->get('success')}}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @elseif(session()->has('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong><i class="fas fa-times"></i></strong> {{session()->get('error')}}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @elseif(count($errors) > 0)
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong><i class="fas fa-times"></i></strong> Lengkapi data terlebih dahulu
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif
                <div class="card">
                    <div class="card-header bg-warning">
                        <h3 class="card-title"><i class="fa fa-pencil-alt" aria-hidden="true"></i>&nbsp;Ubah Permintaan Bahan Baku</h3>
                    </div>
                    <div class="card-body">
                        <div class="col-md-12">
                            <form action="{{ route('bppb.permintaan_bahan_baku.update', ['id' => $id]) }}" method="post">
                                {{ csrf_field() }}
                                {{ method_field('PUT') }}
                                <h3>Permintaan Bahan Baku</h3>
                                <div class="form-horizontal">
                                    <div class="form-group row">
                                        <table id="tableitem" class="table table-hover table-bordered styled-table">
                                            <thead style="text-align: center;">
                                                <tr>
                                                    <th>Part</th>
                                                    <th>Jumlah Diminta</th>
                                                    <th>Jumlah Diserahkan</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody style="text-align: center;" id="tbodies">
                                                @foreach($s->DetailPermintaanBahanBaku as $i)
                                                <tr>
                                                    <td><input class="form-control" type="number" name="detail_permintaan_bahan_baku_id[]" id="detail_permintaan_bahan_baku_id" value="{{$i->id}}" hidden>{{$i->BillOfMaterial->PartEng->nama}}</td>
                                                    <td>{{$i->jumlah_diminta}}</td>
                                                    <td><input class="form-control" type="number" name="jumlah_diterima[]" id="jumlah_diterima" @if($i->jumlah_diterima === NULL) value="{{$i->jumlah_diminta}}" @elseif($i->jumlah_diterima !== NULL) value="{{$i->jumlah_diterima}}" @endif></td>
                                                    <td>
                                                        <button type="button" class="btn btn-danger karyawan-img-small" style="border-radius:50%;" id="closetable"><i class="fas fa-times-circle"></i></button>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                        </div>
                        <!-- /.card -->

                    </div>
                    <div class="card-footer">
                        <span>
                            <button type="button" class="btn btn-block btn-danger rounded-pill" style="width:200px;float:left;"><i class="fas fa-times"></i>&nbsp;Batal</button>
                        </span>
                        <span>
                            <button type="submit" class="btn btn-block btn-warning rounded-pill" style="width:200px;float:right;"><i class="fas fa-save"></i>&nbsp;Simpan Data</button>
                        </span>
                    </div>
                </div>
                </form>
            </div>

        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>
@endsection
@section('adminlte_js')
<script>
    $(function() {
        function formatted_string(pad, user_str, pad_pos) {
            if (typeof user_str === 'undefined')
                return pad;
            if (pad_pos == 'l') {
                return (pad + user_str).slice(-pad.length);
            } else {
                return (user_str + pad).substring(0, pad.length);
            }
        }

        $('select[name="kelompok_produk_id"]').on('change', function() {
            var kelompok_produk_id = jQuery(this).val();
            console.log(kelompok_produk_id);
            if (kelompok_produk_id) {
                $('#tbodies').empty();
                $.ajax({
                    url: 'create/get_detail_produk_by_kelompok_produk/' + kelompok_produk_id,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        console.log(data);
                        $('select[name="detail_produk_id"]').empty();
                        $('select[name="detail_produk_id"]').append('<option value=""></option>');
                        $.each(data, function(key, value) {
                            console.log(value);
                            $('select[name="detail_produk_id"]').append('<option value="' + value.id + '">' + value.nama + '</option>');
                            $('input[name="no_bppb_kode"]').val(value.kode_barcode);
                        });
                    }
                });
            } else {
                $('select[name="detail_produk_id"]').empty();
            }
        });

        $('select[name="detail_produk_id"]').on('change', function() {
            var detail_produk_id = $(this).val();
            console.log(detail_produk_id);
            if (detail_produk_id) {
                $('#tbodies').empty();
                $.ajax({
                    url: 'create/get_detail_produk_by_id/' + detail_produk_id,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        $('input[name="no_bppb_kode"]').val(data[0]['produk']['kode_barcode']);
                    }
                });

                $.ajax({
                    url: 'create/get_bom/' + detail_produk_id,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        console.log(data);
                        $('select[name="model"]').empty();
                        $('select[name="model"]').append('<option value=""></option>');
                        $.each(data, function(key, value) {
                            console.log(value);
                            $('select[name="model"]').append('<option value="' + value.id + '">Versi ' + value.versi + '</option>');
                        });
                    }
                });

                var tanggal = new Date($(this).val());
                var tahun = tanggal.getFullYear();
                if (tahun != "") {
                    $.ajax({
                        url: 'create/get_bppb_detail_produk_count_by_year/' + tahun + '/' + detail_produk_id,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            console.log(data);
                            $('input[name="no_bppb_urutan"]').val(formatted_string('0000', (data + 1), 'l'));
                        }
                    })
                }
            }
        });

        $('select[name="model"]').on('change', function() {
            var model = jQuery(this).val();
            var jumlah = $('#jumlah').val();
            console.log(model);
            if (model) {
                $('#tbodies').empty();
                $.ajax({
                    url: 'create/get_model_bom/' + model,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        $.each(data, function(key, value) {
                            console.log(value.parteng);
                            $('#tableitem tr:last').after(`<tr>
                <td><input name="part_id[]" value="` + value.id + `" hidden>` + value.part_eng_id + `</td>
                <td><input name ="part_jumlah[]" id="part_jumlah" class="form-control" value="` + value.jumlah + `" readonly></td>
                <td><input name ="part_jumlah_diminta[]" id="part_jumlah_diminta" class="form-control" value="` + (value.jumlah * jumlah) + `"></td>
                <td><button class="btn btn-danger  btn-circle btn-circle-sm m-1" id="closetable"><i class="fas fa-times"></i></button></td>
              </tr>`);
                        });
                    }
                });
            } else {
                $('select[name="detail_produk_id"]').empty();
            }
        });

        $('#tableitem').on('click', '#closetable', function(e) {
            $(this).closest('tr').remove();
        });

        $('input[name="tanggal_bppb"]').on('change', function() {
            var tanggal = new Date($(this).val());
            var tahun = tanggal.getFullYear();
            var detail_produk_id = $('select[name="detail_produk_id"]').val();
            $('input[name="no_bppb_bulan"]').val(formatted_string('00', (tanggal.getMonth() + 1), 'l'));
            $('input[name="no_bppb_tahun"]').val(formatted_string('00', (tanggal.getYear()), 'l'));
            if (detail_produk_id != "" && tahun != "") {
                $.ajax({
                    url: 'create/get_bppb_detail_produk_count_by_year/' + tahun + '/' + detail_produk_id,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        console.log(data);
                        $('input[name="no_bppb_urutan"]').val(formatted_string('0000', (data + 1), 'l'));
                    }
                })
            }
        });



    });
</script>
@stop