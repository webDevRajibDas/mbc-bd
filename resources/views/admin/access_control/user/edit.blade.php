@extends('layouts.app')
@section('title','Edit User')
@section('content')

    <div class="app-title">
        <div>
            <h1><i class="fa fa-users" aria-hidden="true"></i>User</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            {{-- <li class="breadcrumb-item"><a href="#">Blank Page</a></li>--}}
        </ul>
    </div>
    <div class="tile">
        <form action="{{route('user.update',$user->id)}}" method="POST">
            @csrf
            @method('put')
            <div class="tile-title-w-btn">
                <h3 class="title">Edit User</h3>
                <p>
                    <a class="btn btn-primary btn-sm icon-btn" href="{{route('user.index')}}"><i class="fa fa-list"></i>See List</a>
                </p>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="name" class="control-label">Name</label>
                        <input type="text" name="name" id="name" class="form-control input-sm" value="{{ old('name', $user->name) }}">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="email" class="control-label">Email</label>
                        <input type="email" name="email" id="email" class="form-control input-sm" value="{{ old('email', $user->email) }}">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="password" class="control-label">Password</label>
                        <div class="input-group">
                            <input type="password" name="password" id="password" class="form-control input-sm">
                            <div class="input-group-append">
                                <span class="input-group-text" onclick="togglePassword('password', this)" style="cursor:pointer">
                                    <i class="fa fa-eye"></i>
                                </span>
                            </div>
                        </div>
                        <small class="form-text text-success">
                            Minimum 8 characters, must include uppercase, lowercase, number &amp; symbol.
                        </small>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="password_confirmation" class="control-label">Confirm Password</label>
                        <div class="input-group">
                            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control input-sm">
                            <div class="input-group-append">
                                <span class="input-group-text" onclick="togglePassword('password_confirmation', this)" style="cursor:pointer">
                                    <i class="fa fa-eye"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="status" class="control-label">Status</label>
                        <select name="status" id="status" class="form-control input-sm">
                            <option value="active" @selected(old('status', $user->status) === 'active')>Active</option>
                            <option value="inactive" @selected(old('status', $user->status) === 'inactive')>Inactive</option>
                        </select>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="role" class="control-label">Role</label>
                        <select name="role" id="role" class="form-control input-sm demoSelect">
                            <option value="">Select a role</option>
                            @foreach($roles as $roleId => $roleName)
                                <option value="{{ $roleId }}" @selected((string) old('role', $selected_role) === (string) $roleId)>{{ $roleName }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>
@endsection
@section('script')
    <script>
        function togglePassword(id, btn) {
            const input = document.getElementById(id);
            const icon = btn.querySelector('i');
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.replace('fa-eye', 'fa-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.replace('fa-eye-slash', 'fa-eye');
            }
        }
    </script>
@endsection
