@extends('adminlte.page')

@section('title', 'Beta Version')

@section('content_header')
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Perakitan</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Advanced Form</li>
        </ol>
      </div>
    </div>
  </div>
</section>
@stop

@section('content')
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <!-- left column -->
      <div class="col-md-12">
        @if(session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          <strong><i class="fas fa-check"></i></strong> {{session()->get('success')}}
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        @elseif(session()->has('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          <strong><i class="fas fa-times"></i></strong> {{session()->get('error')}}
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        @elseif(count($errors) > 0)
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          <strong><i class="fas fa-times"></i></strong> Lengkapi data terlebih dahulu
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        @endif
        <div class="card">
          <div class="card-header bg-success">
            <h3 class="card-title" style="color:white;"><i class="fa fa-plus-circle" aria-hidden="true"></i>&nbsp;Tambahkan Perakitan</h3>
          </div>
          <div class="card-body">

            <div class="col-md-12">
              <form action="{{ route('perakitan.store') }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}

                <!-- <div class="card"> -->
                <!-- <div class="card-header">
                    <h3 class="card-title"><i class="fa fa-info-circle"></i>&nbsp;Info BPPB</h3>
                  </div> -->
                <!-- /.card-header -->
                <!-- form start -->
                <h3>Info BPPB</h3>
                <div class="form-horizontal">
                  <!-- <div class="card-body"> -->

                  <div class="form-group row">
                    <label for="fk_kategori" class="col-sm-4 col-form-label" style="text-align:right;">No BPPB</label>
                    <div class="col-sm-8">
                      <select class="form-control select2 select2-info @error('bppb_id') is-invalid @enderror" data-dropdown-css-class="select2-info" data-placeholder="Pilih No BPPB" style="width: 30%;" name="bppb_id">
                        <option value=""></option>
                        @foreach($s as $i)
                        <option value="{{$i->id}}">{{$i->no_bppb}}</option>
                        @endforeach
                      </select>
                      @if ($errors->has('bppb_id'))
                      <span class="invalid-feedback" role="alert">{{$errors->first('bppb_id')}}</span>
                      @endif
                    </div>
                  </div>

                  <!-- <div class="form-group row">
                    <label for="kelompok_produk" class="col-sm-4 col-form-label" style="text-align:right;">Kelompok Produk</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" name="kelompok_produk" id="kelompok_produk" value="{{old('kelompok_produk')}}" style="width: 30%;" readonly>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="kategori_produk" class="col-sm-4 col-form-label" style="text-align:right;">Kategori Produk</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" name="kategori_produk" id="kategori_produk" value="{{old('kategori_produk')}}" style="width: 40%;" readonly>
                    </div>
                  </div> -->

                  <div class="form-group row">
                    <label for="tipe_produk" class="col-sm-4 col-form-label" style="text-align:right;">Nama Produk</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" name="tipe_produk" id="tipe_produk" value="{{old('tipe_produk')}}" style="width: 50%;" readonly>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="jumlah" class="col-sm-4 col-form-label" style="text-align:right;">Jumlah Rencana Produksi</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" name="jumlah" id="jumlah" value="{{old('jumlah')}}" style="width: 10%;" readonly>
                    </div>
                  </div>

                  <h3>Hasil Perakitan</h3>
                  <div class="form-horizontal">

                    <div class="form-group row">
                      <label for="tanggal_laporan" class="col-sm-4 col-form-label" style="text-align:right;">Tanggal Laporan</label>
                      <div class="col-sm-8">
                        <input type="date" class="form-control" name="tanggal_laporan" id="tanggal_laporan" value="{{old('tanggal_laporan')}}" style="width: 20%;">
                        @if ($errors->has('tanggal_laporan'))
                        <span class="invalid-feedback" role="alert">{{$errors->first('tanggal_laporan')}}</span>
                        @endif
                      </div>
                    </div>

                    <div class="form-group row">
                      <label for="karyawan_id" class="col-sm-4 col-form-label" style="text-align:right;">Karyawan</label>
                      <div class="col-sm-5">
                        <div class="select2-info">
                          <select class="select2 form-control @error('karyawan_id') is-invalid @enderror karyawan_id" multiple="multiple" data-placeholder="Pilih Operator" data-dropdown-css-class="select2-info" style="width: 100%;" name="karyawan_id[]" id="karyawan_id">
                            @foreach($kry as $i)
                            <option value="{{$i->id}}">{{$i->nama}}</option>
                            @endforeach
                          </select>
                          @if ($errors->has('karyawan_id'))
                          <span class="invalid-feedback" role="alert">{{$errors->first('karyawan_id.*')}}</span>
                          @endif
                        </div>
                      </div>
                    </div>

                    <div class="form-group row">
                      <table id="tableitem" class="table table-hover">
                        <thead style="text-align: center;">
                          <!-- <tr style="text-align: left;">
                            <th colspan="12">
                              <button type="button" id="tambahitem" class="btn btn-block btn-success btn-sm" style="width:250px;"><i class="fas fa-plus"></i> &nbsp; Tambah No Seri Perakitan</i></button></a>
                            </th>
                          </tr> -->
                          <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>No Seri</th>
                            <th>Aksi</th>
                          </tr>
                        </thead>
                        <tbody style="text-align:center;">
                          <tr>
                            <td>1</td>
                            <td>
                              <div class="input-group">
                                <input type="date" class="form-control" name="tanggals[]" id="tanggals">
                              </div>
                            </td>
                            <td>
                              <div class="form-group">
                                <div class="input-group">
                                  <input type="text" class="form-control @error('hasil_perakitans.*.no_seri') is-invalid @enderror" name="no_seri[]" id="no_seri">
                                </div>
                                @if ($errors->has('no_seri'))
                                <span class="invalid-feedback" role="alert">{{$errors->first('hasil_perakitans.*.no_seri')}}</span>
                                @endif
                                <span id="no_seri-message[]" role="alert"></span>
                              </div>
                            </td>
                            <td>
                              <button type="button" class="btn btn-success karyawan-img-small" style="border-radius:50%;" id="tambahitem"><i class="fas fa-plus-circle"></i></button>
                            </td>
                          </tr>
                        </tbody>

                      </table>
                    </div>

                    <!-- </div> -->
                  </div>
                  <!-- </div> -->



                </div>
                <!-- /.card -->

            </div>


          </div>
          <div class="card-footer">
            <span>
              <button type="button" class="btn btn-block btn-danger" style="width:200px;float:left;"><i class="fas fa-times"></i>&nbsp;Batal</button>
            </span>
            <span>
              <button type="submit" class="btn btn-block btn-success" style="width:200px;float:right;"><i class="fas fa-plus"></i>&nbsp;Tambah Data</button>
            </span>
          </div>
          </form>
        </div>

      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>
@endsection
@section('adminlte_js')
<script>
  $(function() {
    $('.select2').select2();
    var count = 0;
    var rowIdx = 0;

    function numberRows($t) {
      var c = 0 - 1;
      $t.find("tr").each(function(ind, el) {
        $(el).find("td:eq(0)").html(++c);
        var j = c - 1;
        $(el).find('input[id="tanggals"]').attr('name', 'tanggals[' + j + ']');
        $(el).find('input[id="no_seri"]').attr('name', 'no_seri[' + j + ']');
      });
    }

    $('input[name="tanggal_laporan"]').val();
    $('select[name="bppb_id"]').on('change', function() {
      var bppb_id = jQuery(this).val();
      if (bppb_id) {
        $.ajax({
          url: 'create/get_bppb/' + bppb_id,
          type: "GET",
          dataType: "json",
          success: function(data) {
            console.log(data);
            $('input[name="tipe_produk"]').val(data[0]['detail_produk']['nama']);
            $('input[name="jumlah"]').val(data[0]['jumlah']);
          }
        });
      } else {
        $('input[name="kelompok_produk"]').val("");
        $('input[name="kategori_produk"]').val("");
        $('input[name="tipe_produk"]').val("");
        $('input[name="jumlah"]').val("");
      }
    });

    $('#tambahitem').click(function(e) {
      $('#tableitem tr:last').after(`<tr>
      <td></td>
      <td>
        <div class="input-group">
          <input type="date" class="form-control" name="tanggals[]" id="tanggals">
        </div>
      </td>
      <td>
        <div class="form-group">
          <div class="input-group">
            <input type="text" class="form-control @error('hasil_perakitans.*.no_seri') is-invalid @enderror" name="no_seri[]" id="no_seri">
          </div>
          @if ($errors->has('no_seri'))
            <span class="invalid-feedback" role="alert" >{{$errors->first('hasil_perakitans.*.no_seri')}}</span>
          @endif
          <span id="no_seri-message" role="alert"></span>
        </div>
      </td>
      <td>
        <button type="button" class="btn btn-danger karyawan-img-small" style="border-radius:50%;" id="closetable" ><i class="fas fa-times-circle"></i></button>
      </td>
      </tr>`);
      numberRows($("#tableitem"));
    });

    // $('.items').select2();
    // $("table").on('click','.tr_clone_add' ,function() {
    //   $('.items').select2("destroy");        
    //   var $tr = $(this).closest('.tr_clone');
    //   var $clone = $tr.clone();
    //   $tr.after($clone);
    //   $('.items').select2();
    //   $clone.find('.items').select2('val', '');
    // });

    $('#tableitem').on('click', '#closetable', function(e) {
      $(this).closest('tr').remove();
      numberRows($("#tableitem"));
    });

    $('#tableitem').on("change keyup", 'input[id="no_seri"]', function() {
      var no_seri_val = $(this).closest('tr').find('input[id="no_seri"]').val();
      var no_seri = $(this).closest('tr').find('input[id="no_seri"]');
      var message = $(this).closest('tr').find('span[id="no_seri-message"]');
      if (no_seri_val) {
        $.ajax({
          url: 'get_no_seri_exist/' + no_seri_val,
          type: "GET",
          dataType: "json",
          success: function(data) {
            if (data > 0) {
              message.addClass("invalid-feedback");
              no_seri.addClass("is-invalid");
              message.html("No Seri Sudah Terpakai");
              console.log(message.val());
            } else {
              message.removeClass("invalid-feedback");
              no_seri.removeClass("is-invalid");
              message.empty();
            }
          }
        });
      } else {
        message.removeClass("invalid-feedback");
        no_seri.removeClass("is-invalid");
        message.empty();
      }
    });

  });
</script>
@stop