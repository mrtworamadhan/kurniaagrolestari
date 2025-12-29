<?php

use App\Livewire\PublicPages\About;
use App\Livewire\PublicPages\HomePage;
use App\Livewire\PublicPages\Partner;
use App\Livewire\PublicPages\Products\Index as ProductIndex;
use App\Livewire\PublicPages\Products\Detail as ProductDetail;
use App\Livewire\PublicPages\Articles\Index as ArticleIndex;
use App\Livewire\PublicPages\Articles\Detail as ArticleDetail;
use App\Livewire\PublicPages\Solution;
use Illuminate\Support\Facades\Route;

Route::get('/', HomePage::class)->name('home');
Route::get('/tentang-kami', About::class)->name('about');
Route::get('/produk', ProductIndex::class)->name('products');
Route::get('/produk/{id}', ProductDetail::class)->name('products.detail');
Route::get('/solusi', Solution::class)->name('solutions');
Route::get('/artikel', ArticleIndex::class)->name('articles');
Route::get('/artikel/{id}', ArticleDetail::class)->name('articles.detail');
Route::get('/mitra', Partner::class)->name('partners');
