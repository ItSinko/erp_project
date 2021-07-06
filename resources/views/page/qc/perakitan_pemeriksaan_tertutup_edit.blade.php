@extends('adminlte.page')

@section('title', 'Beta Version')

@section('content_header')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Pemeriksaan Tertutup</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Perakitan</li>
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
            <div class="col-3">
                <div class="card">
                    <div class="card-body">
                        <h3><i class="fas fa-info-circle"></i>&nbsp;Informasi</h3><br>
                        <div class="form-horizontal">
                            <div class="row">
                                <label for="no_seri" class="col-sm-6 col-form-label">No BPPB</label>
                                <div class="col-sm-6 col-form-label" style="text-align:right;">
                                    {{$s->Perakitan->Bppb->no_bppb}}
                                </div>
                            </div>

                            <div class="row">
                                <label for="no_seri" class="col-sm-4 col-form-label">Produk</label>
                                <div class="col-sm-8 col-form-label" style="text-align:right;">
                                    {{$s->Perakitan->Bppb->DetailProduk->nama}}
                                </div>
                            </div>

                            <div class="row">
                                <label for="no_seri" class="col-sm-8 col-form-label">Jumlah Perakitan</label>
                                <div class="col-sm-4 col-form-label" style="text-align:right;">
                                    {{$s->Perakitan->Bppb->countHasilPerakitan()}} {{$s->Perakitan->Bppb->DetailProduk->satuan}}
                                </div>
                            </div>

                            <div class="row">
                                <label for="no_seri" class="col-sm-8 col-form-label">Tanggal Laporan</label>
                                <div class="col-sm-4 col-form-label" style="text-align:right;">
                                    {{$s->tanggal}}
                                </div>
                            </div>

                            <div class="row">
                                <label for="no_seri" class="col-sm-4 col-form-label">Operator</label>
                                <div class="col-sm-8 col-form-label" style="text-align:right;">
                                    {{ $s->Perakitan->Karyawan->pluck('nama')->implode(', ') }}
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
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
                        <h3 class="card-title"><i class="fas fa-pencil-alt" aria-hidden="true"></i>&nbsp;Ubah Pemeriksaan Tertutup</h3>
                    </div>
                    <div class="card-body">
                        <div class="col-md-12">
                            <form action="{{ route('perakitan.pemeriksaan.tertutup.update', ['id' => $id]) }}" method="post">
                                {{ csrf_field() }}
                                {{ method_field('PUT') }}

                                <hgroup>
                                    <h3 class="card-heading">Pemeriksaan</h3>
                                    <h6 class="card-subheading text-muted ">Pemeriksaan ke-{{$s->countStatus('pemeriksaan_tertutup') + 1}}</h6>
                                </hgroup>
                                <div class="form-horizontal">

                                    <div class="form-group row">
                                        <label for="fungsi" class="col-sm-4 col-form-label" style="text-align:right;">Fungsi</label>
                                        <div class="col-sm-1 col-form-label">
                                            <div class="icheck-primary d-inline">
                                                <input type="radio" id="fungsi_ok" name="fungsi" value="ok" @if($s->fungsi == "ok")
                                                checked
                                                @elseif($s->fungsi == "")
                                                checked
                                                @endif>
                                                <label for="fungsi_ok">
                                                    Baik
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-sm-2 col-form-label">
                                            <div class="icheck-primary d-inline">
                                                <input type="radio" id="fungsi_nok" name="fungsi" value="nok" @if($s->fungsi == "nok")
                                                checked
                                                @endif>
                                                <label for="fungsi_nok">
                                                    Tidak Baik
                                                </label>
                                            </div>
                                        </div>
                                        @if ($errors->has('fungsi'))
                                        <span class="invalid-feedback" role="alert">{{$errors->first('fungsi')}}</span>
                                        @endif
                                    </div>

                                    <div class="form-group row">
                                        <label for="kondisi_setelah_proses" class="col-sm-4 col-form-label" style="text-align:right;">Kondisi Setelah Proses</label>

                                        <div class="col-sm-1 col-form-label">
                                            <div class="icheck-primary d-inline">
                                                <input type="radio" id="kondisi_setelah_proses_ok" name="kondisi_setelah_proses" value="ok" @if($s->kondisi_setelah_proses == "ok")
                                                checked
                                                @elseif($s->kondisi_setelah_proses == "")
                                                checked
                                                @endif>
                                                <label for="kondisi_setelah_proses_ok">
                                                    Baik
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col-sm-2 col-form-label">
                                            <div class="icheck-primary d-inline">
                                                <input type="radio" id="kondisi_setelah_proses_nok" name="kondisi_setelah_proses" value="nok" @if($s->kondisi_setelah_proses == "nok")
                                                checked
                                                @endif>
                                                <label for="kondisi_setelah_proses_nok">
                                                    Tidak Baik
                                                </label>
                                            </div>
                                        </div>
                                        @if ($errors->has('kondisi_setelah_proses'))
                                        <span class="invalid-feedback" role="alert">{{$errors->first('kondisi_setelah_proses')}}</span>
                                        @endif
                                    </div>

                                    <div class="form-group row">
                                        <label for="hasil" class="col-sm-4 col-form-label" style="text-align:right;">Hasil</label>
                                        <div class="col-sm-1 col-form-label">
                                            <div class="icheck-primary d-inline">
                                                <input type="radio" id="hasil_ok" name="hasil_tertutup" value="ok" @if($s->hasil_tertutup == "ok")
                                                checked
                                                @elseif($s->hasil_tertutup == "")
                                                checked
                                                @endif>
                                                <label for="hasil_ok">
                                                    Baik
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-sm-2 col-form-label">
                                            <div class="icheck-primary d-inline">
                                                <input type="radio" id="hasil_nok" name="hasil_tertutup" value="nok" @if($s->hasil_tertutup == "nok")
                                                checked
                                                @endif>
                                                <label for="hasil_nok">
                                                    Tidak Baik
                                                </label>
                                            </div>
                                        </div>
                                        @if ($errors->has('hasil'))
                                        <span class="invalid-feedback" role="alert">{{$errors->first('hasil')}}</span>
                                        @endif
                                    </div>

                                    <div class="form-group row">
                                        <label for="kelompok_produk_id" class="col-sm-4 col-form-label" style="text-align:right;">Tindak Lanjut</label>
                                        <div class="col-sm-8">
                                            <select class="form-control select2 select2-info @error('tindak_lanjut_tertutup') is-invalid @enderror" data-dropdown-css-class="select2-info" style="width: 30%;" data-placeholder="Pilih Tindak Lanjut" name="tindak_lanjut_tertutup" id="tindak_lanjut_tertutup">
                                                <option value=""></option>
                                                <option value="aging" @if($s->tindak_lanjut_tertutup == "aging")
                                                    selected
                                                    @elseif($s->tindak_lanjut_tertutup != "aging")
                                                    @if($s->tindak_lanjut_tertutup == "")
                                                    selected
                                                    @else
                                                    disabled
                                                    @endif
                                                    @endif>Pengujian</option>
                                                <option value="perbaikan" @if($s->tindak_lanjut_tertutup == "perbaikan")
                                                    selected
                                                    @elseif($s->tindak_lanjut_tertutup == "")
                                                    disabled
                                                    @endif>Perbaikan</option>
                                                <option value="produk_spesialis" @if($s->tindak_lanjut_tertutup == "produk_spesialis")
                                                    selected
                                                    @elseif($s->tindak_lanjut_tertutup == "")
                                                    disabled
                                                    @endif>Produk Spesialis</option>
                                            </select>
                                            <small id="alert-perubahan"></small>
                                            @if ($errors->has('tindak_lanjut_tertutup'))
                                            <span class="invalid-feedback" role="alert">{{$errors->first('tindak_lanjut_tertutup')}}</span>
                                            @endif
                                        </div>
                                    </div>


                                    <div class="form-group row">
                                        <label for="divisi_id" class="col-sm-4 col-form-label" style="text-align:right;">Keterangan</label>
                                        <div class="col-sm-8">
                                            <textarea name="keterangan_tindak_lanjut_tertutup" id="keterangan_tindak_lanjut_tertutup" class="form-control @error('keterangan_tindak_lanjut_tertutup') is-invalid @enderror">{{$s->keterangan_tindak_lanjut_tertutup}}</textarea>
                                            @if ($errors->has('keterangan_tindak_lanjut_tertutup'))
                                            <span class="invalid-feedback" role="alert">{{$errors->first('keterangan_tindak_lanjut_tertutup')}}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                        </div>
                        <!-- /.card -->

                    </div>
                    <div class="card-footer">
                        <span>
                            <button type="button" class="btn btn-block btn-danger rounded-pill" style="width:200px;float:left;"><i class="fas fa-times"></i>&nbsp;Batal</button>
                        </span>
                        <span>
                            <button type="submit" class="btn btn-block btn-warning rounded-pill" style="width:200px;float:right;"><i class="fas fa-check"></i>&nbsp;Simpan Hasil</button>
                        </span>
                    </div>
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
        var countStatus = "{{$s->countStatus('perbaikan_pemeriksaan_tertutup')}}";
        $('input[type="radio"][name="kondisi_setelah_proses"]').on("change", function() {
            var f = $('input[type="radio"][name="fungsi"]:checked').val();
            if (this.value == 'nok') {
                $("input[name='hasil_tertutup'][value='nok']").prop("checked", true);
                $('select').val('').trigger('change');
                $("select option[value='aging']").attr('disabled', true);
                if (countStatus < 1) {
                    $("select option[value='perbaikan']").attr('disabled', false);
                } else if (countStatus >= 1) {
                    $("select option[value='produk_spesialis']").attr('disabled', false);
                    $("select option[value='perbaikan']").attr('disabled', false);
                }
            } else if (this.value == 'ok') {
                if (f == 'ok') {
                    $("input[name='hasil_tertutup'][value='ok']").prop("checked", true);
                    $('select').val('').trigger('change');
                    $("select option[value='aging']").attr('disabled', false);
                    $("select option[value='perbaikan']").attr('disabled', true);
                    $("select option[value='produk_spesialis']").attr('disabled', true);
                } else if (f == 'nok') {
                    $("input[name='hasil_tertutup'][value='nok']").prop("checked", true);
                    $('select').val('').trigger('change');
                    $("select option[value='aging']").attr('disabled', true);
                    if (countStatus < 1) {
                        $("select option[value='perbaikan']").attr('disabled', false);
                    } else if (countStatus >= 1) {
                        $("select option[value='produk_spesialis']").attr('disabled', false);
                        $("select option[value='perbaikan']").attr('disabled', false);
                    }
                }
            }
        });

        $('input[type="radio"][name="fungsi"]').on("change", function() {
            var ksp = $('input[type="radio"][name="kondisi_setelah_proses"]:checked').val();
            if (this.value == 'nok') {
                $("input[name='hasil_tertutup'][value='nok']").prop("checked", true);
                $('select').val('').trigger('change');
                $("select option[value='aging']").attr('disabled', true);
                if (countStatus < 1) {
                    $("select option[value='perbaikan']").attr('disabled', false);
                } else if (countStatus >= 1) {
                    $("select option[value='produk_spesialis']").attr('disabled', false);
                    $("select option[value='perbaikan']").attr('disabled', false);
                }
            } else if (this.value == 'ok') {
                if (ksp == 'ok') {
                    $("input[name='hasil_tertutup'][value='ok']").prop("checked", true);
                    $('select').val('').trigger('change');
                    $("select option[value='aging']").attr('disabled', false);
                    $("select option[value='perbaikan']").attr('disabled', true);
                    $("select option[value='produk_spesialis']").attr('disabled', true);
                } else if (ksp == 'nok') {
                    $("input[name='hasil_tertutup'][value='nok']").prop("checked", true);
                    $('select').val('').trigger('change');
                    $("select option[value='aging']").attr('disabled', true);
                    if (countStatus < 1) {
                        $("select option[value='perbaikan']").attr('disabled', false);
                    } else if (countStatus >= 1) {
                        $("select option[value='produk_spesialis']").attr('disabled', false);
                        $("select option[value='perbaikan']").attr('disabled', false);
                    }
                }
            }
        });

        $('input[type="radio"][name="hasil_tertutup"]').on("change", function() {
            if (this.value == 'ok') {
                // $('select').select2('val', '');
                $('select').val('').trigger('change');
                $("select option[value='aging']").attr('disabled', false);
                $("select option[value='perbaikan']").attr('disabled', true);
                $("select option[value='produk_spesialis']").attr('disabled', true);

            } else if (this.value == 'nok') {
                // $('select').select2('val', '');
                $('select').val('').trigger('change');
                $("select option[value='aging']").attr('disabled', true);
                if (countStatus < 1) {
                    $("select option[value='perbaikan']").attr('disabled', false);
                } else if (countStatus >= 1) {
                    $("select option[value='produk_spesialis']").attr('disabled', false);
                    $("select option[value='perbaikan']").attr('disabled', false);
                }
            }
        });
        // $('select[name="tindak_lanjut_tertutup"]').on("change", function() {
        //     if (this.value == 'aging' || this.value == '') {
        //         $('textarea[name="keterangan_tindak_lanjut_tertutup"]').attr('disabled', true);
        //     } else {
        //         $('textarea[name="keterangan_tindak_lanjut_tertutup"]').attr('disabled', false);
        //     }
        // });
    });
</script>
@endsection