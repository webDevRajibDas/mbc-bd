@extends('layouts.app')
@section('title', 'Project Names')
@section('content')

<div class="app-title">
    <div>
        <h1><i class="fa fa-folder-open"></i> Project Names</h1>
    </div>
    <ul class="app-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        <li class="breadcrumb-item">Super Admin</li>
        <li class="breadcrumb-item active">Project Names</li>
    </ul>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="tile">
            <div class="tile-title-w-btn">
                <h3 class="title">Project Name List</h3>
                <div class="btn-group">
                    <a href="{{ route('master.project-names.create') }}" class="btn btn-primary btn-sm">
                        <i class="fa fa-plus"></i> Add New
                    </a>
                </div>
            </div>
            <div class="tile-body">
                <div class="table-responsive">
                    <table class="table table-hover table-sm mb-0" id="projectNameTable">
                        <thead>
                            <tr>
                                <th class="text-center" style="width:60px;">#</th>
                                <th>Project Name</th>
                                <th class="text-center" style="width:180px;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($projectNames as $row)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>{{ $row->name }}</td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center" style="gap:5px;">
                                            <a href="{{ route('master.project-names.edit', $row) }}" class="btn btn-success btn-sm">
                                                <i class="fa fa-pencil-square-o"></i> Edit
                                            </a>
                                            <form action="{{ route('master.project-names.destroy', $row) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm delete-confirm" data-name="{{ $row->name }}">
                                                    <i class="fa fa-trash"></i> Delete
                                                </button>
                                            </form>
                                        </div>
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
    $('#projectNameTable').DataTable({
        dom: '<"top"lf>t<"bottom"ip>',
        responsive: true,
        autoWidth: false,
        order: []
    });
</script>
@endpush
