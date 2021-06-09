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
            <div class="btn-group" role="group">
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
</style>
@stop

@section('content')
<div class="row">
    <div class="col-md-3 calendar-view">
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
                            <tr id="row1_{{ $d->id }}">
                                <td>{{$d->detail_produk->nama}}</td>
                                <td>
                                    @if ($d->versi_bom == NULL)
                                    null
                                    @else
                                    {{$d->versi_bom}}
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            @can('admin')
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
            <button class="btn btn-info btn-block" id="show-bppb">Buat bppb</button>
        </div>
    </div>
    <div class="col-md-9 calendar-view">
        <div class="card">
            <div class="card-body">
                <div id='calendar'></div>
                <div id="date" hidden>{{ $event }}</div> <!-- catch data from controller -->
                <div id="user" hidden>{{ (Auth::user()) }}</div>
            </div>
        </div>
    </div>
    <div class="col-12 table-view" style="display: none;">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Table View</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body" style="overflow-x: auto;">
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

<div class="modal fade" id="date-form">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h4 class="modal-title w-100 font-weight-bold">Produksi</h4>
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group row">
                    <label for="color-chooser" class="col-sm-2 col-form-label">Pilih warna</label>
                    <input type="color" id="color-chooser">
                </div>
                <div class="form-group row">
                    <label for="product" class="col-sm-2 col-form-label">Produksi</label>
                    <div class="col-sm-10">
                        <select name="" id="product" class="form-control select2" data-placeholder="Pilih Produk...">
                            <option value=""></option>
                            @foreach($produk as $d)
                            <option value="{{ $d->id }}">{{ $d->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="quantity" class="col-sm-2 col-form-label">Jumlah Produksi</label>
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
            <div class="modal-footer justify-content-center">
                <button type="submit" class="btn btn-primary" id="save">Simpan</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="show-bom">
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
                    <select class="custom-select" id="bom-input">
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
                <button type="submit" class="btn btn-primary" id="choose-bom">Pilih</button>
                <button class="btn btn-danger" id="delete-event">Hapus</button>
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
                        @foreach($date as $d)
                        <tr id="row2_{{ $d->id }}">
                            <td>{{ $d->detail_produk->nama }}</td>
                            <td>{{ $d->jumlah_produksi }}</td>
                            <td><button class="btn btn-info send" value="{{ $d->id }}">
                            @if ($d->status == "permintaan")
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
<script>
    var initial_event = JSON.parse($('#date').html()); // load event from database
    var user = JSON.parse($('#user').html()); // load user authorisation

    var bom_id;

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

    function choose_view(view) {
        if (view == 'Kalender') {
            $('.calendar-view').show(500);
            $('.table-view, .list-view').hide();
        } else if (view == 'Tabel') {
            $('.table-view').show(500);
            $('.calendar-view, .list-view').hide();
        } else if (view == 'Daftar') {
            $('.list-view').show(500);
            $('.calendar-view, .table-view').hide();
        }
    }

    // todo: change this function
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

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).ready(function() {

        var Calendar = FullCalendar.Calendar;
        var calendarEl = document.getElementById('calendar');

        // var status;
        var event_info;

        // if (initial_event.length != 0) {
        //     status = initial_event[0].status;
        // } else {
        //     status = 'penyusunan';
        // }
        // choose_status(status);

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
                    $('#date-form').modal();
                } else if ((date1.getMonth() + 1 == date2.getMonth()) && (date2.getDate() == 1)) {
                    $('#date-form').modal();
                } else {
                    bootbox.alert({
                        message: "Harap pilih tanggal produksi pada bulan yang sama",
                        centerVertical: true,
                    });
                }
            },

            eventClick: function(info) {
                $('#show-bom').modal('show');
                event_info = info;
                console.log(event)
                $.ajax({
                    url: "/ppic/get_bom",
                    method: "GET",
                    data: {
                        detail_id: info.event._def.publicId
                    },
                    success: function(result) {
                        $('#bom-input').empty();
                        $('#bom-input').append(`<option value="">Pilih versi...</option>`);
                        result.forEach(element => {
                            $('#bom-input').append(`<option value="` + element.id + `">` + element.versi + `</option>`);
                        });
                    }
                })
            },
        });
        calendar.render();


        $('#color-chooser').change(function(e) {
            var currColor = $(this).val();
            $('#save').css({
                'background-color': currColor,
                'border-color': currColor
            })
        });

        $('.view').click(function() {
            choose_view($(this).text());
        });

        $('#save').click(function() {
            var color = $(this).css('background-color');
            if ($('#product').val()) {
                var data_saved = {
                    id_produk: $('#product').val(),
                    start: $('#date_start').val(),
                    end: $('#date_end').val(),
                    status: "penyusunan",
                    jumlah: $('#jumlah-produksi').val(),
                    color: color,
                }
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
                        $('#date-form').modal('hide');
                        $('#product_list_body').append(`<tr id="row1_` + result.id + `" >
                            <td>` + result.nama + `</td>
                            <td>null</td>
                        </tr>`);

                        $('#product').val(null);
                        $('#jumlah-produksi').val(null);
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

        $('#delete-event').click(function() {
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
                                id: event_info.event._def.publicId
                            },
                            method: "POST",
                            success: function() {
                                event_info.event.remove();
                                $('#row1_' + event_info.event._def.publicId).remove();
                                $('#row2_' + event_info.event._def.publicId).remove();
                                $('#show-bom').modal('hide');
                            }
                        });
                    }
                }
            });
        });


        // todo: change this
        // $('.status').on('click', function() {
        //     var message, status;
        //     if ($(this).attr('id') == 'acc') {
        //         choose_status('acc')
        //         message = "Jadwal telah di ACC";
        //         status = 'acc';
        //         $.ajax({
        //             url: '/notif',
        //             type: 'POST',
        //             data: {
        //                 message: message,
        //                 status: status,
        //             },
        //             success: function() {
        //                 console.log('notif sent');
        //             },
        //             error: function(err) {
        //                 console.log('error: ' + err);
        //             }
        //         });

        //     } else {
        //         var add_message;
        //         if (user.nama == "Anna") {
        //             bootbox.prompt({
        //                 title: "Keterangan",
        //                 centerVertical: true,
        //                 callback: function(result) {
        //                     add_message = result;
        //                     message = "Jadwal dibatalkan untuk di ACC:<br>" + add_message;
        //                     status = 'penyusunan';
        //                     $.ajax({
        //                         url: '/notif',
        //                         type: 'POST',
        //                         data: {
        //                             message: message,
        //                             status: status,
        //                         },
        //                         success: function() {
        //                             console.log('notif sent');
        //                         },
        //                         error: function(err) {
        //                             console.log('error: ' + err);
        //                         }
        //                     });
        //                 }
        //             });
        //         }
        //     }
        // });


        $("#bom-input").change(function() {
            var value = $("#bom-input").val();
            $('#table-bom').hide();
            $('#table-bom tbody').html('');
            $('#table-bom tfoot').html('');
            $('#table-bom').show(1000);

            if (value != "Choose...") {
                $.ajax({
                    url: "/ppic/get_bom",
                    method: "GET",
                    data: {
                        produk_bill_of_material_id: value
                    },
                    success: function(result) {
                        var data = $('#table-bom tbody');

                        var min = Infinity;
                        for (var j = 0; j < result.length - 1; j++) {
                            var temp = parseInt(result[j].stok/result[j].jumlah);
                            if (temp < min){
                                min = temp;
                            }
                        }

                        for (var j = 0; j < result.length - 1; j++) {
                            var pemotongan = parseInt(result[j].jumlah) * min;
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
                                    <th>` + min + `</th>
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

        $("#choose-bom").click(function(){
            console.log(event_info.event._def.publicId);
            $.ajax({
                url: "/ppic/schedule/create",
                method: "POST",
                data: {
                    versi: $("#bom-input").val(),
                    id_event: event_info.event._def.publicId,
                },
                success: function(result){
                    $('.row_' + event_info.event._def.publicId + " td:nth-child(2)").html(result.versi_bom);
                    $('#show-bom').modal('hide');

                    $('#table-bppb tbody').append(`<tr id="row2_` + result.id + `" >
                            <td>` + result.nama + `</td>
                            <td>` + result.jumlah + `</td>
                            <td><button class="btn btn-info send" value="` + result.id + `">Kirim</button></td>
                        </tr>`);
                },
                error: function(error){
                    console.log(error);
                }
            });
        });

        $("#show-bppb").click(function(){
            $("#create-bppb").modal('show');
        });

        $(".send").click(function(){
            $(this).html(`<i class="fas fa-check"></i>`)
        });

        $("#send-all").click(function(){
            $(".send").html(`<i class="fas fa-check"></i>`)
        });

        $("#done-bppb").click(function(){
            $("#create-bppb").modal("hide");
        });

        $(".send").on("click", function(){
            if ($(this).val() != "permintaan")
            {
                $.ajax({
                    url: "/ppic/schedule/create",
                    method: "POST",
                    data: {
                        status_update: true,
                        status: "permintaan",
                        id: $(this).val(),
                    },
                    success: function(result){
                        console.log(result);
                    }
                });
            }
        });
    });
</script>
@stop