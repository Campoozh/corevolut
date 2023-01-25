<?php

namespace App\Interfaces;

interface UserRepositoryInterface{

    public function getAllUsers();
    public function getUserById($userId);
    public function deleteUser($userId);
    public function createUser(array $userInfo);

}