@extends('adminlte.page')

@section('title', 'Beta Version')

@section('content_top_nav_right')
<li class="nav-item dropdown">
    <a class="nav-link" data-toggle="dropdown" href="#">
        <i class="far fa-bell"></i>
        <span class="badge badge-danger navbar-badge" style="display: none;">0</span>
    </a>
    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" id="notif">
        <div class="dropdown-divider"></div>
        <span class="dropdown-item dropdown-header" id="notif-header">0 Notifications</span>
    </div>
</li>
@stop

@section('content_header')
<div class="row">
    <div class="col-6">
        <h1 id="page_header" class="m-0 text-dark">Jadwal Produksi</h1>
    </div>
    <div class="col-6">
        <div class="btn-toolbar justify-content-between float-right" role="toolbar">
            <div class="btn-group" role="group" id="view-button">
                <button type="button" class="btn btn-primary view">Kalender</button>
                <button type="button" class="btn btn-info view">Tabel</button>
                <button type="button" class="btn btn-warning view">Daftar</button>
            </div>
        </div>
    </div>
</div>
@stop

@section('adminlte_css')
<link href='{{ asset("vendor/fullcalendar/main.css") }}' rel='stylesheet' />
<style>
    #calendar {
        padding: 20px;
    }

    #table-product tr:hover {
        background-color: yellow;
        cursor: pointer;
    }

    #table-product tr {
        background-color: white;
    }
</style>
@stop

@section('content')
<div hidden>
    <!-- container data from controller to javascript code below -->
    <div id="data_produk">{{ $produk }}</div>
    <div id="data_event">{{ $event }}</div>
    <div id="data_status">{{ $status }}</div>
    <div id="data_user">{{ Auth::user() }}</div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="alert alert-info alert-dismissible" id="status_penyusunan" style="display: none;">
            <h5><i class="icon fas fa-info"></i> Status </h5>
            Penyusunan
        </div>
        <div class="alert alert-warning alert-dismissible" id="status_pelaksanaan" style="display: none;">
            <h5><i class="icon fas fa-hard-hat"></i> Status</h5>
            Pelaksanaan
        </div>
        <div class="alert alert-success alert-dismissible" id="status_selesai" style="display: none;">
            <h5><i class="icon fas fa-check"></i> Status</h5>
            Selesai
        </div>
    </div>
    <div class="col-md-3 view-calendar" style="display: none">
        <div class="sticky-top">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Daftar Produksi</h4>
                </div>
                <div class="card-body">
                    <table style="text-align: center; width: 100%;">
                        <thead>
                            <tr>
                                <th>Nama Produk</th>
                                <th>Jumlah Produksi</th>
                            </tr>
                        </thead>
                        <tbody id="table-product">
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
            @can('admin')
            @if ($status == "penyusunan")
            <button class="btn btn-danger btn-block" id="acc-button">Persetujuan</button>
            @endif
            @endcan
            @if (Auth::user()->divisi_id == 3)
            <button class="btn btn-info btn-block" id="bppb-button" style="display: none;">BPPB</button>
            @endif
        </div>
    </div>
    <div class="col-md-9 view-calendar" style="display: none">
        <div class="card">
            <div class="card-body">
                <div id="calendar"></div>
            </div>
        </div>
    </div>
    <div class="col-12 table-view" style="display: none;">
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
        </div>
    </div>
    <div class="col-12 list-view" style="display: none;">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">List View</h3>
                <div class="card-tools">
                    <div class="input-group input-group-sm" style="width: 150px;">
                        <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                        <div class="input-group-append">
                            <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body table-responsive p-0">
                <table class="table table-head-fixed text-nowrap">
                    <thead>
                        <tr>
                            <th>Produk</th>
                            <th>Tanggal Mulai</th>
                            <th>Tanggal Selesai</th>
                            <th>Status</th>
                            <th>Progress</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($event as $e)
                        <tr>
                            <td>{{$e->nama}}</td>
                            <td>{{$e->tanggal_mulai}}</td>
                            <td>{{$e->tanggal_selesai}}</td>
                            <td>On Progress</td>
                            <td>
                                <div class="progress progress-xs">
                                    <div class="progress-bar progress-bar-danger" style="width: 55%"></div>
                                </div>
                                <span class="badge bg-danger">55%</span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
