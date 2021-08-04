@extends('adminlte.page')

@section('title', 'Beta Version')

@section('content_header')
<h1 class="m-0 text-dark">Dashboard</h1>
@stop

@section('content')
<div class="row">
  <div class="col-lg-12">
    <div class="alert alert-danger alert-dismissible" id="alert" hidden>
      Mohon cek kembali form anda
    </div>
    <div class="card">
      <div class="card-body">
        <div class="row">
          <div class="col-lg-3">
          </div>
          <div class="col-lg-6">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Filter Data : </h3>
              </div>
              <div class="form-horizontal" id="form_cari">
                <div class="card-body">
                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Filter</label>
                    <div class="col-sm-8" style="margin-top:7px;">
                      <div class="icheck-success d-inline col-sm-4">
                        <input type="radio" name="filter" value="divisi">
                        <label for="no">
                          Divisi
                        </label>
                      </div>
                      <div class="icheck-warning d-inline col-sm-4">
                        <input type="radio" name="filter" value="karyawan">
                        <label for="sample">
                          Karyawan
                        </label>
                      </div>
                      <span class="invalid-feedback" role="alert" id="kondisi-msg"></span>
                    </div>
                  </div>
                  <div class="form-group row" id="divisi" hidden>
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Divisi</label>
                    <div class="col-sm-10">
                      <select type="text" class="form-control select2" id="divisi_id">
                        <option value="">Semua data</option>
                        @foreach($divisi as $d)
                        <option value="{{$d->id}}">{{$d->nama}}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="form-group row" id="karyawan" hidden>
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Nama</label>
                    <div class="col-sm-10">
                      <select type="text" class="form-control select2" id="karyawan_id">
                        <option value="">Semua data</option>
                        @foreach($karyawan as $d)
                        <option value="{{$d->id}}">{{$d->nama}}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Laporan</label>
                    <div class="col-sm-8" style="margin-top:7px;">
                      <div class="icheck-success d-inline col-sm-4">
                        <input type="radio" name="filter_bulanan" value="berat">
                        <label for="no">
                          Berat Badan
                        </label>
                      </div>
                      <div class="icheck-warning d-inline col-sm-4">
                        <input type="radio" name="filter_bulanan" value="gcu">
                        <label for="sample">
                          GCU
                        </label>
                      </div>
                      <span class="invalid-feedback" role="alert" id="kondisi-msg"></span>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="keterangan" class="col-sm-2 col-form-label">Mulai</label>
                    <div class="col-sm-10">
                      <div class="input-group mb-3">
                        <div class="input-group-append">
                          <span class="input-group-text"> <i class="far fa-calendar-alt"></i></span>
                        </div>
                        <input type="date" class="form-control " id="tgl_1" name="tgl_1">
                      </div>
                      @if($errors->has('tgl_1'))
                      <div class="text-danger">
                        {{ $errors->first('tgl_1')}}
                      </div>
                      @endif
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="keterangan" class="col-sm-2 col-form-label">Selesai</label>
                    <div class="col-sm-10">
                      <div class="input-group mb-3">
                        <div class="input-group-append">
                          <span class="input-group-text"> <i class="far fa-calendar-alt"></i></span>
                        </div>
                        <input type="date" class="form-control " id="tgl_2" name="tgl_2">
                      </div>
                      @if($errors->has('tgl_2'))
                      <div class="text-danger">
                        {{ $errors->first('tgl_2')}}
                      </div>
                      @endif
                    </div>
                  </div>
                </div>
                <div class="card-footer">
                  <button type="submit" class="btn btn-success" id="cari"><i class="fas fa-search"></i> Cari</button>
                  <button type="submit" class="btn btn-danger float-right" id="reset"><i class="fas fa-sync"></i> Reset</button>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-2">
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-12" id="gcu_card" hidden>
    <div class="card">
      <div class="card-body">
        <div class='table-responsive'>
          <h2>GCU</h2>
          <table id="gcu_tabel" class="table table-hover styled-table table-striped">
            <thead style="text-align: center;">
              <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Divisi</th>
                <th>Nama</th>
                <th>Glucose</th>
                <th>Cholesterol</th>
                <th>Uric Acid</th>
                <th>Catatan</th>
              </tr>
            </thead>
            <tbody style="text-align: center;">
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-12" id="berat_card" hidden>
    <div class="card">
      <div class="card-body">
        <div class='table-responsive'>
          <h2>Berat Badan</h2>
          <table id="berat_tabel" class="table table-hover styled-table table-striped">
            <thead style="text-align: center;">
              <tr>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th colspan="5">Komposisi</th>
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
<script src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.print.min.js "></script>
<script src="https://cdn.datatables.net/buttons/1.7.1/css/buttons.bootstrap4.min.css "></script>


