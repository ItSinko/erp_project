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
                                                <label for="kondisi" class="col-sm-4 col-form-label" style="text-align:right;">Vaksin</label>
                                                <div class="col-sm-8" style="margin-top:7px;">
                                                    <div class="icheck-success d-inline col-sm-4">
                                                        <input type="radio" name="status_vaksin" value="Belum" checked="0">
                                                        <label for="no">
                                                            Belum
                                                        </label>
                                                    </div>
                                                    <div class="icheck-warning d-inline col-sm-4">
                                                        <input type="radio" name="status_vaksin" value="Sudah">
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
                                                    <textarea type="text" class="form-control @error('ket_vaksin') is-invalid @enderror" name="ket_vaksin" id="keterangan" value="{{old('ket_vaksin')}}" placeholder="Keterangan Vaksin" style="width:45%;" disabled></textarea>
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
                                                    @if($errors->has('tinggi'))
                                                    <div class="text-danger">
                                                        {{ $errors->first('tinggi')}}
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="keterangan" class="col-sm-4 col-form-label" style="text-align:right;">Berat Badan</label>
                                                <div class="col-sm-2">
                                                    <div class="input-group mb-3">
                                                        <input type="text" class="form-control" name="berat" id="berat" value="{{ old('berat') }}">
                                                        <div class="input-group-append">
                                                            <span class="input-group-text">Kg</span>
                                                        </div>
                                                    </div>
                                                    @if($errors->has('berat'))
                                                    <div class="text-danger">
                                                        {{ $errors->first('berat')}}
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-4 col-form-label" style="text-align:right;">Body Mass Index</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control @error('data') is-invalid @enderror " id="bmi" style="width:15%;" disabled>
                                                    <small id="status_bmi" class="form-text text-muted"></small>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-4 col-form-label" style="text-align:right;">Rabun Mata</label>
                                                <div class="col-sm-8 ">
                                                    <div class="col-sm-4  d-inline">
                                                        <input type="text" class="form-control d-inline col-sm-4 " id="mata_kiri" style="width:15%;" placeholder="Mata Kiri" name="mata_kiri">
                                                        <small id="mata_kiri_status" class="form-text text-muted d-inline"></small>
                                                    </div>
                                                    <div class="col-sm-4  d-inline">
                                                        <input type="text" class="form-control d-inline col-sm-4" id="mata_kanan" style="width:15%;" placeholder="Mata Kanan" name="mata_kanan">
                                                        <small id="mata_kanan_status" class="form-text text-muted d-inline"></small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="kondisi" class="col-sm-4 col-form-label" style="text-align:right;">Komposisi tubuh</label>
                                                <div class="col-sm-8" style="margin-top:7px;">
                                                    <div class="icheck-success d-inline col-sm-4">
                                                        <input type="radio" name="status_komposisi_tubuh" value="0" checked="0">
                                                        <label for="no">
                                                            Tidak Ada
                                                        </label>
                                                    </div>
                                                    <div class="icheck-warning d-inline col-sm-4">
                                                        <input type="radio" name="status_komposisi_tubuh" value="1">
                                                        <label for="sample">
                                                            Ada
                                                        </label>
                                                    </div>
                                                    <span class="invalid-feedback" role="alert" id="kondisi-msg"></span>
                                                </div>
                                            </div>
                                            <div class="card" id="detail_komposisi" style="display:none">
                                                <div class="card-header bg-success">
                                                    <div class="card-title">&nbsp;Komposisi Tubuh</div>
                                                </div>
                                                <div class="card-body">
                                                    <div class="col-lg-12">
                                                        <div class="row">
                                                            <div class="col-lg-12">
                                                                <table id="tabel" class="table table-hover styled-table table-striped">
                                                                    <thead style="text-align: center;">
                                                                        <tr>
                                                                            <th>Fat</th>
                                                                            <th>Tbw</th>
                                                                            <th>Muscle</th>
                                                                            <th>Bone</th>
                                                                            <th>Kalori</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody style="text-align: center;">
                                                                        <tr>
                                                                            <td>
                                                                                <div class="input-group mb-3">
                                                                                    <input type="text" class="form-control" name="lemak" id="lemak" value="{{ old('lemak') }}">
                                                                                    <div class="input-group-append">
                                                                                        <span class="input-group-text">gram</span>
                                                                                    </div>
                                                                                </div>
                                                                            </td>
                                                                            <td>
                                                                                <div class="input-group mb-3">
                                                                                    <input type="text" class="form-control" name="kandungan_air" id="kandungan_air" value="{{ old('kandungan_air') }}">
                                                                                    <div class="input-group-append">
                                                                                        <span class="input-group-text">%</span>
                                                                                    </div>
                                                                                </div>
                                                                            </td>
                                                                            <td>
                                                                                <div class="input-group mb-3">
                                                                                    <input type="text" class="form-control" name="otot" id="otot" value="{{ old('otot') }}">
                                                                                    <div class="input-group-append">
                                                                                        <span class="input-group-text">Kg</span>
                                                                                    </div>
                                                                                </div>
                                                                            </td>
                                                                            <td>
                                                                                <div class="input-group mb-3">
                                                                                    <input type="text" class="form-control" name="tulang" id="tulang" value="{{ old('tulang') }}">
                                                                                    <div class="input-group-append">
                                                                                        <span class="input-group-text">Kg</span>
                                                                                    </div>
                                                                                </div>
                                                                            </td>
                                                                            <td>
                                                                                <div class="input-group mb-3">
                                                                                    <input type="text" class="form-control" name="kalori" id="kalori" value="{{ old('kalori') }}">
                                                                                    <div class="input-group-append">
                                                                                        <span class="input-group-text">kkal</span>
                                                                                    </div>
                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
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
                                                    @if($errors->has('status_mata'))
                                                    <div class="text-danger">
                                                        {{ $errors->first('status_mata')}}
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="tanggal" class="col-sm-4 col-form-label" style="text-align:right;">Hasil Medical Check Up</label>
                                                <div class="col-sm-4">
                                                    <input type="file" class="form-control @error('file_mcu') is-invalid @enderror" name="file_mcu" style="width:45%;">
                                                    @if($errors->has('file_mcu'))
                                                    <div class="text-danger">
                                                        {{ $errors->first('file_mcu')}}
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="kondisi" class="col-sm-4 col-form-label" style="text-align:right;">Pemeriksaan Covid</label>
                                                <div class="col-sm-8" style="margin-top:7px;">
                                                    <div class="icheck-success d-inline col-sm-4">
                                                        <input type="radio" name="tes_covid" value="Antibody">
                                                        <label for="no">
                                                            Antibody
                                                        </label>
                                                    </div>
                                                    <div class="icheck-warning d-inline col-sm-4">
                                                        <input type="radio" name="tes_covid" value="Antigen">
                                                        <label for="sample">
                                                            Antigen
                                                        </label>
                                                    </div>
                                                    <div class="icheck-warning d-inline col-sm-4">
                                                        <input type="radio" name="tes_covid" value="Saliva">
                                                        <label for="sample">
                                                            Saliva
                                                        </label>
                                                    </div>
                                                    <div class="icheck-warning d-inline col-sm-4">
                                                        <input type="radio" name="tes_covid" value="Genose / PCR">
                                                        <label for="sample">
                                                            Genose / PCR
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
                                                            <input type="radio" name="hasil_covid" value="C">
                                                            <label for="no">
                                                                C
                                                            </label>
                                                        </div>
                                                        <div class="icheck-success d-inline col-sm-4">
                                                            <input type="radio" name="hasil_covid" value="C/IG">
                                                            <label for="no">
                                                                C/IG
                                                            </label>
                                                        </div>
                                                        <div class="icheck-warning d-inline col-sm-4">
                                                            <input type="radio" name="hasil_covid" value="C/IgM">
                                                            <label for="sample">
                                                                C/IgM
                                                            </label>
                                                        </div>
                                                        <div class="icheck-warning d-inline col-sm-4">
                                                            <input type="radio" name="hasil_covid" value="C/IgG/IgM">
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
                                                            <input type="radio" name="hasil_covid" value="C">
                                                            <label for="no">
                                                                C
                                                            </label>
                                                        </div>
                                                        <div class="icheck-warning d-inline col-sm-4">
                                                            <input type="radio" name="hasil_covid" value="C/T">
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
                                                        <div class="icheck-success d-inline col-sm-4">
                                                            <input type="radio" name="hasil_covid" value="Positif">
                                                            <label for="no">
                                                                Positif
                                                            </label>
                                                        </div>
                                                        <div class="icheck-warning d-inline col-sm-4">
                                                            <input type="radio" name="hasil_covid" value="Negatif">
                                                            <label for="sample">
                                                                Negatif
                                                            </label>
                                                        </div>
                                                        <input type="file" class="form-control @error('file_covid') is-invalid @enderror" name="file_covid" value="{{old('file_covid')}}" style="width:45%;">
                                                        @if($errors->has('file_covid'))
                                                        <div class="text-danger">
                                                            {{ $errors->first('file_covid')}}
                                                        </div>
                                                        @endif
                                                    </div>
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
        $('input[type=radio][name=status_vaksin]').on('change', function() {
            if (this.value == 'Belum') {
                $('textarea[name=ket_vaksin]').val('');
                $('textarea[name=ket_vaksin]').prop("disabled", true);
                $('textarea[name=ket_vaksin]').prop("required", false);
            } else if (this.value == 'Sudah') {
                $('textarea[name=ket_vaksin]').val('');
                $('textarea[name=ket_vaksin]').prop("disabled", false);
                $('textarea[name=ket_vaksin]').prop("required", true);
            }
        });

        $('#cek_form').hide();
        $('#tipe_1').show();
        $('#tipe_2').hide();
        $('#tipe_3').hide();
        $('input[name=status_mata]').prop("required", true);


        $('input[type=radio][name=status_mata]').on('change', function() {
            if (this.value == 'Defisensi') {
                $('#status_butawarna').text('Dapat membaca 1 - 7 angka');
            } else if (this.value == 'Abnormal') {
                $('#status_butawarna').text('Dapat membaca 8 - 9 angka ');
            } else {
                $('#status_butawarna').text('Dapat membaca 10 - 14 angka');
            }
        });

        $('input[type=radio][name=tes_covid]').on('change', function() {
            if (this.value == 'Antibody') {
                $('#tipe_1').show();
                $('#tipe_2').hide();
                $('#tipe_3').hide();
                $('input[name=hasil_covid]').prop("required", true);
                $('input[name=hasil_covid]').prop("checked", false);
            } else if (this.value == 'Antigen') {
                $('#tipe_2').show();
                $('#tipe_1').hide();
                $('#tipe_3').hide();
                $('input[name=hasil_covid]').prop("required", true);
                $('input[name=hasil_covid]').prop("checked", false);
            } else if (this.value == 'Saliva') {
                $('#tipe_2').show();
                $('#tipe_1').hide();
                $('#tipe_3').hide();
                $('input[name=hasil_covid]').prop("required", true);
                $('input[name=hasil_covid]').prop("checked", false);
            } else if (this.value == 'Genose / PCR') {
                $('#tipe_3').show();
                $('#tipe_1').hide();
                $('#tipe_2').hide();
                $('input[name=hasil_covid]').prop("required", true);
                $('input[name=hasil_covid]').prop("checked", false);
            } else {

            }
        });


        $('input[type=radio][name=status_komposisi_tubuh]').on('change', function() {
            if (this.value == 1) {
                $('#lemak').val('');
                $('#kandungan_air').val('');
                $('#otot').val('');
                $('#tulang').val('');
                $('#kalori').val('');
                $('input[id=lemak]').prop("required", true);
                $('input[id=kandungan_air]').prop("required", true);
                $('input[id=otot]').prop("required", true);
                $('input[id=tulang]').prop("required", true);
                $('input[id=kalori]').prop("required", true);
                $("#detail_komposisi").removeAttr("style");
            } else {
                $('#lemak').val('');
                $('#kandungan_air').val('');
                $('#otot').val('');
                $('#tulang').val('');
                $('#kalori').val('');
                $('input[id=lemak]').prop("required", false);
                $('input[id=kandungan_air]').prop("required", false);
                $('input[id=otot]').prop("required", false);
                $('input[id=tulang]').prop("required", false);
                $('input[id=kalori]').prop("required", false);
                $("#detail_komposisi").css('display', 'none');
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

        $(function() {
            $('#mata_kiri').keyup(function() {
                var value1 = parseFloat($('#mata_kiri').val());
                if (value1 <= 6) {
                    $('#mata_kiri_status').text('Tidak Normal');
                } else {
                    $('#mata_kiri_status').text('Normal');
                }
            });
        });

        $(function() {
            $('#mata_kanan').keyup(function() {
                var value1 = parseFloat($('#mata_kanan').val());
                if (value1 <= 6) {
                    $('#mata_kanan_status').text('Tidak Normal');
                } else {
                    $('#mata_kanan_status').text('Normal');
                }
            });
        });
    });
</script>
@stop