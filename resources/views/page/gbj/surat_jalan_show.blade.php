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
</style>
@stop

@section('content_header')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Gudang Produk</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item active">Gudang Produk</li>
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
                    <div class="float-right" width="100%">
                        <select class="select2 select-info form-control" name="" id="" placeholder="Urutkan" width="100%"></select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="flex-container">
                            @for($i = 0; $i < 15; $i++) <div class="card">
                                <img class="card-img-top" src="https://picsum.photos/300/200.jpg" alt="Card image cap">
                                <div class="card-body">
                                    <h5 class="card-title">PO</h5>
                                    <h6 class="card-subtitle text-muted">PT. Emiindo Jaya Bersama</h6>
                                    <p><small class="card-text"></small></p>
                                    <span>
                                        <a href=""><i class="fas fa-pencil-alt"></i></a>
                                        <a href=""><i class="fas fa-trash"></i></a>
                                    </span>
                                </div>
                        </div>
                        @endfor
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</section>
@stop