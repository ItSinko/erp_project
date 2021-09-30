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
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item"><a href="/perakitan/pemeriksaan">Perakitan</a></li>
                    <li class="breadcrumb-item active">Data Laporan</li>
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
                            <hgroup>
                                <!-- hgroup is deprecated, just defiantly using it anyway -->
                                <h6 class="card-subheading text-muted ">Karyawan</h6>
                                <h5 class="card-heading">@foreach ($s->Karyawan as $kry)
                                    {{ $loop->first ? '' : '' }}
                                    <div>{{ $kry->nama}}</div>
                                    @endforeach
                                </h5>
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
                    <div class="row" style="margin-bottom:10px;">
                        <div class="col-lg-12">
                            <span class="btn-group float-right" role="group" aria-label="Button group with nested dropdown">
                                <button type="button" class="btn btn-outline-info"><i class="fas fa-list"></i></button>
                                <button type="button" class="btn btn-outline-info"><i class="fas fa-th"></i></button>
                            </span>
                            <span class="dropdown float-right" id="filter" style="margin-right:5px;">
                                <button class=" btn btn-outline-info dropdown-toggle" type="button" id="dropdownFilter" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Filter
                                </button>
                                <ul id="filter_dd" class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownFilter">
                                    <li><a class="dropdown-item status_filter semua" id="status_filter" name="status_filter">Semua</a></li>
                                    <li><a class="dropdown-item status_filter req_pemeriksaan" id="status_filter" name="status_filter">Permintaan Pemeriksaan</a></li>
                                    <li><a class="dropdown-item status_filter acc_pemeriksaan" id="status_filter" name="status_filter">Selesai Pemeriksaan</a></li>
                                </ul>
                            </span>
                            <span class="dropdown float-right" id="status" style="margin-right:5px;" hidden>
                                <button class="btn btn-outline-info dropdown-toggle" type="button" id="dropdownStatus" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Status
                                </button>
                                <ul id="status_dd" class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownFilter">
                                    <li><a class="dropdown-item status_update request" id="status_update" name="status_update"><i class="fas fa-check"></i>&nbsp;Pemeriksaan OK</a></li>
                                </ul>
                            </span>
                            <div></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
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
                                        <th rowspan="2">#</th>
                                        <th rowspan="2">Tanggal</th>
                                        <th rowspan="2">No Seri</th>
                                        <th colspan="2">Pemeriksaan</th>
                                        <th rowspan="2">Keterangan</th>
                                        <th rowspan="2">Aksi</th>
                                    </tr>
                                    <tr>
                                        <th>Hasil</th>
                                        <th>Tindak Lanjut</th>
                                    </tr>
                                </thead>
                                <tbody style="text-align:center;">

                                </tbody>
                            </table>
                        </div>
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

            <div class="modal fade" id="periksaokmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog modal-md" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-info">
                            <h5 class="modal-title" id="myModalLabel" style="color:white;">Periksa Hasil</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="modal-body" id="periksa">
                            <section class="content">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="card">
                                            <div class="card-body" style="text-align:center;">
                                                <h6>Apakah anda yakin mengubah Status item ini?</h6>
                                            </div>
                                            <div class="card-footer col-12" style="margin-bottom: 2%;">
                                                <span>
                                                    <button type="button" class="btn btn-block btn-danger" data-dismiss="modal" id="batal" style="width:30%;float:left;">Batal</button>
                                                </span>
                                                <span>
                                                    <button type="submit" class="btn btn-block btn-success" id="iya" style="width:30%;float:right;">Keluar</button></a>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="perbaikanproduksimodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header" style="background-color:	#006400;">
                            <h4 class="modal-title" id="myModalLabel" style="color:white;">Laporan Perbaikan</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="modal-body" id="perbaikanproduksi">

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
        tableview("semua");

        function tableview(status) {
            $('#example').DataTable({
                destroy: true,
                processing: true,
                serverSide: true,
                ajax: "/perakitan/pemeriksaan/hasil/show/" + '{{$id}}' + "/" + status,
                columns: [{
                        data: 'checkbox',
                        name: 'checkbox'
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
                        data: 'hasil_tertutup',
                        name: 'hasil_tertutup'
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
        }

        $('#example').on('change', 'input[type="checkbox"][name="checkbox[]"]', function() {
            var cbox = $('input[type="checkbox"][name="checkbox[]"]:checkbox:checked');
            if (cbox.length <= 0) {
                $('#status').attr('hidden', true);
                $('#filter').removeAttr('hidden');
                // $('input[type="checkbox"].req_pemeriksaan_tertutup').removeAttr('disabled');
                // $('input[type="checkbox"].req_pemeriksaan_terbuka').removeAttr('disabled');
                // $('.acc_pemeriksaan_terbuka_status').removeClass('disabled');
                // $('.acc_pemeriksaan_tertutup_status').removeClass('disabled');
            } else if (cbox.length > 0) {
                $('#filter').attr('hidden', true);
                $('#status').removeAttr('hidden');
                // if (cbox.hasClass('req_pemeriksaan_terbuka')) {
                //     $('input[type="checkbox"].req_pemeriksaan_tertutup').attr('disabled', true);
                //     $('input[type="checkbox"].req_pemeriksaan_terbuka').removeAttr('disabled');
                //     $('.acc_pemeriksaan_tertutup_status').addClass('disabled');
                //     $('.acc_pemeriksaan_terbuka_status').removeClass('disabled');
                // } else if (cbox.hasClass('req_pemeriksaan_tertutup')) {
                //     $('input[type="checkbox"].req_pemeriksaan_tertutup').removeAttr('disabled');
                //     $('input[type="checkbox"].req_pemeriksaan_terbuka').attr('disabled', true);
                //     $('.acc_pemeriksaan_tertutup_status').removeClass('disabled');
                //     $('.acc_pemeriksaan_terbuka_status').addClass('disabled');
                // }
            }
        });

        $('#filter_dd').on('click', "#status_filter", function(e) {
            e.preventDefault();
            var status = "";

            if ($(this).hasClass('semua')) {
                status = "semua";
            } else if ($(this).hasClass('req_pemeriksaan')) {
                status = "req_pemeriksaan";
            } else if ($(this).hasClass('acc_pemeriksaan')) {
                status = "acc_pemeriksaan";
            }

            tableview(status);
        });

        $('#status_dd').on('click', "#status_update", function(e) {
            e.preventDefault();
            var status = "";
            var arr = [];
            $('input[type="checkbox"][name="checkbox[]"]:checkbox:checked').each(function() {
                arr.push($(this).val());
            });

            if ($(this).hasClass('request')) {
                status = "acc_pemeriksaan_tertutup";
            }

            if (arr.length > 0) {
                $.ajax({
                    url: "/perakitan/multiple/status/" + arr + "/" + status,
                    success: function(result) {
                        window.location.reload(true);
                    },
                    error: function(jqXHR, testStatus, error) {
                        console.log("error");
                    },
                    timeout: 8000
                })
            }
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

        $(document).on('click', '.perbaikanproduksimodal', function(event) {
            event.preventDefault();
            var href = $(this).attr('data-attr');
            var dataid = $(this).attr('data-id');
            $.ajax({
                url: href,
                beforeSend: function() {
                    $('#loader').show();
                },
                success: function(result) {
                    $('#perbaikanproduksimodal').modal("show");
                    $('#perbaikanproduksi').html(result).show();
                    console.log(result);
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