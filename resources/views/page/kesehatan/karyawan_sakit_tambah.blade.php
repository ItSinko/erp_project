@extends('adminlte.page')
@section('title', 'Beta Version')
@section('content_header')
<h1 class="m-0 text-dark">Dashboard</h1>
@stop
@section('adminltecss')
<style>
    #obat td.bottom {
        vertical-align: bottom;
    }
</style>

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
            <div class="col-lg-12">
                <form action="/karyawan_sakit/aksi_tambah" method="post">
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
                                                <label for="tanggal" class="col-sm-4 col-form-label" style="text-align:right;">Tgl Pemeriksaan </label>
                                                <div class="col-sm-8">
                                                    <input type="date" class="form-control @error('tgl_cek') is-invalid @enderror" name="tgl" value="{{old('tgl_cek')}}" placeholder="Analisa pemeriksaan" style="width:45%;">
                                                </div>
                                                <span role="alert" id="no_seri-msg"></span>
                                            </div>
                                            <div class="form-group row">
                                                <label for="no_pemeriksaan" class="col-sm-4 col-form-label" style="text-align:right;">Nama</label>
                                                <div class="col-sm-8">
                                                    <select type="text" class="form-control @error('karyawan_id') is-invalid @enderror select2" name="karyawan_id" style="width:45%;">
                                                        <option value=""></option>
                                                        @foreach($karyawan as $k)
                                                        <option value="{{$k->id}}">{{$k->nama}}</option>
                                                        @endforeach
                                                    </select>
                                                    @if($errors->has('karyawan_id'))
                                                    <div class="text-danger">
                                                        {{ $errors->first('karyawan_id')}}
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="no_pemeriksaan" class="col-sm-4 col-form-label" style="text-align:right;">Pemeriksa</label>
                                                <div class="col-sm-8">
                                                    <select type="text" class="form-control @error('pemeriksa_id') is-invalid @enderror select2" name="pemeriksa_id" style="width:45%;">
                                                        <option value=""></option>
                                                        @foreach($pengecek as $p)
                                                        <option value="{{$p->id}}">{{$p->nama}}</option>
                                                        @endforeach
                                                    </select>
                                                    @if($errors->has('karyawan_id'))
                                                    <div class="text-danger">
                                                        {{ $errors->first('karyawan_id')}}
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="tanggal" class="col-sm-4 col-form-label" style="text-align:right;">Analisa </label>
                                                <div class="col-sm-8">
                                                    <textarea type="text" class="form-control @error('analisa') is-invalid @enderror" name="analisa" id="analisa" value="{{old('analisa')}}" placeholder="Analisa pemeriksaan" style="width:45%;"></textarea>
                                                </div>
                                                <span role="alert" id="no_seri-msg"></span>
                                            </div>
                                            <div class="form-group row">
                                                <label for="tanggal" class="col-sm-4 col-form-label" style="text-align:right;">Diagnosa</label>
                                                <div class="col-sm-8">
                                                    <textarea type="text" class="form-control @error('diagnosa') is-invalid @enderror" name="diagnosa" id="diagnosa" value="{{old('diagnosa')}}" placeholder="Diagnosa pemeriksaan" style="width:45%;"></textarea>
                                                </div>
                                                <span role="alert" id="no_seri-msg"></span>
                                            </div>
                                            <div class="form-group row">
                                                <label for="kondisi" class="col-sm-4 col-form-label" style="text-align:right;">Tindak lanjut</label>
                                                <div class="col-sm-8" style="margin-top:7px;">
                                                    <div class="icheck-success d-inline col-sm-4">
                                                        <input type="radio" name="hasil_1" value="Terapi">
                                                        <label for="no">
                                                            Terapi
                                                        </label>
                                                    </div>
                                                    <div class="icheck-warning d-inline col-sm-4">
                                                        <input type="radio" name="hasil_1" value="Pengobatan">
                                                        <label for="sample">
                                                            Pengobatan
                                                        </label>
                                                    </div>
                                                    <span class="invalid-feedback" role="alert" id="kondisi-msg"></span>
                                                </div>
                                            </div>
                                            <div id="tipe_1" style="display:none">
                                                <div class="form-group row">
                                                    <label for="tanggal" class="col-sm-4 col-form-label" style="text-align:right;">Terapi</label>
                                                    <div class="col-sm-8">
                                                        <textarea type="text" class="form-control @error('terapi') is-invalid @enderror" id="terapi" value="{{old('terapi')}}" placeholder="Terapi yang digunakan" style="width:45%;" name="terapi"></textarea>
                                                    </div>
                                                    <span role="alert" id="no_seri-msg"></span>
                                                </div>
                                            </div>
                                            <div id="tipe_2" style="display:none">
                                                <div class="form-group row">
                                                    <table class="table table-hover styled-table table-striped col-sm-12" id="obat">
                                                        <thead>
                                                            <tr>
                                                                <th>No</th>
                                                                <th width="15%">Obat</th>
                                                                <th width="20%">Aturan</th>
                                                                <th></th>
                                                                <th width="10%">Jumlah</th>
                                                                <th width="3%"></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody style="text-align: center;">
                                                            <tr>
                                                                <td>1</td>
                                                                <td>
                                                                    <select class="form-control select2 obat_data" name="obat[]" id="0">
                                                                        <option value="">Pilih produk</option>
                                                                        @foreach ($obat as $o)
                                                                        <option value="{{$o->id}}">{{$o->nama}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </td>
                                                                <td>
                                                                    <div class="form-check form-check-inline">
                                                                        <input class="form-check-input aturan_obat" type="radio" name="aturan_obat[]" value="Sebelum Makan">
                                                                        <label class="form-check-label">Sebelum Makan</label>
                                                                    </div>
                                                                    <div class="form-check form-check-inline">
                                                                        <input class="form-check-input aturan_obat" type="radio" name="aturan_obat[]" value="Sesudah Makan">
                                                                        <label class="form-check-label">Sesudah Makan</label>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="form-check form-check-inline">
                                                                        <input class="form-check-input dosis_obat" type="radio" name="dosis_obat[]" value="1x1">
                                                                        <label class="form-check-label" for="dosis_obat">
                                                                            1x1 Hari
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check form-check-inline">
                                                                        <input class="form-check-input dosis_obat" type="radio" name="dosis_obat[]" value="2x1">
                                                                        <label class="form-check-label" for="dosis_obat">
                                                                            2x1 Hari
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check form-check-inline">
                                                                        <input class="form-check-input dosis_obat" type="radio" name="dosis_obat[]" value="2x1">
                                                                        <label class="form-check-label" for="dosis_obat">
                                                                            <div class="input-group mb-3">
                                                                                <input type="text" class="form-control dosis_obat_custom" name="dosis_obat_custom" id="dosis_obat_custom" placeholder="Jumlah obat x hari">
                                                                                <div class="input-group-append">
                                                                                    <span class="input-group-text">Hari</span>
                                                                                </div>
                                                                            </div>
                                                                        </label>
                                                                    </div>
                                                                </td>
                                                                <td class="bottom">
                                                                    <div class="input-group mb-3">
                                                                        <input type="number" class="form-control jumlah" name="jumlah[]" id="jumlah0" placeholder="Jumlah obat">
                                                                        <div class="input-group-append">
                                                                            <span class="input-group-text">Pcs</span>
                                                                        </div>
                                                                    </div>
                                                                    <small id="stok0" class="stok text-muted">Stok : - </small>

                                                                </td>

                                                                <td style="text-align: right;">
                                                                    <button name="add" type="button" id="tambahitem" class="btn btn-success"><i class="nav-icon fas fa-plus-circle"></i></button>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="kondisi" class="col-sm-4 col-form-label" style="text-align:right;">Tindak lanjut</label>
                                                <div class="col-sm-8" style="margin-top:7px;">
                                                    <div class="icheck-success d-inline col-sm-4">
                                                        <input type="radio" name="hasil_2" value="Lanjut bekerja">
                                                        <label for="no">
                                                            Lanjut bekerja
                                                        </label>
                                                    </div>
                                                    <div class="icheck-warning d-inline col-sm-4">
                                                        <input type="radio" name="hasil_2" value="Dipulangkan">
                                                        <label for="sample">
                                                            Dipulangkan
                                                        </label>
                                                    </div>
                                                    <span class="invalid-feedback" role="alert" id="kondisi-msg"></span>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="kondisi" class="col-sm-4 col-form-label" style="text-align:right;"></label>
                                                <div class="col-sm-8" style="margin-top:7px;">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                                        <label class="" for=" flexCheckDefault">
                                                            Surat Keterangan Sakit
                                                        </label>
                                                    </div>
                                                    <span class="invalid-feedback" role="alert" id="kondisi-msg"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <span class="float-left"><a class="btn btn-danger rounded-pill" href="/karyawan_sakit"><i class="fas fa-times"></i>&nbsp;Batal</a></span>
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
        function numberRows($t) {
            var c = 0 - 1;
            $t.find("tr").each(function(ind, el) {
                $(el).find("td:eq(0)").html(++c);
                var j = c - 1;
                $(el).find('input.aturan_obat:radio').attr('name', 'aturan_obat[' + j + ']');
                $(el).find('input.dosis_obat:radio').attr('name', 'dosis_obat[' + j + ']');
                $(el).find('.jumlah').attr('name', 'jumlah[' + j + ']');
                $(el).find('.jumlah').attr('id', 'jumlah' + j + '');
                $(el).find('.stok').attr('id', 'stok' + j + '');
                $(el).find('.obat').attr('name', 'obat[' + j + ']');
                $(el).find('.obat_data').attr('id', j);
                $('.obat_data').select2();
            });
        }
        $('#obat').on("change", ".obat_data", function(i) {
            var id = jQuery(this).val();
            var index = $(this).attr('id');
            console.log(index);
            $.ajax({
                url: '/obat/data/' + id,
                type: "GET",
                dataType: "json",
                success: function(data) {
                    $("#stok" + index).text('Stok : ' + data[0].stok);
                    $("#jumlah" + index).prop('max', data[0].stok);
                    $("#jumlah" + index).prop('min', 1);
                },
                error: function(error) {
                    console.log(error);
                }
            });
        })
        $('#tambahitem').click(function(e) {
            var data = `     <tr>
            <td>1</td>
                                                                <td>
                                                                    <select class="form-control select2 obat_data" id="0" name="obat[]">
                                                                    <option value="">Pilih Produk</option>   
                                                                    @foreach ($obat as $o)
                                                                        <option value="{{$o->id}}">{{$o->nama}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </td>
                                                                <td>
                                                                    <div class="form-check form-check-inline">
                                                                        <input class="form-check-input aturan_obat" type="radio" name="aturan_obat[]" value="Sebelum Makan">
                                                                        <label class="form-check-label">Sebelum Makan</label>
                                                                    </div>
                                                                    <div class="form-check form-check-inline">
                                                                        <input class="form-check-input aturan_obat" type="radio" name="aturan_obat[]" value="Sesudah Makan">
                                                                        <label class="form-check-label">Sesudah Makan</label>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="form-check form-check-inline">
                                                                        <input class="form-check-input dosis_obat" type="radio" name="dosis_obat[]" value="1x1">
                                                                        <label class="form-check-label">
                                                                            1x1 Hari
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check form-check-inline">
                                                                        <input class="form-check-input dosis_obat" type="radio" name="dosis_obat[]" value="2x1">
                                                                        <label class="form-check-label" for="sample">
                                                                            2x1 Hari
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check form-check-inline">
                                                                        <input class="form-check-input dosis_obat" type="radio" name="dosis_obat[]" id="custom_radio">
                                                                        <label class="form-check-label" for="sample">
                                                                            <div class="input-group mb-3">
                                                                                <input type="text" class="form-control dosis_obat_custom" name="dosis_obat_custom[]" id="dosis_obat_custom" placeholder="Jumlah obat x hari">
                                                                                <div class="input-group-append">
                                                                                    <span class="input-group-text">Hari</span>
                                                                                </div>
                                                                            </div>
                                                                        </label>
                                                                    </div>
                                                                </td>
                                                                <td class="bottom">
                                                                    <div class="input-group mb-3">
                                                                        <input type="number" class="form-control jumlah" name="jumlah[]" id="jumlah0" placeholder="Jumlah obat">
                                                                        <div class="input-group-append">
                                                                            <span class="input-group-text">Pcs</span>
                                                                        </div>
                                                                    </div>
                                                                    <small id="stok0" class="stok text-muted">Stok : - </small>
                                                                </td>
                                                                <td style="text-align: right;">
                                                                <button type="button" class="btn btn-danger karyawan-img-small" style="border-radius:50%;" id="closetable"><i class="fas fa-times-circle"></i></button> 
                                                                </td>
                            </tr>`;
            $('#obat tr:last').after(data);
            numberRows($("#obat"));
        });
        $('#obat').on('click', '#closetable', function(e) {
            $(this).closest('tr').remove();
            numberRows($("#obat"));
        });

        $('input[name=dosis_obat]').on("click", function() {
            check = $("#custom_radio").is(":checked");
            if (check) {
                $('input[id=dosis_obat_custom]').prop("required", true);
            } else {
                $('input[id=dosis_obat_custom]').prop("required", false);
                $('#dosis_obat_custom').val('');
            }
        });


        $('input[name=hasil_1]').prop("required", true);
        $('input[name=hasil_2]').prop("required", true);
        $('input[type=radio][name=hasil_1]').on('change', function() {
            if (this.value == 'Terapi') {
                $('#obat').val(null).trigger('change');
                $("#tipe_1").removeAttr("style");
                $("#tipe_2").css('display', 'none');
                $('#dosis_obat_custom').val('');
                $('#jumlah').val('');
                $('select[name=obat_id]').prop("required", false);
                $('input[name=jumlah]').prop("required", false);
                $('input[name=aturan_obat]').prop("required", false);
                $('input[name=dosis_obat]').prop("required", false);
                $('input[name=aturan_obat]').prop("checked", false);
                $('input[name=dosis_obat]').prop("checked", false);
                $('textarea[id=terapi]').prop("required", true);
                $('#obat').val(null).trigger('change');
                $('#stok').text('');
            } else {
                $('input[name=jumlah]').prop("required", true);
                $('select[name=obat_id]').prop("required", true);
                $('input[name=dosis_obat]').prop("required", true);
                $('input[name=aturan_obat]').prop("required", true);
                $('#obat').val(null).trigger('change');
                $("#tipe_1").css('display', 'none')
                $("#tipe_2").removeAttr("style");
                $('textarea[id=terapi]').prop("required", false);
            }
        });
    });
</script>
@stop