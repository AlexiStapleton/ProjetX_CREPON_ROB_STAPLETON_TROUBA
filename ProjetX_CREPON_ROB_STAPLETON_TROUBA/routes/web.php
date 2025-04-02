<?php


use App\Http\Controllers\ConnexionController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CompteController;
use App\Http\Controllers\RTController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AimeController;
use App\Http\Controllers\GrokController;

Route::get('/', function () {
    return view('connexion');
})->name('connexion');
Route::get("/compte/{id}", [CompteController::class, 'compte'])->name('compte.show');
Route::get("/feed", [CompteController::class, 'feed'])->name('feed.show');
Route::get('/explore/{id}', [CompteController::class, 'explore'])->name('explore');

// Route::get("/post/{id}", [PostController::class, 'post'])->name('post.show');

// Route::get("/posts", [PostController::class, 'posts'])->name('post.showall');

Route::post("/posts", [PostController::class, 'store'])->name('posts.store');

Route::post("/rt/toggle", [RTController::class, 'toggle'])->name('rt.toggle');
Route::post("/like/toggle", [AimeController::class, 'toggle'])->name('like.toggle');

//Route::get("/connexion", 'ConnexionController@formulaire');
Route::post("/connexion", [ConnexionController::class, 'traitement'])->name('connexion.traitement');

Route::post("/signup", [ConnexionController::class, 'signup'])->name('signup');

Route::get('/grok', [GrokController::class, 'index'])->name('grok');
Route::post('/grok', [GrokController::class, 'ask']);

//Route d'un post
Route::get('/post/{id}', [CompteController::class, 'post'])->name('post');
