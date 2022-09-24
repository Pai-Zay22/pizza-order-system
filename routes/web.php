<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AuthenicationController;

//login register

Route::redirect('/', 'loginPage');
Route::get('loginPage',[AuthenicationController::class,'loginPage'])->name('auth#loginPage');
Route::get('registerPage',[AuthenicationController::class,'registerPage'])->name('auth#registerPage');

Route::middleware(['auth'])->group(function () {
//dashboard
Route::get('/dashboard',[AuthenicationController::class,'dashboard'])->name('dashboard');

Route::middleware('admin_auth')->group(function(){
    //admin->category
    Route::prefix('category')->group(function(){
        Route::get('list',[CategoryController::class,'list'])->name('category#list');
        Route::get('create/page',[CategoryController::class,'createPage'])->name('category#createPage');
        Route::post('create',[CategoryController::class,'create'])->name('category#create');
        Route::get('delete/{id}',[CategoryController::class,'delete'])->name('category#delete');
        Route::get('edit/{id}',[CategoryController::class,'edit'])->name('category#edit');
        Route::post('update',[CategoryController::class,'update'])->name('category#update');
    });

    //admin->password
    Route::prefix('admin')->group(function(){
        Route::get('changePasswordPage',[AuthenicationController::class,'changePasswordPage'])->name('admin#changePasswordPage');
        Route::post('changePassword',[AuthenicationController::class,'changePassword'])->name('admin#changePassword');
    });
});


//user->home
Route::group(['prefix' => 'user', 'middleware' => 'user_auth'],function(){
    Route::get('home',[UserController::class,'home'])->name('user#home');
});
});


