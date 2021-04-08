@extends('adminlte.page')

@section('title', 'Beta Version')

@section('content_header')
<h1 class="m-0 text-dark">Dashboard</h1>
@stop

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Inventory</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Advanced Form</li>
                </ol>
            </div>
        </div>
    </div>
</section>
<section class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="col-lg-12">
                <form action="{{route('inventory.update', ['id' => $id])}}" method="POST">
                    {{csrf_field()}}
                    {{method_field('PUT')}}

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
                    @elseif(count($errors))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong><i class="fas fa-times"></i></strong> Lengkapi data yang belum terisi!
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif


                    <div class="card" id="card-pemeriksaan">
                        <div class="card-header bg-warning">
                            <div class="card-title"><i class="fas fa-edit"></i>&nbsp;Ubah Inventory</div>
                        </div>
                        <div class="card-body">
                            <div class="col-lg-12">
                                <h4>Informasi Barang</h4>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-horizontal">

                                            <div class="form-group row">
                                                <label for="kode_barang" class="col-sm-4 col-form-label" style="text-align:right;">Kode Barang</label>
                                                <div class="col-sm-8">
                                                    <input type="text" placeholder="Masukkan Kode Barang" class="form-control @error('kode_barang') is-invalid @enderror" name="kode_barang" id="kode_barang" value="{{old('kode_barang', $s->kode_barang)}}">
                                                    @if ($errors->has('kode_barang'))
                                                    <span class="invalid-feedback" role="alert">{{$errors->first('kode_barang')}}</span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="merk_barang" class="col-sm-4 col-form-label" style="text-align:right;">Merk Barang</label>
                                                <div class="col-sm-8">
                                                    <input type="text" placeholder="Masukkan Merk Barang" class="form-control @error('merk_barang') is-invalid @enderror" name="merk" id="merk" value="{{old('merk', $s->merk)}}">
                                                    @if ($errors->has('merk'))
                                                    <span class="invalid-feedback" role="alert">{{$errors->first('merk')}}</span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="keterangan" class="col-sm-4 col-form-label" style="text-align:right;">Nama Barang</label>
                                                <div class="col-sm-8">
                                                    <input type="text" placeholder="Masukkan Nama Barang" class="form-control @error('nama_barang') is-invalid @enderror" name="nama_barang" id="nama_barang" value="{{old('nama_barang', $s->nama_barang)}}">
                                                    @if ($errors->has('nama_barang'))
                                                    <span class="invalid-feedback" role="alert">{{$errors->first('nama_barang')}}</span>
                                                    @endif
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <h4>Keterangan Barang</h4>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-horizontal">

                                            <div class="form-group row">
                                                <label for="jumlah" class="col-sm-4 col-form-label" style="text-align:right;">Jumlah</label>
                                                <div class="col-sm-8">
                                                    <input type="number" placeholder="Masukkan Jumlah" min="0" class="form-control @error('jumlah') is-invalid @enderror" name="jumlah" id="jumlah" value="{{old('jumlah', $s->jumlah)}}">
                                                    @if ($errors->has('jumlah'))
                                                    <span class="invalid-feedback" role="alert">{{$errors->first('jumlah')}}</span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="lokasi" class="col-sm-4 col-form-label" style="text-align:right;">Lokasi</label>
                                                <div class="col-sm-8">
                                                    <textarea placeholder="Masukkan Lokasi" class="form-control @error('lokasi') is-invalid @enderror" name="lokasi" id="lokasi">{{old('lokasi', $s->lokasi)}}</textarea>
                                                    @if ($errors->has('lokasi'))
                                                    <span class="invalid-feedback" role="alert">{{$errors->first('lokasi')}}</span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="tanggal_perolehan" class="col-sm-4 col-form-label" style="text-align:right;">Tanggal Perolehan</label>
                                                <div class="col-sm-8">
                                                    <input type="date" placeholder="Masukkan Tanggal Perolehan" class="form-control @error('tanggal_perolehan') is-invalid @enderror" name="tanggal_perolehan" id="tanggal_perolehan" value="{{old('tanggal_perolehan', $s->tanggal_perolehan)}}">
                                                    @if ($errors->has('tanggal_perolehan'))
                                                    <span class="invalid-feedback" role="alert">{{$errors->first('tanggal_perolehan')}}</span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="masa_manfaat" class="col-sm-4 col-form-label" style="text-align:right;">Masa Manfaat</label>
                                                <div class="col-sm-8">
                                                    <input type="number" placeholder="Masukkan Masa Manfaat" class="form-control @error('masa_manfaat') is-invalid @enderror" name="masa_manfaat" id="masa_manfaat" value="{{old('masa_manfaat', $s->masa_manfaat)}}">
                                                    @if ($errors->has('masa_manfaat'))
                                                    <span class="invalid-feedback" role="alert">{{$errors->first('masa_manfaat')}}</span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="kondisi" class="col-sm-4 col-form-label" style="text-align:right;">Kondisi</label>
                                                <div class="col-sm-8">
                                                    <input type="number" placeholder="Masukkan Kondisi" class="form-control @error('kondisi') is-invalid @enderror" name="kondisi" id="kondisi" value="{{old('kondisi', $s->kondisi)}}">
                                                    @if ($errors->has('kondisi'))
                                                    <span class="invalid-feedback" role="alert">{{$errors->first('kondisi')}}</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="kondisi" class="col-sm-4 col-form-label" style="text-align:right;">Harga Perolehan</label>
                                                <div class="col-sm-8">
                                                    <input type="text" placeholder="Masukkan Harga Perolehan" class="form-control @error('harga_perolehan') is-invalid @enderror" name="harga_perolehan" id="harga_perolehan" value="{{old('harga_perolehan', $s->harga_perolehan)}}">
                                                    @if ($errors->has('harga_perolehan'))
                                                    <span class="invalid-feedback" role="alert">{{$errors->first('harga_perolehan')}}</span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="kondisi" class="col-sm-4 col-form-label" style="text-align:right;">Keterangan</label>
                                                <div class="col-sm-8">
                                                    <textarea placeholder="Masukkan Keterangan" class="form-control @error('keterangan') is-invalid @enderror" name="keterangan" id="keterangan">{{old('keterangan', $s->keterangan)}}</textarea>
                                                    @if ($errors->has('keterangan'))
                                                    <span class="invalid-feedback" role="alert">{{$errors->first('keterangan')}}</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="form-group row float-left">
                                <button class="btn btn-danger rounded-pill"><i class="fas fa-times"></i>&nbsp;Batal</button>
                            </div>
                            <div class="form-group row float-right">
                                <button class="btn btn-warning rounded-pill" type="submit" id="tambahbaris"><i class="far fa-edit"></i>&nbsp;Simpan Perubahan</button>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
        </div>

    </div>
</section>
@endsection