</div>

<div class="modal fade" id="modal-input-date">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <form onsubmit="return false">
                <div class="modal-header text-center">
                    <h4 class="modal-title w-100 font-weight-bold">Produksi</h4>
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="choose_color" class="col-sm-2 col-form-label">Pilih warna</label>
                        <div id="choose_color">
                            <button type="button" class="btn btn-primary" style="padding: 20px"></button>
                            <button type="button" class="btn btn-secondary" style="padding: 20px"></button>
                            <button type="button" class="btn btn-success" style="padding: 20px"></button>
                            <button type="button" class="btn btn-danger" style="padding: 20px"></button>
                            <button type="button" class="btn btn-warning" style="padding: 20px"></button>
                            <button type="button" class="btn btn-info" style="padding: 20px"></button>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="product" class="col-sm-2 col-form-label">Produksi</label>
                        <div class="col-sm-10">
                            <select name="" id="product" class="form-control select2" data-placeholder="Pilih Produk..." required>
                                <option value=""></option>
                                @foreach($produk as $e)
                                <option value="{{ $e->id }}">{{ $e->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="bom-input-product" class="col-sm-2 col-form-label">Versi BOM</label>
                        <div class="col-sm-10">
                            <select class="form-control" id="bom-input-product" disabled>
                                <option value=""></option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="number-product" class="col-sm-2 col-form-label">Jumlah Produksi</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" id="number-product" placeholder="Jumlah produksi" min="1" autocomplete="off" required disabled>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="days" class="col-sm-2 col-form-label">Jumlah Hari</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" id="days" placeholder="number of days" min="1" autocomplete="off" readonly>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="date_start">Tanggal Mulai</label>
                            <input type="date" class="form-control" id="date_start" autocomplete="off" readonly>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="date_end">Tanggal Berhenti</label>
                            <input type="date" class="form-control" id="date_end" autocomplete="off" readonly>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="submit" class="btn btn-primary" id="save-event">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-bom-show">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h4 class="modal-title w-100 font-weight-bold">Pilih BOM</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="input-group col-6" style="margin-left: auto; margin-right: auto; margin-bottom: 10px">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="input">Search</label>
                    </div>
                    <select class="form-control" id="bom-input">
                        <option value=""></option>
                    </select>
                </div>
                <table id="table-bom" class="table table-hover styled-table table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Jumlah</th>
                            <th>Stok</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="submit" class="btn btn-primary" id="choose-bom">Pilih</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="create-bppb">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h4 class="modal-title w-100 font-weight-bold">Pilih BOM</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered" id="table-bppb" style="text-align: center">
                    <thead>
                        <tr>
                            <th>Nama Produk</th>
                            <th>Jumlah</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($event as $e)
                        <tr id="row2_{{ $e->id }}">
                            <td>{{ $e->nama }}</td>
                            <td>{{ $e->jumlah_produksi }}</td>
                            <td><button class="btn btn-info send" value="{{ $e->id }}">
                                    @if ($e->status == "permintaan")
                                    <i class="fas fa-check"></i>
                                    @else
                                    Kirim
                                    @endif
                                </button></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="submit" class="btn btn-primary" id="done-bppb">Selesai</button>
                <button type="submit" class="btn btn-danger" id="send-all">Kirim Semua</button>
            </div>
        </div>
    </div>
</div>

@stop

@section('adminlte_js')
<script src="{{ asset('vendor/fullcalendar/main.js') }}"></script>
<script src="{{ asset('vendor/fullcalendar/locales-all.js') }}"></script>
<script src="{{ asset('vendor/bootbox/bootbox.js') }}"></script>
<script src="{{ asset('js/notif.js') }}"></script>

<script>
    var produk = JSON.parse($('#data_produk').html()); // GET data produk from controller
    var event = JSON.parse($('#data_event').html()); // GET data event from controller
    var user = JSON.parse($('#data_user').html()); // GET data user
    var status = $('#data_status').html(); // GET data status from controller

    // get object array to initialize fullcalendar
    let initial_event = [];
    for (let i = 0; i < event.length; i++) {
        initial_event[i] = {
            id: event[i].id,
            title: event[i].nama,
            start: event[i].tanggal_mulai,
            end: event[i].tanggal_selesai,
            color: event[i].warna,
        }
    }

    // count number of days
    function get_work_day(date1, date2) {
        const date1utc = Date.UTC(date1.getFullYear(), date1.getMonth(), date1.getDate());
        const date2utc = Date.UTC(date2.getFullYear(), date2.getMonth(), date2.getDate());
        day = 1000 * 60 * 60 * 24;

        var days = (date2utc - date1utc) / day;
        var weeks = Math.floor(days / 7);
        days = days - (weeks * 2);

        var startDay = date1.getDay();
        var endDay = date2.getDay() - 1;

        // Remove weekend not previously removed.   
        if (startDay - endDay > 1)
            days = days - 2;

        // Remove start day if span starts on Sunday but ends before Saturday
        if (startDay == 0 && endDay != 6)
            days = days - 1;

        // Remove end day if span ends on Saturday but starts after Sunday
        if (endDay == 6 && startDay != 0)
            days = days - 1;

        return days;
    }

    // choose view template
    function choose_view(view) {
        if (view == 'Kalender') {
            $('.view-calendar').show(500);
            $('.table-view, .list-view').hide();
        } else if (view == 'Tabel') {
            $('.table-view').show(500);
            $('.view-calendar, .list-view').hide();
        } else if (view == 'Daftar') {
            $('.list-view').show(500);
            $('.view-calendar, .table-view').hide();
        }
    }

    // action base on status sended
    function choose_status(status) {
        if (status == 'penyusunan') {
            $('#status_penyusunan').show();
            $('#status_pelaksanaan, #status_selesai').hide();
            choose_view('Kalender');
        } else if (status == 'pelaksanaan') {
            $('#status_pelaksanaan').show();
            $('#status_penyusunan, #status_selesai').hide();
        } else if (status == 'selesai') {
            $('#status_selesai').show();
            $('#status_penyusunan, #status_pelaksanaan').hide();
        }
    }

    // table-view function
    function date_mark(event) {
        let num = $('#table-date').data('num_date');
        let table = $('#table-date').append(`<tr data-id="${event.id}"></tr>`)
        let table_row = $(`#table-date tr[data-id="${event.id}"]`);

        let start_date = new Date(event.tanggal_mulai);
        let end_date = new Date(event.tanggal_selesai);

        let month = start_date.getMonth();
        let year = start_date.getFullYear();
        // console.log(current_date);
        table_row.append(`<td>${event.nama}</td>`);
        table_row.append(`<td>${event.jumlah_produksi}</td>`);

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
    for (i in event) {
        date_mark(event[i]);
    }

    $(document).ready(function() {
        var Calendar = FullCalendar.Calendar;
        var calendarEl = document.getElementById('calendar');

        var event_info;

        choose_status(status); // choose status info
        $('.view').click(function() {
            choose_view($(this).text()); // choose display mode
        });

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var calendar_setting = {
            locale: 'id',
            headerToolbar: {
                end: ""
            },

            weekends: false,
            weekNumbers: true,
            showNonCurrentDates: false,

            selectable: true,
            editable: false,

            events: initial_event,

            select: function(info) {
                var date1 = new Date(info.startStr);
                var date2 = new Date(info.endStr);

                var days = get_work_day(date1, date2);

                $('#date_start').val(info.startStr);
                $('#date_end').val(info.endStr);
                $('#days').val(days);

                $('#modal-input-date').modal();
            },

            eventClick: function(info) {
                bootbox.confirm({
                    centerVertical: true,
                    message: "Apakah Anda ingin menghapus produksi ini?",
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
                                    id: info.event._def.publicId
                                },
                                method: "POST",
                                success: function() {
                                    info.event.remove();
                                    $('#row1_' + info.event._def.publicId).remove();
                                    $('#row2_' + info.event._def.publicId).remove();
                                }
                            });
                        }
                    }
                });
            },
        }

        var calendar = new Calendar(calendarEl, calendar_setting);
        calendar.render();
        if (status == 'penyusunan') {
            calendar.next();
        }

        var create_bppb = false;
        for (var i = 0; i < event.length; i++) {
            console.log(event[i].status);
            if (event[i].status == 'disetujui' || event[i].status == 'permintaan') {
                create_bppb = true;
                break;
            }
        }
        if (create_bppb) {
            bootbox.alert({
                centerVertical: true,
                message: "<p>Jadwal telah disetujui</p>" +
                    "<p>Silahkan kirim bppb untuk penyusunan bulan ini</p>",
            });
            $('#bppb-button').show();
        }

        var modal_select_bom = function() {
            $('#modal-bom-show').modal('show');
            event_info = {
                id: this.dataset.id
            };
            $.ajax({
                url: "/ppic/get_version",
                method: "GET",
                data: event_info,
                success: function(result) {
                    $('#bom-input').empty();
                    $('#bom-input').append(`<option value="">Pilih versi...</option>`);
                    result.forEach(element => {
                        $('#bom-input').append(`<option value="` + element.id + `">` + element.versi + `</option>`);
                    });
                },
                error: function(xhr, status, err) {
                    console.log("get bom: " + error);
                }
            });
        }
        var bom_change = function() {
            console.log('change bom');
            $('#number-product').next("span").remove();
            $.ajax({
                url: `/ppic/get_bom/${this.value}`,
                method: "GET",
                data: {
                    count: true
                },
                success: function(result) {
                    console.log(result);

                    $('#number-product').after(`<span style='color: grey;'>max: ${result}</span>`);
                    $('#number-product').prop('disabled', false);
                },
                error: function(xhr, status, err) {
                    console.log(err);
                }
            })
        }


        $('#choose_color > button').click(function(e) {
            var currColor = $(this).css('background-color');
            $('#save-event').css({
                'background-color': currColor,
                'border-color': currColor
            })
        });
        $('#product').change(function() {
            $.ajax({
                url: "/ppic/get_version",
                method: "GET",
                data: {
                    detail_produk_id: this.value,
                },
                success: function(result) {
                    $('#bom-input-product').next("span").remove();
                    if (result.length != 0) {
                        console.log("found");
                        $('#bom-input-product').empty();
                        $('#bom-input-product').append(`<option value="">Pilih versi...</option>`);
                        result.forEach(element => {
                            $('#bom-input-product').append(`<option value="` + element.id + `">` + element.versi + `</option>`);
                        });
                        $('#bom-input-product').prop('disabled', false);
                        $('#bom-input-product').change(bom_change);
                    } else {
                        console.log("not found");
                        console.log($('#bom-input-product'));
                        $('#bom-input-product').after("<span style='color: red'>Bom belum tersedia</span>");
                        $('#bom-input-product').prop('disabled', true);
                    }
                },
                error: function(xhr, status, err) {
                    console.log("get bom: " + err);
                }
            });
        });
        $('#save-event').click(function() {
            let color = $(this).css('background-color');
            let data_saved = {
                id_produk: $('#product').val(),
                start: $('#date_start').val(),
                end: $('#date_end').val(),
                status: "penyusunan",
                jumlah: $('#number-product').val(),
                color: $(this).css('background-color'),
            }

            $.ajax({
                url: "/ppic/schedule/create",
                method: "POST",
                data: data_saved,
                success: function(result) {
                    console.log(result);
                    calendar.addEvent({
                        id: result.id,
                        title: result.nama,
                        start: result.tanggal_mulai,
                        end: result.tanggal_selesai,
                        backgroundColor: color,
                        borderColor: color,
                    });
                    $('#modal-input-date').modal('hide');
                    $('#table-product').append(`<tr id="row1_${result.id}" data-id="${result.id}">
                        <td>${result.nama}</td>
                        <td><i class="fas fa-times-circle"></i></td>
                    </tr>`);
                    $('#table-product tr').click(modal_select_bom);
                },
                error: function(xhr, status, err) {
                    console.log(err);
                }
            });
        });

        $('#table-product tr').click(modal_select_bom);

        $('#acc-button').on('click', function() {
            bootbox.confirm({
                centerVertical: true,
                message: "Apakah Anda menyetujui jadwal produksi bulan ini?",
                buttons: {
                    confirm: {
                        label: 'Setuju',
                    },
                    cancel: {
                        label: 'Tolak',
                    }
                },
                callback: function(result) {
                    if (result) {
                        $.ajax({
                            url: "/notif",
                            method: "POST",
                            data: {
                                status: "Setuju",
                                message: "Jadwal telah disetujui"
                            }
                        });
                    } else {
                        bootbox.prompt({
                            title: "Keterangan atas penolakan jadwal produksi",
                            centerVertical: true,
                            callback: function(result) {
                                $.ajax({
                                    url: "/notif",
                                    method: "POST",
                                    data: {
                                        status: "Tolak",
                                        message: result
                                    }
                                })
                            }
                        })
                    }
                }
            });
        });

        let initialize = false;
        let table;
        $("#bom-input").change(function() {
            let temp = this.value;
            if (!initialize) {
                initialize = true;
                table = $('#table-bom').DataTable({
                    paging: false,
                    info: false,
                    pageLength: -1,
                    processing: true,
                    serverSide: true,
                    ajax: '/ppic/get_bom/' + temp,
                    language: {
                        processing: '<i class="fa fa-spinner fa-spin"></i> Tunggu Sebentar'
                    },
                    buttons: [
                        'copy', 'csv', 'excel', 'pdf', 'print'
                    ],
                    dom: 'Bfrtip',
                    columns: [{
                            data: 'DT_RowIndex',
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: 'nama'
                        },
                        {
                            data: 'jumlah'
                        },
                        {
                            data: 'stok'
                        }
                    ]
                });
            } else {
                initialize = false;
                table.destroy();
            }
            $('#table-card').show();
        });

        $("#choose-bom").click(function() {
            $.ajax({
                url: "/ppic/schedule/create",
                method: "POST",
                data: {
                    versi: $("#bom-input").val(),
                    id_event: event_info.id,
                },
                success: function(result) {
                    $(`#row1_${event_info.id} td:nth-child(2)`).html(result.versi_bom);
                    $('#modal-bom-show').modal('hide');

                    $('#table-bppb tbody').append(`<tr id="row2_${result.id}" >
                            <td>${result.nama}</td>
                            <td>${result.jumlah}</td>
                            <td><button class="btn btn-info send" value="${result.id}">Kirim</button></td>
                        </tr>`);
                },
                error: function(xhr, status, err) {
                    console.log(err);
                }
            });
        });

        $("#bppb-button").click(function() {
            $("#create-bppb").modal('show');
        });

        $(".send").click(function() {
            $(this).html(`<i class="fas fa-check"></i>`)
        });

        $("#send-all").click(function() {
            $(".send").html(`<i class="fas fa-check"></i>`)
        });

        $("#done-bppb").click(function() {
            $("#create-bppb").modal("hide");
        });

        $(".send").on("click", function() {
            if ($(this).val() != "permintaan") {
                $.ajax({
                    url: "/ppic/schedule/create",
                    method: "POST",
                    data: {
                        status_update: true,
                        status: "permintaan",
                        id: $(this).val(),
                    },
                    success: function(result) {
                        console.log(result);
                    }
                });
            }
        });
    });
</script>


<script>
    var count = $('#notif a#notif-item').length;

    $('#notif-header').text(count + ' notifications');
    $('span.badge').text(count);
    if (count != 0) {
        $('span.badge').show();
    }

    function insertAtIndex(e) {
        var content = `
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item" id="notif-item">
                <!-- Message Start -->
                <div class="media">
                    <img src="{{ asset('assets/image/user/index.png') }}" alt="User Avatar" class="img-size-50 mr-3 img-circle">
                    <div class="media-body">
                        <h3 class="dropdown-item-title">` +
            e.user.nama +
            `</h3>
                        <p class="text-sm">` + e.message + `</p>
                    </div>
                </div>
                <!-- Message End -->
            </a>
            `;

        $("#notif").prepend(content);
        choose_status(e.status);
    }

    Echo.private('message-events')
        .listen('RealTimeMessage', function(e) {
            global_e = e;
            console.log(e);
            insertAtIndex(e);


            count = $('#notif a#notif-item').length;

            $('#notif-header').text(count + ' notifications');
            $('span.badge').text(count);
            $('span.badge').show();
        });
</script>
@stop