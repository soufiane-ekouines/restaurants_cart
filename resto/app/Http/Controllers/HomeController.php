<?php

namespace App\Http\Controllers;

use App\Models\B;
use App\Models\Cart;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function home()
    {
        $totalday = B::totaltoday();

        $todayproduct = B::join('products','b_s.product_id','=','products.id')
                        ->where('products.user_id',Auth()->user()->id)
                        ->whereDate('b_s.created_at', Carbon::today()->toDateString())
                        ->sum(DB::raw("b_s.qte"));

        $totalmonth = B::totalmonth();

        $monthproduct =  B::join('products','b_s.product_id','=','products.id')
                        ->where('products.user_id',Auth()->user()->id)
                        ->whereMonth('b_s.created_at',date('m'))
                        ->whereYear('b_s.created_at',date('20y'))
                        ->sum(DB::raw("b_s.qte"));

        // select your prudatc out of stock if you are developer you can see all product
        if(Auth()->user()->role->role->designation == 'Developer')
        {
        $products = Product::where('qte',0)
                    ->with(['cat','user'])
                    ->get();
        }else
        {
        $products = Product::where('qte',0)
                    ->where('user_id',Auth()
                    ->user()->id)
                    ->with(['cat','user'])
                    ->get();
        }

        //you can see your cart information
        $cart = Cart::where('user_id',Auth()
                ->user()->id)
                ->first();

        // you can see the employers and how much mony get
        $employer = Product::select(DB::raw("b_s.user_id"),DB::raw("sum(products.prix*b_s.qte) as total"),DB::raw("sum(b_s.qte) as qteb"))
        ->join('b_s','b_s.product_id','=','products.id')
        ->where('products.user_id',Auth()->user()->id)
        ->whereMonth('b_s.created_at',date('m'))
        ->whereYear('b_s.created_at',date('20y'))
        ->groupby(DB::raw("b_s.user_id"))
        ->get();

        //B_s in th day
        $day = Product::select(DB::raw("b_s.created_at as day,products.designation,(products.prix*b_s.qte) as total"))->join('b_s','b_s.product_id','=','products.id')
        ->where('products.user_id',Auth()->user()->id)
        ->whereDate('b_s.created_at', Carbon::today()->toDateString())
        ->groupby(DB::raw("b_s.created_at,products.designation,products.prix*b_s.qte"))
        ->orderBy('b_s.created_at', 'ASC')
        ->take(7)
        ->get();

        // dd($employer);
        return view('dashboard',compact('day','employer','totalday','todayproduct','totalmonth','monthproduct','products','cart'));
    }
}
