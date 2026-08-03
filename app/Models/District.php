<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class District extends Model
{
    use HasFactory, LogsActivity;

    protected $table = 'districts';

    protected $fillable = [
        'division_id', 'name', 'bn_name', 'url',
    ];

    public function division()
    {
        return $this->belongsTo(Division::class, 'division_id');
    }

    public function upazilas()
    {
        return $this->hasMany(Upazila::class, 'district_id');
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['id', 'name', 'division_id'])
            ->useLogName('District');
    }
}
