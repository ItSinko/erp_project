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
        <div class="card-header">
          <div class="card-title">Info BPPB</div>
        </div>
        <div class="card-body">

          <div class="card-body box-profile">
            <div class="text-center">
              <img class="product-img-small img-fluid" @if(empty($sh->Bppb->Produk->foto))
              src="{{url('assets/image/produk')}}/noimage.png"
              @elseif(!empty($sh->Bppb->Produk->foto))
              src="{{url('assets/image/produk')}}/{{$sh->Bppb->Produk->foto}}"
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

            </div>
            <div class="col-lg-6" style="vertical-align: middle;">
              <hgroup>
                <!-- hgroup is deprecated, just defiantly using it anyway -->
                <h6 class="card-subheading text-muted ">Jumlah</h6>
                <h5 class="card-heading">{{$sh->Bppb->jumlah}}</h5>
              </hgroup>
            </div>
          </div>


        </div>
      </div>
    </div>
    <div class="col-9">
      <div class="card">
        <div class="card-header">
          <div class="card-title">Ubah Laporan Perakitan</div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          @if(session()->has('success'))
          <div class="alert alert-success" role="alert">
            Berhasil mengubah Laporan Perakitan
          </div>
          @elseif(session()->has('error') || count($errors) > 0)
          <div class="alert alert-danger" role="alert">
            Gagal mengubah Laporan Perakitan
          </div>
          @endif
          <form action="{{route('perakitan.laporan.update',['id' => $sh->id])}}" method="post">
            {{ csrf_field() }}
            {{ method_field('PUT') }}
            <div class="form-group row">
              <label for="tanggal_laporan" class="col-sm-3 col-form-label" style="text-align:right;">Tanggal Laporan</label>
              <div class="col-sm-9">
                <input type="date" class="form-control" name="tanggal_laporan" id="tanggal_laporan" value="{{$sh->tanggal}}" style="width: 20%;">
                @if ($errors->has('tanggal_laporan'))
                <span class="invalid-feedback" role="alert">{{$errors->first('tanggal_laporan')}}</span>
                @endif
              </div>
            </div>

            <div class="form-group row">
              <table id="tableitem" class="table table-hover styled-table">
                <thead style="text-align: center;">
                  <tr>
                    <th>No</th>
                    <th hidden></th>
                    <th>Tanggal</th>
                    <th>No Seri</th>
                    <th>Operator</th>
                    <th>Warna</th>
                  </tr>
                </thead>
                <tbody style="text-align:center;">
                  @foreach($sh->HasilPerakitan as $i)
                  <tr>
                    <td class="counterCell"></td>
                    <td hidden><input type="text" id="id[]" name="id[{{$loop->iteration - 1}}]" value="{{$i->id}}"></td>
                    <td>
                      <div class="input-group">
                        <input type="date" class="form-control" name="tanggals[{{$loop->iteration - 1}}]" id="tanggals[]" value="{{$i->tanggal}}">
                      </div>
                    </td>
                    <td>
                      <div class="form-group">
                        <div class="input-group">
                          <input type="text" class="form-control @error('hasil_perakitans.*.no_seri') is-invalid @enderror" name="no_seri[{{$loop->iteration - 1}}]" id="no_seri[]" value="{{$i->no_seri}}">
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
                          <select class="select2 form-control @error('karyawan_id') is-invalid @enderror" multiple="multiple" name="karyawan_id[{{$loop->iteration - 1}}][]" id="karyawan_id[{{$loop->iteration - 1}}][]" data-placeholder="Pilih Operator" data-dropdown-css-class="select2-info" style="width: 100%;">
                            @foreach($kry as $j)
                            <option value="{{$j->id}}" @if($i->Karyawan->contains('id', $j->id))
                              selected
                              @endif
                              >{{$j->nama}}</option>
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
                        <input type="text" class="form-control" name="warna[{{$loop->iteration - 1}}]" id="warna[]" value="{{$i->warna}}">
                      </div>
                    </td>
                  </tr>
                  @endforeach
                </tbody>

              </table>
            </div>
        </div>
        <div class="card-footer">
          <span>
            <button type="button" class="btn btn-block btn-danger" style="width:200px;float:left;">Batal</button>
          </span>
          <span>
            <button type="submit" class="btn btn-block btn-success" style="width:200px;float:right;">Ubah</button>
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


    $('#tableitem').on("change keyup", 'input[id="no_seri[]"]', function() {
      var id = $(this).closest('tr').find('input[id="id[]"').val();
      var no_seri_val = $(this).closest('tr').find('input[id="no_seri[]"').val();
      var no_seri = $(this).closest('tr').find('input[id="no_seri[]"');
      var message = $(this).closest('tr').find('span[id="no_seri-message[]"]');
      if (no_seri_val) {
        $.ajax({
          url: '/perakitan/edit_laporan/get_no_seri_exist_not_in/' + no_seri_val + '/' + id,
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