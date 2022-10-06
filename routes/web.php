<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AjaxController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\AuthenicationController;


Route::middleware('admin_auth')->group(function(){
    //login register
    Route::redirect('/', 'loginPage');
    Route::get('loginPage',[AuthenicationController::class,'loginPage'])->name('auth#loginPage');
    Route::get('registerPage',[AuthenicationController::class,'registerPage'])->name('auth#registerPage');
});

Route::middleware(['auth'])->group(function () {
//dashboard
Route::get('/dashboard',[AuthenicationController::class,'dashboard'])->name('dashboard');

Route::middleware('admin_auth')->group(function(){
    //admin->category
    Route::prefix('category')->group(function(){
        Route::get('list',[CategoryController::class,'list'])->name('category#list');
        Route::get('create/page',[CategoryController::class,'createPage'])->name('category#createPage');
        Route::post('create',[CategoryController::class,'create'])->name('category#create');
        Route::delete('delete/{id}',[CategoryController::class,'delete'])->name('category#delete');
        Route::get('edit/{id}',[CategoryController::class,'edit'])->name('category#edit');
        Route::post('update',[CategoryController::class,'update'])->name('category#update');
    });

    //admin->account
    Route::prefix('admin')->group(function(){
        //password
        Route::get('changePasswordPage',[AdminController::class,'changePasswordPage'])->name('admin#changePasswordPage');
        Route::post('changePassword',[AdminController::class,'changePassword'])->name('admin#changePassword');

        //account info
        Route::get('accountInfoPage',[AdminController::class,'accountInfoPage'])->name('admin#accountInfoPage');
        Route::get('accountEditPage',[AdminController::class,'accountEditPage'])->name('admin#accountEditPage');
        Route::post('accountUpdate/{id}',[AdminController::class,'accountUpdate'])->name('admin#accountUpdate');
        Route::get('listPage',[AdminController::class,'adminListPage'])->name('admin#listPage');
        Route::delete('delete/{id}',[AdminController::class,'adminListDelete'])->name('admin#listDelete');
        Route::get('roleChangePage/{id}',[AdminController::class,'roleChangePage'])->name('admin#roleChangePage');
        Route::post('roleChange/{id}',[AdminController::class,'roleChange'])->name('admin#roleChange');
    });

    //admin->product
    Route::prefix('product')->group(function(){
       Route::get('pizzaListPage',[ProductController::class,'pizzalistPage'])->name('product#pizzaListPage');
       Route::get('pizzaCreatePage',[ProductController::class,'pizzaCreatePage'])->name('product#pizzaCreatePage');
       Route::post('pizzaCreate',[ProductController::class,'pizzaCreate'])->name('product#pizzaCreate');
       Route::delete('delete/{id}',[ProductController::class,'pizzaDelete'])->name('product#pizzaDelete');
       Route::get('pizzaInfoPage/{id}',[ProductController::class,'pizzaInfo'])->name('product#pizzaInfoPage');
       Route::get('pizzaUpdatePage/{id}',[ProductController::class,'pizzaUpdatePage'])->name('product#pizzaUpdatePage');
       Route::post('pizzaUpdate/{id}',[ProductController::class,'pizzaUpdate'])->name('product#pizzaUpdate');
    });
});

//user

Route::middleware('user_auth')->group(function(){

    Route::prefix('user')->group(function(){
        //home page
        Route::get('homePage',[UserController::class,'homePage'])->name('user#homePage');
        Route::get('filter/{id}',[UserController::class,'filter'])->name('user#filter');

        //pizza
        Route::prefix('pizza')->group(function(){
            //pizza detail
            Route::get('detailPage/{id}',[UserController::class,'pizzaDetailPage'])->name('user#pizzaDetailPage');

        });

         //account
        Route::get('passwordChangePage/',[UserController::class,'passwordChangePage'])->name('user#pwChangePage');
        Route::post('passwordChange/',[UserController::class,'passwordChange'])->name('user#pwChange');
        Route::get('accountUpdatePage/',[UserController::class,'accountUpdatePage'])->name('user#accountUpdatePage');
        Route::post('accountUpdate/{id}',[UserController::class,'accountUpdate'])->name('user#accountUpdate');
    });

    //ajax
    Route::prefix('ajax')->group(function(){
        Route::get('product/list',[AjaxController::class,'productList'])->name('ajax#productList');
        Route::get('addToCart',[AjaxController::class,'addToCart'])->name('ajax#addToCart');
    });

});
});


