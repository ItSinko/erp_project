@extends('adminlte.page')
@section('title', 'Beta Version')
@section('content_header')
@stop
@section('adminlte_css')
<style>
    .tes {
        width: 1000px;
        margin: 0 auto;
    }
</style>
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
                {{session()->get('success')}}
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
        <form action="/kesehatan_bulanan_berat/aksi_tambah" method="post">
            {{ csrf_field() }}
            <div class="card  ">
                <div class="card-header bg-success">
                    <div class="card-title"><i class="fas fa-plus-circle"></i>&nbsp;Pengukuran Berat Badan</div>
                </div>
                <div class="card-body">
                    <table id="tabel_berat" class="table table-hover styled-table table-striped tes " width="100%">
                        <thead style="text-align: center;">
                            <tr>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th colspan="7">Komposisi Tubuh</th>
                                <th></th>
                            </tr>
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th width="20%">Nama</th>
                                <th>Tinggi</th>
                                <th>Berat</th>
                                <th>Lemak</th>
                                <th>Kandungan air</th>
                                <th>Otot</th>
                                <th>Tulang</th>
                                <th>Kalori</th>
                                <th>Catatan</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody style="text-align: center;">
                            <tr>
                                <td>1</td>
                                <td><input type="date" class="form-control" readonly><input type="text" class="form-control d-none" name="kesehatan_awal_id[]"></td>
                                <td><select class="form-control select2">
                                        <option></option>
                                    </select>
                                </td>
                                <td>
                                    <div class=" input-group mb-3">
                                        <input type="text" class="form-control" name="tinggi[]" readonly id="tinggi">
                                        <div class="input-group-append">
                                            <span class="input-group-text">Cm</span>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" name="berat[]" id="berat">
                                        <div class="input-group-append">
                                            <span class="input-group-text">Kg</span>
                                        </div>
                                    </div>
                                    <small id="status_bmi" class="form-text text-muted"></small>
                                </td>
                                <td>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" name="lemak[]">
                                        <div class="input-group-append">
                                            <span class="input-group-text">gram</span>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" name="kandungan_air[]">
                                        <div class="input-group-append">
                                            <span class="input-group-text">%</span>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" name="otot[]">
                                        <div class="input-group-append">
                                            <span class="input-group-text">Kg</span>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" name="tulang[]">
                                        <div class="input-group-append">
                                            <span class="input-group-text">Kg</span>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" name="kalori[]">
                                        <div class="input-group-append">
                                            <span class="input-group-text">kkal</span>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="input-group mb-3">
                                        <textarea type="text" class="form-control" name="keterangan[]"></textarea>
                                </td>
                                <td>
                                    <button name="add" type="button" id="tambahitem" class="btn btn-success"><i class="nav-icon fas fa-plus-circle"></i></button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    <span class="float-left"><a class="btn btn-danger rounded-pill" href="/kesehatan_mingguan"><i class="fas fa-times"></i>&nbsp;Batal</a></span>
                    <span class="float-right"><button class="btn btn-success rounded-pill" id="button_tambah"><i class="fas fa-plus"></i>&nbsp;Tambah Data</button></span>
                </div>
            </div>
        </form>
    </div>
</section>
@endsection
@section('adminlte_js')
<script>
    $(document).ready(function() {
        $('#tabel_berat').DataTable({
            "scrollX": true
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
                                                          
                                                        </select>
                                                    </td>
                                                    <td><input id="dates" type="date" class="form-control" name="date[]"></td>
                                                    <td>
                                                    <select type="text" class="form-control @error('karyawan_id') is-invalid @enderror karyawan_id select2 select-info" name="karyawan_id[]" style="width:100%;" id="karyawan_id[]">
                                                            <option value=""></option>
                                                           
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
                                                        <input type="file" class="form-control file" name="file[]">
                                                    </td>
                                                    <td>
                                                    <button type="button" class="btn btn-danger karyawan-img-small" style="border-radius:50%;" id="closetable"><i class="fas fa-times-circle"></i></button> 
                                                    </td>
                                                </tr>`;
            $('#tabel_berat tr:last').after(data);
            numberRows($("#tabel_berat"));
        });
        $('#tabel_berat').on('click', '#closetable', function(e) {
            $(this).closest('tr').remove();
            numberRows($("#tabel_berat"));
        });

    })
</script>
@endsection