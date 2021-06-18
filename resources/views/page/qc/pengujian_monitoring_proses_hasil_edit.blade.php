@extends('adminlte.page')

@section('title', 'Beta Version')

@section('content_header')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Pengujian</h1>
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
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <h3>Info</h3>
                        <div class="form-horizontal">
                            <div class="row">
                                <label for="no_bppb" class="col-sm-4 col-form-label" style="text-align:left;">No BPPB</label>
                                <label class="col-sm-8 col-form-label" style="text-align:right;">{{$s->MonitoringProses->Bppb->no_bppb}}<label>
                            </div>

                            <div class="row">
                                <label for="nama_produk" class="col-sm-4 col-form-label" style="text-align:left;">Nama Produk</label>
                                <label class="col-sm-8 col-form-label" style="text-align:right;">{{$s->MonitoringProses->Bppb->DetailProduk->nama}}<label>
                            </div>

                            <div class="row">
                                <label for="jumlah" class="col-sm-8 col-form-label" style="text-align:left;">Jumlah Rencana Produksi</label>
                                <label class="col-sm-4 col-form-label" style="text-align:right;">{{$s->MonitoringProses->Bppb->jumlah}}<label>
                            </div>

                            <div class="form-group row">
                                <label for="karyawan" class="col-sm-4 col-form-label" style="text-align:left;">Operator QC</label>
                                <label class="col-sm-8 col-form-label" style="text-align:right;">{{$s->MonitoringProses->Karyawan->nama}}<label>
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
                        <h3 class="card-title"><i class="fas fa-pencil-alt" aria-hidden="true"></i>&nbsp;Periksa Monitoring Proses</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('pengujian.monitoring_proses.hasil.update', ['id' => $id]) }}" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}
                            <div class="col-md-12">
                                <div class="form-horizontal">
                                    <div class="form-group row">
                                        <label for="no_seri" class="col-sm-4 col-form-label" style="text-align:right;">No Seri</label>
                                        <label for="no_seri" class="col-sm-8 col-form-label">{{$s->HasilPerakitan->Perakitan->alias_tim}}{{$s->HasilPerakitan->no_seri}}</label>
                                    </div>

                                    <div class="form-group row">
                                        <label for="no_barcode" class="col-sm-4 col-form-label" style="text-align:right;">No Barcode</label>
                                        <label for="no_barcode" class="col-sm-8 col-form-label">
                                            @if($s->no_barcode != NULL)
                                            {{str_replace('/', '', $s->MonitoringProses->alias_barcode)}}{{$s->no_barcode}}
                                            @elseif($s->no_barcode == NULL)
                                            <small class="text-muted">Belum Tersedia</small>
                                            @endif
                                        </label>
                                    </div>

                                    <h3>Data Monitoring Proses</h3>
                                    <div class="form-group row">
                                        <label for="hasil" class="col-sm-4 col-form-label" style="text-align:right;">Hasil</label>
                                        <div class="col-sm-1 col-form-label">
                                            <div class="icheck-primary d-inline">
                                                <input type="radio" id="hasil_ok" name="hasil" value="ok" @if($s->hasil == "ok") checked @endif>
                                                <label for="hasil_ok">
                                                    <i class="fas fa-check-circle" style="color:green;"></i>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-sm-2 col-form-label">
                                            <div class="icheck-primary d-inline">
                                                <input type="radio" id="hasil_nok" name="hasil" value="nok" @if($s->hasil == "nok") checked @endif>
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
                                        <label for="no_barcode" class="col-sm-4 col-form-label" style="text-align:right;">Pemeriksaan</label>
                                        <div class="col-sm-8">
                                            <div class="select2-info">
                                                <select class="select2 form-control pemeriksaan  @error('pemeriksaan') is-invalid @enderror" multiple="multiple" name="pemeriksaan[]" id="pemeriksaan" data-placeholder="Standar yang tidak sesuai" data-dropdown-css-class="select2-info" @if($s->hasil == "ok") disabled @endif>
                                                    @foreach($p as $i)
                                                    <optgroup label="{{$i->hal_yang_diperiksa}}">
                                                        @foreach($i->HasilIkPemeriksaanPengujian as $j)
                                                        <option value="{{$j->id}}" @if($s->HasilIkPemeriksaanPengujian->contains('id', $j->id)) selected @endif>{{$j->standar_keberterimaan}}</option>
                                                        @endforeach
                                                    </optgroup>
                                                    @endforeach
                                                </select>
                                                @if ($errors->has('pemeriksaan'))
                                                <span class="invalid-feedback" role="alert">{{$errors->first('pemeriksaan')}}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="no_barcode" class="col-sm-4 col-form-label" style="text-align:right;">Keterangan</label>
                                        <div class="col-sm-8">
                                            <textarea class="form-control  @error('no_barcode') is-invalid @enderror " name="keterangan" id="keterangan" style="width: 40%;">{{old('keterangan', $s->keterangan)}}</textarea>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label" style="text-align:right;">Tindak Lanjut</label>
                                        <div class="col-sm-8">
                                            <div class="select2-info">
                                                <select class="select2 custom-select form-control tindak_lanjut  @error('tindak_lanjut') is-invalid @enderror " name="tindak_lanjut" id="tindak_lanjut" data-placeholder="Pilih Tindak Lanjut" data-dropdown-css-class="select2-info">
                                                    <option value=""></option>
                                                    <option value="pengemasan" @if($s->tindak_lanjut == "pengemasan") selected @endif @if($s->hasil == "nok") disabled @endif>Pengemasan</option>
                                                    <option value="perbaikan" @if($s->tindak_lanjut == "perbaikan") selected @endif @if($s->hasil == "ok") disabled @endif>Perbaikan</option>
                                                    <option value="produk_spesialis" @if($s->tindak_lanjut == "produk_spesialis") selected @endif @if($s->hasil == "ok") disabled @elseif($s->hasil == "nok" && $s->countStatus('perbaikan_pengujian') < 1) disabled @endif>Produk Spesialis</option>
                                                </select>
                                                @if ($errors->has('pemeriksaan'))
                                                <span class="invalid-feedback" role="alert">{{$errors->first('pemeriksaan')}}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                    </div>
                    <div class="card-footer">
                        <span>
                            <button type="button" class="btn btn-block btn-danger rounded-pill" style="width:200px;float:left;"><i class="fas fa-times"></i>&nbsp;Batal</button>
                        </span>
                        <span>
                            <button type="submit" class="btn btn-block btn-warning rounded-pill" style="width:200px;float:right;" id="tambahdata"><i class="fas fa-edit"></i>&nbsp;Simpan Data</button>
                        </span>
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
        var countStatus = "{{$s->countStatus('perbaikan_pengujian')}}";
        var rdb = "";
        $('input[type="radio"][name="brc"]').on("change", function() {
            if (this.value == 'ya') {
                $('.barcode').attr('readonly', false);
                $('#insial_produk').attr('readonly', false);
                $('#tipe_produk').attr('readonly', false);
                $('#waktu_produksi').attr('readonly', false);
                $('#urutan_bb').attr('readonly', false);
                rdb = 'ya';
            } else if (this.value == 'tidak') {
                $('.barcode').attr('readonly', true);
                $('#insial_produk').attr('readonly', true);
                $('#tipe_produk').attr('readonly', true);
                $('#waktu_produksi').attr('readonly', true);
                $('#urutan_bb').attr('readonly', true);
                rdb = 'tidak';
                $('.barcode').val("");
            }
        });

        $('input[type="radio"][name="hasil"]').on('change', function(e) {
            $("#tambahdata").attr('disabled', true);
            if (this.value == 'ok') {
                // $('select').select2('val', '');
                $('select.tindak_lanjut').val('').trigger('change');
                $("select.pemeriksaan").empty();
                $("select.pemeriksaan").attr('disabled', true);
                $("select.pemeriksaan").attr('disabled', true);
                $("select.tindak_lanjut option[value='pengemasan']").attr('disabled', false);
                $("select.tindak_lanjut option[value='perbaikan']").attr('disabled', true);
                $("select.tindak_lanjut option[value='produk_spesialis']").attr('disabled', true);
            } else if (this.value == 'nok') {
                // $('select').select2('val', '');
                $('select.tindak_lanjut').val('').trigger('change');
                $("select.pemeriksaan").attr('disabled', false);
                $("select.tindak_lanjut option[value='pengemasan']").attr('disabled', true);
                if (countStatus >= 1) {
                    $("select.tindak_lanjut option[value='perbaikan']").attr('disabled', false);
                    $("select.tindak_lanjut option[value='produk_spesialis']").attr('disabled', false);
                } else {
                    $("select.tindak_lanjut option[value='perbaikan']").attr('disabled', false);
                }
            }
        });

        $('select[name="tindak_lanjut"]').on('change', function() {
            var data = $(this).val();
            if (data != "") {
                $("#tambahdata").removeAttr('disabled');
            } else if (data == "") {
                $("#tambahdata").attr('disabled', true);
            }
        });
    })
</script>
@stop