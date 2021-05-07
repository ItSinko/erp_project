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
          <h2>Kesehatan</h2>
          <table id="tabel" class="table table-hover styled-table table-striped">
            <thead style="text-align: center;">
              <tr>
                <th colspan="12">
                  <a href="/kesehatan/tambah" style="color: white;"><button type="button" class="btn btn-block btn-success btn-sm" style="width: 200px;"><i class="fas fa-plus"></i> &nbsp; Tambah</i></button></a>
                </th>
              </tr>
              <tr>
                <th>No</th>
                <th>Divisi</th>
                <th>Nama</th>
                <th>Berat</th>
                <th>Tinggi</th>
                <th>BMI</th>
                <th>Vaksin</th>
                <th>Buta warna</th>
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
<div class="modal fade  bd-example-modal-lg" id="berat_mod" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
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
            <div class="data_detail">
              <table style="text-align: center;" class="table table-hover styled-table table-striped" width="100%" id="tabel_detail">
                <h6>Pengecekan terakhir</h6>
                <thead>
                  <tr>
                    <th>Tgl Pengecekan</th>
                    <th>Tinggi</th>
                    <th>Berat</th>
                    <th>BMI</th>
                    <th>Catatan</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>
                      1 Januari 2021
                    <td>
                      100 cm
                    </td>
                    <td>
                      25 Kg
                    </td>
                    <td>
                      22.3
                    </td>
                    <td>
                      Makan Terus
                    </td>
                  </tr>
                </tbody>
              </table>
              <table style="text-align: center;" class="table table-hover styled-table table-striped" width="100%" id="tabel_detail">
                <h6>Update pengecekan</h6>
                <thead>
                  <tr>
                    <th>Tgl Pengecekan</th>
                    <th>Tinggi</th>
                    <th>Berat</th>
                    <th>BMI</th>
                    <th>Catatan</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>
                      <input type="date" class="form-control" id="tgl">
                    </td>
                    <td>
                      <div class="input-group mb-3">
                        <input type="text" class="form-control d-none" name="id" id="id">
                        <input type="text" class="form-control" name="tinggi" id="tinggi">
                        <div class="input-group-append">
                          <span class="input-group-text">Cm</span>
                        </div>
                      </div>
                    </td>
                    <td>
                      <div class="input-group mb-3">
                        <input type="text" class="form-control" name="berat" id="berat">
                        <div class="input-group-append">
                          <span class="input-group-text">Kg</span>
                        </div>
                      </div>
                    </td>
                    <td>
                      <input type="text" class="form-control" readonly id="bmi">
                      <small id="status_bmi" class="form-text text-muted"></small>
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
            <button class="btn btn-success rounded-pill" id="button_tambah" onclick="return confirm('Data akan di ubah ?');"><i class="fas fa-plus"></i>&nbsp;Update Data</button>
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
      serverSide: true,
      language: {
        processing: '<i class="fa fa-spinner fa-spin"></i> Tunggu Sebentar'
      },
      ajax: '/kesehatan/data',
      columns: [{
          data: 'DT_RowIndex',
          orderable: false,
          searchable: false
        },
        {
          data: 'x'
        },
        {
          data: 'karyawan.nama'
        },
        {
          data: 'berat_kg'
        },
        {
          data: 'tinggi_cm'
        },
        {
          data: 'bmi',
          render: function(data, type, full) {
            $s = '<br><span class="badge bg-success  ">Sehat</span>';
            $k = '<br><span class="badge bg-danger  ">Kekurangan Berat Badan</span>';
            $o = '<br><span class="badge bg-danger  ">Kegemukan (Obesitas)</span>';
            $g = '<br><span class="badge bg-warning  ">Kelebihan Berat Badan</span>';
            if (data >= 30) {
              return parseFloat(data).toFixed(2) + $o;
            } else if (data >= 25 || data >= 29.9) {
              return parseFloat(data).toFixed(2) + $g;
            } else if (data >= 18.5 || data >= 24.9) {
              return parseFloat(data).toFixed(2) + $s;
            } else {
              return parseFloat(data).toFixed(2) + $k;
            }

          }
        },
        {
          data: 'vaksin'
        },
        {
          data: 'status_mata'
        },
        {
          data: 'button'
        }
      ]
    });


    $('#tabel > tbody').on('click', '#berat', function() {
      var rows = tabel.rows($(this).parents('tr')).data();
      $('.data_detail_head').html(
        rows[0]['karyawan']['nama']
      );
      $('#berat_mod').modal('show');
    })

    $('#tabel > tbody').on('click', '#edit', function() {
      $('#detail_mod').modal('show');
    })
  });
</script>
@endsection