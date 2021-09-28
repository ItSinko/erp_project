@extends('adminlte.page')

@section('title', 'Beta Version')

@section('content_header')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Pemeriksaan Proses</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Pemeriksaan Proses</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
@stop

@section('adminlte_css')
<style>
    .borderless {
        border: 0 none;
    }
</style>
@endsection

@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <!-- left column -->
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <h4>Info Produk</h4>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
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
                    <strong><i class="fas fa-times"></i></strong> Lengkapi data terlebih dahulu
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif
                <div class="card">
                    <div class="card-header bg-success">
                        <h3 class="card-title" style="color:white;"><i class="fa fa-plus-circle" aria-hidden="true"></i>&nbsp;Pemeriksaan Proses {{$proses}}</h3>
                    </div>
                    <div class="card-body">
                        <div class="col-md-12">
                            <form action="{{ route('pemeriksaan_proses.store', ['bppb_id' => $bppb_id, 'proses' => $proses]) }}" method="post" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                {{ method_field('PUT') }}

                                <div class="form-horizontal">
                                    <h4>Detail Pemeriksaan</h4>
                                    <div class="form-group row">
                                        <label for="nomor" class="col-sm-5 col-form-label" style="text-align:right;">Nomor</label>
                                        <div class="col-sm-7">
                                            <input type="text" class="form-control" name="nomor" id="nomor" value="" style="width: 25%;">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="tanggal" class="col-sm-5 col-form-label" style="text-align:right;">Tanggal</label>
                                        <div class="col-sm-7">
                                            <input type="date" class="form-control" name="tanggal" id="tanggal" value="" style="width: 20%;">
                                        </div>
                                    </div>

                                    <h4>Standar Pemeriksaan</h4>
                                    <div class="form-group row">
                                        <label for="jumlah_all" class="col-sm-5 col-form-label" style="text-align:right;">Jumlah</label>
                                        <div class="col-sm-7">
                                            <input type="number" class="form-control" name="jumlah_all" id="jumlah_all" value="{{$b->jumlah}}" style="width: 20%;">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <table id="tableitem" class="table table-hover tableitem">
                                            <thead style="text-align:center;">
                                                <tr>
                                                    <th rowspan="2">No</th>
                                                    <th rowspan="2">Hal yang diperiksa</th>
                                                    <th rowspan="2">Standar Keberterimaan</th>
                                                    <th rowspan="2">Jumlah</th>
                                                    <th colspan="2">Hasil</th>
                                                    <th rowspan="2">Tindak Lanjut</th>
                                                    <th rowspan="2">Keterangan</th>
                                                </tr>
                                                <tr>
                                                    <th>OK</th>
                                                    <th>NOK</th>
                                                </tr>
                                            </thead>
                                            <tbody style="text-align: left;">
                                                <?php $count = 0; ?>
                                                @foreach($p as $i)
                                                <tr>
                                                    <td rowspan="{{count($i->DetailIkPemeriksaan)}}">{{$loop->iteration}}</td>
                                                    <td rowspan="{{count($i->DetailIkPemeriksaan)}}">{{$i->pemeriksaan}}</td>
                                                    @foreach($i->DetailIkPemeriksaan as $j)
                                                    <?php $first = 0; ?>
                                                    @if ($first == 0)
                                                    <?php $first = 1; ?>
                                                    <td>{{$j->penerimaan}}<input type="text" name="detail_ik_pemeriksaan_id[]" value="{{$j->id}}" hidden> </td>
                                                    <td><input type="number" class="form-control jumlah @error('jumlah') is-invalid @enderror" name="jumlah[]" id="jumlah" min="0" value="{{$b->jumlah}}"></td>
                                                    <td><input type="number" class="form-control hasil_ok @error('hasil_ok') is-invalid @enderror" name="hasil_ok[]" id="hasil_ok" min="0" value="{{$b->jumlah}}"></td>
                                                    <td><input type="number" class="form-control hasil_nok @error('hasil_nok') is-invalid @enderror" name="hasil_nok[]" id="hasil_nok" min="0" value="0"></td>
                                                    <td>
                                                        <div class="form-check">
                                                            <input class="form-check-input tindak_lanjut" type="radio" name="tindak_lanjut[{{$count}}]" id="karantina{{$count}}" value="karantina" disabled>
                                                            <label class="form-check-label" for="karantina{{$count}}">
                                                                Karantina
                                                            </label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input tindak_lanjut" type="radio" name="tindak_lanjut[{{$count}}]" id="perbaikan{{$count}}" value="perbaikan" disabled>
                                                            <label class="form-check-label" for="perbaikan{{$count}}">
                                                                Perbaikan
                                                            </label>
                                                        </div>
                                                    </td>
                                                    <td><textarea name="keterangan[]" id="keterangan" class="form-control keterangan" readonly></textarea></td>
                                                    <?php $count++; ?>
                                                </tr>
                                                @elseif($first == 1)
                                                <tr>
                                                    <td>{{$j->penerimaan}}<input type="text" name="detail_ik_pemeriksaan_id[]" value="{{$j->id}}" hidden></td>
                                                    <td><input type="number" class="form-control jumlah @error('jumlah') is-invalid @enderror" name="jumlah[]" id="jumlah" min="0" value="{{$b->jumlah}}"></td>
                                                    <td><input type="number" class="form-control hasil_ok @error('hasil_ok') is-invalid @enderror" name="hasil_ok[]" id="hasil_ok" min="0" value="{{$b->jumlah}}"></td>
                                                    <td><input type="number" class="form-control hasil_nok @error('hasil_nok') is-invalid @enderror" name="hasil_nok[]" id="hasil_nok" min="0" value="0"></td>
                                                    <td>
                                                        <div class="form-check">
                                                            <input class="form-check-input tindak_lanjut" type="radio" name="tindak_lanjut[{{$count}}]" id="karantina{{$count}}" value="karantina" disabled>
                                                            <label class="form-check-label" for="karantina{{$count}}">
                                                                Karantina
                                                            </label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input tindak_lanjut" type="radio" name="tindak_lanjut[{{$count}}]" id="perbaikan{{$count}}" value="perbaikan" disabled>
                                                            <label class="form-check-label" for="perbaikan{{$count}}">
                                                                Perbaikan
                                                            </label>
                                                        </div>
                                                    </td>
                                                    <td><textarea name="keterangan[]" id="keterangan" class="form-control keterangan" readonly></textarea></td>
                                                    <?php $count++; ?>
                                                </tr>
                                                @endif
                                                @endforeach
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <span>
                            <a class="cancelmodal" data-toggle="modal" data-target="#cancelmodal"><button type="button" class="btn btn-block btn-danger rounded-pill" style="width:200px;float:left;"><i class="fas fa-times"></i>&nbsp;Batal</button></a>
                        </span>
                        <span>
                            <button type="submit" class="btn btn-block btn-success rounded-pill" style="width:200px;float:right;" id="tambahlaporan" disabled><i class="fas fa-plus"></i>&nbsp;Tambah Data</button>
                        </span>
                    </div>
                    </form>
                </div>

                <!-- /.row -->
            </div><!-- /.container-fluid -->
            <div class="modal fade" id="cancelmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog modal-md" role="document">
                    <div class="modal-content">
                        <div class="modal-header" style="background-color:	#778899;">
                            <h4 class="modal-title" id="myModalLabel" style="color:white;">Keluar Halaman</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="modal-body" id="cancel">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="card">
                                        <div class="card-body" style="text-align:center;">
                                            <h6>Apakah anda yakin meninggalkan halaman ini?</h6>
                                        </div>
                                        <div class="card-footer col-12" style="margin-bottom: 2%;">
                                            <span>
                                                <button type="button" class="btn btn-block btn-secondary" data-dismiss="modal" id="batalhapussk" style="width:30%;float:left;">Batal</button>
                                            </span>
                                            <span>
                                                <a href="/pemeriksaan_proses/{{$bppb_id}}"><button type="button" class="btn btn-block btn-danger" id="" style="width:30%;float:right;">Keluar</button></a>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
