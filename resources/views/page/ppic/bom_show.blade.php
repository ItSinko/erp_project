@extends('adminlte.page')

@section('title', 'Beta Version')

@section('content_header')
<h1 id="page_header" class="m-0 text-dark">PPIC BOM</h1>
@stop

@section('content')
<div style="display: none">
    <div id="data_produk">{{ $produk }}</div> // get data produk from Controller
    <div id="data_detail_produk">{{ $detail_produk }}</div> // get data detail produk from Controller
    <div id="data_produk_bom">{{ $produk_bom }}</div> // get data produk bom from controller
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-info">
                    <h3 class="card-title"><i class="fa fa-search" aria-hidden="true"></i>&nbsp;Cari BOM</h3>
                </div>
                <div class="form-horizontal" style="padding: 10px;">
                    <div class="form-group row">
                        <label for="produk" class="col-sm-2 col-form-label">Produk</label>
                        <div class="col-sm-8">
                            <select class="form-control  select2" style="width: 30%" data-dropdown-css-class="select2-info" data-placeholder="Pilih Produk" id="produk">
                                <option value=""></option>
                                @foreach($produk as $i)
                                <option value="{{$i->id}}">{{$i->tipe}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="detail_produk" class="col-sm-2 col-form-label">Detail Produk</label>
                        <div class="col-sm-8">
                            <select class="form-control  select2" style="width: 50%" data-dropdown-css-class="select2-info" data-placeholder="Pilih Detail Produk" disabled="disabled" id="detail_produk">
                                <option value=""></option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="versi_bom" class="col-sm-2 col-form-label">Versi BOM</label>
                        <div class="col-sm-8">
                            <select class="form-control select2" style="width: 20%" disabled="disabled" id="versi_bom">>
                                <option value=""></option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card" id="table-card" style="display: none;">
                <div class="card-body">
                    <table id="table-bom" class="table table-hover styled-table table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Jumlah</th>
                                <th>Stok</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                    <div class="table-footer" style="display: flex; justify-content: space-between; align-items: center;">
                        <h1></h1>
                        <button class="btn btn-info btn-block"></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('adminlte_js')
<script src="{{ asset('vendor/bootbox/bootbox.js') }}"></script>
<script>
    $(document).ready(function() {
        var produk = JSON.parse($('#data_produk').html());
        var detail_produk = JSON.parse($('#data_detail_produk').html());
        var produk_bom = JSON.parse($('#data_produk_bom').html());

        $('#produk').change(function() {
            $('#versi_bom').prop('disabled', true);
            $('#detail_produk').empty();
            let temp = detail_produk.filter(x => x.produk_id == this.value);
            if (temp.length == 0) {
                bootbox.alert({
                    verticalCenter: true,
                    message: "BOM belum tersedia",
                });
            } else {
                $('#detail_produk').append(`<option value=""></option>`);
                for (var i in temp) {
                    $('#detail_produk').append(`<option value="${temp[i].id}">${temp[i].nama}</option>`);
                }
                $('#detail_produk').prop('disabled', false);
            }
            $('#table-card').hide();
        });

        $('#detail_produk').change(function() {
            let temp = produk_bom.filter(x => x.detail_produk_id == this.value);
            $('#versi_bom').attr('data-detail_produk_id', this.value);
            $('#versi_bom').empty();
            $('#versi_bom').append(`<option value=""></option>`);
            for (var i in temp) {
                $('#versi_bom').append(`<option value="${temp[i].versi}">Versi ${temp[i].versi}</option>`);
            }
            $('#versi_bom').prop('disabled', false);
            $('#table-card').hide();
        });

        let initialize = false;
        let table;
        $('#versi_bom').change(function() {
            let versi = this.value;
            let detail_produk_id = this.dataset.detail_produk_id;
            console.log("print this object");;
            console.log(this);
            if (!initialize) {
                initialize = true;
                table = $('#table-bom').DataTable({
                    paging: false,
                    info: false,
                    pageLength: -1,
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: '/ppic/get_item_bom',
                        data: {
                            detail_produk_id: detail_produk_id,
                            versi: versi,
                        },
                    },
                    columns: [{
                            data: 'DT_RowIndex',
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: 'nama'
                        },
                        {
                            data: 'jumlah'
                        },
                        {
                            data: 'stok'
                        }
                    ]
                });
                $.ajax({
                    url: '/ppic/get_item_bom',
                    method: 'GET',
                    data: {
                        detail_produk_id: detail_produk_id,
                        versi: versi,
                        count: true,
                    },
                    success: function(response) {
                        $('.table-footer button').html(`Maksimum perakitan: ${response}`);
                    },
                    error: function() {
                        alert("error");
                    }
                })
            } else {
                initialize = false;
                table.destroy();
            }
            $('#table-card').show();
        });
    })
</script>
@stop