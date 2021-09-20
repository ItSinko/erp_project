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
        <div class="col-lg-12">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Proses</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Analisa</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Sampling</a>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-horizontal">
                                                <div class="form-group row">
                                                    <label for="detail_produk_id" class="col-sm-5 col-form-label" style="text-align:right;">Cari Packing List</label>
                                                    <div class="col-sm-4">
                                                        <div class="select2-info">
                                                            <select class="select2 custom-select form-control @error('packing_list_id') is-invalid @enderror packing_list_id" data-placeholder="Pilih Packing List" data-dropdown-css-class="select2-info" style="width: 80%;" name="packing_list_id" id="packing_list_id">
                                                                <option value=""></option>
                                                                @foreach($pl as $pl)
                                                                <option value="{{$pl->id}}">{{$pl->PoPembelian->nomor}} - {{$pl->nomor}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
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
                                            <label for="no_packing_list" class="col-sm-5 col-form-label">No Packing List</label>
                                            <div class="col-sm-7 col-form-label" style="text-align:right;" id="no_packing_list">

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
                                                <tr>
                                                    <th>#</th>
                                                    <th>Nama Barang</th>
                                                    <th>Jumlah</th>
                                                </tr>
                                            </thead>
                                            <tbody style="text-align:center;">
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">Profile</div>
                <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">Contact</div>
            </div>
        </div>
    </div>

    <div class="row" id="modalinfo">
        <div class="col-12">
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
                    url: 'packing_list/detail/' + id,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        console.log(data);
                        $("#tanggal").text(data["tanggal"]);
                        $("#no_packing_list").text(data["nomor"]);
                        $("#no_po").text(data["po_pembelian"]["nomor"]);
                        $("#supplier").text(data["po_pembelian"]["supplier"]["nama"]);

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
                        data: 'nama_barang',
                        name: 'nama_barang'
                    },
                    {
                        data: 'jumlah',
                        name: 'jumlah'
                    },
                ]
            });

        });
    })
</script>
@stop