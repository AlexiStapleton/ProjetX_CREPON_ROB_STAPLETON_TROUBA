<?php



use App\Http\Controllers\PostController;
use App\Http\Controllers\CompteController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get("/compte/{id}", [CompteController::class, 'compte'])->name('compte.show');
Route::get("/feed/{id}", [CompteController::class, 'feed'])->name('feed.show');

Route::get("/post/{id}", [PostController::class, 'post'])->name('post.show');

Route::get("/posts", [PostController::class, 'posts'])->name('post.showall');

