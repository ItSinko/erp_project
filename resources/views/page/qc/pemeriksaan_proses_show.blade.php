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
                        <h4>Data Info</h4>
                        <ul class="list-group list-group-flush borderless">
                            <li class="list-group-item"><b>Nama Produk</b><a class="float-right"></a></li>
                            <li class="list-group-item"><b>Kelompok Produk</b><a class="float-right">543</a></li>
                            <li class="list-group-item"><b>No BPPB</b><a class="float-right">543</a></li>
                            <li class="list-group-item"><b>Tanggal BPPB</b><a class="float-right">543</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-lg-9">
                <div class="card">
                    <div class="card-body">
                        <nav>
                            <div class="nav nav-tabs nav-justified" id="nav-tab" role="tablist">
                                <a class="nav-item nav-link active" id="nav-rakit-tab" data-toggle="tab" href="#nav-rakit" role="tab" aria-controls="nav-rakit" aria-selected="true">Rakit</a>
                                <a class="nav-item nav-link" id="nav-aging-tab" data-toggle="tab" href="#nav-aging" role="tab" aria-controls="nav-aging" aria-selected="false">Aging</a>
                                <a class="nav-item nav-link" id="nav-kemas-tab" data-toggle="tab" href="#nav-kemas" role="tab" aria-controls="nav-kemas" aria-selected="false">Kemas</a>
                            </div>
                        </nav>
                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="nav-rakit" role="tabpanel" aria-labelledby="nav-rakit-tab">
                                <div class="row">
                                    <div class="col-lg-12">
                                        @if(isset($b->Perakitan))
                                        @if(!isset($pr)) <div class="float-right" style="margin-bottom:1%;margin-top:1%;">
                                            <a class="tambahrakit" href="#"><button class="btn btn-info btn-sm"><i class="fas fa-plus"></i>&nbsp;Tambah</button></a>
                                        </div>
                                        @else
                                        <div class="float-right" style="margin-bottom:1%;margin-top:1%;">
                                            <a class="editrakit" href="#"><button class="btn btn-warning btn-sm"><i class="fas fa-pencil-alt"></i>&nbsp;Ubah</button></a>
                                        </div>
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
                                                    <tr>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="nav-aging" role="tabpanel" aria-labelledby="nav-aging-tab">
                                <div class="row">
                                    <div class="col-lg-12">
                                        @if(isset($b->Pengujian))
                                        @if(!isset($pa)) <div class="float-right" style="margin-bottom:1%;margin-top:1%;">
                                            <a class="tambahaging" href="#"><button class="btn btn-info btn-sm"><i class="fas fa-plus"></i>&nbsp;Tambah</button></a>
                                        </div>
                                        @elseif(isset($pa))
                                        <div class="float-right" style="margin-bottom:1%;margin-top:1%;">
                                            <a class="editaging" href="#"><button class="btn btn-warning btn-sm"><i class="fas fa-pencil-alt"></i>&nbsp;Ubah</button></a>
                                        </div>
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
                                                    @if(isset($pa))
                                                    @foreach($pk as $i)
                                                    <tr>
                                                        <td>{{$loop->iteration}}</td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                    </tr>
                                                    @endforeach
                                                    @elseif(!isset($pa))
                                                    <tr></tr>
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
                                        @if(isset($b->Pengemasan))
                                        @if(!isset($pk)) <div class="float-right" style="margin-bottom:1%;margin-top:1%;">
                                            <a class="tambahkemas" href="/pemeriksaan"><button class="btn btn-info btn-sm"><i class="fas fa-plus"></i>&nbsp;Tambah</button></a>
                                        </div>
                                        @elseif(isset($pk))
                                        <div class="float-right" style="margin-bottom:1%;margin-top:1%;">
                                            <a class="editkemas" href="#"><button class="btn btn-warning btn-sm"><i class="fas fa-pencil-alt"></i>&nbsp;Ubah</button></a>
                                        </div>
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