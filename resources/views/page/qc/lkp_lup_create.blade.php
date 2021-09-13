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
                    <li class="breadcrumb-item"><a href="/lkp_lup">LKP dan LUP</a></li>
                    <li class="breadcrumb-item active">Tambah LKP dan LUP</li>
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
                    <h3>Info</h3>
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
            <form action="" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                {{ method_field('PUT') }}
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header bg-success">
                                <div class="card-title">Format LKP dan LUP</div>
                            </div>
                            <div class="card-body">
                                <div class="form-horizontal">
                                    <div class="form-group row">
                                        <label for="produk_id" class="col-sm-4 col-form-label" style="text-align:right;">Produk</label>
                                        <div class="col-sm-8">
                                            <select class="form-control select2 select2-info @error('produk_id') is-invalid @enderror" data-dropdown-css-class="select2-info" style="width: 30%;" data-placeholder="Pilih Kelompok Barang" name="kelompok_produk_id" id="kelompok_produk_id">
                                                <option value=""></option>
                                                @foreach($p as $i)
                                                <option value="{{$i->id}}">{{$i->nama}}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('produk_id'))
                                            <span class="invalid-feedback" role="alert">{{$errors->first('produk_id')}}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <table id="format_lkp_lup" class="table table-bordered">
                                            <tbody>
                                                <tr class="tbformat">
                                                    <td>
                                                        <div class="form-horizontal">
                                                            <div class="form-group row">
                                                                <label for="nama_pengecekan" class="col-sm-5 col-form-label" style="text-align:left;">Pengecekan</label>
                                                                <div class="col-sm-7">
                                                                    <input type="text" class="form-control" name="nama_pengecekan[]" id="nama_pengecekan" value="">
                                                                </div>
                                                                @if ($errors->has('nama_pengecekan'))
                                                                <span class="invalid-feedback" role="alert">{{$errors->first('nama_pengecekan')}}</span>
                                                                @endif
                                                            </div>
                                                            <div class="form-group row">
                                                                <table class="table table-bordered acuan_lkp_lup">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>No</th>
                                                                            <th>Parameter</th>
                                                                            <th>Aksi</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <tr class="tbacuan">
                                                                            <td>1</td>
                                                                            <td>
                                                                                <div class="form-horizontal">
                                                                                    <div class="form-group row">
                                                                                        <div class="col-sm-12">
                                                                                            <input type="text" class="form-control" name="nama_parameter[][]" id="nama_parameter" value="">
                                                                                        </div>
                                                                                        @if ($errors->has('nama_parameter'))
                                                                                        <span class="invalid-feedback" role="alert">{{$errors->first('nama_parameter')}}</span>
                                                                                        @endif
                                                                                    </div>
                                                                                    <div class="form-group row">
                                                                                        <table class="table table-bordered parameter_lkp_lup">
                                                                                            <thead>
                                                                                                <tr>
                                                                                                    <th>No</th>
                                                                                                    <th>Nilai Parameter</th>
                                                                                                    <th>Aksi</th>
                                                                                                </tr>
                                                                                            </thead>
                                                                                            <tbody>
                                                                                                <tr class="tbparameter">
                                                                                                    <td>1</td>
                                                                                                    <td>
                                                                                                        <div class="form-horizontal">
                                                                                                            <div class="form-group row">
                                                                                                                <div class="col-sm-12">
                                                                                                                    <input type="text" class="form-control" name="nilai_parameter[][][]" id="nilai_parameter" value="">
                                                                                                                </div>
                                                                                                                @if ($errors->has('nilai_parameter'))
                                                                                                                <span class="invalid-feedback" role="alert">{{$errors->first('nilai_parameter')}}</span>
                                                                                                                @endif
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </td>
                                                                                                    <td>
                                                                                                        <div class="form-group">
                                                                                                            <a type="button" class="tambah_parameter_lkp_lup"><i class="fas fa-plus" style="color:green;"></i></button>
                                                                                                        </div>
                                                                                                    </td>
                                                                                                </tr>
                                                                                            </tbody>
                                                                                        </table>
                                                                                    </div>
                                                                                </div>
                                                                            </td>
                                                                            <td>
                                                                                <div class="form-group">
                                                                                    <a type="button" class="tambah_acuan_lkp_lup"><i class="fas fa-plus" style="color:green;"></i></button>
                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-group">
                                                            <a type="button" class="tambah_format_lkp_lup"><i class="fas fa-plus" style="color:green;"></i></button>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <span>
                                    <button type="button" class="btn btn-block btn-danger rounded-pill" style="width:200px;float:left;"><i class="fas fa-times"></i>&nbsp;Batal</button>
                                </span>
                                <span>
                                    <button type="submit" class="btn btn-block btn-success rounded-pill" style="width:200px;float:right;"><i class="fas fa-plus"></i>&nbsp;Tambah Data</button>
                                </span>
                            </div>
                        </div>
                        <!-- /.card -->

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header bg-success">
                                        <h3 class="card-title" style="color:white;"><i class="fa fa-plus-circle" aria-hidden="true"></i>&nbsp;LKP LUP</h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="col-md-12">
                                            <form action="" method="post" enctype="multipart/form-data">
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
                                                                <tr class="kolom" id="kolom0">
                                                                    <td rowspan="1" class="nomor">1</td>
                                                                    <td rowspan="1" class="nama_pengecekan">
                                                                        <div class="form-group">
                                                                            <input type="text" class="form-control nama_pengecekan" id="nama_pengecekan" name="nama_pengecekan[]">
                                                                        </div>
                                                                    </td>
                                                                    <td rowspan="1" class="nama_parameter">
                                                                        <div class="form-group">
                                                                            <input type="text" class="form-control nama_parameter" id="nama_parameter" name="nama_parameter[][]">
                                                                        </div>
                                                                    </td>
                                                                    <td class="nilai_parameter">
                                                                        <div class="form-group">
                                                                            <input type="text" class="form-control nilai_parameter" id="nilai_parameter" name="nilai_parameter[][][]">
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
    </div>
    </form>
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
        $('#format_lkp_lup').on('click', '.tambah_format_lkp_lup', function() {
            $('#format_lkp_lup tr.tbformat:last').after(`
                                        <tr class="tbformat">
                                            <td>
                                                <div class="form-horizontal">
                                                    <div class="form-group row">
                                                        <label for="nama_pengecekan" class="col-sm-5 col-form-label" style="text-align:left;">Pengecekan</label>
                                                        <div class="col-sm-7">
                                                            <input type="text" class="form-control" name="nama_pengecekan[]" id="nama_pengecekan" value="">
                                                        </div>
                                                        @if ($errors->has('nama_pengecekan'))
                                                        <span class="invalid-feedback" role="alert">{{$errors->first('nama_pengecekan')}}</span>
                                                        @endif
                                                    </div>
                                                    <div class="form-group row">
                                                        <table class="table table-bordered acuan_lkp_lup">
                                                            <thead>
                                                                <tr>
                                                                    <th>No</th>
                                                                    <th>Parameter</th>
                                                                    <th>Aksi</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr class="tbacuan">
                                                                    <td>1</td>
                                                                    <td>
                                                                        <div class="form-horizontal">
                                                                            <div class="form-group row">
                                                                                <div class="col-sm-12">
                                                                                    <input type="text" class="form-control" name="nama_parameter[][]" id="nama_parameter" value="">
                                                                                </div>
                                                                                @if ($errors->has('nama_parameter'))
                                                                                <span class="invalid-feedback" role="alert">{{$errors->first('nama_parameter')}}</span>
                                                                                @endif
                                                                            </div>
                                                                            <div class="form-group row">
                                                                                <table class="table table-bordered parameter_lkp_lup">
                                                                                    <thead>
                                                                                        <tr>
                                                                                            <th>No</th>
                                                                                            <th>Nilai Parameter</th>
                                                                                            <th>Aksi</th>
                                                                                        </tr>
                                                                                    </thead>
                                                                                    <tbody>
                                                                                        <tr class="tbparameter">
                                                                                            <td>1</td>
                                                                                            <td>
                                                                                                <div class="form-horizontal">
                                                                                                    <div class="form-group row">
                                                                                                        <div class="col-sm-12">
                                                                                                            <input type="text" class="form-control" name="nilai_parameter[][][]" id="nilai_parameter" value="">
                                                                                                        </div>
                                                                                                        @if ($errors->has('nilai_parameter'))
                                                                                                        <span class="invalid-feedback" role="alert">{{$errors->first('nilai_parameter')}}</span>
                                                                                                        @endif
                                                                                                    </div>
                                                                                                </div>
                                                                                            </td>
                                                                                            <td>
                                                                                                <div class="form-group">
                                                                                                    <a type="button" class="tambah_parameter_lkp_lup"><i class="fas fa-plus" style="color:green;"></i></button>
                                                                                                </div>
                                                                                            </td>
                                                                                        </tr>
                                                                                    </tbody>
                                                                                </table>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="form-group">
                                                                            <a type="button" class="tambah_acuan_lkp_lup"><i class="fas fa-plus" style="color:green;"></i></button>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group">
                                                    <a type="button" class="hapus_format_lkp_lup"><i class="fas fa-times" style="color:red;"></i></button>
                                                </div>
                                            </td>
                                        </tr>`);
        });

        $('.acuan_lkp_lup').on('click', '.tambah_acuan_lkp_lup', function() {
            alert("tes");
            $(this).closest('tr').after(`
            <tr class="tbacuan">
                <td>1</td>
                <td>
                    <div class="form-horizontal">
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <input type="text" class="form-control" name="nama_parameter[][]" id="nama_parameter" value="">
                            </div>
                            @if ($errors->has('nama_parameter'))
                            <span class="invalid-feedback" role="alert">{{$errors->first('nama_parameter')}}</span>
                            @endif
                        </div>
                        <div class="form-group row">
                            <table class="table table-bordered parameter_lkp_lup">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nilai Parameter</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="tbparameter">
                                        <td>1</td>
                                        <td>
                                            <div class="form-horizontal">
                                                <div class="form-group row">
                                                    <div class="col-sm-12">
                                                        <input type="text" class="form-control" name="nilai_parameter[][][]" id="nilai_parameter" value="">
                                                    </div>
                                                    @if ($errors->has('nilai_parameter'))
                                                    <span class="invalid-feedback" role="alert">{{$errors->first('nilai_parameter')}}</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group">
                                                <a type="button" class="tambah_parameter_lkp_lup"><i class="fas fa-plus" style="color:green;"></i></button>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </td>
                <td>
                    <div class="form-group">
                        <a type="button" class="hapus_acuan_lkp_lup"><i class="fas fa-times" style="color:red;"></i></button>
                    </div>
                </td>
            </tr>`);
        });

        $('#tableitem').on('click', '#tambahnamapengecekan', function() {
            rowCount++;
            $('#tableitem tr:last').after(`<tr class="kolom" id="kolom` + rowCount + `">
                <td rowspan="1" class="nomor"></td>
                <td rowspan="1" class="nama_pengecekan">
                    <div class="form-group">
                        <input type="text" class="form-control nama_pengecekan" id="nama_pengecekan" name="nama_pengecekan[]">
                    </div>
                </td>
                <td rowspan="1" class="nama_parameter">
                    <div class="form-group">
                        <input type="text" class="form-control nama_parameter" id="nama_parameter" name="nama_parameter[][]">
                    </div>
                </td>
                <td class="nilai_parameter">
                    <div class="form-group">
                        <input type="text" class="form-control nilai_parameter" id="nilai_parameter" name="nilai_parameter[][][]">
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
            // numberRows($("#tableitem"));
        });

        $('#tableitem').on('click', '#hapusnamapengecekan', function() {
            var id = $(this).closest('tr').attr('id');
            $('tr[id="' + id + '"]').remove();
            // numberRows($("#tableitem"));
        });

    })
</script>
@endsection