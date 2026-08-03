@extends('layouts.app')

@section('title', 'Property Categories')

@section('content')
<div class="app-title">
    <div><h1><i class="fa fa-tags"></i> Property Categories</h1></div>
    <ul class="app-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        <li class="breadcrumb-item">Master Admin</li>
        <li class="breadcrumb-item active">Property Categories</li>
    </ul>
</div>

<div class="tile">
    <div class="tile-title-w-btn">
        <h3 class="title">Property Category List</h3>
        <a href="{{ route('master.property-categories.create') }}" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Add Category</a>
    </div>
    <div class="tile-body">
        <div class="table-responsive">
            <table class="table table-hover table-sm mb-0" id="propertyCategoryTable">
                <thead><tr><th class="text-center" style="width:60px">#</th><th>Name</th><th>Slug</th><th>Description</th><th>Status</th><th>Won</th><th class="text-center" style="width:180px">Action</th></tr></thead>
                <tbody>
                    @forelse($propertyCategories as $propertyCategory)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td class="font-weight-bold">{{ $propertyCategory->name }}</td>
                            <td><code>{{ $propertyCategory->slug }}</code></td>
                            <td>{{ \Illuminate\Support\Str::limit($propertyCategory->description, 70) ?: '—' }}</td>
                            <td><span class="badge badge-{{ $propertyCategory->is_active ? 'success' : 'secondary' }}">{{ $propertyCategory->is_active ? 'Active' : 'Inactive' }}</span></td>
                            <td><span class="badge badge-{{ $propertyCategory->is_won ? 'primary' : 'light' }}">{{ $propertyCategory->is_won ? 'Yes' : 'No' }}</span></td>
                            <td class="text-center">
                                <a href="{{ route('master.property-categories.edit', $propertyCategory) }}" class="btn btn-success btn-sm"><i class="fa fa-pencil"></i> Edit</a>
                                <form method="POST" action="{{ route('master.property-categories.destroy', $propertyCategory) }}" class="d-inline">@csrf @method('DELETE')<button class="btn btn-danger btn-sm delete-confirm" data-name="{{ $propertyCategory->name }}"><i class="fa fa-trash"></i> Delete</button></form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="7" class="text-center text-muted py-4">No property categories have been added yet.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>$('#propertyCategoryTable').DataTable({ dom: '<"top"lf>t<"bottom"ip>', responsive: true, autoWidth: false, order: [] });</script>
@endpush
