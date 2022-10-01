<?php

namespace App\Http\Controllers\User;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    //direct user home page
    public function homePage(){
        $product = Product::get();
        $category = Category::get();
        return view('user.main.home',compact('product','category'));
    }
}
