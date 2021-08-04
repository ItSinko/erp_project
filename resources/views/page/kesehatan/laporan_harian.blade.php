@extends('adminlte.page')

@section('title', 'Beta Version')

@section('content_header')
<h1 class="m-0 text-dark">Dashboard</h1>
@stop

@section('adminlte_css')

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
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Laporan</label>
                    <div class="col-sm-10">
                      <label for="inputPassword3" class="col-sm-10 col-form-label">Suhu Harian & SPO2</label>
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
  <div class="col-lg-12" id="harian_card">
    <div class="card">
      <div class="card-body">
        <div class='table-responsive'>
          <h2>Harian</h2>
          <table id="harian" class="table table-hover styled-table table-striped">
            <thead style="text-align: center;">
              <tr>
                <th>No</th>
                <th>Tgl Pengecekan</th>
                <th>Divisi</th>
                <th>Nama</th>
                <th>Pagi</th>
                <th>Siang</th>
                <th>SpO2 (%)</th>
                <th>PR (bpm)</th>
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
      $('#alert').attr('hidden', 'hidden');
      $('#harian').DataTable().ajax.url('/laporan_harian/data/' + filter + '/' + id + '/' + tgl_1 + '/' + tgl_2).load();
    } else if (date1 >= date2 || id == "" || filter == "") {
      $('#alert').removeAttr('hidden');
    } else if (date1 <= date2) {
      $('#alert').attr('hidden', 'hidden');
      $('#harian').DataTable().ajax.url('/laporan_harian/data/' + filter + '/' + id + '/' + tgl_1 + '/' + tgl_2).load();
    } else {
      $('#alert').removeAttr('hidden');
    }

    console.log(filter);
    console.log(id);
  });

  $('#reset').click(function() {
    $('#harian').DataTable().ajax.url('/laporan_harian/data/' + '' + ' / ' + 0 + ' / ' + 0 + ' / ' + 0).load();
  });
</script>
<!-- <script>
  $(document).ready(function() {
    $('#harian').DataTable({
      "paging": false,
      "ordering": false,
      "searching": false,
      "info": false
    });
  });
</script> -->
<script>
  id = 0;
  $(function() {
    var harian = $('#harian').DataTable({
      processing: true,
      dom: 'Bfrtip',
      serverSide: false,
      language: {
        processing: '<i class="fa fa-spinner fa-spin"></i> Tunggu Sebentar'
      },
      buttons: [{
          extend: 'excel',
          title: 'Laporan Kesehatan Harian',
          text: '<i class="far fa-file-excel"></i> Export',
          className: "btn btn-primary"
        },
        {
          extend: 'print',
          title: 'Laporan Kesehatan Harian',
          text: '<i class="fas fa-print"></i> Cetak',
          className: "btn btn-primary"
        },
      ],
      ajax: '/laporan_harian/data/' + '' + ' / ' + 0 + ' / ' + 0 + ' / ' + 0,
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
          data: 'pagi',
          render: function(data) {
            $l = '<br><span class="badge bg-danger">Hiportemia</span>';
            $n = '<br><span class="badge bg-success">Normal</span>';
            $w = '<br><span class="badge bg-warning">Hiperpireksia</span>';
            $i = '<br><span class="badge bg-info">Hiperpireksia</span>';
            if (data > 40) {
              return data + ' °C' + $w;
            } else if (data < 35) {
              return data + ' °C' + $l;
            } else if (data >= 35 && data <= 37.5) {
              return data + ' °C' + $n;
            } else if (data >= 37.6 && data <= 40) {
              return data + ' °C' + $i;
            } else {
              return '';
            }
          }
        },
        {
          data: 'siang',
          render: function(data) {
            $l = '<br><span class="badge bg-danger">Hiportemia</span>';
            $n = '<br><span class="badge bg-success">Normal</span>';
            $w = '<br><span class="badge bg-warning">Hiperpireksia</span>';
            $i = '<br><span class="badge bg-info">Hiperpireksia</span>';

            if (data > 40) {
              return data + ' °C' + $w;
            } else if (data < 35) {
              return data + ' °C' + $l;
            } else if (data >= 35 && data <= 37.5) {
              return data + ' °C' + $n;
            } else if (data >= 37.6 && data <= 40) {
              return data + ' °C' + $i;
            } else {
              return '';
            }
          }
        },
        {
          data: 'sp',
          render: function(data) {
            $l = '<br><span class="badge bg-danger">Rendah</span>';
            $n = '<br><span class="badge bg-success">Normal</span>';
            $w = '<br><span class="badge bg-warning">Tinggi</span>';
            if (data > 100) {
              return data + ' %' + $w;
            } else if (data < 59) {
              return data + ' %' + $l;
            } else if (data >= 60 || data <= 100) {
              return data + ' %' + $n;
            } else {
              return '';
            }
          }
        },
        {
          data: 'prx',
          render: function(data) {
            $l = '<br><span class="badge bg-danger">Rendah</span>';
            $n = '<br><span class="badge bg-success">Normal</span>';
            $w = '<br><span class="badge bg-warning">Tinggi</span>';
            if (data > 100) {
              return data + ' bpm' + $w;
            } else if (data < 59) {
              return data + ' bpm' + $l;
            } else if (data >= 60 || data <= 100) {
              return data + ' bpm' + $n;
            } else {
              return '';
            }

          }
        }
      ]
    });




  });
</script>
<script>
  $(function() {
    $('input[name="dates"]').daterangepicker();
  })
</script>

@endsection