<?php

namespace App\BusinessLayer;

use App\DTO\DeviceDTO;
use App\DTO\UsersDTO;
use App\Models\Device;
use App\Models\User;
use App\PresentationLayer\ResponseCreatorPresentationLayer;
use Illuminate\Support\Facades\Hash;

class DashboardBusinessLayer extends GenericBusinessLayer
{
    public function signIn(UsersDTO $params)
    {
        try {
            $email = $params->getEmail();
            $password = $params->getPassword();
            $userData = User::where('email', $email)->first();
            if ($userData != null) {
                if (Hash::check($password, $userData['password'])) {
                    $respData = [
                        'remember_token' => $userData['remember_token']
                    ];
                    $response = new ResponseCreatorPresentationLayer(200, 'Successfully Logged In!', $respData);
                } else {
                    $response = new ResponseCreatorPresentationLayer(401, 'Wrong Email/Password', null);
                }
            } else {
                $response = new ResponseCreatorPresentationLayer(401, 'Wrong Email/Password', null);
            }
        } catch (\Exception $e) {
            $response = new ResponseCreatorPresentationLayer(500, 'Internal Server Error', $e);
        }
        return $response->getResponse();
    }

    public function checkLogin(UsersDTO $params)
    {
        try {
            $rememberToken = $params->getRememberToken();
            $tokenData = User::where('remember_token', $rememberToken)->first();
            if ($tokenData) {
                $response = new ResponseCreatorPresentationLayer(200, 'Authorized', $tokenData);
            } else {
                $response = new ResponseCreatorPresentationLayer(401, 'Unauthorized', null);
            }
        } catch (\Exception $e) {
            $response = new ResponseCreatorPresentationLayer(500, 'Internal Server Error', $e);
        }
        return $response->getResponse();
    }

    public function fetchData(DeviceDTO $params)
    {
        try {
            $mac = $params->getMac();
            $deviceData = Device::where('mac', $mac)->first();
            if ($deviceData) {
                $response = new ResponseCreatorPresentationLayer(200, 'Successfully Fetched', $deviceData);
            } else {
                $response = new ResponseCreatorPresentationLayer(404, 'Device Not Found', null);
            }
        } catch (\Exception $e) {
            $response = new ResponseCreatorPresentationLayer(500, 'Internal Server Error', $e);
        }
        return $response->getResponse();
    }
    public function updateDevice(DeviceDTO $params)
    {
        try {
            $mac = $params->getMac();
            $valveStatus = $params->getValveStatus();
            $isManual = $params->getIsManual();
            $deviceData = Device::where('mac', $mac)->first();
            if ($deviceData != null) {
                if ($isManual != null) {
                    $deviceData->isManual = $isManual;
                }
                if ($valveStatus != null) {
                    $deviceData->valveStatus = $valveStatus;
                }
                if ($deviceData->save()) {
                    $response = new ResponseCreatorPresentationLayer(200, 'Successfully Updated and logged!', $deviceData);
                } else {
                    $response = new ResponseCreatorPresentationLayer(400, 'Failed to Update', $deviceData);
                }
            } else {
                $response = new ResponseCreatorPresentationLayer(404, 'Device not registered', null);
            }
        } catch (\Exception $e) {
            $response = new ResponseCreatorPresentationLayer(500, 'Internal Server Error', $e);
        }
        return $response->getResponse();
    }
}
