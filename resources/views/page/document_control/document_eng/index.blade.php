@extends('page.document_control.layouts.app')
@section('title', 'Engineering')
@section('css')
<link rel="stylesheet" href="{{asset('vendor/dropzone/dropzone.css')}}">
<style>
    .menu li {
        position: relative;
        display: block;
        color: #000;
        padding: 8px 16px;
        text-decoration: none;
    }

    .menu li:hover {
        background-color: #0099cc;
    }

    .dropright-content {
        display: none;
        position: absolute;
        top: 0;
        right: auto;
        left: 100%;
        background-color: #f9f9f9;
        min-width: 160px;
        box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
        padding: 0;
        z-index: 1;
    }

    .menu ul {
        list-style-type: none;
        margin: 0;
        padding: 0;
        background-color: #f1f1f1;
    }

    .menu li:hover .dropright-content {
        display: block;
    }
</style>
@stop

@section('content')
<section class="content-header">
    <h1>Dokumen Enggineering</h1>
    <div style="text-align: center;">
        <select id="select-product" class="form-control select2" style="width: 50%;" name="product" data-placeholder="Pilih nama produk..">
            <option disabled selected value></option>
            @foreach ($data as $d)
            <option value="{{ $d->nama }}">{{ $d->nama }}</option>
            @endforeach
        </select>
    </div>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-default">
                <div class="box-body" style="padding: 0;">
                    <div class="col-md-3" style="padding: 0;">
                        <div class="menu">
                            <ul>
                                <li>
                                    SOP
                                    <div class="dropright-content menu">
                                        <ul>
                                            <li>v1</li>
                                            <li>v2</li>
                                            <li>v3</li>
                                            <li>v4</li>
                                        </ul>
                                    </div>
                                </li>
                                <li>Packing List
                                    <div class="dropright-content menu">
                                        <ul>
                                            <li>v1</li>
                                            <li>v2</li>
                                            <li>v3</li>
                                            <li>v4</li>
                                        </ul>
                                    </div>
                                </li>
                                <li>Manual Book Inggris
                                    <div class="dropright-content menu">
                                        <ul>
                                            <li>v1</li>
                                            <li>v2</li>
                                            <li>v3</li>
                                            <li>v4</li>
                                        </ul>
                                    </div>
                                </li>
                                <li>Manual Book Indonesia</li>
                                <li>LKP</li>
                                <li>Bill of Material</li>
                                <li>Alat Kerja</li>
                                <li>IK perakitan</li>
                                <li>Change Log</li>
                                <li>AKD</li>
                                <li>Manajemen Resiko</li>
                            </ul>
                        </div>

                    </div>
                    <div class="col-md-9" style="padding: 0;" id="body-content">
                        <form action="/" class="dropzone dz-drag-hover .dz-clickable" id="my-awesome-dropzone">
                            <input type="file" name="file">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@stop

@section('scripts')
<script src="{{ asset('/vendor/dropzone/dropzone.js') }}"></script>
<script>
    $('.content').hide();
    $('#body-content').hide();
    $('#select-product').change(function() {
        $('.content').hide();
        $('.content').show(1000);
    });

    $('li').click(function() {
        $('#body-content').hide();
        $('#body-content').show(500);
    });

    $('div#my-awesome-dropzone').dropzone();
</script>
@stop