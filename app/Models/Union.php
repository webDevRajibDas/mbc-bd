<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Union extends Model
{
    use HasFactory, LogsActivity;

    protected $table = 'unions';

    protected $fillable = [
        'upazila_id', 'name', 'bn_name', 'url',
    ];

    public function upazila()
    {
        return $this->belongsTo(Upazila::class, 'upazila_id');
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['id', 'name', 'upazila_id'])
            ->useLogName('Union');
    }
}
