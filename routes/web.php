<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\AnnouncementImageController;

Route::controller(PublicController::class)->group(function () {
    Route::get('/', 'index')->name('home');
    Route::get('/search', 'search')->name('search');
});


Route::middleware('auth')->controller(ProfileController::class)->group(function () {
    Route::get('/profile', 'edit')->name('profile.edit');
    Route::patch('/profile', 'update')->name('profile.update');
    Route::delete('/profile', 'destroy')->name('profile.destroy');
});


Route::delete('/images/{image}', [AnnouncementImageController::class, 'destroy'])->name('images.destroy');


Route::middleware('auth')->controller(AnnouncementController::class)->group(function () {
    Route::get('/announcement/user', 'index')->name('announcement.index');
    Route::get('/announcement/show', 'show')->name('announcement.show');
    Route::get('/announcement/create', 'create')->name('announcement.create');
    Route::post('/announcement/store', 'store')->name('announcement.store');
    Route::get('/announcement/edit/{announcement}', 'edit')->name('announcement.edit');
    Route::put('/announcement/update/{announcement}', 'update')->name('announcement.update');
    Route::delete('/announcement/destroy/{announcement}', 'destroy')->name('announcement.destroy');
});



Route::post('/locale/{locale}', function ($locale) {
    if (in_array($locale, ['en', 'it', 'fr'])) {
        session()->put('locale', $locale);
    }

    return redirect()->back()->with([
            'status' => 'success',
            'title' => '',
            'message' => 'locale.change'
        ]);
})->name('locale.switch');

require __DIR__ . '/auth.php';
