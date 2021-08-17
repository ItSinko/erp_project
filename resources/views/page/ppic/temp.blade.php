@extends('adminlte.page')

@section('content_header')
<div class="d-flex justify-content-between">
    <h1>Jadwal Produksi</h1>
    <div class="btn-group" id="view-button">
        <button type="button" data-view="calendar" class="btn btn-primary">Kalender</button>
        <button type="button" data-view="table" class="btn btn-info">Tabel</button>
        <button type="button" data-view="list" class="btn btn-warning">Daftar</button>
    </div>
</div>
@stop

@section('adminlte_css')
<link href='{{ asset("vendor/fullcalendar/main.css") }}' rel='stylesheet' />
<style>
    #calendar {
        padding: 20px;
    }

    /* #table-product tr:hover {
        background-color: yellow;
        cursor: pointer;
    }

    #table-product tr {
        background-color: white;
    } */
</style>
@stop

@section('content')
<div hidden>
    <div id="data-events">{{ $event }}</div>
    <div id="data-product">{{ $detail_produk }}</div>
    <div id="data-status">{{ $status }}</div>
</div>

<div class="alert alert-info" id="status-penyusunan" style="display: none;">
    <h5><i class="icon fas fa-info"></i> Penyusunan </h5>
</div>
<div class="alert alert-primary" id="status-disetujui" style="display: none;">
    <h5><i class="icon far fa-thumbs-up"></i> Disetujui </h5>
</div>
<div class="alert alert-warning" id="status-pelaksanaan" style="display: none;">
    <h5><i class="icon fas fa-hard-hat"></i> Pelaksanaan </h5>
</div>
<div class="alert alert-success" id="status-selesai" style="display: none;">
    <h5><i class="icon fas fa-check"></i> Selesai </h5>
</div>

<div class="row" id="view-calendar">
    <div class="col-md-3 sticky-top">
        <div class="card">
            <div class="card-header">
                <h5 class="text-center">Daftar Produksi</h5>
            </div>
            <div class="card-body">
                <table id="table-product" style="text-align: center;">
                    <thead>
                        <tr>
                            <th>Nama Produk</th>
                            <th>Jumlah Produksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($event as $e)
                        <tr data-id="{{ $e->id }}">
                            <td>{{ $e->nama }}</td>
                            <td>{{ $e->jumlah_produksi }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-9">
        <div class="card">
            <div id="calendar"></div>
        </div>
    </div>
</div>

<div class="modal fade" id="product-modal" tabindex="-1" role="dialog" aria-labelledby="product-modalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="product-modalLabel">Input Produk</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="btn-color" style="margin-bottom: 20px;">
                    <button type="button" class="btn btn-primary" style="padding: 20px"></button>
                    <button type="button" class="btn btn-secondary" style="padding: 20px"></button>
                    <button type="button" class="btn btn-success" style="padding: 20px"></button>
                    <button type="button" class="btn btn-danger" style="padding: 20px"></button>
                    <button type="button" class="btn btn-warning" style="padding: 20px"></button>
                    <button type="button" class="btn btn-info" style="padding: 20px"></button>
                </div>
                <div class="form-group">
                    <label for="product-name">Produk:</label>
                    <select name="product-name" id="product-name" class="form-control select2" data-placeholder="Pilih produk">
                        @foreach ($detail_produk as $d)
                        <option value="{{ $d->id }}">{{ $d->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="product-version">Versi BOM:</label>
                        <select id="product-version" class="form-control select2" data-placeholder="Pilih versi BOM">
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="product-quantity">Jumlah Produk:</label>
                        <input type="number" class="form-control" id="product-quantity">
                        <small id="emailHelp" class="form-text text-muted"></small>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary">Tambah</button>
            </div>
        </div>
    </div>
</div>

@stop

@section('adminlte_js')
<script src="{{ asset('vendor/fullcalendar/main.js') }}"></script>
<script src="{{ asset('vendor/fullcalendar/locales-all.js') }}"></script>
<script src="{{ asset('vendor/bootbox/bootbox.js') }}"></script>

<script>
    function reset_input() {
        $('#product-name').val(null).trigger('change');
        $('#product-version').empty();
        $('#product-quantity').prop('disabled', true);
    }

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    let status = $('#data-status').html();
    let events = JSON.parse($('#data-events').html());
    events = events.length === 0 ? null : events;


    let event_start = null;
    let event_end = null;
    const editable_setting = {
        locale: "id",
        headerToolbar: {
            end: ""
        },
        weekends: false,
        showNonCurrentDates: false,
        selectable: true,
        editable: true,
        events: null,
        select: (selectionInfo) => {
            $('#product-modal').modal('show');
            event_start = new Date(selectionInfo.start);
            event_end = new Date(selectionInfo.end);
        }
    }

    const onlyView_setting = {

    }

    switch (status) {
        case "penyusunan":
            $('#status-penyusunan').show();
            break;
        case "disetujui":
            $('#status-disetujui').show();
            break;
        case "pelaksanaan":
            $('#status-pelaksanaan').show();
            break;
        case "selesai":
            $('#status-selesai').show();
            break;
    }

    $(document).ready(() => {
        let calendarEl = document.getElementById('calendar');
        let calendar = new FullCalendar.Calendar(calendarEl, editable_setting);
        calendar.render();

        reset_input();


        $('#product-name').change((event) => {
            let flag = event.target.value;
            if (flag) {
                $.ajax({
                    url: "/ppic/get-version-bom/" + flag,
                    method: "GET",
                    success: (data) => {
                        $('#product-version').empty();
                        $('#product-quantity').prop('disabled', true);
                        if (data.produk_bill_of_material.length !== 0) {
                            $('#product-quantity').prop('disabled', false);
                            data.produk_bill_of_material.forEach(element => {
                                $('#product-version').append(`
                                <option value="${element.id}">${element.versi}</option>
                            `);
                            });
                        }
                    },
                    error: () => {
                        alert("error");
                    }
                });
            }
        });

        $('#product-version').change(() => {
            console.log('change');
        });

        $('#product-modal').on('hide.bs.modal', () => {
            reset_input();
        });

        $('#product-modal .modal-footer button').click(() => {
            console.log(new Date(event_start));
            $.ajax({
                url: "/ppic/schedule/create",
                data: {
                    id_produk: $('#product-name').val(),
                    bom: $('#product-version').val(),
                    jumlah: $('#product-quantity').val(),
                    start: event_start,
                    end: event_end,
                    color: $('#product-modal .modal-footer button').css('background-color'),
                },
                method: "POST",
                success: (data) => {
                    calendar.addEvent({
                        id: data.id,
                        title: "test",
                        start: event_start,
                        end: event_end,
                        backgroundColor: data.color,
                        borderColor: data.color,
                    });
                    $('#product-modal').modal('hide');
                },
                error: (xhr, status, error) => {
                    console.log(error);
                }
            });
        });

        $('#btn-color > button').click(function() {
            var currColor = $(this).css('background-color');
            $('#product-modal .modal-footer button').css({
                'background-color': currColor,
                'border-color': currColor
            })
        });
    });
</script>
@stop