@extends('layouts.app')

@section('title', 'Officer Profile')
@section('header-title', 'Officer Profile')
@section('sidebar')
    @include('officer.partial.sidebar')
@endsection

@push('styles')
<style>
    .profile-container {
        display: grid;
        grid-template-columns: 280px 1fr;
        gap: 24px;
        max-width: 960px;
        margin: 0 auto;
    }
    .profile-card {
        background: #fff;
        border-radius: 10px;
        border: 1px solid #e3e8ef;
        box-shadow: 0 4px 12px rgba(15, 35, 55, .04);
        padding: 24px;
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
    }
    .avatar-wrapper {
        position: relative;
        width: 130px;
        height: 130px;
        border-radius: 50%;
        overflow: hidden;
        cursor: pointer;
        border: 4px solid #fff;
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        margin-bottom: 16px;
    }
    .avatar-wrapper img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    .avatar-initials {
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, #0c6b5e 0%, #054038 100%);
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 46px;
        font-weight: 800;
    }
    .avatar-overlay {
        position: absolute;
        inset: 0;
        background: rgba(0,0,0,0.5);
        color: #fff;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        font-size: 11px;
        font-weight: 600;
        opacity: 0;
        transition: opacity 0.2s ease;
    }
    .avatar-wrapper:hover .avatar-overlay {
        opacity: 1;
    }
    .avatar-overlay i {
        font-size: 20px;
        margin-bottom: 4px;
    }
    .profile-card h3 {
        margin: 0 0 4px;
        font-size: 18px;
        font-weight: 700;
        color: #1e293b;
    }
    .profile-card span {
        font-size: 13px;
        color: #64748b;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    .profile-form-card {
        background: #fff;
        border-radius: 10px;
        border: 1px solid #e3e8ef;
        box-shadow: 0 4px 12px rgba(15, 35, 55, .04);
        padding: 28px;
    }
    .form-title {
        font-size: 18px;
        font-weight: 700;
        color: #0f172a;
        margin-top: 0;
        margin-bottom: 20px;
        border-bottom: 1px solid #e2e8f0;
        padding-bottom: 12px;
    }
    .profile-form-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 18px;
    }
    .form-group {
        display: flex;
        flex-direction: column;
        gap: 6px;
        margin-bottom: 16px;
    }
    .form-group.full-width {
        grid-column: 1 / -1;
    }
    .form-group label {
        font-size: 13px;
        font-weight: 700;
        color: #475569;
    }
    .form-group input {
        height: 42px;
        border: 1px solid #cbd5e1;
        border-radius: 6px;
        padding: 0 14px;
        font-size: 14px;
        color: #334155;
        transition: border-color 0.2s, box-shadow 0.2s;
    }
    .form-group input:focus {
        border-color: #0c6b5e;
        box-shadow: 0 0 0 3px rgba(12,107,94,0.15);
        outline: 0;
    }
    .form-group input[readonly] {
        background: #f8fafc;
        color: #64748b;
        cursor: not-allowed;
        border-color: #e2e8f0;
    }
    .profile-btn-save {
        background: #0c6b5e;
        color: #fff;
        border: 0;
        border-radius: 6px;
        padding: 10px 28px;
        font-size: 14px;
        font-weight: 700;
        cursor: pointer;
        transition: background 0.2s, transform 0.1s;
        margin-top: 10px;
    }
    .profile-btn-save:hover {
        background: #095046;
        transform: translateY(-1px);
    }
    .profile-btn-save:active {
        transform: translateY(1px);
    }
    @media (max-width: 800px) {
        .profile-container {
            grid-template-columns: 1fr;
        }
        .profile-form-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
@endpush

@section('content')
@php
    $initials = collect(explode(' ', $officer->name))->filter()->take(2)->map(fn ($part) => mb_substr($part, 0, 1))->implode('');
@endphp

<form class="profile-container" method="POST" action="{{ route('officer.profile.update') }}" enctype="multipart/form-data">
    @csrf

    <!-- Left Column: Avatar view and file select trigger -->
    <div class="profile-card">
        <div class="avatar-wrapper" onclick="document.getElementById('profileImageInput').click();" title="Click to change photo">
            @if ($officer->profile_image)
                <img src="{{ asset($officer->profile_image) }}" id="avatarPreview" alt="Profile Picture">
            @else
                <div class="avatar-initials" id="initialsContainer">{{ $initials ?: 'OF' }}</div>
                <img src="" id="avatarPreview" alt="Profile Picture" style="display: none;">
            @endif
            <div class="avatar-overlay">
                <i class="fa fa-camera"></i>
                <span>Change Photo</span>
            </div>
        </div>
        <input type="file" name="profile_image" id="profileImageInput" style="display: none;" accept="image/*">
        
        <h3>{{ $officer->name }}</h3>
        <span>Officer</span>
    </div>

    <!-- Right Column: Text inputs and security -->
    <div class="profile-form-card">
        <h2 class="form-title">Account Details</h2>

        @if ($errors->any())
            <div class="alert alert-danger" style="background:#fff5f5; border:1px solid #fed7d7; color:#c53030; padding:12px; border-radius:6px; margin-bottom:20px; font-size:14px;">
                <ul style="margin:0; padding-left:20px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="profile-form-grid">
            <div class="form-group">
                <label for="profileName">Full Name</label>
                <input type="text" name="name" id="profileName" value="{{ old('name', $officer->name) }}" required>
            </div>

            <div class="form-group">
                <label for="profileEmail">Email Address</label>
                <input type="email" id="profileEmail" value="{{ $officer->email }}" readonly>
            </div>

            <div class="form-group">
                <label for="profilePassword">New Password</label>
                <input type="password" name="password" id="profilePassword" placeholder="Leave blank to keep current">
            </div>

            <div class="form-group">
                <label for="profilePasswordConfirmation">Confirm Password</label>
                <input type="password" name="password_confirmation" id="profilePasswordConfirmation" placeholder="Confirm new password">
            </div>

            <div class="form-group">
                <label>Branch</label>
                <input type="text" value="N/A" readonly>
            </div>

            <div class="form-group">
                <label>Member Since</label>
                <input type="text" value="{{ optional($officer->created_at)->format('d M Y') ?? 'N/A' }}" readonly>
            </div>
        </div>

        <button type="submit" class="profile-btn-save">Save Changes</button>
    </div>
</form>

<script>
    // Live client-side preview of selected profile picture
    document.getElementById('profileImageInput').addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const preview = document.getElementById('avatarPreview');
                const initials = document.getElementById('initialsContainer');
                
                preview.src = e.target.result;
                preview.style.display = 'block';
                
                if (initials) {
                    initials.style.display = 'none';
                }
            };
            reader.readAsDataURL(file);
        }
    });
</script>
@endsection
