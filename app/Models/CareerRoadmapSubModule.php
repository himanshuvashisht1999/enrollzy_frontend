<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CareerRoadmapSubModule extends Model
{
    protected $table = 'career_roadmap_sub_modules';

    protected $fillable = [
        'stage_id',
        'parent_id',
        'title',
        'slug',
        'image',
        'description',
        'custom_fields',
        'status',
    ];

    protected $casts = [
        'custom_fields' => 'array',
    ];

    public function stage()
    {
        return $this->belongsTo(CareerRoadmapStage::class, 'stage_id');
    }

    public function parent()
    {
        return $this->belongsTo(CareerRoadmapSubModule::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(CareerRoadmapSubModule::class, 'parent_id')->orderBy('id');
    }
}
