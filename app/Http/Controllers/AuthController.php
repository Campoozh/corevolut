<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

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

            $user->password = $request->password;

            $user->save();

            return redirect('/');

    }

}
