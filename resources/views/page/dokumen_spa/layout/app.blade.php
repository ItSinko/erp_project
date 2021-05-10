<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>Sinko Prima Alloy | E-Dokumen</title>

  <link rel="stylesheet" href="{{ asset('digidocu/iconfont/material-icons.css') }}">
  <!-- Materialize css -->
  <link rel="stylesheet" href="{{ asset('digidocu/materialize-css/css/materialize.min.css') }}">
  <!-- datatables -->
  <link rel="stylesheet" href="{{ asset('digidocu/DataTables/datatables.min.css') }}">
  <!-- favicon -->
  <link rel="shortcut icon" type="image/x-icon" href="/storage/images/favicon.ico">
  <style>
    body {
      display: flex;
      min-height: 100vh;
      flex-direction: column;
    }

    main {
      flex: 1 0 auto;
    }

    .preloader-background {
      display: flex;
      align-items: center;
      justify-content: center;
      background-color: #eee;

      position: fixed;
      z-index: 100;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
    }
  </style>
</head>

<body>
  @include('page.dokumen_spa.layout.spinner')
  <main>
    <div id="app">
      @include('page.dokumen_spa.layout.navbar')
      @yield('content')
      <!-- Floating Button -->
      <div class="fixed-action-btn">
        <a href="#" class="btn btn-floating btn-large tooltipped" data-position="left" data-delay="50" data-tooltip="Quick Access">
          <i class="large material-icons">explore</i>
        </a>
        <ul>
          <li>
            <a href="/documents/create" class="btn-floating btn-large tooltipped" data-position="left" data-delay="50" data-tooltip="File Upload"><i class="large material-icons">file_upload</i></a>
          </li>
          <li class="hide-on-med-and-down">
            <a href="" class="btn-floating btn-large button-collapse tooltipped" data-activates="slide-out" data-position="left" data-delay="50" data-tooltip="Menu"><i class="large material-icons">menu</i></a>
          </li>
        </ul>
      </div>
    </div>
  </main>
  @include('page.dokumen_spa.layout.footer')

  <!-- Scripts -->
  @include('page.dokumen_spa.layout.scripts')
  <!-- Right click context-menu -->
  <script src="{{ asset('digidocu/js/context-menu.js') }}"></script>
  <!-- MESSAGES -->
  @include('page.dokumen_spa.layout.messages')
</body>

</html>