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
                    <li class="breadcrumb-item active">Kalibrasi </li>
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
                <div class="card-header">
                    <div class="card-title">LKP dan LUP</div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover" id="example1">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kode Perakitan</th>
                                    <th>No Barcode</th>
                                    <th>Tanggal Pengujian</th>
                                    <th>Berlaku s/d Tanggal</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td></td>
                                    <td></td>
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
</section>
@stop

@section('adminlte_js')
<script>
    $(function() {
        $('#example').DataTable({
            destroy: true,
            processing: true,
            serverSide: false,
            ajax: "/pengujian/lup_lkp/show",
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
                    data: 'tanggal_kalibrasi',
                    name: 'tanggal_kalibrasi'
                },
                {
                    data: 'tanggal_selesai',
                    name: 'tanggal_selesai'
                },
                {
                    data: 'hasil',
                    name: 'hasil'
                },
                {
                    data: 'tindak_lanjut',
                    name: 'tindak_lanjut'
                },
                {
                    data: 'aksi',
                    name: 'aksi'
                },
            ]
        });
    });
</script>
@stop