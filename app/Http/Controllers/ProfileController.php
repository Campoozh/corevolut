<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserFollower;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

        if (Auth::user()->id != $id) return redirect('/user/'.Auth::user()->url_id);

        if($request->hasFile('image') && $request->file('image')->isValid()){

                $requestImage = $request->image;

                $imageExtension = $requestImage->extension();

                if(in_array($imageExtension, ['png', 'jpg'])){

                    $imageName = md5($requestImage->getClientOriginalName().strtotime('now')).".".$imageExtension;
                    
                    $request->image->move(public_path('assets\img\profile'), $imageName);
                    
                    $user->image_url = $imageName;
    
                    $user->save();
                } else {

                    return redirect('/user/'.$user->url_id);
                    
                }
            
        }

        return redirect('/user/'.$user->url_id)->with('msg', 'Profile updated with success!');

    }

    public function follow($id){

        $followingUser = User::find($id);

        $userFollower = UserFollower::create([

            'user_id' => $followingUser->id,

            'follower_id' => Auth::user()->id

        ]);
        
    }
}
