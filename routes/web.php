<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AuthenicationController;

//login register

Route::redirect('/', 'loginPage');
Route::get('loginPage',[AuthenicationController::class,'loginPage'])->name('auth#loginPage');
Route::get('registerPage',[AuthenicationController::class,'registerPage'])->name('auth#registerPage');

Route::middleware(['auth:sanctum',config('jetstream.auth_session'),'verified'])->group(function () {
//dashboard
Route::get('/dashboard',[AuthenicationController::class,'dashboard'])->name('dashboard');

//admin->category
Route::group(['prefix' => 'category','middleware' => 'admin_auth'],function(){
    Route::get('list',[CategoryController::class,'list'])->name('category#list');
    Route::get('create/page',[CategoryController::class,'createPage'])->name('category#createPage');
    Route::post('create',[CategoryController::class,'create'])->name('category#create');
    Route::get('delete/{id}',[CategoryController::class,'delete'])->name('category#delete');
    Route::get('edit/{id}',[CategoryController::class,'edit'])->name('category#edit');
    Route::post('update',[CategoryController::class,'update'])->name('category#update');
});

//user->home
Route::group(['prefix' => 'user', 'middleware' => 'user_auth'],function(){
    Route::get('home',[UserController::class,'home'])->name('user#home');
});
});


