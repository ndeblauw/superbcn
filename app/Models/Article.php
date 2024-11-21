<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Article extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    protected $guarded = [];

    protected $casts = [
        'published_at' => 'datetime',
    ];

    // Model relationships --------
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'article_category');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'article_id');
    }

    // Model scopes --------
    public function scopePublished($query)
    {
        return $query->whereNotNull('published_at')->where('published_at', '<=', now());
    }

    // Model methods --------
    public function summary(int $lenght = 50): string
    {
        return Str::of($this->content)->limit($lenght);
    }

    public function authorized(User $user): void
    {
        if($user->is_admin) {
            return;
        }

        if ($this->author_id == $user->id) {
            return;
        }

        abort(401);
    }
}
