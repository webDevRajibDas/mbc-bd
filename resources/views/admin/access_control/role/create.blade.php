@extends('layouts.app')
@section('title', 'Add Role')
@section('content')

<div class="app-title">
    <div>
        <h1><i class="fa fa-users"></i> Role</h1>
    </div>
    <ul class="app-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        <li class="breadcrumb-item">Access Control</li>
        <li class="breadcrumb-item">Roles</li>
        <li class="breadcrumb-item active">Create</li>
    </ul>
</div>

<form method="POST" action="{{ route('role.store') }}" class="form-horizontal">
    @csrf

<div class="row">
    <div class="col-md-12">
        <div class="tile">
            <div class="tile-title-w-btn">
                <h3 class="title">Create Role</h3>
                <p>
                    <a class="btn btn-primary btn-sm icon-btn" href="{{ route('role.index') }}">
                        <i class="fa fa-list"></i> See List
                    </a>
                </p>
            </div>
            <div class="tile-body">
                <div class="row mb-3">
                    <div class="col-lg-6">
                        <div class="form-group mb-0">
                            <label class="control-label mb-1" for="name">Role Name (Must be unique)</label>
                            <input type="text" name="name" id="name" class="form-control form-control-sm"
                                   placeholder="Enter name" required value="{{ old('name') }}">
                            @error('name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="d-flex align-items-center mb-2">
                    <h5 class="mb-0 mr-3"><i class="fa fa-lock"></i> Permissions</h5>
                    <label class="mb-0 d-flex align-items-center" style="cursor:pointer;gap:5px;">
                        <input type="checkbox" id="checkAll"> Select All
                    </label>
                </div>

                @foreach($permission_groups as $key => $permissions)
                    <div class="card mb-2">
                        <div class="card-header py-2 px-3">
                            <strong class="text-uppercase small">{{ $key }}</strong>
                        </div>
                        <div class="card-body py-2 px-3">
                            <div class="row">
                                @foreach($permissions as $permission)
                                    <div class="col-lg-2 col-md-3 col-sm-4 col-6">
                                        <div class="form-check mb-1">
                                            <input type="checkbox" name="permission[]" value="{{ $permission->id }}"
                                                   class="form-check-input permission-checkbox" id="perm_{{ $permission->id }}">
                                            <label class="form-check-label" for="perm_{{ $permission->id }}">
                                                {{ $permission->name }}
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="tile-footer">
                <button type="submit" class="btn btn-primary">Create Role</button>
            </div>
        </div>
    </div>
</div>
</form>

@endsection

@push('script')
<script>
    $(function () {
        $('#checkAll').on('click', function () {
            $('.permission-checkbox').prop('checked', this.checked);
        });

        $('.permission-checkbox').on('change', function () {
            if (!this.checked) {
                $('#checkAll').prop('checked', false);
            } else {
                var allChecked = $('.permission-checkbox').length === $('.permission-checkbox:checked').length;
                $('#checkAll').prop('checked', allChecked);
            }
        });
    });
</script>
@endpush
