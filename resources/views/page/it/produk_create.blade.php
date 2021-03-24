@extends('layouts.app')

@section('content')
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

<section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <div class="card">
              <div class="card-header" style="background-color: #3c8dbc;">
                <h3 class="card-title" style="color:white;"><i class="fa fa-plus-circle" aria-hidden="true"></i>&nbsp;Tambah Produk Baru</h3>
              </div>
              <div class="card-body">

            <div class="col-md-12">
            
              @if(session()->has('success'))
              <div class="alert alert-success" role="alert">
                Berhasil menambahkan produk
              </div>
              @elseif(session()->has('error') || count($errors) > 0)
              <div class="alert alert-danger" role="alert">
                Gagal menambahkan produk
              </div>
              @endif
            <form id="form-tambah-produk" action="{{ route('produk.store') }}" method="post">
            {{ csrf_field() }}
            
            <div class="card">
              <div class="card-header">
                <h3 class="card-title"><i class="fa fa-info-circle"></i>&nbsp;Informasi Umum</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <div class="form-horizontal">
                <div class="card-body">

                  <div class="form-group row">
                    <label for="fk_kategori" class="col-sm-3 col-form-label" style="text-align:right;">Kategori</label>
                    <div class="col-sm-9">
                        <select class="form-control select2 select2-info" data-dropdown-css-class="select2-info" style="width: 50%;" name = "kelompok_produk_id">
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
                    <label for="fk_kategori" class="col-sm-3 col-form-label" style="text-align:right;">Sub Kategori</label>
                    <div class="col-sm-9">
                        <select class="form-control select2 select2-info" data-dropdown-css-class="select2-info" style="width: 50%;" name = "kategori_id">
                          <option value="">-- Pilih Kategori --</option>
                        </select>
                        @if ($errors->has('kategori_id'))
                          <span class="invalid-feedback" role="alert">{{$errors->first('kategori_id')}}</span>
                        @endif
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="produk" class="col-sm-3 col-form-label" style="text-align:right;">Tipe Produk</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control @error('tipe') is-invalid @enderror" name="tipe" id="tipe" value="{{old('tipe')}}" style="width: 30%;">
                        <span id="tipe-message" role="alert"></span>
                        @if ($errors->has('tipe'))
                          <span class="invalid-feedback" role="alert">{{$errors->first('tipe')}}</span>
                        @endif
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="produk" class="col-sm-3 col-form-label" style="text-align:right;">Merk Produk</label>
                    <div class="col-sm-9">
                        <select class="form-control select2 select2-info" data-dropdown-css-class="select2-info" style="width: 30%;" name = "merk">
                            <option value="elitech">Elitech</option>
                            <option value="mentor">Mentor</option>
                            <option value="aelous">Aeolus</option>
                            <option value="vanward">Vanward</option>
                            <option value="other">Other</option>
                        </select>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="produk" class="col-sm-3 col-form-label" style="text-align:right;">Nama Produk</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control @error('nama') is-invalid @enderror " name="nama" id="nama" value="{{old('nama')}}" style="width: 60%;">
                        @if ($errors->has('nama'))
                          <span class="invalid-feedback" role="alert">{{$errors->first('nama')}}</span>
                        @endif
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="produk" class="col-sm-3 col-form-label" style="text-align:right;">Gambar</label>
                    <div class="col-sm-9">
                        <input type="file" class="form-control" name="image" class="image" id="image" value="{{old('foto')}}" style="width: 25%;">
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="produk" class="col-sm-3 col-form-label" style="text-align:right;">Keterangan</label>
                    <div class="col-sm-9">
                        <textarea class="form-control @error('keterangan') is-invalid @enderror " name="keterangan" id="keterangan" value="{{old('keterangan')}}"></textarea>
                        @if ($errors->has('keterangan'))
                          <span class="invalid-feedback" role="alert">{{$errors->first('keterangan')}}</span>
                        @endif
                    </div>
                  </div>

                </div>

              </div>
            </div>

            <div class="card">
              <div class="card-header">
                <h3 class="card-title"><i class="fa fa-info-circle"></i>&nbsp;Informasi Spesifik</h3>
              </div>
              <div class="form-horizontal">
                <div class="card-body">

                  <div class="form-group row">
                    <label for="produk" class="col-sm-3 col-form-label" style="text-align:right;">Kode Produk</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="kode" id="kode" value="{{old('kode')}}" style="width: 25%;">
                        @if ($errors->has('kode'))
                          <span class="invalid-feedback" role="alert">{{$errors->first('kode')}}</span>
                        @endif
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="produk" class="col-sm-3 col-form-label" style="text-align:right;">Kode Barcode</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control @error('kode_barcode') is-invalid @enderror " name="kode_barcode" id="kode_barcode" value="{{old('kode_barcode')}}" style="width: 15%;">
                        @if ($errors->has('kode_barcode'))
                          <span class="invalid-feedback" role="alert">{{$errors->first('kode_barcode')}}</span>
                        @endif
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="produk" class="col-sm-3 col-form-label" style="text-align:right;">Nama COO</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="nama_coo" id="nama_coo" value="{{old('nama_coo')}}" style="width: 35%;">
                        @if ($errors->has('nama_coo'))
                          <span class="invalid-feedback" role="alert">{{$errors->first('nama_coo')}}</span>
                        @endif
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="produk" class="col-sm-3 col-form-label" style="text-align:right;">No AKD</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control @error('no_akd') is-invalid @enderror " name="no_akd" id="no_akd" value="{{old('no_akd')}}" style="width: 35%;">
                        @if ($errors->has('no_akd'))
                          <span class="invalid-feedback" role="alert">{{$errors->first('no_akd')}}</span>
                        @endif
                    </div>
                  </div>

                </div>
              </div>
            </div>

            <div class="card">
              <div class="card-header">
                <h3 class="card-title"><i class="fa fa-info-circle"></i>&nbsp;Info Dimensi</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->

              <div class="form-horizontal">
                <div class="card-body">
                  <div class="form-group row">
                    <label for="berat" class="col-sm-3 col-form-label" style="text-align:right;">Berat</label>
                    <div class="col-sm-9">
                      <input type="number" class="form-control" id="berat" name="berat" value="{{old('berat')}}" style="width: 10%;" >
                      <div id="message"></div>
                      @if ($errors->has('berat'))
                      <span class="invalid-feedback" role="alert">{{$errors->first('berat')}}</span>
                      @endif
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="satuan" class="col-sm-3 col-form-label" style="text-align:right;">Satuan</label>
                    <div class="col-sm-9">
                      <select class="form-control select2 select2-info" data-dropdown-css-class="select2-info" style="width: 15%;" name = "satuan">
                      <option value="unit">Unit</option>
                        <option value="pcs">Pcs</option>
                        <option value="pack">Pack</option>
                        <option value="set">Set</option>
                        <option value="dus">Dus</option>
                        <option value="meter">Meter</option>
                        <option value="roll">Roll</option>
                      </select>
                      <div id="message"></div>
                      @if ($errors->has('satuan'))
                      <span class="invalid-feedback" role="alert">{{$errors->first('satuan')}}</span>
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
                <button type="submit" class="btn btn-block btn-success" style="width:200px;float:right;">Tambahkan</button>
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
@section('footer_script')
<script>
$(function()
{
  $('select[name="kelompok_produk_id"]').on('change',function(){
    var kelompok_produk_id = jQuery(this).val();
    console.log(kelompok_produk_id);
    if(kelompok_produk_id)
    {
      $.ajax({
        url : 'get_kategori_produk/' +kelompok_produk_id,
        type : "GET",
        dataType : "json",
        success:function(data)
        {
          console.log(data);
          jQuery('select[name="kategori_id"]').empty();
          $.each(data, function(key,value)
          {
            $('select[name="kategori_id"]').append('<option value="'+ value['kategori_id'] +'">'+ value['nama_kategori'] +'</option>');
          });
        }
      });
    }
    else
    {
      $('select[name="kategori_id"]').empty();
    }
  });
  
  $('input[name="tipe"]').on("keyup", function(){
    var tipe = $(this).val();
    if(tipe){
      $.ajax({
        url : 'get_tipe_produk_exist/' +tipe,
        type : "GET",
        dataType : "json",
        success:function(data)
        {
          console.log(data);
          
            if(data > 0)
            {
              $('span[id="tipe-message"]').addClass("invalid-feedback");
              $('input[name="tipe"]').addClass("is-invalid");
              $('span[id="tipe-message"]').html("Tipe Produk Sudah Terpakai");
            }
            else
            {
              $('span[id="tipe-message"]').removeClass("invalid-feedback");
              $('input[name="tipe"]').removeClass("is-invalid");
              $('span[id="tipe-message"]').empty();
            }
          
        }
      });
    }
    else
    {
      $('span[id="tipe-message"]').removeClass("invalid-feedback");
      $('input[name="tipe"]').removeClass("is-invalid");
      $('span[id="tipe-message"]').empty();
    }
  });

var rupiah1 = document.getElementById("harga");
rupiah1.addEventListener("keyup", function(e) {
  rupiah1.value = convertRupiah(this.value);
});

rupiah1.addEventListener('keydown', function(event) {
	return isNumberKey(event);
});

$("#tambah-produk-form").submit(function() {
  $("#harga").unmask();
});

$('input[name="tipe"]').bind('keyup keypress blur', function() {
    var input1   = $(this).val();
    $('#nama_coo').val(input1);
  });
// $('input[name="tipe"]').keypress(function() {
//     var input1   = $(this).val();
//     $('#nama_coo').val(input1);
//   });


function convertRupiah(angka, prefix) {
  var number_string = angka.replace(/[^,\d]/g, "").toString(),
    split  = number_string.split(","),
    sisa   = split[0].length % 3,
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
	if ( 	key != 188 // Comma
		 && key != 8 // Backspace
		 && key != 17 && key != 86 & key != 67 // Ctrl c, ctrl v
		 && (key < 48 || key > 57) // Non digit
		) 
	{
		evt.preventDefault();
		return;
	}
}
});

