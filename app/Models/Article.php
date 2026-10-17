<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model
{
    use SoftDeletes;

    // Placeholder list: replace with the client's real homepage sections
    public const HOMEPAGE_SECTIONS = [
        'top_stories' => 'Top Stories',
        'breaking' => 'Breaking News',
        'trending' => 'Trending',
        'editors_pick' => "Editor's Pick",
    ];

    protected $fillable = [
        'category_id', 'subcategory_id', 'location_id', 'author_id', 'reporter_name',
        'headline', 'slug', 'summary', 'body',
        'thumbnail', 'image_alt', 'gallery',
        'meta_title', 'meta_description', 'focus_keyword', 'canonical_url',
        'og_title', 'og_description', 'og_image',
        'youtube_url', 'facebook_url',
        'status', 'published_at',
        'is_pinned', 'pin_priority', 'homepage_section',
        'views',
    ];

    protected $casts = [
        'is_pinned' => 'boolean',
        'gallery' => 'array',
        'published_at' => 'datetime',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function subcategory(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'subcategory_id');
    }

    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    // Public site: visible once published, or once a scheduled time has arrived.
    // No cron job needed: "scheduled" articles appear automatically when the time passes.
    public function scopePublished(Builder $query): Builder
    {
        return $query->whereIn('status', ['published', 'scheduled'])
                     ->where('published_at', '<=', now());
    }
}