@extends('adminlte.page')

@section('title', 'Beta Version')

@section('content_header')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>LKP dan LUP</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item"><a href="/pengujian">Pengujian</a></li>
                    <li class="breadcrumb-item active">LKP dan LUP</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
@stop

@section('content')
<section class="content">
    <div class="row">
        <div class="col-3">
            <div class="card">
                <div class="card-body">
                    <h3><i class="fas fa-info-circle"></i>&nbsp;Informasi</h3><br>
                    <div class="form-horizontal">
                        <div class="row">
                            <label for="no_seri" class="col-sm-6 col-form-label">No BPPB</label>
                            <div class="col-sm-6 col-form-label" style="text-align:right;">
                                {{$b->no_bppb}}
                            </div>
                        </div>

                        <div class="row">
                            <label for="no_seri" class="col-sm-4 col-form-label">Produk</label>
                            <div class="col-sm-8 col-form-label" style="text-align:right;">
                                {{$b->DetailProduk->nama}}
                            </div>
                        </div>

                        <div class="row">
                            <label for="tanggal" class="col-sm-6 col-form-label">Tanggal</label>
                            <div class="col-sm-6 col-form-label" style="text-align:right;">
                                {{date("d-m-Y", strtotime($b->tanggal_bppb))}}
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="col-9">
            <div class="card">
                <div class="card-body">
                    <h4>Daftar LKP dan LUP</h4><br>
                    <div class="form-horizontal">
                        <div class="form-group row">
                            <label for="list_hasil_perakitan" class="col-sm-5 col-form-label" style="text-align:right;">Daftar No Seri</label>
                            <div class="col-sm-7">
                                <select class="form-control select2 select2-info @error('list_hasil_perakitan') is-invalid @enderror" data-dropdown-css-class="select2-info" style="width: 40%;" data-placeholder="Pilih Tampilan" name="list_hasil_perakitan" id="list_hasil_perakitan">
                                    <option value=""></option>
                                    <option value="all">Semua Data</option>
                                    <option value="selesai">Sudah Diuji</option>
                                    <option value="belum">Belum Diuji</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table id="example1" class="table table-hover table-striped" width="100%">
                            <thead style="text-align: center;">
                                <tr>
                                    <th>No</th>
                                    <th>Kode Perakitan</th>
                                    <th>Barcode</th>
                                    <th>Teknisi</th>
                                    <th>Tgl Pengujian</th>
                                    <th>Berlaku s/d Tgl</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody style="text-align:center;" id="tbodies">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="deletemodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog modal-md" role="document">
                    <div class="modal-content">
                        <div class="modal-header" style="background-color:#cc0000;">
                            <h4 class="modal-title" id="myModalLabel" style="color:white;">Hapus Laporan</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="modal-body" id="delete">

                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>
</section>
@stop

@section('adminlte_js')
<script>
    $(function() {
        $('select[name="list_hasil_perakitan"]').on('change', function() {
            var id = jQuery(this).val();
            var jumlah = $('#jumlah').val();
            console.log(id);
            if (id != "") {
                $('#example1').DataTable({
                    destroy: true,
                    processing: true,
                    serverSide: false,
                    ajax: "/pengujian/lkp_lup/show/" + "{{$b->id}}" + "/" + id,
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex',
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: 'hasil_perakitan_id',
                            name: 'hasil_perakitan_id'
                        },
                        {
                            data: 'barcode',
                            name: 'barcode'
                        },
                        {
                            data: 'teknisi',
                            name: 'teknisi'
                        },
                        {
                            data: 'tanggal_pengujian',
                            name: 'tanggal_pengujian'
                        },
                        {
                            data: 'tanggal_expired',
                            name: 'tanggal_expired'
                        },
                        {
                            data: 'status',
                            name: 'status'
                        },
                    ]
                });
            } else if (id == "") {
                console.log("tes");
                $('#example1').DataTable().clear().draw();
            }
        });
    });
</script>
@stop