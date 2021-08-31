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
                <div class="row">
                    <div class="float-right">
                        <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown"><i class="fas fa-filter"></i>&nbsp;Filter</button>
                        <span class="caret"></span></button>
                        <ul class="dropdown-menu">
                            <input class="form-control" id="myInput" type="text" placeholder="Search..">
                            <li><a href="#">HTML</a></li>
                            <li><a href="#">CSS</a></li>
                            <li><a href="#">JavaScript</a></li>
                            <li><a href="#">jQuery</a></li>
                            <li><a href="#">Bootstrap</a></li>
                            <li><a href="#">Angular</a></li>
                        </ul>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th><input type="checkbox" id="checkall" class="form-check form-label"></th>
                                    <th>Distributor</th>
                                    <th>No PO</th>
                                    <th>Tanggal PO</th>
                                    <th>Jenis Penjualan</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><input type="checkbox" name="" class="form-check form-label" value=""></td>
                                    <td></td>
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

    });
</script>
@stop