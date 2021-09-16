@extends('adminlte.page')

@section('content_header')
<div class="d-flex justify-content-between">
    <h1>Jadwal Produksi</h1>
    <button-header v-on:view="changeView" />
</div>
@stop

@section('content')
<div>
    <schedule-app events="{{ $event }}" produks="{{ $detail_produk }}" status="{{ $status }}" :view="view" />
</div>
@stop

@section('adminlte_js')
<script src="{{ asset('costum/js/schedule.js') }}"></script>
@stop