<?php

use App\Http\Controllers\OrderController;
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
    return view('dashboard.index');
})->name('dashboard');

Route::get('/posts', [OrderController::class,'index'])->name('posts.index');
Route::get('/post-edit/{post}',[OrderController::class,'edit'])->name('post.edit');
Route::get('/posts/create-post',[OrderController::class,'create'])->name('create-post');
Route::post('/posts/store-post',[OrderController::class,'store'])->name('store.post');
Route::get('/delete-post/{id}',[OrderController::class,'delete'])->name('delete.post');
Route::get('/posts/edit/{post}',[OrderController::class,'edit'])->name('edit.post');
Route::post('/posts/update-post',[OrderController::class,'update'])->name('update.post');
