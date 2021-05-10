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
      Data berhasil di ubah
    </div>
    @elseif(session()->has('error') || count($errors) > 0)
    <div class="alert alert-danger alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
      Data gagal di tambahkan
    </div>
    @endif

    <div class="card">
      <div class="card-body">
        <div class='table-responsive'>
          <h2>Kesehatan Harian</h2>
          <table id="tabel" class="table table-hover styled-table table-striped">
            <thead style="text-align: center;">
              <tr>
                <th colspan="12">
                  <a href="/kesehatan_harian/tambah" style="color: white;"><button type="button" class="btn btn-block btn-success btn-sm" style="width: 200px;"><i class="fas fa-plus"></i> &nbsp; Tambah</i></button></a>
                </th>
              </tr>
              <tr>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th colspan="2">Suhu</th>
                <th colspan="2">Oximeter</th>
                <th></th>
              </tr>
              <tr>
                <th>No</th>
                <th>Tgl Pengecekan</th>
                <th>Divisi</th>
                <th>Nama</th>
                <th>Pagi</th>
                <th>Siang</th>
                <th>SpO2 (%)</th>
                <th>PR (bpm)</th>
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
    <form method="post" action="/kesehatan_harian/aksi_ubah">
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
          <div class="data_detail">
            <table style="text-align: center;" class="table table-hover styled-table table-striped" width="100%" id="tabel_detail">
              <thead>
                <tr>
                  <th></th>
                  <th></th>
                  <th colspan="2">Suhu</th>
                  <th colspan="2">Oximeter</th>

                </tr>
                <tr>
                  <th>Tgl Pengecekan</th>
                  <th>Pagi</th>
                  <th>Siang</th>
                  <th>SpO2 (%)</th>
                  <th>PR (bpm)</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>
                    <input type="text" class="form-control" readonly id="tgl">
                  </td>
                  <td>
                    <div class="input-group mb-3">
                      <input type="text" class="form-control" name="suhu_pagi" id="suhu_pagi">
                      <div class="input-group-append">
                        <span class="input-group-text">°C</span>
                      </div>
                    </div>
                  </td>
                  <td>
                    <div class="input-group mb-3">
                      <input type="text" class="form-control d-none" name="id" id="id">
                      <input type="text" class="form-control" name="suhu_siang" id="suhu_siang">
                      <div class="input-group-append">
                        <span class="input-group-text">°C</span>
                      </div>
                    </div>
                  </td>
                  <td>
                    <div class="input-group mb-3">
                      <input type="text" class="form-control" name="spo2" id="spo2">
                      <div class="input-group-append">
                        <span class="input-group-text">%</span>
                      </div>
                    </div>
                  </td>
                  <td>
                    <div class="input-group mb-3">
                      <input type="text" class="form-control" name="pr" id="pr">
                      <div class="input-group-append">
                        <span class="input-group-text">bpm</span>
                      </div>
                    </div>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-success rounded-pill" id="button_tambah" onclick="return confirm('Data akan di ubah ?');"><i class="fas fa-plus"></i>&nbsp;Ubah Data</button>
        </div>
      </div>
    </form>
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
      ajax: '/kesehatan_harian/data',
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
          data: 'karyawan.nama'
        },
        {
          data: 'pagi'
        },
        {
          data: 'siang'
        },
        {
          data: 'sp'
        },
        {
          data: 'prx'
        },
        {
          data: 'button'
        },
      ]
    });

    $('#tabel > tbody').on('click', '#edit', function() {
      var rows = tabel.rows($(this).parents('tr')).data();
      $('.data_detail_head').html(
        rows[0]['karyawan']['nama']
      );
      $('input[id="id"]').val(rows[0]['id']);
      $('input[id="tgl"]').val(rows[0]['tgl_cek']);
      $('input[id="suhu_pagi"]').val(rows[0]['suhu_pagi']);
      $('input[id="suhu_siang"]').val(rows[0]['suhu_siang']);
      $('input[id="spo2"]').val(rows[0]['spo2']);
      $('input[id="pr"]').val(rows[0]['pr']);
      $('#detail_mod').modal('show');
      $('#tambah_mod').on('hidden.bs.modal', function() {
        $('#tambah_mod form')[0].reset();
      });
    });
  });
</script>
@endsection