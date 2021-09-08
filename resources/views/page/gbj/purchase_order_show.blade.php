@extends('adminlte.page')

@section('title', 'Beta Version')

@section('adminlte_css')
<style>
    .flex-container {
        display: flex;
        flex-wrap: wrap;
    }

    .flex-container>div {
        background-color: #f1f1f1;
        width: 15%;
        margin: 10px;
    }

    .card-subtitle {
        margin-bottom: 0;
    }

    #myInput {
        padding: 20px;
        margin-top: -6px;
        border: 0;
        border-radius: 0;
        background: #f1f1f1;
    }
</style>
@stop

@section('content_header')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Purchase Order</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item active">Purchase Order</li>
                </ol>
            </div>
        </div>
    </div>
</section>
@stop

@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <div class="row" style="margin-bottom:10px;">
                    <div class="col-lg-12">
                        <span class="btn-group  float-right" role="group" aria-label="Button group with nested dropdown">
                            <button type="button" class="btn btn-outline-info"><i class="fas fa-list"></i></button>
                            <button type="button" class="btn btn-outline-info"><i class="fas fa-th"></i></button>
                        </span>
                        <span class="dropdown float-right" id="filter" style="margin-right:5px;">
                            <button class=" btn btn-outline-info dropdown-toggle" type="button" id="dropdownFilter" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Filter
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownFilter">
                                <a class="dropdown-item jenis_po" href="#" id="jenis_po" name="jenis_po" value="semua">Semua</a>
                                <a class="dropdown-item jenis_po" href="#" id="jenis_po" name="jenis_po" value="online">PO Online</a>
                                <a class="dropdown-item jenis_po" href="#" id="jenis_po" name="jenis_po" value="offline">PO Offline</a>
                            </div>
                        </span>
                        <span class="dropdown float-right" id="status" style="margin-right:5px;" hidden>
                            <button class="btn btn-outline-info dropdown-toggle" type="button" id="dropdownStatus" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Status
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownStatus">
                                <a class="dropdown-item status" href="#" id="status" name="status" value="semua">Diproses</a>
                                <a class="dropdown-item status" href="#" id="status" name="status" value="online">Selesai</a>
                            </div>
                        </span>

                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <table class="table table-striped" id="example2">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Distributor</th>
                                    <th>No PO</th>
                                    <th>Tanggal PO</th>
                                    <th>Jenis Penjualan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><input type="checkbox" name="id[]" class="form-check form-label" value="" id="chckbox"></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                        <!-- <div class="flex-container">
                            @foreach($po as $i)
                            <div class="card">
                                <img class="card-img-top" src="https://picsum.photos/300/300.jpg" alt="Card image cap">
                                <div class="card-body">
                                    <h5 class="card-title">{{$i->no_po}}</h5>
                                    <p class="card-text text-muted"><small>{{date('d-m-Y', strtotime($i->tgl_po))}}</small></p>
                                    <p class="card-text"><small>{{ str_limit(strip_tags($i->keterangan), 50) }}
                                            @if (strlen(strip_tags($i->keterangan)) > 50)
                                            ...
                                            @endif</small></p>
                                </div>
                                <div class="card-footer">
                                    <a href="#" class="card-link"><i class="fas fa-pencil-alt"></i></a>
                                    <a href="#" class="card-link"><i class="fas fa-trash"></i></a>
                                </div>
                            </div>
                            @endforeach
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@stop

@section('adminlte_js')
<script>
    $(function() {
        $('#example2').DataTable({
            destroy: true,
            processing: true,
            serverSide: false,
            ajax: "/gudang_produk_gbj/produk/show/" + k,
            columns: [{
                    data: 'checkbox',
                    name: 'checkbox'
                },
                {
                    data: 'no_po',
                    name: 'no_po'
                },
                {
                    data: 'tgl_po',
                    name: 'tgl_po'
                },
                {
                    data: 'jenis_po',
                    name: 'jenis_po'
                },
                {
                    data: 'aksi',
                    name: 'aksi'
                },
            ]
        });
    });
</script>
@stop