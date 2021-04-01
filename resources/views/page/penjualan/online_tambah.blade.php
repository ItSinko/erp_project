@extends('adminlte.page')

@section('title', 'Beta Version')

@section('content_header')
<h1 class="m-0 text-dark">Dashboard</h1>
@stop

@section('content')
<div class="row">
  <div class="col-lg-12">
    <div class="col-lg-12">
      <form method="post" action="/penjualan_online/aksi_tambah">
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
                      <label for="no_pemeriksaan" class="col-sm-4 col-form-label " style="text-align:right;">LKPP</label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control @error('lkpp') is-invalid @enderror" name="lkpp" id="lkpp" value="" style="width:35%;" value="{{ old('lkpp') }}">
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
                          <input type="text" class="form-control" placeholder="No AK1 Katalog" name="ak1" value="{{ old('ak1') }}">
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
                          <option value="">Pilih Distributor</option>
                          @foreach ($distributor as $d)
                          <option value="{{$d->id}}">{{$d->nama}}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="keterangan" class="col-sm-4 col-form-label" style="text-align:right;">Deskripsi Paket</label>
                      <div class="col-sm-8">
                        <textarea class="form-control @error('despaket') is-invalid @enderror" name="despaket" id="despaket" style="width:50%;">{{ old('despaket') }}</textarea>
                        @if($errors->has('ak1'))
                        <div class="text-danger">
                          {{ $errors->first('ak1')}}
                        </div>
                        @endif
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="no_pemeriksaan" class="col-sm-4 col-form-label " style="text-align:right;">Instansi</label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control @error('instansi') is-invalid @enderror" name="instansi" id="instansi" value="{{ old('instansi') }}" style="width:50%;">
                      </div>

                    </div>
                    <div class="form-group row">
                      <label for="no_pemeriksaan" class="col-sm-4 col-form-label " style="text-align:right;">Satuan Kerja</label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control @error('satuankerja') is-invalid @enderror" name="satuankerja" id="satuankerja" value="{{ old('satuankerja') }}" style="width:50%;">
                      </div>

                    </div>
                    <div class="form-group row">
                      <label for="keterangan" class="col-sm-4 col-form-label" style="text-align:right;">Status</label>
                      <div class="col-sm-4">
                        <select class="form-control @error('status') is-invalid @enderror select2" name="status">
                          <option value="">Pilih Status</option>
                          <option value="Sepakat">Sepakat</option>
                          <option value="Masih Negoisasi">Masih Negoisasi</option>
                          <option value="Batal">Batal</option>
                        </select>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="no_pemeriksaan" class="col-sm-4 col-form-label " style="text-align:right;">Tgl Buat</label>
                      <div class="col-sm-8">
                        <input type="date" class="form-control @error('tglbuat') is-invalid @enderror" name="tglbuat" id="tglbuat" value="{{ old('tglbuat') }}" style="width:35%;">
                      </div>

                    </div>
                    <div class="form-group row">
                      <label for="no_pemeriksaan" class="col-sm-4 col-form-label " style="text-align:right;">Tgl Edit</label>
                      <div class="col-sm-8">
                        <input type="date" class="form-control @error('tgledit') is-invalid @enderror" name="tgledit" id="tgledit" value="{{ old('tgledit') }}" style="width:35%;">
                      </div>

                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

    </div>

    <div class="col-lg-12">
      <div class="card">
        <div class="card-header bg-success">
          <div class="card-title">Produk</div>
        </div>
        <div class="card-body">
          <table class="table table-bordered" id="tableitem" style="text-align:center;">
            <thead>
              <tr>
                <th>No</th>
                <th>Tipe</th>
                <th>Nama</th>
                <th style="width: 15%;">Harga</th>
                <th style="width: 10%;">Jumlah</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>1</td>
                <td><select class="select2 form-control" name="type_produk[0][]" data-dropdown-css-class="select2-info" id="type_produk" style="width: 100%;">
                    <option value=""></option>
                    @foreach ($produk as $p)
                    <option value="{{$p->id}}">{{$p->tipe}}</option>
                    @endforeach
                  </select>
                </td>
                <td><input type="text" placeholder="Masukkan data" class="form-control @error('data') is-invalid @enderror" name="nama_produk[0]" readonly></td>
                <td><input type="text" placeholder="Masukkan data" class="form-control @error('data') is-invalid @enderror" name="harga[0]" id="harga" value="{{old('number-1')}}"></td>
                <td><input type="text" placeholder="Masukkan data" class="form-control @error('data') is-invalid @enderror" name="jumlah[0]" id="jumlah" value="{{old('number-1')}}"></td>
                <td><button type="button" class="btn btn-block btn-success btn-sm circle-button karyawan-img-small" id="tambahitem"><i class="fas fa-plus"></i></button></td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="card-footer">
          <span class="float-left"><button class="btn btn-danger rounded-pill"><i class="fas fa-times"></i>&nbsp;Batal</button></span>
          <span class="float-right"><button class="btn btn-success rounded-pill" id="button_tambah"><i class="fas fa-plus"></i>&nbsp;Tambah Data</button></span>
        </div>
      </div>
    </div>
    </form>
  </div>
