@extends('adminlte.page')

@section('title', 'Beta Version')

@section('content_header')
<h1 class="m-0 text-dark">Document Control</h1>
@stop

@section('adminlte_css')
<link rel="stylesheet" href="{{ asset('vendor/dropzone/dropzone.css') }}">
<style>
    .sidebar_doc {
        margin: 0;
        padding: 0;
        background-color: #f1f1f1;
        overflow: auto;
    }

    .sidebar_doc a {
        display: block;
        color: black;
        padding: 16px;
        text-decoration: none;
    }

    .sidebar_doc a.active {
        background-color: #4CAF50;
        color: white;
    }

    .sidebar_doc a:hover:not(.active) {
        background-color: #555;
        color: white;
    }
</style>
@stop

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <select id="select_product" class="form-control select2" style="width: 50%;" name="product" data-placeholder="Select product name">
                    <option disabled selected value></option>
                    @foreach ($data as $d)
                    <option value="{{ $d->nama }}">{{ $d->nama }}</option>
                    @endforeach
                </select>
            </div>
            <div class="card-body" id="show_doc">
                <div class="row">
                    <div class="col-3 sidebar_doc">
                        @for ($i = 0; $i < count($dokumen); $i++) <a href="#" class="doc">{{ $dokumen[$i]->nama }}</a>
                            @endfor
                    </div>
                    <div class="col-9">
                        <div class="content_doc">
                            <table id="tabel" class="table table-hover styled-table table-striped" style="width: 100%;">
                                <thead style="text-align: center;">
                                    <tr>
                                        <th colspan="12">
                                            <button type="button" class="btn btn-block btn-success btn-sm" style="width: 200px;"><i class="fas fa-plus"></i> &nbsp; Tambah</i></button>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody style="text-align: center;">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



@stop

@section('adminlte_js')
<script src="{{ asset('vendor/bootbox/bootbox.js') }}"></script>
<script src="{{ asset('vendor/dropzone/dropzone.js') }}"></script>
<script>

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).ready(function() {
        // $('#prooduct').selectmenu("refresh", true);
        $('#show_doc').hide();
        $('#tabel').hide();
        $('select[name="product"]').on('change', function() {
            if ($('select[name="product"]').val()) {
                $('#show_doc').show(1000);
            } else {
                $('#show_doc').hide(1000);
            }
        });

        $(".doc").click(function() {
            $('#tabel').show(1000);
            produk = $('select[name="product"]').val();
            doc = this.innerHTML;
            table.ajax.url('/show_list/' + produk + '/' + doc).load();
            console.log(table.ajax.url());
        });

        var table = $('#tabel').DataTable({
            processing: true,
            serverSide: true,
            language: {
                processing: '<i class="fa fa-spinner fa-spin"></i> Tunggu Sebentar'
            },
            ajax: '/show_list',
            columns: [{
                    data: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'nama'
                },
                {
                    data: 'id',
                    render: function(data) {
                        $btn_view = '<div class="inline-flex"><button type="button" id="detail" class="btn btn-block btn-primary karyawan-img-small" style="border-radius:50%;"><i class="fa fa-eye" aria-hidden="true"></i></button>';
                        $btn_edit = '<a href="/penjualan_online_ecom/ubah/' + data + '"><button type="button" class="btn btn-block btn-warning karyawan-img-small" style="border-radius:50%;"  data-target="#edit_mod"><i class="fas fa-edit"></i></button></a>';
                        $btn_hapus = ' <button type="button" class="btn btn-block btn-danger karyawan-img-small" style="border-radius:50%;" data-toggle="modal" data-target="#delete" ><i class="fas fa-trash"></i></button></div>';
                        return $btn_view + $btn_edit + $btn_hapus;
                    },
                    orderable: false,
                    searchable: false
                },
            ]
        });

        $('button').click(function() {
            var box = bootbox.dialog({
                title: "Upload File",
                message: `
                        <div class="form-group">
                            <label for="exampleFormControlFile1">Example file input</label>
                            <input type="file" class="form-control-file" id="file" name="file">
                        </div>
                        `,
                centerVertical: true,
                size: 'large',
                buttons: {
                    ok: {
                        id: "button",
                        className: "btn btn-info",
                        label: "Upload"
                    }
                }
            });

            $('#button').click(function() {
                var fd = new FormData();
                var files = $('#file')[0].files;

                fd.append('file', files[0]);
                fd.append('produk', produk);
                fd.append('doc', doc);
                console.log(files[0]);
                console.log(produk);
                console.log(doc);

                $.ajax({
                    url: "{{ route('eng.fileupload') }}",
                    type: "POST",
                    data: fd,
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        console.log("success");
                        console.log(data);
                    },
                    error: function() {
                        console.log("error");
                    }
                })
            })

            // var CSRF_TOKEN = document.querySelector('meta[name="csrf-token"]').getAttribute("content");

            // Dropzone.autoDiscover = false;
            // var myDropzone = new Dropzone(".dropzone", {
            //     autoProcessQueue: false,
            //     maxFilesize: 5, // 50 mb
            //     acceptedFiles: ".docx,.pdf,.xls",
            // });
            // myDropzone.on("sending", function(file, xhr, formData) {
            //     formData.append("_token", CSRF_TOKEN);
            // });
            // $("#button").click(function(e) {
            //     e.preventDefault();
            //     myDropzone.processQueue();
            // });
        });
    });
</script>
@stop