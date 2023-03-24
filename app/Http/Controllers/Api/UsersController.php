<?php

namespace App\Http\Controllers\Api;

use App\BusinessLayer\UsersBusinessLayer;
use App\DTO\UsersDTO;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller
{
    private $usersBusinessLayer;
    public function __construct()
    {
        $this->usersBusinessLayer = new UsersBusinessLayer();
    }

    public function createUser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'password' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        } else {
            $params = new UsersDTO();
            $params->setEmail($request->input('email'));
            $params->setPassword($request->input('password'));
            $params->setName($request->input('name'));

            $result = $this->usersBusinessLayer->createUser($params);
            return response()->json($result, $result['code']);
        }
    }
}
