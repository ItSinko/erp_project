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
                    <li class="breadcrumb-item active">DataTables</li>
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
                            <label for="no_seri" class="col-sm-8 col-form-label">Jumlah Perakitan</label>
                            <div class="col-sm-4 col-form-label" style="text-align:right;">
                                {{$s->Bppb->countHasilPerakitan()}} {{$s->Bppb->DetailProduk->satuan}}
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
                    <div class="card-title"><i class="fas fa-edit"></i>&nbsp;Ubah Monitoring Proses</div>
                </div>
                <form action="{{route('pengujian.monitoring_proses.laporan.update', ['id' => $id])}}" method="POST">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                    <div class="card-body">
                        <div class="form-horizontal">
                            <div class="form-group row">
                                <label for="tanggal_laporan" class="col-sm-4 col-form-label" style="text-align:right;">Tanggal Laporan</label>
                                <div class="col-sm-8">
                                    <input type="date" class="form-control  @error('tanggal_laporan') is-invalid @enderror " name="tanggal_laporan" id="tanggal_laporan" value="{{old('tanggal_laporan', $s->tanggal)}}" style="width: 30%;">
                                    @if ($errors->has('tanggal_laporan'))
                                    <span class="invalid-feedback" role="alert">{{$errors->first('tanggal_laporan')}}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="karyawan_id" class="col-sm-4 col-form-label" style="text-align:right;">Karyawan</label>
                                <div class="col-sm-5">
                                    <div class="select2-info">
                                        <select class="select2 custom-select form-control @error('karyawan_id') is-invalid @enderror karyawan_id" data-placeholder="Pilih Operator" data-dropdown-css-class="select2-info" style="width: 100%;" name="karyawan_id" id="karyawan_id">
                                            @foreach($kry as $i)
                                            <option value="{{$i->id}}" @if($s->karyawan_id == $i->id) selected @endif>{{$i->nama}}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('karyawan_id'))
                                        <span class="invalid-feedback" role="alert">{{$errors->first('karyawan_id')}}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="brc" class="col-sm-4 col-form-label" style="text-align:right;">Barcode</label>
                                <div class="col-sm-1 col-form-label">
                                    <div class="icheck-primary d-inline">
                                        <input type="radio" id="brc_ya" name="brc" value="ya" @if (!is_null($s->HasilMonitoringProses->pluck('no_barcode'))) checked @endif>
                                        <label for="brc_ya">
                                            Buat
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-2 col-form-label">
                                    <div class="icheck-primary d-inline">
                                        <input type="radio" id="brc_tidak" name="brc" value="tidak" @if (is_null($s->HasilMonitoringProses->pluck('no_barcode'))) checked @endif>
                                        <label for="brc_tidak">
                                            Tidak
                                        </label>
                                    </div>
                                </div>
                                @if ($errors->has('brc'))
                                <span class="invalid-feedback" role="alert">{{$errors->first('brc')}}</span>
                                @endif
                            </div>

                            <div class="form-group row">
                                <table id="tableitem" class="table table-hover">
                                    <thead style="text-align: center;">
                                        <tr>
                                            <th>No</th>
                                            <th hidden>id</th>
                                            <th>No Seri</th>
                                            <th>Barcode</th>
                                            <th>Hasil Cek</th>
                                            <th>Keterangan</th>
                                            <th>Tindak Lanjut</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody style="text-align:center;">
                                        @php ($first = true) @endphp
                                        @foreach($s->HasilMonitoringProses as $j)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td hidden>
                                                <input type="text" class="form-control" name="mpid[{{$loop->iteration - 1}}]" id="mpid" value="{{$j->id}}">
                                            </td>
                                            <td>
                                                <div class="form-group">
                                                    <div class="select2-info">
                                                        <select class="select2 form-control @error('no_seri') is-invalid @enderror no_seri" data-placeholder="Pilih No Seri" data-dropdown-css-class="select2-info" style="width: 100%;" name="no_seri[{{$loop->iteration - 1}}]" id="no_seri{{$loop->iteration - 1}}">
                                                            <option value=""></option>
                                                            @foreach($ns as $i)
                                                            <option value="{{$i->id}}" @if($j->hasil_perakitan_id == $i->id) selected @endif>
                                                                {{$i->no_seri}} @if($i->status == "rej_pemeriksaan_terbuka" || $i->status == "rej_pemeriksaan_tertutup") * @endif
                                                            </option>
                                                            @endforeach
                                                        </select>
                                                        @if ($errors->has('no_seri'))
                                                        <span class="invalid-feedback" role="alert">{{$errors->first('no_seri.*')}}</span>
                                                        @endif
                                                        <span id="no_seri-message[]" role="alert"></span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <input type="text" class="form-control @error('no_barcode') is-invalid @enderror barcode" value="{{$j->no_barcode}}" name="no_barcode[{{$loop->iteration - 1}}]" id="no_barcode">
                                                    </div>
                                                    @if ($errors->has('no_barcode'))
                                                    <span class="invalid-feedback" role="alert">{{$errors->first('no_barcode')}}</span>
                                                    @endif
                                                    <span id="no_barcode-message[]" role="alert"></span>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <div class="form-group clearfix">
                                                            <div class="icheck-success d-inline checked">
                                                                <input type="radio" name="hasil[{{$loop->iteration - 1}}]" id="ok" class="hasil" value="ok" @if($j->hasil == "ok") checked @endif>
                                                                <label for="ok">
                                                                    <i class="fas fa-check-circle" style="color:green;"></i>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <div class="form-group clearfix">
                                                            <div class="icheck-danger d-inline">
                                                                <input type="radio" name="hasil[{{$loop->iteration - 1}}]" id="nok" value="nok" class="hasil" @if($j->hasil == "nok") checked @endif>
                                                                <label for="nok">
                                                                    <i class="fas fa-times-circle" style="color:red;"></i>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group">
                                                    <div class="select2-info">
                                                        <select class="select2 form-control pemeriksaan @error('pemeriksaan') is-invalid @enderror" multiple="multiple" name="pemeriksaan[{{$loop->iteration - 1}}][]" id="pemeriksaan{{$loop->iteration - 1}}" data-placeholder="Standar yang tidak sesuai" data-dropdown-css-class="select2-info" @if($j->hasil == "ok") disabled @endif>
                                                            @foreach($p as $z)
                                                            <optgroup label="{{$z->hal_yang_diperiksa}}">
                                                                @foreach($z->HasilIkPemeriksaanPengujian as $x)
                                                                <option value="{{$x->id}}" @if($j->HasilIkPemeriksaanPengujian->contains('id', $x->id)) selected @endif>{{$x->standar_keberterimaan}}</option>
                                                                @endforeach
                                                            </optgroup>
                                                            @endforeach
                                                        </select>
                                                        @if ($errors->has('pemeriksaan'))
                                                        <span class="invalid-feedback" role="alert">{{$errors->first('pemeriksaan')}}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <textarea class="form-control @error('keterangan') is-invalid @enderror" name="keterangan[{{$loop->iteration - 1}}]" id="keterangan"></textarea>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <select class="select2 custom-select form-control tindak_lanjut  @error('tindak_lanjut') is-invalid @enderror " name="tindak_lanjut[{{$loop->iteration - 1}}]" id="tindak_lanjut{{$loop->iteration - 1}}" data-placeholder="Pilih Tindak Lanjut" data-dropdown-css-class="select2-info" style="width: 80%;">
                                                    <option value="pengemasan" @if($j->tindak_lanjut == "pengemasan") checked @endif @if($j->hasil == "nok") disabled @endif>Pengemasan</option>
                                                    <option value="perbaikan" @if($j->tindak_lanjut == "perbaikan") checked @endif @if($j->hasil == "ok") disabled @endif>Perbaikan</option>
                                                    <option value="produk_spesialis" @if($j->tindak_lanjut == "produk_spesialis") checked @endif @if($j->hasil == "ok") disabled @endif>Produk Spesialis</option>
                                                </select>
                                                @if ($errors->has('tindak_lanjut'))
                                                <span class="invalid-feedback" role="alert">{{$errors->first('tindak_lanjut')}}</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($first == true)
                                                @php ($first = false) @endphp
                                                <button type="button" class="btn btn-success karyawan-img-small" style="border-radius:50%;" id="tambahitem"><i class="fas fa-plus-circle"></i></button>
                                                @elseif($first == false)
                                                <button type="button" class="btn btn-danger karyawan-img-small" style="border-radius:50%;" id="closetable"><i class="fas fa-times-circle"></i></button>
                                                @endif
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>

                                </table>
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
            </div>
        </div>
    </div>
