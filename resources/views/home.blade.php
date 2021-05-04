@extends('adminlte.page')

@section('title', 'Beta Version')

@section('content_header')
<h1 class="m-0 text-dark">Dashboard</h1>
@stop

@section('content')
<div class="row">
    <div class="col-12 col-sm-6 col-md-2">
        <a href="{{ route('dc.dashboard') }}">
            <div class="info-box">
                <span class="info-box-icon"><img src="{{asset(config('settings.system_logo'))}}" alt="Document Image" /></span>
                <div class="info-box-content">
                    <span class="info-box-text">Dokumen SPA</span>
                </div>
            </div>
        </a>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <p class="mb-0">You are logged in!</p>
            </div>
        </div>
    </div>
</div>
@stop