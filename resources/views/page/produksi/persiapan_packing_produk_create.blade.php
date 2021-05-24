@extends('adminlte.page')

@section('title', 'Beta Version')

@section('content_header')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Persiapan Packing Produk</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Packing Produk</li>
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
            <div class="card">
                <div class="card-header bg-success">
                    <div class="card-title"><i class="fas fa-plus-circle"></i>&nbsp;Persiapan Packing</div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <form action="{{ route('persiapan_packing_produk.store', ['id' => $id]) }}" method="post">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        <h3>BPPB</h3>
                        <div class="form-group row">
                            <label for="no_bppb" class="col-sm-4 col-form-label" style="text-align:right;">BPPB</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="no_bppb" id="no_bppb" value="{{old('no_bppb', $s->no_bppb)}}" style="width: 30%;" readonly>
                                @if ($errors->has('no_bppb'))
                                <span class="invalid-feedback" role="alert">{{$errors->first('no_bppb')}}</span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="nama_produk" class="col-sm-4 col-form-label" style="text-align:right;">Produk</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="nama_produk" id="nama_produk" value="{{old('nama_produk', $s->DetailProduk->nama)}}" style="width: 50%;" readonly>
                                @if ($errors->has('nama_produk'))
                                <span class="invalid-feedback" role="alert">{{$errors->first('nama_produk')}}</span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="tipe_produk" class="col-sm-4 col-form-label" style="text-align:right;">Tipe</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="tipe_produk" id="tipe_produk" value="{{old('tipe_produk', $s->DetailProduk->Produk->KelompokProduk->nama)}}" style="width: 50%;" readonly>
                                @if ($errors->has('tipe_produk'))
                                <span class="invalid-feedback" role="alert">{{$errors->first('tipe_produk')}}</span>
                                @endif
                            </div>
                        </div>


                        <h3>Produk</h3>
                        <div class="form-group row">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Dokumen</th>
                                        <th>Ketersediaan</th>
                                        <th>Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1.</td>
                                        <td><input type="text" id="dokumen" name="dokumen[]" value="manual_book_id" hidden>
                                            Manual Book ID</td>
                                        <td><input class="form-control @error('ketersediaan.*') is-invalid @enderror" type="number" id="ketersediaan" min="0" name="ketersediaan[]" value="{{old('ketersediaan', $s->jumlah)}}">
                                            @if ($errors->has('ketersediaan.*'))
                                            <span class="invalid-feedback" role="alert">{{$errors->first('ketersediaan')}}</span>
                                            @endif
                                        </td>
                                        <td><textarea class="form-control" name="keterangan[]" id="keterangan">{{old('keterangan')}}</textarea></td>
                                    </tr>
                                    <tr>
                                        <td>2.</td>
                                        <td><input type="text" id="dokumen" name="dokumen[]" value="manual_book_eng" hidden>
                                            Manual Book ENG</td>
                                        <td><input class="form-control @error('ketersediaan.*') is-invalid @enderror" type="number" id="ketersediaan" min="0" name="ketersediaan[]" value="{{old('ketersediaan', $s->jumlah)}}">
                                            @if ($errors->has('ketersediaan.*'))
                                            <span class="invalid-feedback" role="alert">{{$errors->first('ketersediaan')}}</span>
                                            @endif
                                        </td>
                                        <td><textarea class="form-control" name="keterangan[]" id="keterangan">{{old('keterangan')}}</textarea></td>
                                    </tr>
                                    <tr>
                                        <td>3.</td>
                                        <td><input type="text" id="dokumen" name="dokumen[]" value="sop" hidden>
                                            SOP</td>
                                        <td><input class="form-control @error('ketersediaan.*') is-invalid @enderror" type="number" id="ketersediaan" min="0" name="ketersediaan[]" value="{{old('ketersediaan', $s->jumlah)}}">
                                            @if ($errors->has('ketersediaan.*'))
                                            <span class="invalid-feedback" role="alert">{{$errors->first('ketersediaan')}}</span>
                                            @endif
                                        </td>
                                        <td><textarea class="form-control" name="keterangan[]" id="keterangan">{{old('keterangan')}}</textarea></td>
                                    </tr>
                                    <tr>
                                        <td>4.</td>
                                        <td><input type="text" id="dokumen" name="dokumen[]" value="packing_list" hidden>
                                            Packing List</td>
                                        <td><input class="form-control @error('ketersediaan.*') is-invalid @enderror" type="number" id="ketersediaan" min="0" name="ketersediaan[]" value="{{old('ketersediaan', $s->jumlah)}}">
                                            @if ($errors->has('ketersediaan.*'))
                                            <span class="invalid-feedback" role="alert">{{$errors->first('ketersediaan')}}</span>
                                            @endif
                                        </td>
                                        <td><textarea class="form-control" name="keterangan[]" id="keterangan">{{old('keterangan')}}</textarea></td>
                                    </tr>
                                    <tr>
                                        <td>5.</td>
                                        <td><input type="text" id="dokumen" name="dokumen[]" value="sticker" hidden>
                                            Sticker</td>
                                        <td><input class="form-control @error('ketersediaan.*') is-invalid @enderror" type="number" id="ketersediaan" min="0" name="ketersediaan[]" value="{{old('ketersediaan', $s->jumlah)}}">
                                            @if ($errors->has('ketersediaan.*'))
                                            <span class="invalid-feedback" role="alert">{{$errors->first('ketersediaan')}}</span>
                                            @endif
                                        </td>
                                        <td><textarea class="form-control" name="keterangan[]" id="keterangan">{{old('keterangan')}}</textarea></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>


                </div>
                <div class="card-footer">
                    <span>
                        <button type="button" class="btn btn-block btn-danger btn-rounded" style="width:200px;float:left;"><i class="fas fa-times"></i>&nbsp;Batal</button>
                    </span>
                    <span>
                        <button type="submit" class="btn btn-block btn-warning btn-rounded" style="width:200px;float:right;"><i class="fas fa-plus-circle"></i>&nbsp;Tambah Data</button>
                    </span>
                </div>
                </form>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <!-- /.card -->
        </div>


        <!-- /.col -->
    </div>
    <!-- /.row -->
</section>
@endsection