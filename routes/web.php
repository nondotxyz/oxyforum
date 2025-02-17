<?php

use App\Http\Controllers\GroupController;
use App\Http\Controllers\OauthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TopicController;
use App\Http\Middleware\Authorization;
use App\Models\Group;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return inertia("Welcome");
});

Route::middleware('auth')->group(function () {
    Route::get('/group', [GroupController::class, 'index'])->name('group');
    Route::get('/group/create', [GroupController::class, 'create'])->name('group.create');
    Route::post('/group/store', [GroupController::class, 'store'])->name('group.store');
    Route::get('/group/{group}/topic', [TopicController::class, 'index'])->name('topic');
    Route::get('/group/{group}/topic/create', [TopicController::class, 'create'])->name('topic.create');
    Route::post('/group/{group}/topic/store', [TopicController::class, 'store'])->name('topic.store');
    Route::get('/group/{group}/topic/{topic}/post', [PostController::class, 'index'])->name('post');
    Route::get('/group/{group}/topic/{topic}/post/reply', [PostController::class, 'reply'])->name('post.reply');
    Route::post('/group/{group}/topic/{topic}/post/store', [PostController::class, 'store'])->name('post.store');

    Route::get('/profile', function () {
        return inertia("Profile/Index");
    })->name('profile');
});


Route::get('/oauth/google/', [OauthController::class, 'index']);
Route::get('/oauth/google/callback', [OauthController::class, 'callback']);
