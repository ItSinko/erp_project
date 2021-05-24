@extends('adminlte.page')

@section('title', 'Beta Version')

@section('content_header')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Pengemasan</h1>
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
                                <th>Tipe dan Nama</th>
                                <th>No Seri</th>
                                <th>Operator</th>
                                <th>Tanggal</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody style="text-align:center;">

                        </tbody>
                        <tfoot style="text-align:center;">
                            <tr>
                                <th>No</th>
                                <th>No BPPB</th>
                                <th>Tipe dan Nama</th>
                                <th>No Seri</th>
                                <th>Operator</th>
                                <th>Tanggal</th>
                                <th>Status</th>
                            </tr>
                        </tfoot>
                    </table>
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
            ajax: "{{ route('pengemasan.show.eng')}}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'no_bppb',
                    name: 'no_bppb'
                },
                {
                    data: 'produk',
                    name: 'produk'
                },
                {
                    data: 'no_seri',
                    name: 'no_seri'
                },
                {
                    data: 'operator',
                    name: 'operator'
                },
                {
                    data: 'tanggal',
                    name: 'tanggal'
                },
                {
                    data: 'status',
                    name: 'status'
                },
            ]
        });
    });
</script>
@stop