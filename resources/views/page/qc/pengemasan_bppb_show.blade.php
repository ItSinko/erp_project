@extends('adminlte.page')

@section('title', 'Beta Version')

@section('adminlte_css')
<style>
    .dt-body-left {
        text-align: left;
    }
</style>
@endsection

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
    <div class="row">
        <div class="col-3">
            <div class="card">
                <div class="card-body">
                    <h4>Info</h4><br>
                    <div class="form-horizontal">
                        <div class="row">
                            <label for="no_seri" class="col-sm-6 col-form-label">No BPPB</label>
                            <div class="col-sm-6 col-form-label" style="text-align:right;">
                                {{$s->no_bppb}}
                            </div>
                        </div>

                        <div class="row">
                            <label for="no_seri" class="col-sm-6 col-form-label">Tanggal BPPB</label>
                            <div class="col-sm-6 col-form-label" style="text-align:right;">
                                {{$s->tanggal_bppb}}
                            </div>
                        </div>

                        <div class="row">
                            <label for="no_seri" class="col-sm-4 col-form-label">Produk</label>
                            <div class="col-sm-8 col-form-label" style="text-align:right;">
                                {{$s->DetailProduk->nama}}
                            </div>
                        </div>

                        <div class="row">
                            <label for="tanggal" class="col-sm-6 col-form-label text-muted">Ubah Pemeriksaan</label>
                            <div class="col-sm-6 col-form-label" style="text-align:right;">
                                <a href="{{ route('pengemasan.bppb.edit.qc', ['bppbid' => $bppbid]) }}"><button class="btn btn-warning rounded-pill"><i class="fas fa-edit"></i>&nbsp;Edit</button></a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="col-9">
            <div class="card">
                <div class="card-body">
                    <h4>Pengemasan</h4><br>
                    <div class="table-responsive">
                        <table id="example1" class="table table-hover table-bordered styled-table">
                            <thead style="text-align: center;">
                                <tr style="text-align: right;">
                                    <th colspan="12"><button class="btn btn-sm btn-success" id="tambahlaporan" disabled><i class="fas fa-plus"></i>&nbsp; Tambah Pengemasan</button></th>
                                </tr>
                                <tr>
                                    <th rowspan="2">#</th>
                                    <th rowspan="2">No Seri</th>
                                    <th rowspan="2">Barcode</th>
                                    <th rowspan="2">Kondisi Unit</th>
                                    @foreach($c as $cs)
                                    <th colspan="{{count($cs->DetailCekPengemasan)}}">{{$cs->perlengkapan}}</th>
                                    @endforeach
                                    <th rowspan="2">Hasil</th>
                                    <th rowspan="2">Keterangan</th>
                                    <th rowspan="2">Tindak Lanjut</th>
                                    <th rowspan="2">Aksi</th>
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
                                    <td><input type="checkbox" class="hasil_pengemasan_id" id="hasil_pengemasan_id" name="hasil_pengemasan_id[]" value="{{$i->id}}" @if($i->hasil != "")
                                        disabled
                                        @endif></td>
                                    <td>{{$i->HasilPerakitan->Perakitan->alias_tim}}{{$i->HasilPerakitan->no_seri}}</td>
                                    <td>
                                    @if($i->no_barcode != "")
                                    {{str_replace("/", "", $i->Pengemasan->alias_barcode)}}{{$i->no_barcode}}
                                    @else
                                    {{str_replace("/", "", $i->HasilPerakitan->HasilMonitoringProses->first()->MonitoringProses->alias_barcode)}}{{$i->HasilPerakitan->HasilMonitoringProses->first()->no_barcode}}
                                    @endif</td>
                                    <td>
                                        @if($i->kondisi_unit == "baik")
                                        <i class="fas fa-check-circle" style="color:green;"></i>
                                        @elseif($i->kondisi_unit == "tidak")
                                        <i class="fas fa-times-circle" style="color:red;"></i>
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
                                        @if($i->hasil == "ok")
                                        <i class="fas fa-check-circle" style="color:green;"></i>
                                        @elseif($i->hasil == "nok")
                                        <i class="fas fa-times-circle" style="color:red;"></i>
                                        @endif
                                    </td>
                                    <td>{{$i->keterangan}}</td>
                                    <td>{{str_replace("_", " ", ucfirst($i->tindak_lanjut))}}</td>
                                    <td>@if($i->status == 'req_pengemasan')
                                        <a href="/pengemasan/hasil/edit/qc/{{$i->id}}">
                                            <button type="button" class="btn btn-info btn-sm m-1" style="border-radius:50%;"><i class="fas fa-cog"></i></button>
                                            <div><small>Periksa </small></div>
                                        </a>
                                        @elseif($i->status == 'rej_pengemasan')
                                            @if($i->tindak_lanjut == "perbaikan")
                                            <div><small class="danger-text">Perbaikan</small></div>
                                            @elseif($i->tindak_lanjut == "produk_spesialis")
                                            <div><small class="danger-text">Analisa Produk Spesialis</small></div>
                                            @endif
                                        @elseif($i->status == "perbaikan_pengemasan")
                                        <div><small class="danger-text">Perbaikan</small></div>
                                        @elseif($i->status == "analisa_pengemasan_ps")
                                        <div><small class="danger-text">Analisa Produk Spesialis</small></div>    
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="monitoringprosesmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header" style="background-color:	#006400;">
                            <h4 class="modal-title" id="myModalLabel" style="color:white;">Laporan</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="modal-body" id="monitoringproses">

                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="pemeriksaanprosesmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header" style="background-color:	#006400;">
                            <h4 class="modal-title" id="myModalLabel" style="color:white;">Laporan</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="modal-body" id="pemeriksaanproses">

                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="deletemodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog modal-md" role="document">
                    <div class="modal-content">
                        <div class="modal-header" style="background-color:#cc0000;">
                            <h4 class="modal-title" id="myModalLabel" style="color:white;">Hapus Laporan</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="modal-body" id="delete">

                        </div>
                    </div>
                </div>
            </div>

            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</section>
@endsection

@section('adminlte_js')
<script>
    $(function() {
        $("#example1").on('change', '.hasil_pengemasan_id', function() {
            var cbox = $('.hasil_pengemasan_id:checkbox:checked');
            if (cbox.length <= 0) {
                $("#tambahlaporan").attr('disabled', true)
            } else if (cbox.length > 0) {
                $("#tambahlaporan").removeAttr('disabled');
            }
        });

        $("#tambahlaporan").on('click', function() {
            var arr = [];
            $(".hasil_pengemasan_id:checkbox:checked").each(function() {
                arr.push($(this).val());
            });
            if (arr.length > 0) {
                window.location.href = "/pengemasan/bppb/create/qc/{{$bppbid}}/" + arr;
            }
        });
        $('#example1').DataTable({
            scrollX: true
        });
    })
</script>
@endsection