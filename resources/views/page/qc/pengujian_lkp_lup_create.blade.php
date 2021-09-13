@extends('adminlte.page')

@section('title', 'Beta Version')

@section('content_header')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>LKP dan LUP</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item"><a href="/pengujian">Pengujian</a></li>
                    <li class="breadcrumb-item active">LKP dan LUP</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
@stop

@section('content')
<section class="content">
    <div class="row">
        <div class="col-3">
            <div class="card">
                <div class="card-body">
                    <h3><i class="fas fa-info-circle"></i>&nbsp;Informasi</h3><br>
                    <div class="form-horizontal">
                        <div class="row">
                            <label for="no_seri" class="col-sm-6 col-form-label">No BPPB</label>
                            <div class="col-sm-6 col-form-label" style="text-align:right;">
                                {{$b->no_bppb}}
                            </div>
                        </div>

                        <div class="row">
                            <label for="no_seri" class="col-sm-4 col-form-label">Produk</label>
                            <div class="col-sm-8 col-form-label" style="text-align:right;">
                                {{$b->DetailProduk->nama}}
                            </div>
                        </div>

                        <div class="row">
                            <label for="tanggal" class="col-sm-6 col-form-label">Tanggal</label>
                            <div class="col-sm-6 col-form-label" style="text-align:right;">
                                {{date("d-m-Y", strtotime($b->tanggal_bppb))}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-9">
            @if(session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong><i class="fas fa-check"></i></strong> {{session()->get('success')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @elseif(session()->has('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong><i class="fas fa-times"></i></strong> {{session()->get('error')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @elseif(count($errors) > 0)
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong><i class="fas fa-times"></i></strong> Lengkapi data terlebih dahulu
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif
            <div class="card">
                <div class="card-header bg-info"><i class="fas fa-plus"></i> Tambahkan</div>
                <div class="card-body">
                    <form action="{{route('pengujian.lkp_lup.store', ['id' => $id])}}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-horizontal">
                                    <div class="form-group row">
                                        <label for="tanggal_pengujian" class="col-sm-5 col-form-label" style="text-align:right;">Tanggal Pengujian</label>
                                        <div class="col-sm-7">
                                            <input type="date" class="form-control" name="tanggal_pengujian" id="tanggal_pengujian" value="" style="width: 30%;">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="tanggal_expired" class="col-sm-5 col-form-label" style="text-align:right;">Berlaku s/d Tanggal</label>
                                        <div class="col-sm-7">
                                            <input type="date" class="form-control" name="tanggal_expired" id="tanggal_expired" value="" style="width: 30%;" readonly>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="tanggal_expired" class="col-sm-5 col-form-label" style="text-align:right;">No Seri</label>
                                        <div class="col-sm-7">
                                            <input type="text" class="form-control" name="tanggal_expired" id="tanggal_expired" value="" style="width: 50%;" readonly>
                                        </div>
                                    </div>
                                </div>

                                @foreach($f as $i)
                                <h4>{{$i->nama_pengecekan}}</h4>
                                <div class="form-horizontal">
                                    <div class="form-group row">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    @foreach($i->AcuanLkpLup as $j)
                                                    <th>{{$j->nama_parameter}}</th>
                                                    @endforeach
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($i->AcuanLkpLup as $j)
                                                @foreach($j->ParameterLkpLup as $k)
                                                <tr>
                                                    @foreach($i->AcuanLkpLup as $j)
                                                    @if($j->id == $k->acuan_lkp_lup_id)
                                                    <td>{{$k->nilai_parameter}}</td>
                                                    @else
                                                    <td>
                                                        <div class="form-group row">
                                                            <div class="col-sm-12">
                                                                <input type="text" class="form-control" name="{{$k}}" id="{{$k}}" value="">
                                                            </div>
                                                        </div>
                                                    </td>
                                                    @endif
                                                    @endforeach
                                                </tr>
                                                @endforeach
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                                @endforeach
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@stop