@extends('layouts.app')
@section('title', 'Login Activity')
@section('content')
    <div class="app-title">
        <div>
            <p><i class="fa fa-history"></i> Login Activity</p>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-title-w-btn">
                    <h3>Login Activity List</h3>
                    <a href="{{ route('activity-log-clean-by-name') }}" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to clean login activity logs?')">
                        <i class="fa fa-trash"></i> Clean Logs
                    </a>
                </div>
                <div class="tile-body">
                    <table class="table table-hover table-bordered" id="sampleTable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>User</th>
                                <th>Event</th>
                                <th>IP Address</th>
                                <th>Date & Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($login_activity as $key => $log)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $log->causer?->name ?? 'N/A' }}</td>
                                <td>
                                    @if($log->event == 'login')
                                        <span class="badge badge-success">{{ ucfirst($log->event) }}</span>
                                    @else
                                        <span class="badge badge-warning">{{ ucfirst($log->event) }}</span>
                                    @endif
                                </td>
                                <td>{{ $log->properties['ip'] ?? 'N/A' }}</td>
                                <td>{{ \Carbon\Carbon::parse($log->created_at)->format('d-m-Y h:i A') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
