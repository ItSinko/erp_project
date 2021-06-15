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
<h1 class="m-0 text-dark">Permintaan BPPB</h1>
@stop

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                {{ $result }}
            </div>
        </div>
    </div>
</div>
@stop

@section ('adminlte_js')
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
                        <p class="text-sm">` + e.status + `</p>
                    </div>
                </div>
                <!-- Message End -->
            </a>
            `;

        $("#notif").prepend(content);
    }

    Echo.private('message-events')
        .listen('RealTimeMessage', function(e) {
            global_e = e;
            insertAtIndex(e);

            count = $('#notif a#notif-item').length;

            $('#notif-header').text(count + ' notifications');
            $('span.badge').text(count);
            $('span.badge').show();
        });
</script>
@stop