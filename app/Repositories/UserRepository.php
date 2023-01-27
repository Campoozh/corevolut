<?php

namespace App\Repositories;

use App\Interfaces\UserRepositoryInterface;
use App\Models\User;
use App\Models\Notification;

class UserRepository implements UserRepositoryInterface{

    public function getAllUsers(){

        return User::all();

    }
    
    public function getUserById($userId){

        return User::findOrFail($userId);

    }
    
    public function deleteUser($userId){

        return User::destroy($userId);
    
    }

    public function createUser($userInfo){

        return User::create($userInfo);

    }

    public function getUserNotifications($userId){

        return $this->getUserById($userId)->notifications();      

    }

    public function sendNotification($userId, $senderId, $body){

        return Notification::create([
            "user_id" => $userId,
            "sender_id" => $senderId,
            "body" => $body,
        ]);

    }
    
}