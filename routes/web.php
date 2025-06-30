<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return view('welcome');
})->name('home');

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');




Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
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
