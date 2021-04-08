@extends('adminlte.page')
@section('title', 'Beta Version')
@section('content_header')
<h1 class="m-0 text-dark">Dashboard</h1>
@stop
@section('content')
<div class="row">
  <div class="col-lg-12">
    @if(session()->has('success'))
    <div class="alert alert-success alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
      Data berhasil ditambahkan
    </div>
    @elseif(session()->has('error') || count($errors) > 0)
    <div class="alert alert-danger alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
      Data gagal ditambahkan
    </div>
    @endif
    <div class="card">
      <div class="card-body">
        <div class='table-responsive'>
          <h2>E-Katalog</h2>
          <table id="tabel" class="table table-hover styled-table table-striped">
            <thead style="text-align: center;">
              <tr>
                <th colspan="12">
                  <a href="/penjualan_online/tambah" style="color: white;"><button type="button" class="btn btn-block btn-success btn-sm" style="width: 200px;"><i class="fas fa-plus"></i> &nbsp; Tambah</i></button></a>
                </th>
              </tr>
              <tr>
                <th>No</th>
                <th>Status</th>
                <th>LKPP</th>
                <th>Distributor</th>
                <th>AK1</th>
                <th>Deskripsi</th>
                <th>Instansi</th>
                <th>Satuan Kerja</th>
                <th>Tgl Buat</th>
                <th>Tgl Edit</th>
                <th></th>
              </tr>
            </thead>
            <tbody style="text-align: center;">
            </tbody>
          </table>
          <div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog modal-md" role="document">
              <div class="modal-content">
                <div class="modal-header" style="background-color:#cc0000;">
                  <h4 class="modal-title" id="myModalLabel" style="color:white;"><i class="fas fa-warning-circle"></i>&nbsp;Hapus </h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body" id="delete">
                  <div class="card">
                    <div class="card-body" style="text-align:center;">
                      <h6>Kenapa anda ingin menghapus Laporan ini?</h6>
                    </div>
                    <form id="delete-form" action="" method="POST">
                      <div class="form-group row">
                        <div class="col-sm-1"></div>
                        <div class="col-sm-3">
                          <div class="icheck-danger d-inline">
                            <input type="radio" id="revisi_perakitan" name="keterangan_log" value="revisi" checked>
                            <label for="revisi_perakitan">
                              Revisi
                            </label>
                          </div>
                        </div>
                        <div class="col-sm-4">
                          <div class="icheck-danger d-inline">
                            <input type="radio" id="salah_input_perakitan" name="keterangan_log" value="salah_input">
                            <label for="salah_input_perakitan">
                              Salah Input
                            </label>
                          </div>
                        </div>
                        <div class="col-sm-3">
                          <div class="icheck-danger d-inline">
                            <input type="radio" id="pembatalan_perakitan" name="keterangan_log" value="pembatalan">
                            <label for="pembatalan_perakitan">
                              Pembatalan
                            </label>
                          </div>
                        </div>
                      </div>
                      <div class="card-footer col-12" style="margin-bottom: 2%;">
                        <span>
                          <button type="button" class="btn btn-block btn-info batalsk" data-dismiss="modal" id="batalhapus" style="width:30%;float:left;">Batal</button>
                        </span>
                        <span>
                          <button type="submit" class="btn btn-block btn-danger hapus" id="hapus" style="width:30%;float:right;">Hapus</button>
                        </span>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Modal Detail -->
<div class="modal fade  bd-example-modal-lg" id="detail_mod" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">
          <div class="data_detail_head"></div>
        </h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
        <div class="data_detail">
          <table class="table table-hover styled-table table-striped" width="100%" id="tabel_detail">
            <thead>
              <tr>
                <th colspan="12">
                  <button type="button" class="btn btn-block btn-success btn-sm" style="width: 200px;" data-target="#tambah_mod" data-toggle="modal" data-dismiss="modal"><i class="fas fa-plus"></i> &nbsp;Tambah Produk</i></button>
                </th>
              </tr>
              <tr>
                <th>No</th>
                <th>Tipe</th>
                <th>Nama Produk</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Sub Total</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
            </tbody>
            <tfoot>
              <tr>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
              </tr>
            </tfoot>
          </table>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- End Modal Detail -->
