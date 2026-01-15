<?php

namespace App\Livewire\PublicPages\Articles;

use App\Models\Article;
use Livewire\Component;

class Detail extends Component
{
    public $article;
    public $related = [];

    public function mount($slug) 
    {
        $this->article = Article::with(['category', 'author'])
            ->where('slug', $slug)
            ->where('status', 'published')
            ->firstOrFail(); 

        $this->related = Article::where('article_category_id', $this->article->article_category_id)
            ->where('id', '!=', $this->article->id)
            ->where('status', 'published')
            ->latest('published_at')
            ->take(3)
            ->get();
    }
    
    public function title()
    {
        return $this->article->title . ' - PT KAL';
    }

    public function render()
    {
        return view('livewire.public-pages.articles.detail');
    }
}