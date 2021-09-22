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
                <form action="/daftar_karyawan/aksi_tambah" method="post" enctype="multipart/form-data">
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
                                                <label for="no_pemeriksaan" class="col-sm-4 col-form-label" style="text-align:right;">Nama Karyawan</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" id="nama" style="width:45%;" placeholder="Masukkan Nama Karyawan" value="{{ old('nama') }}">
                                                    @if($errors->has('nama'))
                                                    <div class="text-danger">
                                                        {{ $errors->first('nama')}}
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <span id="nama"></span>
                                            <div class="form-group row">
                                                <label for="no_pemeriksaan" class="col-sm-4 col-form-label" style="text-align:right;">Divisi</label>
                                                <div class="col-sm-8">
                                                    <select type="text" class="form-control @error('divisi_id') is-invalid @enderror select2" name="divisi_id" style="width:45%;" placeholder="Masukkan Nama Karyawan" value="{{ old('divisi_id') }}">
                                                        <option value="">Pilih Divisi</option>
                                                        @foreach($divisi as $d)
                                                        <option value="{{$d->id}}">{{$d->nama}}</option>
                                                        @endforeach
                                                    </select>
                                                    @if($errors->has('divisi_id'))
                                                    <div class="text-danger">
                                                        {{ $errors->first('divisi_id')}}
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="no_pemeriksaan" class="col-sm-4 col-form-label" style="text-align:right;">Jabatan</label>
                                                <div class="col-sm-8">
                                                    <select type="text" class="form-control @error('jabatan') is-invalid @enderror select2" name="jabatan" style="width:45%;" placeholder="Masukkan Nama Karyawan" value="{{ old('jabatan') }}">
                                                        <option value="">Pilih Divisi</option>
                                                        <option value="direktur">Direktur</option>
                                                        <option value="manager">Manager</option>
                                                        <option value="assisten manager">Ass Manager</option>
                                                        <option value="supervisor">Supervisor</option>
                                                        <option value="staff">Staff</option>
                                                        <option value="operator">Operator</option>
                                                        <option value="harian">Harian</option>
                                                    </select>
                                                    @if($errors->has('jabatan'))
                                                    <div class="text-danger">
                                                        {{ $errors->first('jabatan')}}
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="no_pemeriksaan" class="col-sm-4 col-form-label" style="text-align:right;">Tgl Lahir</label>
                                                <div class="col-sm-8">
                                                    <input type="date" class="form-control @error('nama') is-invalid @enderror" name="tgllahir" style="width:45%;" placeholder="Masukkan Nama Karyawan" value="{{ old('tgllahir') }}">
                                                    @if($errors->has('tgllahir'))
                                                    <div class="text-danger">
                                                        {{ $errors->first('tgllahir')}}
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="kondisi" class="col-sm-4 col-form-label" style="text-align:right;">Jeni Kelamin</label>
                                                <div class="col-sm-8" style="margin-top:7px;">
                                                    <div class="icheck-success d-inline col-sm-4">
                                                        <input type="radio" name="jenis" value="L" checked="0">
                                                        <label for="no">
                                                            Laki laki
                                                        </label>
                                                    </div>
                                                    <div class="icheck-warning d-inline col-sm-4">
                                                        <input type="radio" name="jenis" value="P">
                                                        <label for="sample">
                                                            Perempuan
                                                        </label>
                                                    </div>
                                                    <span class="invalid-feedback" role="alert" id="kondisi-msg"></span>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="no_pemeriksaan" class="col-sm-4 col-form-label" style="text-align:right;">Tgl Masuk</label>
                                                <div class="col-sm-8">
                                                    <input type="date" class="form-control @error('tgl_kerja') is-invalid @enderror" name="tgl_kerja" style="width:45%;" placeholder="Masukkan Nama Karyawan" value="{{ old('tgl_kerja') }}">
                                                    @if($errors->has('tgl_kerja'))
                                                    <div class="text-danger">
                                                        {{ $errors->first('tgl_kerja')}}
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
                            <span class="float-left"><a class="btn btn-danger rounded-pill" href="/daftar_karyawan"><i class="fas fa-times"></i>&nbsp;Batal</a></span>
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
        $('#nama').keyup(function() {
            var nama = $(this).val();
            $.ajax({
                url: '/daftar_karyawan/cekdata/' + nama,
                method: "GET",
                dataType: "json",
                success: function(data) {
                    if (data != 0) {
                        $('#nama').html('<span class="text-danger">Nama karyawan pernah di input</span>');
                        $('#button_tambah').attr("disabled", true);
                    } else {
                        $('#button_tambah').attr("disabled", false);
                    }
                }
            })
        });
    });
</script>
@stop