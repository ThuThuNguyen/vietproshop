<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Product,Category};

class IndexController extends Controller
{
    function Index(){
        $data['prd_new']=Product::orderBy('id','desc')->take(8)->get();
        $data['prd_nb']=Product::where('featured',1)->take(4)->get();
        return view('frontend.index',$data);
        
    }
    function GetAbout(){
        return view("frontend.about");
    }


    function GetContact(){
        return view("frontend.contact");
    }
    function GetPrdCate($slug_cate){
        $data['product']=Category::where('slug',$slug_cate)->first()->prd()->paginate(6);
       $data['category']=Category::all();
       return view('frontend.product.shop',$data);
    }
    function GetFilter(request $r){
        $data['product']=Product::whereBetween('price',[$r->start,$r->end])->paginate(6);
        $data['category']=Category::all();
        return view('frontend.product.shop',$data);
    }
}
