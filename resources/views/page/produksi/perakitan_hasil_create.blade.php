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
        <div class="card-header">
          <div class="card-title">Info Perakitan</div>
        </div>
        <div class="card-body">
          <div class="card-body box-profile">
            <div class="text-center">
              <img class="product-img-small img-fluid" @if(empty($sh->Bppb->Produk->foto))
              src="{{url('assets/image/produk')}}/noimage.png"
              @elseif(!empty($sh->Bppb->Produk->foto))
              src="{{url('assets/image/produk')}}/{{$sh->Bppb->Produk->foto_produk}}"
              @endif
              title="{{$sh->Bppb->Produk->nama}}"
              >
            </div>
            <div style="text-align:center;vertical-align:center;padding-top:10px">
              <h5 class="card-heading">{{$sh->Bppb->Produk->tipe}}</h5>
              <h6 class="card-subheading text-muted">{{$sh->Bppb->Produk->nama}}</h6>
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
                <h5 class="card-heading">{{$sh->Bppb->jumlah}} {{ucfirst($sh->Bppb->Produk->satuan)}}</h5>
              </hgroup>
            </div>
            <hgroup class="col-lg-12">
              <!-- hgroup is deprecated, just defiantly using it anyway -->
              <h6 class="card-subheading text-muted ">Status</h6>
              <h5 class="card-heading">
                @if( Auth::user()->divisi_id == "17")
                @if($sh->status == 0)
                <span class="label info-text">Dibuat</span>
                @elseif($sh->status == '12')
                <span class="label warning-text">Menunggu</span>
                @endif
                @endif
              </h5>
            </hgroup>
          </div>
        </div>
      </div>
    </div>
    <div class="col-9">
      <div class="card">
        <div class="card-header">
          <div class="card-title">Hasil Perakitan</div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          @if(session()->has('success'))
          <div class="alert alert-success" role="alert">
            Berhasil menambahkan produk
          </div>
          @elseif(session()->has('error') || count($errors) > 0)
          <div class="alert alert-danger" role="alert">
            Gagal menambahkan produk
          </div>
          @endif
          <form action="{{ route('perakitan.hasil.store', ['id' => $sh->id]) }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            {{ method_field('PUT') }}
            <table id="tableitem" class="table table-hover styled-table">
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
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody style="text-align:center;">
                <tr>
                  <td class="counterCell"></td>
                  <td>
                    <div class="input-group">
                      <input type="date" class="form-control" name="tanggals[]" id="tanggals[]">
                    </div>
                  </td>
                  <td>
                    <div class="form-group">
                      <div class="input-group">
                        <input type="text" class="form-control @error('hasil_perakitans.*.no_seri') is-invalid @enderror" name="no_seri[]" id="no_seri[]">
                      </div>
                      @if ($errors->has('hasil_perakitans.*.no_seri'))
                      <span class="invalid-feedback" role="alert">{{$errors->first('hasil_perakitans.*.no_seri')}}</span>
                      @endif
                      <span id="no_seri-message[]" role="alert"></span>
                    </div>
                  </td>
                  <td>
                    <div class="form-group">
                      <div class="select2-info">
                        <select class="select2 form-control @error('karyawan_id') is-invalid @enderror" multiple="multiple" name="karyawan_id[]" id="karyawan_id[]" data-placeholder="Pilih Operator" data-dropdown-css-class="select2-info" style="width: 100%;">
                          @foreach($k as $i)
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
                    <button type="button" class="btn btn-block btn-danger btn-sm" id="closetable"><i class="fas fa-times-circle"></i></button>
                  </td>
                </tr>
              </tbody>

            </table>
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
@section('adminlte_js')
<script>
  $(function() {
    $('#tambahitem').click(function(e) {
      $('#tableitem tr:last').after(`<tr>
      <td class="counterCell"></td>
      <td>
        <div class="input-group">
          <input type="date" class="form-control" name="tanggals[]" id="tanggals[]">
        </div>
      </td>
      <td>
        <div class="form-group">
          <div class="input-group">
            <input type="text" class="form-control @error('hasil_perakitans.*.no_seri') is-invalid @enderror"" name="no_seri[]" id="no_seri[]">
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
            <select class="select2 form-control @error('karyawan_id') is-invalid @enderror" multiple="multiple" name="karyawan_id[]" id="karyawan_id[]" data-placeholder="Pilih Operator" data-dropdown-css-class="select2-info" style="width: 100%;">
            @foreach($k as $i)
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
        <button type="button" class="btn btn-block btn-danger btn-sm" id="closetable" ><i class="fas fa-times-circle"></i></button>
      </td>
      </tr>`)
    });

    $('#tableitem').on('click', '#closetable', function(e) {
      $(this).closest('tr').remove();
    });

    $('#tableitem').on("change keyup", 'input[name="no_seri[]"]', function() {
      var no_seri_val = $(this).closest('tr').find('input[name="no_seri[]"').val();
      var no_seri = $(this).closest('tr').find('input[name="no_seri[]"');
      var message = $(this).closest('tr').find('span[id="no_seri-message[]"]');
      if (no_seri_val) {
        $.ajax({
          url: '/tambah_hasil_perakitan/get_no_seri_exist/' + no_seri_val,
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