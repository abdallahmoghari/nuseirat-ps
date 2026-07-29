<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable = ['slug'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function author()
    {
        return $this->belongsTo(Author::class);
    }

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($article) {
            if (empty($article->slug)) {
                $article->slug = static::makeSlug($article->title);
            }
        });
        static::updating(function ($article) {
            if ($article->isDirty('title') && !$article->isDirty('slug')) {
                $article->slug = static::makeSlug($article->title, $article->id);
            }
        });
    }

    public static function makeSlug($text, $ignoreId = null)
    {
        $text = preg_replace('/[\s]+/u', '-', $text);
        $text = preg_replace('/[^\p{Arabic}\w\-]/u', '', $text);
        $text = preg_replace('/-+/', '-', $text);
        $text = trim($text, '-');
        if (empty($text)) $text = 'article';
        $base = $text;
        $i = 1;
        $query = static::where('slug', $text);
        if ($ignoreId !== null) $query->where('id', '!=', $ignoreId);
        while ($query->exists()) {
            $text = $base . '-' . $i++;
            $query = static::where('slug', $text);
            if ($ignoreId !== null) $query->where('id', '!=', $ignoreId);
        }
        return $text;
    }

    public function scopeFindBySlug($query, $slug)
    {
        return $query->where('slug', $slug);
    }
}
