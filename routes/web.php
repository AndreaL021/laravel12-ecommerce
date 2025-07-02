<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\ProfileController;

Route::controller(PublicController::class)->group(function () {
    Route::get('/', 'index')->name('home');
    Route::get('/search', 'search')->name('search');
});


Route::middleware('auth')->controller(ProfileController::class)->group(function () {
    Route::get('/profile', 'edit')->name('profile.edit');
    Route::patch('/profile', 'update')->name('profile.update');
    Route::delete('/profile', 'destroy')->name('profile.destroy');
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
