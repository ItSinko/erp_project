@extends('adminlte.page')

@section('title', 'Beta Version')

@section('content_header')
<h1 class="m-0 text-dark">PPIC Scheduler</h1>
@stop

@section('adminlte_css')
<link href='{{ asset("vendor/fullcalendar/main.css") }}' rel='stylesheet' />
@stop

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="modal fade" id="date_form" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header text-center">
                                <h4 class="modal-title w-100 font-weight-bold">Select Date</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body mx-3">
                                <div class="form-group row">
                                    <label for="activity" class="col-sm-2 col-form-label">Activity</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="activity" placeholder="name" autocomplete="off">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="days" class="col-sm-2 col-form-label">Days</label>
                                    <div class="col-sm-10">
                                        <input type="number" class="form-control" id="days" placeholder="number of days" min="1" autocomplete="off" readonly>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="date_start">Date start</label>
                                        <input type="date" class="form-control" id="date_start" autocomplete="off">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="date_end">Date end</label>
                                        <input type="date" class="form-control" id="date_end" autocomplete="off">
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer d-flex justify-content-center">
                                <button type="submit" class="btn btn-default" id="save">Save</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div id='calendar'></div>
                <div id="date" hidden>{{ $date }}</div> <!-- catch data from controller -->
            </div>
        </div>
    </div>
</div>
@stop

@section('adminlte_js')
<script src="{{ asset('vendor/fullcalendar/main.js') }}"></script>
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

        var calendarEl = $('#calendar')[0];
        var calendar = new FullCalendar.Calendar(calendarEl, {
            selectable: true,
            events: initial_date,
            select: function(info) {
                start_date = info.startStr;
                end_date = info.endStr;
                $('#date_start').val(info.startStr);
                $('#date_end').val(info.endStr);
                date1 = new Date(start_date);
                date2 = new Date(end_date);
                $('#days').val(difference(date1, date2));
                $('#date_form').modal('show');
            },
            eventClick: function(event_info) {
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
            }
        });
        calendar.render();

        $('#date_end').change(function() {
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
                        start: start_date,
                        end: end_date,
                    },
                    success: function() {
                        console.log('success');
                        calendar.addEvent({
                            title: $('#activity').val(),
                            start: start_date,
                            end: end_date,
                        });
                        $('#date_form').modal('hide');
                        $('#activity').val('');
                    }
                })
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
    });
</script>
@stop