@extends('adminlte.page')

@section('title', 'Beta Version')

@section('content_header')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Pengemasan</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Pengemasan</li>
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
                                    {{$s->Pengemasan->Bppb->no_bppb}}
                                </div>
                            </div>

                            <div class="row">
                                <label for="no_seri" class="col-sm-4 col-form-label">Produk</label>
                                <div class="col-sm-8 col-form-label" style="text-align:right;">
                                    {{$s->Pengemasan->Bppb->DetailProduk->nama}}
                                </div>
                            </div>

                            <div class="row">
                                <label for="no_seri" class="col-sm-8 col-form-label">Jumlah Pengemasan</label>
                                <div class="col-sm-4 col-form-label" style="text-align:right;">
                                    {{$s->Pengemasan->Bppb->countHasilPengemasan()}} {{$s->Pengemasan->Bppb->DetailProduk->satuan}}
                                </div>
                            </div>

                            <div class="row">
                                <label for="no_seri" class="col-sm-8 col-form-label">Tanggal Laporan</label>
                                <div class="col-sm-4 col-form-label" style="text-align:right;">
                                    {{$s->Pengemasan->tanggal}}
                                </div>
                            </div>

                            <div class="row">
                                <label for="no_seri" class="col-sm-4 col-form-label">Operator</label>
                                <div class="col-sm-8 col-form-label" style="text-align:right;">
                                    {{ $s->Pengemasan->Karyawan->nama}}
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
                        <h3 class="card-title"><i class="fas fa-pencil-alt" aria-hidden="true"></i>&nbsp;Pemeriksaan Pengemasan</h3>
                    </div>
                    <div class="card-body">
                        <div class="col-md-12">
                            <form action="{{ route('pengemasan.hasil.update.qc', ['id' => $id]) }}" method="post">
                                {{ csrf_field() }}
                                {{ method_field('PUT') }}
                                <hgroup>
                                    <h3 class="card-heading">Pemeriksaan</h3>
                                    <h6 class="card-subheading text-muted ">Pemeriksaan ke-{{$s->countStatus('pemeriksaan_pengemasan') + 1}}</h6>
                                </hgroup>
                                <div class="form-horizontal">

                                    <div class="form-group row">
                                        <label for="hasil" class="col-sm-5 col-form-label" style="text-align:right;">Hasil</label>

                                        <div class="col-sm-1 col-form-label">
                                            <div class="icheck-primary d-inline">
                                                <input type="radio" id="hasil_ok" name="hasil" value="ok" checked>
                                                <label for="hasil_ok">
                                                    <i class="fas fa-check-circle" style="color:green;"></i>
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col-sm-2 col-form-label">
                                            <div class="icheck-primary d-inline">
                                                <input type="radio" id="hasil_nok" name="hasil" value="nok">
                                                <label for="hasil_nok">
                                                    <i class="fas fa-times-circle" style="color:red;"></i>
                                                </label>
                                            </div>
                                        </div>
                                        @if ($errors->has('hasil'))
                                        <span class="invalid-feedback" role="alert">{{$errors->first('hasil')}}</span>
                                        @endif
                                    </div>

                                    <div class="form-group row">
                                        <label for="kelompok_produk_id" class="col-sm-5 col-form-label" style="text-align:right;">Tindak Lanjut</label>
                                        <div class="col-sm-7">
                                            <select class="form-control select2 select2-info @error('tindak_lanjut') is-invalid @enderror" data-dropdown-css-class="select2-info" style="width: 30%;" data-placeholder="Pilih Tindak Lanjut" name="tindak_lanjut" id="tindak_lanjut">
                                                <option value=""></option>
                                                <option value="ok">OK</option>
                                                <option value="perbaikan" disabled>Perbaikan</option>
                                                <option value="produk_spesialis" disabled>Produk Spesialis</option>
                                            </select>
                                            <small id="alert-perubahan"></small>
                                            @if ($errors->has('tindak_lanjut'))
                                            <span class="invalid-feedback" role="alert">{{$errors->first('tindak_lanjut')}}</span>
                                            @endif
                                        </div>
                                    </div>


                                    <div class="form-group row">
                                        <label for="divisi_id" class="col-sm-5 col-form-label" style="text-align:right;">Keterangan</label>
                                        <div class="col-sm-7">
                                            <textarea name="keterangan" id="keterangan" class="form-control @error('keterangan') is-invalid @enderror" disabled></textarea>
                                            @if ($errors->has('keterangan'))
                                            <span class="invalid-feedback" role="alert">{{$errors->first('keterangan')}}</span>
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
        var countStatus = "{{$s->countStatus('perbaikan_pengemasan')}}";
        $('input[type="radio"][name="hasil"]').on("change", function() {
            if (this.value == 'ok') {
                // $('select').select2('val', '');
                $('select').val('').trigger('change');
                $("select option[value='ok']").attr('disabled', false);
                $("select option[value='perbaikan']").attr('disabled', true);
                $("select option[value='produk_spesialis']").attr('disabled', true);

            } else if (this.value == 'nok') {
                // $('select').select2('val', '');
                $('select').val('').trigger('change');
                $("select option[value='ok']").attr('disabled', true);
                if (countStatus < 2) {
                    $("select option[value='perbaikan']").attr('disabled', false);
                } else if (countStatus >= 2) {
                    $("select option[value='produk_spesialis']").attr('disabled', false);
                }
            }
        });
        $('select[name="tindak_lanjut"]').on("change", function() {
            if (this.value == 'ok' || this.value == '') {
                $('textarea[name="keterangan"]').attr('disabled', true);
            } else {
                $('textarea[name="keterangan"]').attr('disabled', false);
            }
        });
    });
</script>
@endsection