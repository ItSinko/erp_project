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

    #loader {
        opacity: 0.8;
        background-color: #ccc;
        position: fixed;
        width: 100%;
        height: 100%;
        top: 0px;
        left: 0px;
        z-index: 10000;
    }

    #loading_gif {
        position: absolute;
        left: 50%;
        top: 50%;
        z-index: 1;
        width: 120px;
        height: 120px;
        margin: -76px 0 0 -76px;
        border: 16px solid #f3f3f3;
        border-radius: 50%;
        border-top: 16px solid #3498db;
        -webkit-animation: spin 2s linear infinite;
        animation: spin 2s linear infinite;
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
<div id="loader">
    <div id="loading_gif"></div>
</div>
<div class="row" id="page">
    <div class="col-3 calendar-view">
        <div class="sticky-top">
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
                    <table style="text-align: center; width: 100%;" id="product_list">
                        <thead>
                            <tr>
                                <th>Nama Produk</th>
                                <th>Versi BOM</th>
                            </tr>
                        </thead>
                        <tbody id="product_list_body">
                            @foreach($date as $d)
                            <tr id="row_{{ $d->id_produk }}">
                                <td>{{$d->nama_produk}}</td>
                                <td>
                                    <button class="btn btn-info choose-bom" id="{{ $d->id_produk }}">
                                        @if ($d->bom == NULL)
                                        Pilih BOM
                                        @else
                                        Versi {{$d->bom}}
                                        @endif
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
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
    <div class="col-9 calendar-view">
        <div class="card">
            <div class="card-body">
                <div id='calendar'></div>
                <div id="date" hidden>{{ $event }}</div> <!-- catch data from controller -->
                <div id="user" hidden>{{ (Auth::user()) }}</div>
            </div>
        </div>
    </div>
    <div class="col-12">
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
    <div class="col-12">
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
    </div>
</div>

<div class="row">

</div>

<div class="modal fade" id="date_form" tabindex="-1">
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
                            <option value="{{ $d->nama.','.$d->id }}">{{ $d->nama }}</option>
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

