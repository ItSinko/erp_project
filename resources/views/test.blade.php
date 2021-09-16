@extends('adminlte.page')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div id="app">
                        <Test />
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@section('adminlte_js')
<script src="{{ asset('costum/js/ppic.js') }}"></script>
@stop