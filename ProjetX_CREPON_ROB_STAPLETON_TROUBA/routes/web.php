<?php




use App\Http\Controllers\CompteController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get("/compte/{id}", [CompteController::class, 'compte'])->name('compte.show');
