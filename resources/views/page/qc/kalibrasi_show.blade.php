@extends('adminlte.page')

@section('title', 'Beta Version')

@section('content_header')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Kalibrasi</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item active">Kalibrasi</li>
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
                    <h4>Daftar Kalibrasi</h4><br>
                    <div class="table-responsive">
                        <table id="example1" class="table table-hover table-bordered styled-table">
                            <thead style="text-align: center;">
                                <tr style="text-align: right;">
                                    <th colspan="12"><button class="btn btn-sm btn-success" id="tambahlaporan" disabled><i class="fas fa-plus"></i>&nbsp; Tambah Pengemasan</button></th>
                                </tr>
                                <tr>
                                    <th>No</th>
                                    <th>No BPPB</th>
                                    <th>Tanggal</th>
                                    <th>No Kalibrasi</th>
                                    <th>Nama Produk</th>
                                    <th>Kalibrator</th>
                                    <th>Hasil</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody style="text-align:center;">

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