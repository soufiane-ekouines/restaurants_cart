<?php

namespace App\Http\Controllers;

use App\Http\Requests\CartRequest;
use App\Models\B;
use App\Models\Cart;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;

class CartController extends Controller
{

    public function index()
    {
        $cart = Cart::where('user_id',Auth()->user()->id)->first();

        if($cart)
            {
                $month = Product::select(DB::raw("DATE_FORMAT(b_s.created_at, '%Y-%m') as pdate"),DB::raw("sum(products.prix*b_s.qte) as total"),DB::raw("sum(b_s.qte) as qteb"))
                ->join('b_s','b_s.product_id','=','products.id')
                ->where('products.user_id',Auth()->user()->id)
                ->groupby('pdate')
                ->get();

                $day = Product::select(DB::raw("b_s.created_at as day,products.designation,(products.prix*b_s.qte) as total"))->join('b_s','b_s.product_id','=','products.id')
                ->where('products.user_id',Auth()->user()->id)
                ->whereDate('b_s.created_at', Carbon::today()->toDateString())
                ->groupby(DB::raw("b_s.created_at,products.designation,products.prix*b_s.qte"))
                ->get();
            //    dd($day);
                $B=B::totaltoday();
                $M=B::totalmonth();
                return view('billing',compact('cart','B','M','day','month'));
            }
        else
            return view('cart.create-cart');
    }


    public function store(CartRequest $request)
    {
        Cart::create($request->validated());
        return redirect()->route('card.index');
    }




    public function edit_cart()
    {
        $cart = Cart::where('user_id',Auth()->user()->id)->first();
        return view('cart.edit-cart',compact('cart'));
    }


    public function update(CartRequest $request, $id)
    {
        Cart::findOrfail($id)->update($request->validated());
        return redirect()->route('card.index');
    }

    // public function destroy($id)
    // {
    //     Cart::findOrfail($id)->delete();
    //     return redirect()->route('card.index');
    // }

    public function productm()
    {

        $month = Product::select(DB::raw("DATE_FORMAT(b_s.created_at, '%Y-%m') as pdate"),DB::raw("sum(products.prix*b_s.qte) as total"),DB::raw("sum(b_s.qte) as qteb"))
        ->join('b_s','b_s.product_id','=','products.id')
        ->where('products.user_id',Auth()->user()->id)
        ->groupby('pdate')
        ->get();

        return view('product.productb',compact('month'));
    }

    public function productmy($month)
    {
        set_time_limit(300);
        $products = Product::select(DB::raw("DATE_FORMAT(b_s.created_at, '%Y-%m') AS b_date,designation"),DB::raw('sum(products.prix*b_s.qte) as total ,  sum(b_s.qte) as number'))
            ->join('b_s','b_s.product_id','=','products.id')
            ->where('products.user_id',Auth()->id())
            ->where(DB::raw("DATE_FORMAT(b_s.created_at, '%Y-%m')"),$month)
            ->groupby("designation","b_date")
            ->get();

            $data = [
                'products' => $products,
                'month' => $month
            ];
            $date = now();
            $pdf = PDF::loadView('product.pdfproductm', $data);
            return $pdf->download('sales_in'.$month.'_today'.$date.'.pdf');
        // return view('product.pdfproductm',compact('products','month'));
    }
}