<div class="modal fade" id="show-bom" tabindex="-1">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h4 class="modal-title w-100 font-weight-bold">Pilih BOM</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body mx-3">
                <div class="input-group col-6" style="margin-left: auto; margin-right: auto; margin-bottom: 10px">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="input">Search</label>
                    </div>
                    <select class="custom-select" id="bom-input">
                        <option selected>Choose...</option>
                        @foreach ($produk as $li)
                        <option value="{{ $li->id }}">{{ $li->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <table class="table table-bordered" id="table-bom">
                    <thead>
                        <tr style="text-align: center;">
                            <th>#</th>
                            <th style="width: 50%">Nama</th>
                            <th>Jumlah</th>
                            <th>Stok</th>
                            <th>Pemotongan</th>
                            <th>Sisa</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                    <tfoot>
                    </tfoot>
                </table>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="submit" class="btn btn-primary" id="choosen">Pilih</button>
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
    var initial_event = JSON.parse($('#date').html()); // load event from database
    var user = JSON.parse($('#user').html()); // load user authorisation

    var bom_id;

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
            $('.calendar-view').show(500);
            $('#table-view, #list-view').hide();
        } else if (view == 'Tabel') {
            $('#table-view').show(500);
            $('.calendar-view, #list-view').hide();
        } else if (view == 'Daftar') {
            $('#list-view').show(500);
            $('.calendar-view, #table-view').hide();
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
            // add pelaksanaan status
        }
    }

    function showPage() {
        $('#loader').hide();
    }

    function hidePage() {
        $('#loader').show();
    }

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).ready(function() {

        setTimeout(showPage, 2000);

        var Calendar = FullCalendar.Calendar;
        var calendarEl = document.getElementById('calendar');

        var status;
        var currColor = '#3c8dbc';

        if (initial_event.length != 0) {
            status = initial_event[0].status;
        } else {
            status = 'penyusunan';
        }
        choose_status(status);

        var calendar = new Calendar(calendarEl, {
            locale: 'id',

            weekends: false,
            weekNumbers: true,

            selectable: true,
            editable: false,

            headerToolbar: {
                start: 'title',
                center: '',
                end: 'today prev,next',
            },

            events: initial_event,

            select: function(info) {
                var date1 = new Date(info.startStr);
                var date2 = new Date(info.endStr);

                var days = get_work_day(date1, date2);

                $('#date_start').val(info.startStr);
                $('#date_end').val(info.endStr);
                $('#days').val(days);

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
                                    // console.log('event deleted');
                                    // console.log('row_' + info.event._def.publicId);
                                    // console.log($('#product_list_body').children());
                                    info.event.remove();
                                    $('#row_' + info.event._def.publicId).remove();
                                    console.log($('#row_' + info.event._def.publicId));
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
            var arr = $('#activity').val().split(',');
            var produk = arr[0];
            var id_produk = arr[1];
            if ($('#activity').val()) {
                var data_saved = {
                    title: produk,
                    id_produk: id_produk,
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
                        calendar.addEvent({
                            id: result.id,
                            title: result.nama_produk,
                            start: result.tanggal_mulai,
                            end: result.tanggal_selesai,
                            backgroundColor: color,
                            borderColor: color,
                        });
                        $('#date_form').modal('hide');
                        $('#product_list_body').append(`<tr id="row_` + result.id + `">
                            <td>` + result.nama_produk + `</td>
                            <td>
                                <button class="btn btn-info choose-bom" id="` + result.id + `">
                                    Pilih BOM
                                </button>
                            </td>
                        </tr>`);
                        $('.choose-bom').click(function() {
                            console.log("test")
                            $('#show-bom').modal('show');
                            bom_id = this.id;
                            var input_bom = $('#bom-input').html(`<option selected>Choose...</option>`);
                            $.ajax({
                                url: '/ppic/get_bom_version/' + bom_id,
                                method: 'GET',
                                success: function(result) {
                                    var data = JSON.parse(result);
                                    for (var i = 0; i < data.length; i++) {
                                        input_bom.append(`<option value="` + data[i].id + " " + data[i].versi + " " + data[i].detail_produk_id + `">Versi ` + data[i].versi + `</option>`)
                                    }
                                }
                            });
                        });
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

        $('#choosen').click(function() {
            var versi = $("#bom-input").val().split(' ')[1];
            var id = $("#bom-input").val().split(' ')[2];
            console.log($("#bom-input").val().split(' '));
            $.ajax({
                url: "/ppic/schedule/create",
                method: "POST",
                data: {
                    id_produk: id,
                    bom: versi,
                },
                success: function(data) {

                    console.log(data);
                    $('#' + bom_id).html("Versi " + versi);
                    $('#show-bom').modal('hide');
                },
                error: function(xhr, status, error) {
                    console.log(error);
                }
            });
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

        $("#bom-input").change(function() {
            var value = $("#bom-input").val().split(' ')[0];
            $('#table-bom').hide();
            $('#table-bom tbody').html('');
            $('#table-bom tfoot').html('');
            $('#table-bom').show(1000);

            if (value != "Choose...") {
                $.ajax({
                    url: "/ppic/get_bom/" + value,
                    success: function(result) {
                        var_result = result;
                        var data = $('#table-bom tbody')

                        for (var j = 0; j < result.length - 1; j++) {
                            var pemotongan = parseInt(result[j].jumlah) * parseInt(var_result[var_result.length - 1]);
                            var sisa = parseInt(result[j].stok) - pemotongan;
                            var child;
                            if (sisa == 0) {
                                child = `
                                <tr style="background: yellow;">
                                    <td>` + String(j + 1) + `</td>
                                    <td>` + result[j].nama + `</td>
                                    <td>` + result[j].jumlah + `</td>
                                    <td>` + result[j].stok + `</td>
                                    <td>` + pemotongan + `</td>
                                    <td>` + sisa + `</td>
                                </tr>
                            `;
                            } else {
                                child = `
                                <tr>
                                    <td>` + String(j + 1) + `</td>
                                    <td>` + result[j].nama + `</td>
                                    <td>` + result[j].jumlah + `</td>
                                    <td>` + result[j].stok + `</td>
                                    <td>` + pemotongan + `</td>
                                    <td>` + sisa + `</td>
                                </tr>
                            `;
                            }
                            data.append(child);
                        }
                        var last_child = `
                                <tr>
                                    <th colspan="5">Jumlah Maksimum Produksi</th>
                                    <th>` + var_result[var_result.length - 1] + `</th>
                                </tr>
                        `;

                        $('#table-bom tfoot').html(last_child);
                    },
                    error: function(xhr, status, error) {
                        bootbox.alert({
                            centerVertical: true,
                            message: "BOM tidak ditemukan",
                        });

                        console.log(error);
                    }
                });
            }
        });

        $('.choose-bom').click(function() {
            console.log("test")
            $('#show-bom').modal('show');
            bom_id = this.id;
            var input_bom = $('#bom-input').html(`<option selected>Choose...</option>`);
            $.ajax({
                url: '/ppic/get_bom_version/' + bom_id,
                method: 'GET',
                success: function(result) {
                    var data = JSON.parse(result);
                    for (var i = 0; i < data.length; i++) {
                        input_bom.append(`<option value="` + data[i].id + " " + data[i].versi + " " + data[i].detail_produk_id + `">Versi ` + data[i].versi + `</option>`)
                    }
                }
            });
        });
    });
</script>
@stop