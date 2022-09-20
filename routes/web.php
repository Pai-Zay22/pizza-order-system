<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AuthenicationController;

//login register

Route::redirect('/', 'loginPage');
Route::get('loginPage',[AuthenicationController::class,'loginPage'])->name('auth#loginPage');
Route::get('registerPage',[AuthenicationController::class,'registerPage'])->name('auth#registerPage');

//admin

Route::group(['prefix' => 'category'],function(){
    Route::get('list',[CategoryController::class,'list'])->name('category#list');
});



Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});


