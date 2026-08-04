<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Scholarship extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title', 'slug', 'short_name', 'scholarship_code', 'short_description', 'overview',
        'about_scholarship', 'why_apply', 'selection_process', 'terms_conditions',
        'important_notes', 'additional_information', 'featured_image', 'banner_image',
        'scholarship_type', 'category', 'max_amount', 'amount_prefix', 'amount_suffix',
        'provider_name', 'provider_logo', 'application_mode', 'status', 'featured',
        'featured_on_homepage', 'sort_order', 'cta_text', 'cta_url', 'created_by', 'updated_by'
    ];

    protected $casts = [
        'max_amount' => 'decimal:2',
        'status' => 'integer',
        'featured' => 'integer',
        'featured_on_homepage' => 'integer',
        'sort_order' => 'integer'
    ];

    public function eligibility()
    {
        return $this->hasOne(ScholarshipEligibility::class);
    }

    public function benefits()
    {
        return $this->hasMany(ScholarshipBenefit::class)->orderBy('sort_order');
    }

    public function courses()
    {
        return $this->belongsToMany(Course::class, 'scholarship_courses');
    }

    public function universities()
    {
        return $this->belongsToMany(Organisation::class, 'scholarship_universities', 'scholarship_id', 'organisation_id');
    }

    public function documents()
    {
        return $this->hasMany(ScholarshipDocument::class);
    }

    public function dates()
    {
        return $this->hasOne(ScholarshipDate::class);
    }

    public function faqs()
    {
        return $this->hasMany(ScholarshipFaq::class)->orderBy('sort_order');
    }

    public function gallery()
    {
        return $this->hasMany(ScholarshipGallery::class)->orderBy('sort_order');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
