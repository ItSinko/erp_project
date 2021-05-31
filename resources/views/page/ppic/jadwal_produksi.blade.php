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
        <div class="btn-toolbar justify-content-between float-right" role="toolbar" aria-label="Toolbar with button groups">
            <div class="btn-group" role="group" aria-label="First group">
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

    .loader {
        border: 16px solid #fff;
        border-radius: 50%;
        border-top: 16px solid #3498db;
        width: 120px;
        height: 120px;
        -webkit-animation: spin 2s linear infinite;
        /* Safari */
        animation: spin 2s linear infinite;
        margin-left: auto;
        margin-right: auto;
        display: inline-block;
    }

    /* Safari */
    @-webkit-keyframes spin {
        0% {
            -webkit-transform: rotate(0deg);
        }

        100% {
            -webkit-transform: rotate(360deg);
        }
    }

    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }
</style>
@stop

@section('content')
<div class="row">
    <!-- <button id="test-button">Cliick Me</button> -->
    <div class="col-md-12">
        <div class="row" id="calendar-view">
            <div class="col-md-3">
                <div class="sticky-top mb-3">
                    <div class="alert alert-info alert-dismissible" id="status_penyusunan" style="display: none;">
                        <h5><i class="icon fas fa-info"></i> Status </h5>
                        Proses penyusunan jadwal
                    </div>
                    <div class="alert alert-success alert-dismissible" id="status_acc" style="display: none;">
                        <h5><i class="icon fas fa-check"></i> Status</h5>
                        Jadwal telah Ditetapkan
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Daftar Produksi</h4>
                        </div>
                        <div class="card-body">
                            <!-- the events -->
                            <div id="external-events">
                                <ul>
                                    @foreach($date as $d)
                                    <li>{{$d->nama_produk}}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    @can('manager')
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Status Jadwal Produksi</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-6">
                                    <button type="button" class="btn btn-primary btn-block status" id="acc">ACC</button>
                                </div>
                                <div class="col-sm-6">
                                    <button type="button" class="btn btn-danger btn-block status" id="penyusunan">Tolak</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endcan
                </div>
            </div>
            <div class="col-md-9">
                <div class="card">
                    <div class="card-body">
                        <div id='calendar'></div>
                        <div id="date" hidden>{{ $event }}</div> <!-- catch data from controller -->
                        <div id="user" hidden>{{ (Auth::user()) }}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card" id="list-view" style="display: none;">
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
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0" style="height: 600px;">
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
                        @foreach($date as $d)
                        <tr>
                            <td>{{$d->nama_produk}}</td>
                            <td>{{$d->tanggal_mulai}}</td>
                            <td>{{$d->tanggal_selesai}}</td>
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
        <div class="card" id="table-view" style="display: none;">
            <div class="card-header">
                <h3 class="card-title">Table View</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table class="table table-bordered center">
                    <thead>
                        <tr>
                            <th style="width: 10%">Produk</th>
                            @for ($i = 1; $i <= date('t'); $i++) <th>{{$i}}</th>
                                @endfor
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($date as $d)
                        <tr>
                            <td>{{$d->nama_produk}}</td>
                            @for ($i = 1; $i <= date('t'); $i++) @php $start=date('d', strtotime($d->tanggal_mulai));
                                $end = date('d', strtotime($d->tanggal_selesai));
                                @endphp
                                @if ($i >= $start && $i <= $end) <td style="background: yellow;">
                                    </td>
                                    @else
                                    <td></td>
                                    @endif
                                    @endfor
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="date_form" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h4 class="modal-title w-100 font-weight-bold">Pilih Tanggal</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body mx-3">
                <div class="btn-group" style="width: 100%; margin-bottom: 10px;">
                    <ul class="fc-color-picker" id="color-chooser">
                        <li><a class="text-primary" href="#"><i class="fas fa-square"></i></a></li>
                        <li><a class="text-warning" href="#"><i class="fas fa-square"></i></a></li>
                        <li><a class="text-success" href="#"><i class="fas fa-square"></i></a></li>
                        <li><a class="text-danger" href="#"><i class="fas fa-square"></i></a></li>
                        <li><a class="text-muted" href="#"><i class="fas fa-square"></i></a></li>
                    </ul>
                </div>
                <div class="form-group row">
                    <label for="activity" class="col-sm-2 col-form-label">Produksi</label>
                    <div class="col-sm-10">
                        <select name="" id="activity" class="form-control select2" data-placeholder="Pilih Produk...">
                            <option value=""></option>
                            @foreach($produk as $d)
                            <option value="{{ $d->nama }}">{{ $d->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="days" class="col-sm-2 col-form-label">Jumlah Produksi</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" id="jumlah-produksi" placeholder="Jumlah produksi" min="1" autocomplete="off">
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
            <div class="modal-footer d-flex justify-content-center">
                <button type="submit" class="btn btn-primary" id="save">Simpan</button>
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
            console.log(e);
            insertAtIndex(e);


            count = $('#notif a#notif-item').length;

            $('#notif-header').text(count + ' notifications');
            $('span.badge').text(count);
            $('span.badge').show();
        });