<script>
  $(document).ready(function() {
    $('input[type=radio][name=filter]').on('change', function() {
      if (this.value == 'divisi') {
        $('#karyawan').attr('hidden', 'hidden');
        $('#divisi').removeAttr('hidden');
      } else if (this.value == 'karyawan') {
        $('#divisi').attr('hidden', 'hidden');
        $('#karyawan').removeAttr('hidden');
      }
    });
  });
  $('#cari').click(function() {
    var filter = $("input[name='filter']:checked").val();
    var filter_bulanan = $("input[name='filter_bulanan']:checked").val();

    if (filter == "divisi") {
      var id = $("#divisi_id").val();
    } else if (filter == "karyawan") {
      var id = $("#karyawan_id").val();
    } else {
      $('#karyawan').attr('hidden', 'hidden');
      $('#divisi').attr('hidden', 'hidden');
      var id = "";
    }
    var jenis = $("#jenis").val();
    var tgl_1 = $("#tgl_1").val();
    var tgl_2 = $("#tgl_2").val();

    var date1 = new Date(tgl_1);
    var date2 = new Date(tgl_2);

    if (date1 > date2 || id == "" || filter == "") {
      $('#alert').removeAttr('hidden');
    } else if (date1 < date2) {
      //********
      $('#alert').attr('hidden', 'hidden');
      if (filter_bulanan == 'gcu') {
        $('#gcu_card').removeAttr('hidden');
        $('#berat_card').attr('hidden', 'hidden');
        $('#gcu_tabel').removeAttr('style');
        $('#gcu_tabel').DataTable().ajax.url('/laporan_bulanan/data/' + filter_bulanan + '/' + filter + '/' + id + '/' + tgl_1 + '/' + tgl_2).load();

      } else if (filter_bulanan == 'berat') {
        $('#berat_card').removeAttr('hidden');
        $('#gcu_card').attr('hidden', 'hidden');
        $('#berat_tabel').removeAttr('style');
        $('#berat_tabel').DataTable().ajax.url('/laporan_bulanan/data/' + filter_bulanan + '/' + filter + '/' + id + '/' + tgl_1 + '/' + tgl_2).load();
      }
      //********
    } else if (date1 >= date2 || id == "" || filter == "") {
      $('#alert').removeAttr('hidden');
    } else if (date1 <= date2) {
      //********
      $('#alert').attr('hidden', 'hidden');
      if (filter_bulanan == 'gcu') {
        $('#gcu_card').removeAttr('hidden');
        $('#berat_card').attr('hidden', 'hidden');
        $('#gcu_tabel').removeAttr('style');
        $('#gcu_tabel').DataTable().ajax.url('/laporan_bulanan/data/' + filter_bulanan + '/' + filter + '/' + id + '/' + tgl_1 + '/' + tgl_2).load();

      } else if (filter_bulanan == 'berat') {
        $('#berat_card').removeAttr('hidden');
        $('#gcu_card').attr('hidden', 'hidden');
        $('#berat_tabel').removeAttr('style');
        $('#berat_tabel').DataTable().ajax.url('/laporan_bulanan/data/' + filter_bulanan + '/' + filter + '/' + id + '/' + tgl_1 + '/' + tgl_2).load();
      }
      //********
    } else {
      $('#alert').removeAttr('hidden');
    }
    console.log(filter);
    console.log(filter_bulanan);
    console.log(id);
    console.log(tgl_1);
    console.log(tgl_2);
  });

  $('#reset').click(function() {
    $('#gcu_tabel').DataTable().ajax.url('/laporan_bulanan/data/' + 'y' + '/' + 'x' + '/' + 0 + '/' + 0 + '/' + 0).load();
    $('#rapid').DataTable().ajax.url('/laporan_bulanan/data/' + 'y' + '/' + 'x' + '/' + 0 + '/' + 0 + '/' + 0).load();
  });
</script>
<script>
  $(function() {
    var gcu_tabel = $('#gcu_tabel').DataTable({
      processing: true,
      dom: 'Bfrtip',
      serverSide: false,
      language: {
        processing: '<i class="fa fa-spinner fa-spin"></i> Tunggu Sebentar'
      },
      buttons: [{
          extend: 'excel',
          title: 'Laporan Kesehatan Bulanan GCU',
          text: '<i class="far fa-file-excel"></i> Export',
          className: "btn btn-primary"
        },
        {
          extend: 'print',
          title: 'Laporan Kesehatan Bulanan GCU',
          text: '<i class="fas fa-print"></i> Cetak',
          className: "btn btn-primary"
        },
      ],
      ajax: '/laporan_bulanan/data/' + 'y' + '/' + 'x' + '/' + 0 + '/' + 0 + '/' + 0,
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
          data: 'xx'
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
      ]

    });



    var berat_tabel = $('#berat_tabel').DataTable({
      processing: true,
      dom: 'Bfrtip',
      serverSide: false,
      language: {
        processing: '<i class="fa fa-spinner fa-spin"></i> Tunggu Sebentar'
      },
      buttons: [{
          extend: 'excel',
          title: 'Laporan Kesehatan Bulanan Berat',
          text: '<i class="far fa-file-excel"></i> Export',
          className: "btn btn-primary"
        },
        {
          extend: 'print',
          title: 'Laporan Kesehatan Bulanan Berat',
          text: '<i class="fas fa-print"></i> Cetak',
          className: "btn btn-primary"
        },
      ],
      ajax: '/laporan_bulanan/data/' + 'y' + '/' + 'x' + '/' + 0 + '/' + 0 + '/' + 0,
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
      ]
    });
  });
</script>

@endsection