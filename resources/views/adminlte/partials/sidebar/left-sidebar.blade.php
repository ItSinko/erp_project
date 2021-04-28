<aside class="main-sidebar {{ config('adminlte.classes_sidebar2', 'sidebar-dark-primary royal-bg elevation-4') }}">

    {{-- Sidebar brand logo --}}
    @if(config('adminlte.logo_img_xl'))
    @include('adminlte.partials.common.brand-logo-xl')
    @else
    @include('adminlte.partials.common.brand-logo-xs')
    @endif

    {{-- Sidebar menu --}}
    <div class="sidebar">

        {{--User Profile--}}
        <a href="#">
            <div class="card mb-3 user-panel-bg" id="user-panel-profil" style="max-width: 540px; margin-top:20px;">
                <div class="row no-gutters">
                    <div class="col-md-4" style="margin:auto; text-align:center; padding-left:10px;">
                        @if(Auth::user()->foto != NULL)
                        <img src="{{url('assets/image/user')}}/{{Auth::user()->foto}}" class="karyawan-img-sm-md circle-button">
                        @else
                        <img src="{{url('assets/image/user')}}/unknown.png" class="karyawan-img-sm-md circle-button">
                        @endif
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title font-weight-bold">{{Auth::user()->nama}}</h5>
                            <p class="card-text">{{ Auth::user()->divisi->nama }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </a>

        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column {{ config('adminlte.classes_sidebar_nav', '') }}" data-widget="treeview" role="menu" @if(config('adminlte.sidebar_nav_animation_speed') !=300) data-animation-speed="{{ config('adminlte.sidebar_nav_animation_speed') }}" @endif @if(!config('adminlte.sidebar_nav_accordion')) data-accordion="false" @endif>
                {{-- Configured sidebar links --}}
                @each('adminlte.partials.sidebar.menu-item', $adminlte->menu('sidebar'), 'item')
            </ul>
        </nav>
    </div>

</aside>