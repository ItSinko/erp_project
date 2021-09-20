@extends('adminlte.page')

@section('title', 'Beta Version')

@section('content_header')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Format Pengecekan QC</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item"><a href="/ik_pemeriksaan">Laporan QC</a></li>
                    <li class="breadcrumb-item active">Tambah LKP atau LUP</li>
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
            <div class="row">
                <div class="col-lg-3">
                    <div class="card">
                        <div class="card-body">
                            <div class=" form-group row">
                                <label for="tipe_produk" class="col-sm-4 col-form-label" style="text-align:left;">Tipe Produk</label>
                                <span class="col-sm-8 col-form-label" style="text-align:right;" id="tipe_produk">{{$p->tipe}}</span>
                            </div>
                            <div class="form-group row">
                                <label for="nama_produk" class="col-sm-4 col-form-label" style="text-align:left;">Nama Produk</label>
                                <span class="col-sm-8 col-form-label" style="text-align:right;" id="nama_produk">{{$p->nama}}</span>
                            </div>
                            <div class="form-group row">
                                <label for="kelompok_produk" class="col-sm-5 col-form-label" style="text-align:left;">Kelompok Produk</label>
                                <span class="col-sm-7 col-form-label" style="text-align:right;" id="kelompok_produk">{{$p->KelompokProduk->nama}}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="card">
                        <div class="card-header bg-success">
                            <h3 class="card-title" style="color:white;"><i class="fa fa-plus-circle" aria-hidden="true"></i>&nbsp;LKP LUP</h3>
                        </div>
                        <div class="card-body">
                            <div class="col-md-12">
                                <form action="{{route('lkp_lup.store', ['id' => $id])}}" method="post" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    {{ method_field('PUT') }}
                                    <div class="form-horizontal">
                                        <div class="form-group row">
                                            <table id="tableitem" class="table table-hover tableitem">
                                                <thead style="text-align:center;">
                                                    <tr>
                                                        <th rowspan="3">No</th>
                                                        <th colspan="6">Pengecekan</th>
                                                    </tr>
                                                    <tr>
                                                        <th rowspan="2"></th>
                                                        <th colspan="5">Parameter</th>
                                                    </tr>
                                                    <tr>
                                                        <th></th>
                                                        <th colspan="4">Nilai Parameter</th>
                                                    </tr>
                                                </thead>
                                                <tbody style="text-align: center;">
                                                    <tr class="kolom" id="koloma0">
                                                        <td rowspan="1" class="nomor">1</td>
                                                        <td rowspan="1" class="nama_pengecekan">
                                                            <div class="form-group">
                                                                <input type="text" class="form-control nama_pengecekan" id="nama_pengecekan" name="nama_pengecekan[]">
                                                            </div>
                                                        </td>
                                                        <td rowspan="1" class="nama_parameter kolom1" id="koloma0" name="kolomb00">
                                                            <div class="form-group">
                                                                <input type="text" class="form-control" id="nama_parameter" name="nama_parameter[][]">
                                                            </div>
                                                        </td>
                                                        <td class="nilai_parameter" id="kolomb00">
                                                            <div class="form-group">
                                                                <input type="text" class="form-control" id="nilai_parameter" name="nilai_parameter[][][]">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-group">
                                                                <a type="button" id="tambahnilaiparameter"><i class="fas fa-plus" style="color:green;"></i></button>
                                                            </div>
                                                        </td>
                                                        <td rowspan="1" class="aksinamaparameter">
                                                            <div class="form-group">
                                                                <a type="button" id="tambahnamaparameter"><i class="fas fa-plus" style="color:green;"></i></button>
                                                            </div>
                                                        </td>
                                                        <td rowspan="1" class="aksinamapengecekan"><button type="button" class="btn btn-success btn-sm m-1" style="border-radius:50%;" id="tambahnamapengecekan"><i class="fas fa-plus-circle"></i></button></td>
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
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
</section>
@endsection

