@extends('adminlte.page')

@section('title', 'Beta Version')

@section('content_header')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1></h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item active">Packing List</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
@stop

@section('content')
<section class="content">

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="form-horizontal">
                        <div class="form-group row">
                            <label for="detail_produk_id" class="col-sm-5 col-form-label" style="text-align:right;">Cari Packing List</label>
                            <div class="col-sm-4">
                                <div class="select2-info">
                                    <select class="select2 custom-select form-control @error('packing_list_id') is-invalid @enderror packing_list_id" data-placeholder="Pilih Produk" data-dropdown-css-class="select2-info" style="width: 80%;" name="packing_list_id" id="detail_produk_id">
                                        <option value=""></option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row" hidden>
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4>Pengemasan</h4><br>
                    <div class="table-responsive">
                        <table id="example1" class="table table-hover table-striped styled-table" style="width:100%;">
                            <thead style="text-align: center;">
                                <tr style="text-align: right;">
                                    <th colspan="12"><button class="btn btn-sm btn-success" id="tambahlaporan" disabled><i class="fas fa-plus"></i>&nbsp; Tambah Pengemasan</button></th>
                                </tr>
                                <tr>
                                    <th>#</th>
                                    <th>No Seri</th>
                                    <th>Barcode</th>
                                    <th>Kondisi Unit</th>
                                    <th>Hasil</th>
                                    <th>Keterangan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody style="text-align:center;">
                                <div></div>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="monitoringprosesmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header" style="background-color:	#006400;">
                            <h4 class="modal-title" id="myModalLabel" style="color:white;">Laporan</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="modal-body" id="monitoringproses">

                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="pemeriksaanprosesmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header" style="background-color:	#006400;">
                            <h4 class="modal-title" id="myModalLabel" style="color:white;">Laporan</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="modal-body" id="pemeriksaanproses">

                        </div>
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
    <!-- /.row -->
</section>
@endsection