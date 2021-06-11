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
      {{session()->get('success')}}
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
          <h2>Kesehatan Bulanan</h2>
          <div class="form-group row">
            <label for="no_pemeriksaan" class="col-sm-4 col-form-label" style="text-align:right;">Data</label>
            <div class="col-sm-8">
              <select type="text" class="form-control @error('form') is-invalid @enderror select2" name="form" style="width:45%;" id="form">
                <option value="0">Pilih Data</option>
                <option value="berat">Berat Badan</option>
                <option value="gcu">GCU (Glucose, Cholesterol, Uric ACID)</option>
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
          <table id="berat_tabel" class="table table-hover styled-table table-striped" style="display:none">
            <thead style="text-align: center;">
              <tr>
                <th colspan="13">
                  <a href="/kesehatan_bulanan/tambah" style="color: white;"><button type="button" class="btn btn-block btn-success btn-sm" style="width: 200px;"><i class="fas fa-plus"></i> &nbsp; Tambah</i></button></a>
                </th>
              </tr>
              <tr>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th colspan="5">Komposisi</th>
                <th></th>
              </tr>
              <tr>
                <th>No</th>
                <th>Tgl Pengecekan</th>
                <th>Divisi</th>
                <th>Nama</th>
                <th>Tinggi</th>
                <th>Berat</th>
                <th>BMI</th>
                <th>Fat</th>
                <th>Tbw</th>
                <th>Muscle</th>
                <th>Bone</th>
                <th>Kalori</th>
                <th></th>
              </tr>
            </thead>
            <tbody style="text-align: center;">
            </tbody>
          </table>
          <table id="gcu_tabel" class="table table-hover styled-table table-striped" style="display:none">
            <thead style="text-align: center;">
              <tr>
                <th colspan="12">
                  <a href="/kesehatan_bulanan/tambah" style="color: white;"><button type="button" class="btn btn-block btn-success btn-sm" style="width: 200px;"><i class="fas fa-plus"></i> &nbsp; Tambah</i></button></a>
                </th>
              </tr>
              <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Divisi</th>
                <th>Nama</th>
                <th>Glucose</th>
                <th>Cholesterol</th>
                <th>Uric Acid</th>
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
<div class="modal fade  bd-example-modal-xl" id="detail_mod_berat" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-xl" role="document">
    <form method="post" action="/kesehatan_bulanan_berat/aksi_ubah">
      {{ csrf_field() }}
      {{ method_field('PUT')}}
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="myModalLabel">
            <div class="data_detail_head_gcu"></div>
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
                  <th colspan="5">Komposisi Tubuh</th>
                  <th></th>
                </tr>
                <tr>
                  <th>Tgl Pengecekan</th>
                  <th>Berat</th>
                  <th>Fat</th>
                  <th>Tbw</th>
                  <th>Muscle</th>
                  <th>Bone</th>
                  <th>Kalori</th>
                  <th>Catatan</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>
                    <input type="text" class="form-control" readonly id="tgl">
                  </td>
                  <td>
                    <div class="input-group mb-1">
                      <input type="text" class="form-control d-none" name="id" id="id">
                      <input type="text" class="form-control" name="berat" id="berat">
                      <div class="input-group-append">
                        <span class="input-group-text">Kg</span>
                      </div>
                    </div>
                  </td>
                  <td>
                    <div class="input-group mb-1">
                      <input type="text" class="form-control" name="lemak" id="lemak">
                      <div class="input-group-append">
                        <span class="input-group-text">gram</span>
                      </div>
                    </div>
                  </td>
                  <td>
                    <div class="input-group mb-1">
                      <input type="text" class="form-control" name="kandungan_air" id="kandungan_air">
                      <div class="input-group-append">
                        <span class="input-group-text">%</span>
                      </div>
                    </div>
                  </td>
                  <td>
                    <div class="input-group mb-1">
                      <input type="text" class="form-control" name="otot" id="otot">
                      <div class="input-group-append">
                        <span class="input-group-text">Kg</span>
                      </div>
                    </div>
                  </td>
                  <td>
                    <div class="input-group mb-1">
                      <input type="text" class="form-control" name="tulang" id="tulang">
                      <div class="input-group-append">
                        <span class="input-group-text">Kg</span>
                      </div>
                    </div>
                  </td>
                  <td>
                    <div class="input-group mb-1">
                      <input type="text" class="form-control" name="kalori" id="kalori">
                      <div class="input-group-append">
                        <span class="input-group-text">kkal</span>
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
<!-- Modal Detail -->
<div class="modal fade  bd-example-modal-lg" id="detail_mod_gcu" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <form method="post" action="/kesehatan_bulanan_gcu/aksi_ubah">
      {{ csrf_field() }}
      {{ method_field('PUT')}}
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="myModalLabel">
            <div class="data_detail_head_gcu"></div>
          </h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
          <div class="data_detail">
            <table style="text-align: center;" class="table table-hover styled-table table-striped" width="100%" id="tabel_detail">
              <thead>
                <tr>
                  <th></th>
                  <th colspan="4">Pengukuran GCU (Glucose, Cholesterol, Uric ACID)</th>
                </tr>
                <tr>
                  <th>Tgl Pengecekan</th>
                  <th>Glucose</th>
                  <th>Cholesterol</th>
                  <th>Uric Acid</th>
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
                      <input type="text" class="form-control" name="glukosa" id="glukosa">
                      <div class="input-group-append">
                        <span class="input-group-text">mg/dl</span>
                      </div>
                    </div>
                  </td>
                  <td>
                    <div class="input-group mb-3">
                      <input type="text" class="form-control" name="kolesterol" id="kolesterol">
                      <div class="input-group-append">
                        <span class="input-group-text">mg/dl</span>
                      </div>
                    </div>
                  </td>
                  <td>
                    <div class="input-group mb-3">
                      <input type="text" class="form-control" name="asam_urat" id="asam_urat">
                      <div class="input-group-append">
                        <span class="input-group-text">mg/dl</span>
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
    if (form == 'berat') {
      var gcu = $('#gcu_tabel').DataTable();
      gcu.destroy();
      $("#gcu_tabel").hide();
      $("#detail_gagal").hide();
      $("#berat_tabel").show();
      $(function() {
        var berat_tabel = $('#berat_tabel').DataTable({
          processing: true,
          serverSide: true,
          language: {
            processing: '<i class="fa fa-spinner fa-spin"></i> Tunggu Sebentar'
          },
          ajax: '/kesehatan_bulanan_berat/data',
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
              data: 'ti'
            },
            {
              data: 'z'
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
              data: 'l'
            },
            {
              data: 'k'
            },
            {
              data: 'o'
            },
            {
              data: 't'
            },
            {
              data: 'ka'
            },
            {
              data: 'button'
            },
          ]
        });

        $(function() {
          $('#berat_tabel > tbody ').on('click', '#edit_berat', function() {
            var rows = berat_tabel.rows($(this).parents('tr')).data();
            console.log(rows);
            $('input[id="id"]').val(rows[0]['id']);
            $('textarea[id="catatan"]').val(rows[0]['keterangan']);
            $('.data_detail_head_gcu').html(rows[0].karyawan['nama']);
            $('input[id="tgl"]').val(rows[0]['tgl_cek']);
            $('input[id="berat"]').val(rows[0]['berat']);
            $('input[id="lemak"]').val(rows[0]['lemak']);
            $('input[id="kandungan_air"]').val(rows[0]['kandungan_air']);
            $('input[id="otot"]').val(rows[0]['otot']);
            $('input[id="lemak"]').val(rows[0]['lemak']);
            $('input[id="tulang"]').val(rows[0]['tulang']);
            $('input[id="kalori"]').val(rows[0]['kalori']);
            $('#detail_mod_berat').modal('show');
          });
        });
      });


    } else if (form == 'gcu') {
      var berat = $('#berat_tabel').DataTable();
      berat.destroy();
      $("#detail_gagal").hide();
      $("#berat_tabel").hide();
      $("#gcu_tabel").show();

      $(function() {
        var gcu_tabel = $('#gcu_tabel').DataTable({
          processing: true,
          serverSide: true,
          language: {
            processing: '<i class="fa fa-spinner fa-spin"></i> Tunggu Sebentar'
          },
          ajax: '/kesehatan_bulanan_gcu/data',
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
              data: 'glu',
              render: function(data) {
                $l = '<br><span class="badge bg-danger">' + data + '</span>';
                $n = '<br><span class="badge bg-success">' + data + '</span>';
                $w = '<br><span class="badge bg-warning">' + data + '</span>';

                if (data >= 200) {
                  return 'Diabetes' + $l;
                } else if (data < 200) {
                  return 'Normal' + $n;;
                } else if (data >= 140 && data <= 199) {
                  return 'Pra Diabetes' + $w;
                } else {
                  return '';
                }
              }
            },
            {
              data: 'kol',
              render: function(data) {
                $l = '<br><span class="badge bg-danger">' + data + '</span>';
                $n = '<br><span class="badge bg-success">' + data + '</span>';
                $w = '<br><span class="badge bg-warning">' + data + '</span>';
                if (data > 239) {
                  return 'Bahaya' + $l;
                } else if (data < 200) {
                  return 'Normal' + $n;
                } else if (data >= 200 && data <= 239) {
                  return 'Hati hati' + $w;
                } else {
                  return '';
                }
              }
            },
            {
              data: 'asam',
              render: function(data) {
                $l = '<br><span class="badge bg-danger">' + data + '</span>';
                $n = '<br><span class="badge bg-success">' + data + '</span>';
                $w = '<br><span class="badge bg-warning">' + data + '</span>';

                if (data >= 2 && data <= 7.5) {
                  return 'Normal' + $n;
                } else if (data > 7.5) {
                  return 'Asam Urat' + $l;
                } else {
                  return '';
                }
              }
            },
            {
              data: 'keterangan'
            },
            {
              data: 'button'
            },
          ]
        });
        $('#gcu_tabel tbody').on('click', '#edit_gcu', function() {
          var rows = gcu_tabel.rows($(this).parents('tr')).data();
          console.log(rows);
          $('input[id="id"]').val(rows[0]['id']);
          //$('textarea[id="catatan"]').val(rows[0]['keterangan']);
          $('.data_detail_head_gcu').html(rows[0].karyawan['nama']);
          $('input[id="tgl"]').val(rows[0]['tgl_cek']);
          $('input[id="glukosa"]').val(rows[0]['glukosa']);
          $('input[id="kolesterol"]').val(rows[0]['kolesterol']);
          $('input[id="asam_urat"]').val(rows[0]['asam_urat']);
          $('#detail_mod_gcu').modal('show');
        });
      });
    } else {
      $("#berat_tabel").hide();
      $("#gcu_tabel").hide();
      var berat = $('#berat_tabel').DataTable();
      berat.destroy();
      var gcu = $('#gcu_tabel').DataTable();
      gcu.destroy();
      $("#detail_gagal").show();
    }
  });
</script>
@endsection