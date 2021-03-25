@extends('layouts.app')

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Inventory</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">DataTables</li>
                </ol>
            </div>
        </div>
    </div>
</section>
<section class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="col-lg-12">
                <form id="create-inventory" method="POST" action="{{route('inventory.store', ['divisi_id' => $divisi_id])}}">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                    @if(session()->has('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong><i class="fas fa-check"></i></strong> session()->get('success')
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @elseif(session()->has('error') || count($errors))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong><i class="fas fa-times"></i></strong> Gagal menambahkan data
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif


                    <div class="card">
                        <div class="card-header bg-success">
                            <div class="card-title"><i class="fas fa-plus-circle"></i>&nbsp;Tambah</div>
                        </div>
                        <div class="card-body">
                            <div class="col-lg-12">
                                <h4>Info Inventory</h4>

                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-horizontal">

                                            <div class="form-group row">
                                                <label for="divisi" class="col-sm-4 col-form-label" style="text-align:right;">Divisi</label>
                                                <div class="col-sm-8">
                                                    <label class="col-form-label">{{Auth::user()->Divisi->nama}}</label>
                                                    @if ($errors->has('divisi_id'))
                                                    <span class="invalid-feedback" role="alert">{{$errors->first('divisi_id')}}</span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="kode" class="col-sm-4 col-form-label" style="text-align:right;">Kode</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control @error('kode') is-invalid @enderror" name="kode" id="kode" placeholder="Masukkan Kode Inventory" value="{{old('kode')}}" style="width:45%;">
                                                    <span id="kode-message" role="alert"></span>
                                                    @if ($errors->has('kode'))
                                                    <span class="invalid-feedback" role="alert">{{$errors->first('kode')}}</span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="pic" class="col-sm-4 col-form-label" style="text-align:right;">Penanggung Jawab</label>
                                                <div class="col-sm-8">
                                                    <select class="form-control custom-select select2 select2-info @error('pic_id') is-invalid @enderror" data-dropdown-css-class="pic_id" style="width: 50%;" name="pic_id" data-placeholder="Pilih Divisi">
                                                        @foreach($p as $i)
                                                        <option value="{{$i->id}}">{{$i->nama}}</option>
                                                        @endforeach
                                                    </select>
                                                    @if ($errors->has('pic_id'))
                                                    <span class="invalid-feedback" role="alert">{{$errors->first('pic_id')}}</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <h4>Data Inventory</h4>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <table width="100%" class="table table-bordered" id="tableitem" style="text-align:center;">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Kode Barang</th>
                                                    <th>Merk</th>
                                                    <th>Nama Barang</th>
                                                    <th>Jumlah</th>
                                                    <th>Lokasi</th>
                                                    <th>Tanggal Perolehan</th>
                                                    <th>Masa Manfaat</th>
                                                    <th>Kondisi</th>
                                                    <th>Harga Perolehan</th>
                                                    <th>Keterangan</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>1</td>
                                                    <td><input type="text" placeholder="Masukkan Kode Barang" class="form-control @error('kode_barang') is-invalid @enderror" name="kode_barang[]" id="kode_barang" value="{{old('kode_barang')}}"></td>
                                                    <td><input type="text" placeholder="Masukkan Merk" class="form-control @error('merk') is-invalid @enderror" name="merk[]" id="merk" value="{{old('merk')}}"></td>
                                                    <td><input type="text" placeholder="Masukkan Nama Barang" class="form-control @error('nama_barang') is-invalid @enderror" name="nama_barang[]" id="nama_barang" value="{{old('nama_barang')}}"></td>
                                                    <td><input type="number" placeholder="Masukkan Jumlah" min="0" class="form-control @error('jumlah') is-invalid @enderror" name="jumlah[]" id="jumlah" value="{{old('jumlah')}}"></td>
                                                    <td><textarea placeholder="Masukkan Lokasi" class="form-control @error('lokasi') is-invalid @enderror" name="lokasi[]" id="lokasi"></textarea></td>
                                                    <td><input type="date" placeholder="Masukkan Tanggal Perolehan" class="form-control @error('tanggal_perolehan') is-invalid @enderror" name="tanggal_perolehan[]" id="tanggal_perolehan" value="{{old('tanggal_perolehan')}}"></td>
                                                    <td><input type="number" placeholder="Masukkan Masa Manfaat" class="form-control @error('masa_manfaat') is-invalid @enderror" name="masa_manfaat[]" id="masa_manfaat" value="{{old('masa_manfaat')}}"></td>
                                                    <td><input type="number" placeholder="Masukkan Kondisi" class="form-control @error('kondisi') is-invalid @enderror" name="kondisi[]" id="kondisi" value="{{old('kondisi')}}"></td>
                                                    <td><input type="text" placeholder="Masukkan Harga Perolehan" class="form-control @error('harga_perolehan') is-invalid @enderror" name="harga_perolehan[]" id="harga_perolehan" value="{{old('harga_perolehan')}}"></td>
                                                    <td><textarea placeholder="Masukkan Keterangan" class="form-control @error('keterangan') is-invalid @enderror" name="keterangan[]" id="keterangan"></textarea></td>
                                                    <td><button type="button" class="btn btn-block btn-success btn-sm circle-button karyawan-img-small" id="tambahitem"><i class="fas fa-plus"></i></button></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="card-footer">
                            <span class="float-left"><button class="btn btn-danger rounded-pill" id=""><i class="fas fa-times"></i>&nbsp;Batal</button></span>
                            <span class="float-right"><button type="submit" class="btn btn-success rounded-pill" id="button_tambah"><i class="fas fa-plus"></i>&nbsp;Tambah Data</button></span>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection

@section('footer_script')
<script>
    $(function() {
        $('input[name="tanggal_perolehan[]"]').val(year + "-01-01");
        $('#tambahitem').click(function(e) {
            $('#tableitem tr:last').after(`
                <tr>
                <td></td>
                <td><input type="text" placeholder="Masukkan Kode Barang" class="form-control @error('kode_barang') is-invalid @enderror" name="kode_barang[]" id="kode_barang" value="{{old('kode_barang')}}"></td>
                <td><input type="text" placeholder="Masukkan Merk" class="form-control @error('merk') is-invalid @enderror" name="merk[]" id="merk" value="{{old('merk')}}"></td>
                <td><input type="text" placeholder="Masukkan Nama Barang" class="form-control @error('nama_barang') is-invalid @enderror" name="nama_barang[]" id="nama_barang" value="{{old('nama_barang')}}"></td>
                <td><input type="number" placeholder="Masukkan Jumlah" min="0" class="form-control @error('jumlah') is-invalid @enderror" name="jumlah[]" id="jumlah" value="{{old('jumlah')}}"></td>
                <td><textarea placeholder="Masukkan Lokasi" class="form-control @error('lokasi') is-invalid @enderror" name="lokasi[]" id="lokasi"></textarea></td>
                <td><input type="date" placeholder="Masukkan Tanggal Perolehan" class="form-control @error('tanggal_perolehan') is-invalid @enderror" name="tanggal_perolehan[]" id="tanggal_perolehan" value="{{old('tanggal_perolehan')}}"></td>
                <td><input type="number" placeholder="Masukkan Masa Manfaat" class="form-control @error('masa_manfaat') is-invalid @enderror" name="masa_manfaat[]" id="masa_manfaat" value="{{old('masa_manfaat')}}"></td>
                <td><input type="number" placeholder="Masukkan Kondisi" class="form-control @error('kondisi') is-invalid @enderror" name="kondisi[]" id="kondisi" value="{{old('kondisi')}}"></td>
                <td><input type="text" placeholder="Masukkan Harga Perolehan" class="form-control @error('harga_perolehan') is-invalid @enderror" name="harga_perolehan[]" id="harga_perolehan" value="{{old('harga_perolehan')}}"></td>
                <td><textarea placeholder="Masukkan Keterangan" class="form-control @error('keterangan') is-invalid @enderror" name="keterangan[]" id="keterangan"></textarea></td>
                <td><button type="button" class="btn btn-block btn-danger btn-sm circle-button karyawan-img-small" id="closetable"><i class="fas fa-times"></i></button></td>
                </tr>`)
            numberRows($("#tableitem"));
        });

        $('#tableitem').on('click', '#closetable', function(e) {
            $(this).closest('tr').remove();
            numberRows($("#tableitem"));
        });

        function numberRows($t) {
            var c = 0 - 1;
            $t.find("tr").each(function(ind, el) {
                $(el).find("td:eq(0)").html(++c);
                $(el).find($('input[name="tanggal_perolehan[]"]')).val(year + "-01-01");
            });
        }

        $('input[name="kode"]').on("keyup", function() {
            var kode = $(this).val();
            if (kode) {
                $.ajax({
                    url: '/inventory/kode_exist/' + kode,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        console.log(data);
                        if (data > 0) {
                            $('span[id="kode-message"]').addClass("invalid-feedback");
                            $('input[name="kode"]').addClass("is-invalid");
                            $('span[id="kode-message"]').html("Kode Produk Sudah Terpakai");
                        } else {
                            $('span[id="kode-message"]').removeClass("invalid-feedback");
                            $('input[name="kode"]').removeClass("is-invalid");
                            $('span[id="kode-message"]').empty();
                        }

                    }
                });
            } else {
                $('span[id="kode-message"]').removeClass("invalid-feedback");
                $('input[name="kode"]').removeClass("is-invalid");
                $('span[id="kode-message"]').empty();
            }
        });
    });
</script>
@endsection