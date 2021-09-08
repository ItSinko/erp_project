@extends('adminlte.page')

@section('title', 'Beta Version')

@section('adminlte_css')
<style>
    .hasTooltip span {
        display: none;
        color: #000;
        text-decoration: none;
        padding: 3px;
    }

    .hasTooltip:hover span {
        display: block;
        top: 5%;
        right: 105%;
        background-color: #FFF;
        border: 1px solid #CCC;
        margin: 2px 10px;
    }
</style>
@stop
@section('content_header')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Gudang Produk</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item active">Gudang Produk</li>
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
                                        <input type="radio" id="tampilan1" name="tampilan" value="tanggal">
                                        <label for="tampilan1">
                                            Tampilkan Per Tanggal
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
                            <div class="form-group row" id="tanggal-form" hidden>
                                <label for="produk" class="col-sm-5 col-form-label" style="text-align:right;">Masukkan Tanggal</label>
                                <div class="col-sm-7">
                                    <input type="date" class="form-control col-form-label @error('tanggal') is-invalid @enderror" id="tanggal" name="tanggal" placeholder="Masukkan Tanggal" width="40%">
                                </div>
                            </div>
                            <div class="form-group row" id="produk-form" hidden>
                                <label for="produk" class="col-sm-5 col-form-label" style="text-align:right;">Pilih Produk</label>
                                <div class="col-sm-7">
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

        <div class="row">
            <div class="col-lg-12">
                <!-- <div class="card-body"> -->
                <!-- <div class="row">
                    <div class="col-lg-12">
                        <span class="dropdown float-right" id="filter" style="margin-bottom:10px;">
                            <button class=" btn btn-outline-info dropdown-toggle" type="button" id="dropdownFilter" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="position:relative;">
                                Filter
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownFilter" style="position:relative;">
                                <h6 class="text-muted">Tampilan</h6>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="tampilan" id="tampilan1">
                                    <label class="form-check-label" for="tampilan1">
                                        Hari Ini
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="tampilan" id="tampilan2">
                                    <label class="form-check-label" for="tampilan2">
                                        Per Produk
                                    </label>
                                </div>
                                <h6>Produk</h6>
                                <div class="select2-info">
                                    <select class="select2 custom-select form-control @error('produk') is-invalid @enderror produk" data-placeholder="Pilih Produk" data-dropdown-css-class="select2-info" style="width: 100%;" name="produk" id="produk" disabled>
                                        <option value=""></option>
                                        @foreach($p as $i)
                                        <option value="{{$i->id}}">{{$i->nama}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </span>
                    </div>
                </div> -->
                <div class="row" id="produktable" hidden>
                    <div class="col-lg-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="tanggal_daftar" class="col-sm-4 col-form-label" style="text-align:left;">Tipe Produk</label>
                                    <span class="col-sm-8 col-form-label" style="text-align:right;" id="tipe_produk">-</span>
                                </div>
                                <div class="form-group row">
                                    <label for="tanggal_permintaan_selesai" class="col-sm-4 col-form-label" style="text-align:left;">Nama Produk</label>
                                    <span class="col-sm-8 col-form-label" style="text-align:right;" id="nama_produk">-</span>
                                </div>
                                <div class="form-group row">
                                    <label for="tanggal_permintaan_selesai" class="col-sm-5 col-form-label" style="text-align:left;">Stok Terakhir</label>
                                    <span class="col-sm-7 col-form-label" style="text-align:right;" id="jumlah_stok">-</span>
                                </div>
                                <div class="form-group row" id="kartu_stock_tambah" hidden>
                                    <label for="tambah" class="col-sm-5 col-form-label" style="text-align:left;">Tambahkan</label>
                                    <span class="col-sm-7"><a class="tambahurl" href="/gudang_produk_gbj/create/"><button class="btn btn-success btn-sm btn-rounded col-form-label float-right" id="tambah" name="tambah">Tambah Kartu Stok</button></a></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-9">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example2" class="table table-hover table-striped" width="100%">
                                        <thead style="text-align: center; font-size: 15px;">
                                            <tr>
                                                <th rowspan="2">No</th>
                                                <th rowspan="2">Tanggal</th>
                                                <th rowspan="2">Asal / Tujuan</th>
                                                <th rowspan="2">Keterangan</th>
                                                <th colspan="3">Jumlah</th>
                                                <th rowspan="2">Aksi</th>
                                            </tr>
                                            <tr>
                                                <th>Masuk</th>
                                                <th>Keluar</th>
                                                <th>Saldo</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbodies">

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row" id="hariinitable" hidden>
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example1" class="table table-hover table-striped" width="100%">
                                        <thead style="text-align: center; font-size: 15px; ">
                                            <tr>
                                                <th rowspan="2">No</th>
                                                <th rowspan="2">Produk</th>
                                                <th rowspan="2">Asal / Tujuan</th>
                                                <th rowspan="2">Keterangan</th>
                                                <th colspan="3">Jumlah</th>
                                                <th rowspan="2">Aksi</th>
                                            </tr>
                                            <tr>
                                                <th>Masuk</th>
                                                <th>Keluar</th>
                                                <th>Saldo</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbodies">

                                        </tbody>
                                    </table>
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
    </div>
</section>
@stop

@section('adminlte_js')
<script>
    $(function() {
        $(".tooltip").tooltip();
        $(document).on('click', '.historimutasimodal', function(event) {
            event.preventDefault();
            var href = $(this).attr('data-attr');
            var dataid = $(this).attr('data-id');
            $.ajax({
                url: "/gudang_produk_gbj/mutasi/" + dataid,
                beforeSend: function() {
                    $('#loader').show();
                },
                // return the result
                success: function(result) {
                    $('#historimutasimodal').modal("show");
                    $('#historimutasi').html(result).show();
                    console.log(result);
                    $('#detaildata').DataTable({
                        processing: false,
                        serverSide: false,
                        ajax: href,
                        columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex',
                            orderable: false,
                            searchable: false
                        }, {
                            data: 'barcode',
                            name: 'barcode'
                        }]
                    });
                },
                complete: function() {
                    $('#loader').hide();
                },
                error: function(jqXHR, testStatus, error) {
                    console.log(error);
                    alert("Page " + href + " cannot open. Error:" + error);
                    $('#loader').hide();
                },
                timeout: 8000
            })
        });

        $('input[type="radio"][name="tampilan"]').on('change', function() {
            console.log($(this).val());
            if ($(this).val() == "tanggal") {
                $('#hariinitable').attr('hidden', true);
                $('#tanggal-form').removeAttr('hidden');
                $('#produktable').attr('hidden', true);
                $('#produk-form').attr('hidden', true);
                $('#produk').attr('disabled', true);
                $('#produk').val(null).trigger('change');

                $("#tipe_produk").text("-");
                $("#nama_produk").text("-");
                $("#jumlah_stok").text("-");
                $("#kartu_stock_tambah").attr('hidden', true);
            } else if ($(this).val() == "produk") {
                $('#hariinitable').attr('hidden', true);
                $('#tanggal-form').attr('hidden', true);
                $('#produk-form').removeAttr('hidden');
                $('#produktable').attr('hidden', true);
                $('#produk').removeAttr('disabled');
                $('#tanggal').val("");
            }
        });

        $('select[name="produk"]').on('change', function() {
            var k = $(this).val();
            if (k) {
                $('#hariinitable').attr('hidden', true);
                $('#produktable').removeAttr('hidden');
                $(".tambahurl").attr('href', '/gudang_produk_gbj/create/' + k);
                $.ajax({
                    url: '/gudang_produk_gbj/produk/' + k,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        console.log(data);
                        if (data != null) {
                            $("#tipe_produk").text(data['gudang_produk']['detail_produk']['produk']['nama']);
                            $("#nama_produk").text(data['gudang_produk']['detail_produk']['nama']);
                            $("#jumlah_stok").text(data['jumlah_saldo'] + " pcs");
                            $("#kartu_stock_tambah").attr('hidden', true);
                        } else {
                            $("#tipe_produk").text("-");
                            $("#nama_produk").text("-");
                            $("#jumlah_stok").text("-");
                            $("#kartu_stock_tambah").removeAttr('hidden');
                        }
                    },
                    error: function(data) {
                        $("#tipe_produk").text("-");
                        $("#nama_produk").text("-");
                        $("#jumlah_stok").text("-");
                        $("#kartu_stock_tambah").removeAttr('hidden');
                    }
                });

                $('#example2').DataTable({
                    destroy: true,
                    processing: true,
                    serverSide: false,
                    ajax: "/gudang_produk_gbj/produk/show/" + k,
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex',
                            orderable: false,
                            searchable: false,
                            className: 'text-center'
                        },
                        {
                            data: 'tanggal',
                            name: 'tanggal',
                            className: 'text-center'
                        },
                        {
                            data: 'divisi_id',
                            name: 'divisi_id',
                            className: 'text-left'
                        },
                        {
                            data: 'keterangan',
                            name: 'keterangan'
                        },
                        {
                            data: 'jumlah_masuk',
                            name: 'jumlah_masuk',
                            className: 'text-right'

                        },
                        {
                            data: 'jumlah_keluar',
                            name: 'jumlah_keluar',
                            className: 'text-right'

                        },
                        {
                            data: 'jumlah_saldo',
                            name: 'jumlah_saldo',
                            className: 'text-right'
                        },
                        {
                            data: 'aksi',
                            name: 'aksi',
                            className: 'text-center'
                        },
                    ]
                });
            }
        });

        $('#tanggal').on('keyup change', function() {
            var tanggal = $(this).val();
            if (tanggal != "") {
                $('#hariinitable').removeAttr('hidden');
                $('#produktable').attr('hidden', true);
                $('#example1').DataTable({
                    destroy: true,
                    processing: true,
                    serverSide: false,
                    ajax: "/gudang_produk_gbj/tanggal/show/" + tanggal,
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex',
                            orderable: false,
                            searchable: false,
                            className: 'text-center'
                        },
                        {
                            data: 'produk',
                            name: 'produk'
                        },
                        {
                            data: 'divisi_id',
                            name: 'divisi_id',
                            className: 'text-left'
                        },
                        {
                            data: 'keterangan',
                            name: 'keterangan'
                        },
                        {
                            data: 'jumlah_masuk',
                            name: 'jumlah_masuk',
                            className: 'text-right'

                        },
                        {
                            data: 'jumlah_keluar',
                            name: 'jumlah_keluar',
                            className: 'text-right'

                        },
                        {
                            data: 'jumlah_saldo',
                            name: 'jumlah_saldo',
                            className: 'text-right'
                        },
                        {
                            data: 'aksi',
                            name: 'aksi',
                            className: 'text-center'
                        },
                    ],
                });
            }
        })
    });
</script>
@stop