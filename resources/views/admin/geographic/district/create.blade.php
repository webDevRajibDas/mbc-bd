@extends('layouts.app')
@section('title', 'Add District')
@section('content')

<div class="app-title">
    <div>
        <h1><i class="fa fa-map-marker"></i> Districts</h1>
    </div>
    <ul class="app-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        <li class="breadcrumb-item">Geographic Config</li>
        <li class="breadcrumb-item">Districts</li>
        <li class="breadcrumb-item active">Create</li>
    </ul>
</div>

<form method="POST" action="{{ route('geographic.districts.store') }}">
    @csrf

<div class="row">
    <div class="col-md-12">
        <div class="tile">
            <div class="tile-title-w-btn">
                <h3 class="title">Create District</h3>
                <p>
                    <a class="btn btn-primary btn-sm icon-btn" href="{{ route('geographic.districts.index') }}">
                        <i class="fa fa-list"></i> See List
                    </a>
                </p>
            </div>
            <div class="tile-body">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group mb-3">
                            <label class="control-label mb-1" for="division_id">Division <span class="text-danger">*</span></label>
                            <select name="division_id" id="division_id" class="form-control form-control-sm select2" required>
                                <option value="">Select Division</option>
                                @foreach($divisions as $division)
                                    <option value="{{ $division->id }}" {{ old('division_id') == $division->id ? 'selected' : '' }}>
                                        {{ $division->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('division_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label class="control-label mb-1" for="name">District Name (English) <span class="text-danger">*</span></label>
                            <input type="text" name="name" id="name" class="form-control form-control-sm"
                                   placeholder="Enter District Name" required value="{{ old('name') }}">
                            @error('name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label class="control-label mb-1" for="bn_name">Bengali Name</label>
                            <input type="text" name="bn_name" id="bn_name" class="form-control form-control-sm"
                                   placeholder="Enter Bengali Name" value="{{ old('bn_name') }}">
                            @error('bn_name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label class="control-label mb-1" for="url">Website URL</label>
                            <input type="text" name="url" id="url" class="form-control form-control-sm"
                                   placeholder="Enter website URL (e.g., https://example.com)" value="{{ old('url') }}">
                            @error('url')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="tile-footer">
                <button type="submit" class="btn btn-primary">Create District</button>
            </div>
        </div>
    </div>
</div>
</form>

@endsection
