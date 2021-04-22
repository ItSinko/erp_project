@extends('adminlte.page')

@section('title', 'Beta Version')

@section('content_header')
<h1 class="m-0 text-dark">Dashboard</h1>
@stop
@section('content')
<div class="row">
  <div class="col-lg-12">
    <div class="col-lg-12">
      <form method="post" action="/penawaran_ecom/aksi_ubah/{{$penawaran_ecom->id}}">
        {{ csrf_field() }}
        {{ method_field('PUT') }}
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
                      <label for="keterangan" class="col-sm-4 col-form-label" style="text-align:right;">ID Order</label>
                      <div class="col-sm-4">
                        <input class="d-none " name="ecommerce_id" value="{{$penawaran_ecom->ecommerce->id}}" readonly>
                        <input class="form-control @error('offline_id') is-invalid @enderror " value="{{$penawaran_ecom->ecommerce->order_id}}" readonly>
                        @if($errors->has('offline_id'))
                        <div class="text-danger">
                          {{ $errors->first('offline_id')}}
                        </div>
                        @endif
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="keterangan" class="col-sm-4 col-form-label" style="text-align:right;">Tgl Surat</label>
                      <div class="col-sm-4">
                        <input class="form-control @error('tujuan') is-invalid @enderror" type="date" name="tgl_surat" value="{{ $penawaran_ecom->tgl_surat }}">
                        @if($errors->has('tgl_surat'))
                        <div class="text-danger">
                          {{ $errors->first('tgl_surat')}}
                        </div>
                        @endif
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="keterangan" class="col-sm-4 col-form-label" style="text-align:right;">Perihal Surat</label>
                      <div class="col-sm-4">
                        <input class="form-control @error('tujuan') is-invalid @enderror" readonly name="tujuan" value="Penawaran Harga">
                        @if($errors->has('tujuan'))
                        <div class="text-danger">
                          {{ $errors->first('tujuan')}}
                        </div>
                        @endif
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="keterangan" class="col-sm-4 col-form-label" style="text-align:right;">Deskripsi Surat</label>
                      <div class="col-sm-4">
                        <textarea class="form-control @error('deskripsi') is-invalid @enderror" name="deskripsi" placeholder="Deskripsi isi dari Surat Penawaran Harga">{{ $penawaran_ecom->deskripsi }}</textarea>
                        @if($errors->has('deskripsi'))
                        <div class="text-danger">
                          {{ $errors->first('deskripsi')}}
                        </div>
                        @endif
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="keterangan" class="col-sm-4 col-form-label" style="text-align:right;">Persetujuan</label>
                      <div class="col-sm-4">
                        <select class="form-control @error('karyawan_id') is-invalid @enderror select2" name="karyawan_id">
                          <option value="{{$penawaran_ecom->karyawan_id}}">{{$penawaran_ecom->karyawan->nama}}</option>
                          @foreach ($karyawan as $k)
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
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="card-footer">
            <span class="float-left"><a class="btn btn-danger rounded-pill" href="/penawaran_ecom/"><i class="fas fa-times"></i>&nbsp;Batal</a></span>
            <span class="float-right"><button class="btn btn-success rounded-pill" id="button_tambah"><i class="fas fa-plus"></i>&nbsp;Ubah Data</button></span>
          </div>
        </div>
    </div>
    </form>
  </div>
</div>
@stop