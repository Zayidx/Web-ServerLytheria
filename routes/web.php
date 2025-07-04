<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Auth\Login;
use App\Livewire\Admin\Dashboard;
use App\Livewire\Admin\Vote as AdminVote;
use Illuminate\Support\Facades\Auth;

// Rute Publik
Route::get('/', \App\Livewire\HomePage::class)->name('home');
Route::get('/news', \App\Livewire\News::class)->name('news');
Route::get('/news/{slug}', \App\Livewire\DetailNews::class)->name('news.detail');
Route::get('/shop', \App\Livewire\Shop::class)->name('shop');
Route::get('/vote', \App\Livewire\Vote::class)->name('vote');

// Rute Autentikasi
Route::get('/login', Login::class)->name('login')->middleware('guest');

// Rute Admin (Diproteksi)
Route::prefix('admin')->middleware(['auth', 'admin'])->name('admin.')->group(function () {
    Route::get('/dashboard', Dashboard::class)->name('dashboard');
    Route::get('/news', \App\Livewire\Admin\News::class)->name('news');
    Route::get('/categories', \App\Livewire\Admin\CategoryNews::class)->name('categories');
    Route::get('/owners', \App\Livewire\Admin\Owner::class)->name('owners');
    Route::get('/shop', \App\Livewire\Admin\Shop::class)->name('shop');
    Route::get('/gamemodes', \App\Livewire\Admin\Gamemode::class)->name('gamemodes');
    Route::get('/vote', AdminVote::class)->name('vote');
});

// Logout
Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('login');
})->name('logout');
