@extends('errors.illustrated-layout')

@section('title', 'Page Not Found')
@section('code', '404')
@section('message', 'Oops! Page not found')
@section('description', 'The page you\'re looking for doesn\'t exist or has been moved. Please check the URL or navigate back to the dashboard.')

@section('additional_content')
    <div style="color: #637795; font-size: 14px; line-height: 1.6;">
        {{ __('Need help? Contact your system administrator.') }}
    </div>
@endsection
