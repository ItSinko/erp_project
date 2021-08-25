<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Test Page</title>
        <link rel="stylesheet" href="{{ asset('vendor/adminlte/dist/css/adminlte.css') }}" />
    </head>
    <body>
        <h1>Hello everyone</h1>
        <div id="notif">
        <div class="toast" role="alert" aria-live="assertive" aria-atomic="true">
  <div class="toast-header">
    <svg class=" rounded mr-2" width="20" height="20" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice"
      focusable="false" role="img">
      <rect fill="#007aff" width="100%" height="100%" /></svg>
    <strong class="mr-auto">Bootstrap</strong>
    <small class="text-muted">11 mins ago</small>
    <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  <div class="toast-body">
    Hello, world! This is a toast message.
  </div>
</div>
        </div>
        <!-- <script src="{{ asset('vendor/jquery/jquery.js') }}"></script>
        <script src="{{ asset('vendor/adminlte/dist/js/adminlte.js') }}"></script> -->
        <script src="{{ asset('js/app.js') }}"></script>
        <script>
            echo_obj.channel('event')
                .listen('SimpleNotifEvent', (e) => {
                    document.getElementById("notif").innerHTML = `
                    <div class="toast" role="alert" aria-live="assertive" aria-atomic="true">
  <div class="toast-header">
    <svg class=" rounded mr-2" width="20" height="20" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice"
      focusable="false" role="img">
      <rect fill="#007aff" width="100%" height="100%" /></svg>
    <strong class="mr-auto">Bootstrap</strong>
    <small class="text-muted">11 mins ago</small>
    <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  <div class="toast-body">
    Hello, world! This is a toast message.
  </div>
</div>
                    `;
                
                    alert('test');
                });
        </script>
    </body>
</html>