@extends('layouts.app')
@section('title', 'Add Union')
@section('content')

<div class="app-title">
    <div>
        <h1><i class="fa fa-map-marker"></i> Unions</h1>
    </div>
    <ul class="app-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        <li class="breadcrumb-item">Geographic Config</li>
        <li class="breadcrumb-item">Unions</li>
        <li class="breadcrumb-item active">Create</li>
    </ul>
</div>

<form method="POST" action="{{ route('geographic.unions.store') }}">
    @csrf

<div class="row">
    <div class="col-md-12">
        <div class="tile">
            <div class="tile-title-w-btn">
                <h3 class="title">Create Union</h3>
                <p>
                    <a class="btn btn-primary btn-sm icon-btn" href="{{ route('geographic.unions.index') }}">
                        <i class="fa fa-list"></i> See List
                    </a>
                </p>
            </div>
            <div class="tile-body">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group mb-3">
                            <label class="control-label mb-1" for="upazila_id">Upazila <span class="text-danger">*</span></label>
                            <select name="upazila_id" id="upazila_id" class="form-control form-control-sm select2" required>
                                <option value="">Select Upazila</option>
                                @foreach($upazilas as $upazila)
                                    <option value="{{ $upazila->id }}" {{ old('upazila_id') == $upazila->id ? 'selected' : '' }}>
                                        {{ $upazila->name }} ({{ $upazila->district->name ?? 'N/A' }} District)
                                    </option>
                                @endforeach
                            </select>
                            @error('upazila_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label class="control-label mb-1" for="name">Union Name (English) <span class="text-danger">*</span></label>
                            <input type="text" name="name" id="name" class="form-control form-control-sm"
                                   placeholder="Enter Union Name" required value="{{ old('name') }}">
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
                <button type="submit" class="btn btn-primary">Create Union</button>
            </div>
        </div>
    </div>
</div>
</form>

@endsection
