@extends('adminlte.page')

@section('title', 'Beta Version')

@section('content_header')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1></h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item active">Packing List</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
@stop

@section('content')
<section class="content">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="form-horizontal">
                        <div class="form-group row">
                            <label for="detail_produk_id" class="col-sm-5 col-form-label" style="text-align:right;">Cari Packing List</label>
                            <div class="col-sm-4">
                                <div class="select2-info">
                                    <select class="select2 custom-select form-control @error('packing_list_id') is-invalid @enderror packing_list_id" data-placeholder="Pilih Packing List" data-dropdown-css-class="select2-info" style="width: 80%;" name="packing_list_id" id="detail_produk_id">
                                        <option value=""></option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row" id="rowinfo" hidden>
        <div class="col-3">
            <div class="card">
                <div class="card-body">
                    <h4>Informasi</h4><br>
                    <div class="form-horizontal">
                        <div class="row">
                            <label for="no_packing_list" class="col-sm-6 col-form-label">No Packing List</label>
                            <div class="col-sm-6 col-form-label" style="text-align:right;" id="no_packing_list">

                            </div>
                        </div>

                        <div class="row">
                            <label for="no_po" class="col-sm-4 col-form-label">No PO</label>
                            <div class="col-sm-8 col-form-label" style="text-align:right;" id="no_po">

                            </div>
                        </div>

                        <div class="row">
                            <label for="supplier" class="col-sm-6 col-form-label">Supplier</label>
                            <div class="col-sm-6 col-form-label" style="text-align:right;" id="supplier">

                            </div>
                        </div>

                        <div class="row">
                            <label for="tanggal" class="col-sm-6 col-form-label">Tanggal</label>
                            <div class="col-sm-6 col-form-label" style="text-align:right;" id="tanggal">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-9">
            <div class="card">
                <div class="card-body">
                    <h4>Packing List</h4><br>
                    <div class="table-responsive">
                        <table id="example1" class="table table-hover table-striped styled-table" style="width:100%;">
                            <thead style="text-align: center;">
                                <tr style="text-align: right;">
                                    <th colspan="12"><button class="btn btn-sm btn-success" id="tambahlaporan" disabled><i class="fas fa-plus"></i>&nbsp; Tambah Pengemasan</button></th>
                                </tr>
                                <tr>
                                    <th>#</th>
                                    <th>Kode Barang</th>
                                    <th>Nama Barang</th>
                                    <th>Jumlah</th>
                                    <th>Keterangan</th>
                                </tr>
                            </thead>
                            <tbody style="text-align:center;">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="monitoringprosesmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header" style="background-color:	#006400;">
                            <h4 class="modal-title" id="myModalLabel" style="color:white;">Laporan</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="modal-body" id="monitoringproses">

                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="pemeriksaanprosesmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header" style="background-color:	#006400;">
                            <h4 class="modal-title" id="myModalLabel" style="color:white;">Laporan</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="modal-body" id="pemeriksaanproses">

                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="deletemodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog modal-md" role="document">
                    <div class="modal-content">
                        <div class="modal-header" style="background-color:#cc0000;">
                            <h4 class="modal-title" id="myModalLabel" style="color:white;">Hapus Laporan</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="modal-body" id="delete">

                        </div>
                    </div>
                </div>
            </div>

            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</section>
@endsection

@section('adminlte_js')
<script>
    $(function() {
        $('select[name="packing_list_id"]').on('change', function() {
            var id = jQuery(this).val();
            console.log(id);
            if (id != "") {
                id = id;
                $('#rowinfo').removeAttr('hidden');
                $.ajax({
                    url: 'detail/' + id,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        $("#tanggal").text(data["tanggal"]);
                        $("#no_packing_list").text(data["nomor"]);
                        $("#no_po").text(data["purchase_order"][0]);
                        $("#supplier").text("");
                        console.log(data)
                    }
                });
            } else {
                id = "0";
                $('#rowinfo').attr('hidden', true);
                $("#tanggal").text("");
                $("#no_packing_list").text("");
                $("#no_po").text("");
                $("#supplier").text("");
            }
            $('#example1').DataTable({
                destroy: true,
                processing: true,
                serverSide: false,
                ajax: "/kedatangan/packing_list/show/" + id,
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'kode_barang',
                        name: 'kode_barang'
                    },
                    {
                        data: 'nama_barang',
                        name: 'nama_barang'
                    },
                    {
                        data: 'jumlah',
                        name: 'jumlah'
                    },
                    {
                        data: 'keterangan',
                        name: 'keterangan'
                    },
                ]
            });

        });
    })
</script>
@stop