<!-- Modal Detail -->
<div class="modal fade  bd-example-modal-lg" id="tambah_mod" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">
          <div class="data_detail_head"></div>
        </h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
        <div class="data_detail">
          <div class="row">
            <div class="col-lg-12">
              <div class="col-lg-12">
                <form method="post" action="/penjualan_online/detail/aksi_tambah">
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
                              <input type="text" name="fk_paket_produk" " class=" d-none form-control" id="fk_paket_produk" readonly>

                              <table class="table table-bordered table-striped" id="user_table">
                                <thead>
                                  <tr>
                                    <th width="15%">Tipe</th>
                                    <th width="20%">Nama</th>
                                    <th width="15%">Harga</th>
                                    <th width="5%">Jumlah</th>
                                    <th width="15%">Sub Total</th>
                                    <th width="1%"></th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <tr>
                                    <td><select style="width: 100%;" type="text" name="produk_id[0]" placeholder="Enter your Name" class="form-control select2" id="tipe">
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
                                    <td><button type="button" name="add" id="add" class="btn btn-success"><i class="nav-icon fas fa-plus-circle"></i></button></td>
                                  </tr>
                                </tbody>
                                <tfoot>
                                  <tr>
                                    <th width="15%" colspan="4">Total</th>
                                    <th width="15%" colspan="2"><input type="text" name="subtotal[0]" placeholder="Sub Total" class="form-control" id="subtotal" readonly></th>
                                  </tr>
                                </tfoot>
                              </table>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="card-footer">
                      <span class="float-right"><button class="btn btn-success rounded-pill" id="button_tambah"><i class="fas fa-plus"></i>&nbsp;Tambah Data</button></span>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- End Modal Detail -->
<!-- Modal Detail -->
<div class="modal fade  bd-example-modal-lg" id="edit_mod" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">
          <div class="data_detail_head"></div>
        </h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
        <div class="data_detail">
          <div class="row">
            <div class="col-lg-12">
              <div class="col-lg-12">
                <form method="post" action="/penjualan_online/detail/aksi_tambah">
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
                              <input type="text" name="fk_paket_produk" " class=" d-none form-control" id="fk_paket_produk" readonly>
                              <table class="table table-bordered table-striped" id="user_table">
                                <thead>
                                  <tr>
                                    <th width="15%">Tipe</th>
                                    <th width="20%">Nama</th>
                                    <th width="15%">Harga</th>
                                    <th width="5%">Jumlah</th>
                                    <th width="15%">Sub Total</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <tr>
                                    <td><select style="width: 100%;" type="text" name="produk_id[0]" placeholder="Enter your Name" class="form-control select2" id="tipe">
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
                                  </tr>
                                </tbody>
                                <tfoot>
                                  <tr>
                                    <th width="15%" colspan="4">Total</th>
                                    <th width="15%" colspan="2"><input type="text" name="subtotal[0]" placeholder="Sub Total" class="form-control" id="subtotal" readonly></th>
                                  </tr>
                                </tfoot>
                              </table>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="card-footer">
                      <span class="float-right"><button class="btn btn-success rounded-pill" id="button_tambah"><i class="fas fa-plus"></i>&nbsp;Tambah Data</button></span>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- End Modal Detail -->
