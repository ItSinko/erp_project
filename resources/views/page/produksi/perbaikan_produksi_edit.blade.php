@extends('adminlte.page')

@section('title', 'Beta Version')

@section('content_header')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Perbaikan</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Perbaikan</li>
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
                    <h3><i class="fas fa-info-circle"></i>&nbsp;Informasi</h3><br>
                    <div class="form-horizontal">
                        <div class="row">
                            <label for="no_seri" class="col-sm-6 col-form-label">No BPPB</label>
                            <div class="col-sm-6 col-form-label" style="text-align:right;">
                                {{$s->Bppb->no_bppb}}
                            </div>
                        </div>

                        <div class="row">
                            <label for="no_seri" class="col-sm-4 col-form-label">Produk</label>
                            <div class="col-sm-8 col-form-label" style="text-align:right;">
                                {{$s->Bppb->DetailProduk->nama}}
                            </div>
                        </div>

                        <div class="row">
                            <label for="no_seri" class="col-sm-7 col-form-label">Ketidaksesuaian Proses</label>
                            <div class="col-sm-5 col-form-label" style="text-align:right;">
                                {{ucfirst(str_replace('_', ' ', $s->ketidaksesuaian_proses))}}
                            </div>
                        </div>

                        <div class="row">
                            <label for="no_seri" class="col-sm-7 col-form-label">Tanggal Permintaan</label>
                            <div class="col-sm-5 col-form-label" style="text-align:right;">
                                {{$s->tanggal_permintaan}}
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
            <div class="card">
                <div class="card-header bg-warning">
                    <div class="card-title"><i class="fas fa-edit"></i>&nbsp;Perbaikan</div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <form action="{{route('perbaikan.produksi.update', ['id' => $id])}}" method="post">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        <h3>Produk</h3>
                        <div class="form-group row">
                            <label for="nomor" class="col-sm-4 col-form-label" style="text-align:right;">Nomor</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="nomor" id="nomor" value="{{old('nomor', $s->nomor)}}" style="width: 50%;">
                                @if ($errors->has('nomor'))
                                <span class="invalid-feedback" role="alert">{{$errors->first('nomor')}}</span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="hasil_perakitan_id" class="col-sm-4 col-form-label" style="text-align:right;">No Seri</label>
                            <div class="col-sm-5">
                                <div class="select2-info">
                                    <select class="select2 form-control @error('hasil_perakitan_id') is-invalid @enderror hasil_perakitan_id" multiple="multiple" data-placeholder="Pilih Operator" data-dropdown-css-class="select2-info" style="width: 100%;" name="hasil_perakitan_id[]" id="hasil_perakitan_id">

                                        @foreach($hp as $i)
                                        @if($s->ketidaksesuaian_proses == "perakitan")
                                        <option value="{{$i->id}}" @if($s->HasilPerakitan->contains('id', $i->id)) selected @endif>{{$i->no_seri}}</option>
                                        @elseif($s->ketidaksesuaian_proses == "pengujian" || $s->ketidaksesuaian_proses == "pengemasan")
                                        <option value="{{$i->HasilPerakitan->id}}" @if($s->HasilPerakitan->contains('id', $i->HasilPerakitan->id)) selected @endif>{{$i->HasilPerakitan->no_seri}}</option>
                                        @endif
                                        @endforeach


                                    </select>
                                    @if ($errors->has('hasil_perakitan_id'))
                                    <span class="invalid-feedback" role="alert">{{$errors->first('hasil_perakitan_id.*')}}</span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="kondisi_produk" class="col-sm-4 col-form-label" style="text-align:right;">Kondisi Produk</label>
                            <div class="col-sm-8">
                                <textarea class="form-control" name="kondisi_produk" id="kondisi_produk">{{old('kondisi_produk', $s->kondisi_produk)}}</textarea>
                                @if ($errors->has('kondisi_produk'))
                                <span class="invalid-feedback" role="alert">{{$errors->first('kondisi_produk')}}</span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="sebab_ketidaksesuaian" class="col-sm-4 col-form-label" style="text-align:right;">Sebab Ketidaksesuaian</label>
                            <div class="col-sm-2 col-form-label">
                                <div class="icheck-primary d-inline">
                                    <input type="radio" id="sebab_ketidaksesuaian_operator" name="sebab_ketidaksesuaian" value="operator" @if($s->sebab_ketidaksesuaian == "operator") checked @endif>
                                    <label for="sebab_ketidaksesuaian_operator">
                                        Operator
                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-2 col-form-label">
                                <div class="icheck-primary d-inline">
                                    <input type="radio" id="sebab_ketidaksesuaian_bahan_baku" name="sebab_ketidaksesuaian" value="bahan_baku" @if($s->sebab_ketidaksesuaian == "bahan_baku") checked @endif>
                                    <label for="sebab_ketidaksesuaian_bahan_baku">
                                        Bahan Baku
                                    </label>
                                </div>
                            </div>
                            @if ($errors->has('sebab_ketidaksesuaian'))
                            <span class="invalid-feedback" role="alert">{{$errors->first('sebab_ketidaksesuaian')}}</span>
                            @endif
                        </div>

                        <h3>Pengerjaan</h3>
                        <div class="form-group row">
                            <label for="tanggal_pengerjaan" class="col-sm-4 col-form-label" style="text-align:right;">Tanggal Pengerjaan</label>
                            <div class="col-sm-8">
                                <input type="date" class="form-control" name="tanggal_pengerjaan" id="tanggal_pengerjaan" value="{{old('tanggal_pengerjaan', $s->tanggal_pengerjaan)}}" style="width: 25%;">
                                @if ($errors->has('tanggal_pengerjaan'))
                                <span class="invalid-feedback" role="alert">{{$errors->first('tanggal_pengerjaan')}}</span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="karyawan_id" class="col-sm-4 col-form-label" style="text-align:right;">Operator Perbaikan</label>
                            <div class="col-sm-5">
                                <div class="select2-info">
                                    <select class="select2 form-control @error('karyawan_id') is-invalid @enderror karyawan_id" data-placeholder="Pilih Operator" data-dropdown-css-class="select2-info" style="width: 100%;" name="karyawan_id" id="karyawan_id">
                                        @foreach($k as $i)
                                        <option value="{{$i->id}}" @if($s->karyawan_id == $i->id)
                                            selected
                                            @endif
                                            >{{$i->nama}}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('karyawan_id'))
                                    <span class="invalid-feedback" role="alert">{{$errors->first('karyawan_id.*')}}</span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="analisa" class="col-sm-4 col-form-label" style="text-align:right;">Analisa</label>
                            <div class="col-sm-8">
                                <textarea class="form-control" name="analisa" id="analisa">{{old('analisa', $s->analisa)}}</textarea>
                                @if ($errors->has('analisa'))
                                <span class="invalid-feedback" role="alert">{{$errors->first('analisa')}}</span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="realisasi_pengerjaan" class="col-sm-4 col-form-label" style="text-align:right;">Realisasi Pengerjaan</label>
                            <div class="col-sm-8">
                                <textarea class="form-control" name="realisasi_pengerjaan" id="realisasi_pengerjaan">{{old('realisasi_pengerjaan', $s->realisasi_pengerjaan)}}</textarea>
                                @if ($errors->has('realisasi_pengerjaan'))
                                <span class="invalid-feedback" role="alert">{{$errors->first('realisasi_pengerjaan')}}</span>
                                @endif
                            </div>
                        </div>

                        <h3>Part</h3>
                        <div class="form-group row">
                            <label for="realisasi_pengerjaan" class="col-sm-4 col-form-label" style="text-align:right;">Keperluan Part</label>
                            <div class="col-sm-8">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" name="part[]" id="part">
                                    <label class="form-check-label" for="part">
                                        Default checkbox
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" name="part[]" id="part">
                                    <label class="form-check-label" for="part">
                                        Default checkbox
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" name="part[]" id="part">
                                    <label class="form-check-label" for="part">
                                        Default checkbox
                                    </label>
                                </div>

                            </div>
                        </div>


                </div>
                <div class="card-footer">
                    <span>
                        <button type="button" class="btn btn-block btn-danger btn-rounded" style="width:200px;float:left;"><i class="fas fa-times"></i>&nbsp;Batal</button>
                    </span>
                    <span>
                        <button type="submit" class="btn btn-block btn-warning btn-rounded" style="width:200px;float:right;"><i class="fas fa-edit"></i>&nbsp;Simpan Perubahan</button>
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