@extends('adminlte.page')

@section('title', 'Beta Version')

@section('content_header')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>BPPB</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">DataTables</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
@stop

@section('content')
<div hidden>
    <div id="data_status">{{ $status }}</div>
</div>
<section class="content">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table id="bppb_table" class="table table-hover styled-table" style="text-align: center;">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>No BPPB</th>
                                <th>Gambar</th>
                                <th>Produk</th>
                                <th>Jumlah</th>
                                <th>Status</th>
                                <th>Laporan</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>

                    </table>
                </div>
            </div>
            <div class="modal fade" id="detail_bom" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header" style="background-color:	#006400;">
                            <h4 class="modal-title" id="myModalLabel" style="color:white;">Laporan</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="modal-body">
                            <table id="bom-table" class="table table-hover styled-table" style="text-align: center;">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Kode</th>
                                        <th>Jumlah</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
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
        $('#bppb_table').DataTable({
            paging: false,
            info: false,
            pageLength: -1,
            ajax: {
                url: "{{ route('bppb.show') }}",
                data: {
                    status: $('#data_status').html(),
                }
            },
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                }, {
                    data: 'tanggal_bppb',
                    name: 'tanggal_bppb'
                },
                {
                    data: 'no_bppb',
                    name: 'no_bppb'
                },
                {
                    data: 'gambar',
                    name: 'gambar'
                },
                {
                    data: 'produk',
                    name: 'produk'
                },
                {
                    data: 'jumlah',
                    name: 'jumlah'
                },
                {
                    data: 'status',
                    name: 'status'
                },
                {
                    data: 'laporan',
                    name: 'laporan',
                    orderable: false,
                    searchable: false
                },
            ],
        });

        console.log("add event handler");
        $(document).on('click', '.detail_bom_class', function(event) {
            console.log("click button");
            $.ajax({
                url: "/ppic/get_item_bom",
                data: {
                    detail_produk_id: event.target.dataset.detail_produk_id,
                    versi: event.target.dataset.versi_bom,
                    option: "detail_bppb",
                },
                success: function(response) {
                    // console.log(response);
                    console.log($("#bom-table > tbody"));
                    console.log("initial iteration");
                    $("#bom-table > tbody").empty();
                    for (let i = 0; i < response.data.length; i++) {
                        $("#bom-table > tbody").append(`
                            <tr>
                                <td>${response.data[i].DT_RowIndex}</td>
                                <td>${response.data[i].nama}</td>
                                <td>${response.data[i].kode}</td>
                                <td>${response.data[i].jumlah * event.target.dataset.jumlah}</td>
                            </tr>
                        `)
                    }
                }
            })
        });
    });
</script>
@stop