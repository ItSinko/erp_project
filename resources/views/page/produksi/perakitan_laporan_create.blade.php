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
  <div class="row">
    <div class="col-3">
      <div class="card">
        <div class="card-header bg-info">
          <div class="card-title"><i class="fas fa-info-circle"></i>&nbsp;Info BPPB</div>
        </div>
        <div class="card-body">

          <div class="card-body box-profile">
            <div class="text-center">
              <img class="product-img-small img-fluid" @if(empty($b->DetailProduk->foto))
              src="{{url('assets/image/produk')}}/noimage.png"
              @elseif(!empty($b->DetailProduk->foto))
              src="{{url('assets/image/produk')}}/{{$b->DetailProduk->foto}}"
              @endif
              title="{{$b->DetailProduk->nama}}"
              >
            </div>
            <div style="text-align:center;vertical-align:center;padding-top:10px">
              <h5 class="card-heading">{{$b->DetailProduk->nama}}</h5>
              <h6 class="card-subheading text-muted">{{$b->DetailProduk->Produk->nama}}</h6>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-6" style="vertical-align: middle;">
              <hgroup>
                <!-- hgroup is deprecated, just defiantly using it anyway -->
                <h6 class="card-subheading text-muted">No BPPB</h6>
                <h5 class="card-heading">{{$b->no_bppb}}</h5>
              </hgroup>

            </div>
            <div class="col-lg-6" style="vertical-align: middle;">
              <hgroup>
                <!-- hgroup is deprecated, just defiantly using it anyway -->
                <h6 class="card-subheading text-muted ">Jumlah</h6>
                <h5 class="card-heading">{{$b->jumlah}}</h5>
              </hgroup>
            </div>
          </div>


        </div>
      </div>
    </div>
    <div class="col-9">
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
          <div class="card-title"><i class="fas fa-plus-circle"></i>&nbsp;Tambah Laporan Tim</div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <form action="{{route('perakitan.laporan.store', ['bppb_id' => $b->id])}}" method="post">
            {{ csrf_field() }}
            {{ method_field('PUT') }}
            <div class="form-group row">
              <div class="table-responsive">
                <table id="tableitem" class="table table-hover">
                  <thead style="text-align: center;">
                    <tr>
                      <th>No</th>
                      <th>Kode Tim</th>
                      <th>Karyawan</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody style="text-align:center;">
                    <tr>
                      <td>1</td>
                      <td>
                        <div class="input-group">
                          <input type="text" class="form-control @error('alias') is-invalid @enderror" name="alias[]" id="alias" disabled>
                          @if ($errors->has('alias'))
                          <span class="invalid-feedback" role="alert">{{$errors->first('alias.*')}}</span>
                          @endif
                          <span id="alias-message[]" role="alert"></span>
                        </div>
                      </td>
                      <td>
                        <div class="select2-info">
                          <select class="select2 form-control @error('karyawan_id') is-invalid @enderror karyawan_id" multiple="multiple" data-placeholder="Pilih Operator" data-dropdown-css-class="select2-info" style="width: 100%;" name="karyawan_id[][]" id="karyawan_id">
                            @foreach($kry as $i)
                            <option value="{{$i->id}}" @if($kry2->contains('id', $i->id))
                              disabled
                              @endif>{{$i->nama}}</option>
                            @endforeach
                          </select>
                          @if ($errors->has('karyawan_id'))
                          <span class="invalid-feedback" role="alert">{{$errors->first('karyawan_id.*')}}</span>
                          @endif
                        </div>
                      </td>
                      <td>
                        <button type="button" class="btn btn-success btn-sm karyawan-img-small buttonaksi" style="border-radius:50%;" id="tambahitem" disabled><i class="fas fa-plus-circle"></i></button>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
        </div>
        <div class="card-footer">
          <span>
            <button type="button" class="btn btn-block btn-danger" style="width:200px;float:left;" id="batal" disabled>Batal</button>
          </span>
          <span>
            <button type="submit" class="btn btn-block btn-success" style="width:200px;float:right;" id="tambahdata" disabled>Tambah Data</button>
          </span>
        </div>
        </form>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
      <div class="card">
        <div class="card-body">
          <h4>Tim Perakitan</h4>
          <div class="form-group row">
            <div class="table-responsive">
              <table class="table table-bordered table-striped">
                <thead style="text-align: center;">
                  <tr>
                    <th>No</th>
                    <th>Kode Tim</th>
                    <th>Karyawan</th>
                    <th>Hasil Rakit</th>
                  </tr>
                </thead>
                <tbody>
                  @if($b->Perakitan !== "")
                  @foreach($b->Perakitan as $i)
                  <tr style="text-align: center;">
                    <td>{{$loop->iteration}}</td>
                    <td>{{$i->alias_tim}}</td>
                    <td style="text-align: left;">@foreach ($i->Karyawan as $krys)
                      {{ $loop->first ? '' : '' }}
                      <div>{{ $krys->nama}}</div>
                      @endforeach
                    </td>
                    <td>{{$i->HasilPerakitan->count()}}</td>
                  </tr>
                  @endforeach
                  @endif
                </tbody>
              </table>
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
    $('.select2').select2();

    function numberRows($t) {
      var c = 0 - 1;
      $t.find("tr").each(function(ind, el) {
        $(el).find("td:eq(0)").html(++c);
        var j = c - 1;
        $(el).find('.karyawan_id').attr('name', 'karyawan_id[' + j + '][]');
        $(el).find('.karyawan_id').attr('id', 'karyawan_id' + j);
        $(el).find('input[id="alias"]').attr('name', 'alias[' + j + ']');
        $('.karyawan_id').select2();
      });
    }

    $('#tambahitem').click(function(e) {
      $('#tambahdata').attr('disabled', true);
      $('#tambahitem').attr('disabled', true);
      $('#tableitem tr:last').after(`<tr>
        <td>1</td>
        <td>
          <div class="input-group">
            <input type="text" class="form-control @error('karyawan_id') is-invalid @enderror" name="alias[]" id="alias" disabled>
            @if ($errors->has('alias'))
            <span class="invalid-feedback" role="alert">{{$errors->first('alias.*')}}</span>
            @endif
          </div>
        </td>
        <td>
          <div class="select2-info">
            <select class="select2 form-control @error('karyawan_id') is-invalid @enderror karyawan_id" multiple="multiple" data-placeholder="Pilih Operator" data-dropdown-css-class="select2-info" style="width: 100%;" name="karyawan_id[][]" id="karyawan_id">
              @foreach($kry as $i)
              <option value="{{$i->id}}">{{$i->nama}}</option>
              @endforeach
            </select>
            @if ($errors->has('karyawan_id'))
            <span class="invalid-feedback" role="alert">{{$errors->first('karyawan_id.*')}}</span>
            @endif
          </div>
        </td>
        <td>
          <button type="button" class="btn btn-danger btn-sm karyawan-img-small buttonaksi" style="border-radius:50%;" id="closetable"><i class="fas fa-times-circle"></i></button>
        </td>
      </tr>`);
      numberRows($("#tableitem"));
    });

    $('#tableitem').on('click', '#closetable', function(e) {
      $(this).closest('tr').remove();
      numberRows($("#tableitem"));
    });

    $('#tableitem').on("keyup", "input[id='alias']", function() {

      var id = $(this).closest('tr').find('input[id="alias"]').val();
      var alias = $(this).closest('tr').find('input[id="alias"]');
      var message = $(this).closest('tr').find('span[id="alias-message[]"]');
      var bppb = "{{$b->id}}";
      if (id) {
        $.ajax({
          url: 'get_alias_exist/' + bppb + '/' + id,
          type: "GET",
          dataType: "json",
          success: function(data) {
            if (data > 0) {
              $('#tambahitem').attr('disabled', true);
              $('#tambahdata').attr('disabled', true);
              message.addClass("invalid-feedback");
              alias.addClass("is-invalid");
              message.html("Kode Tim sudah terpakai");
              console.log(message.val());

            } else {
              $('#tambahitem').removeAttr('disabled');
              $('#tambahdata').removeAttr('disabled');
              message.removeClass("invalid-feedback");
              alias.removeClass("is-invalid");
              message.empty();
            }
          },
          error: function(xhr, status, error) {
            var err = eval("(" + xhr.responseText + ")");
            alert(err.Message);
          }
        });
      } else {
        $('#tambahitem').attr('disabled', true);
        $('#tambahdata').attr('disabled', true);
        message.removeClass("invalid-feedback");
        alias.removeClass("is-invalid");
        message.empty();
      }
    });

    $('#tableitem').on("change", ".karyawan_id", function() {
      var arr = [];
      var arr = $(this).closest('tr').find('.karyawan_id').val();
      var alias = $(this).closest('tr').find('input[id="alias"]');
      if (arr.length == 1) {
        alias.removeAttr('disabled');
        var kry_id = arr.toString();
        $.ajax({
          url: 'get_alias_operator/' + kry_id,
          type: "GET",
          dataType: "json",
          success: function(data) {
            if (data !== "") {
              alias.val(data);
            } else if (data === "") {
              alias.val("");
              $('#tambahitem').attr('disabled', true);
              $('#tambahdata').attr('disabled', true);
            }
          },
          error: function(xhr, status, error) {
            var err = eval("(" + xhr.responseText + ")");
            alert(err.Message);
          }
        });
      } else if (arr.length == 0) {
        alias.attr('disabled', true);
        $('#tambahitem').attr('disabled', true);
        $('#tambahdata').attr('disabled', true);
        alias.val("");
      } else if (arr.length > 1) {
        $('#tambahitem').attr('disabled', true);
        $('#tambahdata').attr('disabled', true);
        alias.removeAttr('disabled');
        alias.val("");
      }
    });

    $('#tableitem').on("change keyup", 'input[id="no_seri"]', function() {
      var bppb = "{{$b->id}}"
      var no_seri_val = $(this).closest('tr').find('input[id="no_seri"]').val();
      var no_seri = $(this).closest('tr').find('input[id="no_seri"]');
      var message = $(this).closest('tr').find('span[id="no_seri-message[]"]');
      if (no_seri_val) {
        $.ajax({
          url: 'get_kode_perakitan_exist_not_in/' + bppb + '/' + no_seri_val,
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