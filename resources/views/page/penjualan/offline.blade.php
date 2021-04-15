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
          <h2>Offline</h2>
          <table id="tabel" class="table table-hover styled-table table-striped">
            <thead style="text-align: center;">
              <tr>
                <th colspan="12">
                  <a href="/penjualan_offline/tambah" style="color: white;"><button type="button" class="btn btn-block btn-success btn-sm" style="width: 200px;"><i class="fas fa-plus"></i> &nbsp; Tambah</i></button></a>
                </th>
              </tr>
              <tr>
                <th>No</th>
                <th>Status</th>
                <th>ID Order</th>
                <th>Customer</th>
                <th>Metode Bayar</th>
                <th></th>
              </tr>
            </thead>
            <tbody style="text-align: center;">
            </tbody>
          </table>
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
                <th>Catatan</th>
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
<!-- Modal Edit -->
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
                <form method="post" action="/penjualan_offline/detail/aksi_ubah">
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
                              <input type="text" name="id" class=" d-none form-control" id="fk" readonly>

                              <input type="text" name="produk_id" class=" d-none form-control" id="produk_id" readonly>
                              <table class="table table-bordered table-striped" id="xxx">
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
                                    <td><input type="text" name="offline_id" class="d-none form-control" id="offline_id" readonly><input type="text" name="produk_tipe" placeholder="Tipe Produk" class="form-control" id="tipe" readonly></td>
                                    <td><input type="text" name="produk_nama" placeholder="Nama Produk" class="form-control" id="nama" readonly></td>
                                    <td><input type="text" name="harga" placeholder="Harga" class="form-control" id="harga"></td>
                                    <td><input type="text" name="jumlah" placeholder="Jumlah" class="form-control" id="jumlah"></td>
                                    <td><input type="text" name="subtotal" placeholder="Sub Total" class="form-control" id="subtotal" readonly></td>
                                  </tr>
                                </tbody>
                                <tfoot>
                                  <tr>
                                    <th width="15%" colspan="4">Total</th>
                                    <th width="15%" colspan="2"><input type="text" name="subtotal" placeholder="Sub Total" class="form-control" id="subtotal" readonly></th>
                                  </tr>
                                  <tr>
                                    <th width="15%" colspan="1">Catatan</th>
                                    <th width="15%" colspan="5"><input type="text" name="keterangan" placeholder="Keterangan" class="form-control" id="keterangan"></th>
                                  </tr>
                                </tfoot>
                              </table>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="card-footer">
                      <span class="float-right"><button class="btn btn-success rounded-pill" id="button_tambah"><i class="fas fa-plus"></i>&nbsp;Ubah Data</button></span>
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
      ajax: '/penjualan_offline/data',
      columns: [{
          data: 'DT_RowIndex',
          orderable: false,
          searchable: false
        },
        {
          data: 'status'
        },
        {
          data: 'order_id'
        },
        {
          data: 'distributor.nama'
        },
        {
          data: 'bayar'
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
        'Detail Paket : ' + rows[0]['order_id']
      );
      $('#detail_mod').modal('show');

      $('#tabel_detail').DataTable({
        processing: true,
        destroy: true,
        serverSide: true,
        language: {
          processing: '<i class="fa fa-spinner fa-spin"></i> Tunggu Sebentar'
        },
        ajax: '/penjualan_offline/detail/data/' + rows[0]['id'],
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
            data: 'keterangan',
            orderable: false,
            searchable: false
          },
          {
            data: 'id',
            render: function(data) {
              $btn_edit = '<div class="inline-flex"><button id="edit" type="button" data-id="' + data + '"class="btn btn-block btn-warning karyawan-img-small" style="border-radius:50%;" data-toggle="modal"  data-dismiss="modal" ><i class="fas fa-edit"></i></button></div>';
              $btn_hapus = ' <div class="inline-flex"><button type="button" class="btn btn-block btn-danger karyawan-img-small" style="border-radius:50%;" data-toggle="modal" data-target="#delete" ><i class="fas fa-trash"></i></button></div>';
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
    });



    $('#tabel_detail > tbody').on('click', '#edit', function() {
      var rows = $(this).data('id');

      $.ajax({

        url: '/penjualan_offline/detail/data/edit/' + rows,
        type: "GET",
        dataType: "json",
        success: function(data) {
          console.log(data);
          $('#edit_mod').modal('show');
          $('#detail_mod').modal('hide');
          $('input[id="produk_id"]').val(data[0]['produk_id']);
          $('input[id="offline_id"]').val(data[0]['offline_id']);
          $('input[id="fk"]').val(data[0]['id']);
          $('input[id="tipe"]').val(data[0]['produk']['tipe']);
          $('input[id="nama"]').val(data[0]['produk']['nama']);
          $('input[id="harga"]').val(data[0]['harga']);
          $('input[id="jumlah"]').val(data[0]['jumlah']);
          $('input[id="keterangan"]').val(data[0]['keterangan']);
          $('input[id="subtotal"]').val(data[0]['jumlah'] * data[0]['harga']);
        },
        error: function(error) {
          console.log(error);
        }
      });
    });
  });
</script>
@endsection