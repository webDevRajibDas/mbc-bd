<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AppSetting extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'app_settings';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'brand_name',
        'logo',
        'navbar_color',
        'header_color',
        'social_youtube',
        'social_facebook',
        'social_community',
        'social_messenger',
        'booking_money',
        'service_charge',
        'payout_method',
        'balance_view',
        'advertise_enabled',
        'advertise_default_point',
        'advertise_default_status',
    ];
}
