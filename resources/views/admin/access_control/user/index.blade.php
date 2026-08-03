@extends('layouts.app')

@section('title', 'Users')
@section('header-title', 'User Management')

@push('styles')
<style>
    .user-page {
        --user-primary: #0d6b5c;
        --user-border: #e7eceb;
        --user-muted: #718096;
    }

    .user-page .app-title {
        align-items: center;
        margin-bottom: 20px;
    }

    .user-page .app-title h1 {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 4px;
        font-size: 24px;
    }

    .user-page .app-title p {
        margin: 0;
        color: var(--user-muted);
    }

    .user-page__actions {
        display: flex;
        align-items: center;
        gap: 8px;
        flex-wrap: wrap;
    }

    .user-stat {
        position: relative;
        display: flex;
        align-items: center;
        min-height: 104px;
        margin-bottom: 20px;
        padding: 18px;
        overflow: hidden;
        background: #fff;
        border: 1px solid var(--user-border);
        border-radius: 10px;
        box-shadow: 0 3px 14px rgba(16, 55, 48, .05);
    }

    .user-stat__icon {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 48px;
        height: 48px;
        margin-right: 14px;
        color: var(--user-primary);
        background: rgba(13, 107, 92, .1);
        border-radius: 12px;
        font-size: 20px;
    }

    .user-stat--active .user-stat__icon {
        color: #168654;
        background: rgba(22, 134, 84, .11);
    }

    .user-stat--inactive .user-stat__icon {
        color: #d97706;
        background: rgba(217, 119, 6, .11);
    }

    .user-stat__value {
        display: block;
        color: #24342f;
        font-size: 25px;
        font-weight: 700;
        line-height: 1.15;
    }

    .user-stat__label {
        color: var(--user-muted);
        font-size: 12px;
        font-weight: 600;
        letter-spacing: .45px;
        text-transform: uppercase;
    }

    .user-directory {
        padding: 0;
        overflow: hidden;
        border: 1px solid var(--user-border);
        border-radius: 10px;
        box-shadow: 0 4px 18px rgba(16, 55, 48, .06);
    }

    .user-directory__header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 16px;
        padding: 20px 22px;
        border-bottom: 1px solid var(--user-border);
    }

    .user-directory__header h3 {
        margin: 0 0 3px;
        color: #24342f;
        font-size: 18px;
    }

    .user-directory__header p {
        margin: 0;
        color: var(--user-muted);
        font-size: 13px;
    }

    .user-directory .table {
        margin: 0;
    }

    .user-directory .table thead th {
        padding: 13px 16px;
        color: #66756f;
        background: #f8faf9;
        border-top: 0;
        border-bottom: 1px solid var(--user-border);
        font-size: 11px;
        font-weight: 700;
        letter-spacing: .55px;
        text-transform: uppercase;
        white-space: nowrap;
    }

    .user-directory .table tbody td {
        padding: 14px 16px;
        vertical-align: middle;
        border-color: #edf1f0;
    }

    .user-directory .table tbody tr:hover {
        background: #fbfdfc;
    }

    .user-identity {
        display: flex;
        align-items: center;
        min-width: 230px;
    }

    .user-avatar {
        display: inline-flex;
        flex: 0 0 42px;
        align-items: center;
        justify-content: center;
        width: 42px;
        height: 42px;
        margin-right: 11px;
        overflow: hidden;
        color: #fff;
        background: linear-gradient(135deg, #0d6b5c, #16947e);
        border-radius: 50%;
        font-size: 13px;
        font-weight: 700;
        letter-spacing: .4px;
    }

    .user-avatar img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .user-identity__name {
        display: block;
        max-width: 240px;
        overflow: hidden;
        color: #24342f;
        font-weight: 600;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .user-identity__email {
        display: block;
        max-width: 260px;
        overflow: hidden;
        color: var(--user-muted);
        font-size: 12px;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .user-role {
        display: inline-block;
        margin: 2px 4px 2px 0;
        padding: 5px 9px;
        color: #31584f;
        background: #edf6f3;
        border: 1px solid #d9ebe6;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 600;
    }

    .user-role--empty {
        color: #7b8581;
        background: #f2f4f3;
        border-color: #e5e8e7;
    }

    .user-status {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        font-size: 12px;
        font-weight: 600;
        text-transform: capitalize;
    }

    .user-status::before {
        width: 7px;
        height: 7px;
        background: currentColor;
        border-radius: 50%;
        content: '';
    }

    .user-status--active { color: #168654; }
    .user-status--inactive { color: #c56c0a; }

    .user-date {
        color: #4f5f59;
        font-size: 12px;
        white-space: nowrap;
    }

    .user-date small {
        display: block;
        color: #96a09c;
    }

    .user-actions {
        display: inline-flex;
        align-items: center;
        justify-content: flex-end;
        gap: 6px;
        white-space: nowrap;
    }

    .user-actions .btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 34px;
        height: 34px;
        padding: 0;
        border-radius: 7px;
    }

    .user-empty {
        padding: 58px 20px !important;
        color: var(--user-muted);
        text-align: center;
    }

    .user-empty i {
        display: block;
        margin-bottom: 10px;
        color: #cbd5d1;
        font-size: 32px;
    }

    .user-directory .dataTables_wrapper {
        padding: 0;
    }

    .user-directory .dataTables_wrapper > .row,
    .user-directory .dataTables_wrapper > .top,
    .user-directory .dataTables_wrapper > .bottom {
        margin: 0;
        padding: 14px 20px;
    }

    .user-directory .dataTables_filter input {
        min-width: 230px;
        border: 1px solid #dce4e1;
        border-radius: 7px;
    }

    @media (max-width: 767.98px) {
        .user-page .app-title,
        .user-directory__header {
            align-items: flex-start;
            flex-direction: column;
        }

        .user-page__actions,
        .user-page__actions .btn {
            width: 100%;
        }

        .user-directory .dataTables_filter,
        .user-directory .dataTables_length {
            text-align: left;
        }

        .user-directory .dataTables_filter input {
            min-width: 0;
            width: calc(100% - 70px);
        }
    }
</style>
@endpush

@section('content')
@php
    $activeUsers = $users->where('status', 'active')->count();
    $inactiveUsers = $users->count() - $activeUsers;
    $roleCount = $users->flatMap->roles->pluck('id')->unique()->count();
@endphp

<div class="user-page">
    <div class="app-title">
        <div>
            <h1><i class="fa fa-users"></i> Users</h1>
            <p>Manage user accounts, roles, and account status.</p>
        </div>
        <div class="user-page__actions">
            @can('User deleted button')
                <a href="{{ route('user.deleted') }}" class="btn btn-outline-danger">
                    <i class="fa fa-trash-o mr-1"></i> Deleted users
                </a>
            @endcan
            @can('User create')
                <a href="{{ route('user.create') }}" class="btn btn-primary">
                    <i class="fa fa-plus mr-1"></i> Add user
                </a>
            @endcan
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="user-stat">
                <span class="user-stat__icon"><i class="fa fa-users"></i></span>
                <div>
                    <span class="user-stat__value">{{ number_format($users->count()) }}</span>
                    <span class="user-stat__label">Total users</span>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="user-stat user-stat--active">
                <span class="user-stat__icon"><i class="fa fa-check-circle"></i></span>
                <div>
                    <span class="user-stat__value">{{ number_format($activeUsers) }}</span>
                    <span class="user-stat__label">Active users</span>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="user-stat user-stat--inactive">
                <span class="user-stat__icon"><i class="fa fa-id-badge"></i></span>
                <div>
                    <span class="user-stat__value">{{ number_format($roleCount) }}</span>
                    <span class="user-stat__label">Assigned roles</span>
                </div>
            </div>
        </div>
    </div>

    <div class="tile user-directory">
        <div class="user-directory__header">
            <div>
                <h3>User directory</h3>
                <p>{{ number_format($activeUsers) }} active and {{ number_format($inactiveUsers) }} inactive accounts</p>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table" id="userTable" style="width: 100%;">
                <thead>
                    <tr>
                        <th>User</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th>Joined</th>
                        <th class="text-right">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $row)
                        @php
                            $initials = collect(preg_split('/\s+/', trim($row->name)))
                                ->filter()
                                ->take(2)
                                ->map(fn ($part) => mb_strtoupper(mb_substr($part, 0, 1)))
                                ->implode('');
                            $isActive = $row->status === 'active';
                        @endphp
                        <tr>
                            <td>
                                <div class="user-identity">
                                    <span class="user-avatar" aria-hidden="true">
                                        @if($row->profile_image)
                                            <img src="{{ asset($row->profile_image) }}" alt="">
                                        @else
                                            {{ $initials ?: 'U' }}
                                        @endif
                                    </span>
                                    <span>
                                        <span class="user-identity__name" title="{{ $row->name }}">{{ $row->name }}</span>
                                        <span class="user-identity__email" title="{{ $row->email }}">{{ $row->email }}</span>
                                    </span>
                                </div>
                            </td>
                            <td>
                                @forelse($row->roles as $role)
                                    <span class="user-role">{{ $role->name }}</span>
                                @empty
                                    <span class="user-role user-role--empty">No role</span>
                                @endforelse
                            </td>
                            <td>
                                <span class="user-status {{ $isActive ? 'user-status--active' : 'user-status--inactive' }}">
                                    {{ $row->status ?: 'inactive' }}
                                </span>
                            </td>
                            <td data-order="{{ optional($row->created_at)->timestamp ?? 0 }}">
                                <span class="user-date">
                                    {{ optional($row->created_at)->format('d M Y') ?: 'Not available' }}
                                    @if($row->created_at)
                                        <small>{{ $row->created_at->diffForHumans() }}</small>
                                    @endif
                                </span>
                            </td>
                            <td class="text-right">
                                <div class="user-actions">
                                    @can('User edit')
                                        <a class="btn btn-outline-info" href="{{ route('user.edit', $row) }}"
                                           title="Edit {{ $row->name }}" aria-label="Edit {{ $row->name }}">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                    @endcan
                                    @can('User delete')
                                        <form method="POST" action="{{ route('user.destroy', $row) }}" class="d-inline">
                                            @csrf
                                            @method('delete')
                                            <button data-name="{{ $row->name }}" type="submit"
                                                    class="btn btn-outline-danger delete-confirm"
                                                    title="Delete {{ $row->name }}" aria-label="Delete {{ $row->name }}">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>
                                    @endcan
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="user-empty">
                                <i class="fa fa-user-o"></i>
                                No users have been added yet.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@push('script')
<script>
    $(function () {
        var userTable = $('#userTable');

        if (userTable.length && userTable.find('tbody tr td[colspan]').length === 0) {
            userTable.DataTable({
                dom: '<"row align-items-center"<"col-md-6"l><"col-md-6"f>>t<"row align-items-center"<"col-md-6"i><"col-md-6"p>>',
                responsive: true,
                autoWidth: false,
                pageLength: 10,
                order: [[3, 'desc']],
                language: {
                    search: '',
                    searchPlaceholder: 'Search users...',
                    lengthMenu: 'Show _MENU_ users'
                },
                columnDefs: [
                    { targets: 4, orderable: false, searchable: false }
                ]
            });
        }

        $(document).on('click', '.delete-confirm', function (event) {
            event.preventDefault();

            var form = $(this).closest('form');
            var name = $(this).data('name') || 'this user';

            Swal.fire({
                title: 'Delete ' + name + '?',
                text: 'The account will be moved to Deleted Users and can be restored later.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Yes, delete user',
                cancelButtonText: 'Cancel'
            }).then(function (result) {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
</script>
@endpush
