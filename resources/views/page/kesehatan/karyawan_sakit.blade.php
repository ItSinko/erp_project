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
          <h2>Karyawan Sakit</h2>
          <table id="tabel" class="table table-hover styled-table table-striped">
            <thead style="text-align: center;">
              <tr>
                <th colspan="12">
                  <a href="/karyawan_sakit/tambah" style="color: white;"><button type="button" class="btn btn-block btn-success btn-sm" style="width: 200px;"><i class="fas fa-plus"></i> &nbsp; Tambah</i></button></a>
                </th>
              </tr>
              <tr>
                <th style="width:1%">No</th>
                <th>Tgl</th>
                <th>Divisi</th>
                <th>Nama</th>
                <th>Pemeriksa</th>
                <th>Analisa</th>
                <th>Diagnosa</th>
                <th>Tindak Lanjut</th>
                <th>Hasil</th>
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
              <div class="data_detail_head"></div>
            </h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          </div>
          <div class="modal-body">
            <table class="table table-hover styled-table table-striped" width="100%" id="tabel_detail_obat">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Nama</th>
                  <th>Jumlah</th>
                  <th>Aturan</th>
                  <th>Konsumsi</th>
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
      ajax: '/karyawan_sakit/data',
      columns: [{
          data: 'DT_RowIndex',
          orderable: false,
          searchable: false
        },
        {
          data: 'tgl_cek'
        },
        {
          data: 'x'
        },
        {
          data: 'y'
        },
        {
          data: 'z'
        },
        {
          data: 'analisa'
        },
        {
          data: 'diagnosa'
        },
        {
          data: 'detail_button'
        },
        {
          data: 'keputusan'
        },
        {
          data: 'cetak'
        }
      ]
    });
    $('#tabel > tbody').on('click', '#detail_tindakan', function() {
      var rows = tabel.rows($(this).parents('tr')).data();
      $('.data_detail_head').html(
        rows[0]['tindakan'] + ' : ' + rows[0]['y']
      );
      $('#tabel_detail_obat').DataTable({
        processing: true,
        destroy: true,
        serverSide: false,
        language: {
          processing: '<i class="fa fa-spinner fa-spin"></i> Tunggu Sebentar'
        },
        ajax: '/karyawan_sakit/obat/detail/' + rows[0]['id'],
        columns: [{
            data: 'DT_RowIndex',
            orderable: false,
            searchable: false
          },
          {
            data: 'x',
          },
          {
            data: 'jumlah',
          },
          {
            data: 'aturan',
          },
          {
            data: 'konsumsi',
          }
        ],
      });
      $('#detail_mod').modal('show');
      // $('input[id="nama_obat"]').val(rows[0]['o']);
      // $('input[id="aturan"]').val(rows[0]['d']);
      // $('input[id="konsumsi"]').val(rows[0]['e']);
      // $('input[id="terapi"]').val(rows[0]['f']);
    });
  });
</script>
@endsection