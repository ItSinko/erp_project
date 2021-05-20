@extends('adminlte.page')

@section('title', 'Beta Version')

@section('content_header')
<h1 id="page_header" class="m-0 text-dark">Jadwal Produksi</h1>
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
    <div class="col-md-3">
        <div class="sticky-top mb-3">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Daftar Produksi</h4>
                </div>
                <div class="card-body">
                    <!-- the events -->
                    <div id="external-events">
                        <ul>
                            @foreach($date as $d)
                            <li>{{$d->title}}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Produksi Barang</h3>
                </div>
                <div class="card-body">
                    <div class="btn-group" style="width: 100%; margin-bottom: 10px;">
                        <ul class="fc-color-picker" id="color-chooser">
                            <li><a class="text-primary" href="#"><i class="fas fa-square"></i></a></li>
                            <li><a class="text-warning" href="#"><i class="fas fa-square"></i></a></li>
                            <li><a class="text-success" href="#"><i class="fas fa-square"></i></a></li>
                            <li><a class="text-danger" href="#"><i class="fas fa-square"></i></a></li>
                            <li><a class="text-muted" href="#"><i class="fas fa-square"></i></a></li>
                        </ul>
                    </div>
                    <!-- /btn-group -->
                    <div class="input-group">
                        <input id="new-event" type="text" class="form-control" placeholder="Event Title">

                        <div class="input-group-append">
                            <button id="add-new-event" type="button" class="btn btn-primary">Tambah</button>
                        </div>
                        <!-- /btn-group -->
                    </div>
                    <!-- /input-group -->
                    <div class="input-group" style="margin-top: 5px;">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Status</span>
                        </div>
                        <select name="status" id="status" class="form-control">
                            <option value=""></option>
                            <option value="acc">ACC</option>
                            <option value="not_acc">Penyusunan</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-9">
        <div class="alert alert-info alert-dismissible" id="status_info" style="display: none;">
            <h5><i class="icon fas fa-info"></i> Status </h5>
            Proses penyusunan jadwal
        </div>
        <div class="alert alert-success alert-dismissible" id="status_success" style="display: none;">
            <h5><i class="icon fas fa-check"></i> Status</h5>
            Jadwal telah Ditetapkan
        </div>
        <div class="card">
            <div class="card-body">
                <div id='calendar'></div>
                <div id="date" hidden>{{ $event }}</div> <!-- catch data from controller -->
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
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
                            <td>{{$d->title}}</td>
                            <td>{{$d->start}}</td>
                            <td>{{$d->end}}</td>
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
        <div class="card">
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
                            <td>{{$d->title}}</td>
                            @for ($i = 1; $i <= date('t'); $i++) @php $start=date('d', strtotime($d->start));
                                $end = date('d', strtotime($d->end));
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
                    <label for="days" class="col-sm-2 col-form-label">Jumlah Hari</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" id="days" placeholder="number of days" min="1" autocomplete="off" readonly>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="date_start">Tanggal Mulai</label>
                        <input type="date" class="form-control" id="date_start" autocomplete="off">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="date_end">Tanggal Berhenti</label>
                        <input type="date" class="form-control" id="date_end" autocomplete="off">
                    </div>
                </div>
            </div>
            <div class="modal-footer d-flex justify-content-center">
                <button type="submit" class="btn btn-default" id="save">Simpan</button>
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
    var initial_date = JSON.parse($('#date').html()); // load event from database

    function difference(date1, date2) {
        const date1utc = Date.UTC(date1.getFullYear(), date1.getMonth(), date1.getDate());
        const date2utc = Date.UTC(date2.getFullYear(), date2.getMonth(), date2.getDate());
        day = 1000 * 60 * 60 * 24;
        return (date2utc - date1utc) / day
    }

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).ready(function() {
        var start_date, end_date;

        var Calendar = FullCalendar.Calendar;
        var Draggable = FullCalendar.Draggable;

        var calendarEl = document.getElementById('calendar');
        var containerEl = document.getElementById('external-events');

        new Draggable(containerEl, {
            itemSelector: '.external-event',
            eventData: function(eventEl) {
                console.log(eventEl);
                return {
                    title: eventEl.innerText,
                    backgroundColor: window.getComputedStyle(eventEl, null).getPropertyValue('background-color'),
                    borderColor: window.getComputedStyle(eventEl, null).getPropertyValue('background-color'),
                    textColor: window.getComputedStyle(eventEl, null).getPropertyValue('color'),
                };
            }
        })

        var calendar = new FullCalendar.Calendar(calendarEl, {
            locale: 'id',
            weekNumbers: true,
            weekends: false,
            selectable: true,
            editable: true,
            droppable: true,
            events: initial_date,
            select: function(info) {
                console.log(info);
                $('#date_form').modal();
                $('#date_start').val(info.startStr);
                $('#date_end').val(info.endStr);

                var date1 = new Date(info.startStr);
                var date2 = new Date(info.endStr);

                var days = difference(date1, date2);
                var weeks = Math.floor(days / 7);
                days = days - (weeks * 2);

                var startDay = date1.getDay();
                var endDay = date2.getDay() - 1;

                // Remove weekend not previously removed.   
                if (startDay - endDay > 1)
                    days = days - 2;

                // Remove start day if span starts on Sunday but ends before Saturday
                if (startDay == 0 && endDay != 6)
                    days = days - 1

                // Remove end day if span ends on Saturday but starts after Sunday
                if (endDay == 6 && startDay != 0)
                    days = days - 1

                $('#days').val(days);
            },
            eventClick: function(event_info) {
                console.log(event_info);
                bootbox.confirm({
                    centerVertical: true,
                    message: "Do you want delete this event?",
                    buttons: {
                        confirm: {
                            label: 'Yes',
                            className: 'btn-success'
                        },
                        cancel: {
                            label: 'No',
                            className: 'btn-danger'
                        }
                    },
                    callback: function(result) {
                        if (result) {
                            console.log(event_info.event);
                            $.ajax({
                                url: "{{ route('schedule.delete') }}",
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
            drop: function(info) {
                // if so, remove the element from the "Draggable Events" list
                console.log(info);
                info.draggedEl.parentNode.removeChild(info.draggedEl);
                var result = new Date();
                var start = new Date(info.dateStr);
                result = [result.getFullYear(), result.getMonth(), result.getDate()].join('-');
                console.log(result);
                var data = {
                    title: info.draggedEl.innerText,
                    start: info.dateStr,
                    end: result,
                }
                console.log(data);
                $.ajax({
                    url: "{{ route('schedule.create') }}",
                    method: "POST",
                    data: {
                        title: info.draggedEl.innerText,
                        start: info.dateStr,
                        end: result,
                    },
                    success: function(result) {
                        console.log(result);
                        calendar.addEvent({
                            id: result.id,
                            title: result.title,
                            start: result.start,
                            end: result.end,
                        });
                        $('#date_form').modal('hide');
                        $('#activity').val('');
                    }
                });
            }
        });
        calendar.render();

        /* ADDING EVENTS */
        var currColor = '#3c8dbc' //Red by default
        //Color chooser button
        $('#color-chooser > li > a').click(function(e) {
            e.preventDefault();
            //Save color
            currColor = $(this).css('color');
            console.log(currColor);
            //Add color effect to button
            $('#activity').css({
                'background-color': currColor,
                'border-color': currColor
            })
        });
        $('#add-new-event').click(function(e) {
            $('#external-events > p').remove();
            e.preventDefault()
            //Get value and make sure it is not null
            var val = $('#new-event').val()
            if (val.length == 0) {
                return
            }

            //Create events
            var event = $('<div />')
            event.css({
                'background-color': currColor,
                'border-color': currColor,
                'color': '#fff'
            }).addClass('external-event')
            event.html(val)
            $('#external-events').prepend(event);

            //Remove event from text input
            $('#new-event').val('')
        });

        $('#date_end').click(function() {
            alert('change end date');
            date1 = new Date(start_date);
            end_date = this.value;
            date2 = new Date(end_date);
            $('#days').val(difference(date1, date2));
        });

        $('#date_start').change(function() {
            start_date = this.value;
            date1 = new Date(start_date);
            date2 = new Date(end_date);
            $('#days').val(difference(date1, date2));
        });

        $('#save').click(function() {
            if ($('#activity').val()) {
                console.log('enter ajax');
                $.ajax({
                    url: "{{ route('schedule.create') }}",
                    method: "POST",
                    data: {
                        title: $('#activity').val(),
                        start: $('#date_start').val(),
                        end: $('#date_end').val(),
                    },
                    success: function(result) {
                        console.log(result);
                        calendar.addEvent({
                            id: result.id,
                            title: result.title,
                            start: result.start,
                            end: result.end,
                        });
                        $('#date_form').modal('hide');
                        $('#activity').val('');
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

        $('#status').on('change', function() {
            if ($('#status').val() == 'acc') {
                $('#status_info').hide();
                $('#status_success').show();
                $.ajax({
                    url: '/notif',
                    type: 'GET',
                    success: function() {
                        console.log('notif sent');
                    },
                    error: function(err) {
                        console.log('error: ' + err);
                    }
                });

            } else if ($('#status').val() == 'not_acc') {
                $('#status_info').show();
                $('#status_success').hide();
            } else {
                $('#status_info').hide();
                $('#status_success').hide();
            }
        })
    });
</script>
@stop