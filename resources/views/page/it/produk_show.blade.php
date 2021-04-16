@extends('adminlte.page')

@section('title', 'Beta Version')

@section('content_header')
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Produk</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">DataTables</li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>
@stop

@section('content')


<section class="content">
  <div class="row">
    <div class="col-12">
      <div class="card">

        <!-- /.card-header -->
        <div class="card-body">
          <table id="example" class="table table-hover styled-table">
            <thead style="text-align: center;">
              <tr>
                <th colspan="12">
                  <a href="{{route('produk.create')}}" style="color: white;"><button type="button" class="btn btn-block btn-success btn-sm" style="width: 200px;"><i class="fas fa-plus"></i> &nbsp; Tambah Produk</i></button></a>
                </th>
              </tr>
              <tr>
                <th>No</th>
                <th>No AKD</th>
                <th>Barcode</th>
                <th>Tipe dan Nama</th>
                <th>Nama COO</th>
                <th>Kategori</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody style="text-align:center;">
            </tbody>

          </table>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->

      <div class="modal fade" id="detailmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-xl" role="document">
          <div class="modal-content">
            <div class="modal-header" style="background-color:	#006400;">
              <h4 class="modal-title" id="myModalLabel" style="color:white;">Detail</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body" id="detail">

            </div>
          </div>
        </div>
      </div>

      <div class="modal fade" id="deletemodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-md" role="document">
          <div class="modal-content">
            <div class="modal-header" style="background-color:#cc0000;">
              <h4 class="modal-title" id="myModalLabel" style="color:white;">Hapus Laporan</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body" id="delete">

            </div>
          </div>
        </div>
      </div>

      <!-- /.card -->
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
</section>
@endsection

@section('adminlte_js')
<script>
  $(function() {
    $(document).on('click', '.delete-produk', function() {
      var url = $(this).attr('data-url');
      $("#delete-produk").attr("action", url);
    });
  });

  $(function() {
    $('#example').DataTable({
      processing: true,
      serverSide: true,
      ajax: "{{ route('produk.show') }}",
      columns: [{
          data: 'DT_RowIndex',
          name: 'DT_RowIndex',
          orderable: false,
          searchable: false
        },
        {
          data: 'no_akd',
        },
        {
          data: 'kode_barcode',
        },
        {
          data: 'kategori_id',
        },
        {
          data: 'nama_coo',
        },
        {
          data: 'kelompok_produk_id',
        },
        {
          data: 'aksi',
          name: 'aksi',
          orderable: false,
          searchable: false
        },
      ]
    });

    $(document).on('click', '.detailmodal', function(event) {
      event.preventDefault();
      var href = $(this).attr('data-attr');
      var dataid = $(this).attr('data-id');
      $.ajax({
        url: '/produk/detail',
        beforeSend: function() {
          $('#loader').show();
        },
        // return the result
        success: function(result) {
          $('#detailmodal').modal("show");
          $('#detail').html(result).show();
          console.log(result);
          $('#detaildata').DataTable({
            processing: true,
            serverSide: true,
            ajax: href,
            columns: [{
                data: 'DT_RowIndex',
                name: 'DT_RowIndex',
                orderable: false,
                searchable: false
              }, {
                data: 'kode',
              },
              {
                data: 'nama',
              },
              {
                data: 'stok',
              },
              {
                data: 'harga',
              },
              {
                data: 'foto',
              },
              {
                data: 'berat',
              },
              {
                data: 'satuan',
              },
              {
                data: 'keterangan',
              },
              {
                data: 'aksi',
                name: 'aksi',
                orderable: false,
                searchable: false
              },
            ]
          });
        },
        complete: function() {
          $('#loader').hide();
        },
        error: function(jqXHR, testStatus, error) {
          console.log(error);
          alert("Page " + href + " cannot open. Error:" + error);
          $('#loader').hide();
        },
        timeout: 8000
      })
    });

  });
</script>
@stop