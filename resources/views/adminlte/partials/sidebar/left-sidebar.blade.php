<aside class="main-sidebar {{ config('adminlte.classes_sidebar', 'sidebar-dark-primary elevation-4') }}">

    {{-- Sidebar brand logo --}}
    @if(config('adminlte.logo_img_xl'))
    @include('adminlte.partials.common.brand-logo-xl')
    @else
    @include('adminlte.partials.common.brand-logo-xs')
    @endif

    {{-- Sidebar menu --}}
    <div class="sidebar">

        {{--User Profile--}}
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                @if(Auth::user()->foto != NULL)
                <img src="{{url('asset/image/user')}}/{{Auth::user()->foto}}" class="img-circle elevation-2" alt="User Image">
                @else
                <img src="{{url('asset/image/user')}}/unknown.png" class="img-circle elevation-2" alt="User Image">
                @endif
            </div>
            <div class="info" style="color:white;">
                <a href="#" class="d-block">{{Auth::user()->nama}}</a>
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