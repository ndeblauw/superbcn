<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Spatie\Image\Enums\Fit;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Article extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;
    use SoftDeletes;

    protected $guarded = [];

    protected $casts = [
        'published_at' => 'datetime',
    ];

    // Model events --------
    protected static function booted(): void
    {
        static::creating(function (Article $article) {
            ray($article)->green();
            $article['slug'] = $article['slug'] ?? self::generateSlug($article['title']);
            ray($article)->red();
        });
    }

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
        if ($user->is_admin) {
            return;
        }

        if ($this->author_id == $user->id) {
            return;
        }

        abort(401);
    }

    // Custom methods --------
    public function getContent(): string
    {
        $replace_list = [
            '<p>' => '<p class="mt-4">',
            '<ul>' => '<ul class="list-disc list-inside">',
        ];

        $content = $this->content;
        foreach ($replace_list as $from => $to) {
            $content = str_replace($from, $to, $content);
        }

        return $content;
    }

    public static function generateSlug($title): string
    {
        $slug = Str::of($title)->slug()->toString();

        $nr = self::where('slug', $slug)->count();
        if ($nr === 1) {
            $slug .= '-'.random_int(0, 10000);
        }

        return $slug;
    }

    // Media conversions
    public function registerMediaConversions(?Media $media = null): void
    {
        $this
            ->addMediaConversion('preview')
            ->fit(Fit::Contain, 300, 300)
            ->nonQueued();
    }
}
