@extends('adminlte.page')

@section('title', 'Beta Version')

@section('content_header')
<h1 class="m-0 text-dark">Dashboard</h1>
@stop

@section('content')
<!-- <div class="row">
    <div class="col-12 col-sm-6 col-md-2">
        <a href="{{ route('dc.dashboard') }}">
            <div class="info-box">
                <span class="info-box-icon"><img src="{{asset('logo.png')}}" alt="Document Image" /></span>
                <div class="info-box-content">
                    <span class="info-box-text">Dokumen SPA</span>
                </div>
            </div>
        </a>
    </div>
</div> -->
@if(Auth::user()->divisi_id == 3)
<div class="row">
    <div class="col-12">
        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Rencana Produksi</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            <div class="card-body p-0">
                <table class="table table-striped projects" id="production_schedule_table">
                    <thead>
                        <tr>
                            <th style="width: 1%">
                                #
                            </th>
                            <th style="width: 20%">
                                Nama Produk
                            </th>
                            <th style="width: 20%;">
                                Jumlah Produksi
                            </th>
                            <th style="width: 30%;">
                                Tanggal Produksi
                            </th>
                            <th style="width: 20%">
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
            <div class="card-footer text-right">
                <a class="btn btn-info btn-sm" href="#">
                    <i class="fas fa-check">
                    </i>
                    Setujui semua
                </a>
                <a class="btn btn-primary btn-sm" href="#">
                    <i class="fas fa-eye">
                    </i>
                    Detail
                </a>
            </div>
        </div>
        <!-- /.card -->
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h1>Chart</h1>
            </div>
            <div class="card-body">
                <canvas id="produksi-chart"></canvas>
            </div>
        </div>
    </div>
</div>
@else
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <p class="mb-0">You are logged in!</p>
            </div>
        </div>
    </div>
</div>
@endif

@if (isset($event))
<div hidden>
    <div id="data_event">{{ $event }}</div>
</div>
@endif
@stop

@section("adminlte_js")
<script>
    let data_event = JSON.parse($("#data_event").html());
    data_event.forEach((element, index) => {
        $("#production_schedule_table").append(`
        <tr>
            <td style="text-align: center;">
                ${index + 1}
            </td>
            <td>
                <a>
                    ${element.nama}
                </a>
            </td>
            <td>
                ${element.jumlah_produksi}
            </td>
            <td>
                ${element.tanggal_mulai} - ${element.tanggal_selesai}
            </td>
            <td class="project-actions text-right">
                <a class="btn btn-info btn-sm" href="#">
                    <i class="fas fa-check">
                    </i>
                    Setuju
                </a>
                <a class="btn btn-danger btn-sm" href="#">
                    <i class="fas fa-trash">
                    </i>
                    Tolak
                </a>
            </td>
        </tr>
        `)
    });

    let chart_element = document.getElementById("produksi_chart");
</script>
@stop