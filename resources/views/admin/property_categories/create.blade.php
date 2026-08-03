@extends('layouts.app')
@section('title', 'Add Property Category')
@section('content')
<div class="app-title"><div><h1><i class="fa fa-tags"></i> Property Categories</h1></div><ul class="app-breadcrumb breadcrumb"><li class="breadcrumb-item">Master Admin</li><li class="breadcrumb-item">Property Categories</li><li class="breadcrumb-item active">Create</li></ul></div>
<form method="POST" action="{{ route('master.property-categories.store') }}">@csrf
    <div class="tile"><div class="tile-title-w-btn"><h3 class="title">Add Property Category</h3><a class="btn btn-primary btn-sm" href="{{ route('master.property-categories.index') }}"><i class="fa fa-list"></i> See List</a></div><div class="tile-body">@include('admin.property_categories._form')</div><div class="tile-footer"><button class="btn btn-primary"><i class="fa fa-save"></i> Create Category</button></div></div>
</form>
@endsection
