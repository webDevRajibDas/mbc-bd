@extends('layouts.app')
@section('title', 'Edit Project Name')
@section('content')

<div class="app-title">
    <div>
        <h1><i class="fa fa-folder-open"></i> Project Names</h1>
    </div>
    <ul class="app-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        <li class="breadcrumb-item">Super Admin</li>
        <li class="breadcrumb-item">Project Names</li>
        <li class="breadcrumb-item active">Edit</li>
    </ul>
</div>

<form method="POST" action="{{ route('master.project-names.update', $projectName) }}">
    @csrf
    @method('PUT')

<div class="row">
    <div class="col-md-12">
        <div class="tile">
            <div class="tile-title-w-btn">
                <h3 class="title">Edit Project Name: {{ $projectName->name }}</h3>
                <p>
                    <a class="btn btn-primary btn-sm icon-btn" href="{{ route('master.project-names.index') }}">
                        <i class="fa fa-list"></i> See List
                    </a>
                </p>
            </div>
            <div class="tile-body">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group mb-3">
                            <label class="control-label mb-1" for="name">Project Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" id="name" class="form-control form-control-sm"
                                   placeholder="Enter Project Name" required value="{{ old('name', $projectName->name) }}">
                            @error('name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="tile-footer">
                <button type="submit" class="btn btn-primary">Update Project Name</button>
            </div>
        </div>
    </div>
</div>
</form>

@endsection
