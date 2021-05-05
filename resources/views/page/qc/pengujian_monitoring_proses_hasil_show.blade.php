@extends('adminlte.page')

@section('title', 'Beta Version')

@section('content_header')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Pengujian</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">DataTables</li>
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
                            <label for="tanggal" class="col-sm-6 col-form-label">Tanggal Laporan</label>
                            <div class="col-sm-6 col-form-label" style="text-align:right;">
                                {{date("d-m-Y", strtotime($s->tanggal))}}
                            </div>
                        </div>

                        <div class="row form-group">
                            <label for="tanggal" class="col-sm-6 col-form-label">Operator QC</label>
                            <div class="col-sm-6 col-form-label" style="text-align:right;">
                                {{$s->Karyawan->nama}}
                            </div>
                        </div>
                        <div class="row">
                            <label for="tanggal" class="col-sm-6 col-form-label text-muted">Ubah Pemeriksaan</label>
                            <div class="col-sm-6 col-form-label" style="text-align:right;">
                                <a href="{{ route('pengujian.monitoring_proses.laporan.edit', ['id' => $id]) }}"><button class="btn btn-warning rounded-pill"><i class="fas fa-edit"></i>&nbsp;Edit</button></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-9">
            <div class="card">
                <!-- /.card-header -->
                <div class="card-body">
                    <h3><i class="fas fa-info-circle"></i>&nbsp;Hasil Monitoring Proses</h3><br>
                    @if ($errors->has('file'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('file') }}</strong>
                    </span>
                    @endif

                    {{-- notifikasi sukses --}}
                    @if ($sukses = Session::get('success'))
                    <div class="alert alert-success alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong>{{ $success }}</strong>
                    </div>
                    @endif

                    <table id="example" class="table table-hover styled-table">
                        <thead style="text-align: center;">
                            <tr>
                                <th>No</th>
                                <th>No Seri</th>
                                <th>Barcode</th>
                                <th>Hasil</th>
                                <th>Tindak Lanjut</th>
                                <th>Keterangan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody style="text-align:center;">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</section>
@endsection

@section('adminlte_js')
<script>
    $(function() {
        $('#example').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('pengujian.monitoring_proses.hasil.show', ['id' => $id]) }}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'no_seri',
                    name: 'no_seri'
                },
                {
                    data: 'no_barcode',
                    name: 'no_barcode'
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
                    data: 'keterangan',
                    name: 'keterangan'
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