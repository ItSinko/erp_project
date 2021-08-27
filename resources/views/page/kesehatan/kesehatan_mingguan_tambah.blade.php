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
                                        <table id="tabel_rapid" class="table table-hover styled-table table-striped">
                                            <thead style="text-align: center;">
                                                <tr>
                                                    <th>No</th>
                                                    <th>Jenis Tes</th>
                                                    <th>Pemeriksa</th>
                                                    <th>Tanggal</th>
                                                    <th>Nama</th>
                                                    <th>Hasil</th>
                                                    <th>Catatan</th>
                                                    <th>File</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody style="text-align: center;">
                                                <tr>
                                                    <td>
                                                        1
                                                    </td>
                                                    <td>
                                                        <input type="number" class="form-control d-none" name="karyawan_id" value="` + value[`id`] + `">
                                                        <select type="text" class="form-control @error('jenis_tes') is-invalid @enderror jenis_tes select2 select2-info" name="jenis_tes[]" style="width:100%;" id="jenis_tes[]">
                                                            <option value="">Pilih Produk</option>
                                                            <option value="Rapid">Rapid</option>
                                                            <option value="Antigen">Antigen</option>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <select type="text" class="form-control @error('pemeriksa_id') is-invalid @enderror pemeriksa_id select2 select2-info" name="pemeriksa_id[]" style="width:100%;" id="pemeriksa_id[]">
                                                            <option value=""></option>
                                                            @foreach ($pengecek as $p)
                                                            <option value="{{$p->id}}">{{$p->nama}}</option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td><input id="dates" type="date" class="form-control"></td>
                                                    <td>
                                                        <select type="text" class="form-control @error('karyawan_id') is-invalid @enderror  karyawan_id select2 select2-info" name="karyawan_id[]" style="width:100%;" id="karyawan_id[]">
                                                            <option value=""></option>
                                                            @foreach ($karyawan as $k)
                                                            <option value="{{$k->id}}">{{$k->nama}}</option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <div id="rapids" class="row" hidden>
                                                            <div class="icheck-success d-inline col-sm-6">
                                                                <input type="radio" name="hasil_covid[]" value="Non reaktif" id="hasil_cov">
                                                                <label for="no">
                                                                    Non reaktif
                                                                </label>
                                                            </div>
                                                            <div class="icheck-success d-inline col-sm-6">
                                                                <input type="radio" name="hasil_covid[]" value="IgG" id="hasil_cov">
                                                                <label for="no">
                                                                    IgG
                                                                </label>
                                                            </div>
                                                            <div class="icheck-warning d-inline col-sm-6">
                                                                <input type="radio" name="hasil_covid[]" value="IgM" id="hasil_cov">
                                                                <label for="sample">
                                                                    IgM
                                                                </label>
                                                            </div>
                                                            <div class="icheck-warning d-inline col-sm-6">
                                                                <input type="radio" name="hasil_covid[]" value="IgG-IgM" id="hasil_cov">
                                                                <label for="sample">
                                                                    IgG-IgM
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div id="antigens" class="row" hidden>
                                                            <div class="icheck-success d-inline col-sm-12">
                                                                <input type="radio" name="hasil_covid[]" value="C" id="hasil_cov">
                                                                <label for="no">
                                                                    C
                                                                </label>
                                                            </div>
                                                            <div class="icheck-warning d-inline col-sm-12">
                                                                <input type="radio" name="hasil_covid[]" value="C/T" id="hasil_cov">
                                                                <label for="sample">
                                                                    C/T
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <textarea type="text" class="form-control keterangan" name="keterangan[]"></textarea>
                                                    </td>
                                                    <td>
                                                        <input type="file" class="form-control" name="file[]">
                                                    </td>
                                                    <td>
                                                        <button name="add" type="button" id="tambahitem" class="btn btn-success"><i class="nav-icon fas fa-plus-circle"></i></button>
                                                    </td>
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
    $(function() {
        function numberRows($t) {
            var c = 0 - 1;
            $t.find("tr").each(function(ind, el) {
                $(el).find("td:eq(0)").html(++c);
                var j = c - 1;
                $(el).find('.jenis_tes').attr('name', 'jenis_tes[' + j + ']');
                $(el).find('.jenis_tes').attr('id', 'jenis_tes[' + j + ']');
                $(el).find('.pemeriksa_id').attr('name', 'pemeriksa_id[' + j + ']');
                $(el).find('.pemeriksa_id').attr('id', 'pemeriksa_id[' + j + ']');
                $(el).find('.karyawan_id').attr('name', 'karyawan_id[' + j + ']');
                $(el).find('.karyawan_id').attr('id', 'karyawan_id[' + j + ']');
                $(el).find('#hasil_cov').attr('name', 'hasil_covid[' + j + ']');
                $(el).find('.keterangan').attr('name', 'keterangan[' + j + ']');
                $('.pemeriksa_id').select2();
                $('.jenis_tes').select2();
                $('.karyawan_id').select2();
            });
        }


        $('#tabel_rapid').on("change", ".jenis_tes", function() {
            var x = $(this).closest('tr').find('select[id="jenis_tes"]').val();
            console.log(x);

        });

        $('#tambahitem').click(function(e) {
            var data = `  <tr>
                                                    <td>
                                                        1
                                                    </td>
                                                    <td>
                                                        <select type="text" class="form-control @error('jenis_tes') is-invalid @enderror jenis_tes select2 select-info" name="jenis_tes[]" style="width:100%;" id="jenis_tes[]">
                                                            <option value="">Pilih Produk</option>
                                                            <option value="Rapid">Rapid</option>
                                                            <option value="Antigen">Antigen</option>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <select type="text" class="form-control @error('pemeriksa_id') is-invalid @enderror pemeriksa_id select2 select-info" name="pemeriksa_id[]" style="width:100%;" id="pemeriksa_id[]">
                                                            <option value=""></option>
                                                            @foreach ($pengecek as $p)
                                                            <option value="{{$p->id}}">{{$p->nama}}</option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td><input id="dates" type="date" class="form-control" ></td>
                                                    <td>
                                                    <select type="text" class="form-control @error('karyawan_id') is-invalid @enderror karyawan_id select2 select-info" name="karyawan_id[]" style="width:100%;" id="karyawan_id[]">
                                                            <option value=""></option>
                                                            @foreach ($karyawan as $k)
                                                            <option value="{{$k->id}}">{{$k->nama}}</option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <div id="rapids" class="row" hidden>
                                                            <div class="icheck-success d-inline col-sm-6">
                                                                <input type="radio" name="hasil_covid[]" value="Non reaktif" id="hasil_cov">
                                                                <label for="no">
                                                                    Non reaktif
                                                                </label>
                                                            </div>
                                                            <div class="icheck-success d-inline col-sm-6">
                                                                <input type="radio" name="hasil_covid[]" value="IgG" id="hasil_cov">
                                                                <label for="no">
                                                                    IgG
                                                                </label>
                                                            </div>
                                                            <div class="icheck-warning d-inline col-sm-6">
                                                                <input type="radio" name="hasil_covid[]" value="IgM" id="hasil_cov">
                                                                <label for="sample">
                                                                    IgM
                                                                </label>
                                                            </div>
                                                            <div class="icheck-warning d-inline col-sm-6">
                                                                <input type="radio" name="hasil_covid[]" value="IgG-IgM" id="hasil_cov">
                                                                <label for="sample">
                                                                    IgG-IgM
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div id="antigens" class="row" hidden>
                                                            <div class="icheck-success d-inline col-sm-12">
                                                                <input type="radio" name="hasil_covid[]" value="C" id="hasil_cov">
                                                                <label for="no">
                                                                    C
                                                                </label>
                                                            </div>
                                                            <div class="icheck-warning d-inline col-sm-12">
                                                                <input type="radio" name="hasil_covid[]" value="C/T" id="hasil_cov">
                                                                <label for="sample">
                                                                    C/T
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <textarea type="text" class="form-control keterangan" name="keterangan[]"></textarea>
                                                    </td>
                                                    <td>
                                                        <input type="file" class="form-control file" name="file[]">
                                                    </td>
                                                    <td>
                                                    <button type="button" class="btn btn-danger karyawan-img-small" style="border-radius:50%;" id="closetable"><i class="fas fa-times-circle"></i></button> 
                                                    </td>
                                                </tr>`;
            $('#tabel_rapid tr:last').after(data);
            numberRows($("#tabel_rapid"));

        });







        $('#tabel_rapid').on('click', '#closetable', function(e) {
            $(this).closest('tr').remove();
            numberRows($("#tabel_rapid"));
        });
    })
