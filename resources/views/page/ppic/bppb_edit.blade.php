@extends('adminlte.page')

@section('title', 'Beta Version')

@section('content_header')
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>BPPB</h1>
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
          <div class="card-header bg-warning">
            <h3 class="card-title"><i class="fas fa-edit" aria-hidden="true"></i>&nbsp;Ubah Data BPPB</h3>
          </div>
          <div class="card-body">
            <div class="col-md-12">
              <form action="{{ route('bppb.update', ['id' => $i->id]) }}" method="post">
                {{ csrf_field() }}
                {{ method_field('PUT') }}
                
                    <h3>Detail Produk</h3>
                  <!-- /.card-header -->
                  <!-- form start -->
                  <div class="form-horizontal">

                      <div class="form-group row">
                        <label for="fk_kategori" class="col-sm-3 col-form-label" style="text-align:right;">Kelompok Produk</label>
                        <div class="col-sm-9">

                          <select class="form-control select2 select2-info @error('kelompok_produk_id') is-invalid @enderror" data-dropdown-css-class="select2-info" style="width: 30%;" name="kelompok_produk_id">
                            @foreach($k as $j)
                            <option value="{{$j->id}}" @if($j->id === $i->kelompok_produk_id)
                              selected
                              @endif
                              >{{$j->nama}}</option>
                            @endforeach
                          </select>
                          @if ($errors->has('kelompok_produk_id'))
                          <span class="invalid-feedback" role="alert">{{$errors->first('kelompok_produk_id')}}</span>
                          @endif
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="detail_produk_id" class="col-sm-3 col-form-label" style="text-align:right;">Tipe Produk</label>
                        <div class="col-sm-9">
                          <select class="form-control select2 select2-info @error('detail_produk_id') is-invalid @enderror" data-dropdown-css-class="select2-info" style="width: 40%;" name="detail_produk_id">
                            @foreach($dp as $p)
                            <option value="{{$p->id}}" @if($p->id == $i->detail_produk_id)
                              selected
                              @endif>{{$p->nama}}</option>
                            @endforeach
                          </select>
                          @if ($errors->has('produk_id'))
                          <span class="invalid-feedback" role="alert">{{$errors->first('produk_id')}}</span>
                          @endif
                        </div>
                      </div>

                    

                  </div>
                

                
                    <h3>Detail BPPB</h3>
                  <!-- /.card-header -->
                  <!-- form start -->

                  <div class="form-horizontal">
                    

                      <div class="form-group row">
                        <label for="tanggal_bppb" class="col-sm-3 col-form-label" style="text-align:right;">Tanggal BPPB</label>
                        <div class="col-sm-9">
                          <input type="date" class="form-control @error('tanggal_bppb') is-invalid @enderror" name="tanggal_bppb" id="tanggal_bppb" value="{{$i->tanggal_bppb}}" style="width: 20%;">
                          @if ($errors->has('tanggal_bppb'))
                          <span class="invalid-feedback" role="alert">{{$errors->first('tanggal_bppb')}}</span>
                          @endif
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="divisi_id" class="col-sm-3 col-form-label" style="text-align:right;">Divisi</label>

                        <div class="col-sm-2 col-form-label">
                          <div class="icheck-primary d-inline">
                            <input type="radio" id="17" name="divisi_id" value="17" @if($i->divisi_id == "17")
                            checked
                            @endif>
                            <label for="17">
                              Produksi
                            </label>
                          </div>
                        </div>

                        <div class="col-sm-2 col-form-label">
                          <div class="icheck-primary d-inline ">
                            <input type="radio" id="12" name="divisi_id" value="12" @if($i->divisi_id == "12")
                            checked
                            @endif>
                            <label for="12">
                              Perbaikan
                            </label>
                          </div>
                        </div>
                        @if ($errors->has('divisi_id'))
                        <span class="invalid-feedback" role="alert">{{$errors->first('divisi_id')}}</span>
                        @endif

                      </div>

                      <div class="form-group row">
                        <label for="no_bppb" class="col-sm-3 col-form-label" style="text-align:right;">No BPPB</label>
                        <div class="col-sm-1">
                          <input type="text" class="form-control @error('no_bppb_urutan') is-invalid @enderror" id="no_bppb_urutan" name="no_bppb_urutan" value="{{$no_bppb[0]}}" readonly>
                        </div>
                        <div class="col-sm-1">
                          <input type="text" class="form-control @error('no_bppb_kode') is-invalid @enderror" id="no_bppb_kode" name="no_bppb_kode" value="{{$no_bppb[1]}}" readonly>
                        </div>
                        <div class="col-sm-1">
                          <input type="text" class="form-control @error('no_bppb_bulan') is-invalid @enderror" id="no_bppb_bulan" name="no_bppb_bulan" value="{{$no_bppb[2]}}" readonly>
                        </div>
                        <div class="col-sm-1">
                          <input type="text" class="form-control @error('no_bppb_tahun') is-invalid @enderror" id="no_bppb_tahun" name="no_bppb_tahun" value="{{$no_bppb[3]}}" readonly>
                        </div>
                        @if ($errors->has('no_bppb_urutan') || $errors->has('no_bppb_kode') || $errors->has('no_bppb_bulan') || $errors->has('no_bppb_tahun'))
                        <span class="invalid-feedback" role="alert">Setiap Komponen Harus diisi Lengkap</span>
                        @endif
                      </div>

                      <div class="form-group row">
                        <label for="jumlah" class="col-sm-3 col-form-label" style="text-align:right;">Jumlah Produksi</label>
                        <div class="col-sm-9">
                          <input type="number" class="form-control @error('jumlah') is-invalid @enderror" id="jumlah" name="jumlah" value="{{$i->jumlah}}" style="width: 10%;" min="0">
                          @if ($errors->has('jumlah'))
                          <span class="invalid-feedback" role="alert">{{$errors->first('jumlah')}}</span>
                          @endif
                        </div>
                      </div>

                    
                  </div>
                

                
              
            </div>
            <!-- /.card -->

          </div>
          <div class="card-footer">
          <span>
                  <button type="button" class="btn btn-block btn-danger" style="width:200px;float:left;"><i class="fa fa-times "></i>&nbsp;Batal</button>
                </span>
                <span>
                  <button type="submit" class="btn btn-block btn-warning" style="width:200px;float:right;"><i class="fas fa-edit"></i>&nbsp;Simpan Perubahan</button>
                </span>
          </div>
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
    function formatted_string(pad, user_str, pad_pos) {
                if (typeof user_str === 'undefined')
                    return pad;
                if (pad_pos == 'l') {
                    return (pad + user_str).slice(-pad.length);
                } else {
                    return (user_str + pad).substring(0, pad.length);
                }
            }
    $('select[name="kelompok_produk_id"]').on('change', function() {
      var kelompok_produk_id = jQuery(this).val();
      console.log(kelompok_produk_id);
      if (kelompok_produk_id) {
        $.ajax({
          url: 'get_detail_produk_by_kelompok_produk/' + kelompok_produk_id,
          type: "GET",
          dataType: "json",
          success: function(data) {
            console.log(data);
            $('select[name="detail_produk_id"]').empty();
            $('select[name="detail_produk_id"]').append('<option value=""></option>');
            $.each(data, function(key, value) {
              console.log(value);
              $('select[name="detail_produk_id"]').append('<option value="' + value.id + '">' + value.nama + '</option>');
              $('input[name="no_bppb_kode"]').val(value.kode_barcode);
            });
          }
        });
      } else {
        $('select[name="detail_produk_id"]').empty();
      }
    });

    $('select[name="detail_produk_id"]').on('change', function() {
      var detail_produk_id = $(this).val();
      console.log(detail_produk_id);
      if (detail_produk_id) {
        $.ajax({
          url: 'get_detail_produk_by_id/' + detail_produk_id,
          type: "GET",
          dataType: "json",
          success: function(data) {
            $('input[name="no_bppb_kode"]').val(data[0]['produk']['kode_barcode']);
          }
        });

        var tanggal = new Date($(this).val());
        var tahun = tanggal.getFullYear();
        if (tahun != "") {
          $.ajax({
            url: 'get_bppb_detail_produk_count_by_year/' + tahun + '/' + detail_produk_id,
            type: "GET",
            dataType: "json",
            success: function(data) {
              console.log(data);
              $('input[name="no_bppb_urutan"]').val(formatted_string('0000', (data + 1), 'l'));
            }
          })
        }

      }
    });

    $('input[name="tanggal_bppb"]').on('change', function() {
      var tanggal = new Date($(this).val());
      var tahun = tanggal.getFullYear();
      var detail_produk_id = $('select[name="detail_produk_id"]').val();
      $('input[name="no_bppb_bulan"]').val(formatted_string('00', (tanggal.getMonth() + 1), 'l'));
      $('input[name="no_bppb_tahun"]').val(formatted_string('00', (tanggal.getYear()), 'l'));
      if (detail_produk_id != "" && tahun != "") {
        $.ajax({
          url: 'get_bppb_detail_produk_count_by_year/' + tahun + '/' + detail_produk_id,
          type: "GET",
          dataType: "json",
          success: function(data) {
            console.log(data);
            $('input[name="no_bppb_urutan"]').val(formatted_string('0000', (data + 1), 'l'));
          }
        })
      }
    });
  });
</script>
@stop