var modal = $('#modal');
var image = document.getElementById('image');
var cropper ;
  
$("body").on("change", ".image", function(e){
    var files = e.target.files;
    var done = function (url) {
      image.src = url;
      $('#modal').modal('show');
    };
    var reader ;
    var file ;
    var url ;

    if (files && files.length > 0) {
      file = files[0];

      if (URL) {
        done(URL.createObjectURL(file));
      } else if (FileReader) {
        reader = new FileReader();
        reader.onload = function (e) {
          done(reader.result);
        };
        reader.readAsDataURL(file);
      }
    }
});

$('#modal').on('shown.bs.modal', function () {
    cropper = new Cropper(image, {
	  aspectRatio: 1,
	  viewMode: 3,
	  preview: '.preview'
    });
}).on('hidden.bs.modal', function () {
   cropper.destroy();
   cropper = null;
});

$("#crop").click(function(){
    canvas = cropper.getCroppedCanvas({
	    width: 160,
	    height: 160,
      });

    canvas.toBlob(function(blob) {
        url = URL.createObjectURL(blob);
        var reader = new FileReader();
         reader.readAsDataURL(blob); 
         reader.onloadend = function() {
            var base64data = reader . result ;	

            $.ajax({
                type: "POST",
                dataType: "json",
                url: "image-cropper/upload",
                data: {'_token': $('meta[name="_token"]').attr('content'), 'image': base64data},
                success: function(data){
                    $modal.modal('hide');
                    alert("success upload image");
                }
              });
         }
    });
  })

</script>
@stop
