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
                <form action="/kalibrasi/aksi_tambah" method="post" enctype="multipart/form-data">
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
                                                <label for="keterangan" class="col-sm-4 col-form-label" style="text-align:right;">No Pendaftaran</label>
                                                <div class="col-sm-2">
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-append">
                                                            <span class="input-group-text">LAB-</span>
                                                        </div>
                                                        @foreach($kalibrasi as $k)
                                                        <input type="text" class="form-control" value="{{$k->no_pendaftaran + 1}}" name="no_pendaftaran">
                                                        @endforeach

                                                    </div>
                                                </div>
                                            </div>
                                            <div class=" form-group row">
                                                <label for="keterangan" class="col-sm-4 col-form-label" style="text-align:right;">Jenis</label>
                                                <div class="col-sm-2">
                                                    <select type="text" class="form-control @error('karyawan_id') is-invalid @enderror select2" name="kode_sertifikat">
                                                        <option value="">Pilih</option>
                                                        <option value="rsud">Rumah Sakit Umum Daerah (RSUD)</option>
                                                        <option value="dinkes">Dinas Kesehatan</option>
                                                        <option value="puskes">Puskesmas</option>
                                                        <option value="puskes">Personal</option>
                                                        <option value="lab">Laboratorium</option>
                                                        <option value="cip">PT Cipta Jaya</option>
                                                        <option value="cip">PT Sinko Prima Alloy</option>
                                                        <option value="pt">Perseorangan Terbatas (PT)</option>
                                                        <option value="univ">Universitas</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class=" form-group row">
                                                <label for="keterangan" class="col-sm-4 col-form-label" style="text-align:right;">PIC</label>
                                                <div class="col-sm-2">
                                                    <select type="text" class="form-control @error('teknisi_id') is-invalid @enderror select2" name="teknisi_id">
                                                        <option value="">Pilih</option>
                                                        @foreach($karyawan as $k)
                                                        <option value="{{$k->id}}">{{$k->nama}}</option>
                                                        @endforeach
                                                    </select>
                                                    @if($errors->has('teknisi_id'))
                                                    <div class="text-danger">
                                                        {{ $errors->first('teknisi_id')}}
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class=" form-group row">
                                                <label for="keterangan" class="col-sm-4 col-form-label" style="text-align:right;">Tgl Kalibrasi</label>
                                                <div class="col-sm-2">
                                                    <input type="date" class="form-control @error('tanggal_kalibrasi') is-invalid @enderror" name="tanggal_kalibrasi">
                                                </div>
                                            </div>
                                            <div class=" form-group row">
                                                <label for="keterangan" class="col-sm-4 col-form-label" style="text-align:right;">Tgl Selesai</label>
                                                <div class="col-sm-2">
                                                    <input type="date" class="form-control @error('tanggal_selesai') is-invalid @enderror" name="tanggal_selesai">
                                                </div>
                                            </div>
                                            <div class=" form-group row">
                                                <label for="keterangan" class="col-sm-4 col-form-label" style="text-align:right;">Tgl Penyerahan</label>
                                                <div class="col-sm-2">
                                                    <input type="date" class="form-control @error('tanggal_penyerahan') is-invalid @enderror" name="tanggal_penyerahan">
                                                </div>
                                            </div>
                                            <table class=" table table-bordered table-striped" style="width:100%" id="user_table">
                                                <thead>
                                                    <tr>
                                                        <th width="10%">No Seri</th>
                                                        <th width="10%">Type</th>
                                                        <th width="15%">Nama</th>
                                                        <th width="15%">Distributor</th>
                                                        <th width="1%"></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($listkalibrasi as $k)
                                                    <tr>
                                                        <td>
                                                            {{str_replace("/", "", $k->Kalibrasi->alias_barcode) . $k->no_barcode}}
                                                        </td>
                                                        <td>{{$k->Kalibrasi->bppb->detailproduk->nama}}</td>
                                                        <td>{{$k->Kalibrasi->bppb->detailproduk->produk->nama}}</td>
                                                        <td>-</textarea></td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <span class="float-left"><a class="btn btn-danger rounded-pill" href="/kalibrasi"><i class="fas fa-times"></i>&nbsp;Batal</a></span>
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


@stop