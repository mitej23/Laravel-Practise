<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AdminController;

Route::get('/', [LoginController::class,'home'])->name('home');

Route::get('/library', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/logout',[LogoutController::class,'store'])->name('logout');
Route::post('/logout',[LogoutController::class,'store'])->name('logout');

Route::get('/login',[LoginController::class,'index'])->name('login');
Route::post("/login",[LoginController::class,"store"]);

Route::get('/register',[RegisterController::class,'index'])->name('register');
Route::post("/register",[RegisterController::class,"store"]);


Route::get('/posts',[PostController::class,'index'])->name('posts');
Route::post('/posts',[PostController::class,'store']);

//create route for get donwload file with params as path
Route::get('/download/{name}',[DashboardController::class,'download'])->name('download');

Route::get('/admin',[AdminController::class,'index'])->name('admin');
Route::post('/admin',[AdminController::class,'chatbox'])->name('admin');

Route::get('/admin/users',[AdminController::class,'users'])->name('admin.users');

Route::post('/admin/users',[AdminController::class,'addUsersUsingFile'])->name('admin.users.importUsingFile');
Route::post('/admin/users/add',[AdminController::class,'addUser'])->name('admin.users.add');
Route::get('/admin/users/delete/{id}',[AdminController::class,'deleteUser'])->name('admin.users.delete');
Route::put('/admin/users/{id}',[AdminController::class,'updateUser'])->name('admin.users.update');

Route::get('/admin/qna',[AdminController::class,'qna'])->name('admin.qna');
Route::get('/admin/books',[AdminController::class,'books'])->name('admin.books');

Route::post('/admin/qna/update',[AdminController::class,'updateQuestion'])->name('admin.qna.update');
Route::get('/admin/qna/delete/{id}',[AdminController::class,'deleteQuestion'])->name('admin.qna.delete');
Route::post('/admin/qna/add',[AdminController::class,'addQuestion'])->name('admin.qna.add');
Route::post('/admin/qna/import',[AdminController::class,'addQuestionUsingFile'])->name('admin.qna.import');

Route::get('/approve/{id}',[AdminController::class,'approve'])->name('admin.approve');
Route::get('/delete/{id}',[AdminController::class,'delete'])->name('admin.delete');


