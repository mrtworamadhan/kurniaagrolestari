<?php

use App\Livewire\Auth\Login;
use App\Livewire\Client\GardenAdd;
use App\Livewire\Client\GardenDetail;
use App\Livewire\Client\Notifications;
use App\Livewire\PublicPages\About;
use App\Livewire\PublicPages\HomePage;
use App\Livewire\PublicPages\Partner;
use App\Livewire\PublicPages\Products\Index as ProductIndex;
use App\Livewire\PublicPages\Products\Detail as ProductDetail;
use App\Livewire\PublicPages\Articles\Index as ArticleIndex;
use App\Livewire\PublicPages\Articles\Detail as ArticleDetail;
use App\Livewire\PublicPages\Solution;
use App\Livewire\Client\Dashboard as ClientDashboard;
use App\Livewire\Client\Garden as ClientGarden;
use App\Livewire\Client\Record as ClientRecord;
use App\Livewire\Client\Shop as ClientShop;
use App\Livewire\Client\Profile as ClientProfile;
use App\Livewire\Client\ProductDetail as ClientProductDetail;
use App\Livewire\Client\OrderHistory;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InvoiceController;

Route::middleware('guest')->group(function () {
    Route::get('/login', Login::class)->name('login');
});

Route::get('/', HomePage::class)->name('home');
Route::get('/tentang-kami', About::class)->name('about');
Route::get('/produk', ProductIndex::class)->name('products');
Route::get('/produk/{id}', ProductDetail::class)->name('products.detail');
Route::get('/solusi', Solution::class)->name('solutions');
Route::get('/artikel', ArticleIndex::class)->name('articles');
Route::get('/artikel/{slug}', ArticleDetail::class)->name('articles.detail');
Route::get('/mitra', Partner::class)->name('partners');

Route::get('/invoice/{order}', [InvoiceController::class, 'print'])->name('invoice.print');

Route::prefix('client')->name('client.')->middleware('auth')->group(function () {
    Route::get('/dashboard', ClientDashboard::class)->name('dashboard');
    Route::get('/kebun', ClientGarden::class)->name('garden');
    Route::get('/kebun/tambah', GardenAdd::class)->name('garden.add');
    Route::get('/kebun/{id}', GardenDetail::class)->name('garden.detail'); 
    Route::get('/rekam-medis', ClientRecord::class)->name('record');
    Route::get('/produk', ClientShop::class)->name('shop'); 
    Route::get('/produk/{id}', ClientProductDetail::class)->name('shop.detail');
    Route::get('/profil', ClientProfile::class)->name('profile');
    Route::get('/pesanan', OrderHistory::class)->name('orders');
    Route::get('/notifikasi', Notifications::class)->name('notifications');
});

Route::view('/offline', 'offline')->name('offline');