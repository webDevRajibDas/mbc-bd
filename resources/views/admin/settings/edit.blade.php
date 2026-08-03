@extends('layouts.app')

@section('title', 'Application Settings')

@section('content')

<div class="app-title">
    <div>
        <h1><i class="fa fa-cogs"></i> Application Settings</h1>
    </div>
    <ul class="app-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        <li class="breadcrumb-item">Settings</li>
        <li class="breadcrumb-item active">Application Settings</li>
    </ul>
</div>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="{{ route('master.settings.update') }}" enctype="multipart/form-data">
    @csrf

    <div class="row">
        <!-- Branding Config -->
        <div class="col-md-6">
            <div class="tile">
                <h3 class="tile-title"><i class="fa fa-tag"></i> Branding Config</h3>
                <div class="tile-body">
                    <div class="form-group">
                        <label for="brand_name" class="font-weight-bold">Brand Name *</label>
                        <input type="text" name="brand_name" id="brand_name" class="form-control" value="{{ old('brand_name', $settings->brand_name) }}" required>
                    </div>

                    <div class="form-group">
                        <label for="logo" class="font-weight-bold">Logo Image (PNG, JPG, SVG)</label>
                        <input type="file" name="logo" id="logo" class="form-control-file">
                        @if($settings->logo)
                            <div class="mt-3">
                                <span class="d-block text-muted small mb-1">Current Logo Preview:</span>
                                <img src="{{ asset($settings->logo) }}" alt="Logo" style="max-height: 70px; border: 1px solid #ddd; padding: 6px; border-radius: 6px; background: #fff;">
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Appearance Config -->
        <div class="col-md-6">
            <div class="tile">
                <h3 class="tile-title"><i class="fa fa-paint-brush"></i> Appearance Config</h3>
                <div class="tile-body">
                    <div class="form-group">
                        <label for="navbar_color" class="font-weight-bold">Navbar / Sidebar Color *</label>
                        <div class="d-flex align-items-center" style="gap: 12px;">
                            <input type="color" name="navbar_color" id="navbar_color" class="form-control" value="{{ old('navbar_color', $settings->navbar_color) }}" style="width: 70px; padding: 0 4px; height: 40px; cursor: pointer;">
                            <code class="text-uppercase" id="navbar_color_hex">{{ $settings->navbar_color }}</code>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="header_color" class="font-weight-bold">Header Color *</label>
                        <div class="d-flex align-items-center" style="gap: 12px;">
                            <input type="color" name="header_color" id="header_color" class="form-control" value="{{ old('header_color', $settings->header_color) }}" style="width: 70px; padding: 0 4px; height: 40px; cursor: pointer;">
                            <code class="text-uppercase" id="header_color_hex">{{ $settings->header_color }}</code>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Social Links Config -->
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <h3 class="tile-title"><i class="fa fa-share-alt"></i> Social Accounts Links</h3>
                <div class="tile-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="social_youtube" class="font-weight-bold"><i class="fa fa-youtube-play text-danger"></i> YouTube URL</label>
                                <input type="url" name="social_youtube" id="social_youtube" class="form-control" value="{{ old('social_youtube', $settings->social_youtube) }}" placeholder="https://youtube.com/channel/...">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="social_facebook" class="font-weight-bold"><i class="fa fa-facebook-official text-primary"></i> Facebook URL</label>
                                <input type="url" name="social_facebook" id="social_facebook" class="form-control" value="{{ old('social_facebook', $settings->social_facebook) }}" placeholder="https://facebook.com/group/...">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="social_community" class="font-weight-bold"><i class="fa fa-users text-warning"></i> Yellow Group Community URL</label>
                                <input type="url" name="social_community" id="social_community" class="form-control" value="{{ old('social_community', $settings->social_community) }}" placeholder="https://community.example.com/...">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="social_messenger" class="font-weight-bold"><i class="fa fa-comments text-info"></i> Chat Bubble / Messenger URL</label>
                                <input type="url" name="social_messenger" id="social_messenger" class="form-control" value="{{ old('social_messenger', $settings->social_messenger) }}" placeholder="https://messenger.com/t/...">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Transaction & Fee Config -->
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <h3 class="tile-title"><i class="fa fa-money"></i> Transaction &amp; Fee Config</h3>
                <div class="tile-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="booking_money" class="font-weight-bold">Booking Money (বুকিং মানি) *</label>
                                <input type="number" name="booking_money" id="booking_money" class="form-control" value="{{ old('booking_money', $settings->booking_money) }}" min="0" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="service_charge" class="font-weight-bold">Service Charge (সার্ভিস চার্জ) *</label>
                                <input type="number" name="service_charge" id="service_charge" class="form-control" value="{{ old('service_charge', $settings->service_charge) }}" min="0" required>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Payout Settings -->
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <h3 class="tile-title"><i class="fa fa-credit-card"></i> Payout Settings</h3>
                <div class="tile-body">
                    @php
                        $payoutMethod = old('payout_method', $settings->payout_method ?? 'bkash_nagad');
                        $balanceView = old('balance_view', $settings->balance_view ?? 'open');
                        $payoutMethods = [
                            'bkash_nagad' => 'bKash / Nogad',
                            'bank' => 'Bank',
                            'cellfin' => 'Cellfin',
                            'myprime' => 'MyPrime',
                            'nexuspay' => 'Nexuspay',
                        ];
                    @endphp

                    <div class="row">
                        <div class="col-md-6">
                            <label class="font-weight-bold d-block">Payout Method *</label>
                            @foreach($payoutMethods as $value => $label)
                                <div class="custom-control custom-radio mb-2">
                                    <input type="radio" name="payout_method" value="{{ $value }}" id="payout_method_{{ $value }}" class="custom-control-input" {{ $payoutMethod === $value ? 'checked' : '' }} required>
                                    <label class="custom-control-label" for="payout_method_{{ $value }}">{{ $label }}</label>
                                </div>
                            @endforeach
                        </div>

                        <div class="col-md-6">
                            <label class="font-weight-bold d-block">Balance View *</label>
                            <div class="custom-control custom-radio mb-2">
                                <input type="radio" name="balance_view" value="hold" id="balance_view_hold" class="custom-control-input" {{ $balanceView === 'hold' ? 'checked' : '' }} required>
                                <label class="custom-control-label" for="balance_view_hold">Hold</label>
                            </div>
                            <div class="custom-control custom-radio mb-3">
                                <input type="radio" name="balance_view" value="open" id="balance_view_open" class="custom-control-input" {{ $balanceView === 'open' ? 'checked' : '' }} required>
                                <label class="custom-control-label" for="balance_view_open">Open</label>
                            </div>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" id="balance_view_toggle" class="custom-control-input" {{ $balanceView === 'open' ? 'checked' : '' }}>
                                <label class="custom-control-label" for="balance_view_toggle">Show balance in Officer Panel</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Advertise Config -->
    <div class="row" id="advertise-config">
        <div class="col-md-12">
            <div class="tile">
                <h3 class="tile-title"><i class="fa fa-bullhorn"></i> Add Advertise Config</h3>
                <div class="tile-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="font-weight-bold d-block">Add Advertise</label>
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" name="advertise_enabled" value="1" id="advertise_enabled" class="custom-control-input" {{ old('advertise_enabled', $settings->advertise_enabled ?? true) ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="advertise_enabled">Enable for Officer Panel</label>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="advertise_default_point" class="font-weight-bold">Default Advertise Point *</label>
                                <input type="number" name="advertise_default_point" id="advertise_default_point" class="form-control" value="{{ old('advertise_default_point', $settings->advertise_default_point ?? 50) }}" min="0" required>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="advertise_default_status" class="font-weight-bold">Default Advertise Status *</label>
                                <select name="advertise_default_status" id="advertise_default_status" class="form-control" required>
                                    @php($advertiseStatus = old('advertise_default_status', $settings->advertise_default_status ?? 'active'))
                                    <option value="active" {{ $advertiseStatus === 'active' ? 'selected' : '' }}>Active</option>
                                    <option value="inactive" {{ $advertiseStatus === 'inactive' ? 'selected' : '' }}>Inactive</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Submit Section -->
    <div class="tile">
        <div class="tile-footer d-flex justify-content-end">
            <button type="submit" class="btn btn-primary btn-lg"><i class="fa fa-save"></i> Save Settings</button>
        </div>
    </div>
</form>

<script>
    document.getElementById('navbar_color').addEventListener('input', function() {
        document.getElementById('navbar_color_hex').innerText = this.value;
    });
    document.getElementById('header_color').addEventListener('input', function() {
        document.getElementById('header_color_hex').innerText = this.value;
    });

    document.getElementById('balance_view_toggle').addEventListener('change', function() {
        document.getElementById(this.checked ? 'balance_view_open' : 'balance_view_hold').checked = true;
    });

    document.querySelectorAll('input[name="balance_view"]').forEach(function(input) {
        input.addEventListener('change', function() {
            document.getElementById('balance_view_toggle').checked = this.value === 'open';
        });
    });
</script>

@endsection
