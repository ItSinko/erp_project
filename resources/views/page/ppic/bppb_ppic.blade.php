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
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example" class="table table-hover styled-table" style="text-align: center;">
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
                <!-- /.card-body -->
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
            paging: false,
            info: false,
            pageLength: -1,
            processing: true,
            serverSide: true,
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
            ]
        });
    });
</script>
@stop