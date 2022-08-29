<?php

namespace App\Http\Controllers;

use App\Http\Requests\CartRequest;
use App\Models\B;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cart = Cart::where('user_id',Auth()->user()->id)->first();
        // dd();

        if($cart)
            {
                $month = Product::select(DB::raw("month(b_s.created_at) as month , year(b_s.created_at) as year"),DB::raw("sum(products.prix*b_s.qte) as total"),DB::raw("sum(b_s.qte) as qteb"))
                ->join('b_s','b_s.product_id','=','products.id')
                ->where('b_s.user_id',Auth()->user()->id)
                ->groupby(DB::raw("month(b_s.created_at),year(b_s.created_at)"))
                ->get();

                $day = Product::select(DB::raw("b_s.created_at as day,products.designation,(products.prix*b_s.qte) as total"))->join('b_s','b_s.product_id','=','products.id')
                ->where('b_s.user_id',Auth()->user()->id)
                ->where('b_s.created_at',today())
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function create()
    // {
    //     //
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CartRequest $request)
    {
        Cart::create($request->validated());
        return redirect()->route('card.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    // public function show($id)
    // {
    //     //
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    // public function edit($id)
    // {
    //     //
    // }

    public function edit_cart()
    {
        $cart = Cart::where('user_id',Auth()->user()->id)->first();
        return view('cart.edit-cart',compact('cart'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function update(CartRequest $request, $id)
    {
        Cart::findOrfail($id)->update($request->validated());
        return redirect()->route('card.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    // public function destroy($id)
    // {
    //     Cart::findOrfail($id)->delete();
    //     return redirect()->route('card.index');
    // }
}
