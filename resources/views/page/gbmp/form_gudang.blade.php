@extends('layouts.base')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Gudang Input From</h1>
                </div>
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="card card-primary">
            <form id="form_gudang">
                <div class="card-header">
                    <h3 class="card-title">Input Data</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="form-row">
                        <div class="form-group col-4">
                            <label for="">Kode Barang</label>
                            <input type="text" id="kode" name="kode" class="form-control" placeholder="kode">
                            <span class="text-danger" id="kode-error"></span>
                        </div>
                        <div class="form-group col-4">
                            <label for="">Klasifikasi Barang</label>
                            <input type="text" id="klasifikasi" name="klasifikasi" class="form-control" placeholder="klasifikasi">
                            <span class="text-danger" id="klasifikasi-error"></span>
                        </div>
                        <div class="form-group col-4">
                            <label for="">Nama Barang</label>
                            <input type="text" id="nama" name="nama" class="form-control" placeholder="nama">
                            <span class="text-danger" id="nama-error"></span>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-4">
                            <label for="">Stok Barang</label>
                            <input type="text" id="jumlah" name="jumlah" class="form-control" placeholder="jumlah">
                            <span class="text-danger" id="jumlah-error"></span>
                        </div>
                        <div class="form-group col-4">
                            <label for="">Satuan</label>
                            <input type="text" id="satuan" name="satuan" class="form-control" placeholder="satuan">
                            <span class="text-danger" id="satuan-error"></span>
                        </div>
                        <div class="form-group col-4">
                            <label for="">Harga Barang</label>
                            <input type="text" id="harga" name="harga" class="form-control" placeholder="layout">
                            <span class="text-danger" id="harga-error"></span>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <input type="submit" value="submit" class="btn btn-primary" id="button">
                </div>
            </form>
        </div>
    </section>
</div>
@endsection
@push('script')
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $(document).ready(function(){
        $("#form_gudang").on("submit", function(){
            bootbox.alert();
            alert("test");
            $("#kode-error").text("");
            $("#klasifikasi-error").text("");
            $("#nama-error").text("");
            $("#jumlah-error").text("");
            $("#satuan-error").text("");
            $("#harga-error").text("");

            kode = $("#kode").val();
            klasifikasi = $("#klasifikasi").val();
            nama = $("#nama").val();
            jumlah = $("#jumlah").val();
            satuan = $("#satuan").val();
            harga = $("#harga").val();

            $.ajax({
                url: "/submit_gudang_form",
                type: "POST",
                data: {
                    kode: kode,
                    klasifikasi: klasifikasi,
                    nama: nama,
                    jumlah: jumlah,
                    satuan: satuan,
                    harga: harga
                },
                success:  function(response){
                    bootbox.alert({
                        message: response.success,
                        centerVertical: true
                    });
                    $("#form_gudang")[0].reset();
                },
                error: function(response){
                    $('#kode-error').text(response.responseJSON.errors.kode);
                    $('#klasifikasi-error').text(response.responseJSON.errors.klasifikasi);
                    $('#nama-error').text(response.responseJSON.errors.nama);
                    $('#jumlah-error').text(response.responseJSON.errors.jumlah);
                    $('#satuan-error').text(response.responseJSON.errors.satuan);
                    $('#harga-error').text(response.responseJSON.errors.harga);
                }
            })
        });
    });
</script>
@endpush