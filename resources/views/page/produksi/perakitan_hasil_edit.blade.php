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
          <div class="card-header">
            <div class="card-title">Info Perakitan</div>
          </div>
          <div class="card-body">

            <div class="card-body box-profile">
              <div class="text-center">
                <img class="product-img-small img-fluid" @if(empty($s->Perakitan->Bppb->Produk->foto))
                src="{{url('assets/image/produk')}}/noimage.png"
                @elseif(!empty($s->Perakitan->Bppb->Produk->foto))
                src="{{url('assets/image/produk')}}/{{$s->Perakitan->Bppb->Produk->foto}}"
                @endif
                title="{{$s->Perakitan->Bppb->Produk->nama}}"
                >
              </div>
              <div style="text-align:center;vertical-align:center;padding-top:10px">
                <h5 class="card-heading">{{$s->Perakitan->Bppb->Produk->tipe}}</h5>
                <h6 class="card-subheading text-muted">{{$s->Perakitan->Bppb->Produk->nama}}</h6>
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
        <div class="card">
          <div class="card-header" style="background-color:#e6b800;">
            <h3 class="card-title" style="color:white;"><i class="fa fa-edit" aria-hidden="true"></i>&nbsp;Ubah Hasil Perakitan</h3>
          </div>
          <div class="card-body">

            <div class="col-md-12">

              @if(session()->has('success'))
              <div class="alert alert-success" role="alert">
                Berhasil mengubah produk
              </div>
              @elseif(session()->has('error') || count($errors) > 0)
              <div class="alert alert-danger" role="alert">
                Gagal menambahkan produk
              </div>
              @endif
              <form id="form-tambah-produk" action="{{route('perakitan.hasil.update', ['id' => $id])}}" method="post">
                {{ csrf_field() }}
                {{ method_field('PUT') }}

                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title"><i class="fa fa-info-circle"></i>&nbsp;Data Hasil Perakitan</h3>
                  </div>
                  <!-- /.card-header -->
                  <!-- form start -->
                  <div class="form-horizontal">
                    <div class="card-body">

                      <div class="form-group row">
                        <label for="tanggal" class="col-sm-3 col-form-label" style="text-align:right;">Tanggal</label>
                        <div class="col-sm-9">
                          <input type="date" class="form-control @error('tanggal') is-invalid @enderror" name="tanggal" id="tanggal" value="{{$s->tanggal}}" style="width: 30%;">
                          @if ($errors->has('tanggal'))
                          <span class="invalid-feedback" role="alert">{{$errors->first('tanggal')}}</span>
                          @endif
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="produk" class="col-sm-3 col-form-label" style="text-align:right;">Karyawan</label>
                        <div class="col-sm-6">
                          <select class="select2 form-control @error('karyawan_id') is-invalid @enderror" multiple="multiple" name="karyawan_id[]" id="karyawan_id[]" data-placeholder="Pilih Operator" data-dropdown-css-class="select2-info" style="width: 100%;">
                            @foreach($kry as $i)
                            <option value="{{$i->id}}" @if($s->Karyawan->contains('id', $i->id))
                              selected
                              @endif
                              >{{$i->nama}} </option>
                            @endforeach
                          </select>
                          @if ($errors->has('karyawan_id'))
                          <span class="invalid-feedback" role="alert">{{$errors->first('karyawan_id')}}</span>
                          @endif
                        </div>
                      </div>


                      <div class="form-group row">
                        <label for="produk" class="col-sm-3 col-form-label" style="text-align:right;">No Seri</label>
                        <div class="col-sm-5">
                          <input type="text" class="form-control @error('no_seri') is-invalid @enderror" name="no_seri" id="no_seri" value="{{$s->no_seri}}">
                          @if ($errors->has('no_seri'))
                          <span class="invalid-feedback" role="alert">{{$errors->first('no_seri')}}</span>
                          @endif
                          <span id="no_seri-message" role="alert"></span>
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="warna" class="col-sm-3 col-form-label" style="text-align:right;">Warna</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control @error('warna') is-invalid @enderror" name="warna" id="warna" value="{{$s->warna}}" style="width: 30%;">
                          @if ($errors->has('warna'))
                          <span class="invalid-feedback" role="alert">{{$errors->first('warna')}}</span>
                          @endif
                        </div>
                      </div>

                    </div>

                  </div>
                </div>

                <span>
                  <button type="button" class="btn btn-block btn-danger" style="width:200px;float:left;">Batal</button>
                </span>
                <span>
                  <button type="submit" class="btn btn-block btn-success" style="width:200px;float:right;">Ubah</button>
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
  var ids = {
    {
      $id
    }
  };
  $(function() {
    $('#no_seri').on("change keyup", function() {
      var id = ids;
      var no_seri_val = $('input[id="no_seri"]').val();
      var no_seri = $('input[id="no_seri"]');
      var message = $('span[id="no_seri-message"]');
      if (no_seri_val) {
        $.ajax({
          url: '/perakitan/hasil_perakitan/edit/get_no_seri_exist_not_in/' + no_seri_val + '/' + id,
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