<?php

namespace App\Http\Controllers\Api;

use App\BusinessLayer\DeviceBusinessLayer;
use App\DTO\DeviceDTO;
use App\Http\Controllers\Controller;
use App\Models\device;
use Illuminate\Http\Request;

class DeviceController extends Controller
{
    private $deviceBusinessLayer;
    public function __construct()
    {
        $this->deviceBusinessLayer = new DeviceBusinessLayer();
    }

    public function createDevice(Request $request)
    {
        $params = new DeviceDTO();
        $params->setMac($request->input('mac'));
        $params->setSecret($request->input('secret'));
        $params->setSensorNumber($request->input('sensor_number'));
        $params->setValveNumber($request->input('valve_number'));
        $params->setIsPump($request->input('is_pump'));
        $params->setIsManual($request->input('is_manual'));
        $params->setWetLevel($request->input('wet_level'));

        $result = $this->deviceBusinessLayer->addNewDevice($params);
        return response()->json($result, $result['code']);
    }

    public function deviceInit(Request $request)
    {
        $params = new DeviceDTO();
        $params->setMac($request->input('mac'));
        $params->setSecret($request->input('secret'));

        $result = $this->deviceBusinessLayer->verifyDevice($params);
        return response()->json($result, $result['code']);
    }

    public function deviceLogs(Request $request)
    {
        $params = new DeviceDTO();
        $params->setMac($request->input('mac'));
        $params->setSecret($request->input('secret'));
        $params->setSensorValue($request->input('sensor_value'));
        $params->setValveStatus($request->input('valve_status'));
        $params->setRainIntensity($request->input('rain_intensity'));

        $result = $this->deviceBusinessLayer->updateDeviceInfo($params);
        return response()->json($result, $result['code']);
    }
}
