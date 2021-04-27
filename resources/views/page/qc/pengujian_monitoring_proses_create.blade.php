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
                        <h3 class="card-title" style="color:white;"><i class="fa fa-plus-circle" aria-hidden="true"></i>&nbsp;Tambahkan Monitoring Proses</h3>
                    </div>
                    <div class="card-body">

                        <div class="col-md-12">
                            <form action="{{ route('pengujian.monitoring_proses.store') }}" method="post" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <h3>Info BPPB</h3>
                                <div class="form-horizontal">
                                    <div class="form-group row">
                                        <label for="fk_kategori" class="col-sm-4 col-form-label" style="text-align:right;">No BPPB</label>
                                        <div class="col-sm-8">
                                            <select class="form-control select2 select2-info @error('bppb_id') is-invalid @enderror" data-dropdown-css-class="select2-info" data-placeholder="Pilih No BPPB" style="width: 30%;" name="bppb_id">
                                                <option value=""></option>
                                                @foreach($s as $i)
                                                <option value="{{$i->id}}">{{$i->no_bppb}}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('bppb_id'))
                                            <span class="invalid-feedback" role="alert">{{$errors->first('bppb_id')}}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="tipe_produk" class="col-sm-4 col-form-label" style="text-align:right;">Nama Produk</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" name="tipe_produk" id="tipe_produk" value="{{old('tipe_produk')}}" style="width: 50%;" readonly>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="jumlah" class="col-sm-4 col-form-label" style="text-align:right;">Jumlah Rencana Produksi</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" name="jumlah" id="jumlah" value="{{old('jumlah')}}" style="width: 10%;" readonly>
                                        </div>
                                    </div>

                                    <h3>Data Monitoring Proses</h3>
                                    <div class="form-horizontal">
                                        <div class="form-group row">
                                            <label for="tanggal_laporan" class="col-sm-4 col-form-label" style="text-align:right;">Tanggal Laporan</label>
                                            <div class="col-sm-8">
                                                <input type="date" class="form-control" name="tanggal_laporan" id="tanggal_laporan" value="{{old('tanggal_laporan')}}" style="width: 20%;">
                                                @if ($errors->has('tanggal_laporan'))
                                                <span class="invalid-feedback" role="alert">{{$errors->first('tanggal_laporan')}}</span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="karyawan_id" class="col-sm-4 col-form-label" style="text-align:right;">Karyawan</label>
                                            <div class="col-sm-5">
                                                <div class="select2-info">
                                                    <select class="select2 form-control @error('karyawan_id') is-invalid @enderror karyawan_id" data-placeholder="Pilih Operator" data-dropdown-css-class="select2-info" style="width: 100%;" name="karyawan_id[]" id="karyawan_id">
                                                        @foreach($kry as $i)
                                                        <option value="{{$i->id}}">{{$i->nama}}</option>
                                                        @endforeach
                                                    </select>
                                                    @if ($errors->has('karyawan_id'))
                                                    <span class="invalid-feedback" role="alert">{{$errors->first('karyawan_id.*')}}</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <table id="tableitem" class="table table-hover">
                                                <thead style="text-align: center;">
                                                    <tr>
                                                        <th>No</th>
                                                        <th>No Seri</th>
                                                        <th>Barcode</th>
                                                        <th>Hasil Cek</th>
                                                        <th>Keterangan</th>
                                                        <th>Tindak Lanjut</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody style="text-align:center;">
                                                    <tr>
                                                        <td>1</td>
                                                        <td>
                                                            <div class="form-group">
                                                                <div class="select2-info">
                                                                    <select class="select2 form-control @error('no_seri') is-invalid @enderror no_seri" data-placeholder="Pilih No Seri" data-dropdown-css-class="select2-info" style="width: 100%;" name="no_seri[]" id="no_seri">

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
                                                                    <input type="text" class="form-control @error('hasil_perakitans.*.no_barcode') is-invalid @enderror" name="no_barcode[]" id="no_barcode">
                                                                </div>
                                                                @if ($errors->has('no_barcode'))
                                                                <span class="invalid-feedback" role="alert">{{$errors->first('hasil_perakitans.*.no_barcode')}}</span>
                                                                @endif
                                                                <span id="no_barcode-message[]" role="alert"></span>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="row">
                                                                <div class="col-sm-6">
                                                                    <div class="form-group clearfix">
                                                                        <div class="icheck-success d-inline checked">
                                                                            <input type="radio" name="hasil" id="ok" class="hasil" checked>
                                                                            <label for="ok">
                                                                                <i class="fas fa-check-circle" style="color:green;"></i>
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-sm-6">
                                                                    <div class="form-group clearfix">
                                                                        <div class="icheck-danger d-inline">
                                                                            <input type="radio" name="hasil" id="nok" class="hasil">
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
                                                                <div class="input-group">
                                                                    <textarea class="form-control @error('hasil_perakitans.*.keterangan') is-invalid @enderror" name="keterangan[]" id="keterangan"></textarea>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <select class="select2 form-control tindak_lanjut" name="tindak_lanjut[]" id="tindak_lanjut" data-placeholder="Pilih Tindak Lanjut" data-dropdown-css-class="select2-info" style="width: 80%;">
                                                                <option value="pengemasan">Pengemasan</option>
                                                                <option value="perbaikan">Perbaikan</option>
                                                                <option value="produk_spesialis">Produk Spesialis</option>
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <button type="button" class="btn btn-success karyawan-img-small" style="border-radius:50%;" id="tambahitem"><i class="fas fa-plus-circle"></i></button>
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
                            <button type="submit" class="btn btn-block btn-success rounded-pill" style="width:200px;float:right;"><i class="fas fa-plus"></i>&nbsp;Tambah Data</button>
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
        function numberRows($t) {
            var c = 0 - 1;
            $t.find("tr").each(function(ind, el) {
                $(el).find("td:eq(0)").html(++c);
                var j = c - 1;
                $(el).find('input[id="no_barcode"]').attr('name', 'no_barcode[' + j + ']');
                $(el).find('.no_seri').attr('name', 'no_seri[' + j + ']');
                $(el).find('.no_seri').attr('id', 'no_seri[' + j + ']');
                $(el).find('.hasil').attr('id', 'ok' + j);
                $(el).find('.hasil').attr('id', 'nok' + j);
                $(el).find('.hasil').attr('name', 'hasil[' + j + ']');
                $(el).find('.tindak_lanjut').attr('name', 'tindaklanjut[' + j + ']');
                $(el).find('.tindak_lanjut').attr('id', 'tindaklanjut' + j);
                $(el).find('textarea[id="keterangan"]').attr('name', 'keterangan[' + j + ']');
                $('.tindak_lanjut').select2();
                $('.no_seri').select2();
            });
        }

        $('#tambahitem').click(function(e) {
            $('#tableitem tr:last').after(`<tr>
                <td></td>
                <td>
                    <div class="form-group">
                        <div class="select2-info">
                            <select class="select2 form-control @error('no_seri') is-invalid @enderror no_seri" data-placeholder="Pilih No Seri" data-dropdown-css-class="select2-info" style="width: 100%;" name="no_seri[]" id="no_seri">

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
                            <input type="text" class="form-control @error('hasil_perakitans.*.no_barcode') is-invalid @enderror" name="no_barcode[]" id="no_barcode">
                        </div>
                        @if ($errors->has('no_barcode'))
                        <span class="invalid-feedback" role="alert">{{$errors->first('hasil_perakitans.*.no_barcode')}}</span>
                        @endif
                        <span id="no_barcode-message[]" role="alert"></span>
                    </div>
                </td>
                <td>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group clearfix">
                                <div class="icheck-success d-inline checked">
                                    <input type="radio" name="hasil[]" id="ok" class="hasil" checked>
                                    <label for="ok">
                                        <i class="fas fa-check-circle" style="color:green;"></i>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group clearfix">
                                <div class="icheck-danger d-inline">
                                    <input type="radio" name="hasil[]" id="nok" class="hasil">
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
                        <div class="input-group">
                            <textarea class="form-control @error('hasil_perakitans.*.keterangan') is-invalid @enderror" name="keterangan[]" id="keterangan"></textarea>
                        </div>
                    </div>
                </td>
                <td>
                    <select class="select2 form-control tindak_lanjut" name="tindak_lanjut[]" id="tindak_lanjut" data-placeholder="Pilih Tindak Lanjut" data-dropdown-css-class="select2-info" style="width: 80%;">
                        <option value="pengemasan">Pengemasan</option>
                        <option value="perbaikan">Perbaikan</option>
                        <option value="produk_spesialis">Produk Spesialis</option>
                    </select>
                </td>
                <td>
                    <button type="button" class="btn btn-danger karyawan-img-small" style="border-radius:50%;" id="closetable"><i class="fas fa-times-circle"></i></button>
                </td>
            </tr>`);
            numberRows($("#tableitem"));
        });

        $('#tableitem').on('click', '#closetable', function(e) {
            $(this).closest('tr').remove();
            numberRows($("#tableitem"));
        });
    })
</script>
@stop