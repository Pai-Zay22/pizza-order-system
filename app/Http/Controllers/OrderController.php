<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    //direct order list Page
    public function listPage(){
        $order = Order::select('orders.*','users.name as user_name')
                ->when(request('key'),function($query){
                    $query->orwhere('users.name','like','%'.request('key').'%')
                        ->orwhere('orders.order_code','like','%'.request('key').'%')
                        ->orwhere('orders.total_price','like','%'.request('key').'%');
                })
                ->leftJoin('users','orders.user_id','users.id')
                ->orderBy('id','desc')
                ->get();
        return view('admin.order.list',compact('order'));
    }

    //change main status
    public function changeMainStatus(REQUEST $req){
        $order = Order::select('orders.*','users.name as user_name')
                ->leftJoin('users','orders.user_id','users.id')
                ->orderBy('created_at','desc');
        if($req->status == null){
            $order = $order->get();
        }else{
            $order = $order->where('orders.status',$req->status)->get();
        }
        return view('admin.order.list',compact('order'));
    }

    //ajax change status
    public function ajaxChangeStatus(REQUEST $req){
        $changeStatus = Order::where('id',$req->orderId)
                        ->update([
                            'status' => $req->status,
                        ]);
    }
}
