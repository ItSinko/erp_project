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
          <h2>Kesehatan Mingguan</h2>
          <div class="form-group row">
            <label for="no_pemeriksaan" class="col-sm-4 col-form-label" style="text-align:right;">Data</label>
            <div class="col-sm-8">
              <select type="text" class="form-control @error('form') is-invalid @enderror select2" name="form" style="width:45%;" id="form">
                <option value="0">Pilih Data</option>
                <option value="tensi">Pengukuran Tensi</option>
                <option value="rapid">Pengecekan Covid</option>
              </select>
            </div>
          </div>
          <div class="row " id="detail_gagal">
            <div class="col-lg-4 col-md-4">
            </div>
            <div class="col-lg-4 col-md-4">
              <p>Data yang dicari tidak ada</p>
            </div>
            <div class="col-lg-4 col-md-4">
            </div>
          </div>
          <table id="tensi_tabel" class="table table-hover styled-table table-striped" style="display:none">
            <thead style="text-align: center;">
              <tr>
                <th colspan="12">
                  <a href="/kesehatan_mingguan/tambah" style="color: white;"><button type="button" class="btn btn-block btn-success btn-sm" style="width: 200px;"><i class="fas fa-plus"></i> &nbsp; Tambah</i></button></a>
                </th>
              </tr>
              <tr>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th colspan="2">Pengukuran Tensi</th>
                <th></th>
                <th></th>
              </tr>
              <tr>
                <th>No</th>
                <th>Hasil</th>
                <th>Tgl Pengecekan</th>
                <th>Divisi</th>
                <th>Nama</th>
                <th>Sistolik</th>
                <th>Diastolik</th>
                <th>Catatan</th>
                <th></th>
              </tr>
            </thead>
            <tbody style="text-align: center;">
            </tbody>
          </table>
          <table id="rapid_tabel" class="table table-hover styled-table table-striped" style="display:none">
            <thead style="text-align: center;">
              <tr>
                <th colspan="12">
                  <a href="/kesehatan_mingguan/tambah" style="color: white;"><button type="button" class="btn btn-block btn-success btn-sm" style="width: 200px;"><i class="fas fa-plus"></i> &nbsp; Tambah</i></button></a>
                </th>
              </tr>
              <tr>
                <th>No</th>
                <th>Pengecekan</th>
                <th>Tgl Pengecekan</th>
                <th>Divisi</th>
                <th>Nama</th>
                <th>Jenis</th>
                <th>Hasil</th>
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
<div class="modal fade  bd-example-modal-lg" id="detail_mod_tensi" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <form method="post" action="/kesehatan_mingguan_tensi/aksi_ubah">
      {{ csrf_field() }}
      {{ method_field('PUT')}}
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="myModalLabel">
            <div class="data_detail_head_tensi"></div>
          </h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
          <div class="data_detail">
            <table style="text-align: center;" class="table table-hover styled-table table-striped" width="100%" id="tabel_detail">
              <thead>
                <tr>
                  <th></th>
                  <th colspan="2">Pengukuran Tensi</th>
                  <th></th>
                </tr>
                <tr>
                  <th>Tgl Pengecekan</th>
                  <th>Sistolik</th>
                  <th>Diastolik</th>
                  <th>Catatan</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>
                    <input type="text" class="form-control" readonly id="tgl">
                  </td>
                  <td>
                    <div class="input-group mb-3">
                      <input type="text" class="form-control d-none" name="id" id="id">
                      <input type="text" class="form-control" name="sistolik" id="sistolik">
                      <div class="input-group-append">
                        <span class="input-group-text">mmHg</span>
                      </div>
                    </div>
                  </td>
                  <td>
                    <div class="input-group mb-3">
                      <input type="text" class="form-control" name="diastolik" id="diastolik">
                      <div class="input-group-append">
                        <span class="input-group-text">mmHg</span>
                      </div>
                    </div>
                  </td>
                  <td>
                    <textarea type="text" class="form-control" name="catatan" id="catatan"></textarea>
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
<!-- Modal Detail -->
<div class="modal fade  bd-example-modal-lg" id="detail_mod_rapid" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <form method="post" action="/kesehatan_mingguan_rapid/aksi_ubah">
      {{ csrf_field() }}
      {{ method_field('PUT')}}
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="myModalLabel">
            <div class="data_detail_head_rapid"></div>
          </h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
          <div class="data_detail">
            <table style="text-align: center;" class="table table-hover styled-table table-striped" width="100%" id="tabel_detail">
              <thead>
                <tr>
                  <th>Tgl Pengecekan</th>
                  <th>Jenis</th>
                  <th>Hasil</th>
                  <th>Catatan</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>
                    <input type="text" class="form-control" readonly id="tgl">
                  </td>
                  <td>
                    <div class="form-check form-check-inline">
                      <input type="text" class="form-control d-none" name="id" id="id">
                      <input class="form-check-input" type="radio" name="jenis" id="jenis" value="Rapid">
                      <label class="form-check-label">Rapid</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="jenis" id="jenis" value="Antigen">
                      <label class="form-check-label">Antigen</label>
                    </div>
                  </td>
                  <td>
                    <div id="rapid" hidden>
                      <div class="form-check form-check-inline">
                        <input type="text" class="form-control d-none" name="id" id="id">
                        <input class="form-check-input" type="radio" name="hasil" id="hasil" value="Non reaktif">
                        <label class="form-check-label">Non reaktif</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="hasil" id="hasil" value="IgG">
                        <label class="form-check-label">IgG</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="hasil" id="hasil" value="IgM">
                        <label class="form-check-label">IgM</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="hasil" id="hasil" value="IgG-IgM">
                        <label class="form-check-label">IgG-IgM</label>
                      </div>
                    </div>
                    <div id="antigen" hidden>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="hasil" id="hasil" value="C">
                        <label class="form-check-label">C</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="hasil" id="hasil" value="C/T">
                        <label class="form-check-label">C/T</label>
                      </div>
                    </div>
                  </td>
                  <td>
                    <textarea type="text" class="form-control" name="catatan" id="catatan"></textarea>
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
  $('#form').change(function() {
    var form = $(this).val();
    if (form == 'tensi') {
      $('#detail_mod_rapid form')[0].reset();
      var rapid = $('#rapid_tabel').DataTable();
      rapid.destroy();
      $("#rapid_tabel").hide();
      $("#detail_gagal").hide();
      $("#tensi_tabel").show();
      $(function() {
        var tensi_tabel = $('#tensi_tabel').DataTable({
          processing: true,
          serverSide: true,
          language: {
            processing: '<i class="fa fa-spinner fa-spin"></i> Tunggu Sebentar'
          },
          ajax: '/kesehatan_mingguan_tensi/data',
          columns: [{
              data: 'DT_RowIndex',
              orderable: false,
              searchable: false
            },
            {
              data: 'hasil'
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
              data: 'sis'
            },
            {
              data: 'dias'
            },
            {
              data: 'keterangan'
            },
            {
              data: 'button'
            },
          ]
        });
        $('#tensi_tabel tbody').on('click', '#edit_tensi', function() {
          var rows = tensi_tabel.rows($(this).parents('tr')).data();
          $('.data_detail_head_tensi').html(rows[0].karyawan['nama']);
          $('input[id="id"]').val(rows[0]['id']);
          $('input[id="sistolik"]').val(rows[0]['sistolik']);
          $('input[id="tgl"]').val(rows[0]['tgl_cek']);
          $('input[id="diastolik"]').val(rows[0]['diastolik']);
          $('textarea[id="catatan"]').val(rows[0]['keterangan']);
          $('#detail_mod_tensi').modal('show');
        });
      });
    } else if (form == 'rapid') {
      $('#detail_mod_tensi form')[0].reset();
      var tensi = $('#tensi_tabel').DataTable();
      tensi.destroy();
      $("#detail_gagal").hide();
      $("#tensi_tabel").hide();
      $("#rapid_tabel").show();

      $(function() {
        var rapid_tabel = $('#rapid_tabel').DataTable({
          processing: true,
          serverSide: true,
          language: {
            processing: '<i class="fa fa-spinner fa-spin"></i> Tunggu Sebentar'
          },
          ajax: '/kesehatan_mingguan_rapid/data',
          columns: [{
              data: 'DT_RowIndex',
              orderable: false,
              searchable: false
            },
            {
              data: 'tgl_cek'
            },
            {
              data: 'z'
            },
            {
              data: 'x'
            },
            {
              data: 'karyawan.nama'
            },
            {
              data: 'jenis'
            },
            {
              data: 'hasil'
            },
            {
              data: 'keterangan'
            },
            {
              data: 'button'
            },
          ]
        });

        $('#rapid_tabel tbody').on('click', '#edit_rapid', function() {
          var rows = rapid_tabel.rows($(this).parents('tr')).data();
          console.log(rows);
          if (rows[0]['jenis'] == 'Rapid') {
            $('#rapid').removeAttr('hidden');
            $('#antigen').attr('hidden', 'hidden');
          } else {
            $('#antigen').removeAttr('hidden');
            $('#rapid').attr('hidden', 'hidden');
          }
          $('input[id="id"]').val(rows[0]['id']);
          $('textarea[id="catatan"]').val(rows[0]['keterangan']);
          $('.data_detail_head_rapid').html(rows[0].karyawan['nama']);
          $('input[id="tgl"]').val(rows[0]['tgl_cek']);
          $('input[name="hasil"]').removeAttr('checked');
          $('input[name="jenis"]').removeAttr('checked');
          $('input[name="hasil"][value="' + rows[0]['hasil'] + '"]').attr('checked', 'checked');
          $('input[name="jenis"][value="' + rows[0]['jenis'] + '"]').attr('checked', 'checked');
          $('#detail_mod_rapid').modal('show');
        });
      });
    } else {
      $("#tensi_tabel").hide();
      $("#rapid_tabel").hide();
      var tensi = $('#tensi_tabel').DataTable();
      tensi.destroy();
      var rapid = $('#rapid_tabel').DataTable();
      rapid.destroy();
      $("#detail_gagal").show();
    }

    $('input[type=radio][name=jenis]').on('change', function() {
      if (this.value == 'Rapid') {
        $('#rapid').removeAttr('hidden');
        $('#antigen').attr('hidden', 'hidden');
        $('input[name="hasil"]').prop('checked', false);
      } else {
        $('#antigen').removeAttr('hidden');
        $('#rapid').attr('hidden', 'hidden');
        $('input[name="hasil"]').prop('checked', false);
      }
    });
    $('#hasil').prop("required", true);
  });
</script>
@endsection