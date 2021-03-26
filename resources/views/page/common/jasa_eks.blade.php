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
          <h2>Data Ekspedisi</h2>
          <table id="tabel" class="table table-hover styled-table table-striped">
            <thead style="text-align: center;">
              <tr>
                <th colspan="12">
                  <a href="/jasa_eks/tambah" style="color: white;"><button type="button" class="btn btn-block btn-success btn-sm" style="width: 200px;"><i class="fas fa-plus"></i> &nbsp; Tambah</i></button></a>
                </th>
              </tr>
              <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Telpon</th>
                <th>Alamat</th>
                <th>Jalur Pengiriman</th>
                <th>Daerah Pengiriman</th>
                <th>Catatan</th>
                <th></th>
              </tr>
            </thead>
            <tbody style="text-align: center;">
            </tbody>
          </table>
          <div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog modal-md" role="document">
              <div class="modal-content">
                <div class="modal-header" style="background-color:#cc0000;">
                  <h4 class="modal-title" id="myModalLabel" style="color:white;"><i class="fas fa-warning-circle"></i>&nbsp;Hapus </h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body" id="delete">
                  <div class="card">
                    <div class="card-body" style="text-align:center;">
                      <h6>Kenapa anda ingin menghapus Laporan ini?</h6>
                    </div>
                    <form id="delete-form" action="" method="POST">

                      <div class="form-group row">
                        <div class="col-sm-1"></div>
                        <div class="col-sm-3">
                          <div class="icheck-danger d-inline">
                            <input type="radio" id="revisi_perakitan" name="keterangan_log" value="revisi" checked>
                            <label for="revisi_perakitan">
                              Revisi
                            </label>
                          </div>
                        </div>

                        <div class="col-sm-4">
                          <div class="icheck-danger d-inline">
                            <input type="radio" id="salah_input_perakitan" name="keterangan_log" value="salah_input">
                            <label for="salah_input_perakitan">
                              Salah Input
                            </label>
                          </div>
                        </div>

                        <div class="col-sm-3">
                          <div class="icheck-danger d-inline">
                            <input type="radio" id="pembatalan_perakitan" name="keterangan_log" value="pembatalan">
                            <label for="pembatalan_perakitan">
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
                          <button type="submit" class="btn btn-block btn-danger hapussk" id="hapussk" style="width:30%;float:right;">Hapus</button>
                        </span>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


@stop
@section('adminlte_js')
<script>
  $(function() {
    $('#tabel').DataTable({
      processing: true,
      serverSide: true,
      ajax: '/jasa_eks/data',
      columns: [{
          data: 'DT_RowIndex',
          orderable: false,
          searchable: false
        },
        {
          data: 'nama'
        },
        {
          data: 'telp'
        },
        {
          data: 'alamat'
        },
        {
          data: 'via'
        },
        {
          data: 'jur'
        },
        {
          data: 'ket'
        },
        {
          data: 'id',
          name: 'id',
          render: function(data) {
            $btn = '<div class="inline-flex"><a href="/jasa_eks/ubah"><button type="button" class="btn btn-block btn-warning karyawan-img-small" style="border-radius:50%;"><i class="fas fa-edit"></i></button></a>';
            $btn_edit = ' <button type="button" class="btn btn-block btn-danger karyawan-img-small" style="border-radius:50%;" data-toggle="modal" data-target="#delete" ><i class="fas fa-trash"></i></button></div>';
            return $btn + $btn_edit;
          },
          orderable: false,
          searchable: false
        },
      ]
    });
  });
</script>

@endsection