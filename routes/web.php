<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TweetController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\ReplyController;
use App\Http\Controllers\ProfileController;

Route::get('/', [TweetController::class, 'index'])->name('tweets.index');



Route::middleware('auth')->group(function () {
    // Tweets
    Route::post('/tweets', [TweetController::class, 'store'])->name('tweets.store');
    Route::delete('/tweets/{tweet}', [TweetController::class, 'destroy'])->name('tweets.destroy');

    Route::post('/tweets/{tweet}/like', [LikeController::class, 'store'])->name('likes.store');
    Route::delete('/tweets/{tweet}/like', [LikeController::class, 'destroy'])->name('likes.destroy');

    Route::post('/tweets/{tweet}/replies', [ReplyController::class, 'store'])->name('replies.store');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/@{user:username}', [\App\Http\Controllers\ProfileController::class, 'show'])
        ->name('profile.show');
});
Route::get('/@{user:username}', [\App\Http\Controllers\ProfileController::class, 'show'])
    ->name('profile.show');
Route::get('/@{username}', [ProfileController::class, 'show'])->name('profile.show');

require __DIR__ . '/auth.php';
