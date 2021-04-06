@extends('adminlte.page')
@section('title', 'Beta Version')
@section('content_header')
<h1 class="m-0 text-dark">Dashboard</h1>
@stop
@section('content')
<div class="row">
  <div class="col-lg-12">
    <div class="col-lg-12">
      <form method="post" action="/penjualan_produk/aksi_ubah/{{$penjualan_produk->id}}">
        {{ csrf_field() }}
        {{method_field('PUT')}}
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
                      <label for="no_seri" class="col-sm-4 col-form-label" style="text-align:right;">Merk</label>
                      <div class="col-sm-8">
                        <select class="form-control select2 select2-info @error('merk') custom-select is-invalid @enderror" data-dropdown-css-class="s-2" style="width: 20%;" name="merk">
                          <option value="{{$penjualan_produk->merk }}">{{$penjualan_produk->merk}}</option>
                          <option value="elitech">elitech</option>
                          <option value="mentor">mentor</option>
                          <option value="vanward">vandward</option>
                          <option value="aeolus">aeolus</option>
                          <option value="other">other</option>
                        </select>
                        @if($errors->has('merk'))
                        <div class="text-danger">
                          {{ $errors->first('merk')}}
                        </div>
                        @endif
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="no_pemeriksaan" class="col-sm-4 col-form-label" style="text-align:right;">Tipe</label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control @error('tipe') is-invalid @enderror" name="tipe" id="tipe" value="{{$penjualan_produk->tipe}}" style="width:45%;" readonly>
                        @if($errors->has('tipe'))
                        <div class="text-danger">
                          {{ $errors->first('tipe')}}
                        </div>
                        @endif
                      </div>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="no_pemeriksaan" class="col-sm-4 col-form-label" style="text-align:right;">Nama Produk</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" id="nama" value="{{$penjualan_produk->nama}}" style="width:45%;">
                      @if($errors->has('nama'))
                      <div class="text-danger">
                        {{ $errors->first('tipe')}}
                      </div>
                      @endif
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="no_pemeriksaan" class="col-sm-4 col-form-label" style="text-align:right;">Harga</label>
                    <div class="col-sm-2">
                      <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text">Rp.</span>
                        </div>
                        <input type="text" class="form-control @error('harga') is-invalid @enderror" placeholder="123" name="harga" value="{{$penjualan_produk->harga}}">
                      </div>
                      @if($errors->has('harga'))
                      <div class="text-danger">
                        {{ $errors->first('harga')}}
                      </div>
                      @endif
                    </div>
                    <span role="alert" id="no_pemeriksaan-msg"></span>
                  </div>
                  <div class="form-group row">
                    <label for="no_seri" class="col-sm-4 col-form-label" style="text-align:right;">Satuan</label>
                    <div class="col-sm-8">
                      <select class="form-control select2 select2-info @error('satuan') custom-select is-invalid @enderror" data-dropdown-css-class="s-2" style="width: 20%;" name="satuan">
                        <option value="{{$penjualan_produk->satuan}}">{{$penjualan_produk->satuan}}</option>
                        <option value="pcs">pcs</option>
                        <option value="set">set</option>
                        <option value="unit">unit</option>
                        <option value="dus">dus</option>
                        <option value="roll">roll</option>
                        <option value="meter">meter</option>
                        <option value="pack">pack</option>
                      </select>
                      <span role="alert" id="no_seri-msg"></span>
                      @if($errors->has('satuan'))
                      <div class="text-danger">
                        {{ $errors->first('satuan')}}
                      </div>
                      @endif
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="no_pemeriksaan" class="col-sm-4 col-form-label" style="text-align:right;">No AKD</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control @error('no_akd') is-invalid @enderror" name="no_akd" id="noakd" value="{{$penjualan_produk->no_akd}}" style="width:45%;">
                      @if($errors->has('no_akd'))
                      <div class="text-danger">
                        {{ $errors->first('no_akd')}}
                      </div>
                      @endif
                    </div>
                    <span role="alert" id="no_pemeriksaan-msg"></span>
                  </div>
                  <div class="form-group row">
                    <label for="keterangan" class="col-sm-4 col-form-label" style="text-align:right;">Catatan</label>
                    <div class="col-sm-8">
                      <textarea class="form-control @error('keterangan') is-invalid @enderror" name="keterangan" id="keterangan" style="width:70%;">{{$penjualan_produk->keterangan}}</textarea>
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
          <div class="card-footer">
            <span class="float-left"><a class="btn btn-danger rounded-pill" href="/penjualan_produk"><i class="fas fa-times"></i>&nbsp;Batal</a></span>
            <span class="float-right"><button class="btn btn-success rounded-pill" id="button_tambah"><i class="fas fa-plus"></i>&nbsp;Ubah Data</button></span>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
@stop