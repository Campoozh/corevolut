<?php

namespace App\Http\Controllers;

use App\Models\UserFollower;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Interfaces\UserRepositoryInterface;

class ProfileController extends Controller
{

    private UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function show($url_id){
        
        $user_id = explode('.', $url_id)[2];

        $user = $this->userRepository->getUserById($user_id);

        $followers = $user->followers;

        $userFollowers = UserFollower::where('user_id', $user_id)->get();

        $following = false;

        if (!Auth::guest()){

            foreach($userFollowers as $follower){ 

                if($follower['follower_id'] == Auth::user()->id){

                    $following = true;

                }

            }

        }
        
        if($user->url_id === $url_id){
            
            return view('users.show', ['user' => $user, 'followers' => $followers, 'following' => $following]);

        } else {

            return abort(404, 'User not found');

        }

    }

    public function updateImage(Request $request, $id){

        if (Auth::user()->id != $id) return redirect('/user/'.Auth::user()->url_id);

        if($request->hasFile('image') && $request->file('image')->isValid()){

                $user = $this->userRepository->getUserById($id);

                $requestImage = $request->image;

                $imageExtension = $requestImage->extension();

                if(in_array($imageExtension, ['png', 'jpg'])){

                    if($user->image_url != 'default.png'){

                        unlink(public_path('assets\img\profile').'\\'.$user->image_url);

                    }    

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

    public function updateProfile(Request $request, $id){

        if (Auth::user()->id != $id) return redirect('/user/'.Auth::user()->url_id);

        $user = $this->userRepository->getUserById($id);

        if($request->firstName && $request->lastName){

            $fullName = ucfirst(strtolower($request->firstName)).' '.ucfirst(strtolower($request->lastName));
    
            $newName = $request->firstName ? $fullName : $user->id;

            $user->name = $newName;
    
            $user->save();
        }

        return redirect()->back();

    }

    public function follow($id){

        $followingUser = $this->userRepository->getUserById($id);

        if ($followingUser == Auth::user()) return redirect('/user/'.Auth::user()->url_id);

        $userFollower = UserFollower::create([

            'user_id' => $followingUser->id,

            'follower_id' => Auth::user()->id

        ]);

        return redirect('/user/'.$followingUser->url_id);
        
    }
}
