@extends('adminlte.page')

@section('title', 'Beta Version')

@section('adminlte_css')
<style>
    .box {
        display: block;
        width: auto;
        height: auto;
        background-color: #DDD;
    }

    #pop {
        padding: 0px 0px;
    }

    .popiconsc {
        color: green;
        text-align: right;
    }

    .popiconer {
        color: red;
        text-align: right;
    }

    #example {
        position: relative;
    }

    .text-middle {
        vertical-align: middle;
    }
</style>
@stop

@section('content_header')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Laporan QC</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item active">Laporan QC</li>
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
                            <div class="form-group row" id="produk-form">
                                <label for="produk" class="col-sm-5 col-form-label" style="text-align:right;">Pilih Produk</label>
                                <div class="col-sm-7">
                                    <div class="select2-info">
                                        <select class="select2 custom-select form-control @error('produk') is-invalid @enderror produk" data-placeholder="Pilih Produk" data-dropdown-css-class="select2-info" style="width: 80%;" name="produk" id="produk">
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

        <div class="row">
            <div class="col-lg-2">
                <div class="nav flex-column nav-tabs" id="nav-tab" role="tablist" aria-orientation="vertical">
                    <a class="nav-item nav-link active" id="nav-ik_pemeriksaan-tab" data-toggle="tab" href="#nav-ik_pemeriksaan" role="tab" aria-controls="nav-ik_pemeriksaan" aria-selected="true">IK Pemeriksaan</a>
                    <a class="nav-item nav-link" id="nav-lkp_lup-tab" data-toggle="tab" href="#nav-lkp_lup" role="tab" aria-controls="nav-lkp_lup" aria-selected="false">LUP dan LKP</a>
                </div>
            </div>
            <div class="col-lg-10">
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-ik_pemeriksaan" role="tabpanel" aria-labelledby="nav-ik_pemeriksaan-tab">

                        <div class="row" id="produktable" hidden>
                            <div class="col-lg-3">
                                <div class="card">
                                    <div class="card-body" style="font-size:13px;">
                                        <div class=" form-group row">
                                            <label for="tipe_produk" class="col-sm-4 col-form-label" style="text-align:left;">Tipe Produk</label>
                                            <span class="col-sm-8 col-form-label" style="text-align:right;" id="tipe_produk">-</span>
                                        </div>
                                        <div class="form-group row">
                                            <label for="nama_produk" class="col-sm-4 col-form-label" style="text-align:left;">Nama Produk</label>
                                            <span class="col-sm-8 col-form-label" style="text-align:right;" id="nama_produk">-</span>
                                        </div>
                                        <div class="form-group row">
                                            <label for="kelompok_produk" class="col-sm-5 col-form-label" style="text-align:left;">Kelompok Produk</label>
                                            <span class="col-sm-7 col-form-label" style="text-align:right;" id="kelompok_produk">-</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-9">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <ul class="nav nav-pills nav-justified">
                                                    <li class="nav-item"><a class="nav-link active" data-toggle="pill" href="#perakitan">Perakitan</a></li>
                                                    <li class="nav-item"><a class="nav-link" data-toggle="pill" href="#pengujian">Pengujian</a></li>
                                                    <li class="nav-item"><a class="nav-link" data-toggle="pill" href="#pengemasan">Pengemasan</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="tab-content">
                                                    <div id="perakitan" class="tab-pane fade active show">
                                                        <div class="row" style="margin-top:2%">
                                                            <div class="col-lg-12">
                                                                <div class="float-right" style="margin-bottom:1%;">
                                                                    <a class="tambahikperakitan" href="#"><button class="btn btn-info btn-sm"><i class="fas fa-plus"></i>&nbsp;Tambah</button></a>
                                                                </div>
                                                                <div class="float-right" style="margin-bottom:1%;">
                                                                    <a class="editikperakitan" href="#"><button class="btn btn-warning btn-sm"><i class="fas fa-pencil-alt"></i>&nbsp;Ubah</button></a>
                                                                </div>
                                                                <div class="table-responsive">
                                                                    <table id="perakitan-table" class="table table-striped" style="width:100%; font-size:13px;">
                                                                        <thead bgcolor="#ADD8E6" style="color:#1f2d3d; text-align:center;">
                                                                            <tr>
                                                                                <th>No</th>
                                                                                <th>Hal yang diperiksa</th>
                                                                                <th>Standar Keberterimaan</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <tr>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td></td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div id="pengujian" class="tab-pane fade">
                                                        <div class="row" style="margin-top:2%">
                                                            <div class="col-lg-12">
                                                                <div class="float-right" style="margin-bottom:1%;">
                                                                    <a class="tambahikpengujian" href=""><button class="btn btn-info btn-sm"><i class="fas fa-plus"></i>&nbsp;Tambah</button></a>
                                                                </div>
                                                                <div class="float-right" style="margin-bottom:1%;">
                                                                    <a class="editikpengujian" href="#"><button class="btn btn-warning btn-sm"><i class="fas fa-pencil-alt"></i>&nbsp;Ubah</button></a>
                                                                </div>
                                                                <div class="table-responsive">
                                                                    <table id="pengujian-table" class="table table-striped" style="width:100%;  font-size:13px;">
                                                                        <thead bgcolor=" #F0E68C" style="color:#1f2d3d; text-align:center;">
                                                                            <tr>
                                                                                <th>No</th>
                                                                                <th>Hal yang diperiksa</th>
                                                                                <th>Standar Keberterimaan</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <tr>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td></td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div id="pengemasan" class="tab-pane fade">
                                                        <div class="row" style="margin-top:2%">
                                                            <div class="col-lg-12">
                                                                <div class="float-right" style="margin-bottom:1%;">
                                                                    <a class="tambahikpengemasan" href=""><button class="btn btn-info btn-sm"><i class="fas fa-plus"></i>&nbsp;Tambah</button></a>
                                                                </div>
                                                                <div class="float-right" style="margin-bottom:1%;">
                                                                    <a class="editikpengemasan" href="#"><button class="btn btn-warning btn-sm"><i class="fas fa-pencil-alt"></i>&nbsp;Ubah</button></a>
                                                                </div>
                                                                <div class="table-responsive">
                                                                    <table id="pengemasan-table" class="table table-striped" style="width:100%;  font-size:13px;">
                                                                        <thead bgcolor="#d6ebad" style="color:#1f2d3d; text-align:center;">
                                                                            <tr>
                                                                                <th>No</th>
                                                                                <th>Hal yang diperiksa</th>
                                                                                <th>Standar Keberterimaan</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <tr>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td></td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="tab-pane fade" id="nav-lkp_lup" role="tabpanel" aria-labelledby="nav-lkp_lup-tab">
                        <div class="row" id="lkpluptable">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="historimutasimodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header" style="background-color:	#006400;">
                        <h4 class="modal-title" id="myModalLabel" style="color:white;">Histori Mutasi</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body" id="historimutasi">

                    </div>
                </div>
            </div>
        </div>
