@extends('adminlte.page')

@section('title', 'Beta Version')

@section('content_header')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Mutasi Gudang Produk</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item"><a href="/gudang_produk_gbj">Gudang Produk</a></li>
                    <li class="breadcrumb-item active">Tambah</li>
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
            <div class="col-lg-12">
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
                    <strong><i class="fas fa-times"></i></strong> @foreach($errors as $i)
                    {{$i}}
                    @endforeach
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif
                <div class="card">
                    <div class="card-header bg-info">
                        <div class="card-title"><i class="fas fa-plus-circle"></i> Tambah Gudang Produk</div>
                    </div>
                    <form action="{{ route('gudang_produk_gbj.store', ['id' => $id]) }}" method="post">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        <div class="card-body">
                            <div class="form-horizontal">
                                <div class="form-group row">
                                    <label for="" class="col-sm-5 col-form-label" style="text-align:right;">Nama</label>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control col-form-label @error('produk') is-invalid @enderror" id="nomor" name="nomor" style="width:50%;" readonly value="{{$p->Produk->nama}}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-sm-5 col-form-label" style="text-align:right;">Tipe</label>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control col-form-label @error('produk') is-invalid @enderror" id="nomor" name="nomor" style="width:50%;" readonly value="{{$p->nama}}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="table-responsive">
                                        <table class="table table-striped" id="tableitem">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Tanggal</th>
                                                    <th>Dari / Ke</th>
                                                    <th>Keterangan</th>
                                                    <th>Jumlah Masuk</th>
                                                    <th>Jumlah Keluar</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>1</td>
                                                    <td><input type="date" class="form-control" name="tanggal[]" id="tanggal"></td>
                                                    <td><select class="select2 select-info form-control divisi_id" name="divisi_id[]" id="divisi_id" disabled>
                                                            <option value=""></option>
                                                            @foreach($d as $i)
                                                            <option value="{{$i->id}}">{{$i->nama}}</option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td><textarea name="keterangan[]" id="keterangan" class="form-control" readonly></textarea></td>
                                                    <td><input type="number" class="form-control" id="jumlah_masuk" name="jumlah_masuk[]" readonly></td>
                                                    <td><input type="number" class="form-control" id="jumlah_keluar" name="jumlah_keluar[]" readonly></td>
                                                    <td><button type="button" class="btn btn-success" style="border-radius: 50%;" id="tambahitem" disabled><i class="fas fa-plus-circle"></i></button></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <span>
                                <button type="button" class="btn btn-block btn-danger rounded-pill" style="width:200px;float:left;"><i class="fas fa-times"></i>&nbsp;Batal</button>
                            </span>
                            <span>
                                <button type="submit" id="tambahdata" class="btn btn-block btn-success rounded-pill" style="width:200px;float:right;" disabled><i class="fas fa-plus"></i>&nbsp;Tambah Data</button>
                            </span>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@stop

