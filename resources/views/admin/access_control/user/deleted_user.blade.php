@extends('layouts.app')
@section('title','Deleted Users')
@section('content')

    <div class="app-title">
        <div>
            <h1><i class="fa fa-users" aria-hidden="true"></i>User </h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">

            <div class="tile">

                <div class="tile-title-w-btn">
                    <h3 class="title">User List</h3>
                    <div>
                        @can('User create')
                            <a href="{{route('user.create')}}" class="btn btn-primary btn-sm float-right m-2">
                                <i class="fa fa-plus-square-o" aria-hidden="true"></i>Add New User</a>
                        @endcan
                        @can('User list')
                            <a href="{{route('user.index')}}" class="btn btn-info btn-sm float-right m-2">
                                <i class="fa fa-plus-square-o" aria-hidden="true"></i>Show All Users</a>
                        @endcan
                    </div>
                </div>
                <div class="tile-body">

                    <div class="table-responsive">
                        <table class="table table-hover table-bordered" id="sampleTable" style="width:100%;">
                            <thead>
                            <tr>
                                <th width="10%">#</th>
                                <th>Name</th>
                                <th>User Id</th>
                                <th> Role</th>
                                <th width="20%">Action</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($users as $row)
                                <tr style="background-color: #F5F5F5; text-align: center;">
                                    <td>{{ $row->id }}</td>
                                    <td>{{ $row->name }}</td>
                                    <td>{{ $row->email }}</td>
                                    <td>
                                        @if($row->getRoleNames()->isNotEmpty())
                                            <span class="badge badge-success">
                                                {!! $row->getRoleNames()->implode(" ") !!}
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        {{--                                          @can('User Edit')--}}

                                        <div class="btn-group">
                                            @can('User restore')
                                                <a class="btn btn-info btn-sm" href="{{ route('user.restore', $row->id) }}">
                                                    <i class="fa fa-lg fa-level-up"></i>Restore
                                                </a> &nbsp;
                                            @endcan
                                            @can('User permanent delete')
                                                <form method="POST" action="{{ route('user.permanent-delete',$row->id)}}" class="d-inline">
                                                    @csrf
                                                    @method('delete')
                                                    <button data-name="{{ $row->name }}" type="submit" class="btn btn-danger btn-sm delete-confirm">
                                                        <i class="fa fa-lg fa-trash"></i>Delete Forever
                                                    </button>
                                                </form>
                                            @endcan
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
    <!-- /.content -->
    <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #0D5245; color: white;">
                    <h5 class="modal-title" id="exampleModalLongTitle">Add User</h5>
                </div>
                <form action="" method="POST" class="form-group">
                    @csrf
                    <div class="modal-body">

                        <div class="form-group row">
                            <label for="name" class="col-sm-3 col-form-label">Name</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="name" id="name">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-sm-3 col-form-label">Email</label>
                            <div class="col-sm-9">
                                <input type="email" class="form-control" name="email" id="email">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="gender" class="col-sm-3 col-form-label">Role</label>
                            <div class="col-sm-9">
                                <select class="form-control" name="role">
                                    <option value="admin">Admin</option>
                                    <option value="trainer">Trainer</option>
                                    <option value="participant">Participant</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-sm-3 col-form-label">Password</label>
                            <div class="col-sm-9">
                                <input type="password" class="form-control" name="password" id="password">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password" class="col-sm-3 col-form-label">Confirm Password</label>
                            <div class="col-sm-9">
                                <input type="password" class="form-control" name="password_confirmation" id="password">
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn" data-dismiss="modal"
                                style="background-color: black;color: white;">Close
                        </button>
                        <button type="Submit" class="btn active-color">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('js')

@endsection
@push('script')
    <!-- page script -->
    <script>

    </script>
@endpush
