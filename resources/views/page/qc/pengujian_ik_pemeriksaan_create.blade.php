@extends('adminlte.page')

@section('title', 'Beta Version')

@section('content_header')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Pengujian</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Pengemasan</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
@stop

@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
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
                <form action="{{route('pengujian.ik_pemeriksaan.store')}}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="card">
                        <div class="card-header bg-success">
                            <h3 class="card-title" style="color:white;"><i class="fa fa-plus-circle" aria-hidden="true"></i>&nbsp;Tambahkan Monitoring Proses</h3>
                        </div>
                        <div class="card-body">

                            <div class="col-md-12">

                                <h3>Produk</h3>
                                <div class="form-horizontal">
                                    <div class="form-group row">
                                        <label for="detail_produk_id" class="col-sm-5 col-form-label" style="text-align:right;">Produk</label>
                                        <div class="col-sm-4">
                                            <div class="select2-info">
                                                <select class="select2 custom-select form-control @error('detail_produk_id') is-invalid @enderror detail_produk_id" data-placeholder="Pilih Produk" data-dropdown-css-class="select2-info" style="width: 80%;" name="detail_produk_id" id="detail_produk_id">
                                                    <option value=""></option>
                                                    @foreach($dp as $i)
                                                    <option value="{{$i->id}}">{{$i->nama}}</option>
                                                    @endforeach
                                                </select>
                                                @if ($errors->has('detail_produk_id'))
                                                <span class="invalid-feedback" role="alert">{{$errors->first('detail_produk_id')}}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="kategori_produk" class="col-sm-5 col-form-label" style="text-align:right;">Kategori Produk</label>
                                        <div class="col-sm-7">
                                            <input type="text" class="form-control" name="kategori_produk" id="kategori_produk" value="" style="width: 50%;" readonly>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="kelompok_produk" class="col-sm-5 col-form-label" style="text-align:right;">Kelompok Produk</label>
                                        <div class="col-sm-7">
                                            <input type="text" class="form-control" name="kelompok_produk" id="kelompok_produk" value="" style="width: 50%;" readonly>
                                        </div>
                                    </div>

                                    <h3>Data Pemeriksaan</h3>
                                    <div class="form-horizontal">

                                        <div id="formpemeriksaan">
                                            <div class="form-group row">
                                                <label for="hal_yang_diperiksa_add" class="col-sm-5 col-form-label" style="text-align:right;">Hal yang diperiksa</label>
                                                <div class="col-sm-4">
                                                    <textarea name="hal_yang_diperiksa_add" id="hal_yang_diperiksa_add" class="form-control"></textarea>
                                                    <small id="hal_yang_diperiksa_msg"></small>
                                                </div>
                                                <div class="col-sm-2 col-form-label" style="text-align:left;">

                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <table id="tableitem" class="table table-hover tableitem">
                                                    <thead style="text-align:center;">
                                                        <tr>
                                                            <th>No</th>
                                                            <th>Pemeriksaan</th>
                                                            <th>Aksi</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody style="text-align: center;">
                                                        <td>1</td>
                                                        <td><textarea name="standar_keberterimaan_add[]" id="standar_keberterimaan_add" class="form-control standar_keberterimaan" style="width: 50%;"></textarea>
                                                            <small id="standar_keberterimaan_msg"></small>
                                                        </td>
                                                        <td><button type="button" class="btn btn-success btn-sm m-1 tambahitem" style="border-radius:50%;" id="tambahitem"><i class="fas fa-plus-circle"></i></button></td>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <span>
                                                <button type="button" class="btn btn-sm btn-primary rounded-pill" style="float:right;" id="tambahpemeriksaan"><i class="fas fa-plus"></i>&nbsp;Tambah Pemeriksaan</button>
                                            </span>
                                        </div>

                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header bg-success">
                            <h3 class="card-title" style="color:white;"><i class="fa fa-plus-circle" aria-hidden="true"></i>&nbsp;Data Pemeriksaan Proses</h3>
                        </div>
                        <div class="card-body">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <table id="tableitems" class="table table-hover table-bordered">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Hal yang diperiksa</th>
                                                <th>Standar Keberterimaan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <span>
                                <button type="button" class="btn btn-block btn-danger rounded-pill" style="width:200px;float:left;"><i class="fas fa-times"></i>&nbsp;Batal</button>
                            </span>
                            <span>
                                <button type="submit" class="btn btn-block btn-success rounded-pill" style="width:200px;float:right;"><i class="fas fa-plus"></i>&nbsp;Tambah Data</button>
                            </span>
                        </div>
                    </div>
                </form>

            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
