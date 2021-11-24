@extends('adminlte.page')

@section('title', 'Beta Version')

@section('content_header')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>IK Pemeriksaan</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item"><a href="/ik_pemeriksaan">IK Pemeriksaan</a></li>
                    <li class="breadcrumb-item active">Tambah IK Pemeriksaan</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
@stop

@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <!-- left column -->
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <h3>Info Produk</h3>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item borderless"><b>Tipe Produk</b><a class="float-right">{{$prd->nama}}</a></li>
                            <li class="list-group-item borderless"><b>Nama Produk</b><a class="float-right">{{$prd->Produk->nama}}</a></li>
                            <li class="list-group-item borderless"><b>Kategori</b><a class="float-right">{{$prd->Produk->KelompokProduk->nama}}</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
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
                    <div class="card-header bg-success">
                        <h3 class="card-title" style="color:white;"><i class="fa fa-plus-circle" aria-hidden="true"></i>&nbsp;IK Pemeriksaan {{$proses}}</h3>
                    </div>
                    <div class="card-body">
                        <div class="col-md-12">
                            <form action="{{ route('ik_pemeriksaan.store', ['id' => $id, 'proses' => $proses]) }}" method="post" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                {{ method_field('PUT') }}

                                <div class="form-horizontal">

                                    <div class="form-group row">
                                        <table id="tableitem" class="table table-hover tableitem">
                                            <thead style="text-align:center;">
                                                <tr>
                                                    <th>No</th>
                                                    <th>Hal yang diperiksa</th>
                                                    <th colspan="2">Standar Keberterimaan</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody style="text-align: center;">
                                                <tr class="kolom" id="kolom0">
                                                    <td rowspan="1" class="nomor">1</td>
                                                    <td rowspan="1" class="pemeriksaan">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control pemeriksaan" id="pemeriksaan" name="pemeriksaan[]">
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-group">
                                                            <input type="text" class="form-control penerimaan" id="penerimaan" name="penerimaan[][]">
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-group">
                                                            <a type="button" id="tambahkolom"><i class="fas fa-plus" style="color:green;"></i></button>
                                                        </div>
                                                    </td>
                                                    <td rowspan="1" class="tambahbaris"><button type="button" class="btn btn-success btn-sm m-1" style="border-radius:50%;" id="tambahitem"><i class="fas fa-plus-circle"></i></button></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <span>
                            <a class="cancelmodal" data-toggle="modal" data-target="#cancelmodal"><button type="button" class="btn btn-block btn-danger rounded-pill" style="width:200px;float:left;"><i class="fas fa-times"></i>&nbsp;Batal</button></a>
                        </span>
                        <span>
                            <button type="submit" class="btn btn-block btn-success rounded-pill" style="width:200px;float:right;" id="tambahlaporan"><i class="fas fa-plus"></i>&nbsp;Tambah Data</button>
                        </span>
                    </div>
                    </form>
                </div>

                <!-- /.row -->
            </div><!-- /.container-fluid -->
            <div class="modal fade" id="cancelmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog modal-md" role="document">
                    <div class="modal-content">
                        <div class="modal-header" style="background-color:	#778899;">
                            <h4 class="modal-title" id="myModalLabel" style="color:white;">Keluar Halaman</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="modal-body" id="cancel">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="card">
                                        <div class="card-body" style="text-align:center;">
                                            <h6>Apakah anda yakin meninggalkan halaman ini?</h6>
                                        </div>
                                        <div class="card-footer col-12" style="margin-bottom: 2%;">
                                            <span>
                                                <button type="button" class="btn btn-block btn-secondary" data-dismiss="modal" id="batalhapussk" style="width:30%;float:left;">Batal</button>
                                            </span>
                                            <span>
                                                <a href="/ik_pemeriksaan"><button type="submit" class="btn btn-block btn-danger" id="hapussk" style="width:30%;float:right;">Keluar</button></a>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
