@extends('adminlte.page')

@section('title', 'Beta Version')

@section('content_header')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Persiapan Packing Produk</h1>
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
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table id="example" class="table table-hover styled-table">
                        <thead style="text-align: center;">
                            <tr>
                                <th>No</th>
                                <th>No BPPB</th>
                                <th>Produk</th>
                                <th>Jumlah</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody style="text-align:center;">

                        </tbody>
                        <tfoot style="text-align:center;">
                            <tr>
                                <th>No</th>
                                <th>No BPPB</th>
                                <th>Produk</th>
                                <th>Jumlah</th>
                                <th>Aksi</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            <div class="modal fade" id="persiapanpackingprodukmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header" style="background-color:	#006400;">
                            <h4 class="modal-title" id="myModalLabel" style="color:white;">Persiapan Packing</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="modal-body" id="persiapanpackingproduk">

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
        $('#example').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('persiapan_packing_produk.show') }}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'dokumen',
                    name: 'dokumen'
                },
                {
                    data: 'ketersediaan',
                    name: 'ketersediaan'
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

        $(document).on('click', '.persiapanpackingprodukmodal', function(event) {
            event.preventDefault();
            var href = $(this).attr('data-attr');
            var dataid = $(this).attr('data-id');
            $.ajax({
                url: href,
                beforeSend: function() {
                    $('#loader').show();
                },
                success: function(result) {
                    $('#persiapanpackingprodukmodal').modal("show");
                    $('#persiapanpackingproduk').html(result).show();
                    console.log(result);
                    $('#detaildata').DataTable({
                        processing: true,
                        serverSide: true,
                        ajax: '/persiapan_packing_produk/detail/show/' + dataid,
                        columns: [{
                                data: 'DT_RowIndex',
                                name: 'DT_RowIndex',
                                orderable: false,
                                searchable: false
                            }, {
                                data: 'dokumen',
                                name: 'dokumen'
                            },
                            {
                                data: 'ketersediaan',
                                name: 'ketersediaan'
                            },
                            {
                                data: 'keterangan',
                                name: 'keterangan'
                            },
                            {
                                data: 'ukuran',
                                name: 'ukuran'
                            },
                            {
                                data: 'model',
                                name: 'model'
                            },
                            {
                                data: 'warna_kertas',
                                name: 'warna_kertas'
                            },
                            {
                                data: 'warna_tinta',
                                name: 'warna_tinta'
                            },
                            {
                                data: 'verifikasi',
                                name: 'verifikasi'
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
    });
</script>
@endsection