</section>
@stop

@section('adminlte_js')
<script>
    $(function() {
        function tableikpemeriksaanview(produk) {
            $.ajax({
                url: "/ik_pemeriksaan/show/" + produk + "/Perakitan",
                type: "GET",
                dataType: "json",
                success: function(data) {
                    console.log(data);
                    var datas = "";
                    var count = 1;
                    if (data != "") {
                        for (var i = 0; i < data.length; i++) {
                            for (var j = 0; j < data[i]['list_ik_pemeriksaan'].length; j++) {
                                var first = 0;
                                datas += `<tr>
                            <td rowspan="` + data[i]['list_ik_pemeriksaan'][j]['detail_ik_pemeriksaan'].length + `">` + count++ + `</td>
                            <td rowspan="` + data[i]['list_ik_pemeriksaan'][j]['detail_ik_pemeriksaan'].length + `">` + data[i]['list_ik_pemeriksaan'][j]['pemeriksaan'] + `</td>`;
                                for (var k = 0; k < data[i]['list_ik_pemeriksaan'][j]['detail_ik_pemeriksaan'].length; k++) {
                                    if (first == 0) {
                                        first = 1;
                                        datas += `<td>` + data[i]['list_ik_pemeriksaan'][j]['detail_ik_pemeriksaan'][k]['penerimaan'] + `</td>
                                </tr>`;
                                    } else if (first == 1) {
                                        datas += `<tr>
                                <td>` + data[i]['list_ik_pemeriksaan'][j]['detail_ik_pemeriksaan'][k]['penerimaan'] + `</td>
                                </tr>`;
                                    }
                                }
                            }
                        }
                        $(".editikperakitan").attr('href', '/ik_pemeriksaan/edit/' + data['id']);
                        $(".editikperakitan").removeAttr('hidden');
                        $(".tambahikperakitan").attr('hidden', true);
                    } else if (data == "") {
                        datas += `<tr><td colspan="3"  style="text-align:center;"><i>Tidak Ada Data</i></td></tr>`;
                        $(".tambahikperakitan").attr('href', '/ik_pemeriksaan/create/' + produk + '/Perakitan');
                        $(".tambahikperakitan").removeAttr('hidden');
                        $(".editikperakitan").attr('hidden', true);
                    }
                    $('#perakitan-table tbody').html(datas);
                },
            })

            $.ajax({
                url: "/ik_pemeriksaan/show/" + produk + "/Pengujian",
                type: "GET",
                dataType: 'json',
                success: function(data) {
                    var datas = "";
                    var count = 1;
                    if (data != "") {
                        for (var i = 0; i < data.length; i++) {
                            for (var j = 0; j < data[i]['list_ik_pemeriksaan'].length; j++) {
                                var first = 0;
                                datas += `<tr>
                            <td rowspan="` + data[i]['list_ik_pemeriksaan'][j]['detail_ik_pemeriksaan'].length + `">` + count++ + `</td>
                            <td rowspan="` + data[i]['list_ik_pemeriksaan'][j]['detail_ik_pemeriksaan'].length + `">` + data[i]['list_ik_pemeriksaan'][j]['pemeriksaan'] + `</td>`;
                                for (var k = 0; k < data[i]['list_ik_pemeriksaan'][j]['detail_ik_pemeriksaan'].length; k++) {
                                    if (first == 0) {
                                        first = 1;
                                        datas += `<td>` + data[i]['list_ik_pemeriksaan'][j]['detail_ik_pemeriksaan'][k]['penerimaan'] + `</td>
                                </tr>`;
                                    } else if (first == 1) {
                                        datas += `<tr>
                                <td>` + data[i]['list_ik_pemeriksaan'][j]['detail_ik_pemeriksaan'][k]['penerimaan'] + `</td>
                                </tr>`;
                                    }
                                }
                            }
                        }
                        $(".editikpengujian").attr('href', '/ik_pemeriksaan/edit/' + data['id']);
                        $(".editikpengujian").removeAttr('hidden');
                        $(".tambahikpengujian").attr('hidden', true);
                    } else if (data == "") {
                        datas += `<tr><td colspan="3"  style="text-align:center;"><i>Tidak Ada Data</i></td></tr>`;
                        $(".tambahikpengujian").attr('href', '/ik_pemeriksaan/create/' + produk + '/Pengujian');
                        $(".tambahikpengujian").removeAttr('hidden');
                        $(".editikpengujian").attr('hidden', true);
                    }
                    $('#pengujian-table tbody').html(datas);
                },
            })

            $.ajax({
                url: "/ik_pemeriksaan/show/" + produk + "/Pengemasan",
                type: "GET",
                dataType: 'json',
                success: function(data) {
                    var datas = "";
                    var count = 1;
                    if (data != "") {
                        for (var i = 0; i < data.length; i++) {
                            for (var j = 0; j < data[i]['list_ik_pemeriksaan'].length; j++) {
                                var first = 0;
                                datas += `<tr>
                            <td rowspan="` + data[i]['list_ik_pemeriksaan'][j]['detail_ik_pemeriksaan'].length + `">` + count++ + `</td>
                            <td rowspan="` + data[i]['list_ik_pemeriksaan'][j]['detail_ik_pemeriksaan'].length + `">` + data[i]['list_ik_pemeriksaan'][j]['pemeriksaan'] + `</td>`;
                                for (var k = 0; k < data[i]['list_ik_pemeriksaan'][j]['detail_ik_pemeriksaan'].length; k++) {
                                    if (first == 0) {
                                        first = 1;
                                        datas += `<td>` + data[i]['list_ik_pemeriksaan'][j]['detail_ik_pemeriksaan'][k]['penerimaan'] + `</td>
                                </tr>`;
                                    } else if (first == 1) {
                                        datas += `<tr>
                                <td>` + data[i]['list_ik_pemeriksaan'][j]['detail_ik_pemeriksaan'][k]['penerimaan'] + `</td>
                                </tr>`;
                                    }
                                }
                            }
                        }
                        $(".editikpengemasan").attr('href', '/ik_pemeriksaan/edit/' + data['id']);
                        $(".editikpengemasan").removeAttr('hidden');
                        $(".tambahikpengemasan").attr('hidden', true);
                    } else if (data == "") {
                        datas += `<tr><td colspan="3" style="text-align:center;"><i>Tidak Ada Data</i></td></tr>`;
                        $(".tambahikpengemasan").attr('href', '/ik_pemeriksaan/create/' + produk + '/Pengemasan');
                        $(".tambahikpengemasan").removeAttr('hidden');
                        $(".editikpengemasan").attr('hidden', true);
                    }
                    $('#pengemasan-table tbody').html(datas);
                },
            })
        }

        function tablelkplupview(produk) {
            $.ajax({
                url: "lkp_lup/show/" + produk,
                type: "GET",
                dataType: "json",
                success: function(data) {
                    if (data != null) {

                    }
                }
            })
        }
        $('select[name="produk"]').on('change', function() {
            var produk = $(this).val();
            if (produk != "") {
                $.ajax({
                    url: 'ik_pemeriksaan/get_detail_produk_by_id/' + produk,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        console.log(data);
                        if (data != null) {
                            console.log()
                            $("#tipe_produk").text(data['produk']['nama']);
                            $("#nama_produk").text(data['nama']);
                            $("#kelompok_produk").text(data['produk']['kelompokproduk']['nama']);
                            $("#produktable").removeAttr('hidden');
                        } else {
                            $("#tipe_produk").text("-");
                            $("#nama_produk").text("-");
                            $("#kelompok_produk").text("-");
                            $("#produktable").attr('hidden', true);
                        }
                    },
                    error: function(data) {
                        $("#tipe_produk").text("-");
                        $("#nama_produk").text("-");
                        $("#kelompok_produk").text("-");
                        $("#produktable").attr('hidden', true);
                    }
                });
                tableikpemeriksaanview(produk);
            } else {
                $("#produktable").attr('hidden', true);
            }
        });
    });
</script>
@stop