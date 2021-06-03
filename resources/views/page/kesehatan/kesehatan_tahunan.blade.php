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
          <h2>Kesehatan Tahunan</h2>
          <table id="tabel" class="table table-hover styled-table table-striped">
            <thead style="text-align: center;">
              <tr>
                <th colspan="12">
                  <a href="/kesehatan_tahunan/tambah" style="color: white;"><button type="button" class="btn btn-block btn-success btn-sm" style="width: 200px;"><i class="fas fa-plus"></i> &nbsp; Tambah</i></button></a>
                </th>
              </tr>
              <tr>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th colspan="2">Rabun Mata</th>
                <th></th>
              </tr>
              <tr>
                <th>No</th>
                <th>Tgl Pengecekan</th>
                <th>Pemeriksa</th>
                <th>Divisi</th>
                <th>Nama</th>
                <th>Kiri</th>
                <th>Kanan</th>
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
    <form method="post" action="/kesehatan_tahunan/aksi_ubah">
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
                  <th colspan="2">Rabun Mata</th>
                </tr>
                <tr>
                  <th>Tgl Pengecekan</th>
                  <th>Pemeriksa</th>
                  <th>Kiri</th>
                  <th>Kanan</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>
                    <input type="text" class="form-control d-none" id="id" readonly name="id">
                    <input type="text" class="form-control" id="tgl" readonly>
                  </td>
                  <td>
                    <input type="text" class="form-control" id="pemeriksa" readonly>

                  </td>
                  <td>
                    <input type="text" class="form-control" id="kiri" name="mata_kiri" required>

                  </td>
                  <td>
                    <input type="text" class="form-control" id="kanan" name="mata_kanan" required>
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
      ajax: '/kesehatan_tahunan/data',
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
          data: 'y'
        },
        {
          data: 'mata_kiri',
          render: function(data) {
            $l = '<br><span class="badge bg-danger">Tidak Normal</span>';
            $n = '<br><span class="badge bg-success">Normal</span>';
            if (data <= 6) {
              return data + $l;
            } else {
              return data + $n;
            }
          }
        },
        {
          data: 'mata_kanan',
          render: function(data) {
            $l = '<br><span class="badge bg-danger">Tidak Normal</span>';
            $n = '<br><span class="badge bg-success">Normal</span>';
            if (data <= 6) {
              return data + $l;
            } else {
              return data + $n;
            }
          }
        },
        {
          data: 'button'
        }
      ]
    });

    $('#tabel > tbody').on('click', '#edit_rabun', function() {
      var rows = tabel.rows($(this).parents('tr')).data();
      //   $('.data_detail_head').html(rows[0]['karyawan']['nama']);
      console.log(rows);
      $('input[id="id"]').val(rows[0]['id']);
      $('input[id="tgl"]').val(rows[0]['tgl_cek']);
      $('input[id="kiri"]').val(rows[0]['mata_kiri']);
      $('input[id="kanan"]').val(rows[0]['mata_kanan']);
      $('input[id="pemeriksa"]').val(rows[0]['z']);
      $('#detail_mod').modal('show');
      //   $('#tambah_mod').on('hidden.bs.modal', function() {
      //     $('#tambah_mod form')[0].reset();
      //   });
    });
  });
</script>
@endsection