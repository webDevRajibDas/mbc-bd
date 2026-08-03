@extends('layouts.app')
@section('title', 'View Admin Activity')
@section('content')
    <div class="app-title">
        <div>
            <p><i class="fa fa-history"></i> Admin Activity Detail</p>
        </div>
        <div>
            <a href="{{ route('admin-activity') }}" class="btn btn-secondary btn-sm">
                <i class="fa fa-arrow-left"></i> Back
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">
                    <table class="table table-bordered">
                        <tr>
                            <th style="width:200px">Log Name</th>
                            <td>{{ $activity_log->log_name }}</td>
                        </tr>
                        <tr>
                            <th>Description</th>
                            <td>{{ $activity_log->description }}</td>
                        </tr>
                        <tr>
                            <th>Causer</th>
                            <td>{{ $activity_log->causer?->name ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Date & Time</th>
                            <td>{{ \Carbon\Carbon::parse($activity_log->created_at)->format('d-m-Y h:i A') }}</td>
                        </tr>
                        <tr>
                            <th>Subject Type</th>
                            <td>{{ $activity_log->subject_type }}</td>
                        </tr>
                        <tr>
                            <th>Subject ID</th>
                            <td>{{ $activity_log->subject_id }}</td>
                        </tr>
                    </table>

                    @if($activity_log->properties)
                    <h5 class="mt-4">Changes</h5>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Field</th>
                                <th>Old Value</th>
                                <th>New Value</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(isset($activity_log->changes['attributes']))
                                @foreach($activity_log->changes['attributes'] as $field => $newVal)
                                <tr>
                                    <td>{{ $field }}</td>
                                    <td>{{ $activity_log->changes['old'][$field] ?? 'N/A' }}</td>
                                    <td>{{ $newVal }}</td>
                                    <td>
                                        @if(isset($activity_log->changes['old'][$field]))
                                        <form action="{{ route('revert-admin-activity', $activity_log->id) }}" method="POST" style="display:inline">
                                            @csrf
                                            <input type="hidden" name="field_name" value="{{ $field }}">
                                            <input type="hidden" name="old_value" value="{{ $activity_log->changes['old'][$field] }}">
                                            <button type="submit" class="btn btn-warning btn-sm" onclick="return confirm('Revert this change?')">
                                                <i class="fa fa-undo"></i> Revert
                                            </button>
                                        </form>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>

                    @if(isset($activity_log->changes['old']))
                    <form action="{{ route('revert-all-admin-activity', $activity_log->id) }}" method="POST" class="mt-3">
                        @csrf
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Revert all changes?')">
                            <i class="fa fa-undo"></i> Revert All Changes
                        </button>
                    </form>
                    @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
