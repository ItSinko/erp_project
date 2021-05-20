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
                                                <label for="no_pemeriksaan" class="col-sm-4 col-form-label" style="text-align:right;">Nama</label>
                                                <div class="col-sm-8">
                                                    <select type="text" class="form-control @error('karyawan_id') is-invalid @enderror select2" name="karyawan_id" style="width:45%;">
                                                        <option value=""></option>
                                                        @foreach($karyawan as $k)
                                                        <option value="{{$k->id}}">{{$k->nama}}</option>
                                                        @endforeach
                                                    </select>
                                                    @if($errors->has('karyawan_id'))
                                                    <div class="text-danger">
                                                        {{ $errors->first('karyawan_id')}}
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="no_pemeriksaan" class="col-sm-4 col-form-label" style="text-align:right;">Pemeriksa</label>
                                                <div class="col-sm-8">
                                                    <select type="text" class="form-control @error('karyawan_id') is-invalid @enderror select2" name="karyawan_id" style="width:45%;">
                                                        <option value=""></option>
                                                        @foreach($karyawan as $k)
                                                        <option value="{{$k->id}}">{{$k->nama}}</option>
                                                        @endforeach
                                                    </select>
                                                    @if($errors->has('karyawan_id'))
                                                    <div class="text-danger">
                                                        {{ $errors->first('karyawan_id')}}
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="tanggal" class="col-sm-4 col-form-label" style="text-align:right;">Analisa </label>
                                                <div class="col-sm-8">
                                                    <textarea type="text" class="form-control @error('ket_vaksin') is-invalid @enderror" name="ket_vaksin" id="keterangan" value="{{old('ket_vaksin')}}" placeholder="Analisa pemeriksaan" style="width:45%;"></textarea>
                                                </div>
                                                <span role="alert" id="no_seri-msg"></span>
                                            </div>
                                            <div class="form-group row">
                                                <label for="tanggal" class="col-sm-4 col-form-label" style="text-align:right;">Diagnosa</label>
                                                <div class="col-sm-8">
                                                    <textarea type="text" class="form-control @error('ket_vaksin') is-invalid @enderror" name="ket_vaksin" id="keterangan" value="{{old('ket_vaksin')}}" placeholder="Diagnosa pemeriksaan" style="width:45%;"></textarea>
                                                </div>
                                                <span role="alert" id="no_seri-msg"></span>
                                            </div>
                                            <div class="form-group row">
                                                <label for="kondisi" class="col-sm-4 col-form-label" style="text-align:right;">Tindak lanjut</label>
                                                <div class="col-sm-8" style="margin-top:7px;">
                                                    <div class="icheck-success d-inline col-sm-4">
                                                        <input type="radio" name="hasil_1" value="terapi">
                                                        <label for="no">
                                                            Terapi
                                                        </label>
                                                    </div>
                                                    <div class="icheck-warning d-inline col-sm-4">
                                                        <input type="radio" name="hasil_1" value="pengobatan">
                                                        <label for="sample">
                                                            Pengobatan
                                                        </label>
                                                    </div>
                                                    <span class="invalid-feedback" role="alert" id="kondisi-msg"></span>
                                                </div>
                                            </div>
                                            <div id="tipe_1" style="display:none">
                                                <div class="form-group row">
                                                    <label for="tanggal" class="col-sm-4 col-form-label" style="text-align:right;">Terapi</label>
                                                    <div class="col-sm-8">
                                                        <textarea type="text" class="form-control @error('ket_vaksin') is-invalid @enderror" id="terapi" value="{{old('ket_vaksin')}}" placeholder="Terapi yang digunakan" style="width:45%;"></textarea>
                                                    </div>
                                                    <span role="alert" id="no_seri-msg"></span>
                                                </div>
                                            </div>
                                            <div id="tipe_2" style="display:none">
                                                <div class="form-group row">
                                                    <label for="no_pemeriksaan" class="col-sm-4 col-form-label" style="text-align:right;">Obat</label>
                                                    <div class="col-sm-8">
                                                        <select type="text" class="form-control @error('karyawan_id') is-invalid @enderror select2" style="width:45%;" id="obat">
                                                            <option value=""></option>
                                                            @foreach($karyawan as $k)
                                                            <option value="{{$k->id}}">{{$k->nama}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="kondisi" class="col-sm-4 col-form-label" style="text-align:right;">Aturan konsumsi</label>
                                                    <div class="col-sm-8" style="margin-top:7px;">
                                                        <div class="icheck-success d-inline col-sm-4">
                                                            <input type="radio" name="aturan_obat" value="Antibody">
                                                            <label for="no">
                                                                Sebelum Makan
                                                            </label>
                                                        </div>
                                                        <div class="icheck-warning d-inline col-sm-4">
                                                            <input type="radio" name="aturan_obat" value="Antigen">
                                                            <label for="sample">
                                                                Sesudah Makan
                                                            </label>
                                                        </div>
                                                        <span class="invalid-feedback" role="alert" id="kondisi-msg"></span>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="kondisi" class="col-sm-4 col-form-label" style="text-align:right;">Jumlah konsumsi</label>
                                                    <div class="col-sm-8" style="margin-top:7px;">
                                                        <div class="icheck-success d-inline col-sm-4">
                                                            <input type="radio" name="dosis_obat" value="Antibody">
                                                            <label for="no">
                                                                1x1 Hari
                                                            </label>
                                                        </div>
                                                        <div class="icheck-warning d-inline col-sm-4">
                                                            <input type="radio" name="dosis_obat" value="Antigen">
                                                            <label for="sample">
                                                                2x1 Hari
                                                            </label>
                                                        </div>
                                                        <div class="icheck-warning d-inline col-sm-2">
                                                            <input type="radio" name="dosis_obat" value="Antigen">
                                                            <label for="sample">
                                                                <div class="input-group mb-3">
                                                                    <input type="text" class="form-control" name="dosis_obat" id="dosis_obat_custom" placeholder="Jumlah obat x hari">
                                                                    <div class="input-group-append">
                                                                        <span class="input-group-text">Hari</span>
                                                                    </div>
                                                                </div>
                                                            </label>
                                                        </div>
                                                        <span class="invalid-feedback" role="alert" id="kondisi-msg"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="kondisi" class="col-sm-4 col-form-label" style="text-align:right;">Tindak lanjut</label>
                                                <div class="col-sm-8" style="margin-top:7px;">
                                                    <div class="icheck-success d-inline col-sm-4">
                                                        <input type="radio" name="hasil_2" value="Antibody">
                                                        <label for="no">
                                                            Lanjut bekerja
                                                        </label>
                                                    </div>
                                                    <div class="icheck-warning d-inline col-sm-4">
                                                        <input type="radio" name="hasil_2" value="Antigen">
                                                        <label for="sample">
                                                            Dipulangkan
                                                        </label>
                                                    </div>
                                                    <span class="invalid-feedback" role="alert" id="kondisi-msg"></span>
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
<script>
    $(document).ready(function() {
        $('input[name=hasil_1]').prop("required", true);
        $('input[name=hasil_2]').prop("required", true);
        $('input[type=radio][name=hasil_1]').on('change', function() {
            if (this.value == 'terapi') {
                $('#obat').val(null).trigger('change');
                $("#tipe_1").removeAttr("style");
                $("#tipe_2").css('display', 'none');
                $('#dosis_obat_custom').val('');
                $('input[name=aturan_obat]').prop("required", false);
                $('input[name=dosis_obat]').prop("required", false);
                $('input[name=aturan_obat]').prop("checked", false);
                $('input[name=dosis_obat]').prop("checked", false);
                $('textarea[id=terapi]').prop("required", true);
            } else {
                $('input[name=aturan_obat]').prop("required", true);
                $('input[name=dosis_obat]').prop("required", true);
                $('#obat').val(null).trigger('change');
                $("#tipe_1").css('display', 'none')
                $("#tipe_2").removeAttr("style");
                $('textarea[id=terapi]').prop("required", false);
            }
        });
    });
</script>
@stop