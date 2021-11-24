@extends('adminlte.page')

@section('title', 'Beta Version')

@section('content_header')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Produk Penjualan</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item active">Produk Penjualan</li>
                </ol>
            </div>
        </div>
    </div>
</section>
@stop

@section('adminlte_css')
<style>
    #tablecustom td:nth-child(1),
    td:nth-child(2),
    td:nth-child(4),
    td:nth-child(7) {
        text-align: center;
    }

    #tablecustom {
        font-family: 'Roboto';
    }

    .search {
        color: #F1F1F1
    }
</style>
@endsection

@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row" style="margin-bottom:10px;">
                            <div class="col-lg-12 col-md-12">
                                <span class="btn-group  float-right" role="group" aria-label="Button group with nested dropdown">
                                    <button type="button" class="btn btn-outline-info active" id="tablebtn"><i class="fas fa-list"></i></button>
                                    <button type="button" class="btn btn-outline-info" id="gridbtn"><i class="fas fa-th"></i></button>
                                </span>
                                <span class="dropdown float-right" id="filter" style="margin-right:5px;">
                                    <button class=" btn btn-outline-info dropdown-toggle" type="button" id="dropdownFilter" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Filter
                                    </button>

                                    <ul id="filter_dd" class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownFilter">
                                        <li class="dropdown-header">Kategori</li>
                                        <li><span class="dropdown-item kategori" id="kategori" name="kategori"><input type="checkbox" class="col-form-label"> Alat Kesehatan</span></li>
                                        <li><span class="dropdown-item kategori" id="kategori" name="kategori"><input type="checkbox" class="col-form-label"> Sarana Kesehatan</span></li>
                                        <li><span class="dropdown-item kategori" id="kategori" name="kategori"><input type="checkbox" class="col-form-label"> Aksesoris</span></li>
                                        <li><span class="dropdown-item kategori" id="kategori" name="kategori"><input type="checkbox" class="col-form-label"> Lain - lain</span></li>
                                        <li class="dropdown-divider"></li>
                                        <li class="dropdown-header">Stok</li>
                                        <li><span class="dropdown-item jumlahstok" id="jumlahstok" name="jumlahstok"><input type="checkbox" class="col-form-label"> Tersedia</span></li>
                                        <li><span class="dropdown-item jumlahstok" id="jumlahstok" name="jumlahstok"><input type="checkbox" class="col-form-label"> Hampir Habis</span></li>
                                        <li><span class="dropdown-item jumlahstok" id="jumlahstok" name="jumlahstok"><input type="checkbox" class="col-form-label"> Tidak Tersedia</span></li>
                                    </ul>
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
                            <div class="col-lg-12 col-md-12">
                                <div class="table-responsive">
                                    <table class="table" id="tablecustom">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Merk</th>
                                                <th>Nama Produk</th>
                                                <th>Kelompok</th>
                                                <th>Harga</th>
                                                <th>Stok</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>Elitech</td>
                                                <td>FOX-BABY Yellow</td>
                                                <td><span class="info-text badge">Alat Kesehatan</span></td>
                                                <td><span>Rp.</span><span class="float-right tabular-nums">@currency(1111111)</span></td>
                                                <td><span class="float-right tabular-nums">@stock(15)</span></td>
                                                <td><i class="fas fa-search"></i></td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td>Elitech</td>
                                                <td>FOX-BABY Blue</td>
                                                <td><span class="info-text badge">Alat Kesehatan</span></td>
                                                <td><span>Rp.</span><span class="float-right tabular-nums">@currency(2000000)</span></td>
                                                <td><span class="float-right tabular-nums">@stock(15)</span></td>
                                                <td><i class="fas fa-search"></i></td>
                                            </tr>
                                            <tr>
                                                <td>3</td>
                                                <td>Elitech</td>
                                                <td>FOX-BABY Pink</td>
                                                <td><span class="info-text badge">Alat Kesehatan</span></td>
                                                <td><span>Rp.</span><span class="float-right tabular-nums">@currency(21546000)</span></td>
                                                <td><span class="float-right tabular-nums">@stock(15)</span></td>
                                                <td><i class="fas fa-search"></i></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@stop