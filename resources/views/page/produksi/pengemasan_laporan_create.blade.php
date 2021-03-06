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
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item"><a href="/pengemasan">Pengemasan</a></li>
                    <li class="breadcrumb-item"><a href="/pengemasan/bppb/{{$id}}">Laporan No Seri</a></li>
                    <li class="breadcrumb-item active">Tambah Pengemasan</li>
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
                    <div class="card-header bg-success">
                        <h3 class="card-title" style="color:white;"><i class="fa fa-plus-circle" aria-hidden="true"></i>&nbsp;Tambahkan Pengemasan</h3>
                    </div>
                    <div class="card-body">

                        <div class="col-md-12">
                            <form action="{{ route('pengemasan.laporan.store', ['bppb_id' => $id]) }}" method="post" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                {{ method_field('PUT') }}
                                <h3>Info BPPB</h3>
                                <div class="form-horizontal">
                                    <div class="form-group row">
                                        <label for="no_bppb" class="col-sm-4 col-form-label" style="text-align:right;">No BPPB</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" name="no_bppb" id="no_bppb" value="{{$b->no_bppb}}" style="width: 50%;" readonly>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="nama_produk" class="col-sm-4 col-form-label" style="text-align:right;">Nama Produk</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" name="nama_produk" id="nama_produk" value="{{old('nama_produk', $b->DetailProduk->nama)}}" style="width: 50%;" readonly>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="jumlah" class="col-sm-4 col-form-label" style="text-align:right;">Jumlah Rencana Produksi</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" name="jumlah" id="jumlah" value="{{old('jumlah', $b->jumlah)}}" style="width: 10%;" readonly>
                                        </div>
                                    </div>

                                    <h3>Data Pengemasan</h3>
                                    <div class="form-horizontal">
                                        <div class="form-group row">
                                            <label for="tanggal_laporan" class="col-sm-4 col-form-label" style="text-align:right;">Tanggal Laporan</label>
                                            <div class="col-sm-8">
                                                <input type="date" class="form-control  @error('tanggal_laporan') is-invalid @enderror " name="tanggal_laporan" id="tanggal_laporan" value="{{old('tanggal_laporan')}}" style="width: 20%;">
                                                @if ($errors->has('tanggal_laporan'))
                                                <span class="invalid-feedback" role="alert">{{$errors->first('tanggal_laporan')}}</span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="karyawan_id" class="col-sm-4 col-form-label" style="text-align:right;">Karyawan</label>
                                            <div class="col-sm-5">
                                                <div class="select2-info">
                                                    <select class="select2 custom-select form-control @error('karyawan_id') is-invalid @enderror karyawan_id" data-placeholder="Pilih Operator" data-dropdown-css-class="select2-info" style="width: 100%;" name="karyawan_id" id="karyawan_id" disabled>
                                                        <option value=""></option>
                                                        @foreach($kry as $i)
                                                        <option value="{{$i->id}}">{{$i->nama}}</option>
                                                        @endforeach
                                                    </select>
                                                    @if ($errors->has('karyawan_id'))
                                                    <span class="invalid-feedback" role="alert">{{$errors->first('karyawan_id')}}</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="kode_barcode" class="col-sm-4 col-form-label" style="text-align:right;">Kode Barcode</label>
                                            <div class="col-sm-1">
                                                <input type="text" class="form-control  @error('inisial_produk') is-invalid @enderror " name="inisial_produk" id="inisial_produk" value="{{old('inisial_produk')}}" readonly>
                                                @if ($errors->has('inisial_produk') || $errors->has('tipe_produk') || $errors->has('waktu_produksi') || $errors->first('urutan_bb'))
                                                <span class="invalid-feedback" role="alert">Barcode Harus Diisi</span>
                                                @endif
                                            </div>
                                            <div class="col-sm-1">
                                                <input type="text" class="form-control  @error('tipe_produk') is-invalid @enderror " name="tipe_produk" id="tipe_produk" value="{{old('tipe_produk')}}" readonly>
                                            </div>
                                            <div class="col-sm-1">
                                                <input type="text" class="form-control  @error('waktu_produksi') is-invalid @enderror " name="waktu_produksi" id="waktu_produksi" value="{{old('waktu_produksi')}}" readonly>
                                            </div>
                                            <div class="col-sm-1">
                                                <input type="text" class="form-control  @error('urutan_bb') is-invalid @enderror " name="urutan_bb" id="urutan_bb" value="{{old('urutan_bb')}}" readonly>
                                            </div>

                                        </div>

                                        <div class="form-group row">
                                            <div class="table-responsive">
                                                <table id="tableitem" class="table table-hover table-bordered">
                                                    <thead style="text-align: center;">
                                                        <tr>
                                                            <th rowspan="2">No</th>
                                                            <th rowspan="2">No Seri</th>
                                                            <th rowspan="2" hidden>Has Barcode</th>
                                                            <th rowspan="2">Barcode</th>
                                                            <th rowspan="2">Kondisi Unit</th>
                                                            @foreach($cp as $cps)
                                                            <th colspan="{{count($cps->DetailCekPengemasan)}}">{{$cps->perlengkapan}}</th>
                                                            @endforeach
                                                        </tr>
                                                        <tr>
                                                            @foreach($cp as $cps)
                                                            @foreach($cps->DetailCekPengemasan as $i)
                                                            <th>{{$i->nama_barang}}</th>
                                                            @endforeach
                                                            @endforeach
                                                        </tr>
                                                    </thead>
                                                    <tbody style="text-align:center;">
                                                        @php ($m = 0); @endphp
                                                        @foreach($s as $i)
                                                        <tr>
                                                            <td>{{$loop->iteration}}</td>
                                                            <td>
                                                                <div class="form-group">
                                                                    <input type="text" value="{{$i->HasilPerakitan->id}}" id="no_seri{{$loop->iteration - 1}}" name="no_seri[{{$loop->iteration - 1}}]" hidden>
                                                                    {{$i->HasilPerakitan->Perakitan->alias_tim}}{{$i->HasilPerakitan->no_seri}}
                                                                </div>
                                                            </td>
                                                            <td hidden>
                                                                <input type="text" name="has_barcode[{{$loop->iteration - 1}}]" @if($i->no_barcode != "")
                                                                value = "yes"
                                                                @elseif($i->no_barcode == "")
                                                                value = "no"
                                                                @php ($m = $m + 1); @endphp
                                                                @endif>
                                                            </td>
                                                            <td>
                                                                <div class="form-group">
                                                                    @if($i->no_barcode != "")
                                                                    {{str_replace("/", "", $i->MonitoringProses->alias_barcode)}}{{$i->no_barcode}}
                                                                    @elseif($i->no_barcode == "")
                                                                    <div class="input-group">
                                                                        <input type="text" class="form-control @error('no_barcode') is-invalid @enderror barcode" name="no_barcode[{{$loop->iteration - 1}}]" id="no_barcode{{$loop->iteration - 1}}" value="{{$cbrc + $m}}">
                                                                    </div>
                                                                    @if ($errors->has('no_barcode'))
                                                                    <span class="invalid-feedback" role="alert">{{$errors->first('no_barcode')}}</span>
                                                                    @endif
                                                                    <span id="no_barcode-message[]" role="alert"></span>
                                                                    @endif
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="row">
                                                                    <div class="col-sm-12">
                                                                        <div class="form-group clearfix">
                                                                            <div class="icheck-success d-inline checked">
                                                                                <input type="radio" name="kondisi_unit[{{$loop->iteration - 1}}]" id="ok{{$loop->iteration - 1}}" class="kondisi_unit" value="ok" checked>
                                                                                <label for="ok{{$loop->iteration - 1}}">
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
                                                                                <input type="radio" name="kondisi_unit[{{$loop->iteration - 1}}]" id="nok{{$loop->iteration - 1}}" value="nok" class="kondisi_unit">
                                                                                <label for="nok{{$loop->iteration - 1}}">
                                                                                    <i class="fas fa-times-circle" style="color:red;"></i>
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            @php ($k = 0); ($l = $loop->iteration - 1); @endphp
                                                            @foreach($cp as $cps)
                                                            @foreach($cps->DetailCekPengemasan as $i)
                                                            <td>
                                                                <div class="row">
                                                                    <div class="col-sm-12">
                                                                        <div class="form-group clearfix">
                                                                            <div class="icheck-success d-inline checked">
                                                                                <input type="radio" name="detail_cek_pengemasan[{{$l}}][{{$k}}]" id="detail_cek_pengemasan{{$l}}{{$k}}" class="detail_cek_pengemasan" value="{{$i->id}}" checked>
                                                                                <label for="detail_cek_pengemasan{{$l}}{{$k}}">
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
                                                                                <input type="radio" name="detail_cek_pengemasan[{{$l}}][{{$k}}]" id="nok{{$l}}{{$k}}" value="nok" class="detail_cek_pengemasan">
                                                                                <label for="nok{{$l}}{{$k}}">
                                                                                    <i class="fas fa-times-circle" style="color:red;"></i>
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            @php ($k++); @endphp
                                                            @endforeach
                                                            @endforeach
                                                        </tr>
                                                        @endforeach
                                                    </tbody>

                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <span>
                            <a class="cancelmodal" data-toggle="modal" data-target="#cancelmodal"><button type="button" class="btn btn-block btn-danger rounded-pill" style="width:200px;float:left;"><i class="fas fa-times"></i>&nbsp;Batal</button></a>
                        </span>
                        <span>
                            <button type="submit" class="btn btn-block btn-success rounded-pill" style="width:200px;float:right;" id="tambahdata" disabled><i class="fas fa-plus"></i>&nbsp;Tambah Data</button>
                        </span>
                    </div>
                    </form>
                </div>

            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
        <div class="modal fade" id="cancelmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog modal-md" role="document">
                <div class="modal-content">
                    <div class="modal-header" style="background-color:	#778899;">
                        <h4 class="modal-title" id="myModalLabel" style="color:white;">Keluar Halaman</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body" id="cancel">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body" style="text-align:center;">
                                        <h6>Apakah anda yakin meninggalkan halaman ini?</h6>
                                    </div>
                                    <div class="card-footer col-12" style="margin-bottom: 2%;">
                                        <span>
                                            <button type="button" class="btn btn-block btn-secondary" data-dismiss="modal" id="batalhapussk" style="width:30%;float:left;">Batal</button>
                                        </span>
                                        <span>
                                            <a href="/pengemasan/bppb/{{$id}}" id="cancelform"><button type="submit" class="btn btn-block btn-danger" id="hapussk" style="width:30%;float:right;">Keluar</button></a>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>
