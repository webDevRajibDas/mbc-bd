<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Upazila extends Model
{
    use HasFactory, LogsActivity;

    protected $table = 'upazilas';

    protected $fillable = [
        'district_id', 'name', 'bn_name', 'url',
    ];

    public function district()
    {
        return $this->belongsTo(District::class, 'district_id');
    }

    public function unions()
    {
        return $this->hasMany(Union::class, 'upazila_id');
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['id', 'name', 'district_id'])
            ->useLogName('Upazila');
    }
}
