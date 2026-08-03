<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Booking extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'officer_id',
        'project_name_id',
        'full_name',
        'guardian_name',
        'nid_no',
        'phone_number',
        'gender',
        'division_id',
        'district_id',
        'upazila_id',
        'union_id',
        'holding_village',
        'referral_id',
        'placement_user_id',
        'nominee_name',
        'relationship',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function officer()
    {
        return $this->belongsTo(User::class, 'officer_id');
    }

    public function projectName()
    {
        return $this->belongsTo(ProjectName::class, 'project_name_id');
    }

    public function division()
    {
        return $this->belongsTo(Division::class, 'division_id');
    }

    public function district()
    {
        return $this->belongsTo(District::class, 'district_id');
    }

    public function upazila()
    {
        return $this->belongsTo(Upazila::class, 'upazila_id');
    }

    public function union()
    {
        return $this->belongsTo(Union::class, 'union_id');
    }
}
