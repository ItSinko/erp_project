@extends('adminlte.page')

@section('title', 'Beta Version')

@section('content_header')
<h1 class="m-0 text-dark">Dashboard</h1>
@stop


@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">

            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">DataTables</li>
                </ol>
            </div>
        </div>
    </div>
</section>

<section class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="col-lg-12">
                <form action="form-pemeriksaan">
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
                                                    <input type="text" class="form-control @error('data') is-invalid @enderror" name="no_pemeriksaan" id="no_pemeriksaan" placeholder="Nama Karyawan" value="{{old('no_pemeriksaan')}}" style="width:45%;">
                                                </div>
                                                <span role="alert" id="no_pemeriksaan-msg"></span>
                                            </div>
                                            <div class="form-group row">
                                                <label for="tanggal" class="col-sm-4 col-form-label" style="text-align:right;">Tgl Lahir</label>
                                                <div class="col-sm-8">
                                                    <input type="date" class="form-control @error('data') is-invalid @enderror" name="tanggal" id="tanggal" value="{{old('tanggal')}}" placeholder="Masukkan tanggal" style="width:45%;">
                                                </div>
                                                <span role="alert" id="no_seri-msg"></span>
                                            </div>
                                            <div class="form-group row">
                                                <label for="tanggal" class="col-sm-4 col-form-label" style="text-align:right;">NIK</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control @error('data') is-invalid @enderror" name="tanggal" id="tanggal" value="{{old('tanggal')}}" placeholder="Nomor Induk Kependudukan" style="width:45%;">
                                                </div>
                                                <span role="alert" id="no_seri-msg"></span>
                                            </div>
                                            <div class="form-group row">
                                                <label for="tanggal" class="col-sm-4 col-form-label" style="text-align:right;">No BPJS</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control @error('data') is-invalid @enderror" name="tanggal" id="tanggal" value="{{old('tanggal')}}" placeholder="Nomor Kartu BPJS" style="width:45%;">
                                                </div>
                                                <span role="alert" id="no_seri-msg"></span>
                                            </div>
                                            <div class="form-group row">
                                                <label for="tanggal" class="col-sm-4 col-form-label" style="text-align:right;">Tgl Masuk Kerja</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control @error('data') is-invalid @enderror" name="tanggal" id="tanggal" value="{{old('tanggal')}}" style="width:45%;">
                                                </div>
                                                <span role="alert" id="no_seri-msg"></span>
                                            </div>
                                            <div class="form-group row">
                                                <label for="kondisi" class="col-sm-4 col-form-label" style="text-align:right;">Vaksin</label>
                                                <div class="col-sm-8" style="margin-top:7px;">
                                                    <div class="icheck-success d-inline col-sm-4">
                                                        <input type="radio" name="status_vaksin" value="0" checked="0">
                                                        <label for="no">
                                                            Belum
                                                        </label>
                                                    </div>
                                                    <div class="icheck-warning d-inline col-sm-4">
                                                        <input type="radio" name="status_vaksin" value="1">
                                                        <label for="sample">
                                                            Sudah
                                                        </label>
                                                    </div>
                                                    <span class="invalid-feedback" role="alert" id="kondisi-msg"></span>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="tanggal" class="col-sm-4 col-form-label" style="text-align:right;">Keterangan</label>
                                                <div class="col-sm-8">
                                                    <textarea type="text" class="form-control @error('data') is-invalid @enderror" name="keterangan" id="keterangan" value="{{old('tanggal')}}" placeholder="Keterangan Vaksin" style="width:45%;" disabled></textarea>
                                                </div>
                                                <span role="alert" id="no_seri-msg"></span>
                                            </div>
                                            <div class="form-group row">
                                                <label for="kondisi" class="col-sm-4 col-form-label" style="text-align:right;">Cek Kesehatan Awal</label>
                                                <div class="col-sm-8" style="margin-top:7px;">
                                                    <div class="icheck-success d-inline col-sm-4">
                                                        <input type="radio" name="status_kesehatan" value="0" checked="0">
                                                        <label for="no">
                                                            Belum
                                                        </label>
                                                    </div>
                                                    <div class="icheck-warning d-inline col-sm-4">
                                                        <input type="radio" name="status_kesehatan" value="1">
                                                        <label for="sample">
                                                            Sudah
                                                        </label>
                                                    </div>
                                                    <span class="invalid-feedback" role="alert" id="kondisi-msg"></span>
                                                </div>
                                            </div>
                                            <div id="cek_form">
                                                <div class="form-group row">
                                                    <label for="keterangan" class="col-sm-4 col-form-label" style="text-align:right;">Tinggi Badan</label>
                                                    <div class="col-sm-1">
                                                        <div class="input-group mb-3">
                                                            <input type="text" class="form-control" name="tinggi" value="{{ old('tinggi') }}">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">Cm</span>
                                                            </div>
                                                        </div>
                                                        @if($errors->has('ak1'))
                                                        <div class="text-danger">
                                                            {{ $errors->first('ak1')}}
                                                        </div>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="kondisi" class="col-sm-4 col-form-label" style="text-align:right;">Buta Warna</label>
                                                    <div class="col-sm-8" style="margin-top:7px;">
                                                        <div class="icheck-success d-inline col-sm-4">
                                                            <input type="radio" name="status_mata" value="0" checked="0">
                                                            <label for="no">
                                                                Defisiensi
                                                            </label>
                                                        </div>
                                                        <div class="icheck-warning d-inline col-sm-4">
                                                            <input type="radio" name="status_mata" value="1">
                                                            <label for="sample">
                                                                Abnormal
                                                            </label>
                                                        </div>
                                                        <div class="icheck-warning d-inline col-sm-4">
                                                            <input type="radio" name="status_mata" value="1">
                                                            <label for="sample">
                                                                Normal
                                                            </label>
                                                        </div>
                                                        <span class="invalid-feedback" role="alert" id="kondisi-msg"></span>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="tanggal" class="col-sm-4 col-form-label" style="text-align:right;">Hasil Medical Check Up</label>
                                                    <div class="col-sm-4">
                                                        <input type="file" class="form-control @error('data') is-invalid @enderror" name="tanggal" id="tanggal" value="{{old('tanggal')}}" placeholder="Nomor Induk Kependudukan" style="width:45%;">
                                                    </div>
                                                    <span role="alert" id="no_seri-msg"></span>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="kondisi" class="col-sm-4 col-form-label" style="text-align:right;">Pemeriksaan Covid</label>
                                                    <div class="col-sm-8" style="margin-top:7px;">
                                                        <div class="icheck-success d-inline col-sm-4">
                                                            <input type="radio" name="jenis_tes" value="1" checked="0">
                                                            <label for="no">
                                                                Antibody
                                                            </label>
                                                        </div>
                                                        <div class="icheck-warning d-inline col-sm-4">
                                                            <input type="radio" name="jenis_tes" value="2">
                                                            <label for="sample">
                                                                Antigen
                                                            </label>
                                                        </div>
                                                        <div class="icheck-warning d-inline col-sm-4">
                                                            <input type="radio" name="jenis_tes" value="2">
                                                            <label for="sample">
                                                                Ge Nose
                                                            </label>
                                                        </div>
                                                        <div class="icheck-warning d-inline col-sm-4">
                                                            <input type="radio" name="jenis_tes" value="2">
                                                            <label for="sample">
                                                                PCR
                                                            </label>
                                                        </div>
                                                        <div class="icheck-warning d-inline col-sm-4">
                                                            <input type="radio" name="jenis_tes" value="3">
                                                            <label for="sample">
                                                                Saliva
                                                            </label>
                                                        </div>
                                                        <span class="invalid-feedback" role="alert" id="kondisi-msg"></span>
                                                    </div>
                                                </div>
                                                <div id="tipe_1">
                                                    <div class="form-group row">
                                                        <label for="kondisi" class="col-sm-4 col-form-label" style="text-align:right;"></label>
                                                        <div class="col-sm-8" style="margin-top:7px;">
                                                            <div class="icheck-success d-inline col-sm-4">
                                                                <input type="radio" name="tes_covid" value="non-reaktif">
                                                                <label for="no">
                                                                    C
                                                                </label>
                                                            </div>
                                                            <div class="icheck-success d-inline col-sm-4">
                                                                <input type="radio" name="tes_covid" value="reaktif">
                                                                <label for="no">
                                                                    C/IG
                                                                </label>
                                                            </div>
                                                            <div class="icheck-warning d-inline col-sm-4">
                                                                <input type="radio" name="tes_covid" value="reaktif">
                                                                <label for="sample">
                                                                    C/IgM
                                                                </label>
                                                            </div>
                                                            <div class="icheck-warning d-inline col-sm-4">
                                                                <input type="radio" name="tes_covid" value="reaktif">
                                                                <label for="sample">
                                                                    C/IgG/IgM
                                                                </label>
                                                            </div>
                                                            <span class="invalid-feedback" role="alert" id="kondisi-msg"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div id="tipe_2">
                                                    <div class="form-group row">
                                                        <label for="kondisi" class="col-sm-4 col-form-label" style="text-align:right;"></label>
                                                        <div class="col-sm-8" style="margin-top:7px;">
                                                            <div class="icheck-success d-inline col-sm-4">
                                                                <input type="radio" name="tes_covid" value="negatif">
                                                                <label for="no">
                                                                    C
                                                                </label>
                                                            </div>
                                                            <div class="icheck-warning d-inline col-sm-4">
                                                                <input type="radio" name="tes_covid" value="positif">
                                                                <label for="sample">
                                                                    C/T
                                                                </label>
                                                            </div>
                                                            <span class="invalid-feedback" role="alert" id="kondisi-msg"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div id="tipe_3">
                                                    <div class="form-group row">
                                                        <label for="tanggal" class="col-sm-4 col-form-label" style="text-align:right;"></label>
                                                        <div class="col-sm-4">
                                                            <input type="file" class="form-control @error('data') is-invalid @enderror" name="tanggal" id="tanggal" value="{{old('tanggal')}}" placeholder="Nomor Induk Kependudukan" style="width:45%;">
                                                        </div>
                                                        <span role="alert" id="no_seri-msg"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <span class="float-left"><button class="btn btn-danger rounded-pill" id=""><i class="fas fa-times"></i>&nbsp;Batal</button></span>
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
        $('input[type=radio][name=status_vaksin]').on('change', function() {
            if (this.value == 0) {
                $('textarea[name=keterangan]').val('');
                $('textarea[name=keterangan]').prop("disabled", true);
            } else if (this.value == 1) {
                $('textarea[name=keterangan]').val('');
                $('textarea[name=keterangan]').prop("disabled", false);
            }
        });

        $('#cek_form').hide();
        $('#tipe_1').show();
        $('#tipe_2').hide();
        $('#tipe_3').hide();

        $('input[type=radio][name=status_kesehatan]').on('change', function() {
            if (this.value == 1) {
                // $('input[name=tinggi]').val('');
                $('#cek_form').hide().fadeIn(500);
            } else if (this.value == 0) {
                // $('input[name=tinggi]').val('');
                $('#cek_form').show().fadeOut(500);
            }
        });

        $('input[type=radio][name=jenis_tes]').on('change', function() {
            if (this.value == 1) {
                $('#tipe_1').show();
                $('#tipe_2').hide();
                $('#tipe_3').hide();
            } else if (this.value == 2) {
                $('#tipe_2').show();
                $('#tipe_1').hide();
                $('#tipe_3').hide();
            } else if (this.value == 3) {
                $('#tipe_3').show();
                $('#tipe_1').hide();
                $('#tipe_2').hide();
            } else {

            }
        });
    });
</script>
\\
@stop