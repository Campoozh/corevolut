<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{

    public function create(){

        return view('users.create');

    }

    public function store(Request $request){

            $user = new User;

            $userName = ucfirst($request->firstName)." ".ucfirst($request->lastName);

            $user->name = $userName;

            $user->email = $request->email;

            $password = $request->password;

            $confirmPassword = $request->confirmPassword;


            if($password == $confirmPassword){

                $hashedPassword = Hash::make($password);

                $user->password = $hashedPassword;

            } else {

                return redirect('/register')->with('msg', "The passwords don't match.");
            }
            
            $user->save();

            auth()->login($user);
            
            Session::push('user', [

                'name' => $userName,
                'email' => $request->email,

            ]);

            return redirect('/');

    }

    public function logout(){

        $user = Auth::user();

        auth()->logout($user);

        return redirect('/');

    }

}
