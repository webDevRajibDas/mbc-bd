<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyStore extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'title_bn', 'property_category_id', 'community_type', 'reference_code',
        'short_description', 'description_bn', 'division_id', 'district_id', 'upazila_id',
        'union_id', 'landmark', 'minimum_plot_size', 'plot_unit', 'total_plots',
        'members_target', 'booking_money', 'installment_duration', 'duration_unit',
        'installments', 'entry_designation', 'top_designation', 'promotion_path',
        'feature_image', 'gallery_images', 'status', 'is_featured', 'is_members_only',
    ];

    protected $casts = [
        'installments' => 'array',
        'gallery_images' => 'array',
        'is_featured' => 'boolean',
        'is_members_only' => 'boolean',
        'minimum_plot_size' => 'decimal:2',
        'booking_money' => 'decimal:2',
    ];

    public function category() { return $this->belongsTo(PropertyCategory::class, 'property_category_id'); }
    public function division() { return $this->belongsTo(Division::class); }
    public function district() { return $this->belongsTo(District::class); }
    public function upazila() { return $this->belongsTo(Upazila::class); }
    public function union() { return $this->belongsTo(Union::class); }
}
