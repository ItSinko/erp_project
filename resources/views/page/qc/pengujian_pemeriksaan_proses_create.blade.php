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
    <div class="row">
        <div class="col-3">
            <div class="card">
                <div class="card-body">
                    <h3>Info</h3>

                </div>
            </div>
        </div>
        <div class="col-9">
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
            <form action="{{route('pengujian.pemeriksaan_proses.store', ['id' => $b->id])}}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                {{ method_field('PUT') }}
                <div class="card">
                    <div class="card-header bg-success">
                        <div class="card-title">Pemeriksaan Proses</div>
                    </div>
                    <div class="card-body">
                        <h3>Pemeriksaan</h3>
                        <div class="form-horizontal">
                            <div class="form-group row">
                                <label for="no_pemeriksaan" class="col-sm-5 col-form-label" style="text-align:right;">No Pemeriksaan</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control @error('no_pemeriksaan') is-invalid @enderror" name="no_pemeriksaan" id="no_pemeriksaan" value="" style="width: 50%;">
                                </div>
                                @if ($errors->has('no_pemeriksaan'))
                                <span class="invalid-feedback" role="alert">{{$errors->first('no_pemeriksaan')}}</span>
                                @endif
                            </div>

                            <div class="form-group row">
                                <label for="tanggal" class="col-sm-5 col-form-label" style="text-align:right;">Tanggal</label>
                                <div class="col-sm-7">
                                    <input type="date" class="form-control  @error('tanggal') is-invalid @enderror" name="tanggal" id="tanggal" value="" style="width: 30%;">
                                </div>
                                @if ($errors->has('tanggal'))
                                <span class="invalid-feedback" role="alert">{{$errors->first('tanggal')}}</span>
                                @endif
                            </div>

                            <div class="form-group row">
                                <label for="jumlah_produksi" class="col-sm-5 col-form-label" style="text-align:right;">Jumlah Produksi</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" name="jumlah_produksi" id="jumlah_produksi" value="{{$b->jumlah}}" style="width: 50%;">
                                </div>
                                @if ($errors->has('jumlah_produksi'))
                                <span class="invalid-feedback" role="alert">{{$errors->first('jumlah_produksi')}}</span>
                                @endif
                            </div>

                            <div class="form-group row">
                                <label for="jumlah_sampling" class="col-sm-5 col-form-label" style="text-align:right;">Jumlah Sampling</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" name="jumlah_sampling" id="jumlah_sampling" value="{{$b->jumlah}}" style="width: 50%;">
                                </div>
                                @if ($errors->has('jumlah_sampling'))
                                <span class="invalid-feedback" role="alert">{{$errors->first('jumlah_sampling')}}</span>
                                @endif
                            </div>

                            <div></div>
                        </div>
                        <h3>Data</h3>
                        <div class="form-horizontal">
                            <div class="form-group row">
                                <table id="example" class="table table-hover table-bordered styled-table">
                                    <thead style="text-align: center;">
                                        <tr>
                                            <th rowspan="2">No</th>
                                            <th rowspan="2">Pemeriksaan</th>
                                            <th rowspan="2">Standar Keberterimaan</th>
                                            <th colspan="2">Jumlah</th>
                                            <th colspan="2">Hasil</th>
                                            <th rowspan="2">Keterangan</th>
                                        </tr>
                                        <tr>
                                            <th><i class="fas fa-check-circle" style="color:green;"></i></th>
                                            <th><i class="fas fa-times-circle" style="color:red;"></i></th>
                                            <th>Karantina</th>
                                            <th>Perbaikan</th>
                                        </tr>
                                    </thead>
                                    <tbody style="text-align:center;">
                                        @foreach($s as $i)
                                        <tr>
                                            <td rowspan="{{$i->HasilIkPemeriksaanPengujian->pluck('id')->count()}}">{{$loop->iteration}}</td>
                                            <td rowspan="{{$i->HasilIkPemeriksaanPengujian->pluck('id')->count()}}">{{$i->hal_yang_diperiksa}}</td>
                                            @foreach($i->HasilIkPemeriksaanPengujian as $j)
                                            <td><input type="text" value="{{$j->id}}" id="hasil_ik_id" name="hasil_ik_id[]" hidden>{{$j->standar_keberterimaan}}</td>
                                            <td><input type="number" class="form-control" id="hasil_ok" name="hasil_ok[]" min="0" max="{{$b->jumlah}}"></td>
                                            <td><input type="number" class="form-control" id="hasil_nok" name="hasil_nok[]" min="0" max="{{$b->jumlah}}"></td>
                                            <td><input type="number" class="form-control" id="karantina" name="karantina[]" min="0" max="{{$b->jumlah}}"></td>
                                            <td><input type="number" class="form-control" id="perbaikan" name="perbaikan[]" min="0" max="{{$b->jumlah}}"></td>
                                            <td><textarea class="form-control" id="keterangan" name="keterangan[]"></textarea></td>
                                        </tr>
                                        @endforeach
                                        @endforeach
                                    </tbody>
                                </table>
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
                </div>
                <!-- /.card -->
            </form>
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</section>
@endsection