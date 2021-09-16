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


<!-- Modal Detail -->
<div class="modal fade  bd-example-modal-lg" id="detail_mod" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
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
                <div class="card">
                  <div class="card-header bg-success">
                    <div class="card-title">&nbsp;Detail</div>
                  </div>
                  <div class="card-body">
                    <div class="col-lg-12">
                      <div class="row">
                        <div class="col-lg-12">
                          <div class="form-horizontal">
                            <table class="table table-bordered table-striped" id="tabel_detail">
                              <thead>
                                <tr>
                                  <th width="1%">No</th>
                                  <th>Tgl Pendaftaran</th>
                                  <th>Barcode</th>
                                  <th></th>
                                </tr>
                              </thead>
                              <tbody>
                                <tr>
                                  <td></td>
                                  <td></td>
                                  <td></td>
                                  <td></td>
                                </tr>
                              </tbody>
                            </table>
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
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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
          data: 'button',
          orderable: false,
          searchable: false
        },
        {
          data: 'no_bppb',
        },
        {
          data: 'button',
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


    $('#tabel > tbody').on('click', '#detail', function() {
      var rows = tabel.rows($(this).parents('tr')).data();
      $('.data_detail_head').html(
        'Detail Paket : ' + rows[0]['no_bppb']
      );

      var tabel_detail = $('#tabel_detail').DataTable({
        processing: true,
        destroy: true,
        serverSide: false,
        ajax: '/kalibrasi/data/detail/' + rows[0]['id'],
        columns: [{
            data: 'DT_RowIndex',
            orderable: false,
            searchable: false
          },
          {
            data: 'tanggal_daftar',
          },
          {
            data: 'barcode_list',
          },
          {
            data: 'button',
            orderable: false,
            searchable: false
          }
        ]
      });

      $('#detail_mod').modal('show');
    });
  });
</script>
@endsection