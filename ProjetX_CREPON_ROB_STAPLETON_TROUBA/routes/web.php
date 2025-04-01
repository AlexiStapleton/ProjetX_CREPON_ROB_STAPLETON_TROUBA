<?php


use App\Http\Controllers\ConnexionController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CompteController;
use App\Http\Controllers\RTController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('connexion');
})->name('connexion');
Route::get("/compte/{id}", [CompteController::class, 'compte'])->name('compte.show');
Route::get("/feed/{id}", [CompteController::class, 'feed'])->name('feed.show');

Route::get("/post/{id}", [PostController::class, 'post'])->name('post.show');

Route::get("/posts", [PostController::class, 'posts'])->name('post.showall');

Route::post("/posts", [PostController::class, 'store'])->name('posts.store');

Route::post("/rt/toggle", [RTController::class, 'toggleRt'])->name('rt.toggle');

//Route::get("/connexion", 'ConnexionController@formulaire');
Route::post("/connexion", [ConnexionController::class, 'traitement'])->name('connexion.traitement');

Route::post("/signup", [ConnexionController::class, 'signup'])->name('signup');
