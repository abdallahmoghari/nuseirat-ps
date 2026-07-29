<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'description', 'status'];

    public function articles()
    {
        return $this->hasMany(Article::class);
    }

    public function latestArticles($limit = 3)
    {
        return $this->articles()->orderBy('created_at', 'desc')->take($limit);
    }

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($category) {
            if (empty($category->slug)) {
                $category->slug = static::makeSlug($category->name);
            }
        });
        static::updating(function ($category) {
            if ($category->isDirty('name') && !$category->isDirty('slug')) {
                $category->slug = static::makeSlug($category->name, $category->id);
            }
        });
    }

    public static function makeSlug($text, $ignoreId = null)
    {
        $text = preg_replace('/[\s]+/u', '-', $text);
        $text = preg_replace('/[^\p{Arabic}\w\-]/u', '', $text);
        $text = preg_replace('/-+/', '-', $text);
        $text = trim($text, '-');
        if (empty($text)) $text = 'category';
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
