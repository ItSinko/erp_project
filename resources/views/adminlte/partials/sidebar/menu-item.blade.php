@inject('menuItemHelper', 'JeroenNoten\LaravelAdminLte\Helpers\MenuItemHelper')

@if (isset($item['auth']))
@foreach($item['auth'] as $user)
@if ($user == Auth::user()->nama)

@if ($menuItemHelper->isHeader($item))

{{-- Header --}}
@include('adminlte.partials.sidebar.menu-item-header')

@elseif ($menuItemHelper->isSearchBar($item))

{{-- Search form --}}
@include('adminlte.partials.sidebar.menu-item-search-form')

@elseif ($menuItemHelper->isSubmenu($item))

{{-- Treeview menu --}}
@include('adminlte.partials.sidebar.menu-item-treeview-menu')

@elseif ($menuItemHelper->isLink($item))

{{-- Link --}}
@include('adminlte.partials.sidebar.menu-item-link')

@endif

@endif
@endforeach
@else

@if ($menuItemHelper->isHeader($item))

{{-- Header --}}
@include('adminlte.partials.sidebar.menu-item-header')

@elseif ($menuItemHelper->isSearchBar($item))

{{-- Search form --}}
@include('adminlte.partials.sidebar.menu-item-search-form')

@elseif ($menuItemHelper->isSubmenu($item))

{{-- Treeview menu --}}
@include('adminlte.partials.sidebar.menu-item-treeview-menu')

@elseif ($menuItemHelper->isLink($item))

{{-- Link --}}
@include('adminlte.partials.sidebar.menu-item-link')

@endif

@endif