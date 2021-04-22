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
            <h3 class="card-title"><i class="fa fa-plus-circle" aria-hidden="true"></i>&nbsp;Tambah Produk</h3>
          </div>
          <div class="card-body">
            <div class="col-md-12">
              <form id="form-tambah-produk" action="{{ route('produk.store') }}" method="post">
                {{ csrf_field() }}

                <h3>Tentang Produk</h3>
                <div class="form-horizontal">
                  <div class="form-group row">
                    <label for="kelompok_produk_id" class="col-sm-4 col-form-label" style="text-align:right;">Kelompok</label>
                    <div class="col-sm-8">
                      <select class="form-control select2 select2-info" data-dropdown-css-class="select2-info" style="width: 50%;" name="kelompok_produk_id" data-placeholder="Pilih Kelompok Produk">
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
                    <label for="kategori_id" class="col-sm-4 col-form-label" style="text-align:right;">Kategori Produk</label>
                    <div class="col-sm-8">
                      <select class="form-control select2 select2-info" data-dropdown-css-class="select2-info" style="width: 50%;" name="kategori_id" data-placeholder="Pilih Kategori Produk">
                        <option value=""></option>
                      </select>
                      @if ($errors->has('kategori_id'))
                      <span class="invalid-feedback" role="alert">{{$errors->first('kategori_id')}}</span>
                      @endif
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="produk" class="col-sm-4 col-form-label" style="text-align:right;">Tipe Produk</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control @error('tipe') is-invalid @enderror" name="tipe" id="tipe" value="{{old('tipe')}}" style="width: 30%;">
                      <span id="tipe-message" role="alert"></span>
                      @if ($errors->has('tipe'))
                      <span class="invalid-feedback" role="alert">{{$errors->first('tipe')}}</span>
                      @endif
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="produk" class="col-sm-4 col-form-label" style="text-align:right;">Merk Produk</label>
                    <div class="col-sm-8">
                      <select class="form-control select2 select2-info" data-dropdown-css-class="select2-info" style="width: 30%;" name="merk" data-placeholder="Pilih Merk">
                        <option value=""></option>
                        <option value="elitech">Elitech</option>
                        <option value="mentor">Mentor</option>
                        <option value="aelous">Aeolus</option>
                        <option value="vanward">Vanward</option>
                        <option value="other">Other</option>
                      </select>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="produk" class="col-sm-4 col-form-label" style="text-align:right;">Nama Produk</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control @error('nama') is-invalid @enderror " name="nama" id="nama" value="{{old('nama')}}" style="width: 60%;">
                      @if ($errors->has('nama'))
                      <span class="invalid-feedback" role="alert">{{$errors->first('nama')}}</span>
                      @endif
                    </div>
                  </div>
                </div>


                <h3>Informasi</h3>
                <div class="form-horizontal">
                  <div class="form-group row">
                    <label for="produk" class="col-sm-4 col-form-label" style="text-align:right;">Kode Barcode</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control @error('kode_barcode') is-invalid @enderror " name="kode_barcode" id="kode_barcode" value="{{old('kode_barcode')}}" style="width: 15%;">
                      @if ($errors->has('kode_barcode'))
                      <span class="invalid-feedback" role="alert">{{$errors->first('kode_barcode')}}</span>
                      @endif
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="produk" class="col-sm-4 col-form-label" style="text-align:right;">Nama COO</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" name="nama_coo" id="nama_coo" value="{{old('nama_coo')}}" style="width: 35%;">
                      @if ($errors->has('nama_coo'))
                      <span class="invalid-feedback" role="alert">{{$errors->first('nama_coo')}}</span>
                      @endif
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="produk" class="col-sm-4 col-form-label" style="text-align:right;">No AKD</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control @error('no_akd') is-invalid @enderror " name="no_akd" id="no_akd" value="{{old('no_akd')}}" style="width: 35%;">
                      @if ($errors->has('no_akd'))
                      <span class="invalid-feedback" role="alert">{{$errors->first('no_akd')}}</span>
                      @endif
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="produk" class="col-sm-4 col-form-label" style="text-align:right;">Keterangan</label>
                    <div class="col-sm-8">
                      <textarea class="form-control @error('keterangan') is-invalid @enderror" name="keterangan" id="keterangan" value="{{old('keterangan')}}"></textarea>
                      @if ($errors->has('keterangan'))
                      <span class="invalid-feedback" role="alert">{{$errors->first('keterangan')}}</span>
                      @endif
                    </div>
                  </div>
                </div>

                <h3>Detail Produk</h3>
                <div class="form-horizontal">
                  <div class="form-group row">
                    <table id="tableitem" class="table table-hover">
                      <thead style="text-align: center;">
                        <tr>
                          <th>No</th>
                          <th>Kode</th>
                          <th>Nama</th>
                          <th>Harga</th>
                          <th>Berat</th>
                          <th>Satuan</th>
                          <th>Keterangan</th>
                          <th>Aksi</th>
                        </tr>
                      </thead>
                      <tbody style="text-align:center;">
                        <tr>
                          <td>1</td>
                          <td><input type="text" class="form-control @error('kode') is-invalid @enderror" name="kode[]" id="kode" value="{{old('kode')}}"></td>
                          <td>
                            <div class="form-group row">
                              <input type="text" class="form-control @error('nama_detail1') is-invalid @enderror col-sm-4" name="nama_detail1[]" id="nama_detail1" value="{{old('nama_detail1')}}">
                              <input type="text" class="form-control @error('nama_detail2') is-invalid @enderror col-sm-8" name="nama_detail2[]" id="nama_detail2" value="{{old('nama_detail2')}}">
                            </div>
                          </td>
                          <td><input type="text" class="form-control @error('harga') is-invalid @enderror" name="harga[]" id="harga" value="{{old('harga')}}"></td>
                          <td><input type="number" class="form-control @error('berat') is-invalid @enderror" name="berat[]" id="berat" value="{{old('berat')}}"></td>
                          <td>
                            <select class="form-control select2 select2-info satuan" data-placeholder="Pilih Satuan" data-dropdown-css-class="select2-info" name="satuan[]" id="satuan">
                              <option value="unit">Unit</option>
                              <option value="pcs">Pcs</option>
                              <option value="pack">Pack</option>
                              <option value="set">Set</option>
                              <option value="dus">Dus</option>
                              <option value="meter">Meter</option>
                              <option value="roll">Roll</option>
                            </select>
                          </td>
                          <td>
                            <textarea class="form-control @error('keterangan_detail') is-invalid @enderror " name="keterangan_detail[]" id="keterangan_detail">{{old('keterangan_detail')}}</textarea>
                          </td>
                          <td><button type="button" class="btn btn-success karyawan-img-small" style="border-radius:50%;" id="tambahitem"><i class="fas fa-plus-circle"></i></button></td>
                        </tr>
                      </tbody>

                    </table>
                  </div>
                </div>
            </div>
          </div>
          <div class="card-footer"><span>
              <button type="button" class="btn btn-block btn-danger rounded-pill" style="width:200px;float:left;"><i class="fas fa-times"></i>&nbsp;Batal</button>
            </span>
            <span>
              <button type="submit" class="btn btn-block btn-success rounded-pill" style="width:200px;float:right;"><i class="fas fa-plus"></i>&nbsp;Tambahkan</button>
            </span>
          </div>
        </div>
        </form>
      </div>
    </div>
  </div>

  <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalLabel">Preview</h5>
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
  $(function() {
    function numberRows($t) {
      var tipe = $('input[name="tipe"]').val();
      var c = 0 - 1;
      $t.find("tr").each(function(ind, el) {
        $(el).find("td:eq(0)").html(++c);
        var j = c - 1;
        $(el).find('.satuan').attr('name', 'satuan[' + j + ']');
        $(el).find('.satuan').attr('id', 'satuan' + j);
        if (tipe) {
          $(el).find('input[id="nama_detail1"]').val(tipe);
        }
        $('.satuan').select2();
      });
    }

    $('#tambahitem').click(function(e) {
      $('#tableitem tr:last').after(`<tr>
      <td></td>
      <td><input type="text" class="form-control @error('kode') is-invalid @enderror" name="kode[]" id="kode" value="{{old('kode')}}"></td>
      <td><div class="form-group row">
            <input type="text" class="form-control @error('nama_detail1') is-invalid @enderror col-sm-4" name="nama_detail1[]" id="nama_detail1" value="{{old('nama_detail1')}}">
            <input type="text" class="form-control @error('nama_detail2') is-invalid @enderror col-sm-8" name="nama_detail2[]" id="nama_detail2" value="{{old('nama_detail2')}}">
          </div>
      </td>
      <td><input type="text" class="form-control @error('harga') is-invalid @enderror" name="harga[]" id="harga" value="{{old('harga')}}"></td>
      <td><input type="number" class="form-control @error('berat') is-invalid @enderror" name="berat[]" id="berat" value="{{old('berat')}}"></td>
      <td>
        <select class="form-control select2 select2-info satuan" data-placeholder="Pilih Satuan" data-dropdown-css-class="select2-info" name="satuan[]" id="satuan">
          <option value="unit">Unit</option>
          <option value="pcs">Pcs</option>
          <option value="pack">Pack</option>
          <option value="set">Set</option>
          <option value="dus">Dus</option>
          <option value="meter">Meter</option>
          <option value="roll">Roll</option>
        </select>
      </td>
      <td>
        <textarea class="form-control @error('keterangan_detail') is-invalid @enderror " name="keterangan_detail[]" id="keterangan_detail">{{old('keterangan_detail')}}</textarea>
      </td>
      <td>
        <button type="button" class="btn btn-danger karyawan-img-small" style="border-radius:50%;" id="closetable" ><i class="fas fa-times-circle"></i></button>
      </td>
      </tr>`);
      numberRows($("#tableitem"));
    });

    $('#tableitem').on('click', '#closetable', function(e) {
      $(this).closest('tr').remove();
      numberRows($("#tableitem"));
    });

    $('select[name="kelompok_produk_id"]').on('change', function() {
      var kelompok_produk_id = jQuery(this).val();
      console.log(kelompok_produk_id);
      if (kelompok_produk_id) {
        $.ajax({
          url: 'create/get_kategori_produk_by_kelompok_produk/' + kelompok_produk_id,
          type: "GET",
          dataType: "json",
          success: function(data) {
            console.log(data);
            $('select[name="kategori_id"]').empty();
            $('select[name="kategori_id"]').append('<option value=""></option>');
            $.each(data, function(key, value) {
              $('select[name="kategori_id"]').append('<option value="' + value['id'] + '">' + value['nama'] + '</option>');
            });
          }
        });
      } else {
        $('select[name="kategori_id"]').empty();
      }
    });

    $('input[name="tipe"]').on("keyup", function() {

      var tipe = $(this).val();
      $('#nama_coo').val(tipe);
      $('#tableitem').find('input[id="nama_detail1"]').val(tipe);
      if (tipe) {
        $.ajax({
          url: 'create/get_tipe_produk_exist/' + tipe,
          type: "GET",
          dataType: "json",
          success: function(data) {
            console.log(data);
            if (data > 0) {
              $('span[id="tipe-message"]').addClass("invalid-feedback");
              $('input[name="tipe"]').addClass("is-invalid");
              $('span[id="tipe-message"]').html("Tipe Produk Sudah Terpakai");
            } else {
              $('span[id="tipe-message"]').removeClass("invalid-feedback");
              $('input[name="tipe"]').removeClass("is-invalid");
              $('span[id="tipe-message"]').empty();
            }
          }
        });
      } else {
        $('span[id="tipe-message"]').removeClass("invalid-feedback");
        $('input[name="tipe"]').removeClass("is-invalid");
        $('span[id="tipe-message"]').empty();
      }
    });

    var rupiah1 = document.getElementById("harga");
    $('#tableitem').addEventListener("keyup", 'input[id="harga"]', function(e) {
      $(this).closest('tr').find('input[id="harga"]').val(convertRupiah(this.value));
    });

    $('#tableitem').addEventListener("keydown", 'input[id="harga"]', function(e) {
      return isNumberKey(event);
    });

    rupiah1.addEventListener('keydown', function(event) {
      return isNumberKey(event);
    });

    $("#tambah-produk-form").submit(function() {
      $("#harga").unmask();
    });

    // $('input[name="tipe"]').bind('keyup keypress blur', function() {
    //   var input1 = $(this).val();
    //   $('#nama_coo').val(input1);
    // });
    // $('input[name="tipe"]').keypress(function() {
    //   var input1 = $(this).val();
    //   $('#nama_coo').val(input1);
    // });


    function convertRupiah(angka, prefix) {
      var number_string = angka.replace(/[^,\d]/g, "").toString(),
        split = number_string.split(","),
        sisa = split[0].length % 3,
        rupiah = split[0].substr(0, sisa),
        ribuan = split[0].substr(sisa).match(/\d{3}/gi);

      if (ribuan) {
        separator = sisa ? "." : "";
        rupiah += separator + ribuan.join(".");
      }

      rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
      return prefix == undefined ? rupiah : rupiah ? prefix + rupiah : "";
    }

    function isNumberKey(evt) {
      key = evt.which || evt.keyCode;
      if (key != 188 // Comma
        &&
        key != 8 // Backspace
        &&
        key != 17 && key != 86 & key != 67 // Ctrl c, ctrl v
        &&
        (key < 48 || key > 57) // Non digit
      ) {
        evt.preventDefault();
        return;
      }
    }
  });

  var modal = $('#modal');
  var image = document.getElementById('image');
  var cropper;

  $("body").on("change", ".image", function(e) {
    var files = e.target.files;
    var done = function(url) {
      image.src = url;
      $('#modal').modal('show');
    };
    var reader;
    var file;
    var url;

    if (files && files.length > 0) {
      file = files[0];

      if (URL) {
        done(URL.createObjectURL(file));
      } else if (FileReader) {
        reader = new FileReader();
        reader.onload = function(e) {
          done(reader.result);
        };
        reader.readAsDataURL(file);
      }
    }
  });

  $('#modal').on('shown.bs.modal', function() {
    cropper = new Cropper(image, {
      aspectRatio: 1,
      viewMode: 3,
      preview: '.preview'
    });
  }).on('hidden.bs.modal', function() {
    cropper.destroy();
    cropper = null;
  });

  $("#crop").click(function() {
    canvas = cropper.getCroppedCanvas({
      width: 160,
      height: 160,
    });

    canvas.toBlob(function(blob) {
      url = URL.createObjectURL(blob);
      var reader = new FileReader();
      reader.readAsDataURL(blob);
      reader.onloadend = function() {
        var base64data = reader.result;

        $.ajax({
          type: "POST",
          dataType: "json",
          url: "image-cropper/upload",
          data: {
            '_token': $('meta[name="_token"]').attr('content'),
            'image': base64data
          },
          success: function(data) {
            $modal.modal('hide');
            alert("success upload image");
          }
        });
      }
    });
  })
</script>
@stop