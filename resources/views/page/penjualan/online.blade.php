@extends('adminlte.page')

@section('title', 'Beta Version')

@section('content_header')
<h1 class="m-0 text-dark">Dashboard</h1>
@stop

@section('content')
<div class="row">
  <div class="col-lg-12">
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
                          <button type="button" class="btn btn-block btn-info batalsk" data-dismiss="modal" id="batalhapussk" style="width:30%;float:left;">Batal</button>
                        </span>
                        <span>
                          <button type="submit" class="btn btn-block btn-danger hapussk" id="hapussk" style="width:30%;float:right;">Hapus</button>
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
                <th>No</th>
                <th>Tipe</th>
                <th>Nama Produk</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Sub Total</th>
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
            $btn_view = '<div class="inline-flex"><button type="button" id="detail" class="btn btn-block btn-primary karyawan-img-small" style="border-radius:50%;"> <i class="fa fa-eye" aria-hidden="true"></i></button>';
            $btn_edit = '<a href="/penjualan_online/ubah/' + data + '"><button type="button" class="btn btn-block btn-warning karyawan-img-small" style="border-radius:50%;"><i class="fas fa-edit"></i></button></a>';
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
    });




    // $.ajax({
    //   url: '/penjualan_online/detail/data/' + rows[0]['id'],
    //   type: 'get',
    //   dataType: 'JSON',
    //   success: function(data) {

    //     jQuery('#tabel_detail > tbody >tr').empty();
    //     $.each(data, function(key, value) {
    //       $('#tabel_detail').append('<tr><td>' + value['id'] + '</td></tr>');
    //     });
    //   }
    // });
  });
</script>

@endsection