</section>
@endsection

@section('adminlte_js')
<script>
    $(function() {
        var rowCount = 0;
        $('select[name="detail_produk_id"]').on('change', function() {
            var detail_produk_id = $(this).val();
            console.log(detail_produk_id);
            if (detail_produk_id) {
                $.ajax({
                    url: 'get_detail_produk_by_id/' + detail_produk_id,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        $('input[name="kelompok_produk"]').val(data[0]['produk']['kelompokproduk']['nama']);
                        $('input[name="kategori_produk"]').val(data[0]['produk']['kategoriproduk']['nama']);
                    }
                });
            }
        });

        // $("#aksi").on('click', function() {
        //     var ColCount = 0;
        //     $(this).closest("tr").children("td").each(function() {
        //         ColCount++;
        //     });
        //     ColCount = ColCount - 2;

        //     var j = 1;
        //     for (j = 1; j <= ColCount; j++) {
        //         var z = $(this).closest("tr").find(("td:nth-child(" + j + ")")).attr('rowspan');
        //         if (z == null)
        //             break;
        //         else
        //             $(this).closest("tr").find(("td:nth-child(" + j + ")")).attr('rowspan', 1 + parseInt(z));
        //     }

        //     console.log(ColCount);
        // });

        // $("#aksi2").on('click', function() {
        //     var rowCount1 = $('#tableitems12 tbody tr').length;
        //     var x = `<tr><td class="personal"></td>
        //         <td class="personal"><textarea name="hal_yang_diperiksa[]" id="hal_yang_diperiksa" class="form-control"></textarea></td>
        //         <td><textarea name="standar_keberterimaan[]" id="standar_keberterimaan" class="form-control"></textarea></td>
        //         <td><button type = "button" class="btn btn-sm btn-success" style="border-radius: 50%;" id="aksi"><i class="fas fa-plus"></i></button></td>
        //         <td class="personal"><button type="button" class="btn btn-sm btn-danger" style="border-radius: 50%;" id="delaksi2"><i class="fas fa-times"></i></button></td>
        //         </tr>`;
        //     $("#tableitems12 tr:last").after(x);
        //     RowCount++;
        // });

        function numberRows($t) {
            var c = 0 - 1;
            $t.find("tr").each(function(ind, el) {
                $(el).find("td:eq(0)").html(++c);
                var j = c - 1;
                $(el).find('input[id="standar_keberterimaan"]').attr('name', 'standar_keberterimaan[][' + j + ']');
            });
        }

        // function numberRows1($t) {
        //     var c = 0 - 1;
        //     $t.find("tr").each(function(ind, el) {
        //         console.log(c);
        //         $(el).find("td:eq(0)").html(++c);
        //         var j = c - 1;
        //         $(el).find('textarea[id="hal_yang_diperiksa"]').attr('name', 'hal_yang_diperiksa[' + j + ']');
        //         $(el).find('.standar_keberterimaan').attr('name', 'standar_keberterimaan[' + j + '][]');
        //     });
        // }

        var numrows = 0;
        $('.tambahitem').click(function(e) {
            $('.tableitem tr:last').after(`<tr class="personal">
                <td></td>
                <td><textarea name="standar_keberterimaan_add[]" id="standar_keberterimaan_add" class="form-control standar_keberterimaan" style="width: 50%;"></textarea>
                <small id="standar_keberterimaan_msg"></small></td>
                <td><button type="button" class="btn btn-danger btn-sm m-1" style="border-radius:50%;" id="closetable" ><i class="fas fa-times-circle"></i></button></td>
            </tr>`);
            numberRows($(".tableitem"));
        });


        $('#tambahpemeriksaan').on('click', function() {
            var hal_yg_diperiksa = $('textarea[name="hal_yang_diperiksa_add"]').val();
            var standar_keberterimaan_arr = [];
            var sk = [];
            var bool = true;
            $("textarea[name='standar_keberterimaan_add[]']").each(function() {
                sk.push($(this).val());
                if ($(this).val() == "") {
                    bool = false;
                }
            });
            if (bool == true && hal_yg_diperiksa != null) {
                var first = true;
                var data = "";
                data += `<tr>
                <td rowspan = "` + sk.length + `">` + (numrows + 1) + `</td>
                <td rowspan = "` + sk.length + `"><textarea id="hal_yang_diperiksa" name="hal_yang_diperiksa[` + numrows + `]" class="form-control" hidden> ` + hal_yg_diperiksa + ` </textarea>` + hal_yg_diperiksa + `</td>`;
                for (var j = 0; j < sk.length; j++) {
                    if (first == true) {
                        data += `<td><textarea id="standar_keberterimaan" name="standar_keberterimaan[` + numrows + `][]" class="form-control standar_keberterimaan" hidden>` + sk[j] + `</textarea>` + sk[j] + `</td>
                             </tr>`;
                        first = false;
                    } else if (first == false) {
                        data += `<tr><td><textarea id="standar_keberterimaan" name="standar_keberterimaan[` + numrows + `][]" class="form-control standar_keberterimaan" hidden>` + sk[j] + `</textarea>` + sk[j] + `</td>
                    </tr>`;
                    }
                }
                numrows++;
                $('#tableitems tr:last').after(data);
                $('textarea[name="hal_yang_diperiksa_add"]').val("");
                $('textarea[id="standar_keberterimaan_add"]').val("");
                $("#tableitem").find("tr:gt(1)").remove();

                $('#hal_yang_diperiksa_msg').removeClass("invalid-feedback");
                $('textarea[name="hal_yang_diperiksa_add"]').removeClass("is-invalid");
                $('#hal_yang_diperiksa_msg').html("");

                $('#standar_keberterimaan_msg').removeClass("invalid-feedback");
                $('textarea[id="standar_keberterimaan_add"]').removeClass("is-invalid");
                $('#standar_keberterimaan_msg').html("");
            } else if (bool == false || hal_yg_diperiksa == null) {
                if (hal_yg_diperiksa == null && bool == true) {
                    $('#hal_yang_diperiksa_msg').addClass("invalid-feedback");
                    $('textarea[name="hal_yang_diperiksa_add"]').addClass("is-invalid");
                    $('#hal_yang_diperiksa_msg').html("Harus Diisi");
                } else if (hal_yg_diperiksa != null && bool == false) {
                    $('#standar_keberterimaan_msg').addClass("invalid-feedback");
                    $('textarea[id="standar_keberterimaan_add"]').addClass("is-invalid");
                    $('#standar_keberterimaan_msg').html("Harus Diisi");
                } else {
                    $('#hal_yang_diperiksa_msg').addClass("invalid-feedback");
                    $('textarea[name="hal_yang_diperiksa_add"]').addClass("is-invalid");
                    $('#hal_yang_diperiksa_msg').html("Harus Diisi");

                    $('#standar_keberterimaan_msg').addClass("invalid-feedback");
                    $('textarea[id="standar_keberterimaan_add"]').addClass("is-invalid");
                    $('#standar_keberterimaan_msg').html("Harus Diisi");
                }
            }
            // numberRows1($("#tableitems"));
        });

        $('.tableitem').on('click', '#closetable', function(e) {
            $(this).closest('tr').remove();
            numberRows($(".tableitem"));
        });

        // $('#tableitems').on('click', '#closetable1', function(e) {
        //     $(this).closest('tr .personal').remove();
        //     numberRows($("#tableitem"));
        // });
    })
</script>
@stop