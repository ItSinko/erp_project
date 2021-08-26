@extends('adminlte.master')

@section('body')
<h1>Hello</h1>
<button class="btn btn-primary">Show</button>
<div id="notif" style="position: fixed; bottom: 20px; right: 20px;">
</div>
</div>
</div>
@stop

@section('adminlte_js')
<script src="{{ asset('js/app.js') }}"></script>
<script>
  function create_notif(user, message) {
    $('#notif').append(`
    <div class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-autohide="false" style="width: 300px;">
      <div class="toast-header">
        <strong class="mr-auto">${user}</strong>
        <small class="text-muted">a few seconds ago</small>
        <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="toast-body">
        ${message}
      </div>
    </div>
    `)
  }

  echo_obj.channel('event')
    .listen('SimpleNotifEvent', (e) => {
      create_notif(e.name, e.message);
    });

  $(document).ready(function() {
    $("button").click(function() {
      $(".toast").toast('show');
    });
  });
</script>
@stop