@extends('layouts.app')

@section('title','Add Permission')

@section('content')

    <div class="app-title">
        <div>
            <h1><i class="fa fa-users" aria-hidden="true"></i> Permission</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        </ul>
    </div>
    <div class="tile">
        <form action="{{route('permission.store')}}" method="post">
            @csrf
            <div class="tile-title-w-btn"><h4 class="title"><i class="fa fa-plus fa-lg"></i> Create Permission</h4>
                <p>
                    <a class="btn btn-primary btn-sm icon-btn" href="{{route('permission.index')}}">
                        <i class="fa fa-list"></i>See List
                    </a>
                </p>
            </div>

            <hr>
            <div class="row">
                <div class="col-md-6 col-sm-6">
                    <div class="form-group">
                        <label class="col-form-label col-form-label-sm" for="name">Permission Name (Must Be Unique)
                            <span class="text-danger">*</span>
                        </label>
                        <input class="form-control" id="name" type="text" name="name" value="{{ old('name') }}" required autofocus>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6">
                    <div class="form-group">
                        <label class="col-form-label col-form-label-sm" for="parent">Parent (Module / Group)</label>
                        <input class="form-control" id="parent" type="text" name="parent" list="parent-list"
                            value="{{ old('parent') }}" placeholder="e.g. Attendance, Leave, Employee" autocomplete="off">
                        <datalist id="parent-list">
                            @foreach($parents as $p)
                                <option value="{{ $p }}"></option>
                            @endforeach
                        </datalist>
                        <small class="form-text text-muted">Group permissions by module so they appear together in role editor.</small>
                    </div>
                </div>
            </div>

            <div class="tile-footer">
                <button class="btn btn-primary" type="submit">Submit</button>
            </div>
        </form>
    </div>

@endsection

@section('js')

@endsection

@push('script')
    <script>

    </script>
@endpush
