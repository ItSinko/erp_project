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
          <div class="card-header bg-success">
            <h3 class="card-title"><i class="fa fa-plus-circle" aria-hidden="true"></i>&nbsp;Tambah BPPB</h3>
          </div>
          <div class="card-body">
            <div class="col-md-12">
              <form action="{{ route('bppb.store') }}" method="post">
                {{ csrf_field() }}

                <h3>Detail Produk</h3>
                <div class="form-horizontal">
                  <div class="form-group row">
                    <label for="fk_kategori" class="col-sm-4 col-form-label" style="text-align:right;">Kelompok Barang</label>
                    <div class="col-sm-8">
                      <select class="form-control select2 select2-info @error('kelompok_produk_id') is-invalid @enderror" data-dropdown-css-class="select2-info" style="width: 30%;" data-placeholder="Pilih Kelompok Barang" name="kelompok_produk_id">
                        <option value=""></option>
                        @foreach($k as $i)
                        <option value="{{$i->id}}">{{$i->nama}}</option>
                        @endforeach
                      </select>
                      @if ($errors->has('kelompok_produk_id'))
                      <span class="invalid-feedback" role="alert">{{$errors->first('kelompok_produk_id')}}</span>
                      @endif
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="detail_produk_id" class="col-sm-4 col-form-label" style="text-align:right;">Tipe Produk</label>
                    <div class="col-sm-8">
                      <select class="form-control select2 select2-info @error('detail_produk_id') is-invalid @enderror" data-placeholder="Pilih Tipe Produk" data-dropdown-css-class="select2-info" style="width: 50%;" name="detail_produk_id">
                      </select>
                      @if ($errors->has('detail_produk_id'))
                      <span class="invalid-feedback" role="alert">{{$errors->first('detail_produk_id')}}</span>
                      @endif
                    </div>
                  </div>
                </div>


                <h3>Detail BPPB</h3>
                <div class="form-horizontal">
                  <div class="form-group row">
                    <label for="tanggal_bppb" class="col-sm-4 col-form-label" style="text-align:right;">Tanggal BPPB</label>
                    <div class="col-sm-8">
                      <input type="date" class="form-control @error('tanggal_bppb') is-invalid @enderror" name="tanggal_bppb" id="tanggal_bppb" value="{{old('tanggal_bppb')}}" style="width: 20%;">
                      @if ($errors->has('tanggal_bppb'))
                      <span class="invalid-feedback" role="alert">{{$errors->first('tanggal_bppb')}}</span>
                      @endif
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="divisi_id" class="col-sm-4 col-form-label" style="text-align:right;">Divisi</label>

                    <div class="col-sm-2 col-form-label">
                      <div class="icheck-primary d-inline">
                        <input type="radio" id="17" name="divisi_id" value="17" checked>
                        <label for="17">
                          Produksi
                        </label>
                      </div>
                    </div>

                    <div class="col-sm-2 col-form-label">
                      <div class="icheck-primary d-inline">
                        <input type="radio" id="12" name="divisi_id" value="12">
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
                    <label for="no_bppb" class="col-sm-4 col-form-label" style="text-align:right;">No BPPB</label>
                    <div class="col-sm-1">
                      <input type="text" class="form-control @error('no_bppb_urutan') is-invalid @enderror" id="no_bppb_urutan" name="no_bppb_urutan" value="{{old('no_bppb')}}" readonly>
                    </div>
                    <div class="col-sm-1">
                      <input type="text" class="form-control @error('no_bppb_kode') is-invalid @enderror" id="no_bppb_kode" name="no_bppb_kode" value="{{old('no_bppb_kode')}}" readonly>
                    </div>
                    <div class="col-sm-1">
                      <input type="text" class="form-control @error('no_bppb_bulan') is-invalid @enderror" id="no_bppb_bulan" name="no_bppb_bulan" value="{{old('no_bppb_bulan')}}" readonly>
                    </div>
                    <div class="col-sm-1">
                      <input type="text" class="form-control @error('no_bppb_tahun') is-invalid @enderror" id="no_bppb_tahun" name="no_bppb_tahun" value="{{old('no_bppb_tahun')}}" readonly>
                    </div>
                    @if ($errors->has('no_bppb_urutan') || $errors->has('no_bppb_kode') || $errors->has('no_bppb_bulan') || $errors->has('no_bppb_tahun'))
                    <span class="invalid-feedback" role="alert">Setiap Komponen Harus diisi Lengkap</span>
                    @endif
                  </div>

                  <div class="form-group row">
                    <label for="jumlah" class="col-sm-4 col-form-label" style="text-align:right;">Jumlah Produksi</label>
                    <div class="col-sm-8">
                      <input type="number" class="form-control @error('jumlah') is-invalid @enderror" id="jumlah" name="jumlah" value="{{old('jumlah')}}" style="width: 10%;" min="0">
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
              <button type="button" class="btn btn-block btn-danger rounded-pill" style="width:200px;float:left;"><i class="fas fa-times"></i>&nbsp;Batal</button>
            </span>
            <span>
              <button type="submit" class="btn btn-block btn-success rounded-pill" style="width:200px;float:right;"><i class="fas fa-plus"></i>&nbsp;Tambahkan Data</button>
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
@section('footer_script')
<script>
  $(function() {
    $('select[name="kelompok_produk_id"]').on('change', function() {
      var kelompok_produk_id = jQuery(this).val();
      console.log(kelompok_produk_id);
      if (kelompok_produk_id) {
        $.ajax({
          url: 'get_detail_produk_by_kelompok/' + kelompok_produk_id,
          type: "GET",
          dataType: "json",
          success: function(data) {
            console.log(data);
            $('select[name="detail_produk_id"]').empty();
            $('select[name="detail_produk_id"]').append('<option value=""></option>');
            $.each(data, function(key, value) {
              console.log(value);
              $('select[name="detail_produk_id"]').append('<option value="' + value['detailproduk'][0]['id'] + '">' + value['detailproduk'][0]['nama'] + '</option>');
              $('input[name="no_bppb_kode"]').val(value['produk'][0]['kode_barcode']);
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
          url: 'get_kategori_by_produk/' + produk_id,
          type: "GET",
          dataType: "json",
          success: function(data) {
            console.log(data);
            $.each(data, function(key, value) {
              document.getElementById('kategori_id').value = value['kategori_id'];
            });
          }
        });

        $.ajax({
          url: 'get_detail_produk_id/' + produk_id,
          type: "GET",
          dataType: "json",
          success: function(data) {
            console.log(data);
            $.each(data, function(key, value) {
              $('input[name="no_bppb_kode"]').val(value['kode_barcode']);
            });
          }
        });

        var tanggal = new Date($(this).val());
        var tahun = tanggal.getFullYear();
        if (tahun != "") {
          $.ajax({
            url: '/get_bppb_produk_count_by_year/' + tahun + '/' + produk_id,
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
      var produk_id = $('select[name="produk_id"]').val();
      $('input[name="no_bppb_bulan"]').val(formatted_string('00', (tanggal.getMonth() + 1), 'l'));
      $('input[name="no_bppb_tahun"]').val(formatted_string('00', (tanggal.getYear()), 'l'));
      if (produk_id != "" && tahun != "") {
        $.ajax({
          url: '/get_bppb_produk_count_by_year/' + tahun + '/' + produk_id,
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