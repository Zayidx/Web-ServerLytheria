<?php

use App\Livewire\HomePage;
use App\Livewire\Maintenance;
use App\Livewire\News;
use App\Livewire\DetailNews;
use App\Livewire\Shop;
use App\Livewire\Vote;
use App\Livewire\Auth\Login;
use App\Livewire\Auth\Register;
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\Dashboard as AdminDashboard;
use App\Livewire\Admin\CategoryNews as AdminCategoryNews;
use App\Livewire\Admin\News as AdminNews;
use App\Livewire\Admin\Owner as AdminOwner;
use App\Livewire\Admin\Vote as AdminVote;
use App\Livewire\Admin\Shop as AdminShop;
use App\Livewire\Admin\Gamemode as AdminGamemode;


Route::get('/', HomePage::class)->name('home');
Route::get('/news', News::class)->name('news');
Route::get('/news/{slug}', DetailNews::class)->name('news.detail');
Route::get('/shop', Maintenance::class)->name('shop');
Route::get('/vote', Vote::class)->name('vote');

Route::middleware('guest')->group(function () {
    Route::get('/login', Login::class)->name('login');
    Route::get('/register', Register::class)->name('register');
});


Route::prefix('admin')->middleware(['auth', 'admin'])->name('admin.')->group(function () {
    Route::get('/dashboard', AdminDashboard::class)->name('dashboard');
    Route::get('/categories', AdminCategoryNews::class)->name('categories');
    Route::get('/news', AdminNews::class)->name('news');
    Route::get('/owners', AdminOwner::class)->name('owners');
    Route::get('/votes', AdminVote::class)->name('votes');
    Route::get('/shops', AdminShop::class)->name('shops');
    Route::get('/gamemodes', AdminGamemode::class)->name('gamemodes');
    Route::get('/shop', AdminShop::class)->name('shop');
});

// Logout
Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('login');
})->name('logout');

