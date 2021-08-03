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
                <th>Umur</th>
                <th>Berat</th>
                <th>Tinggi</th>
                <th>BMI</th>
                <th>Vaksin</th>
                <th>Buta warna</th>
                <th>Suhu</th>
                <th>SPO2</th>
                <th>Pr</th>
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
            <!-- /.card-header -->
            <!-- form start -->
            <form role="form">
              <div class="card-body">
                <div class="form-group">
                  <label for="lemak" style="text-align:right;">Tgl Cek</label>
                  <input type="date" class="form-control" name="tgl_cek" id="lemak" placeholder="Masukkan jumlah lemak">
                </div>
                <div class="form-group">
                  <label for="keterangan" style=" text-align:right;">Tinggi Badan</label>
                  <div class="input-group mb-3">
                    <input type="number" class="form-control" name="tinggi" id="tinggi" readonly>
                    <div class="input-group-append">
                      <span class="input-group-text">Cm</span>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="keterangan" style=" text-align:right;">Berat Badan</label>
                  <div class="input-group mb-3">
                    <input type="number" class="form-control" name="berat" id="berat" required>
                    <div class="input-group-append">
                      <span class="input-group-text">Kg</span>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="lemak" style="text-align:right;">Lemak</label>
                  <input type="text" class="form-control" name="lemak" id="lemak" placeholder="Masukkan jumlah lemak">
                </div>
                <div class="form-group">
                  <label for="lemak" style="text-align:right;">Kandungan Air</label>
                  <input type="text" class="form-control" name="lemak" placeholder="Masukkan jumlah kandungan air">
                </div>
                <div class="form-group">
                  <label for="lemak" style="text-align:right;">Massa Otot</label>
                  <input type="text" class="form-control" name="otot" placeholder="Masukkan jumlah massa otot">
                </div>
                <div class="form-group">
                  <label for="lemak" style="text-align:right;">Tulang</label>
                  <input type="text" class="form-control" name="tulang" placeholder="Masukkan jumlah tulang">
                </div>
                <div class="form-group">
                  <label for="lemak" style="text-align:right;">Kalori</label>
                  <input type="text" class="form-control" name="kalori" placeholder="Masukkan jumlah kalori">
                </div>
              </div>
            </form>
          </div>
          <!-- /.card -->
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
      serverSide: false,
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
          data: 'umur'
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
          data: 'suhu_k'
        },
        {
          data: 'sp'
        },
        {
          data: 'pr'
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

      $('input[id="tinggi"]').val(rows[0]['tinggi']);

      var value1 = $('.modal-body input[id=berat]').val();
      var value2 = rows[0]['tinggi'];

      var sum = value1 / ((value2 / 100) * (value2 / 100))
      $('#bmi').val(sum.toFixed(2));
      if (sum >= 30) {
        $('#status_bmi').text('Kegemukan (Obesitas)');
      } else if (sum >= 25 || sum >= 29.9) {
        $('#status_bmi').text('Kelebihan Berat Badan');
      } else if (sum >= 18.5 || sum >= 24.9) {
        $('#status_bmi').text('Normal (Ideal)');
      } else {
        $('#status_bmi').text('Kekurangan Berat Badan');
      }
      $('#berat_mod').modal('show');
    })
  });
</script>
@endsection