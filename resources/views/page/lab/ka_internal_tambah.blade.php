@extends('adminlte.page')
@section('title', 'Beta Version')
@section('content_header')
<h1 class="m-0 text-dark">Dashboard</h1>
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
            <div class="col-lg-12">
                <form action="/kesehatan/aksi_tambah" method="post" enctype="multipart/form-data">
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
                                                <label for="kondisi" class="col-sm-4 col-form-label" style="text-align:right;">Kalibrasi</label>
                                                <div class="col-sm-8" style="margin-top:7px;">
                                                    <div class="icheck-success d-inline col-sm-4">
                                                        <input type="radio" name="status_vaksin" value="Belum" checked="0">
                                                        <label for="no">
                                                            Internal
                                                        </label>
                                                    </div>
                                                    <div class="icheck-warning d-inline col-sm-4">
                                                        <input type="radio" name="status_vaksin" value="Sudah">
                                                        <label for="sample">
                                                            Eksternal
                                                        </label>
                                                    </div>
                                                    <span class="invalid-feedback" role="alert" id="kondisi-msg"></span>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="keterangan" class="col-sm-4 col-form-label" style="text-align:right;">No Pendaftaran</label>
                                                <div class="col-sm-2">
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-append">
                                                            <span class="input-group-text">LAB-</span>
                                                        </div>
                                                        <input type="number" class="form-control" ">
                                                    </div>
                                                </div>
                                            </div>                                                 
                                                    <table class=" table table-bordered table-striped" style="width:100%" id="user_table">
                                                        <thead>
                                                            <tr>
                                                                <th width="10%">Kalibrasi</th>
                                                                <th width="10%">PIC</th>
                                                                <th width="10%">No Seri</th>
                                                                <th width="10%">Type</th>
                                                                <th width="15%">Nama</th>
                                                                <th width="15%">Distributor</th>
                                                                <th width="1%"></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>
                                                                    <select type="text" class="form-control @error('karyawan_id') is-invalid @enderror select2" name="karyawan_id" style="width:100%">
                                                                        <option value="">Pilih</option>
                                                                        <option value="rsud">Rumah Sakit Umum Daerah (RSUD)</option>
                                                                        <option value="dinkes">Dinas Kesehatan</option>
                                                                        <option value="puskes">Puskesmas</option>
                                                                        <option value="puskes">Personal</option>
                                                                        <option value="lab">Laboratorium</option>
                                                                        <option value="cip">PT Cipta Jaya</option>
                                                                        <option value="pt">Perseorangan Terbatas (PT)</option>
                                                                        <option value="univ">Universitas</option>
                                                                    </select>
                                                                </td>
                                                                <td><select type="text" class="form-control @error('karyawan_id') is-invalid @enderror select2" name="karyawan_id" style="width:100%">
                                                                        <option value="">Pilih</option>
                                                                        @foreach($karyawan as $k)
                                                                        <option value="{{$k->id}}">{{$k->nama}}</option>
                                                                        @endforeach
                                                                    </select></td>
                                                                <td><select type="text" class="form-control @error('karyawan_id') is-invalid @enderror select2" id="barcode" style="width:100%">
                                                                        <option value="">Pilih</option>
                                                                        @foreach($listkalibrasiinternal as $k)
                                                                        <option value="{{$k->kalibrasi_internal_id}}">{{str_replace("/", "", $k->KalibrasiInternal->alias_barcode) . $k->no_barcode}}</option>
                                                                        @endforeach
                                                                    </select></td>
                                                                </td>
                                                                <td><input type="text" placeholder="Type Produk" class="form-control" id="type_produk" readonly></td>
                                                                <td><textarea type="nama" placeholder="Nama Produk" class="form-control" id="nama_produk" readonly></textarea></td>
                                                                <td><textarea type="nama" placeholder="Nama Produk" class="form-control" id="nama" readonly></textarea></td>
                                                                <td><button type="button" name="add" id="add" class="btn btn-success"><i class="nav-icon fas fa-plus-circle"></i></button></td>
                                                            </tr>
                                                        </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <span class="float-left"><a class="btn btn-danger rounded-pill" href="/kesehatan"><i class="fas fa-times"></i>&nbsp;Batal</a></span>
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
<script type="text/javascript">
    var i = 0;
    $("#add").click(function() {
        ++i;
        $("#user_table ").append(`<tr>
                                <td>
                                <select type="text" class="form-control select2" name="" id="kalibrasi_jenis` + i + `" style="width:100%">
                                                                        <option value="">Pilih</option>
                                                                        <option value="rsud">Rumah Sakit Umum Daerah (RSUD)</option>
                                                                        <option value="dinkes">Dinas Kesehatan</option>
                                                                        <option value="puskes">Puskesmas</option>
                                                                        <option value="puskes">Personal</option>
                                                                        <option value="lab">Laboratorium</option>
                                                                        <option value="cip">PT Cipta Jaya</option>
                                                                        <option value="pt">Perseorangan Terbatas (PT)</option>
                                                                        <option value="univ">Universitas</option>
                                                                    </select>
                                </td>
                                <td>
                                <select type="text" class="form-control select2" name="" style="width:100%" id="karyawan` + i + `">
                                                                        <option value="">Pilih</option>
                                                                        @foreach($karyawan as $k)
                                                                        <option value="{{$k->id}}">{{$k->nama}}</option>
                                                                        @endforeach
                                                                        </select> 
                                                                        <td>
                                                                        <select type="text" class="form-control @error('karyawan_id') is-invalid @enderror select2" id="barcode` + i + `" style="width:100%">
                                                                        <option value="">Pilih</option>
                                                                        @foreach($listkalibrasiinternal as $k)
                                                                        <option value="{{$k->kalibrasi_internal_id}}">{{str_replace("/", "", $k->KalibrasiInternal->alias_barcode) . $k->no_barcode}}</option>
                                                                        @endforeach
                                                                    </select></td>
                                                                </td>
                                                                <td><input type="text" placeholder="Type Produk" class="form-control" id="type_produk` + i + `"  "></td>
                                                                <td><textarea type="nama" placeholder="Nama Produk" class="form-control"id="nama_produk` + i + `" readonly></textarea></td>
                                                                <td><textarea type="nama" placeholder="Nama Produk" class="form-control" id="nama" readonly></textarea></td>
                                <td>
                                <button type="button" class="btn btn-danger remove-tr"><i class="fas fa-trash"></i></button>
                                </td>
                                </tr>`);
        $('#kalibrasi_jenis' + i + '').select2({
            placeholder: "Pilih Data",
            allowClear: true,
            theme: 'bootstrap4',
        })
        $('#karyawan' + i + '').select2({
            placeholder: "Pilih Data",
            allowClear: true,
            theme: 'bootstrap4',
        })
        $('#barcode' + i + '').select2({
            placeholder: "Pilih Data",
            allowClear: true,
            theme: 'bootstrap4',
        })

        $(document).ready(function() {
            $('select[id="barcode' + i + '"]').on('change', function() {
                var kalibrasi_internal_id = jQuery(this).val();
                $.ajax({
                    url: '/ka_internal/detail/seri_kalibrasi/' + kalibrasi_internal_id,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        $('input[id="type_produk' + i + '"]').val(data[0]['bppb']['detailproduk']['nama']);
                        $('textarea[id="nama_produk' + i + '"]').val(data[0]['bppb']['detailproduk']['produk']['nama']);
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            });
        });

    });
    $(document).on('click', '.remove-tr', function() {
        let konfirmasi = confirm('Yakin menghapus baris ini ?');
        let pesan = konfirmasi ? $(this).parents('tr').remove() :
            '';
    });
</script>


<script type="text/javascript">
    // function myFunction() {
    //     var x = document.getElementById("tprd");
    //     var add = $("#add");
    //     if (x.value != "") {
    //         add.removeAttr("disabled");
    //     } else {
    //         add.attr("disabled", "disabled");
    //     }
    // }

    $(document).ready(function() {
        $('select[id="barcode"]').on('change', function() {
            var kalibrasi_internal_id = jQuery(this).val();
            $.ajax({
                url: '/ka_internal/detail/seri_kalibrasi/' + kalibrasi_internal_id,
                type: "GET",
                dataType: "json",
                success: function(data) {
                    console.log(data[0]['bppb']['detailproduk']['produk']['nama']);
                    $('input[id="type_produk"]').val(data[0]['bppb']['detailproduk']['nama']);
                    $('textarea[id="nama_produk"]').val(data[0]['bppb']['detailproduk']['produk']['nama']);
                },
                error: function(error) {
                    console.log(error);
                }
            });
        });
    });
</script>
@stop