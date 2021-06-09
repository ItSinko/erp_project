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
    <div class="col-3">
      <div class="card">
        <div class="card-header bg-info">
          <div class="card-title"><i class="fas fa-info-circle"></i>&nbsp;Info Perakitan</div>
        </div>
        <div class="card-body">
          <div class="card-body box-profile">
            <div class="text-center">
              <img class="product-img-small img-fluid" @if(empty($sh->Bppb->DetailProduk->foto))
              src="{{url('assets/image/produk')}}/noimage.png"
              @elseif(!empty($sh->Bppb->DetailProduk->foto))
              src="{{url('assets/image/produk')}}/{{$sh->Bppb->DetailProduk->foto_produk}}"
              @endif
              title="{{$sh->Bppb->DetailProduk->nama}}"
              >
            </div>
            <div style="text-align:center;vertical-align:center;padding-top:10px">
              <h5 class="card-heading">{{$sh->Bppb->DetailProduk->nama}}</h5>
              <h6 class="card-subheading text-muted">{{$sh->Bppb->DetailProduk->Produk->nama}}</h6>
            </div>
          </div>
          <div class="row">

            <div class="col-lg-6" style="vertical-align: middle;">
              <hgroup>
                <!-- hgroup is deprecated, just defiantly using it anyway -->
                <h6 class="card-subheading text-muted">No BPPB</h6>
                <h5 class="card-heading">{{$sh->Bppb->no_bppb}}</h5>
              </hgroup>
              <hgroup>
                <!-- hgroup is deprecated, just defiantly using it anyway -->
                <h6 class="card-subheading text-muted ">Tanggal</h6>
                <h5 class="card-heading">{{date("d-m-Y", strtotime($sh->tanggal))}}</h5>
              </hgroup>
            </div>
            <div class="col-lg-6" style="vertical-align: middle;">
              <hgroup>
                <!-- hgroup is deprecated, just defiantly using it anyway -->
                <h6 class="card-subheading text-muted ">Jumlah</h6>
                <h5 class="card-heading">{{$sh->Bppb->jumlah}} {{ucfirst($sh->Bppb->DetailProduk->satuan)}}</h5>
              </hgroup>
              <hgroup>
                <!-- hgroup is deprecated, just defiantly using it anyway -->
                <h6 class="card-subheading text-muted ">Karyawan</h6>
                <h5 class="card-heading">@foreach ($sh->Karyawan as $kry)
                  {{ $loop->first ? '' : '' }}
                  <div>{{ $kry->nama}}</div>
                  @endforeach
                </h5>
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
          <div class="card-title"><i class="fas fa-plus-circle"></i>&nbsp;Tambah </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <form action="{{ route('perakitan.hasil.store', ['id' => $sh->id]) }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            {{ method_field('PUT') }}
            <div class="form-horizontal">


              <div class="form-group row">
                <label for="tanggal" class="col-sm-4 col-form-label" style="text-align:right;">Tanggal</label>
                <div class="col-sm-8">
                  <input type="date" class="form-control @error('tanggal') is-invalid @enderror" name="tanggal" id="tanggal" value="" style="width: 30%;">
                  @if ($errors->has('tanggal'))
                  <span class="invalid-feedback" role="alert">{{$errors->first('tanggal')}}</span>
                  @endif
                </div>
              </div>

              <div class="form-group row">
                <label for="produk" class="col-sm-4 col-form-label" style="text-align:right;">Jumlah</label>
                <div class="col-sm-3">
                  <input type="number" class="form-control @error('jumlah') is-invalid @enderror" name="jumlah" id="jumlah" value="">
                  @if ($errors->has('jumlah'))
                  <span class="invalid-feedback" role="alert">{{$errors->first('jumlah')}}</span>
                  @endif
                  <span id="jumlah-message" role="alert"></span>
                </div>
              </div>


              <div class="form-group row">
                <div class="table-responsive">
                  <table id="tableitem" class="table table-hover styled-table">
                    <thead style="text-align: center;">
                      <tr>
                        <th>No</th>
                        <th>Kode Perakitan</th>
                      </tr>
                    </thead>
                    <tbody style="text-align:center;">

                    </tbody>
                  </table>
                </div>
              </div>
            </div>
        </div>
        <div class="card-footer">
          <span>
            <button type="button" class="btn btn-block btn-danger" style="width:200px;float:left;">Batal</button>
          </span>
          <span>
            <button type="submit" class="btn btn-block btn-success btn" style="width:200px;float:right;">Tambahkan</button>
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
@section('adminlte_js')
<script>
  $(function() {
    function formatted_string(pad, user_str, pad_pos) {
      if (typeof user_str === 'undefined')
        return pad;
      if (pad_pos == 'l') {
        return (pad + user_str).slice(-pad.length);
      } else {
        return (user_str + pad).substring(0, pad.length);
      }
    }

    function numberRows($t) {
      var c = 0 - 1;
      $t.find("tr").each(function(ind, el) {
        $(el).find("td:eq(0)").html(++c);
        var j = c - 1;
        $(el).find('input[id="tanggals"]').attr('name', 'tanggals[' + j + ']');
        $(el).find('input[id="no_seri"]').attr('name', 'no_seri[' + j + ']');
      });
    }

    $('#jumlah').on('keyup change', function() {
      var jumlah = $('#jumlah').val();
      var alias_tim = "{{$sh->alias_tim}}";
      if (jumlah !== 0) {
        $('#tableitem tbody').empty();
        $.ajax({
          url: 'get_count_hasil_perakitan/' + "{{$sh->id}}",
          type: "GET",
          dataType: "json",
          success: function(data) {
            datatables = "";
            for (var i = 0; i < jumlah; i++) {
              datatables += `<tr>
                        <td>` + (i + 1) + `</td>
                        <td>
                        <div class="form-group row">
                          <input type="text" class="form-control @error('hasil_perakitans.*.alias') is-invalid @enderror col-sm-3" name="alias[]" id="alias" value="{{$sh->alias_tim}}" readonly>
                          <input type="text" class="form-control @error('hasil_perakitans.*.no_seri') is-invalid @enderror col-sm-5" name="no_seri[]" id="no_seri" value="` + formatted_string('00000', (data + i + 1), 'l') + `" readonly>
                          @if ($errors->has('hasil_perakitans.*.no_seri'))
                          <span class="invalid-feedback" role="alert">{{$errors->first('hasil_perakitans.*.no_seri')}}</span>
                          @endif
                          <span id="no_seri-message[]" role="alert"></span>
                        </div>
                        </td>
                        </tr>`;


            }
            console.log(datatables);
            $("#tableitem").append(datatables);
          }
        });
      } else {
        $('#tableitem tbody').empty();
      }
    });

    $('#tableitem').on('click', '#closetable', function(e) {
      $(this).closest('tr').remove();
      numberRows($("#tableitem"));
    });

    $('#tableitem').on("change keyup", 'input[id="no_seri"]', function() {
      var bppb = "{{$sh->Bppb->id}}";
      var no_seri_val = $(this).closest('tr').find('input[id="no_seri"]').val();
      var no_seri = $(this).closest('tr').find('input[id="no_seri"]');
      var message = $(this).closest('tr').find('span[id="no_seri-message"]');
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
  })
</script>
@stop