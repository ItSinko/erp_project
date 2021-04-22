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
      <div class="col-3">
        <div class="card">
          <div class="card-header bg-info">
            <div class="card-title"><i class="fas fa-info-circle"></i>&nbsp;Info Perakitan</div>
          </div>
          <div class="card-body">

            <div class="card-body box-profile">
              <div class="text-center">
                <img class="product-img-small img-fluid" @if(empty($s->Perakitan->Bppb->DetailProduk->foto))
                src="{{url('assets/image/produk')}}/noimage.png"
                @elseif(!empty($s->Perakitan->Bppb->DetailProduk->foto))
                src="{{url('assets/image/produk')}}/{{$s->Perakitan->Bppb->DetailProduk->foto}}"
                @endif
                title="{{$s->Perakitan->Bppb->DetailProduk->nama}}"
                >
              </div>
              <div style="text-align:center;vertical-align:center;padding-top:10px">
                <h5 class="card-heading">{{$s->Perakitan->Bppb->DetailProduk->nama}}</h5>
                <h6 class="card-subheading text-muted">{{$s->Perakitan->Bppb->DetailProduk->Produk->nama}}</h6>
              </div>
            </div>


            <div class="row">
              <div class="col-lg-6" style="vertical-align: middle;">
                <hgroup>
                  <!-- hgroup is deprecated, just defiantly using it anyway -->
                  <h6 class="card-subheading text-muted">No BPPB</h6>
                  <h5 class="card-heading">{{$s->Perakitan->Bppb->no_bppb}}</h5>
                </hgroup>
                <hgroup>
                  <!-- hgroup is deprecated, just defiantly using it anyway -->
                  <h6 class="card-subheading text-muted ">Tanggal</h6>
                  <h5 class="card-heading">{{date("d-m-Y", strtotime($s->Perakitan->tanggal))}}</h5>
                </hgroup>
              </div>
              <div class="col-lg-6" style="vertical-align: middle;">
                <hgroup>
                  <!-- hgroup is deprecated, just defiantly using it anyway -->
                  <h6 class="card-subheading text-muted ">Jumlah</h6>
                  <h5 class="card-heading">{{$s->Perakitan->Bppb->jumlah}}</h5>
                </hgroup>
              </div>

            </div>
          </div>
        </div>
      </div>

      <div class="col-md-9">
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
          <div class="card-header bg-warning">
            <h3 class="card-title"><i class="fa fa-edit" aria-hidden="true"></i>&nbsp;Ubah Hasil Perakitan</h3>
          </div>
          <div class="card-body">

            <div class="col-md-12">
              <form id="form-tambah-produk" action="{{route('perakitan.hasil.update', ['id' => $id])}}" method="post">
                {{ csrf_field() }}
                {{ method_field('PUT') }}

                <!-- /.card-header -->
                <!-- form start -->
                <div class="form-horizontal">
                  <div class="form-group row">
                    <label for="tanggal" class="col-sm-4 col-form-label" style="text-align:right;">Tanggal</label>
                    <div class="col-sm-8">
                      <input type="date" class="form-control @error('tanggal') is-invalid @enderror" name="tanggal" id="tanggal" value="{{$s->tanggal}}" style="width: 30%;">
                      @if ($errors->has('tanggal'))
                      <span class="invalid-feedback" role="alert">{{$errors->first('tanggal')}}</span>
                      @endif
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="produk" class="col-sm-4 col-form-label" style="text-align:right;">No Seri</label>
                    <div class="col-sm-5">
                      <input type="text" class="form-control @error('no_seri') is-invalid @enderror" name="no_seri" id="no_seri" value="{{$s->no_seri}}">
                      @if ($errors->has('no_seri'))
                      <span class="invalid-feedback" role="alert">{{$errors->first('no_seri')}}</span>
                      @endif
                      <span id="no_seri-message" role="alert"></span>
                    </div>
                  </div>
                </div>



            </div>
            <!-- /.card -->

          </div>
          <div class="card-footer">
            <span>
              <button type="button" class="btn btn-block btn-danger btn-rounded" style="width:200px;float:left;"><i class="fas fa-times"></i>&nbsp;Batal</button>
            </span>
            <span>
              <button type="submit" class="btn btn-block btn-warning btn-rounded" style="width:200px;float:right;"><i class="fas fa-edit"></i>&nbsp;Simpan Perubahan</button>
            </span>
          </div>
        </div>
        </form>
      </div>

    </div>
    <!-- /.row -->
  </div><!-- /.container-fluid -->

  <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalLabel">Laravel Crop Image Before Upload using Cropper JS - NiceSnippets.com</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="img-container">
            <div class="row">
              <div class="col-md-8">
                <img id="image" src="https://avatars0.githubusercontent.com/u/3456749">
              </div>
              <div class="col-md-4">
                <div class="preview"></div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <button type="button" class="btn btn-primary" id="crop">Crop</button>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection

@section('adminlte_js')
<script>
  var ids = "{{$id}}";
  var bppb = "{{$s->Perakitan->Bppb->id}}"
  $(function() {
    $('#no_seri').on("change keyup", function() {
      var id = ids;
      var no_seri_val = $('input[id="no_seri"]').val();
      var no_seri = $('input[id="no_seri"]');
      var message = $('span[id="no_seri-message"]');
      if (no_seri_val) {
        $.ajax({
          url: '/perakitan/hasil/edit/get_kode_perakitan_exist_not_in_id/' + bppb + '/' + id + '/' + no_seri_val,
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