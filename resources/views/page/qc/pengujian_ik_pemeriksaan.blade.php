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
                    <li class="breadcrumb-item active">Pengemasan</li>
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
            <div class="col-md-12">
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
                        <h3 class="card-title" style="color:white;"><i class="fa fa-plus-circle" aria-hidden="true"></i>&nbsp;Tambahkan Monitoring Proses</h3>
                    </div>
                    <div class="card-body">

                        <div class="col-md-12">
                            <form action="" method="post" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <h3>Produk</h3>
                                <div class="form-horizontal">
                                    <div class="form-group row">
                                        <label for="detail_produk_id" class="col-sm-4 col-form-label" style="text-align:right;">Produk</label>
                                        <div class="col-sm-5">
                                            <div class="select2-info">
                                                <select class="select2 custom-select form-control @error('detail_produk_id') is-invalid @enderror detail_produk_id" data-placeholder="Pilih Operator" data-dropdown-css-class="select2-info" style="width: 100%;" name="detail_produk_id" id="detail_produk_id">
                                                    @foreach($dp as $i)
                                                    <option value="{{$i->id}}">{{$i->nama}}</option>
                                                    @endforeach
                                                </select>
                                                @if ($errors->has('detail_produk_id'))
                                                <span class="invalid-feedback" role="alert">{{$errors->first('detail_produk_id')}}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="kategori_produk" class="col-sm-4 col-form-label" style="text-align:right;">Kategori Produk</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" name="kategori_produk" id="kategori_produk" value="" style="width: 50%;" readonly>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="kelompok_produk" class="col-sm-4 col-form-label" style="text-align:right;">Kelompok Produk</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" name="kelompok_produk" id="kelompok_produk" value="" style="width: 50%;" readonly>
                                        </div>
                                    </div>

                                    <h3>Data</h3>
                                    <div class="form-horizontal">
                                        <div class="form-group row">
                                            <span><button type="button" class="btn btn-sm btn-primary rounded-pill" style="float:right;" id="tambahpemeriksaan"><i class="fas fa-plus"></i>&nbsp;Tambah Pemeriksaan</button></span>
                                        </div>
                                        <div id="formpemeriksaan">
                                            <div class="form-group row">
                                                <label for="hal_yang_diperiksa" class="col-sm-4 col-form-label" style="text-align:right;">Hal yang diperiksa</label>
                                                <div class="col-sm-4">
                                                    <textarea name="hal_yang_diperiksa[]" id="hal_yang_diperiksa" class="form-control"></textarea>
                                                </div>
                                                <div class="col-sm-2 col-form-label" style="text-align:left;">

                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <table id="tableitem" class="table table-hover tableitem">
                                                    <thead style="text-align:center;">
                                                        <tr>
                                                            <th>No</th>
                                                            <th>Pemeriksaan</th>
                                                            <th>Aksi</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody style="text-align: center;">
                                                        <tr>
                                                            <td>1</td>
                                                            <td><textarea name="standar_keberterimaan[][]" id="standar_keberterimaan" class="form-control standar_keberterimaan" style="width: 50%;"></textarea></td>
                                                            <td><button type="button" class="btn btn-success btn-sm m-1" style="border-radius:50%;" id="tambahitem"><i class="fas fa-plus-circle"></i></button></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
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
                    </form>
                </div>

            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
</section>
@endsection

@section('adminlte_js')
<script>
    $(function() {
        function numberRows($t) {
            var c = 0 - 1;
            $t.find("tr").each(function(ind, el) {
                $(el).find("td:eq(0)").html(++c);
                var j = c - 1;
                $(el).find('input[id="standar_keberterimaan"]').attr('name', 'standar_keberterimaan[][' + j + ']');
            });
        }

        $('#tambahitem').click(function(e) {
            $('#tableitem tr:last').after(`<tr>
                <td></td>
                <td><textarea name="standar_keberterimaan[][]" id="standar_keberterimaan" class="form-control standar_keberterimaan" style="width: 50%;"></textarea></td>
                <td><button type="button" class="btn btn-danger btn-sm m-1" style="border-radius:50%;" id="closetable"><i class="fas fa-times-circle"></i></button></td>
            </tr>`);
            numberRows($("#tableitem"));
        });

        $('#tambahpemeriksaan').on('click', function() {
            $('#formpemeriksaan').append(`<div class="form-group row">
                <label for="hal_yang_diperiksa" class="col-sm-4 col-form-label" style="text-align:right;">Hal yang diperiksa</label>
                    <div class="col-sm-8">
                        <textarea name="hal_yang_diperiksa[]" id="hal_yang_diperiksa" class="form-control" style="width: 50%;"></textarea>
                    </div>
                </div>

                <div class="form-group row">
                    <table id="tableitem" class="table table-hover tableitem">
                        <thead style="text-align:center;">
                            <tr>
                                <th>No</th>
                                <th>Pemeriksaan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody style="text-align: center;">
                            <tr>
                                <td>1</td>
                                <td><textarea name="standar_keberterimaan[][]" id="standar_keberterimaan" class="form-control standar_keberterimaan" style="width: 50%;"></textarea></td>
                                <td><button type="button" class="btn btn-success btn-sm m-1" style="border-radius:50%;" id="tambahitem"><i class="fas fa-plus-circle"></i></button></td>
                            </tr>
                        </tbody>
                    </table>
                </div>`);
        });

        $('#tableitem').on('click', '#closetable', function(e) {
            $(this).closest('tr').remove();
            numberRows($("#tableitem"));
        });
    })
</script>
@stop