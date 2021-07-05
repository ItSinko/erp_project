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
                            <form action="{{ route('pengemasan.bppb.update.qc', ['bppbid' => $bppbid]) }}" method="post" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                {{ method_field('PUT') }}
                                <h3>Info BPPB</h3>
                                <div class="form-horizontal">
                                    <div class="form-group row">
                                        <label for="no_bppb" class="col-sm-4 col-form-label" style="text-align:right;">No BPPB</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" name="no_bppb" id="no_bppb" value="{{$s->no_bppb}}" style="width: 50%;" readonly>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="nama_produk" class="col-sm-4 col-form-label" style="text-align:right;">Nama Produk</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" name="nama_produk" id="nama_produk" value="{{old('nama_produk', $s->DetailProduk->nama)}}" style="width: 50%;" readonly>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="jumlah" class="col-sm-4 col-form-label" style="text-align:right;">Jumlah Rencana Produksi</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" name="jumlah" id="jumlah" value="{{old('jumlah', $s->jumlah)}}" style="width: 10%;" readonly>
                                        </div>
                                    </div>

                                    <h3>Data Pengemasan</h3>
                                    <div class="form-horizontal">
                                        <div class="form-group row">
                                        <div class="table-responsive">
                                            <table id="tableitem" class="table table-hover table-bordered">
                                                <thead style="text-align: center;">
                                                    <tr>
                                                        <th rowspan="2">No</th>
                                                        <th rowspan="2">Kode Perakitan</th>
                                                        <th rowspan="2">Barcode</th>
                                                        <th rowspan="2" hidden>Pemeriksaan</th>
                                                        <th rowspan="2">Kondisi Unit</th>
                                                        @foreach($c as $cps)
                                                        <th colspan="{{count($cps->DetailCekPengemasan)}}">{{$cps->perlengkapan}}</th>
                                                        @endforeach
                                                        <th rowspan="2">Hasil</th>
                                                        <th rowspan="2">Keterangan</th>
                                                        <th rowspan="2">Tindak Lanjut</th>
                                                    </tr>
                                                    <tr>
                                                        @foreach($c as $cs)
                                                        @foreach($cs->DetailCekPengemasan as $i)
                                                        <th>{{$i->nama_barang}}</th>
                                                        @endforeach
                                                        @endforeach
                                                    </tr>
                                                </thead>
                                                <tbody style="text-align:center;">
                                                    @foreach($hp as $i)
                                                    <tr>
                                                        <td>{{$loop->iteration}}</td>
                                                        <td>
                                                            <input type="text" name="hasil_pengemasan_id[{{$loop->iteration - 1}}]" id="hasil_pengemasan_id" value="{{$i->id}}" hidden>{{$i->HasilPerakitan->no_seri}}
                                                        </td>
                                                        <td>
                                                        @if($i->no_barcode != "")
                                                        {{str_replace("/", "", $i->Pengemasan->alias_barcode)}}{{$i->no_barcode}}
                                                        @else
                                                        {{str_replace("/", "", $i->HasilPerakitan->HasilMonitoringProses->first()->MonitoringProses->alias_barcode)}}{{$i->HasilPerakitan->HasilMonitoringProses->first()->no_barcode}}
                                                        @endif
                                                        </td>
                                                        <td hidden><input type="text" class="pemeriksaan_ke" name="pemeriksaan_ke[{{$loop->iteration - 1}}]" id="pemeriksaan_ke" value="{{$i->countStatus('pemeriksaan_pengemasan')}}" hidden></td>
                                                        <td>
                                                            @if($i->kondisi_unit == "tidak")
                                                            <i class="fas fa-times-circle" style="color:red;"></i>
                                                            @elseif($i->kondisi_unit == "baik")
                                                            <i class="fas fa-check-circle" style="color:green;"></i>
                                                            @endif
                                                        </td>
                                                        @foreach($c as $cs)
                                                        @foreach($cs->DetailCekPengemasan as $h)
                                                        <td>@if($i->DetailCekPengemasan->contains('id', $h->id))
                                                            <i class="fas fa-check" style="color:green;"></i>
                                                            @else
                                                            <i class="fas fa-times" style="color:red;"></i>
                                                            @endif
                                                        </td>
                                                        @endforeach
                                                        @endforeach
                                                        <td>
                                                            <div class="row">
                                                                <div class="col-sm-12">
                                                                    <div class="form-group clearfix">
                                                                        <div class="icheck-success d-inline checked">
                                                                            <input type="radio" name="hasil[{{$loop->iteration - 1}}]" id="ok{{$loop->iteration - 1}}" class="hasil" value="ok" checked>
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
                                                                            <input type="radio" name="hasil[{{$loop->iteration - 1}}]" id="nok{{$loop->iteration - 1}}" value="nok" class="hasil">
                                                                            <label for="nok{{$loop->iteration - 1}}">
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
                                                                    <textarea class="form-control @error('keterangan') is-invalid @enderror" name="keterangan[{{$loop->iteration - 1}}]" id="keterangan"></textarea>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <select class="select2 custom-select form-control tindak_lanjut  @error('tindak_lanjut') is-invalid @enderror " name="tindak_lanjut[{{$loop->iteration - 1}}]" id="tindak_lanjut{{$loop->iteration - 1}}" data-placeholder="Pilih Tindak Lanjut" data-dropdown-css-class="select2-info" style="width: 80%;">
                                                                <option value="ok">OK</option>
                                                                <option value="perbaikan" disabled>Perbaikan</option>
                                                                <option value="produk_spesialis" disabled>Produk Spesialis</option>
                                                            </select>
                                                            @if ($errors->has('tindak_lanjut'))
                                                            <span class="invalid-feedback" role="alert">{{$errors->first('tindak_lanjut')}}</span>
                                                            @endif
                                                        </td>
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
        var rdb = "";
        var add = 0;
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
                $('.tindak_lanjut').select2();
                $('.no_seri').select2();
            });
        }

        $('#tableitem').on('change', '.hasil', function(e) {
            var hasil = $(this).closest('tr').find('.hasil');
            var pemeriksaan_ke = $(this).closest('tr').find('.pemeriksaan_ke');
            if (this.value == 'ok') {
                // $('select').select2('val', '');
                $(this).closest('tr').find('select.tindak_lanjut').val('').trigger('change');
                $(this).closest('tr').find("select.tindak_lanjut option[value='ok']").attr('disabled', false);
                $(this).closest('tr').find("select.tindak_lanjut option[value='perbaikan']").attr('disabled', true);
                $(this).closest('tr').find("select.tindak_lanjut option[value='produk_spesialis']").attr('disabled', true);

            } else if (this.value == 'nok') {
                // $('select').select2('val', '');
                $(this).closest('tr').find('select.tindak_lanjut').val('').trigger('change');
                $(this).closest('tr').find("select.tindak_lanjut option[value='ok']").attr('disabled', true);
                $(this).closest('tr').find("select.tindak_lanjut option[value='perbaikan']").attr('disabled', false);
                $(this).closest('tr').find("select.tindak_lanjut option[value='produk_spesialis']").attr('disabled', false);
            }
        });
    });
</script>
@stop