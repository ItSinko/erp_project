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
                <h1>Perakitan</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item"><a href="/perakitan/pemeriksaan">Perakitan</a></li>
                    <li class="breadcrumb-item active">Hasil Perakitan</li>
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
                            <img class="product-img-small img-fluid" @if(empty($s->DetailProduk->foto))
                            src="{{url('assets/image/produk')}}/noimage.png"
                            @elseif(!empty($s->DetailProduk->foto))
                            src="{{url('assets/image/produk')}}/{{$s->DetailProduk->foto}}"
                            @endif
                            title="{{$s->DetailProduk->nama}}"
                            >
                        </div>
                        <div style="text-align:center;vertical-align:center;padding-top:10px">
                            <h5 class="card-heading">{{$s->DetailProduk->nama}}</h5>
                            <h6 class="card-subheading text-muted">{{$s->DetailProduk->Produk->nama}}</h6>
                        </div>
                    </div>
                    <!-- <div class="row" style="padding-bottom:10%;">
                        @if($s->status == 12)
                        <a href="">
                            <div class="inline-flex col-lg-12">
                                <button type="button" class="btn btn-block btn-primary rounded-pill"><i class="fas fa-tasks"></i> Pemeriksaan</button>
                            </div>
                        </a>
                        @endif
                    </div> -->

                    <div class="row">
                        <div class="col-lg-6" style="vertical-align: middle;">
                            <hgroup>
                                <!-- hgroup is deprecated, just defiantly using it anyway -->
                                <h6 class="card-subheading text-muted">No BPPB</h6>
                                <h5 class="card-heading">{{$s->no_bppb}}</h5>
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
                                <h5 class="card-heading">{{$s->jumlah}}</h5>
                            </hgroup>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <div class="col-9">
            @if(session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong><i class="fas fa-check"></i></strong> {{session()->get('success')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @elseif(session()->has('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong><i class="fas fa-times"></i></strong> {{session()->get('error')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @elseif(count($errors) > 0)
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong><i class="fas fa-times"></i></strong> Lengkapi data terlebih dahulu
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif
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

                            <div class="table-responsive">
                                <table id="examples" class="table table-hover table-striped styled-table" style="width:100%;">
                                    <thead style="text-align: center;">
                                        <tr>
                                            <th>#</th>
                                            <th>Tanggal</th>
                                            <th>No Seri</th>
                                            <th>Operator</th>
                                            <th>Pemeriksaan</th>
                                            <th>Keterangan</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody style="text-align:center; vertical-align: middle;">

                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>

        <!-- MODAL -->
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
        $("#examples").popover({
                trigger: "manual",
                html: true,
                animation: false,
                content: function() {
                    return $(this).next('.pop').html();
                }
            })
            .on("mouseenter", '.pop', function() {
                var _this = this;
                $(this).popover("show");
                $(".pop").on("mouseleave", function() {
                    $(_this).popover('hide');
                });
            }).on("mouseleave", '.pop', function() {
                var _this = this;
                setTimeout(function() {
                    if (!$(".pop:hover").length) {
                        $(_this).popover("hide");
                    }
                }, 300);
            });

        function tableview(status) {
            $('#examples').DataTable({
                destroy: true,
                scrollX: true,
                processing: true,
                serverSide: true,
                ajax: "/perakitan/pemeriksaan/bppb/show/{{$id}}/" + status,
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
                        data: 'operator',
                        name: 'operator'
                    },
                    {
                        data: 'hasil_tertutup',
                        name: 'hasil_tertutup'
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

        $('#examples').on('change', 'input[type="checkbox"][name="checkbox[]"]', function() {
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