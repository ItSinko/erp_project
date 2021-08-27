@extends('adminlte.page')

@section('title', 'Beta Version')

@section('content_header')
<h1 class="m-0 text-dark">Stok GBMP</h1>
@stop

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class='table-responsive'>
                    <table id="tabel" class="table table-hover styled-table table-striped">
                        <thead style="text-align: center;">
                            <tr>
                                <th colspan="12">
                                    <a href="/gbmp/input-form" style="color: white;"><button type="button" class="btn btn-block btn-success btn-sm" style="width: 200px;"><i class="fas fa-plus"></i> &nbsp; Tambah</i></button></a>
                                </th>
                            </tr>
                            <tr>
                                <th>No</th>
                                <th>Kode</th>
                                <th>Jumlah</th>
                            </tr>
                        </thead>
                        <tbody style="text-align: center;">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
@section('adminlte_js')
<script>
    $(function() {
        var tabel = $('#tabel').DataTable({
            processing: true,
            serverSide: true,
            language: {
                processing: '<i class="fa fa-spinner fa-spin"></i> Tunggu Sebentar'
            },
            ajax: '/gbmp/data-part-order',
            columns: [{
                    data: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'kode'
                },
                {
                    data: 'nama'
                },
            ]
        });
    });
</script>
@endsection