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
                  <a href="/podo_online/tambah" style="color: white;"><button type="button" class="btn btn-block btn-success btn-sm" style="width: 200px;"><i class="fas fa-plus"></i> &nbsp; Tambah</i></button></a>
                </th>
              </tr>
              <tr>
                <th>No</th>
                <th>LKPP</th>
                <th>Distributor</th>
                <th>AK1</th>
                <th>No PO</th>
                <th>Tgl PO</th>
                <th>No DO</th>
                <th>Tgl DO</th>
                <th>Catatan</th>
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
      ajax: '/podo_online/data',
      columns: [{
          data: 'DT_RowIndex',
          orderable: false,
          searchable: false
        },
        {
          data: 'no_lkpp'
        },
        {
          data: 'dsb'
        },
        {
          data: 'ak1'
        },
        {
          data: 'po'
        },
        {
          data: 'tglpo'
        },
        {
          data: 'do'
        },
        {
          data: 'tgldo'
        },
        {
          data: 'keterangan'
        },
        {
          data: 'button',
          orderable: false,
          searchable: false
        },
      ]
    });

    $('#tabel > tbody').on('click', '#detail', function() {
      var rows = $(this).data('id');
      var x = tabel.rows($(this).parents('tr')).data();
      $('.data_detail_head').html(
        'Detail Paket : ' + x[0]['ak1']
      );

      var y = $('#tabel_detail').DataTable({
        processing: true,
        destroy: true,
        serverSide: true,
        language: {
          processing: '<i class="fa fa-spinner fa-spin"></i> Tunggu Sebentar'
        },
        ajax: '/penjualan_online/detail/data/' + rows,
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
      $('#tambah_mod').on('hidden.bs.modal', function() {
        $('#tambah_mod form')[0].reset();
      });
    });
  });
</script>
@endsection