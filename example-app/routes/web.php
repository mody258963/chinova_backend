<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OtpController;
use App\Http\Controllers\SocialiteController;
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
});

Route::get('/dashboard', function () {
    return view('layout.dashboard');
    })->name('dashboard');

    Route::prefix('users')->group(function(Router $route) {
    $route->get('/posts', [OrderController::class,'index'])->name('posts.index');
    $route->get('/post-edit/{post}',[OrderController::class,'edit'])->name('post.edit');
    $route->get('/posts/create-post',[OrderController::class,'create'])->name('create-post');
    $route->post('/posts/store-post',[OrderController::class,'store'])->name('store.post');
    $route->get('/delete-post/{id}',[OrderController::class,'delete'])->name('delete.post');
    $route->get('/posts/edit/{post}',[OrderController::class,'edit'])->name('edit.post');
    $route->post('/posts/update-post',[OrderController::class,'update'])->name('update.post');
    });

// Route::prefix('users')->group(function(Router $route) {

//     $route->get('/', [OrderController::class,'index'])->name('admin.users.index');
//     $route->get('/create', [OrderController::class,'create'])->name('admin.user.create');
//     $route->post('/store', [OrderController::class,'store'])->name('admin.user.store');
//     $route->get('/edit/{user}', [OrderController::class,'edit'])->name('admin.user.edit');
//     $route->post('/update', [OrderController::class,'update'])->name('admin.user.update');
//     $route->get('/delete/{user}', [OrderController::class,'delete'])->name('admin.user.delete');
// });



Route::post('/login' , [AuthController::class,'login'])->name('login');
Route::get('/signup' , [AuthController::class,'regsterPage'])->name('SignUpPage');
Route::post('/signupuser' , [AuthController::class,'storeUser'])->name('StoreUser');
Route::get('/loginPage' , [AuthController::class,'getLoginPage'])->name('loginPages');

// Route::controller(AuthController::class)->middleware(['auth', 'admin'])->prefix('admin')->group(function () {
//     Route::get('/login', 'login')->name('login');
//     Route::get('/signup', 'regsterPage')->name('signUpPage');
//     Route::post('/users/add', 'regester')->name('signUp');
//     Route::get('/users/edit/{id}', 'EditUser')->name('EditUser');
//     Route::post('/users/update/{id}', 'UpdateUser')->name('UpdateUser');
//     Route::post('/users/delete/{id}', 'DeleteUser')->name('DeleteUser');
// });

Route::get('/auth/google', [SocialiteController::class,'redirectToGoogle'])->name('google.uri');
Route::get('/auth/google/callback', [SocialiteController::class,'handleGoogleCallback'])->name('google.handel');

Route::post('/genrateOtp', [OtpController::class,'OtpRequst'])->name('ganerate.Otp');
Route::post('/veriyOtp', [OtpController::class,'Otp'])->name('verify.Otp');
Route::get('/OtpPage', [OtpController::class,'OPTPage'])->name('OPT.page');
Route::get('/OtpVerifyPage', [OtpController::class,'OPTverifyPage'])->name('OPT.verify.page');