@extends('layouts.app')

@section('title', 'Officer Booking Form')
@section('header-title', 'Officer Booking Form')
@section('sidebar')
    @include('officer.partial.sidebar')
@endsection

@push('styles')
<style>
    .officer-booking-page,
    .officer-booking-page * {
        box-sizing: border-box;
    }
    .officer-booking-page {
        min-height: calc(100vh - 69px);
        margin: -12px;
        padding: 26px;
        background: #f4f7fb;
        font-family: Arial, "Hind Siliguri", sans-serif;
    }
    .booking-form-card {
        width: min(100%, 680px);
        margin: 0 auto;
        background: #dfeecb;
        border: 8px solid #8fb9e6;
        border-radius: 2px;
        padding: 14px 22px 18px;
    }
    .booking-form-top {
        display: grid;
        grid-template-columns: 94px minmax(0, 1fr);
        gap: 10px;
        align-items: center;
    }
    .booking-form-bismillah {
        grid-column: 1 / -1;
        text-align: center;
        font-size: 13px;
        color: #333;
        text-decoration: underline wavy #d21f1f;
    }
    .booking-form-logo {
        width: 68px;
        height: 68px;
        border-radius: 50%;
        border: 4px solid #20a558;
        background: #fff;
        color: #f20d0d;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 25px;
        font-weight: 900;
    }
    .booking-form-brand {
        color: #6a24d9;
        font-size: 22px;
        font-weight: 900;
        line-height: 1.05;
        text-decoration: underline;
    }
    .booking-form-brand span {
        display: block;
        color: #000;
        font-size: 18px;
        text-decoration: none;
    }
    .booking-form-title {
        display: grid;
        grid-template-columns: minmax(0, 1fr) auto;
        gap: 12px;
        align-items: center;
        margin: 8px 0;
    }
    .booking-form-project {
        display: flex;
        min-width: 0;
        border: 1px solid #111;
        background: #fff;
    }
    .booking-form-project span {
        background: #6fa7de;
        color: #fff;
        padding: 4px 8px;
        font-size: 18px;
        font-family: Georgia, serif;
        font-weight: 800;
        white-space: nowrap;
    }
    .booking-form-project strong {
        color: #f20d0d;
        padding: 4px 8px;
        font-size: 22px;
        font-weight: 900;
        text-shadow: 1px 1px #111;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    .booking-form-project select {
        width: 100%;
        min-width: 0;
        border: 0;
        background: #fff;
        color: #f20d0d;
        padding: 4px 8px;
        font-size: 18px;
        font-weight: 900;
        outline: 0;
    }
    .booking-form-code {
        display: grid;
        grid-template-columns: repeat(8, 15px);
        gap: 1px;
    }
    .booking-form-code span {
        width: 15px;
        height: 15px;
        border: 1px solid #111;
        background: #dfeecb;
    }
    .booking-form-heading {
        display: grid;
        grid-template-columns: 112px 1fr 120px;
        gap: 8px;
        align-items: center;
        margin-bottom: 8px;
    }
    .booking-form-officer {
        border: 1px solid #111;
        background: #fff;
        color: #001eff;
        font-size: 12px;
        font-weight: 800;
        padding: 3px;
    }
    .booking-form-heading h3 {
        margin: 0;
        color: #8a3bc1;
        font-size: 22px;
        font-family: Georgia, serif;
        font-weight: 900;
        text-align: center;
        text-transform: uppercase;
    }
    .booking-form-grid {
        display: grid;
        gap: 3px;
    }
    .booking-field {
        display: grid;
        grid-template-columns: 32px 1fr;
        align-items: center;
        min-height: 28px;
        border: 1px solid #111;
        background: #fff;
    }
    .booking-field.is-split {
        grid-template-columns: 32px minmax(0, 1fr) 48px minmax(120px, .7fr);
    }
    .booking-icon {
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #7c32c4;
        border-right: 1px solid #b7c9dd;
        font-size: 16px;
    }
    .booking-field input,
    .booking-field select {
        width: 100%;
        min-width: 0;
        border: 0;
        background: transparent;
        padding: 4px 7px;
        font-size: 13px;
        color: #111;
        outline: 0;
    }
    .booking-price-table {
        width: 100%;
        margin-top: 6px;
        border-collapse: collapse;
        background: #f5d8d8;
        font-size: 13px;
    }
    .booking-price-table th,
    .booking-price-table td {
        border: 1px solid #111;
        padding: 3px 6px;
        text-align: center;
    }
    .booking-terms {
        display: flex;
        align-items: center;
        gap: 7px;
        background: #fff;
        border: 1px solid #111;
        padding: 5px;
        font-size: 12px;
    }
    .booking-terms input {
        width: 16px;
        height: 16px;
        margin: 0;
    }
    .booking-submit {
        display: block;
        margin: 10px auto 0;
        border: 1px solid #111;
        background: #cfe4f7;
        color: #f20d0d;
        padding: 6px 20px;
        font-size: 16px;
        font-weight: 800;
    }
    @media (max-width: 700px) {
        .officer-booking-page {
            margin: -12px;
            padding: 12px;
        }
        .booking-form-card {
            padding: 12px;
        }
        .booking-form-title,
        .booking-form-heading {
            grid-template-columns: 1fr;
        }
        .booking-form-code {
            justify-content: center;
        }
        .booking-field.is-split {
            grid-template-columns: 32px 1fr;
        }
    }
