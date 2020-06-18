<?php

namespace App\Http\Controllers\backend;
use App\Models\Order;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    function GetOrder(){
        $data['orders']=Order::where('state',2)->orderby('id','desc')->paginate(3);
        return view("backend.order.order",$data);
    }
    function GetProcessed(){
        $data['orders']=Order::where('state',1)->orderby('updated_at','desc')->paginate(3);
        return view("backend.order.processed",$data);
    }
    function GetDetailOrder($order_id){
        $data['order']=Order::find($order_id);
        return view("backend.order.detailorder",$data);
    }
    function paid($order_id)
    {
        $order=Order::find($order_id);
        $order->state=1;
        $order->save();
        return redirect('admin/order/processed');
    }
}
