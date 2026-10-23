<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StreamOffered extends Model
{
    use HasFactory;

    protected $table = 'stream_offereds';

    protected $fillable = ['title', 'status', 'sort_order'];

    protected $casts = [
        'status' => 'boolean',
    ];

    public function courses()
    {
        return $this->hasMany(Course::class, 'stream_offered_id');
    }
}
