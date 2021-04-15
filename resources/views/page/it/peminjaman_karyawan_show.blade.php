@extends('adminlte.page')

@section('title', 'Beta Version')

@section('content_header')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Peminjaman Karyawan</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Advanced Form</li>
                </ol>
            </div>
        </div>
    </div>
</section>
@stop


@section('content')
<section class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h2>Peminjaman</h2>
                    <table id="example" class="table table-hover styled-table-small table-striped table-item" style="width:100%;">
                        <thead style="text-align: center;">
                            <tr>
                                <th colspan="20">
                                    <a href="{{route('peminjaman.karyawan.create')}}" style="color: white;"><button type="button" class="btn btn-block btn-success btn-sm" style="width: 200px;"><i class="fas fa-plus"></i> &nbsp; Tambah</i></button></a>
                                </th>
                            </tr>
                            <tr>
                                <th>No</th>
                                <th>PIC</th>
                                <th>Nama Penugasan</th>
                                <th>Tanggal Pembuatan</th>
                                <th>Tanggal Penugasan</th>
                                <th>Tanggal Selesai</th>
                                <th>Keterangan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody style="text-align: center;">

                        </tbody>
                    </table>

                    <div class="modal fade" id="detailmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header" style="background-color:	#006400;">
                                    <h4 class="modal-title" id="myModalLabel" style="color:white;">Penugasan Karyawan</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                </div>
                                <div class="modal-body" id="detail">

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="deletemodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                        <div class="modal-dialog modal-md" role="document">
                            <div class="modal-content">
                                <div class="modal-header" style="background-color:#cc0000;">
                                    <h4 class="modal-title" id="myModalLabel" style="color:white;">Hapus Data</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                </div>
                                <div class="modal-body" id="delete">

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="editdetailmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header" style="background-color:	#FFD700;">
                                    <h4 class="modal-title" id="myModalLabel" style="color:black;">Ubah Penugasan Karyawan</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                </div>
                                <div class="modal-body" id="editdetail">

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
        $('#example').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('peminjaman.karyawan.show') }}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                }, {
                    data: 'penanggung_jawab',
                    name: 'penanggung_jawab'
                },
                {
                    data: 'nama_penugasan',
                    name: 'nama_penugasan'
                },
                {
                    data: 'tanggal_pembuatan',
                    name: 'tanggal_pembuatan'
                },
                {
                    data: 'tanggal_penugasan',
                    name: 'tanggal_penugasan'
                },
                {
                    data: 'tanggal_selesai',
                    name: 'tanggal_selesai'
                },
                {
                    data: 'keterangan',
                    name: 'keterangan'
                },
                {
                    data: 'aksi',
                    name: 'aksi',
                    orderable: false,
                    searchable: false
                },
            ]
        });



        // $(document).on('click', '.deletemodal', function() {
        //     var url = $(this).attr('data-url');
        //     $("#deleteform").attr("action", url);
        // });

        $(document).on('click', '.detailmodal', function(event) {
            event.preventDefault();
            var href = $(this).attr('data-attr');
            var dataid = $(this).attr('data-id');
            $.ajax({
                url: href,
                beforeSend: function() {
                    $('#loader').show();
                },
                // return the result
                success: function(result) {
                    $('#detailmodal').modal("show");
                    $('#detail').html(result).show();
                    console.log(result);
                    $('#detaildata').DataTable({
                        processing: true,
                        serverSide: true,
                        ajax: "/peminjaman/karyawan/detail/show/" + dataid,
                        columns: [{
                                data: 'DT_RowIndex',
                                name: 'DT_RowIndex',
                                orderable: false,
                                searchable: false
                            }, {
                                data: 'karyawan_id',
                                name: 'karyawan_id'
                            },
                            {
                                data: 'keterangan',
                                name: 'keterangan'
                            },
                            {
                                data: 'status',
                                name: 'status'
                            },
                            {
                                data: 'aksi',
                                name: 'aksi',
                                orderable: false,
                                searchable: false
                            },
                        ]
                    });
                },
                complete: function() {
                    $('#loader').hide();
                },
                error: function(jqXHR, testStatus, error) {
                    console.log(error);
                    alert("Page " + href + " cannot open. Error:" + error);
                    $('#loader').hide();
                },
                timeout: 8000
            })
        });

        $(document).on('click', '.editdetailmodal', function(event) {
            event.preventDefault();
            var href = $(this).attr('data-attr');
            $.ajax({
                url: href,
                beforeSend: function() {
                    $('#loader').show();
                },
                // return the result
                success: function(result) {
                    $('#editdetailmodal').modal("show");
                    $('#editdetail').html(result).show();
                    console.log(result);
                },
                complete: function() {
                    $('#loader').hide();
                },
                error: function(jqXHR, testStatus, error) {
                    console.log(error);
                    alert("Page " + href + " cannot open. Error:" + error);
                    $('#loader').hide();
                },
                timeout: 8000
            })
        });

        $(document).on('click', '.deletemodal', function(event) {
            event.preventDefault();
            var href = $(this).attr('data-attr');
            $.ajax({
                url: '/template_form_delete',
                beforeSend: function() {
                    $('#loader').show();
                },
                // return the result
                success: function(result) {
                    $('#deletemodal').modal("show");
                    $('#delete').html(result).show();
                    $("#deleteform").attr("action", href);
                },
                complete: function() {
                    $('#loader').hide();
                },
                error: function(jqXHR, testStatus, error) {
                    console.log(error);
                    alert("Page " + href + " cannot open. Error:" + error);
                    $('#loader').hide();
                },
                timeout: 8000
            })
        });


    });
</script>
@stop