</style>
@endpush

@section('content')
<div class="officer-booking-page">
    <form class="booking-form-card" method="POST" action="{{ route('officer.booking-form.store') }}">
        @csrf
        <div class="booking-form-top">
            <div class="booking-form-bismillah">বিসমিল্লাহির রাহমানির রাহিম</div>
            <div class="booking-form-logo">MB</div>
            <div class="booking-form-brand">
                MBC Bangladesh.com
                <span>Multiple Business Community</span>
            </div>
        </div>

        <div class="booking-form-title">
            <div class="booking-form-project">
                <span>Project Name</span>
                <select name="project_name_id" required>
                    <option value="">Select Project Name *</option>
                    @foreach($projectNames as $projectName)
                        <option value="{{ $projectName->id }}" {{ old('project_name_id') == $projectName->id ? 'selected' : '' }}>
                            {{ $projectName->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="booking-form-code" aria-label="Booking serial">
                @for($i = 0; $i < 8; $i++)
                    <span></span>
                @endfor
            </div>
        </div>

        <div class="booking-form-heading">
            <div class="booking-form-officer">Officer ID {{ $officer->id }}</div>
            <h3>Booking Form</h3>
            <div></div>
        </div>

        <div class="booking-form-grid">
            <label class="booking-field">
                <span class="booking-icon"><i class="fa fa-user"></i></span>
                <input type="text" name="user_name" placeholder="User Name">
            </label>
            <label class="booking-field">
                <span class="booking-icon"><i class="fa fa-user"></i></span>
                <input type="text" name="full_name" placeholder="Full Name">
            </label>
            <label class="booking-field">
                <span class="booking-icon"><i class="fa fa-user"></i></span>
                <input type="text" name="guardian_name" placeholder="Father's Name / Husband's Name">
            </label>
            <label class="booking-field">
                <span class="booking-icon"><i class="fa fa-id-card"></i></span>
                <input type="text" name="nid_no" placeholder="NID NO">
            </label>
            <div class="booking-field is-split">
                <span class="booking-icon"><i class="fa fa-mobile"></i></span>
                <input type="text" name="phone_number" placeholder="Phone Number">
                <span class="booking-icon"><i class="fa fa-venus-mars"></i></span>
                <select name="gender">
                    <option value="">Select Gender</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                    <option value="other">Other</option>
                </select>
            </div>
            <label class="booking-field">
                <span class="booking-icon"><i class="fa fa-globe"></i></span>
                <select name="division" id="division" required>
                    <option value="">Select Division *</option>
                    @foreach($divisions as $division)
                        <option value="{{ $division->id }}" {{ old('division') == $division->id ? 'selected' : '' }}>{{ $division->name }}</option>
                    @endforeach
                </select>
            </label>
            <label class="booking-field">
                <span class="booking-icon"><i class="fa fa-globe"></i></span>
                <select name="district" id="district" required>
                    <option value="">Select District *</option>
                </select>
            </label>
            <label class="booking-field">
                <span class="booking-icon"><i class="fa fa-globe"></i></span>
                <select name="thana" id="thana" required>
                    <option value="">Select Thana *</option>
                </select>
            </label>
            <label class="booking-field">
                <span class="booking-icon"><i class="fa fa-globe"></i></span>
                <select name="union" id="union" required>
                    <option value="">Select Union *</option>
                </select>
            </label>
            <label class="booking-field">
                <span class="booking-icon"><i class="fa fa-home"></i></span>
                <input type="text" name="holding_village" placeholder="Holding No and Village">
            </label>
            <label class="booking-field">
                <span class="booking-icon"><i class="fa fa-user"></i></span>
                <input type="text" name="referral_id" placeholder="Referral ID">
            </label>
            <label class="booking-field">
                <span class="booking-icon"><i class="fa fa-user"></i></span>
                <input type="text" name="placement_user_id" placeholder="Placement User ID">
            </label>
            <label class="booking-field">
                <span class="booking-icon"><i class="fa fa-lock"></i></span>
                <input type="password" name="password" placeholder="Password">
            </label>
            <label class="booking-field">
                <span class="booking-icon"><i class="fa fa-lock"></i></span>
                <input type="password" name="password_confirmation" placeholder="Re-Password">
            </label>
            <div class="booking-field is-split">
                <span class="booking-icon"><i class="fa fa-user"></i></span>
                <input type="text" name="nominee_name" placeholder="Nominee's name">
                <span></span>
                <select name="relationship">
                    <option value="">Relationship</option>
                    <option value="father">Father</option>
                    <option value="mother">Mother</option>
                    <option value="husband">Husband</option>
                    <option value="wife">Wife</option>
                    <option value="son">Son</option>
                    <option value="daughter">Daughter</option>
                    <option value="brother">Brother</option>
                    <option value="sister">Sister</option>
                </select>
            </div>
        </div>

        <table class="booking-price-table">
            <tbody>
                <tr>
                    <th>Level-1</th>
                    <td>এক কাঠা প্লট অথবা ফ্ল্যাটের অগ্রিম মানি</td>
                    <td>বুকিং মানি</td>
                    <td>{{ isset($appSettings) ? number_format($appSettings->booking_money) : '২০,০০০' }}/-</td>
                </tr>
                <tr>
                    <th></th>
                    <td></td>
                    <td>সার্ভিস চার্জ</td>
                    <td>{{ isset($appSettings) ? number_format($appSettings->service_charge) : '৬,৫০০' }}/-</td>
                </tr>
                <tr>
                    <th>পরিশোধিত সর্বমোট</th>
                    <td></td>
                    <td>মোট মূল্য</td>
                    <td>{{ isset($appSettings) ? number_format($appSettings->booking_money + $appSettings->service_charge) : '২৬,৫০০' }}/-</td>
                </tr>
            </tbody>
        </table>

        <label class="booking-terms">
            <input type="checkbox" name="terms" value="1">
            <span>I accept the Terms of Service and Privacy Policy</span>
        </label>

        <button type="submit" class="booking-submit">Submit</button>
    </form>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    $('#division').on('change', function() {
        var divisionId = $(this).val();
        $('#district').html('<option value="">Select District *</option>');
        $('#thana').html('<option value="">Select Thana *</option>');
        $('#union').html('<option value="">Select Union *</option>');
        
        if (divisionId) {
            $.ajax({
                url: '{{ url("/get-districts") }}/' + divisionId,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    $.each(data, function(key, value) {
                        $('#district').append('<option value="' + value.id + '">' + value.name + '</option>');
                    });
                }
            });
        }
    });

    $('#district').on('change', function() {
        var districtId = $(this).val();
        $('#thana').html('<option value="">Select Thana *</option>');
        $('#union').html('<option value="">Select Union *</option>');
        
        if (districtId) {
            $.ajax({
                url: '{{ url("/get-upazilas") }}/' + districtId,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    $.each(data, function(key, value) {
                        $('#thana').append('<option value="' + value.id + '">' + value.name + '</option>');
                    });
                }
            });
        }
    });

    $('#thana').on('change', function() {
        var upazilaId = $(this).val();
        $('#union').html('<option value="">Select Union *</option>');
        
        if (upazilaId) {
            $.ajax({
                url: '{{ url("/get-unions") }}/' + upazilaId,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    $.each(data, function(key, value) {
                        $('#union').append('<option value="' + value.id + '">' + value.name + '</option>');
                    });
                }
            });
        }
    });
});
</script>
@endpush