</section>
@endsection

@section('adminlte_js')
<script>
    $(function() {
        var jumprd = parseInt("{{$b->jumlah}}");
        $('#nomor').on('keyup change', function() {
            var nomor = $(this).val();
        })

        $('#jumlah_all').on('keyup change', function() {
            var jumlah_all = $(this).val();
            $(this).removeClass("is-invalid");
            $(".tindak_lanjut").prop('checked', false);
            $(".tindak_lanjut").attr('disabled', true);
            $(".keterangan").val("");
            $(".keterangan").attr('readonly', true);
            if (jumlah_all > 0 && jumlah_all <= jumprd) {
                $('.jumlah').removeAttr('readonly');
                $('.hasil_ok').removeAttr('readonly');
                $('.hasil_nok').removeAttr('readonly');
                $('.jumlah').val(jumlah_all);
                $('.hasil_ok').val(jumlah_all);
                $('.hasil_nok').val("");
            } else {
                $('.jumlah').attr('readonly', true);
                $('.hasil_ok').attr('readonly', true);
                $('.hasil_nok').attr('readonly', true);
                $('.jumlah').val("");
                $('.hasil_ok').val("");
                $('.hasil_nok').val("");
                $(this).addClass("is-invalid");
            }
        })

        $('#tableitem').on('keyup change', '.jumlah', function() {
            $(this).removeClass("is-invalid");
            var hasil = parseInt($(this).val());
            var jumlah = parseInt($('#jumlah_all').val());
            var ok = $(this).closest('tr').find('.hasil_ok');
            var nok = $(this).closest('tr').find('.hasil_nok');
            var tl = $(this).closest('tr').find('.tindak_lanjut');
            var ket = $(this).closest('tr').find('.keterangan');
            if (hasil <= jumlah) {
                ok.val(hasil);
                nok.val("0");
                tl.prop('checked', false);
                tl.attr('disabled', true);
                ket.val("");
                ket.attr('readonly', true);
            } else if (hasil > jumlah) {
                $(this).addClass("is-invalid");
                ok.val("0");
                nok.val("0");
                tl.prop('checked', false);
                tl.attr('disabled', true);
                ket.val("");
                ket.attr('readonly', true);
            } else {
                ok.val("0");
                nok.val("0");
                tl.prop('checked', false);
                tl.attr('disabled', true);
                ket.val("");
                ket.attr('readonly', true);
            }
        });

        $('#tableitem').on('keyup change', '.hasil_ok', function() {
            var hasil = parseInt($(this).val());
            var jumlah = parseInt($(this).closest('tr').find('.jumlah').val());
            var ok = $(this).closest('tr').find('.hasil_ok');
            var nok = $(this).closest('tr').find('.hasil_nok');
            var tl = $(this).closest('tr').find('.tindak_lanjut');
            var ket = $(this).closest('tr').find('.keterangan');
            ok.removeClass("is-invalid");
            console.log("jumlah " + jumlah);
            console.log("hasil " + hasil);
            if (hasil > 0 && hasil <= jumlah) {
                if (hasil < jumlah) {
                    tl.removeAttr('disabled');
                    var res = jumlah - hasil;
                    nok.val(res);
                } else if (hasil == jumlah) {
                    tl.prop('checked', false);
                    tl.attr('disabled', true);
                    var res = jumlah - hasil;
                    nok.val(res);
                }
            } else if (hasil > jumlah) {
                tl.prop('checked', false);
                tl.attr('disabled', true);
                ok.addClass("is-invalid");
                nok.val("");
                ket.val("");
                ket.attr('readonly', true);
            } else {
                tl.removeAttr('disabled');
                nok.val(jumlah);
                ket.val("");
                ket.attr('readonly', true);
            }
        })

        $('#tableitem').on('keyup change', '.hasil_nok', function() {
            var hasil = parseInt($(this).val());
            var jumlah = parseInt($(this).closest('tr').find('.jumlah').val());
            var ok = $(this).closest('tr').find('.hasil_ok');
            var nok = $(this).closest('tr').find('.hasil_nok');
            var tl = $(this).closest('tr').find('.tindak_lanjut');
            var ket = $(this).closest('tr').find('.keterangan');
            nok.removeClass("is-invalid");
            ket.attr('readonly', true);
            if (hasil > 0 && hasil <= jumlah) {
                tl.removeAttr('disabled');
                var res = jumlah - hasil;
                ok.val(res);
                ket.val("");
                ket.attr('readonly', true);
            } else if (hasil > jumlah) {
                tl.prop('checked', false);
                tl.attr('disabled', true);
                nok.addClass("is-invalid");
                ok.val("");
                ket.val("");
                ket.attr('readonly', true);
            } else {
                tl.prop('checked', false);
                tl.attr('disabled', true);
                ok.val(jumlah);
                ket.val("");
                ket.attr('readonly', true);
            }
        })

        $('#tableitem').on('change', '.tindak_lanjut', function() {
            var hasil = $(this).closest('tr').find('.tindak_lanjut:checked').val();
            var keterangan = $(this).closest('tr').find('.keterangan');
            if (hasil != "") {
                keterangan.removeAttr('readonly');
            }
        });
    })
</script>
@endsection