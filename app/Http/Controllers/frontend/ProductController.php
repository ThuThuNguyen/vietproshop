<?php

namespace App\Http\Controllers\frontend;
use App\Models\{Product,Category};
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    function GetDetail($slug){
        $data['prd']=Product::where("slug",$slug)->first();
        $data['prd_new']=Product::orderBy('id','desc')->take(4)->get();
        return view("frontend.product.detail",$data);
    }
    function GetShop(){
        $data['product']=Product::paginate(6);
        $data['category']=category::all();
        return view('frontend.product.shop',$data);
    }
}
