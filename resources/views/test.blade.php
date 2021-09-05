@extends('adminlte.master')

@section('body')
<h1>Test</h1>
@stop

@section('master_js')
<script>
    var pusher = new Pusher(12345, {
        cluster: "mt1",
    });

    var channel = pusher.subscribe("my-channel");
    channel.bind("my-event", (data) => {
        alert(data);
    });
</script>
@stop