<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{

    public function create(){

        $user = Auth::user();

        if ($user){

            return redirect('/');
            
        }

        $registerPage = true;

        return view('users.create', ["registerPage" => $registerPage]);

    }

    public function store(Request $request){

            $user = new User;

            $userName = ucfirst($request->firstName)." ".ucfirst($request->lastName);

            $user->name = $userName;

            $user->email = $request->email;

            $password = $request->password;

            $confirmPassword = $request->confirmPassword;


            /* Remove accent */
            function stripAccents($str) {

                return strtr(utf8_decode($str), utf8_decode('àáâãäçèéêëìíîïñòóôõöùúûüýÿÀÁÂÃÄÇÈÉÊËÌÍÎÏÑÒÓÔÕÖÙÚÛÜÝ'), 'aaaaaceeeeiiiinooooouuuuyyAAAAACEEEEIIIINOOOOOUUUUY');
            
            }
               
            if($password == $confirmPassword){

                $hashedPassword = Hash::make($password);

                $user->password = $hashedPassword;

            } else {

                return redirect('/register')->with('msg', "The passwords don't match.");
            }
            
            $url_id = stripAccents(strtolower($request->firstName)).".".stripAccents(strtolower($request->lastName)).".".$user->getNextId();

            $user->url_id = $url_id;  
            
            $user->save();

            auth()->login($user);
            
            Session::push('user', [

                'name' => $userName,
                'email' => $request->email,

            ]);

            return redirect('/user/'.$url_id);

    }

    public function logout(Request $request){

        Auth::logout();

        $request->session()->invalidate();
 
        $request->session()->regenerateToken();

        return redirect('/login');

    }

    public function login(){

        if (Auth::user()){

            return redirect('/');

        }

        $loginPage = true;

        return view('users.login', ['loginPage' => $loginPage]);

    }

    public function authenticate(Request $request){

        try {
            
            $userInfo = $request->validate([

                'email' => ['required', 'email'],
                'password' => ['required'],
    
            ]);

        } catch (\Throwable $th) {

            return redirect('/login')->with('msg', 'Incorrect credentials. Please, try again.');

        }

        if (Auth::attempt($userInfo)){

            $request->session()->regenerate();

            return redirect('/user/'.Auth::user()->url_id);

        } else {

            return redirect('/login')->with('msg', 'Incorrect credentials. Please, try again.');
        }
    }

}
