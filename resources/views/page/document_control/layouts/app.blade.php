<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>@yield('title') | {{config('settings.system_title')}}</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <link rel="stylesheet" href="{{asset('vendor/digidocu/css/bootstrap3.css')}}">
    <link rel="stylesheet" href="{{asset('vendor/digidocu/css/bootstrap-toggle.css')}}">
    <link rel="stylesheet" href="{{asset('vendor/fontawesome-free/css/all.css')}}">
    <link rel="stylesheet" href="{{asset('vendor/select2/css/select2.css')}}">
    <link rel="stylesheet" href="{{asset('vendor/digidocu/css/AdminLTE.min.css')}}">
    <link rel="stylesheet" href="{{asset('vendor/digidocu/css/skin-blue-light.min.css')}}">
    <link rel="stylesheet" href="{{asset('vendor/digidocu/css/square_all.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('vendor/daterangepicker/css/daterangepicker.css')}}" />
    <link rel="stylesheet" href="{{asset('vendor/digidocu/css/bootstrap3-wysihtml5.min.css')}}">
    <link rel="stylesheet" href="{{asset('vendor/digidocu/css/bootstrap-tagsinput.css')}}">
    <link rel="stylesheet" href="{{asset('vendor/digidocu/css/digidocu-custom.css')}}">
    @yield('css')
</head>

<body class="skin-blue-light sidebar-mini">
    <div class="wrapper">
        <!-- Main Header -->
        <header class="main-header">

            <!-- Logo -->
            <a href="{{route('home')}}" class="hidden-xs logo">
                <span class="logo-mini"><b>D</b></span>
                <span class="logo-lg"><b>Dokumen SPA</b></span>
            </a>

            <!-- Header Navbar -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button" style="content: '\f0c9';">
                    <i class="fas fa-bars"></i>
                    <span class="sr-only">Toggle navigation</span>
                </a>

                <span style="display: inline-block;width: 71vw;text-align: center;font-size: 20px;line-height: 50px;color: white;" class="visible-xs-inline-block">
                    <b>{{config('settings.system_title')}}</b>
                </span>
                <!-- Navbar Right Menu -->
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <!-- User Account Menu -->
                        <li class="dropdown user user-menu">
                            <!-- Menu Toggle Button -->
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <!-- The user image in the navbar-->
                                <img src="{{asset(config('settings.system_logo'))}}" class="user-image" alt="User Image" />
                                <!-- hidden-xs hides the username on small devices so only the image appears. -->
                                <span class="hidden-xs">{!! auth()->user()->nama !!}</span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- The user image in the menu -->
                                <li class="user-header">
                                    <img src="{{asset(config('settings.system_logo'))}}" class="img-circle" alt="User Image" />
                                    <p>
                                        {!! Auth::user()->nama !!}
                                        <small>Member since {!! Auth::user()->created_at->format('M. Y') !!}</small>
                                    </p>
                                </li>
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="#" class="btn btn-default btn-flat">Profile</a>
                                    </div>
                                    <div class="pull-right">
                                        <a href="{!! url('/logout') !!}" class="btn btn-default btn-flat" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            Sign out
                                        </a>
                                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>

        <!-- Left side column. contains the logo and sidebar -->
        @include('page.document_control.layouts.sidebar')
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            @yield('content')
        </div>
    </div>

    <script src="{{asset('vendor/jquery/jquery.js')}}"></script>
    <script src="{{asset('vendor/daterangepicker/js/moment.js')}}"></script>
    <script src="{{asset('vendor/bootstrap/js/bootstrap.js')}}"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/2.4.3/js/adminlte.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/iCheck/1.0.2/icheck.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.min.js"></script>
    <script src="{{asset('vendor/digidocu/js/bootstrap3-typeahead.min.js')}}"></script>
    <script src="{{asset('vendor/digidocu/js/bootstrap-tagsinput.min.js')}}"></script>
    <script src="{{asset('vendor/digidocu/js/bootstrap3-wysihtml5.all.min.js')}}"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/handlebars.js/4.4.2/handlebars.min.js"></script>
    <script src="{{asset('js/handlebar-helpers.js')}}"></script>
    <script src="{{asset('js/digidocu-custom.js')}}"></script>
    @yield('scripts')
</body>

</html>