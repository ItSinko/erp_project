@extends('adminlte.page')

@section('title', 'Beta Version')

@section('content_header')
<h1 class="m-0 text-dark">Chat App</h1>
@stop

@section('content')
<div class="col-12">
    <div class="card direct-chat direct-chat-primary" id="app">
        <div class="card-header">
            <h3 class="card-title">Direct Chat</h3>

            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                </button>
                <notif></notif>
                <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            <div class="direct-chat-messages">
                <chat-messages :messages="messages" :user="{{ Auth::user() }}"></chat-messages>
            </div>
        </div>
        <div class="card-footer">
            <chat-form v-on:messagesent="addMessage" :user="{{ Auth::user() }}"></chat-form>
        </div>
    </div>
</div>
@stop

@section('adminlte_js')
<script src="{{ asset('js/app.js') }}"></script>
<script>
    console.log(app);
</script>
@endsection