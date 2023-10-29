<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrderController;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
})->name('dashboard');

Route::get('/posts', [OrderController::class,'index'])->name('posts.index');
Route::get('/post-edit/{post}',[OrderController::class,'edit'])->name('post.edit');
Route::get('/posts/create-post',[OrderController::class,'create'])->name('create-post');
Route::post('/posts/store-post',[OrderController::class,'store'])->name('store.post');
Route::get('/delete-post/{id}',[OrderController::class,'delete'])->name('delete.post');
Route::get('/posts/edit/{post}',[OrderController::class,'edit'])->name('edit.post');
Route::post('/posts/update-post',[OrderController::class,'update'])->name('update.post');


Route::prefix('users')->group(function(Router $route){
    $route->get('/',[OrderController::class,'index'])->name('admin.users.index');
    $route->get('/create',[OrderController::class,'create'])->name('admin.user.create');
    $route->post('/store',[OrderController::class,'store'])->name('admin.user.store');
    $route->get('/edit/{user}',[OrderController::class,'edit'])->name('admin.user.edit');
    $route->post('/update',[OrderController::class,'update'])->name('admin.user.update');
    $route->get('/delete/{user}',[OrderController::class,'delete'])->name('admin.user.delete');
});

Route::get('/login' , [AuthController::class,'getLoginPage'])->name('get-login-page');
Route::post('/login' , [AuthController::class,'login'])->name('login');
