<?php

namespace App\BusinessLayer;

use App\DTO\UsersDTO;
use App\Models\User;
use App\PresentationLayer\ResponseCreatorPresentationLayer;
use Illuminate\Support\Facades\Hash;

class UsersBusinessLayer extends GenericBusinessLayer
{
    public function createUser(UsersDTO $params)
    {
        try {
            $email = $params->getEmail();
            $password = $params->getPassword();
            $name = $params->getName();
            $data = [
                'email' => $email,
                'password' => Hash::make($password),
                'name' => $name,
                'remember_token' => Hash::make($name . $email)
            ];
            $saved = User::create($data);
            if ($saved) {
                $response = new ResponseCreatorPresentationLayer(200, 'User Successfully Added!', $data);
            } else {
                $response = new ResponseCreatorPresentationLayer(400, 'Failed to create', null);
            }
        } catch (\Exception $e) {
            $response = new ResponseCreatorPresentationLayer(500, 'Internal Server Error', $e);
        }
        return $response->getResponse();
    }
    public function updateUsers(UsersDTO $params)
    {
        try {
        } catch (\Exception $e) {
            $response = new ResponseCreatorPresentationLayer(500, 'Internal Server Error', $e);
        }
    }
    public function deleteUsers(UsersDTO $params)
    {
        try {
        } catch (\Exception $e) {
            $response = new ResponseCreatorPresentationLayer(500, 'Internal Server Error', $e);
        }
    }
}
