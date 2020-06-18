<?php

namespace App\Http\Controllers\backend;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\carbon;
use App\models\Order;
class IndexController extends Controller
{
    function Index(){
        $month_now=carbon::now()->format('m');
        $year_now=carbon::now()->format('Y');
        for ($i=1; $i <= $month_now; $i++) { 
            $dl['Tháng '.$i]=order::where('state',1)->whereMonth('updated_at',$i)->whereYear('updated_at',$year_now)->sum('total');
        }
        $data['dl']=$dl;
        $data['so_dh']=order::where('state',2)->count();
        return view("backend.index",$data);
    }
    function Logout(){
        
        Auth::logout();
        
        return redirect('login');
        
    }
}
