@extends('adminlte.page')
@section('title', 'Beta Version')
@section('content_header')
<h1 class="m-0 text-dark">Dashboard</h1>
@stop
@section('content')
<div class="row">
  <div class="col-lg-12">
    <div class="col-lg-12">
      <form method="post" action="/penjualan_produk/aksi_tambah">
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
                      <label for="no_seri" class="col-sm-4 col-form-label" style="text-align:right;">Merk</label>
                      <div class="col-sm-8">
                        <select class="form-control select2 select2-info @error('merk') custom-select is-invalid @enderror" data-dropdown-css-class="s-2" style="width: 20%;" name="merk">
                          <option value="">Pilih Merk</option>
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
                        <input type="text" class="form-control @error('tipe') is-invalid @enderror" name="tipe" id="tipe" value="{{old('tipe')}}" style="width:45%;">
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
                      <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" id="nama" value="{{old('nama')}}" style="width:45%;">
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
                        <input type="text" class="form-control @error('harga') is-invalid @enderror" placeholder="123" name="harga" value="{{ old('harga') }}">
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
                        <option value="">Pilih Satuan</option>
                        <option value="elitech">pcs</option>
                        <option value="mentor">set</option>
                        <option value="vanward">unit</option>
                        <option value="aeolus">dus</option>
                        <option value="other">roll</option>
                        <option value="other">meter</option>
                        <option value="other">pack</option>
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
                      <input type="text" class="form-control @error('noakd') is-invalid @enderror" name="noakd" id="noakd" value="{{old('noakd')}}" style="width:45%;">
                      @if($errors->has('noakd'))
                      <div class="text-danger">
                        {{ $errors->first('noakd')}}
                      </div>
                      @endif
                    </div>
                    <span role="alert" id="no_pemeriksaan-msg"></span>
                  </div>
                  <div class="form-group row">
                    <label for="keterangan" class="col-sm-4 col-form-label" style="text-align:right;">Catatan</label>
                    <div class="col-sm-8">
                      <textarea class="form-control @error('keterangan') is-invalid @enderror" name="keterangan" id="keterangan" style="width:70%;">{{old('keterangan')}}</textarea>
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
            <span class="float-right"><button class="btn btn-success rounded-pill" id="button_tambah"><i class="fas fa-plus"></i>&nbsp;Tambah Data</button></span>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
@stop
@section('adminlte_js')
<script>
  $(document).ready(function() {
    $('#tipe').blur(function() {
      var tipe = $(this).val();
      $.ajax({
        url: '/penjualan_produk/cek_data/' + tipe,
        method: "GET",
        dataType: "json",
        success: function(data) {
          if (data != 0) {
            $('#button_tambah').attr("disabled", true);
            $('#tipe').html('<span class="text-danger">Tipe Produk Sudah Terpakai</span>');
          } else {
            $('#tipe').html('<span class="text-danger">Tipe Produk Tersedia</span>');
            $('#button_tambah').attr("disabled", false);
          }
        }
      })
    });
  });
</script>
@stop