</section>
@endsection

@section('adminlte_js')
<script>
    $(function() {
        var rowCount = 0;

        function numberRows($t) {
            var c = 0;
            $t.find("tr.kolom").each(function(ind, el) {
                $(el).find("td:eq(0)").html(++c);
                var j = c - 1;
                var id = $(el).attr('id');
                $('tr[id="' + id + '"]').find('input[id="penerimaan"]').attr('name', 'penerimaan[' + j + '][]');
                $('tr[id="' + id + '"]').attr('id', 'kolom' + j);
                $(el).attr('id', 'kolom' + j);
                $(el).find('input[id="pemeriksaan"]').attr('name', 'pemeriksaan[' + j + ']');
                $(el).find('input[id="penerimaan"]').attr('name', 'penerimaan[' + j + '][]');
            });
        }

        $('#tableitem').on('click', '.kolom #tambahkolom', function() {
            var id = $(this).closest('tr').attr('id');
            var x = $(this).closest('tr[id="' + id + '"]').find('.nomor').attr('rowspan');
            var penerimaan = $(this).closest('tr[id="' + id + '"]').find('.penerimaan').attr('name');

            $(this).closest('tr[id="' + id + '"]').find('.nomor').attr('rowspan', (parseInt(x) + 1));
            $(this).closest('tr[id="' + id + '"]').find('.pemeriksaan').attr('rowspan', (parseInt(x) + 1));
            $(this).closest('tr[id="' + id + '"]').find('.tambahbaris').attr('rowspan', (parseInt(x) + 1));
            $(this).closest('tr.kolom').after(`<tr id="` + id + `">
            <td>
                <div class="form-group">
                    <input type="text" class="form-control penerimaan" id="penerimaan" name="` + penerimaan + `">
                </div>
            </td>
            <td>
                <div class="form-group">
                    <a type="button" id="hapuskolom"><i class="fas fa-times" style="color:red;"></i></button>
                </div>
            </td>
            </tr>`);
        });

        $('#tableitem').on('click', '#hapuskolom', function() {
            var id = $(this).closest('tr').attr('id');
            var x = $('tr[id="' + id + '"]').find('.nomor').attr('rowspan');

            $('tr[id="' + id + '"]').find('.nomor').attr('rowspan', (parseInt(x) - 1));
            $('tr[id="' + id + '"]').find('.pemeriksaan').attr('rowspan', (parseInt(x) - 1));
            $('tr[id="' + id + '"]').find('.tambahbaris').attr('rowspan', (parseInt(x) - 1));
            $(this).closest('tr').remove();
        });

        $('#tableitem').on('click', '#tambahitem', function() {
            rowCount++;
            $('#tableitem tr:last').after(`<tr class="kolom" id="kolom` + rowCount + `">
                <td rowspan="1" class="nomor">1</td>
                <td rowspan="1" class="pemeriksaan">
                    <div class="form-group">
                        <input type="text" class="form-control pemeriksaan" id="pemeriksaan" name="pemeriksaan[]">
                    </div>
                </td>
                <td>
                    <div class="form-group">
                        <input type="text" class="form-control penerimaan" id="penerimaan" name="penerimaan[][]">
                    </div>
                </td>
                <td>
                    <div class="form-group">
                        <a type="button" id="tambahkolom"><i class="fas fa-plus" style="color:green;"></i></button>
                    </div>
                </td>
                <td rowspan="1" class="tambahbaris"><button type="button" class="btn btn-danger btn-sm m-1" style="border-radius:50%;" id="hapusitem"><i class="fas fa-times-circle"></i></button></td>
            </tr>`);
            numberRows($("#tableitem"));
        });

        $('#tableitem').on('click', '#hapusitem', function() {
            var id = $(this).closest('tr').attr('id');
            $('tr[id="' + id + '"]').remove();
            numberRows($("#tableitem"));
        });
    });
</script>
@endsection