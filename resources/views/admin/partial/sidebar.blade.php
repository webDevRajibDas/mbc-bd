@php
    $routeIs   = fn(...$p) => request()->routeIs(...$p) ? 'active' : '';
    $openIf    = fn(bool $cond) => $cond ? 'is-expanded' : '';
    $expandIf  = fn(bool $cond) => $cond ? 'expanded'   : '';

    $isAccessCtrl   = request()->routeIs('user.*', 'role.*', 'permission.*');
    $isActivityLog  = request()->routeIs('login-activity', 'admin-activity');
    $isGeographic   = request()->routeIs('geographic.*');
    $isMasterAdmin  = request()->routeIs('master.settings.*', 'master.project-names.*', 'master.property-categories.*', 'master.property-stores.*');
    $isEShop        = request()->routeIs('admin.e-shop.*');
@endphp

<ul class="app-menu">

    <li>
        <a class="app-menu__item {{ $routeIs('home') }}" href="{{ route('home') }}">
            <i class="app-menu__icon fa fa-tachometer"></i>
            <span class="app-menu__label">Dashboard</span>
        </a>
    </li>

    @can('Access control menu')
    <li class="treeview {{ $openIf($isAccessCtrl) }}">
        <a class="app-menu__item" href="#" data-toggle="treeview">
            <i class="app-menu__icon fa fa-shield"></i>
            <span class="app-menu__label">Access Control</span>
            <i class="treeview-indicator fa fa-angle-right"></i>
        </a>
        <ul class="treeview-menu {{ $expandIf($isAccessCtrl) }}">
            <li><a class="treeview-item {{ $routeIs('user.*') }}"
                href="{{ route('user.index') }}">
                <i class="fa fa-angle-right"></i> Users</a></li>
            <li><a class="treeview-item {{ $routeIs('role.*') }}"
                href="{{ route('role.index') }}">
                <i class="fa fa-angle-right"></i> Roles</a></li>
            <li><a class="treeview-item {{ $routeIs('permission.*') }}"
                href="{{ route('permission.index') }}">
                <i class="fa fa-angle-right"></i> Permissions</a></li>
        </ul>
    </li>
    @endcan

    @can('Activity log menu')
    <li class="treeview {{ $openIf($isActivityLog) }}">
        <a class="app-menu__item" href="#" data-toggle="treeview">
            <i class="app-menu__icon fa fa-history"></i>
            <span class="app-menu__label">Activity Log</span>
            <i class="treeview-indicator fa fa-angle-right"></i>
        </a>
        <ul class="treeview-menu {{ $expandIf($isActivityLog) }}">
            <li><a class="treeview-item {{ $routeIs('login-activity') }}"
                href="{{ route('login-activity') }}">
                <i class="fa fa-angle-right"></i> Login Activity</a></li>
            <li><a class="treeview-item {{ $routeIs('admin-activity') }}"
                href="{{ route('admin-activity') }}">
                <i class="fa fa-angle-right"></i> Admin Activity</a></li>
        </ul>
    </li>
    @endcan

    @can('Geographic menu')
    <li class="treeview {{ $openIf($isGeographic) }}">
        <a class="app-menu__item" href="#" data-toggle="treeview">
            <i class="app-menu__icon fa fa-globe"></i>
            <span class="app-menu__label">Geographic Config</span>
            <i class="treeview-indicator fa fa-angle-right"></i>
        </a>
        <ul class="treeview-menu {{ $expandIf($isGeographic) }}">
            <li><a class="treeview-item {{ $routeIs('geographic.divisions.*') }}"
                href="{{ route('geographic.divisions.index') }}">
                <i class="fa fa-angle-right"></i> Divisions</a></li>
            <li><a class="treeview-item {{ $routeIs('geographic.districts.*') }}"
                href="{{ route('geographic.districts.index') }}">
                <i class="fa fa-angle-right"></i> Districts</a></li>
            <li><a class="treeview-item {{ $routeIs('geographic.upazilas.*') }}"
                href="{{ route('geographic.upazilas.index') }}">
                <i class="fa fa-angle-right"></i> Upazilas</a></li>
            <li><a class="treeview-item {{ $routeIs('geographic.unions.*') }}"
                href="{{ route('geographic.unions.index') }}">
                <i class="fa fa-angle-right"></i> Unions</a></li>
        </ul>
    </li>
    @endcan

    @if(auth()->user()->hasAnyRole(['Admin', 'Master Admin', 'Super Admin']))
    <li class="treeview {{ $openIf($isEShop) }}">
        <a class="app-menu__item" href="#" data-toggle="treeview">
            <i class="app-menu__icon fa fa-shopping-cart"></i>
            <span class="app-menu__label">E-Shop Management</span>
            <i class="treeview-indicator fa fa-angle-right"></i>
        </a>
        <ul class="treeview-menu {{ $expandIf($isEShop) }}">
            <li><a class="treeview-item {{ $routeIs('admin.e-shop.categories.*') }}" href="{{ route('admin.e-shop.categories.index') }}"><i class="fa fa-angle-right"></i> Product Categories</a></li>
            <li><a class="treeview-item {{ $routeIs('admin.e-shop.products.*') }}" href="{{ route('admin.e-shop.products.index') }}"><i class="fa fa-angle-right"></i> Products</a></li>
            <li><a class="treeview-item {{ $routeIs('admin.e-shop.stock.*') }}" href="{{ route('admin.e-shop.stock.index') }}"><i class="fa fa-angle-right"></i> Manage Stock</a></li>
        </ul>
    </li>
    <li>
        <a class="app-menu__item {{ $routeIs('admin.packages.*') }}" href="{{ route('admin.packages.index') }}">
            <i class="app-menu__icon fa fa-cubes"></i>
            <span class="app-menu__label">Packages</span>
        </a>
    </li>
    <li>
        <a class="app-menu__item {{ $routeIs('admin.registration-categories.*') }}" href="{{ route('admin.registration-categories.index') }}">
            <i class="app-menu__icon fa fa-id-badge"></i>
            <span class="app-menu__label">Registration Categories</span>
        </a>
    </li>
    @endif

    @if(auth()->user()->hasAnyRole(['Master Admin', 'Super Admin']))
    <li class="treeview {{ $openIf($isMasterAdmin) }}">
        <a class="app-menu__item" href="#" data-toggle="treeview">
            <i class="app-menu__icon fa fa-cogs"></i>
            <span class="app-menu__label">Master Admin</span>
            <i class="treeview-indicator fa fa-angle-right"></i>
        </a>
        <ul class="treeview-menu {{ $expandIf($isMasterAdmin) }}">
            <li><a class="treeview-item {{ $routeIs('master.project-names.*') }}"
                href="{{ route('master.project-names.index') }}">
                <i class="fa fa-angle-right"></i> Project Names</a></li>
            <li><a class="treeview-item {{ $routeIs('master.property-categories.*') }}"
                href="{{ route('master.property-categories.index') }}">
                <i class="fa fa-angle-right"></i> Property Categories</a></li>
            <li><a class="treeview-item {{ $routeIs('master.property-stores.*') }}"
                href="{{ route('master.property-stores.index') }}">
                <i class="fa fa-angle-right"></i> Property Store</a></li>
            <li><a class="treeview-item {{ $routeIs('master.settings.edit') }}"
                href="{{ route('master.settings.edit') }}">
                <i class="fa fa-angle-right"></i> App Settings</a></li>
        </ul>
    </li>
    @endif

</ul>