</script>
<script>
    var initial_date = JSON.parse($('#date').html()); // load event from database
    var user = JSON.parse($('#user').html()); // load user authorisation

    console.log(initial_date);

    function date_diff(date1, date2) {
        const date1utc = Date.UTC(date1.getFullYear(), date1.getMonth(), date1.getDate());
        const date2utc = Date.UTC(date2.getFullYear(), date2.getMonth(), date2.getDate());
        day = 1000 * 60 * 60 * 24;
        return (date2utc - date1utc) / day
    }

    function get_work_day(date1, date2) {
        var days = date_diff(date1, date2);
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

    function choose_view(view) {
        if (view == 'Kalender') {
            $('#calendar-view').show(500);
            $('#table-view, #list-view').hide();
        } else if (view == 'Tabel') {
            $('#table-view').show(500);
            $('#calendar-view, #list-view').hide();
        } else if (view == 'Daftar') {
            $('#list-view').show(500);
            $('#calendar-view, #table-view').hide();
        }
    }

    function choose_status(status) {
        if (status == 'penyusunan') {
            $('#status_penyusunan').show();
            $('#status_acc').hide();
            $('#acc').removeClass('disabled');
            console.log("penyusunan");
        } else if (status == 'acc') {
            $('#status_penyusunan').hide();
            $('#status_acc').show();
            $('#acc').addClass("disabled");
            $('#penyusunan').removeClass('disabled');
            console.log('acc');
        } else if (status == 'pelaksanaan') {
            // todo:
            // add plaksanaan status
        }
    }

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).ready(function() {

        var Calendar = FullCalendar.Calendar;
        var calendarEl = document.getElementById('calendar');

        var status;
        var currColor = '#3c8dbc';

        var calendar = new Calendar(calendarEl, {
            locale: 'id',

            weekends: false,
            weekNumbers: true,

            selectable: true,
            editable: true,

            headerToolbar: {
                start: 'title',
                center: '',
                end: 'today prev,next',
            },

            events: initial_date,

            select: function(info) {
                var date1 = new Date(info.startStr);
                var date2 = new Date(info.endStr);

                var days = get_work_day(date1, date2);

                $('#date_start').val(info.startStr);
                $('#date_end').val(info.endStr);
                $('#days').val(days);

                console.log(date1, date2);
                if (date1.getMonth() == date2.getMonth()) {
                    $('#date_form').modal();
                } else if ((date1.getMonth() + 1 == date2.getMonth()) && (date2.getDate() == 1)) {
                    $('#date_form').modal();
                } else {
                    bootbox.alert({
                        message: "Harap pilih tanggal produksi pada bulan yang sama",
                        centerVertical: true,
                    });
                }
            },

            eventClick: function(event_info) {
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
                            console.log(event_info.event);
                            $.ajax({
                                url: "/ppic/schedule/delete",
                                data: {
                                    id: event_info.event._def.publicId
                                },
                                method: "POST",
                                success: function() {
                                    console.log('event deleted');
                                    event_info.event.remove();
                                },
                                error: function() {
                                    console.log('error delete an event');
                                }
                            })
                        }
                    }
                });
            },
        });
        calendar.render();

        $('.fc-prev-button span, .fc-next-button span').click(function(event) {
            var targetMonth = calendar.getDate().getMonth() + 1;
            var targetYear = calendar.getDate().getYear();
            if (event.currentTarget.className.search('right') != -1) targetMonth += 1;
            if (event.currentTarget.className.search('left') != -1) targetMonth -= 1;

            if (targetMonth > 12) {
                targetMonth = 1;
                targetYear += 1;
            } else if (targetMonth < 0) {
                targetMonth = 12;
                targetYear -= 1;
            }

            $.ajax({
                url: '/ppic/schedule',
                method: 'GET',
                data: {
                    month: targetMonth,
                    year: targetYear,
                },
                success: function(result) {
                    console.log(result);
                },
                error: function() {
                    console.log('error');
                }
            })

            console.log(targetMonth);
        });

        if (initial_date.length != 0)
            status = initial_date[0].status;
        else
            status = 'penyusunan';
        choose_status(status);


        $('#color-chooser > li > a').click(function(e) {
            e.preventDefault();
            currColor = $(this).css('color');
            console.log(currColor);
            $('#save, #add-new-event').css({
                'background-color': currColor,
                'border-color': currColor
            })
        });

        $('#save').click(function() {
            var color = $(this).css('background-color');
            if ($('#activity').val()) {
                console.log('saved data by ajax');
                var data_saved = {
                    title: $('#activity').val(),
                    start: $('#date_start').val(),
                    end: $('#date_end').val(),
                    status: "penyusunan",
                    jumlah: $('#jumlah-produksi').val(),
                    color: color,
                }
                console.log(data_saved);
                $.ajax({
                    url: "/ppic/schedule/create",
                    method: "POST",
                    data: data_saved,
                    success: function(result) {
                        console.log(result);
                        global_result = result;
                        calendar.addEvent({
                            id: result.id,
                            title: result.nama_produk,
                            start: result.tanggal_mulai,
                            end: result.tanggal_selesai,
                            backgroundColor: color,
                            borderColor: color,
                        });
                        $('#date_form').modal('hide');
                        $('#activity').val('');
                    },
                    error: function(err) {
                        console.log(err);
                    }
                });
            } else {
                $('#activity').css('border', '2px solid red');
                setTimeout(() => {
                    $('#activity').css('border', '');
                }, 1000);
            }
        });

        $(document).keypress(function(e) {
            var key = e.which;
            if (key == 13) {
                $('#save').trigger("click");
            }
        });

        $('.status').on('click', function() {
            var message, status;
            if ($(this).attr('id') == 'acc') {
                choose_status('acc')
                message = "Jadwal telah di ACC";
                status = 'acc';
                $.ajax({
                    url: '/notif',
                    type: 'POST',
                    data: {
                        message: message,
                        status: status,
                    },
                    success: function() {
                        console.log('notif sent');
                    },
                    error: function(err) {
                        console.log('error: ' + err);
                    }
                });

            } else {
                var add_message;
                if (user.nama == "Anna") {
                    bootbox.prompt({
                        title: "Keterangan",
                        centerVertical: true,
                        callback: function(result) {
                            add_message = result;
                            message = "Jadwal dibatalkan untuk di ACC:<br>" + add_message;
                            status = 'penyusunan';
                            $.ajax({
                                url: '/notif',
                                type: 'POST',
                                data: {
                                    message: message,
                                    status: status,
                                },
                                success: function() {
                                    console.log('notif sent');
                                },
                                error: function(err) {
                                    console.log('error: ' + err);
                                }
                            });
                        }
                    });
                }
            }
        });

        $('.view').click(function() {
            choose_view($(this).text());
        });
    });
</script>
@stop