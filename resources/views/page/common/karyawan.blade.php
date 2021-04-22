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
          <h2>Karyawan</h2>
          <table id="tabel" class="table table-hover styled-table table-striped">
            <thead style="text-align: center;">
              <tr>
                <th colspan="12">
                  <a href="/karyawan/tambah" style="color: white;"><button type="button" class="btn btn-block btn-success btn-sm" style="width: 200px;"><i class="fas fa-plus"></i> &nbsp; Tambah</i></button></a>
                </th>
              </tr>
              <tr>
                <th>No</th>
                <th>Nama</th>
                <th>NIK</th>
                <th>BPJS</th>
                <th>Masa Kerja</th>
                <th>Vaskin</th>
                <th>Tgl Lahir</th>
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
@endsection