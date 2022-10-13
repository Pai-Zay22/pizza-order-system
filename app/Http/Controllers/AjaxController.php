<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Models\OrderList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    //order list
    public function orderList(REQUEST $req){
        foreach($req->all() as $item ){
           OrderList::create([
            'user_id' => $item['user_id'],
            'product_id' => $item['product_id'],
            'quantity' => $item['quantity'],
            'total_price' => $item['total_price'],
            'order_code' => $item['order_code'],
           ]);
        };
        Cart::where('user_id',Auth::user()->id)->delete();
        $response = [
            'status' => 'success',
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
