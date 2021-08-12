@extends('adminlte.page')

@section('title', 'Beta Version')

@section('content_header')
<h1 class="m-0 text-dark">Kalibrasi</h1>
@stop

@section('content')
<div class="row">
  <div class="col-lg-12">
    <div class="card">
      <div class="card-body">
        <div class='table-responsive'>
          <h2></h2>
          <table id="tabel" class="table table-hover styled-table table-striped">
            <thead style="text-align: center;">
              <tr>
                <th>No</th>
                <th>No Pendaftaran</th>
                <th>No BPPB</th>
                <th>Gambar</th>
                <th>Tipe dan Nama</th>
                <th>Jumlah</th>
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
<div class="modal fade  bd-example-modal-xl" id="detail_mod" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-xl" role="document">
    <div class="card-body">
      <form method="post" action="/kesehatan_harian_mingguan_tensi/aksi_ubah">
        {{ csrf_field() }}
        {{ method_field('PUT')}}
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" id="myModalLabel">
              <div class="data_detail_head">FOX - BABY </div>
            </h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          </div>
          <div class="modal-body">
            <table class="table table-hover styled-table table-striped" width="100%" id="tabel_detail">
              <thead>
                <tr>
                  <th>No</th>
                  <th>No Seri</th>
                  <th>Tgl Kalibrasi</th>
                  <th>Tgl Selesai</th>
                  <th>Tgl Penyerahan</th>
                  <th>Sertifikat</th>
                  <th>SJ</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
              </tbody>
            </table>
          </div>
        </div>
      </form>
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
      serverSide: false,
      language: {
        processing: '<i class="fa fa-spinner fa-spin"></i> Tunggu Sebentar'
      },
      ajax: '/acc_kalibrasi/data',
      columns: [{
          data: 'DT_RowIndex',
          orderable: false,
          searchable: false
        }, {
          data: 'order',
        },
        {
          data: 'bppb.no_bppb',
        },
        {
          data: 'gambar',
          orderable: false,
          searchable: false
        },
        {
          data: 'bppb.detailproduk.nama',
        },
        {
          data: 'bppb.jumlah',
          orderable: false,
          searchable: false
        },
        {
          data: 'button',
          orderable: false,
          searchable: false
        }
      ]
    });

    $('#tabel > tbody').on('click', '#detail', function() {
      var rows = tabel.rows($(this).parents('tr')).data();
      var y = $('#tabel_detail').DataTable({
        processing: true,
        destroy: true,
        serverSide: false,
        language: {
          processing: '<i class="fa fa-spinner fa-spin"></i> Tunggu Sebentar'
        },
        ajax: '/acc_list_kalibrasi/data',
        columns: [{
            data: 'DT_RowIndex',
            orderable: false,
            searchable: false
          },
          {
            data: 'no_barcode'
          },
          {
            data: 'tanggal_kalibrasi'
          },
          {
            data: 'tanggal_selesai'
          },
          {
            data: 'tanggal_penyerahan'
          },
          {
            data: 'id'
          },
          {
            data: 'id'
          },
          {
            data: 'cetak'
          }
        ],
      });
      $('#detail_mod').modal('show');
    })
  });
</script>
@endsection