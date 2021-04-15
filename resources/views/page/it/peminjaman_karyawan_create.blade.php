@extends('adminlte.page')

@section('title', 'Beta Version')

@section('content_header')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Penugasan Karyawan</h1>
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
        <div class="col-lg-12">
            <div class="col-lg-12">
                <form id="create-peminjaman-karyawan" method="POST" action="{{route('peminjaman.karyawan.store')}}">
                    {{ csrf_field() }}
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
                            <div class="card-title"><i class="fas fa-plus-circle"></i>&nbsp;Tambah Penugasan</div>
                        </div>
                        <div class="card-body">
                            <div class="col-lg-12">
                                <h4>Info Penugasan</h4>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-horizontal">
                                            <div class="form-group row">
                                                <label for="penanggung_jawab_id" class="col-sm-4 col-form-label" style="text-align:right;">Penanggung Jawab</label>
                                                <div class="col-sm-8">
                                                    <select class="select2 form-control penanggung_jawab_id" name="penanggung_jawab_id" id="penanggung_jawab_id" data-placeholder="Pilih Penanggung Jawab" data-dropdown-css-class="select2-info" style="width: 80%;">
                                                        @foreach($p as $i)
                                                        <option value="{{$i->id}}">{{$i->nama}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="nama_user" class="col-sm-4 col-form-label" style="text-align:right;">Nama Penugasan</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control @error('nama_penugasan') is-invalid @enderror" name="nama_penugasan" id="nama_penugasan" placeholder="Masukkan Nama Pekerjaan" value="{{old('nama_penugasan')}}" style="width:80%;">
                                                    <span id="nama_penugasan-message" role="alert"></span>
                                                    @if ($errors->has('nama_penugasan'))
                                                    <span class="invalid-feedback" role="alert">{{$errors->first('nama_penugasan')}}</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="lokasi_penugasan" class="col-sm-4 col-form-label" style="text-align:right;">Lokasi Penugasan</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control @error('lokasi_penugasan') is-invalid @enderror" name="lokasi_penugasan" id="lokasi_penugasan" placeholder="Masukkan Lokasi Penugasan" value="{{old('lokasi_penugasan')}}">
                                                    <span id="lokasi_penugasan-message" role="alert"></span>
                                                    @if ($errors->has('lokasi_penugasan'))
                                                    <span class="invalid-feedback" role="alert">{{$errors->first('lokasi_penugasan')}}</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="lokasi_penugasan" class="col-sm-4 col-form-label" style="text-align:right;">Keterangan</label>
                                                <div class="col-sm-8">
                                                    <textarea class="form-control @error('keterangan') is-invalid @enderror" name="keterangan" id="keterangan">{{old('keterangan')}}</textarea>
                                                    <span id="keterangan-message" role="alert"></span>
                                                    @if ($errors->has('keterangan'))
                                                    <span class="invalid-feedback" role="alert">{{$errors->first('keterangan')}}</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <h4>Waktu Penugasan</h4>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-horizontal">
                                            <div class="form-group row">
                                                <label for="tanggal_penugasan" class="col-sm-4 col-form-label" style="text-align:right;">Mulai Penugasan</label>
                                                <div class="col-sm-8">
                                                    <input type="date" class="form-control @error('tanggal_penugasan') is-invalid @enderror" name="tanggal_penugasan" id="tanggal_penugasan" placeholder="Masukkan Tanggal Penugasan" value="{{old('tanggal_penugasan')}}" style="width:80%;">
                                                    <span id="tanggal_penugasan-message" role="alert"></span>
                                                    @if ($errors->has('tanggal_penugasan'))
                                                    <span class="invalid-feedback" role="alert">{{$errors->first('tanggal_penugasan')}}</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="tanggal_estimasi_selesai" class="col-sm-4 col-form-label" style="text-align:right;">Estimasi Selesai</label>
                                                <div class="col-sm-8">
                                                    <input type="date" class="form-control @error('tanggal_estimasi_selesai') is-invalid @enderror" name="tanggal_estimasi_selesai" id="tanggal_estimasi_selesai" placeholder="Masukkan Tanggal Estimasi Selesai" value="{{old('tanggal_estimasi_selesai')}}" style="width:80%;">
                                                    <span id="tanggal_estimasi_selesai-message" role="alert"></span>
                                                    @if ($errors->has('tanggal_estimasi_selesai'))
                                                    <span class="invalid-feedback" role="alert">{{$errors->first('tanggal_estimasi_selesai')}}</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <h4></h4>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <table width="100%" class="table table-bordered" id="tableitem" style="text-align:center;">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Nama Karyawan</th>
                                                    <th>Rincian Pekerjaan</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>1</td>
                                                    <td><select class="select2 form-control karyawan_id" name="karyawan_id[]" id="karyawan_id" data-placeholder="Pilih Inventory Divisi" data-dropdown-css-class="select2-info" style="width: 80%;">
                                                            @foreach($p as $i)
                                                            <option value="{{$i->id}}">{{$i->nama}}</option>
                                                            @endforeach
                                                        </select></td>
                                                    <td><textarea class="form-control" name="keterangan_detail[]" id="keterangan_detail" placeholder="Masukkan Rincian Pekerjaan"></textarea></td>
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

        function numberRows($t) {
            var c = 0 - 1;
            $t.find("tr").each(function(ind, el) {
                $(el).find("td:eq(0)").html(++c);
                var j = c - 1;
                // $(el).find('select[id="inventory_id"]').attr('name', 'inventory_id[' + j + ']');
                $(el).find('select[id="karyawan_id"]').attr('id', 'karyawan_id' + j);
                $(el).find('.karyawan_id').select2();
            });
        }

        $('#tambahitem').click(function(e) {
            $('#tableitem tr:last').after(`<tr>
                                                    <td></td>
                                                    <td><select class="select2 form-control karyawan_id" name="karyawan_id[]" id="karyawan_id" data-placeholder="Pilih Inventory Divisi" data-dropdown-css-class="select2-info" style="width: 80%;">
                                                            @foreach($p as $i)
                                                            <option value="{{$i->id}}">{{$i->nama}}</option>
                                                            @endforeach
                                                        </select></td>
                                                    <td><textarea class="form-control" name="keterangan_detail[]" id="keterangan_detail" placeholder="Masukkan Keterangan"></textarea></td>
                                                    <td><button type="button" class="btn btn-block btn-danger btn-sm circle-button karyawan-img-small" id="closetable"><i class="fas fa-times"></i></button></td>
                                                </tr>`);
            numberRows($("#tableitem"));
        });

        $('#tableitem').on('click', '#closetable', function(e) {
            $(this).closest('tr').remove();
            numberRows($("#tableitem"));
            console.log("not trigger");
        });
    });
</script>
@stop