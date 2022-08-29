<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Role_user;
use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function create()
    {
        return view('session.register');
    }

    public function store()
    {
        $attributes = request()->validate([
            'name' => ['required', 'max:50'],
            'Phone' => ['required', 'max:50'],
            'Adresse' => ['required', 'max:50'],
            'desc' => ['required', 'max:50'],
            'email' => ['required', 'email', 'max:50', Rule::unique('users', 'email')],
            'password' => ['required', 'min:5', 'max:20'],
            'agreement' => ['accepted']
        ]);
        
        $attributes['password'] = bcrypt($attributes['password'] );
        session()->flash('success', 'Your account has been created.');
        $user = User::create($attributes);
        Role_user::create([
            'role_id'=>Role::where('designation','Developer')->first()->id,
            'user_id'=>$user->id
        ]);
        Auth::login($user);
        return redirect('/dashboard');
    }
}
