@extends('adminlte.page')

@section('title', 'Beta Version')

@section('content_header')
<h1 class="m-0 text-dark">Dashboard</h1>
@stop

@section('content')
<div class="row">
  <div class="col-lg-12">
    <div class="col-lg-12">
      <form method="post" action="">
        {{ csrf_field() }}
        <div class="card">
          <div class="card-header bg-success">
            <div class="card-title"><i class="fas fa-plus-circle"></i>&nbsp;Ubah</div>
          </div>
          <div class="card-body">
            <div class="col-lg-12">
              <div class="row">
                <div class="col-lg-12">
                  <div class="form-horizontal">
                    <div class="form-group row">
                      <label for="no_pemeriksaan" class="col-sm-4 col-form-label " style="text-align:right;">Nama</label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" id="nama" value="{{old('nama')}}" style="width:45%;">
                      </div>
                      <span role="alert" id="no_pemeriksaan-msg"></span>
                    </div>
                    <div class="form-group row">
                      <label for="no_seri" class="col-sm-4 col-form-label" style="text-align:right;">Jenis</label>
                      <div class="col-sm-8">
                        <select class="form-control select2 select2-info @error('jenis') custom-select is-invalid @enderror" data-dropdown-css-class="s-2" style="width: 50%;" name="jenis">
                          <option value="">Pilih Jenis</option>
                          <option value="Pelanggan">Pelanggan</option>
                          <option value="Distributor">Distributor</option>
                        </select>
                        <span role="alert" id="no_seri-msg"></span>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="keterangan" class="col-sm-4 col-form-label" style="text-align:right;">Alamat</label>
                      <div class="col-sm-8">
                        <textarea class="form-control @error('alamat') is-invalid @enderror" name="alamat" id="alamat" style="width:70%;">{{old('alamat')}}</textarea>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="no_pemeriksaan" class="col-sm-4 col-form-label" style="text-align:right;">Email</label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" id="email" value="{{old('email')}}" style="width:45%;">
                      </div>
                      <span role="alert" id="no_pemeriksaan-msg"></span>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="no_pemeriksaan" class="col-sm-4 col-form-label" style="text-align:right;">Telpon</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control @error('telp') is-invalid @enderror" name="telp" id="telp" value="{{old('telp')}}" style="width:45%;">
                    </div>
                    <span role="alert" id="no_pemeriksaan-msg"></span>
                  </div>
                  <div class="form-group row">
                    <label for="no_pemeriksaan" class="col-sm-4 col-form-label" style="text-align:right;">Diskon Nota</label>
                    <div class="col-sm-1">
                      <div class="input-group mb-3">
                        <input type="text" class="form-control @error('dis_nota') is-invalid @enderror" placeholder="123" name="dis_nota" value="{{ old('dis_nota') }}">
                        <div class="input-group-prepend">
                          <span class="input-group-text">%</span>
                        </div>
                      </div>
                    </div>
                    <span role="alert" id="no_pemeriksaan-msg"></span>
                  </div>
                  <div class="form-group row">
                    <label for="no_pemeriksaan" class="col-sm-4 col-form-label" style="text-align:right;">Diskon Uji</label>
                    <div class="col-sm-1">
                      <div class="input-group mb-3">
                        <input type="text" class="form-control @error('dis_uji') is-invalid @enderror" placeholder="123" name="dis_uji" value="{{ old('dis_uji') }}">
                        <div class="input-group-prepend">
                          <span class="input-group-text">%</span>
                        </div>
                      </div>
                    </div>
                    <span role="alert" id="no_pemeriksaan-msg"></span>
                  </div>
                  <div class="form-group row">
                    <label for="no_pemeriksaan" class="col-sm-4 col-form-label" style="text-align:right;">Tempo Bayar</label>
                    <div class="col-sm-1">
                      <div class="input-group mb-3">
                        <input type="text" class="form-control @error('tempo') is-invalid @enderror" placeholder="123" name="tempo" value="{{ old('tempo') }}">
                        <div class="input-group-prepend">
                          <span class="input-group-text">Hari</span>
                        </div>
                      </div>
                    </div>
                    <span role="alert" id="no_pemeriksaan-msg"></span>
                  </div>
                  <div class="form-group row">
                    <label for="keterangan" class="col-sm-4 col-form-label" style="text-align:right;">Keterangan</label>
                    <div class="col-sm-8">
                      <textarea class="form-control @error('ket') is-invalid @enderror" name="ket" id="ket" style="width:70%;">{{old('ket')}}</textarea>
                    </div>
                  </div>
                </div>
              </div>

            </div>
          </div>
          <div class="card-footer">
            <span class="float-left"><button class="btn btn-danger rounded-pill" id="button_tambah"><i class="fas fa-times"></i>&nbsp;Batal</button></span>
            <span class="float-right"><button class="btn btn-success rounded-pill" id="button_tambah"><i class="fas fa-plus"></i>&nbsp;Ubah Data</button></span>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
@stop