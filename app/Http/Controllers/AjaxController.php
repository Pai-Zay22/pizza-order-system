<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    //sorting product list
    public function productList(REQUEST $req){
        if($req->status == 'asc'){
            $data = Product::orderBy('id','asc')->get();
        }else{
            $data = Product::orderBy('id','desc')->get();
        }
        return $data;
    }

    //add to cart
    public function addToCart(REQUEST $req){
        $orderData = $this->requestOrderData($req);
        Cart::create($orderData);
        $response = [
            'status' =>  'success',
        ];
        return response()->json($response, 200);
    }

    //request order data
    private function requestOrderData(REQUEST $req){
        return [
            'user_id' => $req->userId,
            'product_id' => $req->productId,
            'quantity' => $req->quantity,
        ];

    }

}
