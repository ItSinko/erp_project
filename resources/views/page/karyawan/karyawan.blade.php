@extends('adminlte.page')

@section('title', 'Beta Version')

@section('content_header')
<h1 class="m-0 text-dark">Dashboard</h1>
@stop

@section('content')
<div class="row">
  <div class="col-lg-12">
    @if(session()->has('success'))
    <div class="alert alert-success alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
      Data berhasil ditambahkan
    </div>
    @elseif(session()->has('error') || count($errors) > 0)
    <div class="alert alert-danger alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
      Data gagal ditambahkan
    </div>
    @endif
    <div class="card">
      <div class="card-body">
        <div class='table-responsive'>
          <h2>Karyawan</h2>
          <table id="tabel" class="table table-hover styled-table table-striped">
            <thead style="text-align: center;">
              <tr>
                <th colspan="14">
                  <a href="/kesehatan/tambah" style="color: white;"><button type="button" class="btn btn-block btn-success btn-sm" style="width: 200px;"><i class="fas fa-plus"></i> &nbsp; Tambah</i></button></a>
                </th>
              </tr>
              <tr>
                <th>No</th>
                <th>Divisi</th>
                <th>Jabatan</th>
                <th>KTP</th>
                <th>Nama</th>
                <th>Kelamin</th>
                <th>Umur</th>
                <th>Tgl Masuk</th>
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
<!-- Modal Detail -->
<div class="modal fade  bd-example-modal-xl" id="edit_mod" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">
          <div class="data_detail_head"></div>
        </h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
        <div class="data_detail">
          <div class="row">
            <div class="col-lg-12">
              <div class="col-lg-12">
                <form method="post" action="/daftar_karyawan/aksi_ubah">
                  {{ csrf_field() }}
                  {{method_field('PUT')}}
                  <div class="card">
                    <div class="card-header bg-success">
                      <div class="card-title"><i class="fas fa-plus-circle"></i>&nbsp;Ubah Data</div>
                    </div>
                    <div class="card-body">
                      <div class="col-lg-12">
                        <div class="row">
                          <div class="col-lg-12">
                            <div class="form-horizontal">
                              <input type="text" name="id" class="d-none form-control" id="id" readonly>
                              <table class="table table-bordered table-striped" id="tabel_vaksin">
                                <thead>
                                  <tr>
                                    <th>Tgl Lahir</th>
                                    <th width="25%">Divisi</th>
                                    <th>Jabatan</th>
                                    <th>Kelamin</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <tr>
                                    <td>
                                      <input type="date" class="form-control" name="tgllahir" id="tgllahir">
                                    </td>
                                    <td>
                                      <select class="form-control select2" id="divisi" name="divisi">
                                        <option value="">Pilih Divisi</option>
                                        @foreach($karyawan as $k)
                                        <option value="{{$k->id}}">{{$k->nama}}</option>
                                        @endforeach
                                      </select>
                                    </td>
                                    <td>
                                      <select class="form-control select2 " id="jabatan" name="jabatan">
                                        <option value="">Pilih Jabatan</option>
                                        <option value="direktur">Direktur</option>
                                        <option value="manager">Manager</option>
                                        <option value="assisten manager">Ass Manager</option>
                                        <option value="supervisor">Supervisor</option>
                                        <option value="staff">Staff</option>
                                        <option value="operator">Operator</option>
                                        <option value="harian">Harian</option>
                                      </select>
                                    </td>
                                    <td>
                                      <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="jenis" id="jenis" value="P">
                                        <label class="form-check-label">Perempuan</label>
                                      </div>
                                      <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="jenis" id="jenis" value="L">
                                        <label class="form-check-label">Laki laki</label>
                                      </div>
                                    </td>
                                  </tr>
                                </tbody>
                              </table>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="card-footer">
                      <span class="float-right"><button class="btn btn-success rounded-pill" id="button_tambah"><i class="fas fa-plus"></i>&nbsp;Ubah Data</button></span>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- End Modal Detail -->
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
      ajax: '/daftar_karyawan/data',
      columns: [{
          data: 'DT_RowIndex',
          orderable: false,
          searchable: false
        },
        {
          data: 'x',
        },
        {
          data: 'jabatan',
        },
        {
          data: 'ktp',
          orderable: false,
          searchable: false,
        },
        {
          data: 'nama',
        },
        {
          data: 'kelamin',
        },
        {
          data: 'umur',
        },
        {
          data: 'tgl_kerja',
        },
        {
          data: 'button',
        }
      ]
    });


    $('#tabel > tbody').on('click', '#edit', function() {
      var rows = tabel.rows($(this).parents('tr')).data();
      $('.data_detail_head').html(
        rows[0]['nama']
      );
      var optionDivisi = rows[0]['divisi_id'];
      var optionJabatan = rows[0]['jabatan'];

      $("#divisi").val(optionDivisi).trigger('change');
      $("#jabatan").val(optionJabatan).trigger('change');
      $('input[name="jenis"][value="' + rows[0]['kelamin'] + '"]').attr('checked', 'checked');
      $('input[id="id"]').val(rows[0]['id']);
      $('input[id="tgllahir"]').val(rows[0]['tgllahir']);
      $('#edit_mod').modal('show');
    })
  });
</script>
@endsection