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
        </div>
        <div class="col-lg-12" id="rapid">
            <div class="col-lg-12">
                <form action="/kesehatan_mingguan_rapid/aksi_tambah" method="post" enctype="multipart/form-data" id="form">
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
                                                    <!-- <th>File</th> -->
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody style="text-align: center;">
                                                <tr>
                                                    <td>
                                                        1
                                                    </td>
                                                    <td>
                                                        <select type="text" class="form-control @error('jenis_tes') is-invalid @enderror jenis_tes select2 select2-info" name="jenis_tes[]" style="width:100%;" id="0">
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
                                                    <td><input id="dates" type="date" class="form-control date" name="date[]"></td>
                                                    <td>
                                                        <select type="text" class="form-control @error('karyawan_id') is-invalid @enderror  karyawan_id select2 select2-info" name="karyawan_id[]" style="width:100%;" id="karyawan_id[]">
                                                            <option value=""></option>
                                                            @foreach ($karyawan as $k)
                                                            <option value="{{$k->id}}">{{$k->nama}}</option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <div id="rapids0" class="row rapids" hidden>
                                                            <div class="icheck-success d-inline col-sm-6">
                                                                <input type="radio" name="hasil_covid[]" value="Non reaktif">
                                                                <label for="no">
                                                                    Non reaktif
                                                                </label>
                                                            </div>
                                                            <div class="icheck-success d-inline col-sm-6">
                                                                <input type="radio" name="hasil_covid[]" value="IgG">
                                                                <label for="no">
                                                                    IgG
                                                                </label>
                                                            </div>
                                                            <div class="icheck-warning d-inline col-sm-6">
                                                                <input type="radio" name="hasil_covid[]" value="IgM">
                                                                <label for="sample">
                                                                    IgM
                                                                </label>
                                                            </div>
                                                            <div class="icheck-warning d-inline col-sm-6">
                                                                <input type="radio" name="hasil_covid[]" value="IgG-IgM">
                                                                <label for="sample">
                                                                    IgG-IgM
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div id="antigens0" class="row antigens" hidden>
                                                            <div class="icheck-success d-inline col-sm-12">
                                                                <input type="radio" name="hasil_covid[]" value="C">
                                                                <label for="no">
                                                                    C
                                                                </label>
                                                            </div>
                                                            <div class="icheck-warning d-inline col-sm-12">
                                                                <input type="radio" name="hasil_covid[]" value="C/T">
                                                                <label for="sample">
                                                                    C/T
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <textarea type="text" class="form-control keterangan" name="keterangan[]"></textarea>
                                                    </td>
                                                    <!-- <td>
                                                        <input type="file" class="form-control file" name="file[]">
                                                    </td> -->
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
    $(document).ready(function() {
        $('#form').validate({
            rules: {
                "jenis_tes[]": "required"
            },
            messages: {
                "jenis_tes[]": "Please Insert"
            }
        });
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
                $(el).find('.jenis_tes').attr('id', '' + j + '');
                $(el).find('.pemeriksa_id').attr('name', 'pemeriksa_id[' + j + ']');
                $(el).find('.karyawan_id').attr('name', 'karyawan_id[' + j + ']');
                $(el).find('.karyawan_id').attr('id', 'karyawan_id[' + j + ']');
                $(el).find('.date').attr('name', 'date[' + j + ']');
                $(el).find('input[type="radio"]').attr('name', 'hasil_covid[' + j + ']');
                $(el).find('.keterangan').attr('name', 'keterangan[' + j + ']');
                $(el).find('.file').attr('name', 'file[' + j + ']');

                $(el).find('.antigens').attr('id', 'antigens' + j + '');
                $(el).find('.rapids').attr('id', 'rapids' + j + '');
                $(el).find('.pemeriksa_id').attr('id', 'pemeriksa_id[' + j + ']');

                $('.pemeriksa_id').select2();
                $('.jenis_tes').select2();
                $('.karyawan_id').select2();
            });
        }

        $('#tabel_rapid').on("change", ".jenis_tes", function() {
            var x = $(this).closest('tr').find('.jenis_tes').val();
            var y = this.id;

            if (x == "Antigen") {
                $('#antigens' + y + '').removeAttr('hidden');
                $('#rapids' + y + '').attr('hidden', 'hidden');
            } else if (x == "Rapid") {
                $('#rapids' + y + '').removeAttr('hidden');
                $('#antigens' + y + '').attr('hidden', 'hidden');
            }
            console.log(y);
        });

        $('#tambahitem').click(function(e) {
            var data = `  <tr>
                                                    <td>
                                                        1
                                                    </td>
                                                    <td>
                                                        <select type="text" class="form-control @error('jenis_tes') is-invalid @enderror jenis_tes select2 select-info" name="jenis_tes[]" style="width:100%;" id="0">
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
                                                    <td><input id="dates" type="date" class="form-control" name="date[]"></td>
                                                    <td>
                                                    <select type="text" class="form-control @error('karyawan_id') is-invalid @enderror karyawan_id select2 select-info" name="karyawan_id[]" style="width:100%;" id="karyawan_id[]">
                                                            <option value=""></option>
                                                            @foreach ($karyawan as $k)
                                                            <option value="{{$k->id}}">{{$k->nama}}</option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <div id="rapids" class="row rapids" hidden>
                                                            <div class="icheck-success d-inline col-sm-6">
                                                                <input type="radio" name="hasil_covid[]" value="Non reaktif" >
                                                                <label for="no">
                                                                    Non reaktif
                                                                </label>
                                                            </div>
                                                            <div class="icheck-success d-inline col-sm-6">
                                                                <input type="radio" name="hasil_covid[]" value="IgG" >
                                                                <label for="no">
                                                                    IgG
                                                                </label>
                                                            </div>
                                                            <div class="icheck-warning d-inline col-sm-6">
                                                                <input type="radio" name="hasil_covid[]" value="IgM" >
                                                                <label for="sample">
                                                                    IgM
                                                                </label>
                                                            </div>
                                                            <div class="icheck-warning d-inline col-sm-6">
                                                                <input type="radio" name="hasil_covid[]" value="IgG-IgM" >
                                                                <label for="sample">
                                                                    IgG-IgM
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div id="antigens" class="row antigens" hidden>
                                                            <div class="icheck-success d-inline col-sm-12">
                                                                <input type="radio" name="hasil_covid[]" value="C" >
                                                                <label for="no">
                                                                    C
                                                                </label>
                                                            </div>
                                                            <div class="icheck-warning d-inline col-sm-12">
                                                                <input type="radio" name="hasil_covid[]" value="C/T" >
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
@endsection