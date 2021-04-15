@extends('adminlte.page')

@section('title', 'Beta Version')

@section('content_header')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Peminjaman Alat</h1>
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
@stop

@section('content')
<section class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="col-lg-12">
                <form id="create-inventory" method="POST" action="{{route('peminjaman.alat.store', ['user_id' => Auth::user()->id])}}">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                    @if(session()->has('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong><i class="fas fa-check"></i></strong> {{session()->get('success')}}
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
                            <div class="card-title"><i class="fas fa-plus-circle"></i>&nbsp;Tambah Peminjaman</div>
                        </div>
                        <div class="card-body">
                            <div class="col-lg-12">
                                <h4>Info Peminjaman</h4>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-horizontal">
                                            <div class="form-group row">
                                                <label for="divisi" class="col-sm-4 col-form-label" style="text-align:right;">Divisi</label>
                                                <div class="col-sm-8">
                                                    <label for="divisi" class="col-form-label">{{Auth::user()->divisi->nama}}</label>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="nama_user" class="col-sm-4 col-form-label" style="text-align:right;">Peminjam</label>
                                                <div class="col-sm-8">
                                                    <label for="nama_user" class="col-form-label">{{Auth::user()->nama}}</label>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="tanggal_pengajuan" class="col-sm-4 col-form-label" style="text-align:right;">Tanggal Pengajuan</label>
                                                <div class="col-sm-8">
                                                    <input type="date" class="form-control @error('tanggal_pengajuan') is-invalid @enderror" name="tanggal_pengajuan" id="tanggal_pengajuan" placeholder="Masukkan Tanggal Pengajuan" value="{{old('tanggal_pengajuan')}}" style="width:45%;">
                                                    <span id="tanggal_pengajuan-message" role="alert"></span>
                                                    @if ($errors->has('tanggal_pengajuan'))
                                                    <span class="invalid-feedback" role="alert">{{$errors->first('tanggal_pengajuan')}}</span>
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
                                                    <th>Divisi</th>
                                                    <th>Nama + Kode Barang</th>
                                                    <th>Jumlah</th>
                                                    <th>Keterangan</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>1</td>
                                                    <td><select class="select2 form-control divinvid" name="divisi_inventory_id[]" id="divisi_inventory_id" data-placeholder="Pilih Inventory Divisi" data-dropdown-css-class="select2-info" style="width: 80%;">
                                                            @foreach($d as $i)
                                                            <option value="{{$i->id}}">{{$i->divisi->nama}}</option>
                                                            @endforeach
                                                        </select></td>
                                                    <td><select class="select2 form-control invid" name="inventory_id[]" id="inventory_id" data-placeholder="Pilih Kode Barang" data-dropdown-css-class="select2-info" style="width: 80%;">
                                                        </select></td>
                                                    <td><input type="number" placeholder="Masukkan Jumlah" min="0" class="form-control @error('jumlah') is-invalid @enderror" name="jumlah[]" id="jumlah" value="{{old('jumlah')}}" readonly=true>
                                                        <span id="jumlah-msg[]"></span>
                                                    </td>
                                                    <td><textarea class="form-control" name="keteranganinv[]" id="keteranganinv" placeholder="Masukkan Keterangan"></textarea></td>
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

@section('adminlte_js')
<script>
    $(function() {
        $('#tanggal_pengajuan').val(today);
        $('.invid').select2({
            placeholder: 'Pilih Barang'
        });

        function numberRows($t) {
            var c = 0 - 1;
            $t.find("tr").each(function(ind, el) {
                $(el).find("td:eq(0)").html(++c);
                var j = c - 1;

                // $(el).find('select[id="inventory_id"]').attr('name', 'inventory_id[' + j + ']');
                $(el).find('select[id="divisi_inventory_id"]').attr('id', 'divisi_inventory_id' + j);
                $(el).find('select[id="inventory_id"]').attr('id', 'inventory_id' + j);
                $(el).find('.divinvid').select2();
                $(el).find('.invid').select2();
                $(el).find('input[id="jumlah"]').attr('name', 'jumlah[' + j + ']');
                $(el).find('textarea[id="keteranganinv"]').attr('name', 'keteranganinv[' + j + ']');
            });
        }

        function numberRows($t) {
            var c = 0 - 2;
            $t.find("tr").each(function(ind, el) {
                $(el).find("td:eq(0)").html(++c);
                var j = c - 1;
                $(el).find('input[id="tanggals"]').attr('name', 'tanggals[' + j + ']');
                $(el).find('select[id="karyawan_id"]').attr('name', 'karyawan_id[' + j + '][]');
                $(el).find('select[id="karyawan_id"]').attr('id', 'karyawan_id' + j);
                $(el).find('input[id="no_seri"]').attr('name', 'no_seri[' + j + ']');
                $(el).find('input[id="warna"]').attr('name', 'warna[' + j + ']');
                $('select[name="karyawan_id[' + j + '][]"]').select2();
            });
        }



        $('#tambahitem').click(function(e) {
            $('#tableitem tr:last').after(`<tr>
                <td></td>
                <td><select class="select2 form-control divinvid" name="divisi_inventory_id[]" id="divisi_inventory_id" data-placeholder="Pilih Inventory Divisi" data-dropdown-css-class="select2-info" style="width: 80%;">
                    @foreach($d as $i)
                    <option value="{{$i->id}}">{{$i->divisi->nama}}</option>
                    @endforeach
                </select></td>
                <td><select class="select2 form-control invid" name="inventory_id[]" id="inventory_id" data-placeholder="Pilih Kode Barang" data-dropdown-css-class="select2-info" style="width: 80%;">
                </select></td>
                <td><input type="number" placeholder="Masukkan Jumlah" min="0" class="form-control @error('jumlah') is-invalid @enderror" name="jumlah[]" id="jumlah" value="{{old('jumlah')}}" readonly=true>
                    <span id="jumlah-msg[]"></span>
                </td>
                <td><textarea class="form-control" name="keteranganinv[]" id="keteranganinv" placeholder="Masukkan Keterangan"></textarea></td>
                <td><button type="button" class="btn btn-block btn-danger btn-sm circle-button karyawan-img-small" id="closetable"><i class="fas fa-times"></i></button></td>
            </tr>`);
            numberRows($("#tableitem"));
        });

        $('#tableitem').on('click', '#closetable', function(e) {
            $(this).closest('tr').remove();
            numberRows($("#tableitem"));
        });

        $('#tableitem').on('change', '.divinvid', function(e) {
            var id = $(this).closest('tr').find('.divinvid').val();
            var invid = $(this).closest('tr').find('.invid');
            var jumlah = $(this).closest('tr').find('input[id="jumlah"]');
            if (id) {
                $.ajax({
                    url: 'get_inventory/' + id,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        console.log(data);
                        invid.empty();
                        $.each(data, function(key, value) {
                            invid.append('<option value="' + value['id'] + '">' + value['kode_barang'] + ' - ' + value['nama_barang'] + '</option>');
                        });
                    }
                });
            } else {
                invid.empty();
            }
        });


        $('#tableitem').on('change', '.invid', function(e) {
            var id = $(this).closest('tr').find('.invid').val();
            var jumlah = $(this).closest('tr').find('input[id="jumlah"]');
            if (id) {
                $.ajax({
                    url: 'get_inventory_detail/' + id,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        jumlah.attr("readonly", false);
                        jumlah.val(data['jumlah_tersedia']);
                    }
                });
            } else {
                jumlah.val("");
            }
        });

        $('#tableitem').on('keyup change', 'input[id="jumlah"]', function(e) {
            var id = $(this).closest('tr').find('.invid').val();
            var jumlah = $(this).closest('tr').find('input[id="jumlah"]');
            var jumlahmsg = $(this).closest('tr').find('span[id="jumlah-msg[]"]');
            if (id) {
                $.ajax({
                    url: 'get_inventory_detail/' + id,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        if (data['jumlah_tersedia'] < jumlah.val()) {
                            jumlahmsg.addClass("invalid-feedback");
                            jumlah.addClass("is-invalid");
                            jumlahmsg.html("Jumlah tidak tersedia");
                        } else {
                            jumlahmsg.removeClass("invalid-feedback");
                            jumlah.removeClass("is-invalid");
                            jumlahmsg.html("");
                        }
                    }
                });
            } else {
                jumlahmsg.removeClass("invalid-feedback");
                jumlah.removeClass("is-invalid");
                jumlahmsg.html("");
            }
        });
    });
</script>
@endsection