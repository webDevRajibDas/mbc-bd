@extends('errors.illustrated-layout')

@section('title', __('Server Error'))
@section('code', '500')
@section('message', __('Server Error'))
@section('description', __('We encountered an unexpected problem while processing your request. Please try again shortly.'))
