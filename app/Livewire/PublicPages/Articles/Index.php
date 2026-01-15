<?php

namespace App\Livewire\PublicPages\Articles;

use App\Models\Article;
use App\Models\ArticleCategory;
use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\WithPagination;

#[Title('Artikel & Berita - PT Kurnia Agro Lestari')]
class Index extends Component
{
    use WithPagination;

    #[Url]
    public $categoryId = 0; 
    
    #[Url]
    public $search = '';

    public function render()
    {
        $categories = ArticleCategory::all();

        $query = Article::with(['category', 'author']) 
            ->where('status', 'published') 
            ->where('published_at', '<=', now());

        if ($this->categoryId != 0) {
            $query->where('article_category_id', $this->categoryId);
        }

        if ($this->search) {
            $query->where('title', 'like', '%' . $this->search . '%');
        }

        $allArticles = $query->latest('published_at')->get();

        $featured = null;
        $articles = $allArticles;

        if ($this->search == '' && $this->categoryId == 0 && $allArticles->count() > 0) {
            $featured = $allArticles->first();
            $articles = $allArticles->skip(1);
        }

        return view('livewire.public-pages.articles.index', [
            'categories' => $categories,
            'featured' => $featured,
            'articles' => $articles
        ]);
    }

    public function setCategory($id)
    {
        $this->categoryId = $id;
        $this->search = ''; 
    }
}