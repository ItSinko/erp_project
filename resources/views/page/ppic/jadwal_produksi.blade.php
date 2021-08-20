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

    #table-product tbody tr:hover {
        background-color: yellow;
        cursor: pointer;
    }
</style>
@stop

@section('content')
<div hidden>
    <div id="data-events">{{ $event }}</div>
    <div id="data-product">{{ $detail_produk }}</div>
    <div id="data-status">{{ $status }}</div>
    <div id="data-user">{{ Auth::user() }}</div>
</div>

<div class="alert alert-info" id="status-penyusunan" style="display: none;">
    <h5><i class="icon fas fa-info"></i> Penyusunan </h5>
</div>
<div class="alert alert-warning" id="status-pelaksanaan" style="display: none;">
    <h5><i class="icon fas fa-hard-hat"></i> Pelaksanaan </h5>
</div>
<div class="alert alert-success" id="status-selesai" style="display: none;">
    <h5><i class="icon fas fa-check"></i> Selesai </h5>
</div>

<div class="row" id="view-calendar">
    <div class="col-md-3">
        <div class="card">
            <div class="card-header">
                <h5 class="text-center">Daftar Produksi</h5>
            </div>
            <div class="card-body">
                <table id="table-product" class="table text-center">
                    <thead>
                        <tr>
                            <th>Nama Produk</th>
                            <th>Jumlah Produksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($event as $e)
                        <tr data-id="{{ $e->id }}">
                            <td>{{ $e->DetailProduk->nama }}</td>
                            <td>{{ $e->jumlah_produksi }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <button class="btn btn-block btn-info" id="btn-confirmation" style="display: none;">Konfirmasi</button>
        <button class="btn btn-block btn-danger" id="btn-confirmation-cancel" style="display: none;">Batal konfirmasi</button>
        <button class="btn btn-block btn-success" id="btn-bppb" style="display: none;">Kirim BPPB</button>
    </div>
    <div class="col-md-9">
        <div class="card">
            <div id="calendar"></div>
        </div>
    </div>
</div>

<div id="view-table" style="display: none;">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Table View</h3>
            <div class="card-tools">
                <div class="btn-group" role="group" id="button-date">
                    <button type="button" class="btn btn-secondary"><i class="fas fa-less-than"></i></button>
                    <button type="button" class="btn btn-secondary"><i class="fas fa-greater-than"></i></button>
                </div>
            </div>
        </div>
        <div class="card-body" style="overflow-x: auto;">
            <table class="table table-bordered center">
                <thead>
                    <tr>
                        <th style="width: 20%">Produk</th>
                        <th style="width: 10%">Jumlah Produksi</th>
                        @for ($i = 1; $i <= date('t'); $i++) <th>{{$i}}</th>
                            @endfor
                    </tr>
                </thead>
                <tbody id="table-date" data-num_date="{{ date('t') }}">
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            <div class="d-flex justify-content-between">
                <div>
                    <span style="background-color: black; display: inline-block; height:15px; width:15px; margin-right:10px;"></span><span>Hari libur</span><br>
                    <span style="background-color: yellow; display: inline-block; height:15px; width:15px; margin-right:10px;"></span><span>Hari produksi</span><br>
                    <span style="background-color: white; display: inline-block; height:15px; width:15px; margin-right:10px;"></span><span>Hari kosong</span><br>
                </div>
                <div @if(Auth::user()->divisi_id != 3) style="display: none;" @endif>
                    <button class="btn btn-success">Setuju</button>
                </div>
            </div>
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
        $('#product-quantity').val(null);
    }

    function choose_button(confirm, calendar) {
        switch (confirm) {
            case 0:
                $('#btn-confirmation').show();
                calendar.setOption('selectable', true);
                calendar.setOption('editable', true);
                calendar.setOption('eventClick', handleEventClick);
                break;
            case 1:
                $('#btn-confirmation-cancel').show();
                calendar.setOption('selectable', false);
                calendar.setOption('editable', false);
                calendar.setOption('eventClick', null);
                break;
            case 2:
                $('#btn-bppb').show();
                calendar.setOption('selectable', false);
                calendar.setOption('editable', false);
                calendar.setOption('eventClick', null);
                break;
        }
    }

    function handleEventClick(eventClickInfo) {
        bootbox.confirm({
            message: "Hapus produk dari jadwal?",
            buttons: {
                confirm: {
                    label: 'Ya',
                    className: 'btn-success'
                },
                cancel: {
                    label: 'Tidak',
                    className: 'btn-danger'
                }
            },
            callback: function(result) {
                if (result) {
                    $.ajax({
                        url: "/ppic/schedule/delete",
                        data: {
                            id: eventClickInfo.event._def.publicId
                        },
                        method: "POST",
                        success: function() {
                            eventClickInfo.event.remove();
                            $(`tr[data-id="${eventClickInfo.event._def.publicId}"]`).remove();

                            if ($('#table-product > tbody').children().length === 0) $('#btn-confirmation').hide();
                        }
                    });
                }
            }
        });
    }

    function update_schedule_function(data) {
        $.ajax({
            url: "/ppic/schedule/update",
            method: 'POST',
            data: data,
        });
    }

    function update_table_view(event) {
        let num = $('#table-date').data('num_date');
        let table = $('#table-date').append(`<tr data-id="${event.id}"></tr>`)
        let table_row = $(`#table-date tr[data-id="${event.id}"]`);

        let start_date = new Date(event.start);
        let end_date = new Date(event.end);

        let month = start_date.getMonth();
        let year = start_date.getFullYear();

        table_row.append(`<td>${event.title}</td>`);
        table_row.append(`<td>${event.quantity}</td>`);

        for (let i = 1; i <= num; i++) {
            let date = new Date(year, month, i);
            if (date.getDay() == 0 || date.getDay() == 6)
                table_row.append(`<td style="background-color: black;"></td>`)
            else if (i >= start_date.getDate() && i < end_date.getDate())
                table_row.append(`<td style="background-color: yellow;"></td>`)
            else
                table_row.append(`<td></td>`);
        }
    }

    function choose_view(view) {
        switch (view) {
            case "calendar":
                $('#view-calendar').show();
                $('#view-table, #view-list').hide();
                break;
            case "table":
                $('#view-table').show();
                $('#view-calendar, #view-list').hide();
                break;
        }
    }

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    let status = $('#data-status').html();
    let events = JSON.parse($('#data-events').html());
    let user = JSON.parse($('#data-user').html());

    events = events.length === 0 ? [] : events.map((event) => {
        let temp = {
            id: event.id,
            title: event.detail_produk.nama,
            start: event.tanggal_mulai,
            end: event.tanggal_selesai,
            backgroundColor: event.warna,
            borderColor: event.warna,
            konfirmasi: event.konfirmasi,
            quantity: event.jumlah_produksi,
        }
        update_table_view(temp);
        return temp;
    });

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
        events: events,
        select: (selectionInfo) => {
            $('#product-modal').modal('show');
            event_start = new Date(selectionInfo.start);
            event_end = new Date(selectionInfo.end);
        },
        eventClick: handleEventClick,
        eventDrop: (eventDropInfo) => {
            console.log(eventDropInfo);
        }
    }

    const onlyView_setting = {
        locale: "id",
        headerToolbar: {
            end: ""
        },
        weekends: false,
        showNonCurrentDates: false,
        events: events,
    }

    $(document).ready(() => {
        let calendarEl = document.getElementById('calendar');
        let calendar = new FullCalendar.Calendar(calendarEl, (status === "penyusunan" ? editable_setting : onlyView_setting));
        calendar.render();

        if (user.divisi_id === 3) {
            choose_view("table");
            $('#view-button').hide();
            if (events.length === 0) $('#view-table .card-footer button').hide();
            if (events.length > 0 && events[0].konfirmasi !== 1) $('#view-table .card-footer button').hide();
        } else {
            reset_input();

            if (events.length > 0) {
                choose_button(events[0].konfirmasi, calendar);
            }

            switch (status) {
                case "penyusunan":
                    $('#status-penyusunan').show();
                    calendar.next();
                    break;
                case "pelaksanaan":
                    $('#status-pelaksanaan').show();
                    break;
                case "selesai":
                    $('#status-selesai').show();
                    calendar.prev();
                    break;
            }
        }

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
            $.ajax({
                url: "/ppic/schedule/create",
                data: {
                    id_produk: $('#product-name').val(),
                    bom: $('#product-version').val(),
                    jumlah: $('#product-quantity').val(),
                    start: `${event_start.getFullYear()}-${event_start.getMonth()+1}-${event_start.getDate()}`,
                    end: `${event_end.getFullYear()}-${event_end.getMonth()+1}-${event_end.getDate()}`,
                    status: status,
                    color: $('#product-modal .modal-footer button').css('background-color'),
                },
                method: "POST",
                success: (data) => {
                    let event = {
                        id: data.id,
                        title: data.detail_produk.nama,
                        start: data.tanggal_mulai,
                        end: data.tanggal_selesai,
                        backgroundColor: data.warna,
                        borderColor: data.warna,
                        quantity: data.jumlah_produksi,
                    }

                    calendar.addEvent(event);

                    update_table_view(event);

                    $('#table-product > tbody').append(`
                        <tr data-id="${data.id}">
                            <td>${data.detail_produk.nama}</td>
                            <td>${data.jumlah_produksi}</td>
                        </tr>
                    `);

                    if ($('#table-product > tbody').children().length !== 0) $('#btn-confirmation').show();

                    $('#product-modal').modal('hide');
                },
                error: (xhr, status, error) => {
                    alert('data belum lengkap');
                    console.log(error);
                }
            });
        });
