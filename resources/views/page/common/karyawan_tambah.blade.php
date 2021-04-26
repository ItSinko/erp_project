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
                                                    <select type="text" class="form-control @error('data') is-invalid @enderror select2" name="no_pemeriksaan" id="no_pemeriksaan" placeholder="Nama Karyawan" value="{{old('no_pemeriksaan')}}" style="width:45%;">
                                                        <option value=""></option>
                                                        @foreach($karyawan as $k)
                                                        <option value=""></option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <span role="alert" id="no_pemeriksaan-msg"></span>
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
                                                <label for="keterangan" class="col-sm-4 col-form-label" style="text-align:right;">Tinggi Badan</label>
                                                <div class="col-sm-2">
                                                    <div class="input-group mb-3">
                                                        <input type="number" class="form-control" name="tinggi" id="tinggi" value="{{ old('tinggi') }}">
                                                        <div class="input-group-append">
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
                                                <label for="keterangan" class="col-sm-4 col-form-label" style="text-align:right;">Berat Badan</label>
                                                <div class="col-sm-2">
                                                    <div class="input-group mb-3">
                                                        <input type="number" class="form-control" name="berat" id="berat" value="{{ old('berat') }}">
                                                        <div class="input-group-append">
                                                            <span class="input-group-text">Kg</span>
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
                                                <label for="no_pemeriksaan" class="col-sm-4 col-form-label" style="text-align:right;">Body Mass Index</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control @error('data') is-invalid @enderror " id="bmi" style="width:15%;" disabled>
                                                    <small id="status_bmi" class="form-text text-muted"></small>
                                                </div>
                                                <span role="alert" id="no_pemeriksaan-msg"></span>
                                            </div>
                                            <div class="form-group row">
                                                <label for="kondisi" class="col-sm-4 col-form-label" style="text-align:right;">Buta Warna</label>
                                                <div class="col-sm-8" style="margin-top:7px;">
                                                    <div class="icheck-success d-inline col-sm-4">
                                                        <input type="radio" name="status_mata" value="Defisensi">
                                                        <label for="no">
                                                            Defisiensi
                                                        </label>
                                                    </div>
                                                    <div class="icheck-warning d-inline col-sm-4">
                                                        <input type="radio" name="status_mata" value="Abnormal">
                                                        <label for="sample">
                                                            Abnormal
                                                        </label>
                                                    </div>
                                                    <div class="icheck-warning d-inline col-sm-4">
                                                        <input type="radio" name="status_mata" value="Normal">
                                                        <label for="sample">
                                                            Normal
                                                        </label>
                                                    </div>
                                                    <span class="invalid-feedback" role="alert" id="kondisi-msg"></span>
                                                    <small id="status_butawarna" class="form-text text-muted"></small>
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


        $('input[type=radio][name=status_mata]').on('change', function() {
            if (this.value == 'Defisensi') {
                $('#status_butawarna').text('Dapat membaca < 7 angka');
            } else if (this.value == 'Abnormal') {
                $('#status_butawarna').text('Dapat membaca >=7 angka ');
            } else {
                $('#status_butawarna').text('Dapat membaca semua angka');
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

        $(function() {
            $('#berat, #tinggi').keyup(function() {
                var value1 = parseFloat($('#berat').val()) || 0;
                var value2 = parseFloat($('#tinggi').val()) || 0;
                var sum = value1 / ((value2 / 100) * (value2 / 100))
                $('#bmi').val(sum.toFixed(2));

                if (sum >= 30) {
                    $('#status_bmi').text('Kegemukan (Obesitas)');
                } else if (sum >= 25 || sum >= 29.9) {
                    $('#status_bmi').text('Kelebihan Berat Badan');
                } else if (sum >= 18.5 || sum >= 24.9) {
                    $('#status_bmi').text('Normal (Ideal)');
                } else {
                    $('#status_bmi').text('Kekurangan Berat Badan');
                }
            });
        });
    });
</script>
@stop