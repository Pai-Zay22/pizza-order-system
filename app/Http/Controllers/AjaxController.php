<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
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
        $total = 0;
        foreach($req->all() as $item ){
           $data = OrderList::create([
            'user_id' => $item['user_id'],
            'product_id' => $item['product_id'],
            'quantity' => $item['quantity'],
            'total_price' => $item['total_price'],
            'order_code' => $item['order_code'],
           ]);
           $total += $data->total_price;

        };
        $total = $total + 3000;
        Cart::where('user_id',Auth::user()->id)->delete();
        Order::create([
            'user_id' => Auth::user()->id,
            'total_price' => $total,
            'order_code' => $data->order_code,
        ]);
        $response = [
            'status' => 'success',
        ];
        return response()->json($response, 200);
    }

    //cart remove
    public function cartRemove(){
        Cart::where('user_id',Auth::user()->id)->delete();
        $response = [
            'status' => 'success',
        ];
        return response()->json($response, 200);
    }

    //cart item remove
    public function cartItemRemove(REQUEST $req){
        Cart::where('user_id',Auth::user()->id)
            ->where('product_id',$req->productId)
            ->where('id',$req->orderId)->delete();
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
