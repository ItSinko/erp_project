@extends('adminlte.page')

@section('title', 'Beta Version')

@section('content_header')
<h1 class="m-0 text-dark">Dashboard</h1>
@stop

@section('content')
<div class="row">
  <div class="col-lg-12">
    <div class="col-lg-12">
      <form method="post" action="/penjualan_online/aksi_ubah/{{ $ekatjual->id }}">
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
                      <label for="no_pemeriksaan" class="col-sm-4 col-form-label " style="text-align:right;">LKPP</label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control @error('lkpp') is-invalid @enderror" name="lkpp" id="lkpp" style="width:35%;" value="{{ $ekatjual->lkpp }}" readonly>
                        @if($errors->has('lkpp'))
                        <div class="text-danger">
                          {{ $errors->first('lkpp')}}
                        </div>
                        @endif
                      </div>
                    </div>
                    <span id="lkpp"></span>
                    <div class="form-group row">
                      <label for="keterangan" class="col-sm-4 col-form-label" style="text-align:right;">No Paket</label>
                      <div class="col-sm-4">
                        <div class="input-group mb-3">
                          <div class="input-group-prepend">
                            <span class="input-group-text">AK1-P</span>
                          </div>
                          <input type="text" class="form-control" placeholder="No AK1 Katalog" name="ak1" value="{{ substr($ekatjual->ak1,5) }}">
                        </div>
                        @if($errors->has('ak1'))
                        <div class="text-danger">
                          {{ $errors->first('ak1')}}
                        </div>
                        @endif
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="keterangan" class="col-sm-4 col-form-label" style="text-align:right;">Distributor</label>
                      <div class="col-sm-4">
                        <select class="form-control select2 @error('distributor_id') is-invalid @enderror" name="distributor_id">
                          <option value="{{$ekatjual->distributor_id}}">{{$ekatjual->distributor->nama}}</option>
                          @foreach ($distributor as $d)
                          <option value="{{$d->id}}">{{$d->nama}}</option>
                          @endforeach
                        </select>
                        @if($errors->has('distributor_id'))
                        <div class="text-danger">
                          {{ $errors->first('distributor_id')}}
                        </div>
                        @endif
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="keterangan" class="col-sm-4 col-form-label" style="text-align:right;">Deskripsi Paket</label>
                      <div class="col-sm-8">
                        <textarea class="form-control @error('despaket') is-invalid @enderror" name="despaket" id="despaket" style="width:50%;">{{ $ekatjual->despaket }}</textarea>
                        @if($errors->has('despaket'))
                        <div class="text-danger">
                          {{ $errors->first('despaket')}}
                        </div>
                        @endif
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="no_pemeriksaan" class="col-sm-4 col-form-label " style="text-align:right;">Instansi</label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control @error('instansi') is-invalid @enderror" name="instansi" id="instansi" value="{{ $ekatjual->instansi }}" style="width:50%;">
                        @if($errors->has('instansi'))
                        <div class="text-danger">
                          {{ $errors->first('instansi')}}
                        </div>
                        @endif
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="no_pemeriksaan" class="col-sm-4 col-form-label " style="text-align:right;">Satuan Kerja</label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control @error('satuankerja') is-invalid @enderror" name="satuankerja" id="satuankerja" value="{{ $ekatjual->satuankerja }}" style="width:50%;">
                        @if($errors->has('satuankerja'))
                        <div class="text-danger">
                          {{ $errors->first('satuankerja')}}
                        </div>
                        @endif
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="keterangan" class="col-sm-4 col-form-label" style="text-align:right;">Status</label>
                      <div class="col-sm-4">
                        <select class="form-control @error('status') is-invalid @enderror select2" name="status">
                          <option value="{{$ekatjual->status }}">{{$ekatjual->status}}</option>
                          <option value="Sepakat">Sepakat</option>
                          <option value="Masih Negoisasi">Masih Negoisasi</option>
                          <option value="Batal">Batal</option>
                        </select>
                        @if($errors->has('status'))
                        <div class="text-danger">
                          {{ $errors->first('status')}}
                        </div>
                        @endif
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="no_pemeriksaan" class="col-sm-4 col-form-label " style="text-align:right;">Tgl Buat</label>
                      <div class="col-sm-8">
                        <input type="date" class="form-control @error('tglbuat') is-invalid @enderror" name="tglbuat" id="tglbuat" value="{{ $ekatjual->tglbuat }}" style="width:35%;">
                        @if($errors->has('tglbuat'))
                        <div class="text-danger">
                          {{ $errors->first('tglbuat')}}
                        </div>
                        @endif
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="no_pemeriksaan" class="col-sm-4 col-form-label " style="text-align:right;">Tgl Edit</label>
                      <div class="col-sm-8">
                        <input type="date" class="form-control @error('tgledit') is-invalid @enderror" name="tgledit" id="tgledit" value="{{ $ekatjual->tgledit }}" style="width:35%;">
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="card-footer">
            <span class="float-left"><a class="btn btn-danger rounded-pill" href="/penjualan_online"><i class="fas fa-times"></i>&nbsp;Batal</a></span>
            <span class="float-right"><button class="btn btn-success rounded-pill" id="button_tambah"><i class="fas fa-plus"></i>&nbsp;Ubah Data</button></span>
          </div>
        </div>
    </div>
    </form>
  </div>
</div>
@stop
@section('adminlte_js')
<script>
  $(document).ready(function() {
    $('select[id="tipe"]').on('change', function() {
      var id = jQuery(this).val();
      $.ajax({
        url: '/produk/get_select/' + id,
        type: "GET",
        dataType: "json",
        success: function(data) {
          $('input[id="nama"]').val(data[0].nama);
          $('input[id="harga"]').val('3500000');
          $('input[id="jumlah"]').val('1');
        },
        error: function(error) {
          console.log(error);
        }
      });
    });
  });
</script>

<script>
  $(document).ready(function() {
    $('#lkpp').blur(function() {
      var lkpp = $(this).val();
      $.ajax({
        url: '/penjualan_online/cek_data/' + lkpp,
        method: "GET",
        dataType: "json",
        success: function(data) {
          if (data != 0) {
            $('#button_tambah').attr("disabled", true);
            $('#lkpp').html('<span class="text-danger">No LKPP Sudah Terpakai</span>');
          } else {
            $('#lkpp').html('<span class="text-danger">No Produk Tersedia</span>');
            $('#button_tambah').attr("disabled", false);
          }
        }
      })
    });
  });
</script>
@stop