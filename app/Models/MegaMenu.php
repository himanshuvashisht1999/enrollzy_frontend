<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MegaMenu extends Model
{
    protected $fillable = [
        'parent_id',
        'title',
        'url',
        'column_title',
        'sort_order',
        'status',
        'is_highlighted',
    ];

    public function parent()
    {
        return $this->belongsTo(MegaMenu::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(MegaMenu::class, 'parent_id')->orderBy('sort_order');
    }
}
