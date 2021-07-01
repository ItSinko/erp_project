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
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <h4>Info</h4><br>
                        <div class="form-horizontal">
                            <div class="row">
                                <label for="no_seri" class="col-sm-6 col-form-label">No BPPB</label>
                                <div class="col-sm-6 col-form-label" style="text-align:right;">
                                    {{$b->Bppb->no_bppb}}
                                </div>
                            </div>

                            <div class="row">
                                <label for="no_seri" class="col-sm-4 col-form-label">Produk</label>
                                <div class="col-sm-8 col-form-label" style="text-align:right;">
                                    {{$b->Bppb->DetailProduk->nama}}
                                </div>
                            </div>

                            <div class="row">
                                <label for="tanggal" class="col-sm-6 col-form-label">Jumlah Rencana</label>
                                <div class="col-sm-6 col-form-label" style="text-align:right;">
                                    {{$b->Bppb->jumlah}}
                                </div>
                            </div>

                            <div class="row">
                                <label for="tanggal" class="col-sm-6 col-form-label">Karyawan</label>
                                <div class="col-sm-6 col-form-label" style="text-align:right;">
                                    {{$b->Karyawan->nama}}
                                </div>
                            </div>

                            <div class="row">
                                <label for="tanggal" class="col-sm-6 col-form-label">Tanggal</label>
                                <div class="col-sm-6 col-form-label" style="text-align:right;">
                                    {{$b->tanggal}}
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
                    <div class="card-header bg-success">
                        <h3 class="card-title" style="color:white;"><i class="fa fa-plus-circle" aria-hidden="true"></i>&nbsp;Tambahkan Pengemasan</h3>
                    </div>
                    <div class="card-body">
                        <div class="col-md-12">
                            <form action="{{ route('pengemasan.hasil.store', ['id' => $id]) }}" method="post" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                {{ method_field('PUT') }}
                                <div class="form-horizontal">
                                    <h3>Data Pengemasan</h3>
                                    <div class="form-horizontal">
                                        <div class="form-group row">
                                            <label for="kode_barcode" class="col-sm-5 col-form-label" style="text-align:right;">Kode Barcode</label>
                                            <div class="col-sm-1">
                                                <input type="text" class="form-control  @error('inisial_produk') is-invalid @enderror " name="inisial_produk" id="inisial_produk" @if($barcode != "") value="{{old('inisial_produk', $barcode[0])}}" readonly @endif placeholder="Inisial Produk">
                                                @if ($errors->has('inisial_produk'))
                                                <span class="invalid-feedback" role="alert">{{$errors->first('inisial_produk')}}</span>
                                                @endif
                                            </div>
                                            <div class="col-sm-1">
                                                <input type="text" class="form-control  @error('tipe_produk') is-invalid @enderror " name="tipe_produk" id="tipe_produk" @if($barcode != "") value="{{old('tipe_produk', $barcode[1])}}" readonly @endif placeholder="Tipe Produk">
                                                @if ($errors->has('tipe_produk'))
                                                <span class="invalid-feedback" role="alert">{{$errors->first('tipe_produk')}}</span>
                                                @endif
                                            </div>
                                            <div class="col-sm-1">
                                                <input type="text" class="form-control  @error('waktu_produksi') is-invalid @enderror " name="waktu_produksi" id="waktu_produksi" @if($barcode != "") value="{{old('waktu_produksi', $barcode[2])}}" readonly @endif placeholder="Waktu Produksi">
                                                @if ($errors->has('waktu_produksi'))
                                                <span class="invalid-feedback" role="alert">{{$errors->first('waktu_produksi')}}</span>
                                                @endif
                                            </div>
                                            <div class="col-sm-1">
                                                <input type="text" class="form-control  @error('urutan_bb') is-invalid @enderror " name="urutan_bb" id="urutan_bb" @if($barcode != "") value="{{old('urutan_bb', $barcode[3])}}" readonly @endif placeholder="Kedatangan Part">
                                                @if ($errors->has('urutan_bb'))
                                                <span class="invalid-feedback" role="alert">{{$errors->first('urutan_bb')}}</span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group row">
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
                                                        <th rowspan="2">Aksi</th>
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
                                                    <tr>
                                                        <td>1</td>
                                                        <td>
                                                            <div class="form-group">
                                                                <div class="select2-info">
                                                                    <select class="select2 form-control @error('no_seri') is-invalid @enderror no_seri" data-placeholder="Pilih No Seri" data-dropdown-css-class="select2-info" style="width: 100%;" name="no_seri[0]" id="no_seri0">
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
                                                        <td hidden>
                                                            <div class="form-group">
                                                                <input type="text" class="has_barcode" name="has_barcode[0]" id="has_barcode0">
                                                            </div>
                                                        </td>
                                                        <td hidden>
                                                            <div class="form-group">
                                                                <input type="text" class="pemeriksaanke" name="pemeriksaanke[0]" id="pemeriksaanke0">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-group">
                                                                <div class="input-group">
                                                                    <input type="text" class="form-control @error('no_barcode') is-invalid @enderror barcode" name="no_barcode[0]" id="no_barcode0" readonly>
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
                                                                            <input type="radio" name="kondisi_unit[0]" id="ok0" class="kondisi_unit" value="ok" checked>
                                                                            <label for="ok0">
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
                                                                            <input type="radio" name="kondisi_unit[0]" id="nok0" value="nok" class="kondisi_unit">
                                                                            <label for="nok0">
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
                                                                            <input type="radio" name="detail_cek_pengemasan[0][{{$k}}]" id="detail_cek_pengemasan0{{$k}}" class="detail_cek_pengemasan" value="{{$i->id}}" checked>
                                                                            <label for="detail_cek_pengemasan0{{$k}}">
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
                                                                            <input type="radio" name="detail_cek_pengemasan[0][{{$k}}]" id="nok0{{$k}}" value="nok" class="detail_cek_pengemasan">
                                                                            <label for="nok0{{$k}}">
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
                                                            <button type="button" class="btn btn-success karyawan-img-small" style="border-radius:50%;" id="tambahitem" disabled><i class="fas fa-plus-circle"></i></button>
                                                        </td>
                                                    </tr>
                                                </tbody>

                                            </table>
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
                            <button type="submit" class="btn btn-block btn-success rounded-pill" style="width:200px;float:right;" id="tambahlaporan" disabled><i class="fas fa-plus"></i>&nbsp;Tambah Data</button>
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
        var rdb = "";
        var add = 0;

        $('#tableitem').on('change', '.no_seri', function(){
            var no_seri = $(this).closest('tr').find('.no_seri');
            var has_barcode = $(this).closest('tr').find('.has_barcode');
            var no_barcode = $(this).closest('tr').find('.barcode');
            var pemeriksaanke = $(this).closest('tr').find('.pemeriksaanke');
            if(no_seri)
            {
                $.ajax({
                    url: 'hasil/create/getbarcode/' + no_seri,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        if(data != "")
                        {
                            has_barcode.val("yes");
                            
                            if(data[0]['monitoring_proses']['alias_barcode'] != "")
                            {
                                no_barcode.val(data[0]['monitoring_proses']['alias_barcode'].replace("/", "") + data[0]['no_barcode']);
                            }
                            else if(data[0]['pengemasan']['alias_barcode'] != "")
                            {
                                no_barcode.val(data[0]['pengamasan']['alias_barcode'].replace("/", "") + data[0]['no_barcode']);
                            }
                            no_barcode.attr("readonly", true);
                            $('#tambahitem').removeAttr('disabled');
                            $('#tambahlaporan').removeAttr('disabled');
                        }
                        else
                        {
                            has_barcode.val("no");
                            no_barcode.val("");
                            no_barcode.removeAttr("readonly", true);
                            $('#tambahitem').attr('disabled', true);
                            $('#tambahlaporan').attr('disabled', true);
                        }
                    }
                });

                $.ajax({
                    url: 'hasil/create/count_status_histori_perakitan/' + no_seri + '/pemeriksaan_pengemasan',
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        pemeriksaanke.val(data);
                    }
                });
            }
        })

        $('#tableitem').on('change', '.no_seri', function(){
            var no_barcode = $(this).closest('tr').find('.barcode');
            if(no_barcode != "")
            {
                $('#tambahitem').removeAttr('disabled');
                $('#tambahlaporan').removeAttr('disabled');
            }
            else
            {
                $('#tambahitem').attr('disabled', true);
                $('#tambahlaporan').attr('disabled', true);
            }
        })

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
            $('#tambahitem').attr('disabled', true);
            $('#tambahlaporan').attr('disabled', true);
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
            <td hidden>
                <div class="form-group">
                    <input type="text" class="has_barcode" name="has_barcode[` + add + `]" id="has_barcode` + add + `">
                </div>
            </td>
            <td hidden>
                <div class="form-group">
                    <input type="text" class="pemeriksaanke" name="pemeriksaanke[` + add + `]" id="pemeriksaanke` + add + `">
                </div>
            </td>
            <td>
                <div class="form-group">
                    <div class="input-group">
                        <input type="text" class="form-control @error('no_barcode') is-invalid @enderror barcode" name="no_barcode[` + add + `]" id="no_barcode" readonly>
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
                                <input type="radio" name="kondisi_unit[` + add + `]" id="ok` + add + `" class="kondisi_unit" value="baik" checked>
                                <label for="ok` + add + `">
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
                                <input type="radio" name="kondisi_unit[` + add + `]" id="nok` + add + `" value="tidak" class="kondisi_unit">
                                <label for="nok` + add + `">
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