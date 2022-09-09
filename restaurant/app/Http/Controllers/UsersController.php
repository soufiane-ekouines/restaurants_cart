<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\Product;
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
        $roles = Role::get();
        return view('laravel-examples.create-user',compact('roles'));
        // $user = user::findOrFail(1);
        // return view('compts.update-user',compact('user'));

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
        $attributes['user_id'] = Auth()->user()->id;
        $user = User::create($attributes);
        if(Auth()->user()->role->role->designation == 'Developer')
        {
            $role_id = $request['role_id'];
        }else
            $role_id = Role::where('designation','Employer')->first()->id;
        Role_user::create([
            'role_id'=>$role_id,
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
    // public function show(user $user)
    // {
    //    dd('k');
    // }



    public function edit_user($id)
    {
        $user = user::findOrFail($id);
        $Login = Auth()->user();
        if($Login->role->role->designation=='Developer' ||  $user->user_id == $Login->id)
        {
            return view('compts.update-user',compact('user'));
        }else
        {
            return  404;
        }
    }

    public function profile()
    {
        $products = Product::where('user_id',Auth()->user()->id)->limit(3)->get();
        $Message = Message::where('userGet_id',Auth()->user()->id)->where('read_',false)->limit(5)->get();
        return view('profile',compact('products','Message'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\user  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $attributes = $request->validate([
            'name' => ['required', 'max:50'],
            'Phone' => ['required', 'max:50'],
            'Adresse' => ['required', 'max:50'],
            'desc' => ['required', 'max:50'],
            'email' => ['required', 'email', 'max:50'],
            'password' => ['nullable', 'min:5', 'max:20'],
            'agreement' => ['accepted']
        ]);

        $user = user::findOrFail($id);
        if($attributes['password']==null)
        $attributes['password']=$user->password;
       $user->update($attributes);
        return redirect()->route('user.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\user  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       User::findOrFail($id)->delete();
        // session()->flash('success', 'the account has been deleted.');
       return redirect()->route('user-management');
    }
}
