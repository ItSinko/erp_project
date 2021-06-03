@extends('adminlte.page')

@section('title', 'Beta Version')

@section('adminlte_css')
<style>
    .dt-body-left {
        text-align: left;
    }
</style>
@endsection

@section('content_header')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>BPPB</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">BPPB</li>
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
                    <h4>Info</h4><br>
                    <div class="form-horizontal">
                        <div class="row">
                            <label for="no_seri" class="col-sm-6 col-form-label">No BPPB</label>
                            <div class="col-sm-6 col-form-label" style="text-align:right;">
                                {{$s->no_bppb}}
                            </div>
                        </div>

                        <div class="row">
                            <label for="no_seri" class="col-sm-4 col-form-label">Produk</label>
                            <div class="col-sm-8 col-form-label" style="text-align:right;">
                                {{$s->DetailProduk->nama}}
                            </div>
                        </div>

                        <div class="row">
                            <label for="no_seri" class="col-sm-5 col-form-label">Kelompok Produk</label>
                            <div class="col-sm-7 col-form-label" style="text-align:right;">
                                {{$s->DetailProduk->Produk->KelompokProduk->nama}}
                            </div>
                        </div>

                        <div class="row">
                            <label for="tanggal" class="col-sm-6 col-form-label">Tanggal Laporan</label>
                            <div class="col-sm-6 col-form-label" style="text-align:right;">
                                {{date("d-m-Y", strtotime($s->tanggal_bppb))}}
                            </div>
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
            <form action="{{route('bppb.permintaan_bahan_baku.store', ['id' => $id])}}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                {{ method_field('PUT') }}
                <div class="card">
                    <div class="card-header bg-success">Permintaan Bahan Baku</div>
                    <div class="card-body">

                        <div class="form-horizontal">
                            <div class="form-group row">
                                <label for="divisi_id" class="col-sm-5 col-form-label" style="text-align:right;">Divisi</label>
                                <div class="col-sm-7">
                                    <select class="select2 select2-info form-control divisi_id" name="divisi_id" id="divisi_id">
                                        <option></option>
                                        <option value="11">Gudang Bahan Material</option>
                                        <option value="12">Gudang Karantina</option>
                                    </select>
                                    @if ($errors->has('divisi_id'))
                                    <span class="invalid-feedback" role="alert">{{$errors->first('divisi_id')}}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="tanggal" class="col-sm-5 col-form-label" style="text-align:right;">Tanggal</label>
                                <div class="col-sm-7">
                                    <input type="date" class="form-control  @error('tanggal') is-invalid @enderror" name="tanggal" id="tanggal" style="width: 50%;">
                                    @if ($errors->has('tanggal'))
                                    <span class="invalid-feedback" role="alert">{{$errors->first('tanggal')}}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="versi" class="col-sm-5 col-form-label" style="text-align:right;"></label>
                                <div class="col-sm-7">
                                    <select class="select2 select2-info form-control versi" name="versi" id="versi">
                                        <option></option>
                                        @foreach($s->DetailProduk->ProdukBillOfMaterial as $i)
                                        <option value="{{$i->id}}">{{$i->versi}}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('versi'))
                                    <span class="invalid-feedback" role="alert">{{$errors->first('versi')}}</span>
                                    @endif
                                </div>
                            </div>

                        </div>

                        <div class="col-md-12">
                            <div class="form-group row">
                                <table id="tableitem" class="table table-hover table-bordered styled-table">
                                    <thead style="text-align: center;">
                                        <tr>
                                            <th>No</th>
                                            <th>Part</th>
                                            <th>Jumlah Diminta</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody style="text-align: center;">

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <span>
                            <button type="button" class="btn btn-block btn-danger rounded-pill" style="width:200px;float:left;" @if($s->countHasilPengemasanByHasil('nok') <= 0 && $s->countHasilPengemasanByHasil('ok') <= 0) disabled @endif><i class="fas fa-times"></i>&nbsp;Batal</button>
                        </span>
                        <span>
                            <button type="submit" class="btn btn-block btn-success rounded-pill" style="width:200px;float:right;" @if($s->countHasilPengemasanByHasil('nok') <= 0 && $s->countHasilPengemasanByHasil('ok') <= 0) disabled @endif><i class="fas fa-plus"></i>&nbsp;Tambah Data</button>
                        </span>
                    </div>
                </div>
            </form>
            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</section>
@endsection

@section('adminlte_js')
<script>
    $(function() {
        $('select[name="versi"]').on('change', function() {

        });
    });
</script>
@stop