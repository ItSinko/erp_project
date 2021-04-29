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

  });
</script>
@endsection