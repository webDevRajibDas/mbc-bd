@php
    $routeIs = fn(...$patterns) => request()->routeIs(...$patterns) ? 'active' : '';
@endphp

<ul class="app-menu">
    <li>
        <a class="app-menu__item {{ $routeIs('officer.dashboard') }}" href="{{ route('officer.dashboard') }}">
            <i class="app-menu__icon fa fa-tachometer"></i>
            <span class="app-menu__label">Officer Dashboard</span>
        </a>
    </li>

    <li>
        <a class="app-menu__item {{ $routeIs('officer.profile') }}" href="{{ route('officer.profile') }}">
            <i class="app-menu__icon fa fa-user-circle"></i>
            <span class="app-menu__label">My Profile</span>
        </a>
    </li>

    <li>
        <a class="app-menu__item {{ $routeIs('officer.booking-form') }}" href="{{ route('officer.booking-form') }}">
            <i class="app-menu__icon fa fa-user-plus"></i>
            <span class="app-menu__label">Booking Form</span>
        </a>
    </li>

    <li>
        <a class="app-menu__item" href="#">
            <i class="app-menu__icon fa fa-briefcase"></i>
            <span class="app-menu__label">Assigned Work</span>
        </a>
    </li>

    <li>
        <a class="app-menu__item" href="#">
            <i class="app-menu__icon fa fa-bell"></i>
            <span class="app-menu__label">Notifications</span>
        </a>
    </li>
</ul>
