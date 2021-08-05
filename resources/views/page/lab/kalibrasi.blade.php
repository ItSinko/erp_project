@extends('adminlte.page')

@section('title', 'Beta Version')

@section('content_header')
<h1 class="m-0 text-dark">Kalibrasi</h1>
@stop

@section('content')
<div class="row">
  <div class="col-lg-12">
    <div class="card">
      <div class="card-body">
        <div class='table-responsive'>
          <h2></h2>
          <table id="tabel" class="table table-hover styled-table table-striped">
            <thead style="text-align: center;">
              <tr>
                <th>No</th>
                <th>No BPPB</th>
                <th>Gambar</th>
                <th>Tipe dan Nama</th>
                <th>Jumlah</th>
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
      serverSide: false,
      language: {
        processing: '<i class="fa fa-spinner fa-spin"></i> Tunggu Sebentar'
      },
      ajax: '/kalibrasi/data',
      columns: [{
          data: 'DT_RowIndex',
          orderable: false,
          searchable: false
        },
        {
          data: 'bppb.no_bppb',
        },
        {
          data: 'gambar',
          orderable: false,
          searchable: false
        },
        {
          data: 'bppb.detailproduk.nama',
        },
        {
          data: 'bppb.jumlah',
          orderable: false,
          searchable: false
        },
        {
          data: 'button',
          orderable: false,
          searchable: false
        }
      ]
    });
  });
</script>
@endsection