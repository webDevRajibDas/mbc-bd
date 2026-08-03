@extends('errors.illustrated-layout')

@section('title', 'Page Not Found')
@section('code', '404')
@section('message', 'Oops! Page not found')
@section('description', 'The page you\'re looking for doesn\'t exist or has been moved. Please check the URL or navigate back to the dashboard.')

@section('image')
    <img src="{{ asset('/svg/404.svg') }}" alt="404 Illustration" style="max-width: 400px;">
@endsection

@section('additional_content')
    <div style="margin-top: 1.5rem; padding-top: 1rem; border-top: 1px solid #e2e8f0;">
        <p style="font-size: 0.9rem; color: #718096;">
            <i class="fas fa-info-circle" style="color: #667eea; margin-right: 0.5rem;"></i>
            Need help? Contact your HR administrator or visit our 
            <a href="#" style="color: #667eea; text-decoration: none; font-weight: 600;">Help Center</a>
        </p>
    </div>
@endsection