</div>
@stop
@section('adminlte_js')
<script>
  $(function() {
    var count = 0;
    var rowIdx = 0;

    function numberRows($t) {
      var c = 0 - 1;
      $t.find("tr").each(function(ind, el) {
        $(el).find("td:eq(0)").html(++c);
        var j = c - 1;
        $(el).find('input[id="nama_produk"]').attr('name', 'nama_produk[' + j + ']');
        $(el).find('select[id="type_produk"]').attr('name', 'type_produk[' + j + ']');
        console.log(j);
        $('select[name="type_produk[' + j + ']"]').on('change', function() {
          var id = jQuery(this).val();
          if (id) {
            $.ajax({
              url: '/produk/get_select/' + id,
              type: "GET",
              dataType: "json",
              success: function(data) {
                $('input[name="nama_produk[' + j + ']"]').val(data[0]['nama']);;
              }
            });
          } else {
            alert('nok');
          }
        });

        $(function() {
          $('select[name="type_produk[' + j + ']"]').select2({
            placeholder: "Pilih Data",
            allowClear: true
          });
        })

      });
    }

    $('#tambahitem').click(function(e) {
      $('#tableitem tr:last').after(`<tr>
                                <td></td>
                                <td><select class="select2 form-control"  id="type_produk" name="type_produk[]" data-dropdown-css-class="select2-info" style="width: 100%;">
                                <option value=""></option>
                                @foreach ($produk as $p)
                                <option value="{{$p->id}}">{{$p->tipe}}</option>
                                @endforeach    
                                </select>
                                </td>      
                                <td><input type="text" class="form-control" id="nama_produk" name="nama_produk[]" placeholder="Masukkan data" readonly></td>
                                <td><input type="text" class="form-control" name="harga_produk"  placeholder="Masukkan data" ></td>
                                <td><input type="text" class="form-control" name="jumlah"  placeholder="Masukkan data"  </td>
                                <td><button type="button" class="btn btn-block btn-danger btn-sm circle-button karyawan-img-small" id="closetable" ><i class="fas fa-trash"></i></button></td>
                            </tr>`);
      numberRows($("#tableitem"));
    });

    $('#tableitem').on('click', '#closetable', function(e) {
      $(this).closest('tr').remove();
      numberRows($("#tableitem"));
    });

    $('select[name="type_produk[0][]"]').on('change', function() {
      var id = jQuery(this).val();
      if (id) {
        $.ajax({
          url: '/produk/get_select/' + id,
          type: "GET",
          dataType: "json",
          success: function(data) {
            $('input[name="nama_produk[0]"]').val(data[0]['nama']);
          }
        });
      } else {
        alert('nok');
      }
    });
  })
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