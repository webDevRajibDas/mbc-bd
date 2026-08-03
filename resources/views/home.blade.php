@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')
    <div class="app-title">
        <div>
            <p><i class="fa fa-dashboard"></i> MBC Bangladesh - Dashboard</p>
        </div>
    </div>

    <div class="row mb-4">
        @can('User list')
        <div class="col-md-3 col-sm-6 mb-3">
            <a href="{{ route('user.index') }}" class="text-decoration-none">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Users</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">Manage Users</div>
                            </div>
                            <div class="col-auto">
                                <i class="fa fa-users fa-3x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        @endcan

        @can('Role list')
        <div class="col-md-3 col-sm-6 mb-3">
            <a href="{{ route('role.index') }}" class="text-decoration-none">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Roles</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">Manage Roles</div>
                            </div>
                            <div class="col-auto">
                                <i class="fa fa-user-secret fa-3x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        @endcan

        @can('Permission list')
        <div class="col-md-3 col-sm-6 mb-3">
            <a href="{{ route('permission.index') }}" class="text-decoration-none">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Permissions</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">Manage Permissions</div>
                            </div>
                            <div class="col-auto">
                                <i class="fa fa-key fa-3x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        @endcan

        @if(auth()->user()->hasAnyRole(['Master Admin', 'Super Admin']))
        <div class="col-md-3 col-sm-6 mb-3">
            <a href="{{ route('master.settings.edit') }}" class="text-decoration-none">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Settings</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">App Settings</div>
                            </div>
                            <div class="col-auto">
                                <i class="fa fa-cogs fa-3x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-3 col-sm-6 mb-3">
            <a href="{{ route('master.settings.edit') }}#advertise-config" class="text-decoration-none">
                <div class="card border-left-danger shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Advertise</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">Add Advertise Config</div>
                            </div>
                            <div class="col-auto">
                                <i class="fa fa-bullhorn fa-3x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-3 col-sm-6 mb-3">
            <a href="{{ route('officer.dashboard') }}" class="text-decoration-none">
                <div class="card border-left-teal shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-teal text-uppercase mb-1">Officer</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">Officer UI Test</div>
                            </div>
                            <div class="col-auto">
                                <i class="fa fa-id-card fa-3x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        @endif
    </div>

@endsection

@push('css')
<style>
    .border-left-primary { border-left: 4px solid #4e73df !important; }
    .border-left-success { border-left: 4px solid #1cc88a !important; }
    .border-left-info { border-left: 4px solid #36b9cc !important; }
    .border-left-warning { border-left: 4px solid #f6c23e !important; }
    .border-left-danger { border-left: 4px solid #e74a3b !important; }
    .border-left-teal { border-left: 4px solid #009688 !important; }
    .text-teal { color: #009688 !important; }
    .text-xs { font-size: .7rem; }
    .text-gray-800 { color: #5a5c69; }
    .text-gray-300 { color: #dddfeb; }
    .card a { color: inherit; }
    .card a:hover { text-decoration: none; }
    .card.shadow:hover { box-shadow: 0 .5rem 1rem rgba(0,0,0,.15) !important; transition: box-shadow .2s; }
</style>
@endpush
