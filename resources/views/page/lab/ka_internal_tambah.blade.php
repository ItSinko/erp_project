@extends('adminlte.page')
@section('title', 'Beta Version')
@section('content_header')
<h1 class="m-0 text-dark">Dashboard</h1>
@stop
@section('content')
<section class="content-header">
    <div class="container-fluid">
    </div>
</section>

<section class="content">
    <div class="row">
        <div class="col-lg-12">
            @if(session()->has('success'))
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                {{session()->get('success')}}
            </div>
            @elseif(session()->has('error') || count($errors) > 0)
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                Data gagal ditambahkan
            </div>
            @endif
            <div class="col-lg-12">
                <form action="/kesehatan/aksi_tambah" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="card">
                        <div class="card-header bg-success">
                            <div class="card-title"><i class="fas fa-plus-circle"></i>&nbsp;Tambah</div>
                        </div>
                        <div class="card-body">
                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-horizontal">
                                            <div class="form-group row">
                                                <label for="keterangan" class="col-sm-4 col-form-label" style="text-align:right;">No Pendaftaran</label>
                                                <div class="col-sm-2">
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-append">
                                                            <span class="input-group-text">LAB-</span>
                                                        </div>
                                                        <input type="number" class="form-control" ">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class=" form-group row">
                                                        <label for="no_pemeriksaan" class="col-sm-4 col-form-label" style="text-align:right;">No Seri</label>
                                                        <div class="col-sm-8">
                                                            <select type="text" class="form-control @error('karyawan_id') is-invalid @enderror select2" name="karyawan_id" style="width:45%;">
                                                                <option value=""></option>
                                                            </select>
                                                            @if($errors->has('karyawan_id'))
                                                            <div class="text-danger">
                                                                {{ $errors->first('karyawan_id')}}
                                                            </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="no_pemeriksaan" class="col-sm-4 col-form-label" style="text-align:right;">Type Produk</label>
                                                        <div class="col-sm-8">
                                                            <select type="text" class="form-control @error('karyawan_id') is-invalid @enderror select2" name="karyawan_id" style="width:45%;">
                                                                <option value=""></option>
                                                            </select>
                                                            @if($errors->has('karyawan_id'))
                                                            <div class="text-danger">
                                                                {{ $errors->first('karyawan_id')}}
                                                            </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <span class="float-left"><a class="btn btn-danger rounded-pill" href="/kesehatan"><i class="fas fa-times"></i>&nbsp;Batal</a></span>
                                    <span class="float-right"><button class="btn btn-success rounded-pill" id="button_tambah"><i class="fas fa-plus"></i>&nbsp;Tambah Data</button></span>
                                </div>
                            </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
@section('adminlte_js')
@stop