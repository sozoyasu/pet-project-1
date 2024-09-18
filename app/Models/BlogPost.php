<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class BlogPost extends Model
{
    use HasFactory;

    protected $table = 'blog_posts';

    protected $fillable = [
        'title',
        'slug',
        'is_active',
        'short_text',
        'short_image',
        'detail_text',
        'detail_image',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

//    public function getRouteKeyName(): string
//    {
//        return 'slug';
//    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(BlogCategory::class, 'blog_posts_categories', 'post_id', 'category_id');
    }
}
