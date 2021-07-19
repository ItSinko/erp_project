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
                    <li class="breadcrumb-item"><a href=""></a>Kalibrasi</li>
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
                        <h3 class="card-title" style="color:white;"><i class="fa fa-plus-circle" aria-hidden="true"></i>&nbsp;Daftar Kalibrasi</h3>
                    </div>
                    <div class="card-body">

                        <div class="col-md-12">
                            <form action="{{ route('kalibrasi_internal.store', ['bppb_id' => $s->id]) }}" method="post" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                {{ method_field('PUT') }}
                                <h3>Info BPPB</h3>
                                <div class="form-horizontal">
                                    <div class="form-group row">
                                        <label for="no_bppb" class="col-sm-4 col-form-label" style="text-align:right;">No BPPB</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" name="no_bppb" id="no_bppb" value="{{$s->no_bppb}}" style="width: 50%;" readonly>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="nama_produk" class="col-sm-4 col-form-label" style="text-align:right;">Nama Produk</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" name="nama_produk" id="nama_produk" value="{{old('nama_produk', $s->DetailProduk->nama)}}" style="width: 50%;" readonly>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="tanggal" class="col-sm-4 col-form-label" style="text-align:right;">Tanggal Pendaftaran</label>
                                        <div class="col-sm-8">
                                            <input type="date" class="form-control" name="tanggal" id="tanggal" value="" style="width: 50%;">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="jumlah" class="col-sm-4 col-form-label" style="text-align:right;">Diajukan Oleh</label>
                                        <div class="col-sm-8">
                                            <div class="select2-info">
                                                <select class="select2 custom-select form-control pic_id  @error('pic_id') is-invalid @enderror " name="pic_id" id="pic_id" data-placeholder="Pilih Karyawan" data-dropdown-css-class="select2-info" style="width: 80%;" disabled>
                                                    <option value=""></option>
                                                    @foreach($k as $i)
                                                    <option value="{{$i->id}}">{{$i->nama}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <h3>Data No Seri</h3>
                                    <div class="form-horizontal">
                                        <div class="form-group row">
                                            <div class="table-responsive">
                                                <table id="tableitem" class="table table-hover table-bordered">
                                                    <thead style="text-align: center;">
                                                        <tr>
                                                            <th>No</th>
                                                            <th>Kode Perakitan</th>
                                                            <th>Aksi</th>
                                                            <th hidden>ID</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody style="text-align:center;">
                                                        @foreach($hp as $i)
                                                        <tr>
                                                            <td>{{$loop->iteration}}</td>
                                                            <td>
                                                                {{str_replace("/", "", $i->Perakitan->alias_tim)}}{{$i->no_seri}}
                                                            </td>
                                                            <td><button type="button" class="btn btn-danger btn-sm m-1 removeitem" style="border-radius:50%;" id="removeitem"><i class="fas fa-times-circle"></i></button></td>
                                                            <td hidden><input type="text" class="hasil_perakitan_id" name="hasil_perakitan_id[{{$loop->iteration - 1}}]" id="hasil_perakitan_id" value="{{$i->id}}" hidden></td>
                                                        </tr>
                                                        @endforeach
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
                            <a class="cancelmodal" data-toggle="modal" data-target="#cancelmodal"><button type="button" class="btn btn-block btn-danger rounded-pill" style="width:200px;float:left;"><i class="fas fa-times"></i>&nbsp;Batal</button></a>
                        </span>
                        <span>
                            <button type="submit" class="btn btn-block btn-success rounded-pill" style="width:200px;float:right;" id="tambahlaporan" disabled><i class="fas fa-plus"></i>&nbsp;Tambah Data</button>
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
        $('#tanggal').on('change', function() {
            var t = $(this).val();
            if (t != "") {
                $('#pic_id').removeAttr('disabled');
            } else {
                $('#pic_id').attr('disabled', true);
            }
        });

        $('#pic_id').on('change', function() {
            var p = $(this).val();
            if (p != "") {
                $('#tambahlaporan').removeAttr('disabled');
            } else {
                $('#tambahlaporan').attr('disabled', true);
            }
        });

        $('#tableitem').on('click', '#removeitem', function(e) {
            $(this).closest('tr').remove();
        });

    });
</script>
@stop