@section('adminlte_js')
<script>
    $(function() {
        var rowCount = 0;

        function numberRowsPengecekan($t) {
            var c = 0;
            $t.find("tr.kolom").each(function(ind, el) {
                $(el).find("td:eq(0)").html(++c);
                var j = c - 1;
                var id = $(el).attr('id');

                var k = 0;
                $('tr[id="' + id + '"]').each(function(ind1, el1) {
                    var name = $(el1).attr('name');
                    $(el1).find('input[id="nama_parameter"]').attr('name', 'nama_parameter[' + j + '][' + k + ']');
                    $(el1).find('input[id="nilai_parameter"]').attr('name', 'nilai_parameter[' + j + '][' + k + '][]');
                    k++;
                });
                $('tr[id="' + id + '"]').find('input[id="nama_pengecekan"]').attr('name', 'nama_pengecekan[' + j + ']');
            });
        }

        $('#tableitem').on('click', '#tambahnamapengecekan', function() {
            rowCount++;
            $('#tableitem tr:last').after(`<tr class="kolom" id="koloma` + rowCount + `">
                <td rowspan="1" class="nomor"></td>
                <td rowspan="1" class="nama_pengecekan">
                    <div class="form-group">
                        <input type="text" class="form-control nama_pengecekan" id="nama_pengecekan" name="nama_pengecekan[]">
                    </div>
                </td>
                <td rowspan="1" class="nama_parameter kolom1" id="koloma` + rowCount + `" name="kolomb` + rowCount + `0">
                    <div class="form-group">
                        <input type="text" class="form-control" id="nama_parameter" name="nama_parameter[][]">
                    </div>
                </td>
                <td class="nilai_parameter" id="kolomb` + rowCount + `0">
                    <div class="form-group">
                        <input type="text" class="form-control" id="nilai_parameter" name="nilai_parameter[][][]">
                    </div>
                </td>
                <td>
                    <div class="form-group">
                        <a type="button" id="tambahnilaiparameter"><i class="fas fa-plus" style="color:green;"></i></button>
                    </div>
                </td>
                <td rowspan="1" class="aksinamaparameter">
                    <div class="form-group">
                        <a type="button" id="tambahnamaparameter"><i class="fas fa-plus" style="color:green;"></i></button>
                    </div>
                </td>
                <td rowspan="1" class="aksinamapengecekan"><button type="button" class="btn btn-danger btn-sm m-1" style="border-radius:50%;" id="hapusnamapengecekan"><i class="fas fa-times-circle"></i></button></td>
            </tr>`);
            numberRowsPengecekan($("#tableitem"));
        });

        $('#tableitem').on('click', '#hapusnamapengecekan', function() {
            var id = $(this).closest('tr').attr('id');
            $('tr[id="' + id + '"]').remove();
            numberRowsPengecekan($("#tableitem"));
        });

        $('#tableitem').on('click', '.kolom #tambahnamaparameter', function() {
            var id = $(this).closest('tr').attr('id');
            var x = $(this).closest('tr[id="' + id + '"]').find('.nomor').attr('rowspan');
            var nama_parameter = $(this).closest('tr[id="' + id + '"]').find('.nama_parameter').attr('name');
            var currRow = String(parseInt($("#tableitem").find('tr[id="' + id + '"]').length));

            $(this).closest('tr[id="' + id + '"]').find('.nomor').attr('rowspan', (parseInt(x) + 1));
            $(this).closest('tr[id="' + id + '"]').find('.nama_pengecekan').attr('rowspan', (parseInt(x) + 1));
            $(this).closest('tr[id="' + id + '"]').find('.aksinamapengecekan').attr('rowspan', (parseInt(x) + 1));
            var nid = String(id.substring(6)) + currRow;
            $(this).closest('tr.kolom').after(`<tr class="kolom1" id="` + id + `" name="kolomb` + nid + `">
                <td rowspan="1" class="nama_parameter">
                    <div class="form-group">
                        <input type="text" class="form-control" id="nama_parameter" name="nama_parameter[][]">
                    </div>
                </td>
                <td class="nilai_parameter" id="kolomb` + nid + `">
                    <div class="form-group">
                        <input type="text" class="form-control" id="nilai_parameter" name="nilai_parameter[][][]">
                    </div>
                </td>
                <td>
                    <div class="form-group">
                        <a type="button" id="tambahnilaiparameter"><i class="fas fa-plus" style="color:green;"></i></button>
                    </div>
                </td>
                <td rowspan="1" class="aksinamaparameter">
                    <div class="form-group">
                        <a type="button" id="hapusnamaparameter"><i class="fas fa-times" style="color:red;"></i></button>
                    </div>
                </td>
            </tr>`);
            numberRowsPengecekan($("#tableitem"));

        });

        $('#tableitem').on('click', '#hapusnamaparameter', function() {
            var id = $(this).closest('tr').attr('id');
            var name = $(this).closest('tr').attr('name');
            var x = $('tr[id="' + id + '"]').find('.nomor').attr('rowspan');
            var y = $(this).closest('tr[id="' + id + '"]').find('.nama_parameter').attr('rowspan');

            $('tr[id="' + id + '"]').find('.nomor').attr('rowspan', (parseInt(x) - y));
            $('tr[id="' + id + '"]').find('.nama_pengecekan').attr('rowspan', (parseInt(x) - y));
            $('tr[id="' + id + '"]').find('.aksinamapengecekan').attr('rowspan', (parseInt(x) - y));
            $(this).closest('tr').remove();
            $('tr[id="' + name + '"]').remove();
            numberRowsPengecekan($("#tableitem"));
        });

        $('#tableitem').on('click', '.kolom1 #tambahnilaiparameter', function() {
            var name = $(this).closest('tr').attr('name');
            var id = $(this).closest('tr').attr('id');
            var x = $('tr[id="' + id + '"]').find('.nomor').attr('rowspan');
            var y = $(this).closest('tr[id="' + id + '"]').find('.nama_parameter').attr('rowspan');
            var nilai_parameter = $(this).closest('tr').find('input[id="nilai_parameter"]').attr('name');

            $('tr[id="' + id + '"]').find('.nomor').attr('rowspan', (parseInt(x) + 1));
            $('tr[id="' + id + '"]').find('.nama_pengecekan').attr('rowspan', (parseInt(x) + 1));
            $(this).closest('tr[id="' + id + '"]').find('.nama_parameter').attr('rowspan', (parseInt(y) + 1));
            $(this).closest('tr[id="' + id + '"]').find('.aksinamaparameter').attr('rowspan', (parseInt(y) + 1));
            $('tr[id="' + id + '"]').find('.aksinamapengecekan').attr('rowspan', (parseInt(x) + 1));
            $(this).closest('tr.kolom1').after(`<tr id="` + name + `">
                <td class="nilai_parameter">
                    <div class="form-group">
                        <input type="text" class="form-control" id="nilai_parameter" name="` + nilai_parameter + `">
                    </div>
                </td>
                <td>
                    <div class="form-group">
                        <a type="button" id="hapusnilaiparameter"><i class="fas fa-times" style="color:red;"></i></button>
                    </div>
                </td>
            </tr>`);
        });

        $('#tableitem').on('click', '#hapusnilaiparameter', function() {
            var id = $(this).closest('tr').attr('id');
            var ids = $('tr[name="' + id + '"]').attr('id');
            var x = $('tr[id="' + ids + '"]').find('.nomor').attr('rowspan');
            var y = $('tr[name="' + id + '"]').find('.nama_parameter').attr('rowspan');

            $('tr[id="' + ids + '"]').find('.nomor').attr('rowspan', (parseInt(x) - 1));
            $('tr[id="' + ids + '"]').find('.nama_pengecekan').attr('rowspan', (parseInt(x) - 1));
            $('tr[name="' + id + '"]').find('.nama_parameter').attr('rowspan', (parseInt(y) - 1));
            $('tr[name="' + id + '"]').find('.aksinamaparameter').attr('rowspan', (parseInt(y) - 1));
            $('tr[id="' + ids + '"]').find('.aksinamapengecekan').attr('rowspan', (parseInt(x) - 1));
            $(this).closest('tr').remove();
            $('tr[id="' + name + '"]').remove();
        });
    })
</script>
@endsection