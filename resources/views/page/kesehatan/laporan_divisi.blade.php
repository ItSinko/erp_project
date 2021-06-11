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
                  <div class="form-group row">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Jenis</label>
                    <div class="col-sm-10">
                      <select type="text " class="form-control select2 " id="jenis">
                        <option value="">Pilih</option>
                        <option value="harian">Suhu Harian & SPO2</option>
                        <option value="tensi">Mingguan Tensi</option>
                        <option value="rapid">Mingguan Rapid</option>
                        <option value="bulanan">Berat Badan</option>
                        <option value="tahunan">Rabun Mata</option>
                        <option value="sakit">Karyawan Sakit</option>
                        <option value="masuk">Karyawan Masuk</option>
                      </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="keterangan" class="col-sm-2 col-form-label">Tanggal</label>
                    <div class="col-sm-10">
                      <div class="input-group mb-3">
                        <div class="input-group-append">
                          <span class="input-group-text"> <i class="far fa-calendar-alt"></i></span>
                        </div>
                        <input type="text" class="form-control " id="tgl" name="dates">
                      </div>
                      @if($errors->has('berat'))
                      <div class="text-danger">
                        {{ $errors->first('berat')}}
                      </div>
                      @endif
                    </div>
                  </div>
                </div>
                <div class="card-footer">
                  <button type="submit" class="btn btn-default" id="cari">Cari</button>
                  <button type="submit" class="btn btn-danger float-right">Reset</button>
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

  <div class="col-lg-12" id="harian_card" style="display:none">
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

  <div class="col-lg-12" id="tensi_card">
    <div class="card">
      <div class="card-body">
        <div class='table-responsive'>
          <h2>Mingguan Tensi</h2>
          <table id="tensi" class="table table-hover styled-table table-striped">
            <thead style="text-align: center;">
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
        </div>
      </div>
    </div>
  </div>

</div>
@stop
@section('adminlte_js')
<script>
  $('#cari').click(function() {
    var divisi_id = $("#divisi_id").val();
    var jenis = $("#jenis").val();
    var tgl = $("#tgl").val();
    console.log(divisi_id);
    console.log(jenis);
    console.log(tgl);

    if (jenis == 'harian') {
      //style 
      $("#tensi_card").css('display', 'none');
      $("#harian_card").removeAttr("style");

    } else if (jenis == 'tensi') {
      //style   
      $("#harian_card").css('display', 'none');
      $("#tensi_card").removeAttr("style");
    } else {
      alert
    }
  });
</script>
<script>
  $(document).ready(function() {
    $('#harian').DataTable({
      "paging": false,
      "ordering": false,
      "searching": false,
      "info": false
    });
  });
</script>
<script>
  $(function() {
    $('input[name="dates"]').daterangepicker();
  })
</script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
@endsection