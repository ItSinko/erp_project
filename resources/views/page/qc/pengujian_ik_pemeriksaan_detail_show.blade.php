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
                    <li class="breadcrumb-item active">Pengujian</li>
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
                    <h3>Info</h3>
                    <div class="form-horizontal">
                        <div class="row">
                            <label for="no_seri" class="col-sm-4 col-form-label">Produk</label>
                            <div class="col-sm-8 col-form-label" style="text-align:right;">
                                {{$sp->nama}}
                            </div>
                        </div>

                        <div class="row">
                            <label for="tanggal" class="col-sm-6 col-form-label">Kelompok Produk</label>
                            <div class="col-sm-6 col-form-label" style="text-align:right;">
                                {{$sp->Produk->KelompokProduk->nama}}
                            </div>
                        </div>

                        <div class="row form-group">
                            <label for="tanggal" class="col-sm-5 col-form-label">Kategori Produk</label>
                            <div class="col-sm-7 col-form-label" style="text-align:right;">
                                {{$sp->Produk->KategoriProduk->nama}}
                            </div>
                        </div>

                        <div class="row">
                            <label for="tanggal" class="col-sm-6 col-form-label text-muted">Ubah</label>
                            <div class="col-sm-6 col-form-label" style="text-align:right;">
                                <a href="{{ route('pengujian.monitoring_proses.laporan.edit', ['id' => $sp->id]) }}"><button class="btn btn-warning rounded-pill"><i class="fas fa-edit"></i>&nbsp;Ubah</button></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-9">
            <div class="card">
                <div class="card-body">
                    <hgroup>
                        <h3 class="card-heading">Pemeriksaan Proses</h3>
                        <h6 class="card-subheading text-muted ">Pengujian</h6>
                    </hgroup>
                    <div class="form-group row">
                        <table id="example" class="table table-hover table-bordered styled-table">
                            <thead style="text-align: center;">
                                <tr>
                                    <th>No</th>
                                    <th>Pemeriksaan</th>
                                    <th>Standar Keberterimaan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody style="text-align:center;">
                                @foreach($s as $i)
                                <tr>
                                    <td rowspan="{{$i->HasilIkPemeriksaanPengujian->pluck('id')->count()}}">{{$loop->iteration}}</td>
                                    <td rowspan="{{$i->HasilIkPemeriksaanPengujian->pluck('id')->count()}}">{{$i->hal_yang_diperiksa}}</td>
                                    @php ($first = true); @endphp
                                    @foreach($i->HasilIkPemeriksaanPengujian as $j)
                                    @if($first == true)
                                    @php ($first = false); @endphp
                                    <td>{{$j->standar_keberterimaan}}</td>
                                    <td rowspan="{{$i->HasilIkPemeriksaanPengujian->pluck('id')->count()}}"><a href="{{route('pengujian.ik_pemeriksaan.hasil.edit', ['id' => $i->id])}}"><button class="btn btn-warning btn-sm m-1" style="border-radius:50%;"><i class="fas fa-pencil-alt"></i></button></a></td>
                                </tr>
                                @elseif($first == false)
                                <tr>
                                    <td>{{$j->standar_keberterimaan}}</td>
                                </tr>
                                @endif
                                @endforeach
                                @endforeach
                            </tbody>
                            <tfoot style="text-align:center;">
                                <tr>
                                    <th>No</th>
                                    <th>Pemeriksaan</th>
                                    <th>Standar Keberterimaan</th>
                                    <th>Aksi</th>
                                </tr>
                            </tfoot>
                        </table>
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