</section>
@stop

@section('adminlte_js')
<script>
    $(function() {
        var rdb = "";
        $('input[type="radio"][name="brc"]').on("change", function() {
            if (this.value == 'ya') {
                $('.barcode').attr('readonly', false);
                rdb = 'ya';

            } else if (this.value == 'tidak') {
                $('.barcode').attr('readonly', true);
                rdb = 'tidak';
                $('.barcode').val("");
            }
        });


        function numberRows($t) {
            var c = 0 - 1;
            $t.find("tr").each(function(ind, el) {
                $(el).find("td:eq(0)").html(++c);
                var j = c - 1;
                $(el).find('input[id="no_barcode"]').attr('name', 'no_barcode[' + j + ']');
                $(el).find('input[id="mpid"]').attr('name', 'mpid[' + j + ']');
                $(el).find('.no_seri').attr('name', 'no_seri[' + j + ']');
                $(el).find('.no_seri').attr('id', 'no_seri[' + j + ']');
                $(el).find('.pemeriksaan').attr('name', 'pemeriksaan[' + j + '][]');
                $(el).find('.pemeriksaan').attr('id', 'pemeriksaan' + j);
                $(el).find('.hasil').attr('id', 'ok' + j);
                $(el).find('.hasil').attr('id', 'nok' + j);
                $(el).find('.hasil').attr('name', 'hasil[' + j + ']');
                $(el).find('.tindak_lanjut').attr('name', 'tindak_lanjut[' + j + ']');
                $(el).find('.tindak_lanjut').attr('id', 'tindak_lanjut' + j);
                $(el).find('textarea[id="keterangan"]').attr('name', 'keterangan[' + j + ']');
                $('.tindak_lanjut').select2();
                $('.no_seri').select2();
                $('.pemeriksaan').select2();
            });
        }

        $('#tambahitem').click(function(e) {
            data = `<tr>
                <td></td>
                <td hidden>
                <input type="text" class="form-control" name="mpid[]" id="mpid">
                </td>
                <td>
                    <div class="form-group">
                        <div class="select2-info">
                            <select class="select2 custom-select form-control @error('no_seri') is-invalid @enderror no_seri" data-placeholder="Pilih No Seri" data-dropdown-css-class="select2-info" style="width: 100%;" name="no_seri[]" id="no_seri">
                            <option value=""></option>
                            @foreach($ns as $i)
                            <option value="{{$i->id}}">
                                {{$i->no_seri}} @if($i->status == "rej_pemeriksaan_terbuka" || $i->status == "rej_pemeriksaan_tertutup") * @endif
                            </option>
                            @endforeach
                            </select>
                            @if ($errors->has('no_seri'))
                            <span class="invalid-feedback" role="alert">{{$errors->first('no_seri.*')}}</span>
                            @endif
                            <span id="no_seri-message[]" role="alert"></span>
                        </div>
                    </div>
                </td>
                <td>
                    <div class="form-group">
                        <div class="input-group">
                            <input type="text" class="form-control @error('no_barcode') is-invalid @enderror barcode" name="no_barcode[]" id="no_barcode"`;
            if (rdb == 'tidak') {
                data += `readonly`;
            }
            data += `>
                        </div>
                        @if ($errors->has('no_barcode'))
                        <span class="invalid-feedback" role="alert">{{$errors->first('no_barcode')}}</span>
                        @endif
                        <span id="no_barcode-message[]" role="alert"></span>
                    </div>
                </td>
                <td>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group clearfix">
                                <div class="icheck-success d-inline checked">
                                    <input type="radio" name="hasil[]" id="ok" class="hasil" value="ok" checked>
                                    <label for="ok">
                                        <i class="fas fa-check-circle" style="color:green;"></i>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group clearfix">
                                <div class="icheck-danger d-inline">
                                    <input type="radio" name="hasil[]" id="nok" value="nok" class="hasil">
                                    <label for="nok">
                                        <i class="fas fa-times-circle" style="color:red;"></i>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
                <td>
                    <div class="form-group">
                        <div class="select2-info">
                            <select class="select2 form-control pemeriksaan @error('pemeriksaan') is-invalid @enderror" multiple="multiple" name="pemeriksaan[][]" id="pemeriksaan" data-placeholder="Standar yang tidak sesuai" data-dropdown-css-class="select2-info" disabled>
                                @foreach($p as $i)
                                <optgroup label="{{$i->hal_yang_diperiksa}}">
                                    @foreach($i->HasilIkPemeriksaanPengujian as $j)
                                    <option value="{{$j->id}}">{{$j->standar_keberterimaan}}</option>
                                    @endforeach
                                </optgroup>
                                @endforeach
                            </select>
                            @if ($errors->has('pemeriksaan'))
                            <span class="invalid-feedback" role="alert">{{$errors->first('pemeriksaan')}}</span>
                            @endif
                        </div>
                    </div>
                </td>
                <td>
                    <div class="form-group">
                        <div class="input-group">
                            <textarea class="form-control @error('keterangan') is-invalid @enderror" name="keterangan[]" id="keterangan"></textarea>
                        </div>
                    </div>
                </td>
                <td>
                    <select class="select2 custom-select form-control  @error('tindak_lanjut') is-invalid @enderror tindak_lanjut" name="tindak_lanjut[]" id="tindak_lanjut" data-placeholder="Pilih Tindak Lanjut" data-dropdown-css-class="select2-info" style="width: 80%;">
                        <option value="pengemasan">Pengemasan</option>
                        <option value="perbaikan" disabled>Perbaikan</option>
                        <option value="produk_spesialis" disabled>Produk Spesialis</option>
                    </select>
                    @if ($errors->has('tindak_lanjut'))
                    <span class="invalid-feedback" role="alert">{{$errors->first('tindak_lanjut')}}</span>
                    @endif
                </td>
                <td>
                    <button type="button" class="btn btn-danger karyawan-img-small" style="border-radius:50%;" id="closetable"><i class="fas fa-times-circle"></i></button>
                </td>
            </tr>`
            $('#tableitem tr:last').after(data);
            numberRows($("#tableitem"));
        });

        $('#tableitem').on('click', '#closetable', function(e) {
            $(this).closest('tr').remove();
            numberRows($("#tableitem"));
        });

        $('#tableitem').on('change', '.hasil', function(e) {
            var hasil = $(this).closest('tr').find('.hasil');
            if (this.value == 'ok') {
                // $('select').select2('val', '');
                $(this).closest('tr').find('select.tindak_lanjut').val('').trigger('change');
                $(this).closest('tr').find("select.pemeriksaan").attr('disabled', true);
                $(this).closest('tr').find("select.tindak_lanjut option[value='pengemasan']").attr('disabled', false);
                $(this).closest('tr').find("select.tindak_lanjut option[value='perbaikan']").attr('disabled', true);
                $(this).closest('tr').find("select.tindak_lanjut option[value='produk_spesialis']").attr('disabled', true);

            } else if (this.value == 'nok') {
                // $('select').select2('val', '');
                $(this).closest('tr').find('select.tindak_lanjut').val('').trigger('change');
                $(this).closest('tr').find("select.pemeriksaan").attr('disabled', false);
                $(this).closest('tr').find("select.tindak_lanjut option[value='pengemasan']").attr('disabled', true);
                $(this).closest('tr').find("select.tindak_lanjut option[value='perbaikan']").attr('disabled', false);
                $(this).closest('tr').find("select.tindak_lanjut option[value='produk_spesialis']").attr('disabled', false);
            }
        });
    })
</script>
@stop