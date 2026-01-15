<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = [
        'article_category_id',
        'user_id',
        'title',
        'slug',
        'thumbnail',
        'content',
        'status',       
        'published_at',
    ];

    protected $casts = [
        'published_at' => 'date',
    ];

    public function category() 
    { 
        return $this->belongsTo(ArticleCategory::class, 'article_category_id'); 
    }
    public function getReadTimeAttribute()
    {
        $wordCount = str_word_count(strip_tags($this->content));
        $minutes = ceil($wordCount / 200);
        return $minutes . ' min baca';
    }
    public function getFormattedDateAttribute()
    {
        return $this->published_at ? $this->published_at->translatedFormat('d M Y') : '-';
    }
    
    public function getImageUrlAttribute()
    {
        return $this->thumbnail 
            ? asset('storage/' . $this->thumbnail) 
            : 'https://via.placeholder.com/800x400?text=No+Image'; 
    }


    
    public function author() 
    { 
        return $this->belongsTo(User::class, 'user_id'); 
    }
}