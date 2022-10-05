<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    public function productList(REQUEST $req){
        if($req->status == 'asc'){
            $data = Product::orderBy('id','asc')->get();
        }else{
            $data = Product::orderBy('id','desc')->get();
        }
        return $data;

    }

}
