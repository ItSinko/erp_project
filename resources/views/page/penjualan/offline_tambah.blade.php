@extends('adminlte.page')

@section('title', 'Beta Version')

@section('content_header')
<h1 class="m-0 text-dark">Dashboard</h1>
@stop
@section('content')
<div class="row">
  <div class="col-lg-12">
    <div class="col-lg-12">
      <form method="post" action="/penjualan_offline/aksi_tambah">
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
                      <label class="col-sm-4 col-form-label" style="text-align:right;">Customer</label>
                      <div class="col-sm-4">
                        <select class="form-control select2 @error('customer_id') is-invalid @enderror" name="customer_id">
                          <option value="">Pilih Customer</option>
                          @foreach ($distributor as $d)
                          <option value="{{$d->id}}">{{$d->nama}}</option>
                          @endforeach
                        </select>
                        @if($errors->has('customer_id'))
                        <div class="text-danger">
                          {{ $errors->first('customer_id')}}
                        </div>
                        @endif
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="keterangan" class="col-sm-4 col-form-label" style="text-align:right;">Status</label>
                      <div class="col-sm-4">
                        <select class="form-control @error('status') is-invalid @enderror select2" name="status">
                          <option value="">Pilih Status</option>
                          <option value="Lunas">Lunas</option>
                          <option value="Proses">Proses</option>
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
                      <label for="keterangan" class="col-sm-4 col-form-label" style="text-align:right;">Metode Pembayaran</label>
                      <div class="col-sm-4">
                        <select class="form-control @error('bayar') is-invalid @enderror select2" name="bayar">
                          <option value="">Pilih Status</option>
                          <option value="Transfer">Transfer</option>
                          <option value="Tunai">Tunai</option>
                        </select>
                        @if($errors->has('status'))
                        <div class="text-danger">
                          {{ $errors->first('status')}}
                        </div>
                        @endif
                      </div>
                    </div>
                    <table class="table table-bordered table-striped" id="user_table">
                      <thead>
                        <tr>
                          <th width="15%">Tipe</th>
                          <th width="20%">Nama</th>
                          <th width="15%">Harga</th>
                          <th width="5%">Jumlah</th>
                          <th width="15%">Sub Total</th>
                          <th width="15%">Catatan</th>
                          <th width="1%"></th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>
                            <select style="width: 100%;" type="text" name="produk_id[0]" placeholder="Enter your Name" class="form-control select2" id="tipe">
                              <option value="">Pilih Tipe Produk</option>
                              @foreach ($produk as $p)
                              <option value="{{$p->id}}">{{$p->tipe}}</option>
                              @endforeach
                            </select>
                            @if($errors->has('produk_id'))
                            <div class="text-danger">
                              {{ $errors->first('produk_id')}}
                            </div>
                            @endif
                          </td>
                          <td><input type="text" name="produk_nama[0]" placeholder="Nama Produk" class="form-control" id="nama" readonly></td>
                          <td><input type="text" name="harga[0]" placeholder="Harga" class="form-control" id="harga"></td>
                          <td><input type="text" name="jumlah[0]" placeholder="Jumlah" class="form-control" id="jumlah"></td>
                          <td><input type="text" name="subtotal[0]" placeholder="Sub Total" class="form-control" id="subtotal" readonly></td>
                          <td><textarea type="text" name="keterangan[0]" placeholder="Isi Keterangan" class="form-control" id="keterangan"></textarea></td>
                          <td><button type="button" name="add" id="add" class="btn btn-success"><i class="nav-icon fas fa-plus-circle"></i></button></td>
                        </tr>
                      </tbody>
                      <tfoot>
                        <tr>
                          <th width="15%" colspan="4">Total</th>
                          <th width="15%"><input type="text" name="subtotal[0]" placeholder="Sub Total" class="form-control" id="subtotal" readonly></th>
                          <th width="15%" colspan="3"></th>
                        </tr>
                      </tfoot>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="card-footer">
            <span class="float-left"><a class="btn btn-danger rounded-pill" href="/penjualan_offline/"><i class="fas fa-times"></i>&nbsp;Batal</a></span>
            <span class="float-right"><button class="btn btn-success rounded-pill" id="button_tambah"><i class="fas fa-plus"></i>&nbsp;Tambah Data</button></span>
          </div>
        </div>
    </div>
    </form>
  </div>
</div>
@stop
@section('adminlte_js')
<script type="text/javascript">
  var i = 0;
  $("#add").click(function() {
    ++i;

    $("#user_table ").append('<tr><td><select style="width: 100%;" type="text" name="produk_id[' + i + ']" placeholder="Enter your Name" class="form-control" id="tipe' + i + '"><option value="">Pilih Tipe Produk</option>@foreach ($produk as $p)<option value="{{$p->id}}">{{$p->tipe}}</option>@endforeach</select></td><td><input type="text" name="produk_nama[' + i + ']"  placeholder="Nama Produk" class="form-control" id="nama_produk' + i + '" readonly></td><td><input type="text" name="harga[' + i + ']" placeholder="Harga" class="form-control" id="harga' + i + '"></td><td><input type="text" name="jumlah[' + i + ']" placeholder="Jumlah" class="form-control" id="jumlah' + i + '"></td><td><input type="text" name="subtotal[' + i + ']" placeholder="Subtotal" class="form-control" id="subtotal' + i + '" readonly></td><td><textarea type="text" name="keterangan[' + i + ']" placeholder="Isi Keterangan" class="form-control" id="keterangan"></textarea></td><td><button type="button" class="btn btn-danger remove-tr"><i class="fas fa-trash"></i></button></td></tr>');

    $('#tipe' + i + '').select2({
      placeholder: "Pilih Data",
      allowClear: true,
      theme: 'bootstrap4',
    })


    $(document).ready(function() {
      $('select[id="tipe' + i + '"]').on('change', function() {
        var id = jQuery(this).val();
        $.ajax({
          url: '/produk/get_select/' + id,
          type: "GET",
          dataType: "json",
          success: function(data) {
            $('input[id="nama_produk' + i + '"]').val(data[0].nama);
            $('input[id="harga' + i + '"]').val('3500000');
            $('input[id="jumlah' + i + '"]').val('1');
          },
          error: function(error) {
            console.log(error);
          }
        });
      });
    });
  });


  $(document).on('click', '.remove-tr', function() {
    $(this).parents('tr').remove();
  });
</script>
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