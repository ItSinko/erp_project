@extends('layouts.app')

@section('content')
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

<section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <div class="card">
              <div class="card-header" style="background-color: #3c8dbc;">
                <h3 class="card-title" style="color:white;"><i class="fa fa-plus-circle" aria-hidden="true"></i>&nbsp;Tambahkan Perakitan</h3>
              </div>
              <div class="card-body">

            <div class="col-md-12">
            
              @if(session()->has('success'))
              <div class="alert alert-success" role="alert">
                {{session()->get('success')}}
              </div>
              @elseif(session()->has('error'))
              <div class="alert alert-danger" role="alert">
                {{session()->get('error')}}
              </div>
              @elseif(count($errors) > 0)
              <div class="alert alert-danger" role="alert">
                {{ implode('', $errors->all(':message')) }}
              </div>
              @endif
            <form action="{{ route('perakitan.store') }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}

            <div class="card">
              <div class="card-header">
                <h3 class="card-title"><i class="fa fa-info-circle"></i>&nbsp;Info BPPB</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <div class="form-horizontal">
                <div class="card-body">

                  <div class="form-group row">
                    <label for="fk_kategori" class="col-sm-3 col-form-label" style="text-align:right;">No BPPB</label>
                    <div class="col-sm-9">
                        <select class="form-control select2 select2-info @error('bppb_id') is-invalid @enderror" data-dropdown-css-class="select2-info" data-placeholder="Pilih No BPPB" style="width: 30%;" name = "bppb_id">
                          @foreach($s as $i)
                            <option value="{{$i->id}}">{{$i->no_bppb}}</option>
                          @endforeach
                        </select>
                        @if ($errors->has('bppb_id'))
                          <span class="invalid-feedback" role="alert">{{$errors->first('bppb_id')}}</span>
                        @endif
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="kelompok_produk" class="col-sm-3 col-form-label" style="text-align:right;">Kelompok Produk</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="kelompok_produk" id="kelompok_produk" value="{{old('kelompok_produk')}}" style="width: 30%;" readonly>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="kategori_produk" class="col-sm-3 col-form-label" style="text-align:right;">Kategori Produk</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="kategori_produk" id="kategori_produk" value="{{old('kategori_produk')}}" style="width: 40%;" readonly>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="tipe_produk" class="col-sm-3 col-form-label" style="text-align:right;">Tipe Produk</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="tipe_produk" id="tipe_produk" value="{{old('tipe_produk')}}" style="width: 50%;" readonly>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="jumlah" class="col-sm-3 col-form-label" style="text-align:right;">Jumlah Rencana Produksi</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="jumlah" id="jumlah" value="{{old('jumlah')}}" style="width: 10%;" readonly>
                    </div>
                  </div>

                </div>

              </div>
            </div>

            <div class="card">
              <div class="card-header">
                <h3 class="card-title"><i class="fa fa-info-circle"></i>&nbsp;Hasil Perakitan</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->

              <div class="form-horizontal">
                <div class="card-body">

                  <div class="form-group row">
                    <label for="tanggal_laporan" class="col-sm-3 col-form-label" style="text-align:right;">Tanggal Laporan</label>
                    <div class="col-sm-9">
                        <input type="date" class="form-control" name="tanggal_laporan" id="tanggal_laporan" value="{{old('tanggal_laporan')}}" style="width: 20%;">
                        @if ($errors->has('tanggal_laporan'))
                        <span class="invalid-feedback" role="alert">{{$errors->first('tanggal_laporan')}}</span>
                        @endif
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="import_file" class="col-sm-3 col-form-label" style="text-align:right;">Import No Seri (Excel)</label>
                    <div class="col-sm-9">
                      <input type="file" class="form-control" name="file">  
                      
                    </div>
                  </div>  

                  <div class="form-group row">
                  <table id="tableitem" class="table table-hover">
                    <thead style="text-align: center;">
                      <tr style="text-align: left;">
                        <th colspan="12">
                            <button type="button" id="tambahitem" class="btn btn-block btn-success btn-sm" style="width: 200px;"><i class="fas fa-plus"></i> &nbsp; Tambah No Seri Perakitan</i></button></a>
                        </th>
                      </tr>
                      <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>No Seri</th>
                        <th>Operator</th>
                        <th>Warna</th>
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
                            <span class="invalid-feedback" role="alert" >{{$errors->first('hasil_perakitans.*.no_seri')}}</span>
                          @endif
                          <span id="no_seri-message[]" role="alert"></span>
                        </div>
                      </td>
                      <td>
                        <div class="form-group">
                          <div class="select2-info">
                            <select class="select2 myselect0 form-control @error('karyawan_id') is-invalid @enderror" multiple="multiple" data-placeholder="Pilih Operator" data-dropdown-css-class="select2-info" style="width: 100%;" name="karyawan_id[][]" id="karyawan_id">
                            @foreach($kry as $i)
                              <option value="{{$i->id}}">{{$i->nama}}</option>
                            @endforeach
                            </select>
                            @if ($errors->has('karyawan_id'))
                              <span class="invalid-feedback" role="alert">{{$errors->first('karyawan_id.*')}}</span>
                            @endif
                          </div>
                        </div>
                      </td>
                      <td>
                        <div class="input-group">
                          <input type="text" class="form-control" name="warna[]" id="warna">
                        </div>
                      </td>
                      <td>
                        <button type="button" class="btn btn-block btn-danger btn-sm" id="closetable" ><i class="fas fa-times-circle"></i></button>
                      </td>
                    </tr>
                    </tbody>
                    
                  </table>
                  </div>

                </div>
              </div>
            </div>

            <span>
                <button type="button" class="btn btn-block btn-danger" style="width:200px;float:left;">Batal</button>
            </span>
            <span>
                <button type="submit" class="btn btn-block btn-success" style="width:200px;float:right;">Tambahkan</button>
            </span>
          </form>
            </div>
            <!-- /.card -->

          </div>
        </div>
          </div>

        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
