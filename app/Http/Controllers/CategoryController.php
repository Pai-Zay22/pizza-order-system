<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // admin category list
    public function list(){
        return view('admin.category.list');
    }
}
