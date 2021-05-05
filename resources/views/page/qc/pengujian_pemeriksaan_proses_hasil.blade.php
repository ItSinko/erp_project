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
                                {{$s->no_bppb}}
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
                                <a href="{{ route('pengujian.monitoring_proses.laporan.edit', ['id' => $id]) }}"><button class="btn btn-warning rounded-pill"><i class="fas fa-edit"></i>&nbsp;Edit</button></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-9">
            <div class="card">
                <!-- /.card-header -->
                <div class="card-body">
                    <h3><i class="fas fa-info-circle"></i>&nbsp;Hasil Monitoring Proses</h3><br>
                    @if ($errors->has('file'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('file') }}</strong>
                    </span>
                    @endif

                    {{-- notifikasi sukses --}}
                    @if ($sukses = Session::get('success'))
                    <div class="alert alert-success alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong>{{ $success }}</strong>
                    </div>
                    @endif

                    <table id="example" class="table table-hover styled-table">
                        <thead style="text-align: center;">
                            <tr>
                                <th rowspan="2">No</th>
                                <th rowspan="2">Pemeriksaan</th>
                                <th rowspan="2">Standar Keberterimaan</th>
                                <th colspan="2">Jumlah</th>
                                <th rowspan="2">Keterangan</th>
                            </tr>
                            <tr>
                                <th><i class="fas fa-check-circle" style="color:green;"></i></th>
                                <th><i class="fas fa-times-circle" style="color:red;"></i></th>
                            </tr>
                        </thead>
                        <tbody style="text-align:center;">

                            @foreach($s->DetailProduk->IkPemeriksaanPengujian as $i)
                            <tr>
                                <td rowspan="{{$i->HasilIkPemeriksaanPengujian->pluck('id')->count()}}">{{$loop->iteration}}</td>
                                <td rowspan="{{$i->HasilIkPemeriksaanPengujian->pluck('id')->count()}}">{{$i->hal_yang_diperiksa}}</td>
                                @foreach($i->HasilIkPemeriksaanPengujian as $j)
                                <td>{{$j->standar_keberterimaan}}</td>
                                <td>{{$s->countMonitoringProses() - $s->countPemeriksaanProses($j->id)}}</td>
                                <td>{{$s->countPemeriksaanProses($j->id)}}</td>
                                <td>@if($s->countPemeriksaanProses($j->id) != 0)<a data-attr="{{route('pengujian.pemeriksaan_proses.not_ok', ['bppb_id' => $s->id, 'ik_pengujian_id' => $j->id])}}">Detail</a>@endif</td>
                            </tr>
                            @endforeach
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</section>
@endsection