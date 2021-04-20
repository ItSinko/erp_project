@extends('adminlte.page')

@section('title', 'Beta Version')

@section('content_header')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Pemeriksaan Perakitan</h1>
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
                <div class="card-header">
                    <div class="card-title"><i class="fas fa-"></i>Info Perakitan</div>
                </div>
                <div class="card-body">

                    <div class="card-body box-profile">
                        <div class="text-center">
                            <img class="product-img-small img-fluid" @if(empty($s->Bppb->DetailProduk->foto))
                            src="{{url('assets/image/produk')}}/noimage.png"
                            @elseif(!empty($s->Bppb->DetailProduk->foto))
                            src="{{url('assets/image/produk')}}/{{$s->Bppb->DetailProduk->foto}}"
                            @endif
                            title="{{$s->Bppb->DetailProduk->nama}}"
                            >
                        </div>
                        <div style="text-align:center;vertical-align:center;padding-top:10px">
                            <h5 class="card-heading">{{$s->Bppb->DetailProduk->nama}}</h5>
                            <h6 class="card-subheading text-muted">{{$s->Bppb->DetailProduk->Produk->nama}}</h6>
                        </div>
                    </div>
                    <div class="row" style="padding-bottom:10%;">
                        @if($s->status == 12)
                        <a href="{{route('perakitan.pemeriksaan.laporan.edit', ['id' => $s->id])}}">
                            <div class="inline-flex col-lg-12">
                                <button type="button" class="btn btn-block btn-primary rounded-pill"><i class="fas fa-tasks"></i> Pemeriksaan</button>
                            </div>
                        </a>
                        @endif
                    </div>

                    <div class="row">
                        <div class="col-lg-6" style="vertical-align: middle;">
                            <hgroup>
                                <!-- hgroup is deprecated, just defiantly using it anyway -->
                                <h6 class="card-subheading text-muted">No BPPB</h6>
                                <h5 class="card-heading">{{$s->Bppb->no_bppb}}</h5>
                            </hgroup>
                            <hgroup>
                                <!-- hgroup is deprecated, just defiantly using it anyway -->
                                <h6 class="card-subheading text-muted ">Tanggal</h6>
                                <h5 class="card-heading">{{date("d-m-Y", strtotime($s->tanggal))}}</h5>
                            </hgroup>
                        </div>
                        <div class="col-lg-6" style="vertical-align: middle;">
                            <hgroup>
                                <!-- hgroup is deprecated, just defiantly using it anyway -->
                                <h6 class="card-subheading text-muted ">Jumlah</h6>
                                <h5 class="card-heading">{{$s->Bppb->jumlah}}</h5>
                            </hgroup>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-9">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Hasil Perakitan</div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
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

                    <table id="example" class="table table-hover table-bordered styled-table">
                        <thead style="text-align: center;">
                            <tr>
                                <th rowspan="2">No</th>
                                <th rowspan="2">Tanggal</th>
                                <th rowspan="2">No Seri</th>
                                <th rowspan="2">Operator</th>
                                <th colspan="2">Pemeriksaan Terbuka</th>
                                <th colspan="2">Pemeriksaan Tertutup</th>
                                <th rowspan="2">Keterangan</th>
                                <th rowspan="2">Aksi</th>
                            </tr>
                            <tr>
                                <th>Kondisi</th>
                                <th>Tindak Lanjut</th>
                                <th>Kondisi</th>
                                <th>Tindak Lanjut</th>
                            </tr>
                        </thead>
                        <tbody style="text-align:center;">

                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->


            <!-- /.card -->
        </div>

        <div class="modal fade" id="importExcel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <form method="post" action="{{route('perakitan.hasil.import', ['id' => $s->id])}}" enctype="multipart/form-data">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Import Excel</h5>
                        </div>
                        <div class="modal-body">
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}
                            <label>Pilih file excel</label>
                            <div class="form-group">
                                <input type="file" name="file" required="required" accept=".xls,.xlsx,.csv">
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Import</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="modal fade" id="deletenoserimodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog modal-md" role="document">
                <div class="modal-content">
                    <div class="modal-header" style="background-color:#cc0000;">
                        <h4 class="modal-title" id="myModalLabel" style="color:white;">Hapus No Seri</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body" id="deletenoseri">

                    </div>
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
            ajax: "{{ route('perakitan.pemeriksaan.hasil.show', ['id' => $id]) }}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'tanggal',
                    name: 'tanggal'
                },
                {
                    data: 'no_seri',
                    name: 'no_seri'
                },
                {
                    data: 'operator',
                    name: 'operator'
                },
                {
                    data: 'kondisi_terbuka',
                    name: 'kondisi_terbuka'
                },
                {
                    data: 'tindak_lanjut_terbuka',
                    name: 'tindak_lanjut_terbuka'
                },
                {
                    data: 'kondisi_tertutup',
                    name: 'kondisi_tertutup'
                },
                {
                    data: 'tindak_lanjut_tertutup',
                    name: 'tindak_lanjut_tertutup'
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

        $(document).on('click', '.deletemodal', function(event) {
            event.preventDefault();
            var href = $(this).attr('data-attr');
            $.ajax({
                url: '/template_form_delete',
                beforeSend: function() {
                    $('#loader').show();
                },
                // return the result
                success: function(result) {
                    $('#deletemodal').modal("show");
                    $('#delete').html(result).show();
                    $("#deleteform").attr("action", href);
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

    });
</script>
@stop