@extends('errors.illustrated-layout')

@section('title', __('Maintenance Mode'))
@section('code', '503')
@section('message', __('Maintenance Mode'))
@section('image')
    <div style="background-image: url({{ asset('/svg/503.svg') }});" class="absolute pin bg-cover bg-no-repeat md:bg-left lg:bg-center">
    </div>
@endsection
