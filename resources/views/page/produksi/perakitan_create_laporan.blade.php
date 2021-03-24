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
      <div class="row">
        <div class="col-3">
        <div class="card">
                <div class="card-header">
                  <div class="card-title">Info BPPB</div>
                </div> 
                <div class="card-body">

                <div class="card-body box-profile">
                  <div class="text-center">
                        <img class="product-img-small img-fluid"
                        @if(empty($b->Produk->foto))
                          src="{{url('assets/image/produk')}}/noimage.png"
                        @elseif(!empty($b->Produk->foto))
                          src="{{url('assets/image/produk')}}/{{$b->Produk->foto}}"
                        @endif
                        title="{{$b->Produk->nama}}"
                        >
                  </div>
                  <div style="text-align:center;vertical-align:center;padding-top:10px">
                    <h5 class="card-heading">{{$b->Produk->tipe}}</h5>
                    <h6 class="card-subheading text-muted">{{$b->Produk->nama}}</h6>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-6" style="vertical-align: middle;">
                    <hgroup> <!-- hgroup is deprecated, just defiantly using it anyway -->
                      <h6 class="card-subheading text-muted">No BPPB</h6>
                      <h5 class="card-heading">{{$b->no_bppb}}</h5>
                    </hgroup>

                  </div>
                  <div class="col-lg-6" style="vertical-align: middle;">
                    <hgroup> <!-- hgroup is deprecated, just defiantly using it anyway -->
                      <h6 class="card-subheading text-muted ">Jumlah</h6>
                      <h5 class="card-heading">{{$b->jumlah}}</h5>
                    </hgroup>
                  </div>
                </div>

                
                </div>
            </div>
        </div>
        <div class="col-9">
          <div class="card">
            <div class="card-header">
              <div class="card-title">Laporan Perakitan</div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
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
              <form action="{{route('perakitan.store_laporan', ['bppb_id' => $b->id])}}" method="post">
              {{ csrf_field() }}
              {{ method_field('PUT') }}
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
            <div class="card-footer">
                <span>
                    <button type="button" class="btn btn-block btn-danger" style="width:200px;float:left;">Batal</button>
                </span>
                <span>
                    <button type="submit" class="btn btn-block btn-success" style="width:200px;float:right;">Tambahkan</button>
                </span>
            </div>
            </form>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->

          
          <!-- /.card -->
        </div>

       
        <!-- /.col -->
      </div>
      <!-- /.row -->
</section>
@endsection
@section('footer_script')
<script>
$(function(){
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

  $('input[name="tanggal_laporan"]').val();
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

  $('#tableitem').on('click', '#closetable', function(e){
      $(this).closest('tr').remove();
      numberRows($("#tableitem"));
  });

  $('#tableitem').on("change keyup", 'input[name="no_seri[]"]', function(){
    var no_seri_val = $(this).closest('tr').find('input[name="no_seri[]"').val();
    var no_seri = $(this).closest('tr').find('input[name="no_seri[]"');
    var message = $(this).closest('tr').find('span[id="no_seri-message[]"]');
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