<<<<<<< HEAD

        $('#btn-color > button').click(function() {
            var currColor = $(this).css('background-color');
            $('#product-modal .modal-footer button').css({
                'background-color': currColor,
                'border-color': currColor
=======
        // submit product form
        $('#product-submit').click(function() {
            let color = $(this).css('background-color');
            let data_saved = {
                id_produk: $('#product-name').val(),
                start: $('#date_start').val(),
                end: $('#date_end').val(),
                status: "penyusunan",
                jumlah: $('#product-quantity').val(),
                bom: $('#product-bom-version').val(),
                color: color,
            }
            console.log
            $.ajax({
                url: "/ppic/schedule/create",
                method: "POST",
                data: data_saved,
                success: function(result) {
                    calendar.addEvent({
                        id: result.id,
                        title: result.nama,
                        start: result.tanggal_mulai,
                        end: result.tanggal_selesai,
                        backgroundColor: color,
                        borderColor: color,
                    });
                    $('#modal-input-product').modal('hide');
                    $('#table-product').append(
                        `<tr data-id="${result.id}">
                            <td>${result.nama}</td>
                            <td>${result.jumlah_produksi}</td>
                        </tr>`
                    );
                    date_mark(result);
                    list_view_table_update(result);
                    reset_form();
                },
                error: function(xhr, status, err) {
                    console.log(err);
                }
>>>>>>> 031db91a212a9c4b6a5da9f02ecd56715093a0f7
            });

        });

        $('#btn-confirmation').click(function() {
            $(this).hide();
            $('#btn-confirmation-cancel').show();
            calendar.setOption('selectable', false);
            calendar.setOption('editable', false);
            calendar.setOption('eventClick', null);

            let data = {
                confirmation: 1,
                status: status,
            }

            update_schedule_function(data);
        });

        $('#btn-confirmation-cancel').click(() => {
            bootbox.confirm({
                message: "Batalkan permintaan konfirmasi?",
                buttons: {
                    confirm: {
                        label: 'Ya',
                        className: 'btn-success'
                    },
                    cancel: {
                        label: 'Tidak',
                        className: 'btn-danger'
                    }
                },
                callback: function(result) {
                    if (result) {
                        $('#btn-confirmation-cancel').hide();
                        $('#btn-confirmation').show();
                        calendar.setOption('selectable', true);
                        calendar.setOption('editable', true);
                        calendar.setOption('eventClick', handleEventClick);

                        let data = {
                            confirmation: 0,
                            status: status,
                        }

                        update_schedule_function(data);
                    }
                }
            });
        });

        $('#view-button button[data-view="calendar"]').click(() => {
            $('#view-calendar').show();
            $('#view-table, #view-list').hide();
        });

        $('#view-button button[data-view="table"]').click(() => {
            $('#view-table').show();
            $('#view-calendar, #view-list').hide();
        });

        $('#view-table .card-footer button').click(function() {
            bootbox.alert("Jadwal telah disetujui");
            $(this).hide();
            let data = {
                confirmation: 2,
                status: status,
            }
            update_schedule_function(data);
        });
    });
</script>
@stop