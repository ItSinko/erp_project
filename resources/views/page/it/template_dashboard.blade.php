@extends('layouts.app')
@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Template Dashboard</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </div>
        </div>
    </div>
</section>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h3 class="font-weight-bold">Permintaan</h3>
                        <div class="card mb-3" style="max-width: 540px;">
                            <div class="row no-gutters">
                                <div class="col-md-4" style="margin:auto; text-align:center;">
                                    <img src="{{url('assets/image/icon/Perakitan.png')}}" class="karyawan-img-med">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h5 class="card-title">Perakitan</h5>
                                        <p class="card-text">No Referensi BPPB <b>0005/CN01/03/21</b></p>
                                        <p class="card-text"><small class="text-muted">2 jam yang lalu</small></p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card mb-3" style="max-width: 540px;">
                            <div class="row no-gutters">
                                <div class="col-md-4" style="margin:auto; text-align:center;">
                                    <img src="{{url('assets/image/icon/Pengujian.png')}}" class="karyawan-img-med">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h5 class="card-title">Pengujian</h5>
                                        <p class="card-text">No Referensi BPPB <b>0005/CN01/03/21</b></p>
                                        <p class="card-text"><small class="text-muted">Pukul 14.00 Tanggal 15 Maret 2021</small></p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card mb-3" style="max-width: 540px;">
                            <div class="row no-gutters">
                                <div class="col-md-4" style="margin:auto; text-align:center;">
                                    <img src="{{url('assets/image/user/Uci Puspita Sari.jpg')}}" class="karyawan-img-med circle-button">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h5 class="card-title">Pengemasan</h5>
                                        <p class="card-text">No Referensi BPPB <b>0005/CN01/03/21</b></p>
                                        <p class="card-text"><small class="text-muted">Pukul 13.16 Tanggal 15 Maret 2021</small></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h3 class="font-weight-bold">Kalendar</h3>
                        <div class="card-body">
                            <div class="calendar calendar-first" id="calendar_first">
                                <div class="calendar_header">
                                    <button class="switch-month switch-left"> <i class="fa fa-chevron-left"></i></button>
                                    <h2></h2>
                                    <button class="switch-month switch-right"> <i class="fa fa-chevron-right"></i></button>
                                </div>
                                <div class="calendar_weekdays"></div>
                                <div class="calendar_content"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection