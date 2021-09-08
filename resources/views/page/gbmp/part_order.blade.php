@extends('adminlte.page')

@section('title', 'Beta Version')

@section('content_header')
<h1 class="m-0 text-dark">Stok GBMP</h1>
@stop

@section('content')
<div hidden>
    <div id="data">{{ $data }}</div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class='table-responsive'>
                    <table id="tabel" class="table table-hover styled-table table-striped">
                        <thead style="text-align: center;">
                            <tr>
                                <th>No</th>
                                <th>Produk</th>
                                <th>Detail</th>
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

<div class="modal fade" id="modal-detail">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h4 class="modal-title w-100 font-weight-bold">Detail</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
                <table id="table-detail" class="table table-hover styled-table table-striped" style="width: 100%;">
                    <thead style="text-align: center;">
                        <tr>
                            <th>No</th>
                            <th>Kode</th>
                            <th>Nama</th>
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

@stop
@section('adminlte_js')
<script>
    let data = JSON.parse($('#data').html());
    let index = 1;
    data.forEach((element, index) => {
        $('#tabel tbody').append(`
            <tr>
                <td>${index+1}</td>
                <td>${element.detail_produk.nama}</td>
                <td><a data-toggle="modal" data-target="#modal-detail" data-id=${element.produk_bill_of_material_id}>
                    <button type="button" class="rounded-pill btn btn-sm btn-info">
                        <span style="color:white;"><i class="fa fa-search" aria-hidden="true"></i>&nbsp;Detail</span>
                    </button>
                </a></td>
            </tr>
        `);
    });

    // var table = $('#example').DataTable();
    $('a[data-target="#modal-detail"]').click(function() {
        $('#table-detail').DataTable().destroy();
        $("#table-detail").DataTable({
            processing: true,
            serverSide: true,
            paging: false,
            info: false,
            searching: false,
            ajax: '/api/bom-table/' + this.dataset.id,
            columns: [{
                    data: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'kode_gudang'
                },
                {
                    data: 'nama_gudang'
                },
                {
                    data: 'jumlah'
                },
            ]
        });
    });
</script>
@endsection