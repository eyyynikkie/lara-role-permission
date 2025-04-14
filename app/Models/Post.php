<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'ft_image',
        'slug',
        'content',
        'user_id',
        'category_id',
        'is_published',
        'published_at',
        'has_affiliate_links',
        'affiliate_disclaimer',
        'affiliate_product_url' // optional
    ];

    protected $casts = [
        'published_at' => 'date',
        'is_published' => 'boolean',
        'has_affiliate_links' => 'boolean'
    ];

    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = $value;
        $this->attributes['slug'] = strtolower(Str::slug($value));
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'post_tag');
    }

    public function scopePublished($query)
    {
        return $query->where('is_published', true)
                     ->whereNotNull('published_at')
                     ->where('published_at', '<=', now());
    }

    public function scopeDrafts($query)
    {
        return $query->where('is_published', false);
    }
}
