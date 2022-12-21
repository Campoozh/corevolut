<?php

namespace App\Http\Controllers;

use App\Models\Level;
use App\Models\User;

class ProfileController extends Controller
{
    public function show($url_id){
        
        $user_id_num = explode('.', $url_id)[2];

        $user_by_id = User::findOrFail($user_id_num);

        if($user_by_id['url_id'] == $url_id){

            $user = User::findOrFail($user_id_num);

        } else {

            return redirect('/');

        }
       
        return view('users.show', ['user' => $user]);

    }
}
