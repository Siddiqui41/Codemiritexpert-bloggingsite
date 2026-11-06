<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'category_id',
        'title',
        'slug',
        'kicker',
        'excerpt',
        'content',
        'cover_image',
        'cover_caption',
        'reading_time',
        'is_hero',
        'is_featured',
        'is_guide',
        'views_count',
        'claps_count',
        'status',
        'tags',
        'published_at',
    ];

    protected $casts = [
        'is_hero' => 'boolean',
        'is_featured' => 'boolean',
        'is_guide' => 'boolean',
        'tags' => 'array',
        'published_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class)->where('status', 'approved');
    }

    public function allComments()
    {
        return $this->hasMany(Comment::class);
    }

    public function getCoverImageUrlAttribute()
    {
        if (empty($this->cover_image)) {
            return 'https://images.unsplash.com/photo-1507238691740-187a5b1d37b8?auto=format&fit=crop&w=1200&q=80';
        }
        if (str_starts_with($this->cover_image, 'http://') || str_starts_with($this->cover_image, 'https://')) {
            return $this->cover_image;
        }
        return asset(ltrim($this->cover_image, '/'));
    }
}
