@extends('adminlte.page')

@section('title', 'Beta Version')

@section('content_header')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Perbaikan</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Perbaikan</li>
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
                            <label for="no_seri" class="col-sm-4 col-form-label">Ketidaksesuaian Proses</label>
                            <div class="col-sm-8 col-form-label" style="text-align:right;">
                                {{ucfirst(str_replace('_', ' ', $s->ketidaksesuaian_proses))}}
                            </div>
                        </div>

                    </div>
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
            <div class="card">
                <div class="card-header bg-warning">
                    <div class="card-title"><i class="fas fa-edit"></i>&nbsp;Ubah Laporan Perakitan</div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <form action="{{route('perakitan.laporan.update',['id' => $sh->id])}}" method="post">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        <div class="form-group row">
                            <label for="tanggal_laporan" class="col-sm-4 col-form-label" style="text-align:right;">Tanggal Laporan</label>
                            <div class="col-sm-8">
                                <input type="date" class="form-control" name="tanggal_laporan" id="tanggal_laporan" value="{{$sh->tanggal}}" style="width: 25%;">
                                @if ($errors->has('tanggal_laporan'))
                                <span class="invalid-feedback" role="alert">{{$errors->first('tanggal_laporan')}}</span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="karyawan_id" class="col-sm-4 col-form-label" style="text-align:right;">Karyawan</label>
                            <div class="col-sm-5">
                                <div class="select2-info">
                                    <select class="select2 form-control @error('karyawan_id') is-invalid @enderror karyawan_id" multiple="multiple" data-placeholder="Pilih Operator" data-dropdown-css-class="select2-info" style="width: 100%;" name="karyawan_id[]" id="karyawan_id">
                                        @foreach($kry as $i)
                                        <option value="{{$i->id}}" @if($sh->Karyawan->contains('id', $i->id))
                                            selected
                                            @endif
                                            >{{$i->nama}}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('karyawan_id'))
                                    <span class="invalid-feedback" role="alert">{{$errors->first('karyawan_id.*')}}</span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <table id="tableitem" class="table table-hover styled-table">
                                <thead style="text-align: center;">
                                    <tr>
                                        <th>No</th>
                                        <th hidden></th>
                                        <th>Tanggal</th>
                                        <th>No Seri</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody style="text-align:center;">
                                    @php ($first = true) @endphp
                                    @foreach($sh->HasilPerakitan as $i)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td hidden><input type="text" id="id" name="id[]" value="{{$i->id}}"></td>
                                        <td>
                                            <div class="input-group">
                                                <input type="date" class="form-control" name="tanggals[]" id="tanggals" value="{{$i->tanggal}}">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <input type="text" class="form-control @error('hasil_perakitans.*.no_seri') is-invalid @enderror" name="no_seri[{{$loop->iteration - 1}}]" id="no_seri" value="{{$i->no_seri}}">
                                                </div>
                                                @if ($errors->has('hasil_perakitans.*.no_seri'))
                                                <span class="invalid-feedback" role="alert">{{$errors->first('hasil_perakitans.*.no_seri')}}</span>
                                                @endif
                                                <span id="no_seri-message[]" role="alert"></span>
                                            </div>
                                        </td>
                                        <td>@if($first == false)
                                            <button type="button" class="btn btn-danger btn-sm m-1" style="border-radius:50%;" id="closetable"><i class="fas fa-times-circle"></i></button>
                                            @elseif($first == true)
                                            @php ($first = false) @endphp
                                            <button type="button" class="btn btn-success btn-sm m-1" style="border-radius:50%;" id="tambahitem"><i class="fas fa-plus-circle"></i></button>
                                            @endif
                                        </td>
                                    </tr>

                                    @endforeach
                                </tbody>

                            </table>
                        </div>
                </div>
                <div class="card-footer">
                    <span>
                        <button type="button" class="btn btn-block btn-danger btn-rounded" style="width:200px;float:left;"><i class="fas fa-times"></i>&nbsp;Batal</button>
                    </span>
                    <span>
                        <button type="submit" class="btn btn-block btn-warning btn-rounded" style="width:200px;float:right;"><i class="fas fa-edit"></i>&nbsp;Simpan Perubahan</button>
                    </span>
                </div>
                </form>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <!-- /.card -->
        </div>


        <!-- /.col -->
    </div>
    <!-- /.row -->
</section>
@endsection