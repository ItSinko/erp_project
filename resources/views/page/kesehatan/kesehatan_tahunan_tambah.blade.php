@extends('adminlte.page')
@section('title', 'Beta Version')
@section('content_header')
<h1 class="m-0 text-dark">Dashboard</h1>
@stop
@section('content')
<section class="content-header">
    <div class="container-fluid">
    </div>
</section>

<section class="content">
    <div class="row">
        <div class="col-lg-12">
            @if(session()->has('success'))
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                {{session()->get('success')}}
            </div>
            @elseif(session()->has('error') || count($errors) > 0)
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                Data gagal ditambahkan
            </div>
            @endif
            <div class="col-lg-12">
                <form action="/kesehatan_tahunan/aksi_tambah" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="card">
                        <div class="card-header bg-success">
                            <div class="card-title"><i class="fas fa-plus-circle"></i>&nbsp;Tambah</div>
                        </div>
                        <div class="card-body">
                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-horizontal">
                                            <div class="form-group row">
                                                <label for="no_pemeriksaan" class="col-sm-4 col-form-label" style="text-align:right;">Tgl Pemeriksaan</label>
                                                <div class="col-sm-8">
                                                    <input type="date" class="form-control @error('tgl_cek') is-invalid @enderror" name="tgl_cek" style="width:45%;" value="{{ old('tgl_cek') }}">
                                                    @if($errors->has('tgl_cek'))
                                                    <div class="text-danger">
                                                        {{ $errors->first('tgl_cek')}}
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="no_pemeriksaan" class="col-sm-4 col-form-label" style="text-align:right;">Pemeriksa</label>
                                                <div class="col-sm-8">
                                                    <select type="text" class="form-control @error('pemeriksa_id') is-invalid @enderror select2" name="pemeriksa_id" style="width:45%;">
                                                        <option value=""></option>
                                                        @foreach($pengecek as $p)
                                                        <option value="{{$p->id}}">{{$p->nama}}</option>
                                                        @endforeach
                                                    </select>
                                                    @if($errors->has('karyawan_id'))
                                                    <div class="text-danger">
                                                        {{ $errors->first('karyawan_id')}}
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="no_pemeriksaan" class="col-sm-4 col-form-label" style="text-align:right;">Nama</label>
                                                <div class="col-sm-8">
                                                    <select type="text" class="form-control @error('karyawan_id') is-invalid @enderror select2" name="karyawan_id" style="width:45%;">
                                                        <option value=""></option>
                                                        @foreach($karyawan as $k)
                                                        <option value="{{$k->id}}">{{$k->nama}}</option>
                                                        @endforeach
                                                    </select>
                                                    @if($errors->has('karyawan_id'))
                                                    <div class="text-danger">
                                                        {{ $errors->first('karyawan_id')}}
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-4 col-form-label" style="text-align:right;">Rabun Mata</label>
                                                <div class="col-sm-8 ">
                                                    <div class="col-sm-4  d-inline">
                                                        <input type="text" class="form-control d-inline col-sm-4 " id="mata_kiri" style="width:15%;" placeholder="Mata Kiri" name="mata_kiri" value="{{ old('mata_kiri ') }}">
                                                        <small id="mata_kiri_status" class="form-text text-muted d-inline"></small>

                                                    </div>
                                                    <div class="col-sm-4  d-inline">
                                                        <input type="text" class="form-control d-inline col-sm-4" id="mata_kanan" style="width:15%;" placeholder="Mata Kanan" name="mata_kanan" value="{{ old('mata_kanan') }}">
                                                        <small id="mata_kanan_status" class="form-text text-muted d-inline"></small>
                                                    </div>
                                                    @if($errors->has('mata_kiri'))
                                                    <div class="text-danger">
                                                        {{ $errors->first('mata_kiri')}}
                                                    </div>
                                                    @endif
                                                    @if($errors->has('mata_kanan'))
                                                    <div class="text-danger ">
                                                        {{ $errors->first('mata_kanan')}}
                                                    </div>
                                                    @endif
                                                </div>

                                            </div>
                                            <div class="form-group row">
                                                <label for="no_pemeriksaan" class="col-sm-4 col-form-label" style="text-align:right;">Catatan</label>
                                                <div class="col-sm-8">
                                                    <textarea type="date" class="form-control @error('keterangan') is-invalid @enderror" name="keterangan" style="width:45%;" value="{{ old('keterangan') }}"></textarea>
                                                    @if($errors->has('keterangan'))
                                                    <div class="text-danger">
                                                        {{ $errors->first('keterangan')}}
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <span class="float-left"><a class="btn btn-danger rounded-pill" href="/kesehatan_tahunan"><i class="fas fa-times"></i>&nbsp;Batal</a></span>
                            <span class="float-right"><button class="btn btn-success rounded-pill" id="button_tambah"><i class="fas fa-plus"></i>&nbsp;Tambah Data</button></span>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
@section('adminlte_js')
<script>
    $(document).ready(function() {
        $(function() {
            $('#mata_kiri').keyup(function() {
                var value1 = parseFloat($('#mata_kiri').val());
                if (value1 <= 6) {
                    $('#mata_kiri_status').text('Tidak Normal');
                } else {
                    $('#mata_kiri_status').text('Normal');
                }
            });
        });

        $(function() {
            $('#mata_kanan').keyup(function() {
                var value1 = parseFloat($('#mata_kanan').val());
                if (value1 <= 6) {
                    $('#mata_kanan_status').text('Tidak Normal');
                } else {
                    $('#mata_kanan_status').text('Normal');
                }
            });
        });
    });
</script>
@stop