@endsection

@section('adminlte_js')
<script>
    $(function() {
        var s = @json($s);

        function arrayLookup(searchValue, array, searchIndex, returnIndex) // Posted on Tathyika.com (also refer for more codes there)
        {
            var returnVal = null;
            var i;
            for (i = 0; i < array.length; i++) {
                if (array[i][searchIndex] == searchValue) {
                    returnVal = array[i][returnIndex];
                    break;
                }
            }
            return returnVal;
        }


        function formatted_string(pad, user_str, pad_pos) {
            if (typeof user_str === 'undefined')
                return pad;
            if (pad_pos == 'l') {
                return (pad + user_str).slice(-pad.length);
            } else {
                return (user_str + pad).substring(0, pad.length);
            }
        }

        $('#tableitem').ready(function() {
            $(this).find("tr").each(function() {
                $(this).find('.barcode').val(formatted_string('00000', $(this).find('.barcode').val(), 'l'));
            });
        });

        var rdb = "";
        var add = 0;
        $('#tanggal_laporan').on('change', function() {
            $('#karyawan_id').removeAttr('disabled');
        });

        $('#karyawan_id').on('change', function() {
            var kry = $(this).val();
            console.log(kry);
            if (kry != null) {
                $('#tambahdata').removeAttr('disabled');
                if (arrayLookup(null, s, 'no_barcode', "yes") == "yes") {
                    $('.barcode').attr('readonly', false);
                    $('#inisial_produk').attr('readonly', false);
                    $('#tipe_produk').attr('readonly', false);
                    $('#waktu_produksi').attr('readonly', false);
                    $('#urutan_bb').attr('readonly', false);
                } else {
                    $('.barcode').attr('readonly', true);
                    $('#inisial_produk').attr('readonly', true);
                    $('#tipe_produk').attr('readonly', true);
                    $('#waktu_produksi').attr('readonly', true);
                    $('#urutan_bb').attr('readonly', true);
                }
            } else if (kry == null) {
                $('.barcode').attr('readonly', true);
                $('#inisial_produk').attr('readonly', true);
                $('#tipe_produk').attr('readonly', true);
                $('#waktu_produksi').attr('readonly', true);
                $('#urutan_bb').attr('readonly', true);
                $('#tambahdata').attr('disabled', true);
            }
        });

        $('input[type="radio"][name="brc"]').on("change", function() {
            if (this.value == 'ya') {
                $('.barcode').attr('readonly', false);
                $('#inisial_produk').attr('readonly', false);
                $('#tipe_produk').attr('readonly', false);
                $('#waktu_produksi').attr('readonly', false);
                $('#urutan_bb').attr('readonly', false);
                rdb = 'ya';
            } else if (this.value == 'tidak') {
                $('.barcode').attr('readonly', true);
                $('#inisial_produk').attr('readonly', true);
                $('#tipe_produk').attr('readonly', true);
                $('#waktu_produksi').attr('readonly', true);
                $('#urutan_bb').attr('readonly', true);
                rdb = 'tidak';
                $('.barcode').val("");
            }
        });

        function numberRows($t) {
            var c = 0 - 2;
            $t.find("tr").each(function(ind, el) {
                $(el).find("td:eq(0)").html(++c);
                // var j = c - 1;
                // $(el).find('input[id="no_barcode"]').attr('name', 'no_barcode[' + j + ']');
                // $(el).find('.no_seri').attr('name', 'no_seri[' + j + ']');
                // $(el).find('.no_seri').attr('id', 'no_seri[' + j + ']');
                // $(el).find('.kondisi_unit').attr('id', 'ok' + j);
                // $(el).find('.kondisi_unit').attr('id', 'nok' + j);
                // $(el).find('.kondisi_unit').attr('name', 'kondisi_unit[' + j + ']');
                // $(el).find('.tindak_lanjut').attr('name', 'tindak_lanjut[' + j + ']');
                // $(el).find('.tindak_lanjut').attr('id', 'tindak_lanjut' + j);
                // $(el).find('textarea[id="keterangan"]').attr('name', 'keterangan[' + j + ']');
                $('.no_seri').select2();
            });
        }

        $('#tambahitem').click(function(e) {
            add++;
            var data = `
            <tr>
            <td></td>
            <td>
                <div class="form-group">
                    <div class="select2-info">
                        <select class="select2 form-control @error('no_seri') is-invalid @enderror no_seri" data-placeholder="Pilih No Seri" data-dropdown-css-class="select2-info" style="width: 100%;" name="no_seri[` + add + `]" id="no_seri` + add + `">
                            <option value=""></option>
                            @foreach($s as $i)
                            <option value="{{$i->HasilPerakitan->id}}">{{$i->HasilPerakitan->no_seri}}
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
                        <input type="text" class="form-control @error('no_barcode') is-invalid @enderror barcode" name="no_barcode[` + add + `]" id="no_barcode" `;
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
                                <input type="radio" name="kondisi_unit[` + add + `]" id="ok" class="kondisi_unit" value="baik" checked>
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
                                <input type="radio" name="kondisi_unit[` + add + `]" id="nok" value="tidak" class="kondisi_unit">
                                <label for="nok">
                                    <i class="fas fa-times-circle" style="color:red;"></i>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </td>
            @php ($k = 0); @endphp
            @foreach($cp as $cps)
            @foreach($cps->DetailCekPengemasan as $i)
            <td>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group clearfix">
                            <div class="icheck-success d-inline checked">
                                <input type="radio" name="detail_cek_pengemasan[` + add + `][{{$k}}][{{$loop->iteration - 1}}]" id="detail_cek_pengemasan` + add + `{{$k}}{{$loop->iteration - 1}}" class="detail_cek_pengemasan" value="{{$i->id}}" checked>
                                <label for="detail_cek_pengemasan` + add + `{{$k}}{{$loop->iteration - 1}}">
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
                                <input type="radio" name="detail_cek_pengemasan[` + add + `][{{$k}}][{{$loop->iteration - 1}}]" id="nok` + add + `{{$k}}{{$loop->iteration - 1}}" value="nok" class="detail_cek_pengemasan">
                                <label for="nok` + add + `{{$k}}{{$loop->iteration - 1}}">
                                    <i class="fas fa-times-circle" style="color:red;"></i>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </td>
            @php ($k++); @endphp
            @endforeach
            @endforeach
            <td>
                <button type="button" class="btn btn-danger karyawan-img-small" style="border-radius:50%;" id="closetable"><i class="fas fa-times-circle"></i></button>
            </td>
        </tr>`;
            $('#tableitem tr:last').after(data);
            numberRows($("#tableitem"));
        });

        $('#tableitem').on('click', '#closetable', function(e) {
            $(this).closest('tr').remove();
            numberRows($("#tableitem"));
        });
    });
</script>
@stop