@stop
@section('adminlte_js')
<script>
  $(function() {
    var tabel = $('#tabel').DataTable({
      processing: true,
      serverSide: true,
      language: {
        processing: '<i class="fa fa-spinner fa-spin"></i> Tunggu Sebentar'
      },
      ajax: '/penjualan_online/data',
      columns: [{
          data: 'DT_RowIndex',
          orderable: false,
          searchable: false
        },
        {
          data: 'status',
          render: function(data) {
            if (data == 'Sepakat') {
              return '<i class="fas fa-check-circle " title = "' + data + '"></i>';
            } else if (data == 'Masih Negoisasi') {
              return '<i class="fas fa-exclamation-triangle  " title = "' + data + '"></i>';
            } else {
              return '<i class="fas fa-times-circle " title = "' + data + '"></i>';
            }
          },
          orderable: false,
        },
        {
          data: 'lkpp'
        },
        {
          data: 'distributor.nama'
        },
        {
          data: 'ak1'
        },
        {
          data: 'despaket'
        },
        {
          data: 'instansi'
        },
        {
          data: 'satuankerja'
        },
        {
          data: 'tglbuat'
        },
        {
          data: 'tgledit'
        },

        {
          data: 'id',
          render: function(data) {
            $btn_view = '<div class="inline-flex"><button type="button" id="detail" class="btn btn-block btn-primary karyawan-img-small" style="border-radius:50%;"><i class="fa fa-eye" aria-hidden="true"></i></button>';
            $btn_edit = '<a href="/penjualan_online/ubah/' + data + '"><button type="button" class="btn btn-block btn-warning karyawan-img-small" style="border-radius:50%;"  data-target="#edit_mod"><i class="fas fa-edit"></i></button></a>';
            $btn_hapus = ' <button type="button" class="btn btn-block btn-danger karyawan-img-small" style="border-radius:50%;" data-toggle="modal" data-target="#delete" ><i class="fas fa-trash"></i></button></div>';
            return $btn_view + $btn_edit + $btn_hapus;
          },
          orderable: false,
          searchable: false
        },
      ]
    });


    $('#tabel tbody').on('click', '#detail', function() {

      var rows = tabel.rows($(this).parents('tr')).data();
      $('.data_detail_head').html(
        'Detail Paket : ' + rows[0]['ak1']
      );

      $('input[id="fk_paket_produk"]').val(rows[0]['id']);

      $('#tabel_detail').DataTable({
        processing: true,
        destroy: true,
        serverSide: true,
        language: {
          processing: '<i class="fa fa-spinner fa-spin"></i> Tunggu Sebentar'
        },
        ajax: '/penjualan_online/detail/data/' + rows[0]['id'],
        columns: [{
            data: 'DT_RowIndex',
            orderable: false,
            searchable: false
          },
          {
            data: 'produk.tipe'
          },
          {
            data: 'produk.nama'
          },
          {
            data: 'harga',
            render: $.fn.dataTable.render.number(',', '.', 2),
            orderable: false,
            searchable: false
          },
          {
            data: 'jumlah',
            orderable: false,
            searchable: false
          },
          {
            data: 'total',
            render: $.fn.dataTable.render.number(',', '.', 2),
            orderable: false,
            searchable: false
          },
          {
            data: 'id',
            render: function(data) {
              $btn_edit = '<div class="inline-flex"><button type="button" class="btn btn-block btn-warning karyawan-img-small" style="border-radius:50%;" data-toggle="modal" data-target="#edit_mod"  data-dismiss="modal" ><i class="fas fa-edit"></i></button>';
              $btn_hapus = ' <button type="button" class="btn btn-block btn-danger karyawan-img-small" style="border-radius:50%;" data-toggle="modal" data-target="#delete" ><i class="fas fa-trash"></i></button></div>';
              return $btn_edit + $btn_hapus;
            },
            orderable: false,
            searchable: false
          },

        ],
        footerCallback: function(row, data, start, end, display) {
          var api = this.api(),
            data;

          // converting to interger to find total
          var intVal = function(i) {
            return typeof i === 'string' ?
              i.replace(/[\$,]/g, '') * 1 :
              typeof i === 'number' ?
              i : 0;
          };

          // computing column Total of the complete result 
          var jumlah_pesanan = api
            .column(4)
            .data()
            .reduce(function(a, b) {
              return intVal(a) + intVal(b);
            }, 0);
          // computing column Total of the complete result 
          var total_pesanan = api
            .column(5)
            .data()
            .reduce(function(a, b) {
              return intVal(a) + intVal(b);
            }, 0);

          var num_for = $.fn.dataTable.render.number(',', '.', 2).display;
          $(api.column(0).footer()).html('Total');
          $(api.column(4).footer()).html(jumlah_pesanan);
          $(api.column(5).footer()).html(num_for(total_pesanan));
        },

      });


      $('#detail_mod').modal('show');
      $('#tambah_mod').on('hidden.bs.modal', function() {
        $('#tambah_mod form')[0].reset();
      });
    });

  });
</script>

<script type="text/javascript">
  var i = 0;
  $("#add").click(function() {
    ++i;

    $("#user_table ").append('<tr><td><select style="width: 100%;" type="text" name="produk_id[' + i + ']" placeholder="Enter your Name" class="form-control" id="tipe' + i + '"><option value="">Pilih Tipe Produk</option>@foreach ($produk as $p)<option value="{{$p->id}}">{{$p->tipe}}</option>@endforeach</select></td><td><input type="text" name="produk_nama[' + i + ']"  placeholder="Nama Produk" class="form-control" id="nama_produk' + i + '" readonly></td><td><input type="text" name="harga[' + i + ']" placeholder="Harga" class="form-control" id="harga' + i + '"></td><td><input type="text" name="jumlah[' + i + ']" placeholder="Jumlah" class="form-control" id="jumlah' + i + '"></td><td><input type="text" name="subtotal[' + i + ']" placeholder="Subtotal" class="form-control" id="subtotal' + i + '" readonly></td><td><button type="button" class="btn btn-danger remove-tr"><i class="fas fa-trash"></i></button></td></tr>');

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

@endsection