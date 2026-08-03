<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Models\Role as SpatieRole;

use Spatie\Activitylog\Traits\LogsActivity;
use \Spatie\Activitylog\LogOptions;

class Role extends SpatieRole
{
    use HasFactory, LogsActivity;

    //spatie activity log start
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['id','name'])    // Log only these fields
            ->useLogName('Role');    // Set log name
    }
    //spatie activity log end

}
