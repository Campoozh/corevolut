<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function show($url_id){
        
        $user_id = explode('.', $url_id)[2];

        $user = User::findOrFail($user_id);

        if($user->url_id === $url_id){
            
            return view('users.show', ['user' => $user]);

        } else {

            return abort(404, 'User not found');

        }

    }

    public function update(Request $request, $id){

        $user = User::findOrFail($request->id);

        if($request->hasFile('image') && $request->file('image')->isValid()){

                $requestImage = $request->image;

                $imageExtension = $requestImage->extension();

                $imageName = md5($requestImage->getClientOriginalName().strtotime('now')).".".$imageExtension;
                
                $request->image->move(public_path('assets\img\profile'), $imageName);
                
                $user->image_url = $imageName;

                $user->save();
  
        }

        return redirect('/user/'.$user->url_id);

    }
}
