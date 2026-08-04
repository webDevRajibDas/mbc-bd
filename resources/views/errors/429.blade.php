@extends('errors.illustrated-layout')

@section('title', __('Too Many Requests'))
@section('code', '429')
@section('message', __('Too Many Requests'))
@section('description', __('Too many requests were made. Please wait a moment before trying again.'))
