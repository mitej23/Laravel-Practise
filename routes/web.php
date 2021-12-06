<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PostController;

Route::get('/', function () {
    return "home";
})->name('home');

Route::get('/library', [DashboardController::class, 'index'])->name('dashboard');

Route::post('/logout',[LogoutController::class,'store'])->name('logout');

Route::get('/login',[LoginController::class,'index'])->name('login');
Route::post("/login",[LoginController::class,"store"]);

Route::get('/register',[RegisterController::class,'index'])->name('register');
Route::post("/register",[RegisterController::class,"store"]);


Route::get('/posts',[PostController::class,'index'])->name('posts');
Route::post('/posts',[PostController::class,'store']);

//create route for get donwload file with params as path
Route::get('/download/{name}',[DashboardController::class,'download'])->name('download');