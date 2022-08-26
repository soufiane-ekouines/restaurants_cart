<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Role_user;
use App\Models\user;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth()->user()->role->role->designation == 'Developer')
        {
            $users = user::with([
                'role.role'
            ])->get();
        }else{
            $users = user::where('user_id',Auth()->user()->id)->with([
                'role.role'
            ])->get();
        }

        return view('laravel-examples.user-management',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // return view('laravel-examples.create-user');
        $user = user::find(1);
        return view('compts.update-user',compact('user'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $attributes =$request->validate([
            'name' => ['required', 'max:50'],
            'Phone' => ['required', 'max:50'],
            'Adresse' => ['required', 'max:50'],
            'desc' => ['required'],
            'user_id' =>['nullable'],
            'email' => ['required', 'email', 'max:50', Rule::unique('users', 'email')],
            'password' => ['required', 'min:5', 'max:20'],
            'agreement' => ['accepted']
        ]);
        $attributes['password'] = bcrypt($attributes['password'] );
        $attributes['user_id'] =Auth()->user()->id;

        // session()->flash('success', 'Your account has been created.');
        $user = User::create($attributes);
        Role_user::create([
            'role_id'=>Role::where('designation','Employer')->first()->id,
            'user_id'=>$user->id
        ]);
        return redirect()->route('user-management');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\user  $user
     * @return \Illuminate\Http\Response
     */
    public function show(user $user)
    {
       dd('k');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\user  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = user::find($id);
        return view('compts.update-user',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\user  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, user $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\user  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       User::find($id)->delete();
        // session()->flash('success', 'the account has been deleted.');
       return redirect()->route('user-management');
    }
}
