<?php

namespace App\Http\Controllers;

use App\Http\Requests\CatRequest;
use App\Models\Cat;
use App\Models\Product;
use Illuminate\Http\Request;

class CatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth()->user()->role->role == 'Developer')
        {
            $category = Cat::with('Products')->get();
            $NmProdict = Product::count();
        }else{
            $category = Cat::where('user_id',Auth()->user()->id)->with('Products')->get();
            $NmProdict = Product::where('user_id',Auth()->user()->id)->count();
        }

        return view('tables',compact('category','NmProdict'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('category.create-cat');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CatRequest $request)
    {
        Cat::create($request->validated());
        return redirect()->route('category.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cat  $cat
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cat  $cat
     * @return \Illuminate\Http\Response
     */
    public function edit_cat($id)
    {
        $cat = Cat::findOrfail($id);
        if(Auth()->user()->role->role == 'Developer' || $cat->user_id == Auth()->user()->id)
        {
            return view('category.edit-cat',compact('cat'));
        }else
        return 404;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cat  $cat
     * @return \Illuminate\Http\Response
     */
    public function update(CatRequest $request, $id)
    {
        Cat::findOrfail($id)->update($request->validated());
        return redirect()->route('category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cat  $cat
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Cat::findOrfail($id)->delete();
        return redirect()->route('category.index');
    }
}
