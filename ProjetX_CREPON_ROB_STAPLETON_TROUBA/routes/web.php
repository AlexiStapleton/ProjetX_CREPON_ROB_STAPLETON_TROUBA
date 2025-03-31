<?php



use App\Http\Controllers\PostController;
use App\Http\Controllers\CompteController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('connexion');
})->name('connexion');
Route::get("/compte/{id}", [CompteController::class, 'compte'])->name('compte.show');
Route::get("/feed/{id}", [CompteController::class, 'feed'])->name('feed.show');

Route::get("/post/{id}", [PostController::class, 'post'])->name('post.show');

Route::get("/posts", [PostController::class, 'posts'])->name('post.showall');

Route::post("/posts", [PostController::class, 'store'])->name('post.store')->middleware("auth");

