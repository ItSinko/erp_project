@extends('adminlte.page')

@section('title', 'QC | Analisa & Sampling')

@section('content_header')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1></h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item active">Packing List</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
@stop

@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="form-horizontal">
                            <div class="form-group row">
                                <label for="detail_produk_id" class="col-sm-5 col-form-label" style="text-align:right;">Tampilan Data</label>
                                <div class="col-sm-4">
                                    <div class="select2-info">
                                        <select class="select2 custom-select form-control @error('analisa_sampling_id') is-invalid @enderror analisa_sampling_id" data-placeholder="Pilih Packing List" data-dropdown-css-class="select2-info" style="width: 80%;" name="analisa_sampling_id" id="analisa_sampling_id">
                                            <option value=""></option>
                                            <option value="all">Semua</option>
                                            <option value="none">Belum Dianalisa</option>
                                            <option value="done">Sudah Dianalisa</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4>Analisa</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@stop