@extends('adminlte.page')

@section('title', 'Beta Version')

@section('content_header')
<h1 class="m-0 text-dark">Kalibrasi</h1>
@stop

@section('content')
<style>
  tr.details td.details-control {
    background: ;
  }
</style>
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
                <th></th>
                <th>No BPPB</th>
                <th>Gambar</th>
                <th>Tipe dan Nama</th>
                <th>Jumlah</th>
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
  function format(d) {
    console.log(d);
    return `<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">
      <tr>
      <td>Tgl Permintaan</td> 
      <td>Status</td>
      <td></td>
      </tr> 
      <tr> 
      <td></td>
      <td><span class="badge bg-danger">Belum Kalibrasi</span></td>
      <td><div class="inline-flex"><a href="/kalibrasi/tambah/32"><button type="button" class="btn btn-block btn-success karyawan-img-small" style="border-radius:50%;" ><i class="fas fa-balance-scale"></i></button></a></td>
      </tr>
      <tr> 
      <td>3 Juni 2021</td>
      <td><span class="badge bg-success">Sudah Kalibrasi</span></td>
      <td><div class="inline-flex"><a href="/kalibrasi/tambah/32"><button type="button" class="btn btn-block btn-success karyawan-img-small" style="border-radius:50%;" ><i class="fas fa-balance-scale"></i></button></a></td>
      </tr>
      </table>`;
  }
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
          className: 'details-control',
          orderable: false,
          data: null,
          defaultContent: '',
          render: function() {
            return '<button  class="btn btn-primary"><i class="fas fa-plus-circle"></i></button>';
          }
        },
        {
          data: 'no_bppb',
        },
        {
          data: 'gambar',
          orderable: false,
          searchable: false
        },
        {
          data: 'detailproduk.nama',
        },
        {
          data: 'jumlah_kalibrasi',
          orderable: false,
          searchable: false
        }
      ]
    });
    $('#tabel tbody').on('click', 'td.details-control', function() {
      var tr = $(this).closest('tr');
      var row = tabel.row(tr);
      if (row.child.isShown()) {
        // This row is already open - close it
        row.child.hide();
        tr.removeClass('shown');
      } else {
        // Open this row
        row.child(format(row.data())).show();
        tr.addClass('shown');
      }
    })
  });
</script>
@endsection