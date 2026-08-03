<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Dashboard') | {{ config('app.name', 'MBC Bangladesh') }}</title>

    <link rel="shortcut icon" href="{{ asset('default-img/popi-logo.png') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/bootstrap/css/bootstrap-datepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/bootstrap/css/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/datatable/css/buttons.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/datatable/css/select.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/toastr/toastr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/css/style.css') }}">
    @stack('styles')
    @if(isset($appSettings))
    <style>
        .popi-header {
            --header-bg: {{ $appSettings->header_color }};
            --header-bg-dark: {{ $appSettings->header_color }};
        }
        .popi-sidebar {
            background-color: {{ $appSettings->navbar_color }} !important;
        }
        .popi-sidebar__brand {
            background-color: rgba(0,0,0,0.15) !important;
        }
    </style>
    @endif
</head>

<body class="popi-shell">
    @php
        $headerUser = auth()->user();
        $headerName = $headerUser->name ?? 'User';
        $headerEmail = $headerUser->email ?? '';
        $headerInitials = collect(explode(' ', $headerName))
            ->filter()
            ->take(2)
            ->map(fn ($part) => mb_substr($part, 0, 1))
            ->implode('');
        $profileUrl = $headerUser && $headerUser->hasRole('Officer')
            ? route('officer.profile')
            : url('access-control/user/' . auth()->id());
    @endphp

    <div class="popi-wrapper">
        <aside class="popi-sidebar">
            <div class="popi-sidebar__brand">
                <a href="{{ route('home') }}">
                    {{ isset($appSettings) ? $appSettings->brand_name : 'MBC Bangladesh.com' }}
                </a>
            </div>

            <nav class="popi-sidebar__nav">
                @hasSection('sidebar')
                    @yield('sidebar')
                @else
                    @include('admin.partial.sidebar')
                @endif
            </nav>
        </aside>

        <div class="popi-sidebar__overlay" data-popi-sidebar-close></div>

        <div class="popi-main">
            <header class="popi-header">
                <button type="button" class="popi-header__toggle" data-popi-sidebar-toggle aria-label="Toggle sidebar">
                    <i class="fa fa-bars"></i>
                </button>

                <span class="popi-header__title">@yield('header-title', isset($appSettings) ? $appSettings->brand_name : config('app.name', 'MBC Bangladesh'))</span>

                <ul class="popi-header__nav">
                    <li>
                        <a class="popi-header__quick" href="{{ route('home') }}" title="Dashboard">
                            <i class="fa fa-home"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    @if($headerUser && $headerUser->hasAnyRole(['Master Admin', 'Super Admin']))
                        <li>
                            <a class="popi-header__quick" href="{{ route('master.settings.edit') }}" title="Settings">
                                <i class="fa fa-cog"></i>
                                <span>Settings</span>
                            </a>
                        </li>
                    @endif
                    <li class="dropdown">
                        <a class="popi-header__user" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-label="Open profile menu">
                            <span class="popi-header__avatar">
                                @if($headerUser && $headerUser->profile_image)
                                    <img src="{{ asset($headerUser->profile_image) }}" alt="{{ $headerName }}">
                                @else
                                    {{ $headerInitials ?: 'U' }}
                                @endif
                            </span>
                            <span class="popi-header__user-text">
                                <span class="popi-header__user-name">{{ $headerName }}</span>
                                <span class="popi-header__user-role">{{ $headerUser ? $headerUser->getRoleNames()->first() : 'Account' }}</span>
                            </span>
                            <i class="fa fa-angle-down"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-right popi-header__dropdown">
                            <li class="popi-header__dropdown-head">
                                <div class="popi-header__dropdown-avatar">{{ $headerInitials ?: 'U' }}</div>
                                <div>
                                    <strong>{{ $headerName }}</strong>
                                    <span>{{ $headerEmail }}</span>
                                </div>
                            </li>
                            <li><div class="dropdown-divider"></div></li>
                            <li>
                                <a class="dropdown-item" href="{{ route('home') }}">
                                    <i class="fa fa-dashboard"></i> Dashboard
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ $profileUrl }}">
                                    <i class="fa fa-user"></i> Profile
                                </a>
                            </li>
                            @if($headerUser && $headerUser->hasRole('Officer'))
                                <li>
                                    <a class="dropdown-item" href="{{ route('officer.booking-form') }}">
                                        <i class="fa fa-edit"></i> Booking Form
                                    </a>
                                </li>
                            @endif
                            @if($headerUser && $headerUser->hasAnyRole(['Master Admin', 'Super Admin']))
                                <li>
                                    <a class="dropdown-item" href="{{ route('master.settings.edit') }}">
                                        <i class="fa fa-cogs"></i> Application Settings
                                    </a>
                                </li>
                            @endif
                            <li><div class="dropdown-divider"></div></li>
                            <li>
                                <a class="dropdown-item popi-header__logout" href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="fa fa-sign-out"></i> {{ __('Logout') }}
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </header>

            <main class="popi-content">
                @yield('content')
            </main>
        </div>
    </div>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
    </form>

    <script src="{{ asset('js/main.js') }}"></script>
    <script src="{{ asset('assets/admin/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/plugins/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/plugins/dataTables.bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/admin/datatable/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets/admin/datatable/js/jszip.min.js') }}"></script>
    <script src="{{ asset('assets/admin/datatable/js/pdfmake.min.js') }}"></script>
    <script src="{{ asset('assets/admin/datatable/js/vfs_fonts.js') }}"></script>
    <script src="{{ asset('assets/admin/datatable/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('assets/admin/datatable/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('assets/admin/datatable/js/buttons.colVis.min.js') }}"></script>
    <script src="{{ asset('assets/admin/datatable/js/dataTables.select.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/plugins/select2.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/plugins/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/moment.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/sweetalert.min.js') }}"></script>
    <script src="{{ asset('assets/admin/toastr/toastr.min.js') }}"></script>
    <script src="{{ asset('vue-js/vue/dist/vue.min.js') }}"></script>
    <script src="{{ asset('vue-js/axios/dist/axios.min.js') }}"></script>

    <script>
        (function ($) {
            'use strict';

            function initSidebar() {
                const toggleButton = document.querySelector('[data-popi-sidebar-toggle]');
                const closeOverlay = document.querySelector('[data-popi-sidebar-close]');
                const mobileQuery = window.matchMedia('(max-width: 991.98px)');

                if (toggleButton) {
                    toggleButton.addEventListener('click', function (event) {
                        event.preventDefault();
                        document.body.classList.toggle(
                            mobileQuery.matches ? 'popi-sidebar--open' : 'popi-sidebar--collapsed'
                        );
                    });
                }

                if (closeOverlay) {
                    closeOverlay.addEventListener('click', function () {
                        document.body.classList.remove('popi-sidebar--open');
                    });
                }

                window.addEventListener('resize', function () {
                    document.body.classList.remove(
                        mobileQuery.matches ? 'popi-sidebar--collapsed' : 'popi-sidebar--open'
                    );
                });
            }

            function initTreeview() {
                document.querySelectorAll('.treeview > a').forEach(function (link) {
                    link.addEventListener('click', function (event) {
                        const submenu = link.nextElementSibling;

                        if (!submenu || !submenu.classList.contains('treeview-menu')) {
                            return;
                        }

                        event.preventDefault();

                        const parent = link.parentElement;
                        const isExpanded = submenu.classList.contains('expanded');

                        document.querySelectorAll('.treeview-menu.expanded').forEach(function (openMenu) {
                            if (openMenu !== submenu) {
                                openMenu.style.maxHeight = null;
                                openMenu.classList.remove('expanded');
                                openMenu.parentElement.classList.remove('is-expanded');
                            }
                        });

                        submenu.classList.toggle('expanded', !isExpanded);
                        parent.classList.toggle('is-expanded', !isExpanded);
                        submenu.style.maxHeight = isExpanded ? null : submenu.scrollHeight + 'px';
                    });
                });

                document.querySelectorAll('.treeview-menu.expanded').forEach(function (menu) {
                    menu.style.maxHeight = menu.scrollHeight + 'px';
                    menu.parentElement.classList.add('is-expanded');
                });

                if ($.fn.off) {
                    $('[data-toggle="treeview"]').off('click');
                }
            }

            function initDataTables() {
                const tables = $('#sampleTable, #secondSampleTable');

                if (!tables.length || !$.fn.DataTable) {
                    return;
                }

                tables.DataTable({
                    dom: '<"top"Blfr>t<"bottom"ip>',
                    responsive: true,
                    buttons: [
                        { extend: 'copy', exportOptions: { columns: ':visible' } },
                        { extend: 'csv', exportOptions: { columns: ':visible' } },
                        { extend: 'excel', exportOptions: { columns: ':visible' } },
                        { extend: 'print', exportOptions: { columns: ':visible' } },
                        { extend: 'pdf', exportOptions: { columns: ':visible' } },
                        @hasSection('datatable-buttons')
                            @yield('datatable-buttons')
                        @endif
                        'selectAll',
                        'selectNone'
                    ],
                    columnDefs: [
                        { targets: [], visible: false },
                        { targets: 0, orderable: false, className: 'select-checkbox' }
                    ],
                    select: {
                        style: 'multi'
                    }
                });
            }

            function initDateInputs() {
                $('.demoDate, .demoDate2').on('keyup', function () {
                    const value = this.value;

                    if ((value.length === 2 || value.length === 5) && /[0-9]/.test(value)) {
                        this.value = value + '-';
                    }
                });

                if ($.fn.datepicker) {
                    $('.demoDate, .demoDate2, .demoDate3').datepicker({
                        format: 'dd-mm-yyyy',
                        autoclose: true,
                        todayHighlight: true,
                        orientation: 'bottom right'
                    });

                    $('#datepicker').datepicker({
                        format: 'mm/yyyy',
                        minViewMode: 1,
                        autoclose: true,
                        todayHighlight: true
                    });
                }
            }

            function initPlugins() {
                if ($.fn.select2) {
                    $('.select2').select2({ width: 'resolve' });
                }

                $('.delete-confirm').on('click', function (event) {
                    const form = $(this).closest('form');
                    const name = $(this).data('name') || 'this item';

                    event.preventDefault();

                    swal({
                        title: 'Are you sure you want to delete ' + name + '?',
                        text: 'If you delete this, it will be gone forever.',
                        icon: 'warning',
                        buttons: true,
                        dangerMode: true
                    }).then(function (willDelete) {
                        if (willDelete) {
                            form.submit();
                        }
                    });
                });
            }

            $(function () {
                initSidebar();
                initTreeview();
                initDataTables();
                initDateInputs();
                initPlugins();
            });
        })(jQuery);
    </script>

    {!! Toastr::message() !!}

    @if ($errors->any())
        <script>
            @foreach ($errors->all() as $error)
                toastr.error(@json($error), 'Error', {
                    closeButton: true,
                    progressBar: true
                });
            @endforeach
        </script>
    @endif

    @stack('scripts')
</body>

</html>
