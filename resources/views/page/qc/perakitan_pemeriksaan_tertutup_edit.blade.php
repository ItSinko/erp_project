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
                    <div class="card-header bg-warning">
                        <h3 class="card-title"><i class="fas fa-pencil-alt" aria-hidden="true"></i>&nbsp;Ubah Pemeriksaan Tertutup</h3>
                    </div>
                    <div class="card-body">
                        <div class="col-md-12">
                            <form action="{{ route('perakitan.pemeriksaan.tertutup.update', ['id' => $id]) }}" method="post">
                                {{ csrf_field() }}
                                {{ method_field('PUT') }}
                                <h3>Detail Produk</h3>
                                <div class="form-horizontal">
                                    <div class="form-group row">
                                        <label for="no_seri" class="col-sm-4 col-form-label" style="text-align:right;">No Seri : </label>
                                        <div class="col-sm-8 col-form-label">
                                            {{$s->no_seri}}
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="tanggal" class="col-sm-4 col-form-label" style="text-align:right;">Tanggal : </label>
                                        <div class="col-sm-8 col-form-label">
                                            {{$s->tanggal }}
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="tanggal" class="col-sm-4 col-form-label" style="text-align:right;">Operator : </label>
                                        <div class="col-sm-8 col-form-label">
                                            @foreach($s->Perakitan->Karyawan as $i)
                                            {{$i->nama}}<br>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>

                                <hgroup>
                                    <h3 class="card-heading">Pemeriksaan</h3>
                                    <h6 class="card-subheading text-muted ">Pemeriksaan ke-{{$s->countStatus('perbaikan_pemeriksaan_tertutup') + 1}}</h6>
                                </hgroup>
                                <div class="form-horizontal">

                                    <div class="form-group row">
                                        <label for="fungsi" class="col-sm-4 col-form-label" style="text-align:right;">Fungsi</label>
                                        <div class="col-sm-1 col-form-label">
                                            <div class="icheck-primary d-inline">
                                                <input type="radio" id="fungsi_ok" name="fungsi" value="ok" checked>
                                                <label for="fungsi_ok">
                                                    Baik
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-sm-2 col-form-label">
                                            <div class="icheck-primary d-inline">
                                                <input type="radio" id="fungsi_nok" name="fungsi" value="nok">
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
                                                <input type="radio" id="kondisi_setelah_proses_ok" name="kondisi_setelah_proses" value="ok" checked>
                                                <label for="kondisi_setelah_proses_ok">
                                                    Baik
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col-sm-2 col-form-label">
                                            <div class="icheck-primary d-inline">
                                                <input type="radio" id="kondisi_setelah_proses_nok" name="kondisi_setelah_proses" value="nok">
                                                <label for="kondisi_setelah_proses_nok">
                                                    Tidak Baik
                                                </label>
                                            </div>
                                        </div>
                                        @if ($errors->has('kondisi_saat_proses_perakitan'))
                                        <span class="invalid-feedback" role="alert">{{$errors->first('kondisi_saat_proses_perakitan')}}</span>
                                        @endif
                                    </div>

                                    <div class="form-group row">
                                        <label for="hasil" class="col-sm-4 col-form-label" style="text-align:right;">Hasil</label>
                                        <div class="col-sm-1 col-form-label">
                                            <div class="icheck-primary d-inline">
                                                <input type="radio" id="hasil_ok" name="hasil_tertutup" value="ok" checked>
                                                <label for="hasil_ok">
                                                    Baik
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-sm-2 col-form-label">
                                            <div class="icheck-primary d-inline">
                                                <input type="radio" id="hasil_nok" name="hasil_tertutup" value="nok">
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
                                                <option value="aging">Aging</option>
                                                <option value="perbaikan" disabled>Perbaikan</option>
                                                <option value="produk_spesialis" disabled>Produk Spesialis</option>
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
                                            <textarea name="keterangan_tindak_lanjut_tertutup" id="keterangan_tindak_lanjut_tertutup" class="form-control" disabled></textarea>
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
        $('select[name="tindak_lanjut_tertutup"]').on("change", function() {
            if (this.value == 'aging' || this.value == '') {
                $('textarea[name="keterangan_tindak_lanjut_tertutup"]').attr('disabled', true);
            } else {
                $('textarea[name="keterangan_tindak_lanjut_tertutup"]').attr('disabled', false);
            }
        });
    });
</script>
@endsection