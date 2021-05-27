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
                            <label for="tanggal" class="col-sm-6 col-form-label">Tanggal Laporan</label>
                            <div class="col-sm-6 col-form-label" style="text-align:right;">
                                {{date("d-m-Y", strtotime($s->tanggal))}}
                            </div>
                        </div>

                        <div class="row">
                            <label for="tanggal" class="col-sm-6 col-form-label">Operator</label>
                            <div class="col-sm-6 col-form-label" style="text-align:right;">
                                {{$s->Karyawan->nama}}
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="col-9">
            <div class="card">
                <div class="card-body">
                    <h4>Monitoring Proses</h4><br>
                    <table id="example1" class="table table-hover table-bordered styled-table">
                        <thead style="text-align: center;">
                            <tr>
                                <th rowspan="2">No</th>
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
                                <td>{{$loop->iteration}}</td>
                                <td>{{$i->HasilPerakitan->no_seri}}</td>
                                <td>{{$i->no_barcode}}</td>
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
                                    <i class="fas fa-check-circle" style="color:green;"></i>
                                    @else
                                    <i class="fas fa-times-circle" style="color:red;"></i>
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
                                <td>{{ucfirst($i->tindak_lanjut)}}</td>
                                <td>@if($i->status == 'req_perbaikan')
                                    <a href="/perbaikan/produksi/create/{{$i->id}}/pengemasan">
                                        <button type="button" class="btn btn-info btn-sm m-1" style="border-radius:50%;"><i class="fas fa-paper-plane"></i></button>
                                        <div><small>Perbaikan </small></div>
                                    </a>
                                    @elseif($i->status == 'acc_perbaikan')
                                    <small class="danger-text">Perbaikan</small>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
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
        $('#example1').DataTable({
            scrollX: true
        });
    })
</script>
@endsection