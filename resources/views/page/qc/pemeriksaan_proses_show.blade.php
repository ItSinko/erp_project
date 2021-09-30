@extends('adminlte.page')

@section('title', 'Beta Version')

@section('content_header')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Pemeriksaan Proses</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Pemeriksaan Proses</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
@stop

@section('adminlte_css')
<style>
    .borderless {
        border: 0 none;
    }
</style>
@endsection

@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3">
                <div class="card">
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item borderless">
                                <h4>Data Info</h4>
                            </li>
                            <li class="list-group-item borderless"><b>Nama Produk</b><a class="float-right"></a></li>
                            <li class="list-group-item borderless"><b>Kelompok Produk</b><a class="float-right">543</a></li>
                            <li class="list-group-item borderless"><b>No BPPB</b><a class="float-right">543</a></li>
                            <li class="list-group-item borderless"><b>Tanggal BPPB</b><a class="float-right">543</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-lg-9">
                <div class="card">
                    <div class="card-body">
                        <nav>
                            <div class="nav nav-tabs nav-justified" id="nav-tab" role="tablist">
                                <a class="nav-item nav-link active" id="nav-rakit-tab" data-toggle="tab" href="#nav-rakit" role="tab" aria-controls="nav-rakit" aria-selected="true">
                                    Rakit
                                </a>
                                <a class="nav-item nav-link" id="nav-aging-tab" data-toggle="tab" href="#nav-aging" role="tab" aria-controls="nav-aging" aria-selected="false">
                                    Aging
                                </a>
                                <a class="nav-item nav-link" id="nav-kemas-tab" data-toggle="tab" href="#nav-kemas" role="tab" aria-controls="nav-kemas" aria-selected="false">
                                    Kemas
                                </a>
                            </div>
                        </nav>
                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="nav-rakit" role="tabpanel" aria-labelledby="nav-rakit-tab">
                                <div class="row">
                                    <div class="col-lg-12">
                                        @if(count($b->Perakitan) > 0)
                                        @if(count($pr) <= 0) <div class="float-right" style="margin-bottom:1%;margin-top:1%;">
                                            <a class="tambahrakit" href="{{route('pemeriksaan_proses.create',  ['bppb_id' => $bppb_id, 'proses' => 'Perakitan'])}}"><button class="btn btn-info btn-sm"><i class="fas fa-plus"></i>&nbsp;Tambah</button></a>
                                    </div>
                                    @elseif(count($pr) > 0)
                                    <div class="float-right" style="margin-bottom:1%;margin-top:1%;">
                                    </div>
                                    <!-- <div class="float-right" style="margin-bottom:1%;margin-top:1%;">
                                        <a class="editrakit" href="#"><button class="btn btn-warning btn-sm"><i class="fas fa-pencil-alt"></i>&nbsp;Ubah</button></a>
                                    </div> -->
                                    @endif

                                    @endif
                                    <div class="table-responsive">
                                        <table class="table table-striped" id="rakittable">
                                            <thead style="text-align:center;">
                                                <tr>
                                                    <th rowspan="2">No</th>
                                                    <th rowspan="2">Hal yang diperiksa</th>
                                                    <th rowspan="2">Standar Keberterimaan</th>
                                                    <th rowspan="2">Jumlah</th>
                                                    <th colspan="2">Hasil</th>
                                                    <th rowspan="2">Tindak Lanjut</th>
                                                    <th rowspan="2">Keterangan</th>
                                                </tr>
                                                <tr>
                                                    <th><i class="fas fa-check" style="color:green;"></i></th>
                                                    <th><i class="fas fa-times" style="color:red;"></i></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if(count($pr) <= 0) <tr style="text-align:center;">
                                                    <td colspan="12"><i>Data Belum tersedia</i></td>
                                                    </tr>
                                                    @elseif(count($pr)> 0)
                                                    @foreach($lr as $i)
                                                    <tr>
                                                        <td rowspan="{{count($i->DetailIkPemeriksaan)}}">{{$loop->iteration}}</td>
                                                        <td rowspan="{{count($i->DetailIkPemeriksaan)}}">{{$i->pemeriksaan}}</td>
                                                        @foreach($i->DetailIkPemeriksaan as $j)
                                                        <?php $first = 0; ?>
                                                        @if ($first == 0)
                                                        <?php $first = 1; ?>
                                                        <td>{{$j->penerimaan}}</td>
                                                        @foreach($pr as $k)
                                                        @if($k->detail_ik_pemeriksaan_id == $j->id)
                                                        <td>{{$k->jumlah}}</td>
                                                        <td>{{$k->hasil_ok}}</td>
                                                        <td>{{$k->hasil_nok}}</td>
                                                        <td>{{$k->tindak_lanjut}}</td>
                                                        <td>{{$k->keterangan}}</td>
                                                        @endif
                                                        @endforeach
                                                    </tr>
                                                    @elseif($first == 1)
                                                    <tr>
                                                        <td>{{$j->penerimaan}}</td>
                                                        @foreach($pr as $k)
                                                        @if($k->detail_ik_pemeriksaan_id == $j->id)
                                                        <td>{{$k->jumlah}}</td>
                                                        <td>{{$k->hasil_ok}}</td>
                                                        <td>{{$k->hasil_nok}}</td>
                                                        <td>{{$k->tindak_lanjut}}</td>
                                                        <td>{{$k->keterangan}}</td>
                                                        @endif
                                                        @endforeach
                                                    </tr>
                                                    @endif
                                                    @endforeach
                                                    @endforeach
                                                    @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="nav-aging" role="tabpanel" aria-labelledby="nav-aging-tab">
                            <div class="row">
                                <div class="col-lg-12">
                                    @if(count($b->MonitoringProses) > 0)
                                    @if(count($pa) <= 0) <div class="float-right" style="margin-bottom:1%;margin-top:1%;">
                                        <a class="tambahaging" href="{{route('pemeriksaan_proses.create',  ['bppb_id' => $bppb_id, 'proses' => 'Pengujian'])}}"><button class="btn btn-info btn-sm"><i class="fas fa-plus"></i>&nbsp;Tambah</button></a>
                                </div>
                                @elseif(count($pa) > 0)
                                <div class="float-right" style="margin-bottom:1%;margin-top:1%;">
                                </div>
                                <!-- <div class="float-right" style="margin-bottom:1%;margin-top:1%;">
                                    <a class="editaging" href="#"><button class="btn btn-warning btn-sm"><i class="fas fa-pencil-alt"></i>&nbsp;Ubah</button></a>
                                </div> -->
                                @endif
                                @endif
                                <div class="table-responsive">
                                    <table class="table table-striped" id="agingtable">
                                        <thead style="text-align:center;">
                                            <tr>
                                                <th rowspan="2">No</th>
                                                <th rowspan="2">Hal yang diperiksa</th>
                                                <th rowspan="2">Standar Keberterimaan</th>
                                                <th rowspan="2">Jumlah</th>
                                                <th colspan="2">Hasil</th>
                                                <th rowspan="2">Tindak Lanjut</th>
                                                <th rowspan="2">Keterangan</th>
                                            </tr>
                                            <tr>
                                                <th><i class="fas fa-check" style="color:green;"></i></th>
                                                <th><i class="fas fa-times" style="color:red;"></i></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if(count($pa) <= 0) <tr style="text-align:center;">
                                                <td colspan="12"><i>Data Belum tersedia</i></td>
                                                </tr>
                                                @elseif(count($pa)> 0)
                                                @foreach($la as $i)
                                                <tr>
                                                    <td rowspan="{{count($i->DetailIkPemeriksaan)}}">{{$loop->iteration}}</td>
                                                    <td rowspan="{{count($i->DetailIkPemeriksaan)}}">{{$i->pemeriksaan}}</td>
                                                    @foreach($i->DetailIkPemeriksaan as $j)
                                                    <?php $first = 0; ?>
                                                    @if ($first == 0)
                                                    <?php $first = 1; ?>
                                                    <td>{{$j->penerimaan}}</td>
                                                    @foreach($pa as $k)
                                                    @if($k->detail_ik_pemeriksaan_id == $j->id)
                                                    <td>{{$k->jumlah}}</td>
                                                    <td>{{$k->hasil_ok}}</td>
                                                    <td>{{$k->hasil_nok}}</td>
                                                    <td>{{$k->tindak_lanjut}}</td>
                                                    <td>{{$k->keterangan}}</td>
                                                    @endif
                                                    @endforeach
                                                </tr>
                                                @elseif($first == 1)
                                                <tr>
                                                    <td>{{$j->penerimaan}}</td>
                                                    @foreach($pa as $k)
                                                    @if($k->detail_ik_pemeriksaan_id == $j->id)
                                                    <td>{{$k->jumlah}}</td>
                                                    <td>{{$k->hasil_ok}}</td>
                                                    <td>{{$k->hasil_nok}}</td>
                                                    <td>{{$k->tindak_lanjut}}</td>
                                                    <td>{{$k->keterangan}}</td>
                                                    @endif
                                                    @endforeach
                                                </tr>
                                                @endif
                                                @endforeach
                                                @endforeach
                                                @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="nav-kemas" role="tabpanel" aria-labelledby="nav-kemas-tab">
                        <div class="row">
                            <div class="col-lg-12">
                                @if(count($b->Pengemasan) > 0)
                                @if(count($pk) <= 0) <div class="float-right" style="margin-bottom:1%;margin-top:1%;">
                                    <a class="tambahkemas" href="{{route('pemeriksaan_proses.create',  ['bppb_id' => $bppb_id, 'proses' => 'Pengujian'])}}"><button class="btn btn-info btn-sm"><i class="fas fa-plus"></i>&nbsp;Tambah</button></a>
                            </div>
                            @elseif(count($pk) > 0)
                            <div class="float-right" style="margin-bottom:1%;margin-top:1%;">
                            </div>
                            <!-- <div class="float-right" style="margin-bottom:1%;margin-top:1%;">
                                <a class="editkemas" href="#"><button class="btn btn-warning btn-sm"><i class="fas fa-pencil-alt"></i>&nbsp;Ubah</button></a>
                            </div> -->
                            @endif
                            @endif
                            <div class="table-responsive">
                                <table class="table table-striped" id="kemastable">
                                    <thead style="text-align:center;">
                                        <tr>
                                            <th rowspan="2">No</th>
                                            <th rowspan="2">Hal yang diperiksa</th>
                                            <th rowspan="2">Standar Keberterimaan</th>
                                            <th rowspan="2">Jumlah</th>
                                            <th colspan="2">Hasil</th>
                                            <th rowspan="2">Tindak Lanjut</th>
                                            <th rowspan="2">Keterangan</th>
                                        </tr>
                                        <tr>
                                            <th><i class="fas fa-check" style="color:green;"></i></th>
                                            <th><i class="fas fa-times" style="color:red;"></i></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(count($pk) <= 0) <tr style="text-align:center;">
                                            <td colspan="12"><i>Data Belum tersedia</i></td>
                                            </tr>
                                            @elseif(count($pk)> 0)
                                            @foreach($lk as $i)
                                            <tr>
                                                <td rowspan="{{count($i->DetailIkPemeriksaan)}}">{{$loop->iteration}}</td>
                                                <td rowspan="{{count($i->DetailIkPemeriksaan)}}">{{$i->pemeriksaan}}</td>
                                                @foreach($i->DetailIkPemeriksaan as $j)
                                                <?php $first = 0; ?>
                                                @if ($first == 0)
                                                <?php $first = 1; ?>
                                                <td>{{$j->penerimaan}}</td>
                                                @foreach($pk as $k)
                                                @if($k->detail_ik_pemeriksaan_id == $j->id)
                                                <td>{{$k->jumlah}}</td>
                                                <td>{{$k->hasil_ok}}</td>
                                                <td>{{$k->hasil_nok}}</td>
                                                <td>{{$k->tindak_lanjut}}</td>
                                                <td>{{$k->keterangan}}</td>
                                                @endif
                                                @endforeach
                                            </tr>
                                            @elseif($first == 1)
                                            <tr>
                                                <td>{{$j->penerimaan}}</td>
                                                @foreach($pk as $k)
                                                @if($k->detail_ik_pemeriksaan_id == $j->id)
                                                <td>{{$k->jumlah}}</td>
                                                <td>{{$k->hasil_ok}}</td>
                                                <td>{{$k->hasil_nok}}</td>
                                                <td>{{$k->tindak_lanjut}}</td>
                                                <td>{{$k->keterangan}}</td>
                                                @endif
                                                @endforeach
                                            </tr>
                                            @endif
                                            @endforeach
                                            @endforeach
                                            @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
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
        function tableview() {
            $.ajax({
                url: "/pemeriksaan_proses/show/" + "{{$bppb_id}}" + "/Perakitan",
                type: "GET",
                dataType: "json",
                success: function(data) {
                    console.log(data);
                    var datas = "";
                    var count = 1;
                    if (data != "") {
                        for (var i = 0; i < data.length; i++) {
                            for (var j = 0; j < data[i]['list_ik_pemeriksaan'].length; j++) {
                                var first = 0;
                                datas += `<tr>
                            <td rowspan="` + data[i]['list_ik_pemeriksaan'][j]['detail_ik_pemeriksaan'].length + `">` + count++ + `</td>
                            <td rowspan="` + data[i]['list_ik_pemeriksaan'][j]['detail_ik_pemeriksaan'].length + `">` + data[i]['list_ik_pemeriksaan'][j]['pemeriksaan'] + `</td>`;
                                for (var k = 0; k < data[i]['list_ik_pemeriksaan'][j]['detail_ik_pemeriksaan'].length; k++) {
                                    if (first == 0) {
                                        first = 1;
                                        datas += `<td>` + data[i]['list_ik_pemeriksaan'][j]['detail_ik_pemeriksaan'][k]['penerimaan'] + `</td>
                                </tr>`;
                                    } else if (first == 1) {
                                        datas += `<tr>
                                <td>` + data[i]['list_ik_pemeriksaan'][j]['detail_ik_pemeriksaan'][k]['penerimaan'] + `</td>
                                </tr>`;
                                    }
                                }
                            }
                        }
                        $(".editikperakitan").attr('href', '/ik_pemeriksaan/edit/' + data['id']);
                        $(".editikperakitan").removeAttr('hidden');
                        $(".tambahikperakitan").attr('hidden', true);
                    } else if (data == "") {
                        datas += `<tr><td colspan="3"  style="text-align:center;"><i>Tidak Ada Data</i></td></tr>`;
                        $(".tambahikperakitan").attr('href', '/ik_pemeriksaan/create/' + produk + '/Perakitan');
                        $(".tambahikperakitan").removeAttr('hidden');
                        $(".editikperakitan").attr('hidden', true);
                    }
                    $('#perakitan-table tbody').html(datas);
                },
            })
        }
    });
</script>
@endsection