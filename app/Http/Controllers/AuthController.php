<?php

namespace App\Http\Controllers;

use App\Interfaces\UserRepositoryInterface;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{

    private UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function create(){

        $user = Auth::user();

        if ($user){

            return redirect('/');
            
        }

        $registerPage = true;

        return view('users.create', ["registerPage" => $registerPage]);

    }

    public function store(Request $request){

            $userName = ucfirst($request->firstName)." ".ucfirst($request->lastName);
          
            $password = $request->password;

            $confirmPassword = $request->confirmPassword;


            if($password == $confirmPassword){

                $hashedPassword = Hash::make($password);

            } else {

                return redirect('/register')->with('msg', "The passwords don't match.");
            }

            /* Remove accent */
            function stripAccents($str) {

                return strtr(mb_convert_encoding($str, "UTF-8"), mb_convert_encoding('àáâãäçèéêëìíîïñòóôõöùúûüýÿÀÁÂÃÄÇÈÉÊËÌÍÎÏÑÒÓÔÕÖÙÚÛÜÝ', "UTF-8"), 'aaaaaceeeeiiiinooooouuuuyyAAAAACEEEEIIIINOOOOOUUUUY');
            
            }

            $user = new User;

            $url_id = stripAccents(strtolower($request->firstName)).".".stripAccents(strtolower($request->lastName)).".".$user->getNextId();
            
            $user = $this->userRepository->createUser([
                "name" => $userName,
                "email" => $request->email,
                "password" => $hashedPassword,
                "url_id" => $url_id
            ]);

            $this->userRepository->sendNotification($user->id, Null,"Welcome to Corevolut!");
        
            Session::push('user', [

                'name' => $userName,
                'email' => $request->email,

            ]);

            auth()->login($user);

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