</script>
<!-- <script>
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
</script> -->
<!-- <script>
    $(document).ready(function() {
        function numberRows($t) {
            var c = 0 - 1;
            $t.find("tr").each(function(ind, el) {
                $(el).find("td:eq(0)").html(++c);
                var j = c - 1;
                $(el).find('input[id="no_barcode"]').attr('name', 'no_barcode[' + j + ']');
                $('.tindak_lanjut').select2();
                $('.no_seri').select2();
                $('.pemeriksaan').select2();
            });
        }

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


                            $.each(data, function(key, value) {

                                $('#tabel_rapid').append(`<tr> <td><div class="form-check">
                                                                    <input class="form-check-input hapus" type="checkbox"  id="hapus">
                                                                    <label class="form-check-label" for="flexCheckDefault"></label>
                                                                    </div>
                                                                    </td>
                                                     <td>   
                                                     <input type="number" class="form-control d-none" name="karyawan_id" value="` + value[`id`] + `"> 
                                                     <select type="text" class="form-control @error('jenis_tes') is-invalid @enderror" name="jenis_tes" style="width:100%;" id="jenis_tes">
                                                         <option value="">Pilih Produk</option>
                                                         <option value="Rapid">Rapid</option>
                                                         <option value="Antigen">Antigen</option>
                                                         </select>
                                                        </td>
                                                         <td>
                                                             <select type="text" class="form-control @error('pemeriksa_id') is-invalid @enderror" name="pemeriksa_id" style="width:100%;" id="pemeriksa">
                                                         <option value=""></option>
                                                         @foreach ($pengecek as $p)
                                                        <option value="{{$p->id}}">{{$p->nama}}</option>
                                                        @endforeach
                                                         </select>
                                                         </td>
                                                        <td><input id="dates" type="date" class="form-control" readonly></td>      
                                                         <td>` + value[`nama`] + `</td>
                                                         <td>         
                                                        <div id ="rapids" class="row" hidden>
                                                        <div class="icheck-success d-inline col-sm-6">
                                                            <input type="radio" name="hasil_covid" value="Non reaktif" id="hasil_cov">
                                                            <label for="no">
                                                                Non reaktif
                                                            </label>
                                                        </div>
                                                        <div class="icheck-success d-inline col-sm-6">
                                                            <input type="radio" name="hasil_covid" value="IgG" id="hasil_cov">
                                                            <label for="no">
                                                                IgG
                                                            </label>
                                                        </div>
                                                        <div class="icheck-warning d-inline col-sm-6">
                                                            <input type="radio" name="hasil_covid" value="IgM" id="hasil_cov" >
                                                            <label for="sample">
                                                                IgM
                                                            </label>
                                                        </div>
                                                        <div class="icheck-warning d-inline col-sm-6">
                                                            <input type="radio" name="hasil_covid" value="IgG-IgM"  id="hasil_cov" >
                                                            <label for="sample">
                                                            IgG-IgM
                                                            </label>
                                                        </div>
                                                           </div>
                                                        <div id ="antigens" class="row" hidden>
                                                        <div class="icheck-success d-inline col-sm-12">
                                                            <input type="radio" name="hasil_covid" value="C"  id="hasil_cov">
                                                            <label for="no">
                                                                C
                                                            </label>
                                                        </div>
                                                        <div class="icheck-warning d-inline col-sm-12">
                                                            <input type="radio" name="hasil_covid" value="C/T"  id="hasil_cov">
                                                            <label for="sample">
                                                                C/T
                                                            </label>
                                                        </div>
                                                       </div>
                                                        </td>
                                                        <td>    
                                                         <textarea type="text" class="form-control" name="keterangan"  ></textarea>
                                                        </td>
                                                        <td>    
                                                         <input type="file" class="form-control" name="file"  >
                                                        </td>
                                                        </tr>`);

                                x++;
                                var n = no;
                                console.log(n);
                                $('#button_hapus').click(function() {
                                    $(".hapus:checked").closest('tr').remove();
                                });
                                $('#jenis_tes' + no + '').on('change', function() {
                                    var tes = jQuery(this).val();
                                    if (tes == "Antigen") {
                                        $('#antigens' + n + '').removeAttr('hidden');
                                        $('#rapids' + n + '').attr('hidden', 'hidden');
                                        $('#hasil_cov' + n + '').prop("required", true);
                                    } else if (tes == "Rapid") {
                                        $('#rapids' + n + '').removeAttr('hidden');
                                        $('#antigens' + n + '').attr('hidden', 'hidden');
                                        $('#hasil_cov' + n + '').prop("required", true);
                                    }
                                    console.log(tes)
                                });
                                $('#pemeriksa' + no + '').select2({
                                    placeholder: "Pilih Data",
                                    allowClear: true,
                                    theme: 'bootstrap4',
                                })
                                $('#jenis_tes' + no + '').select2({
                                    placeholder: "Pilih Data",
                                    allowClear: true,
                                    theme: 'bootstrap4',
                                })
                                $('input[name=tgl_cek]').val('');
                                $('#tgls').change(function() {
                                    $('#dates' + value['id'] + '').val($(this).val());
                                });
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
</script> -->

@endsection