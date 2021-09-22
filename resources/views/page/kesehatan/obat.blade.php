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
          <h2>Obat</h2>
          <table id="tabel" class="table table-hover styled-table table-striped">
            <thead style="text-align: center;">
              <tr>
                <th colspan="12">
                  <a href="/obat/tambah" style="color: white;"><button type="button" class="btn btn-block btn-success btn-sm" style="width: 200px;"><i class="fas fa-plus"></i> &nbsp; Tambah</i></button></a>
                </th>
              </tr>
              <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Stok</th>
                <th>Keterangan</th>
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
<div class="modal fade  bd-example-modal-lg" id="riwayat_mod" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
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
            <table class="table table-hover styled-table table-striped" width="100%" id="tabel_detail">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Tgl</th>
                  <th>Divisi</th>
                  <th>Nama</th>
                  <th>Analisa</th>
                  <th>Diagnosa</th>
                  <th>Jumlah</th>
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
                <form method="post" action="/obat/aksi_ubah">
                  {{ csrf_field() }}
                  {{method_field('PUT')}}
                  <div class="card">
                    <div class="card-header bg-success">
                      <div class="card-title"><i class="fas fa-plus-circle"></i>&nbsp;Ubah Data</div>
                    </div>
                    <div class="card-body">
                      <div class="col-lg-12">
                        <div class="row">
                          <div class="col-lg-12">
                            <div class="form-horizontal">
                              <input type="text" name="id" class="d-none form-control" id="id" readonly>
                              <table class="table table-bordered table-striped" id="tabel_vaksin">
                                <thead>
                                  <tr>
                                    <th>Nama</th>
                                    <th width="25%">Stok</th>
                                    <th>Keterangan</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <tr>
                                    <td>
                                      <textarea type="text" class="form-control" name="nama" id="nama"></textarea>
                                    </td>
                                    <td>
                                      <div class="input-group mb-3">
                                        <input type="text" class="form-control" id="stok" readonly>
                                        <div class="input-group-append">
                                          <span class="input-group-text">Pcs</span>
                                        </div>
                                      </div>
                                    </td>
                                    <td>
                                      <textarea type="text" class="form-control" name="keterangan" id="keterangan"></textarea>
                                    </td>
                                  </tr>
                                </tbody>
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
<!-- Modal Detail -->
<div class="modal fade  bd-example-modal-xl" id="obat_mod" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-xl" role="document">
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
                <form method="post" action="/obat/stok/aksi_tambah">
                  {{ csrf_field() }}
                  <div class="card">
                    <div class="card-header bg-success">
                      Penambahan Stok
                    </div>
                    <div class="card-body">
                      <div class="col-lg-12">
                        <div class="row">
                          <div class="col-lg-12">
                            <div class="form-horizontal">
                              <input type="text" name="id" class="d-none form-control" id="id" readonly>
                              <table class="table table-bordered table-striped" id="tabel_vaksin">
                                <thead>
                                  <tr>
                                    <th>Tgl Pembelian</th>
                                    <th width="25%">Stok</th>
                                    <th>Keterangan</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <tr>
                                    <td>
                                      <input type="text" class="form-control d-none" name="id" id="id">
                                      <input type="date" class="form-control" name="tgl_pembelian">
                                    </td>
                                    <td>
                                      <div class="input-group mb-3">
                                        <input type="text" class="form-control" id="stok" name="stok">
                                        <div class="input-group-append">
                                          <span class="input-group-text">Pcs</span>
                                        </div>
                                      </div>
                                    </td>
                                    <td>
                                      <textarea type="text" class="form-control" name="keterangan" id="keterangan"></textarea>
                                    </td>
                                  </tr>
                                </tbody>
                              </table>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="card-footer">
                      <span class="float-right"><button class="btn btn-success rounded-pill" id="button_tambah"><i class="fas fa-plus"></i>&nbsp;Update Stok</button></span>
                    </div>
                  </div>
                </form>
                <div class="card">
                  <div class="card-header bg-success">
                    Riwayat Penambahan Stok
                  </div>
                  <div class="card-body">
                    <div class="col-lg-12">
                      <div class="row">
                        <div class="col-lg-12">
                          <div class="form-horizontal">
                            <input type="text" name="id" class="d-none form-control" id="id" readonly>
                            <table class="table table-bordered table-striped" id="tabel_riwayat">
                              <thead>
                                <tr>
                                  <th>No</th>
                                  <th>Tgl Pembelian</th>
                                  <th>Keterangan</th>
                                  <th width="5%">Jumlah</th>
                                </tr>
                              </thead>
                              <tbody>
                              </tbody>
                            </table>
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
    $('#tabel_riwayat').DataTable({

    });

    var tabel = $('#tabel').DataTable({
      processing: true,
      serverSide: false,
      language: {
        processing: '<i class="fa fa-spinner fa-spin"></i> Tunggu Sebentar'
      },
      ajax: '/obat/data',
      columns: [{
          data: 'DT_RowIndex',
          orderable: false,
          searchable: false
        },
        {
          data: 'nama'
        },
        {
          data: 'a'
        },
        {
          data: 'keterangan'
        },
        {
          data: 'button'
        }
      ]
    });
    $('#tabel > tbody').on('click', '#riwayat', function() {
      var rows = tabel.rows($(this).parents('tr')).data();
      $('.data_detail_head').html(
        'Riwayat Pemakaian ' + rows[0]['nama']
      );
      var y = $('#tabel_detail').DataTable({
        processing: true,
        destroy: true,
        serverSide: false,
        language: {
          processing: '<i class="fa fa-spinner fa-spin"></i> Tunggu Sebentar'
        },
        ajax: '/obat/detail/data/' + rows[0]['id'],
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
            data: 'analisa'
          },
          {
            data: 'diagnosa'
          },
          {
            data: 'jumlah'
          }
        ],
      });
      $('#riwayat_mod').modal('show');
    })

    $('#tabel > tbody').on('click', '#edit', function() {
      var rows = tabel.rows($(this).parents('tr')).data();
      $('input[id="id"]').val(rows[0]['id']);
      $('textarea[id="nama"]').val(rows[0]['nama']);
      $('input[id="stok"]').val(rows[0]['stok']);
      $('textarea[id="keterangan"]').val(rows[0]['keterangan']);
      $('#edit_mod').modal('show');
    })

    $('#tabel > tbody').on('click', '#stok', function() {
      var rows = tabel.rows($(this).parents('tr')).data();
      $('.data_detail_head').html(
        'Stok ' + rows[0]['nama']
      );
      $('input[id="id"]').val(rows[0]['id']);

      var y = $('#tabel_riwayat').DataTable({
        processing: true,
        destroy: true,
        serverSide: false,
        pageLength: 5,
        lengthMenu: [
          [5, 10, 20, -1],
          [5, 10, 20, "Semua"]
        ],
        language: {
          processing: '<i class="fa fa-spinner fa-spin"></i> Tunggu Sebentar'
        },
        ajax: '/obat/stok/data/' + rows[0]['id'],
        columns: [{
            data: 'DT_RowIndex',
            orderable: false,
            searchable: false
          },
          {
            data: 'tgl_pembelian'
          },
          {
            data: 'keterangan'
          },
          {
            data: 'a'
          },
        ],
      });


      $('#obat_mod').modal('show');
    })
  });
</script>
@endsection