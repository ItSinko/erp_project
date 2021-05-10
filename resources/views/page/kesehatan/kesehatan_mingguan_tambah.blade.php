@extends('adminlte.page')
@section('title', 'Beta Version')
@section('content_header')
@stop
@section('content')
<section class="content-header">
    <div class="container-fluid">
    </div>
</section>


<section class="content">
    <div class="row">


        <div class="col-lg-12">
            @if(session()->has('success'))
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                Data berhasil ditambahkan
            </div>
            @elseif(session()->has('error') || count($errors) > 0)
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                Data gagal ditambahkan
            </div>
            @endif

            <div class="col-lg-12">
                <form action="/kesehatan_harian/aksi_tambah" method="post">
                    {{ csrf_field() }}
                    <div class="card">
                        <div class="card-header bg-success">
                            <div class="card-title"><i class="fas fa-plus-circle"></i>&nbsp;Tambah</div>
                        </div>
                        <div class="card-body">
                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-horizontal">
                                            <div class="form-group row">
                                                <label for="no_pemeriksaan" class="col-sm-4 col-form-label" style="text-align:right;">Pilih Form</label>
                                                <div class="col-sm-8">
                                                    <select type="text" class="form-control @error('form') is-invalid @enderror select2" name="form" style="width:45%;" id="form">
                                                        <option value="0">Pilih Data</option>
                                                        <option value="tensi">Pengukuran Tensi</option>
                                                        <option value="rapid">Pemeriksaan Covid</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
        </div>
        <div class="col-lg-12" id="tensi" style="display:none">
            <div class="col-lg-12">
                <form action="/kesehatan_mingguan_tensi/aksi_tambah" method="post">
                    {{ csrf_field() }}
                    <div class="card">
                        <div class="card-header bg-success">
                            <div class="card-title"><i class="fas fa-plus-circle"></i>&nbsp;Pengukuran Tensi</div>
                        </div>
                        <div class="card-body">
                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-horizontal">
                                            <div class="form-group row">
                                                <label for="no_pemeriksaan" class="col-sm-4 col-form-label" style="text-align:right;">Divisi</label>
                                                <div class="col-sm-8">
                                                    <select type="text" class="form-control @error('divisi') is-invalid @enderror select2" name="divisi" style="width:45%;">
                                                        <option value=""></option>
                                                        @foreach ($divisi as $d)
                                                        <option value="{{$d->id}}">{{$d->nama}}</option>
                                                        @endforeach
                                                    </select>
                                                    @if($errors->has('divisi'))
                                                    <div class="text-danger">
                                                        {{ $errors->first('divisi')}}
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="no_pemeriksaan" class="col-sm-4 col-form-label" style="text-align:right;">Tanggal</label>
                                                <div class="col-sm-8">
                                                    <input type="date" class="form-control @error('tgl') is-invalid @enderror " name="tgl_cek" style="width:45%;" id="tgl">
                                                    @if($errors->has('tgl_cek'))
                                                    <div class="text-danger">
                                                        {{ $errors->first('tgl_cek')}}
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <table id="tabel_tensi" class="table table-hover styled-table table-striped">
                                            <thead style="text-align: center;">
                                                <tr>
                                                    <th></th>
                                                    <th></th>
                                                    <th></th>
                                                    <th colspan="2">Tekanan Darah</th>
                                                    <th></th>
                                                </tr>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Tanggal</th>
                                                    <th>Nama</th>
                                                    <th>Systol (mmHg)</th>
                                                    <th>Dyastol (mmHg)</th>
                                                    <th>Catatan</th>
                                                </tr>
                                            </thead>
                                            <tbody style="text-align: center;">
                                                <tr>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <span class="float-left"><a class="btn btn-danger rounded-pill" href="/kesehatan_mingguan"><i class="fas fa-times"></i>&nbsp;Batal</a></span>
                            <span class="float-right"><button class="btn btn-success rounded-pill" id="button_tambah"><i class="fas fa-plus"></i>&nbsp;Tambah Data</button></span>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-lg-12" id="rapid" style="display:none">
            <div class="col-lg-12">
                <form action="/kesehatan_mingguan_rapid/aksi_tambah" method="post">
                    {{ csrf_field() }}
                    <div class="card">
                        <div class="card-header bg-success">
                            <div class="card-title"><i class="fas fa-plus-circle"></i>&nbsp;Pemeriksaan Covid</div>
                        </div>
                        <div class="card-body">
                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-horizontal">
                                            <div class="form-group row">
                                                <label for="no_pemeriksaan" class="col-sm-4 col-form-label" style="text-align:right;">Divisi</label>
                                                <div class="col-sm-8">
                                                    <select type="text" class="form-control @error('divisi') is-invalid @enderror select2" name="divisi" style="width:45%;">
                                                        <option value=""></option>
                                                        @foreach ($divisi as $d)
                                                        <option value="{{$d->id}}">{{$d->nama}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="no_pemeriksaan" class="col-sm-4 col-form-label" style="text-align:right;">Tanggal</label>
                                                <div class="col-sm-8">
                                                    <input type="date" class="form-control @error('tgl') is-invalid @enderror " name="tgl_cek" style="width:45%;" id="tgls">
                                                    @if($errors->has('tgl_cek'))
                                                    <div class="text-danger">
                                                        {{ $errors->first('tgl_cek')}}
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <table id="tabel_rapid" class="table table-hover styled-table table-striped">
                                            <thead style="text-align: center;">
                                                <tr>
                                                    <th>No</th>
                                                    <th>Tanggal</th>
                                                    <th>Nama</th>
                                                    <th>Hasil</th>
                                                    <th>Catatan</th>
                                                </tr>
                                            </thead>
                                            <tbody style="text-align: center;">
                                                <tr>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <span class="float-left"><a class="btn btn-danger rounded-pill" href="/kesehatan_harian"><i class="fas fa-times"></i>&nbsp;Batal</a></span>
                            <span class="float-right"><button class="btn btn-success rounded-pill" id="button_tambah"><i class="fas fa-plus"></i>&nbsp;Tambah Data</button></span>
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
    $('#form').change(function() {
        var form = $(this).val();
        if (form == 'tensi') {
            $("#rapid").hide('1000');
            $("#detail_gagal").hide('1000');
            $("#tensi").show('1000');
        } else if (form == 'rapid') {
            $("#detail_gagal").hide('1000');
            $("#tensi").hide('1000');
            $("#rapid").show('1000');
        } else {
            $("#tensi").hide('1000');
            $("#detail_gagal").show('1000');
            $("#rapid").hide('1000');
        }
    });
</script>
<script>
    $(document).ready(function() {
        $('select[name="divisi"]').on('change', function() {
            var id = jQuery(this).val();
            console.log(id);
            if (id) {
                $.ajax({
                    url: '/kesehatan_harian/tambah/data/' + id,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        console.log(data);
                        console.log(data.length);
                        if (data.length > 0) {
                            jQuery('#tabel_tensi > tbody >tr').empty();
                            var x = 0;
                            var no = 0;
                            $.each(data, function(key, value) {
                                no++;
                                $('input[name=tgl]').val('');
                                $('#tgl').change(function() {
                                    $('#date' + value['id'] + '').val($(this).val());
                                });
                                $('#tabel_tensi').append(`<tr> <td>` + no + `</td>
                                <td><input id="date` + value[`id`] + `" type="date" class="form-control" readonly></td>
                                                         <td>` + value[`nama`] + `</td>
                                                         <td>    
                                                         <div class="input-group mb-3">
                                                         <input type="number" class="form-control d-none" name="karyawan_id[` + x + `]" value="` + value[`id`] + `">
                                                         <input type="text" class="form-control" name=" sistolik[` + x + `]" >
                                                         <div class="input-group-append">
                                                            <span class="input-group-text">mmHg</span>
                                                           </div>
                                                           </div>
                                                        </td>
                                                         <td>    
                                                         <div class="input-group mb-3">
                                                         <input type="text" class="form-control" name="diastolik[` + x + `]" >
                                                         <div class="input-group-append">
                                                            <span class="input-group-text">mmHg</span>
                                                           </div>
                                                           </div>
                                                        </td>
                                                        <td>    
                                                         <textarea type="text" class="form-control" name="keterangan[` + x + `]" ></textarea>
                                                        </td>
                                                        </tr>`);
                                x++;
                            });
                        } else {
                            jQuery('#tabel_tensi > tbody >tr').empty();
                            $('#tabel_tensi').append('<tr><td colspan="8">Data yang anda pilih tidak ada</td></tr>');
                        }
                    },
                });
            } else {
                alert('Harap memuat ulang');
            }
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('select[name="divisi"]').on('change', function() {
            var id = jQuery(this).val();
            console.log(id);
            if (id) {
                $.ajax({
                    url: '/kesehatan_harian/tambah/data/' + id,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        console.log(data.length);
                        if (data.length > 0) {
                            jQuery('#tabel_rapid > tbody >tr').empty();
                            var x = 0;
                            var no = 0;
                            $.each(data, function(key, value) {
                                no++;

                                $('input[name=tgl_cek]').val('');
                                $('#tgls').change(function() {
                                    $('#dates' + value['id'] + '').val($(this).val());
                                });
                                $('#tabel_rapid').append(`<tr> <td>` + no + `</td>
                                <td><input id="dates` + value[`id`] + `" type="date" class="form-control" readonly></td>
                                                         <td>` + value[`nama`] + `</td>
                                                         <td>    
                                                         <div class="icheck-success d-inline col-sm-4">
                                                         <input type="number" class="form-control d-none" name="karyawan_id[` + x + `]" value="` + value[`id`] + `">  
                                                        <input type="radio" name="hasil[` + x + `]" value="Non reaktif" checked>
                                                        <label for="no">
                                                            Non reaktif
                                                        </label>
                                                    </div>
                                                    <div class="icheck-warning d-inline col-sm-4">
                                                        <input type="radio" name="hasil[` + x + `]" value="IgG">
                                                        <label for="sample">
                                                            IgG
                                                        </label>
                                                    </div>
                                                    <div class="icheck-warning d-inline col-sm-4">
                                                        <input type="radio" name="hasil[` + x + `]" value="IgM">
                                                        <label for="sample">
                                                            IgM
                                                        </label>
                                                    </div>
                                                    <div class="icheck-warning d-inline col-sm-4">
                                                        <input type="radio" name="hasil[` + x + `]" value="IgG-IgM">
                                                        <label for="sample">
                                                        IgG-IgM
                                                        </label>
                                                    </div>
                                                        </td>
                                                        <td>    
                                                         <textarea type="text" class="form-control" name="keterangan[` + x + `]" ></textarea>
                                                        </td>
                                                        </tr>`);
                                x++;
                            });
                        } else {
                            jQuery('#tabel_rapid > tbody >tr').empty();
                            $('#tabel_rapid').append('<tr><td colspan="8">Data yang anda pilih tidak ada</td></tr>');
                        }
                    },
                });
            } else {
                alert('Harap memuat ulang');
            }
        });
    });
</script>
@endsection