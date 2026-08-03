@extends('layouts.app')
@section('title', 'Roles')
@section('content')

<div class="app-title">
    <div>
        <h1><i class="fa fa-users"></i> Roles</h1>
    </div>
    <ul class="app-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        <li class="breadcrumb-item">Access Control</li>
        <li class="breadcrumb-item active">Roles</li>
    </ul>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="tile">
            <div class="tile-title-w-btn">
                <h3 class="title">Role List</h3>
                <div class="btn-group">
                    @can('Role create')
                        <a href="{{ route('role.create') }}" class="btn btn-primary btn-sm">
                            <i class="fa fa-plus"></i> Add New
                        </a>
                    @endcan
                </div>
            </div>
            <div class="tile-body">
                <div class="table-responsive">
                    <table class="table table-hover table-sm mb-0" id="roleTable">
                        <thead>
                            <tr>
                                <th class="text-center" style="width:60px;">#</th>
                                <th>Name</th>
                                <th class="text-center" style="width:140px;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($roles as $row)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>
                                        @can('Role edit')
                                            <a href="{{ route('role.edit', $row) }}" class="text-decoration-none">
                                                <i class="fa fa-pencil-square-o text-muted mr-1"></i> {{ $row->name }}
                                            </a>
                                        @else
                                            {{ $row->name }}
                                        @endcan
                                    </td>
                                    <td class="text-center">
                                        @can('Role edit')
                                            <a href="{{ route('role.edit', $row) }}" class="btn btn-success btn-sm">
                                                <i class="fa fa-pencil-square-o"></i> Edit
                                            </a>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')
<script>
    $('#roleTable').DataTable({
        dom: '<"top"lf>t<"bottom"ip>',
        responsive: true,
        autoWidth: false,
        buttons: [
            { extend: 'print', exportOptions: { columns: ':visible' } },
            { extend: 'pdf', exportOptions: { columns: ':visible' } }
        ],
        columnDefs: [
            { targets: [], visible: false }
        ],
        order: []
    });
</script>
@endpush
