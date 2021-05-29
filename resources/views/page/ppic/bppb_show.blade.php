@extends('adminlte.page')

@section('title', 'Beta Version')

@section('content_header')
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>BPPB</h1>
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
          <table id="example" class="table table-hover styled-table" style="text-align: center;">
            <thead>
              <tr>
                <th colspan="12">
                  <a href="{{route('bppb.create')}}" style="color: white;">
                    <button type="button" class="btn btn-block btn-success btn-sm" style="width: 200px;">
                      <i class="fas fa-plus"></i> &nbsp; Tambah Data BPPB</i>
                    </button>
                  </a>
                </th>
              </tr>
              <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>No BPPB</th>
                <th>Gambar</th>
                <th>Produk</th>
                <th>Jumlah</th>
                <th>Divisi</th>
                <th>Laporan</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>

            </tbody>

          </table>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->

      <div class="modal fade" id="deletemodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-md" role="document">
          <div class="modal-content">
            <div class="modal-header" style="background-color:#cc0000;">
              <h4 class="modal-title" id="myModalLabel" style="color:white;">Hapus Data</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body" id="delete">
              <div class="card">
                <div class="card-body" style="text-align:center;">
                  <input id="labelid" name="labelid" hidden>
                  <h6>Kenapa anda ingin menghapus data ini?</h6>
                </div>
                <form id="deleteform" action="" method="POST">
                  @method('DELETE')
                  @csrf
                  <div class="form-group row">
                    <div class="col-sm-1"></div>
                    <div class="col-sm-3">
                      <div class="icheck-danger d-inline">
                        <input type="radio" id="revisi" name="keterangan_log" value="revisi" checked>
                        <label for="revisi">
                          Revisi
                        </label>
                      </div>
                    </div>

                    <div class="col-sm-4">
                      <div class="icheck-danger d-inline">
                        <input type="radio" id="salah_input" name="keterangan_log" value="salah_input">
                        <label for="salah_input">
                          Salah Input
                        </label>
                      </div>
                    </div>

                    <div class="col-sm-3">
                      <div class="icheck-danger d-inline">
                        <input type="radio" id="pembatalan" name="keterangan_log" value="pembatalan">
                        <label for="pembatalan">
                          Pembatalan
                        </label>
                      </div>
                    </div>

                  </div>
                  <div class="card-footer col-12" style="margin-bottom: 2%;">
                    <span>
                      <button type="button" class="btn btn-block btn-info batalsk" data-dismiss="modal" id="batalhapussk" style="width:30%;float:left;">Batal</button>
                    </span>
                    <span>
                      <button type="submit" class="btn btn-block btn-danger" id="hapussk" style="width:30%;float:right;">Hapus</button>
                    </span>
                  </div>
                </form>
              </div>
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
    $('#example').DataTable({
      processing: true,
      serverSide: true,
      ajax: "{{ route('bppb.show') }}",
      columns: [{
          data: 'DT_RowIndex',
          name: 'DT_RowIndex',
          orderable: false,
          searchable: false
        }, {
          data: 'tanggal_bppb',
          name: 'tanggal_bppb'
        },
        {
          data: 'no_bppb',
          name: 'no_bppb'
        },
        {
          data: 'gambar',
          name: 'gambar'
        },
        {
          data: 'produk',
          name: 'produk'
        },
        {
          data: 'jumlah',
          name: 'jumlah'
        },
        {
          data: 'divisi_id',
          name: 'divisi_id'
        },
        {
          data: 'laporan',
          name: 'laporan',
          orderable: false,
          searchable: false
        },
        {
          data: 'aksi',
          name: 'aksi',
          orderable: false,
          searchable: false
        },
      ]
    });

    $(document).on('click', '.deletemodal', function() {
      var url = $(this).attr('data-url');
      alert(url);
      $("#deleteform").attr("action", url);
    });
  });
</script>
@stop