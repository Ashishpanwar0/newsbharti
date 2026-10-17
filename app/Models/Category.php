<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description',
        'is_active',
        'show_in_header',
        'sort_order',
    ];

    public function subcategories(): HasMany
    {
        return $this->hasMany(Subcategory::class);
    }
    public function news()
{
    return $this->hasMany(News::class);
}
}