</section>
@endsection
@section('footer_script')
<script>

$(function(){
    $('.select2').select2();
    var count = 0;
    var rowIdx = 0; 
    function numberRows($t) {
      var c = 0-2;
      $t.find("tr").each(function(ind, el) {
        $(el).find("td:eq(0)").html(++c);
        var j = c-1;
        $(el).find('input[id="tanggals"]').attr('name', 'tanggals['+j+']');
        $(el).find('select[id="karyawan_id"]').attr('name', 'karyawan_id['+j+'][]');
        $(el).find('select[id="karyawan_id"]').attr('id', 'karyawan_id'+j);
        $(el).find('input[id="no_seri"]').attr('name', 'no_seri['+j+']');
        $(el).find('input[id="warna"]').attr('name', 'warna['+j+']');
        $('select[name="karyawan_id['+j+'][]"]').select2();
      });
    }

    $('input[name="tanggal_laporan"]').val()
    $('select[name="bppb_id"]').on('change',function(){
      var bppb_id = jQuery(this).val();
      if(bppb_id)
      {
        $.ajax({
          url : 'get_bppb/' +bppb_id,
          type : "GET",
          dataType : "json",
          success:function(data)
          {
              $('input[name="kelompok_produk"]').val(data['nama_kelompok']);
              $('input[name="kategori_produk"]').val(data['nama_kategori']);
              $('input[name="tipe_produk"]').val(data['tipe_produk']+' '+data['nama_produk']);
              $('input[name="jumlah"]').val(data['jumlah']);
          }
        });
      }
      else
      {
        $('input[name="kelompok_produk"]').val("");
        $('input[name="kategori_produk"]').val("");
        $('input[name="tipe_produk"]').val("");
        $('input[name="jumlah"]').val("");
      }
    });

  $('#tambahitem').click(function(e){
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
          <span id="no_seri-message[]" role="alert"></span>
        </div>
      </td>
      <td>
        <div class="form-group">
          <div class="select2-info">
            <select class="select2 myselect form-control @error('karyawan_id') is-invalid @enderror" multiple="multiple" data-placeholder="Pilih Operator" data-dropdown-css-class="select2-info" style="width: 100%;" name="karyawan_id[][]" id="karyawan_id" tabindex="-1"  aria-hidden="true">
            @foreach($kry as $i)
              <option value="{{$i->id}}">{{$i->nama}}</option>
            @endforeach
            </select>
            @if ($errors->has('karyawan_id'))
              <span class="invalid-feedback" role="alert">{{$errors->first('karyawan_id.*')}}</span>
            @endif
          </div>
        </div>
      </td>
      <td>
        <div class="input-group">
          <input type="text" class="form-control" name="warna[]" id="warna">
        </div>
      </td>
      <td>
        <button type="button" class="btn btn-block btn-danger btn-sm" id="closetable" ><i class="fas fa-times-circle"></i></button>
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

  $('#tableitem').on('click', '#closetable', function(e){
      $(this).closest('tr').remove();
      numberRows($("#tableitem"));
  });

  $('#tableitem').on("change keyup", 'input[id="no_seri"]', function(){
    var no_seri_val = $(this).closest('tr').find('input[id="no_seri"]').val();
    var no_seri = $(this).closest('tr').find('input[id="no_seri"]');
    var message = $(this).closest('tr').find('span[id="no_seri-message"]');
    if(no_seri_val){
      $.ajax({
        url : 'get_no_seri_exist/' +no_seri_val,
        type : "GET",
        dataType : "json",
        success:function(data)
        {
            if(data > 0)
            {
              message.addClass("invalid-feedback");
              no_seri.addClass("is-invalid");
              message.html("No Seri Sudah Terpakai");
              console.log(message.val());
            }
            else
            {
              message.removeClass("invalid-feedback");
              no_seri.removeClass("is-invalid");
              message.empty();
            }
        }
      });
    }
    else
    {
      message.removeClass("invalid-feedback");
      no_seri.removeClass("is-invalid");
      message.empty();
    }
  });

});
</script>
@stop