@section('adminlte_js')
<script>
    $(function() {
        $('#tableitem').on("keyup change", "input[id='tanggal']", function() {
            var tanggal = $(this).closest('tr').find('input[id="tanggal"]').val();
            var divisi_id = $(this).closest('tr').find('.divisi_id');
            var keterangan = $(this).closest('tr').find('#keterangan');
            var jumlah_masuk = $(this).closest('tr').find('input[id="jumlah_masuk"]');
            var jumlah_keluar = $(this).closest('tr').find('input[id="jumlah_keluar"]');

            if (tanggal) {
                if (divisi_id.val() != "" && keterangan.val() != "" && jumlah_masuk.val() != "" && jumlah_keluar.val() != "") {
                    $('#tambahdata').removeAttr('disabled');
                    $('#tambahitem').removeAttr('disabled');
                } else {
                    divisi_id.removeAttr('disabled');
                    $('#tambahitem').attr('disabled', true);
                    $('#tambahdata').attr('disabled', true);
                }
            } else {
                divisi_id.attr('disabled', true);
                $('#tambahitem').attr('disabled', true);
                $('#tambahdata').attr('disabled', true);
                message.removeClass("invalid-feedback");
                alias.removeClass("is-invalid");
                message.empty();
            }
        });

        $('#tableitem').on("keyup change", ".divisi_id", function() {
            var divisi_id = $(this).closest('tr').find('.divisi_id').val();
            var tanggal = $(this).closest('tr').find('input[id="tanggal"]');
            var keterangan = $(this).closest('tr').find('#keterangan');
            var jumlah_masuk = $(this).closest('tr').find('input[id="jumlah_masuk"]');
            var jumlah_keluar = $(this).closest('tr').find('input[id="jumlah_keluar"]');

            if (divisi_id) {
                if (tanggal.val() != "" && keterangan.val() != "" && jumlah_masuk.val() != "" && jumlah_keluar.val() != "") {
                    $('#tambahdata').removeAttr('disabled');
                    $('#tambahitem').removeAttr('disabled');
                } else {
                    keterangan.removeAttr('readonly');
                    $('#tambahitem').attr('disabled', true);
                    $('#tambahdata').attr('disabled', true);
                }
            } else {
                keterangan.attr('readonly', true);
                $('#tambahitem').attr('disabled', true);
                $('#tambahdata').attr('disabled', true);
                message.removeClass("invalid-feedback");
                alias.removeClass("is-invalid");
                message.empty();
            }
        });

        $('#tableitem').on("keyup change", '#keterangan', function() {
            var keterangan = $(this).closest('tr').find('#keterangan').val();
            var tanggal = $(this).closest('tr').find('input[id="tanggal"]');
            var divisi_id = $(this).closest('tr').find('.divisi_id');
            var jumlah_masuk = $(this).closest('tr').find('input[id="jumlah_masuk"]');
            var jumlah_keluar = $(this).closest('tr').find('input[id="jumlah_keluar"]');

            if (keterangan != "") {

                if (tanggal.val() != "" && divisi_id.val() != "" && jumlah_keluar.val() != "" && jumlah_masuk.val() != "") {
                    $('#tambahdata').removeAttr('disabled');
                    $('#tambahitem').removeAttr('disabled');
                } else {
                    jumlah_masuk.removeAttr('readonly');
                    jumlah_keluar.removeAttr('readonly');
                    $('#tambahitem').attr('disabled', true);
                    $('#tambahdata').attr('disabled', true);
                }
            } else if (keterangan == "") {
                jumlah_masuk.attr('readonly', true);
                jumlah_keluar.attr('readonly', true);
                $('#tambahitem').attr('disabled', true);
                $('#tambahdata').attr('disabled', true);
            }
        });

        $('#tableitem').on("keyup change", 'input[id="jumlah_masuk"]', function() {
            var jumlah_masuk = $(this).closest('tr').find('input[id="jumlah_masuk"]').val();
            var keterangan = $(this).closest('tr').find('#keterangan');
            var tanggal = $(this).closest('tr').find('input[id="tanggal"]');
            var divisi_id = $(this).closest('tr').find('.divisi_id');
            var jumlah_keluar = $(this).closest('tr').find('input[id="jumlah_keluar"]');

            if (jumlah_masuk != "") {
                if (tanggal.val() != "" && divisi_id.val() != "" && keterangan.val() != "") {
                    jumlah_keluar.val("0");
                    jumlah_keluar.attr("readonly", true);
                    $('#tambahdata').removeAttr('disabled');
                    $('#tambahitem').removeAttr('disabled');
                } else {
                    jumlah_keluar.val("0");
                    jumlah_keluar.attr("readonly", true);
                    $('#tambahitem').attr('disabled', true);
                    $('#tambahdata').attr('disabled', true);
                }
            } else if (jumlah_masuk == "") {
                jumlah_keluar.val("");
                jumlah_keluar.removeAttr('readonly');
                $('#tambahitem').attr('disabled', true);
                $('#tambahdata').attr('disabled', true);
            }
        });

        $('#tableitem').on("keyup change", 'input[id="jumlah_keluar"]', function() {
            var jumlah_keluar = $(this).closest('tr').find('input[id="jumlah_keluar"]').val();
            var keterangan = $(this).closest('tr').find('#keterangan');
            var tanggal = $(this).closest('tr').find('input[id="tanggal"]');
            var divisi_id = $(this).closest('tr').find('.divisi_id');
            var jumlah_masuk = $(this).closest('tr').find('input[id="jumlah_masuk"]');

            if (jumlah_keluar) {
                if (tanggal.val() != "" && divisi_id.val() != "" && keterangan.val() != "") {
                    jumlah_masuk.val("0");
                    jumlah_masuk.attr("readonly", true);
                    $('#tambahdata').removeAttr('disabled');
                    $('#tambahitem').removeAttr('disabled');
                } else {
                    jumlah_masuk.val("0");
                    jumlah_masuk.attr("readonly", true);
                    $('#tambahitem').attr('disabled', true);
                    $('#tambahdata').attr('disabled', true);
                }
            } else if (jumlah_keluar == "") {
                jumlah_masuk.val("");
                jumlah_masuk.removeAttr('readonly');
                $('#tambahitem').attr('disabled', true);
                $('#tambahdata').attr('disabled', true);
            }
        });

        function numberRows($t) {
            var c = 0 - 1;
            $t.find("tr").each(function(ind, el) {
                $(el).find("td:eq(0)").html(++c);
                var j = c - 1;
                $(el).find('input[id="tanggal"]').attr('name', 'tanggal[' + j + ']');
                $(el).find('#keterangan').attr('name', 'keterangan[' + j + ']');
                $(el).find('input[id="jumlah_masuk"]').attr('name', 'jumlah_masuk[' + j + ']');
                $(el).find('input[id="jumlah_keluar"]').attr('name', 'jumlah_keluar[' + j + ']');
                $(el).find('.divisi_id').attr('name', 'divisi_id[' + j + ']');
                $(el).find('.divisi_id').attr('id', 'divisi_id' + j);
                $('.divisi_id').select2();
            });
        }

        $('#tambahitem').click(function(e) {
            $('#tambahitem').attr('disabled', true);
            $('#tambahdata').attr('disabled', true);
            $('#tableitem tr:last').after(`<tr>
                <td></td>
                <td><input type="date" class="form-control" name="tanggal[]" id="tanggal"></td>
                <td><select class="select2 select-info form-control divisi_id" name="divisi_id[]" id="divisi_id" disabled>
                        <option value=""></option>
                        @foreach($d as $i)
                        <option value="{{$i->id}}">{{$i->nama}}</option>
                        @endforeach
                    </select>
                </td>
                <td><textarea name="keterangan[]" id="keterangan" class="form-control" readonly></textarea></td>
                <td><input type="number" class="form-control" id="jumlah_masuk" name="jumlah_masuk[]" readonly></td>
                <td><input type="number" class="form-control" id="jumlah_keluar" name="jumlah_keluar[]" readonly></td>
                <td><button type="button" class="btn btn-danger" style="border-radius: 50%;" id="closetable"><i class="fas fa-times-circle"></i></button></td>
            </tr>`);
            numberRows($("#tableitem"));
        });

        $('#tableitem').on('click', '#closetable', function(e) {
            $('#tambahitem').removeAttr('disabled');
            $('#tambahdata').removeAttr('disabled');
            $(this).closest('tr').remove();
            numberRows($("#tableitem"));
        });
    });
</script>
@stop