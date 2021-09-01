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
                                        <input type="radio" id="tampilan1" name="tampilan" value="hari_ini">
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
                            <label for="tambah" class="col-sm-5 col-form-label" style="text-align:left;">Tambahkan </label>
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
                                <thead style="text-align: center;">
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal</th>
                                        <th>Asal / Tujuan</th>
                                        <th>Keterangan</th>
                                        <th>Jumlah Masuk</th>
                                        <th>Jumlah Keluar</th>
                                        <th>Jumlah Saldo</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody style="text-align:center;" id="tbodies">

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
                                <thead style="text-align: center;">
                                    <tr>
                                        <th>No</th>
                                        <th>Produk</th>
                                        <th>Asal / Tujuan</th>
                                        <th>Keterangan</th>
                                        <th>Jumlah Masuk</th>
                                        <th>Jumlah Keluar</th>
                                        <th>Jumlah Saldo</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody style="text-align:center;" id="tbodies">

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="historimutasimodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog modal-lg" role="document">
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
                url: "{{route('gudang_produk_gbj.mutasi')}}",
                beforeSend: function() {
                    $('#loader').show();
                },
                // return the result
                success: function(result) {
                    $('#historimutasimodal').modal("show");
                    $('#historimutasi').html(result).show();
                    console.log(result);
                    $('#detaildata').DataTable({
                        processing: true,
                        serverSide: true,
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
            if ($(this).val() == "hari_ini") {
                $('#produk').attr('disabled', true);
                $('#produk').val(null).trigger('change');
                var today = new Date();
                var dd = String(today.getDate()).padStart(2, '0');
                var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
                var yyyy = today.getFullYear();
                today = yyyy + '-' + mm + '-' + dd;

                $('#hariinitable').removeAttr('hidden');
                $('#produktable').attr('hidden', true);
                $('#example1').DataTable({
                    destroy: true,
                    processing: true,
                    serverSide: false,
                    ajax: "/gudang_produk_gbj/tanggal/show/" + today,
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex',
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: 'produk',
                            name: 'produk'
                        },
                        {
                            data: 'divisi_id',
                            name: 'divisi_id'
                        },
                        {
                            data: 'keterangan',
                            name: 'keterangan'
                        },
                        {
                            data: 'jumlah_masuk',
                            name: 'jumlah_masuk'
                        },
                        {
                            data: 'jumlah_keluar',
                            name: 'jumlah_keluar'
                        },
                        {
                            data: 'jumlah_saldo',
                            name: 'jumlah_saldo'
                        },
                        {
                            data: 'aksi',
                            name: 'aksi'
                        },
                    ]
                });
            } else if ($(this).val() == "produk") {
                $('#hariinitable').attr('hidden', true);
                $('#produktable').removeAttr('hidden');
                $('#produk').removeAttr('disabled');
            }
        });

        $('select[name="produk"]').on('change', function() {
            var k = $(this).val();
            if (k) {
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
                    serverSide: true,
                    ajax: "/gudang_produk_gbj/produk/show/" + k,
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex',
                            orderable: false,
                            searchable: false
                        }, {
                            data: 'tanggal',
                            name: 'tanggal'
                        },
                        {
                            data: 'divisi_id',
                            name: 'divisi_id'
                        },
                        {
                            data: 'keterangan',
                            name: 'keterangan'
                        },
                        {
                            data: 'jumlah_masuk',
                            name: 'jumlah_masuk'
                        },
                        {
                            data: 'jumlah_keluar',
                            name: 'jumlah_keluar'
                        },
                        {
                            data: 'jumlah_saldo',
                            name: 'jumlah_saldo'
                        },
                        {
                            data: 'aksi',
                            name: 'aksi'
                        },
                    ]
                });
            }
        });
    });
</script>
@stop