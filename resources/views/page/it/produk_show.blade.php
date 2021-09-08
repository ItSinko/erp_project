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
@section('adminlte_css')
<style>
  .flex-container {
    display: flex;
    flex-wrap: wrap;
  }

  .flex-container>div {
    background-color: #f1f1f1;
    width: 15%;
    margin: 13px;
  }

  .card-subtitle {
    margin-bottom: 0;
  }

  #myInput {
    padding: 20px;
    margin-top: -6px;
    border: 0;
    border-radius: 0;
    background: #f1f1f1;
  }
</style>
@stop

@section('content')


<section class="content">
  <div class="row">
    <div class="col-12">
      <div class="card">

        <!-- /.card-header -->
        <div class="card-body">
          <div class="row" style="margin-bottom:10px;">
            <div class="col-lg-12">
              <span class="btn-group  float-right" role="group" aria-label="Button group with nested dropdown">
                <button type="button" class="btn btn-outline-info active" id="tablebtn"><i class="fas fa-list"></i></button>
                <button type="button" class="btn btn-outline-info" id="gridbtn"><i class="fas fa-th"></i></button>
              </span>
              <span class="dropdown float-right" id="filter" style="margin-right:5px;">
                <button class=" btn btn-outline-info dropdown-toggle" type="button" id="dropdownFilter" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Filter
                </button>
                <ul id="filter_dd" class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownFilter">
                  <li><a class="dropdown-item kelompok alkes" id="kelompok" name="kelompok">Alat Kesehatan</a></li>
                  <li><a class="dropdown-item kelompok sarkes" id="kelompok" name="kelompok">Sarana Kesehatan</a></li>
                </ul>
              </span>
            </div>
          </div>
          <div class="row tabledisp">
            <div class="col-lg-12">
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
          </div>

          <div class="row griddisp" hidden>
            <div class="col-lg-12">
              <div class="flex-container gridview">

              </div>
            </div>
          </div>
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
    gridview("semua");
    tableview("semua");
    $('#tablebtn').on('click', function() {
      $('.tabledisp').removeAttr('hidden');
      $('.griddisp').attr('hidden', true);
      $('#tablebtn').addClass('active');
      $('#gridbtn').removeClass('active');
    });

    $('#gridbtn').on('click', function() {
      $('.tabledisp').attr('hidden', true);
      $('.griddisp').removeAttr('hidden');
      $('#tablebtn').removeClass('active');
      $('#gridbtn').addClass('active');
    });

    function gridview(status) {
      $('.gridview').html("");
      $.ajax({
        url: "/produk/grid/show/" + status,
        type: "GET",
        dataType: 'json',
        success: function(data) {
          var datas = "";
          console.log(data);
          $.each(data, function(key, value) {
            var ket = "";
            var kel = "";

            if (value.keterangan != null) {
              ket = String(value.keterangan).substring(0, 50);
            } else if (value.keterangan == null) {
              ket = "<i>Tidak Tersedia</i>";
            }

            datas += '<div class="card">' +
              '<img class="card-img-top" src="assets/image/user/unknown.png" alt="Card image cap">' +
              '<div class="card-body">' +
              '<h5 class="card-title">' + value['tipe'] + '</h5>' +
              '<p class="card-text text-muted">';
            if (kel === "Alat Kesehatan") {
              datas += '<small class="light-green-text">Alkes</small>';
            } else if (kel == "Sarana Kesehatan") {
              datas += '<small class="purple-text">Sarkes</small>';
            }
            datas += ' - <small></small></p> ' +
              '<p class="card-text"><small>' + value['nama'] +
              '</small></p>' +
              '</div>' +
              '<div class="card-footer">' +
              '<a href="#" class="card-link"><i class="fas fa-pencil-alt" ></i></a>' +
              '<a href="#" class="card-link"><i class="fas fa-trash"></i></a>' +
              '<a href="#" class="card-link float-right"><i class="fas fa-eye"></i></a>' +
              '</div>' +
              '</div>';
          });
          $('.gridview').append(datas);
        },
      })
    }

    function tableview(status) {
      $('#example').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
          url: "/produk/show/" + status,
          method: 'GET'
        },
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
    }


  });
  $(function() {
    $(document).on('click', '.delete-produk', function() {
      var url = $(this).attr('data-url');
      $("#delete-produk").attr("action", url);
    });
  });

  $(function() {
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