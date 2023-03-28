<?php

namespace App\Http\Controllers\Api;

use App\BusinessLayer\DashboardBusinessLayer;
use App\DTO\DeviceDTO;
use App\DTO\UsersDTO;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    private $dashboardBusinessLayer;
    public function __construct()
    {
        $this->dashboardBusinessLayer = new DashboardBusinessLayer;
    }
    public function signIn(Request $request)
    {
        $params = new UsersDTO();
        $params->setEmail($request->input('email'));
        $params->setPassword($request->input('password'));
        $result = $this->dashboardBusinessLayer->signIn($params);
        return response()->json($result, $result['code']);
    }
    public function checkLogin(Request $request)
    {
        $params = new UsersDTO();
        $params->setRememberToken($request->input('remember_token'));
        $result = $this->dashboardBusinessLayer->checkLogin($params);
        return response()->json($result, $result['code']);
    }
    public function fetchData(Request $request)
    {
        $params = new DeviceDTO();
        $params->setMac($request->input('mac'));
        $result = $this->dashboardBusinessLayer->fetchData($params);
        return response()->json($result, $result['code']);
    }
    public function updateDevice(Request $request)
    {
        $params = new DeviceDTO();
        $params->setMac($request->input('mac'));
        $params->setSecret($request->input('secret'));
        $params->setSensorValue($request->input('sensor_value'));
        $params->setIsManual($request->input('is_manual'));
        $result = $this->dashboardBusinessLayer->updateDevice($params);
        return response()->json($result, $result['code']);
    }
}
