<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\View;

class InfoUserController extends Controller
{

    public function create()
    {
        return view('laravel-examples/user-profile');
    }

    public function store(Request $request)
    {

        $attributes = request()->validate([
            'name' => ['required', 'max:50'],
            'Phone' => ['required', 'max:50'],
            'Adresse' => ['required', 'max:50'],
            'desc' => ['required', 'max:50'],
            'password' => ['nullable', 'min:5', 'max:20'],
            // 'agreement' => ['accepted'],
            'email' => ['required', 'email', 'max:50', Rule::unique('users')->ignore(Auth::user()->id)],
        ]);

        if($attributes['password']==null)
            $attributes['password'] = Auth()->user()->password;

        if($request->get('email') != Auth::user()->email)
        {
            if(env('IS_DEMO') && Auth::user()->id == 1)
            {
                return redirect()->back()->withErrors(['msg2' => 'You are in a demo version, you can\'t change the email address.']);

            }

        }
        else{
            $attribute = request()->validate([
                'email' => ['required', 'email', 'max:50', Rule::unique('users')->ignore(Auth::user()->id)],
            ]);
        }


        User::where('id',Auth::user()->id)
        ->update(
            $attributes
        );


        return redirect('/user-profile')->with('success','Profile updated successfully');
    }
}