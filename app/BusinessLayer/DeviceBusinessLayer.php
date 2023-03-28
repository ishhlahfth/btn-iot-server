<?php

namespace App\BusinessLayer;

use App\BusinessLayer\GenericBusinessLayer;
use App\DTO\DeviceDTO;
use App\Models\Device;
use App\Models\Logs;
use App\PresentationLayer\ResponseCreatorPresentationLayer;

class DeviceBusinessLayer extends GenericBusinessLayer
{
    public function verifyDevice(DeviceDTO $params)
    {
        try {
            $mac = $params->getMac();
            $secret = $params->getSecret();
            $deviceData = Device::where('mac', $mac)->first();
            if ($deviceData != null) {
                if ($deviceData->secret  == $secret) {
                    $response = new ResponseCreatorPresentationLayer(200, 'Device found!', $deviceData);
                } else {
                    $response = new ResponseCreatorPresentationLayer(401, 'Wrong Secret Key', null);
                }
            } else {
                $response = new ResponseCreatorPresentationLayer(404, 'Device not registered', null);
            }
        } catch (\Exception $e) {
            $response = new ResponseCreatorPresentationLayer(500, 'Internal Server Error', $e);
        }

        return $response->getResponse();
    }

    public function addNewDevice(DeviceDTO $params)
    {
        try {
            $mac = $params->getMac();
            $secret = $params->getSecret();
            $deviceData = Device::where('mac', $mac)->first();
            if ($deviceData == null) {
                $sensorNumber = $params->getSensorNumber();
                $valveNumber = $params->getValveNumber();
                $tmpval = [];
                for ($i = 0; $i < $sensorNumber; $i++) {
                    array_push($tmpval, 0);
                }

                $tmpvalvstat = [];
                for ($i = 0; $i < $valveNumber; $i++) {
                    array_push($tmpvalvstat, 0);
                }
                $strValveStat = implode(',', $tmpvalvstat);
                $strSensorVal = implode(',', $tmpval);
                $data = [
                    'mac' => $mac,
                    'secret' => $secret,
                    'isPump' => $params->getIsPump(),
                    'isManual' => $params->getIsManual(),
                    'sensorNumber' => $sensorNumber,
                    'valveNumber' => $valveNumber,
                    'sensorValue' => $strSensorVal,
                    'valveStatus' => $strValveStat,
                    'wetLevel' => $params->getWetLevel(),
                    'lastUpdate' => date('Y-m-d H:i:s'),
                    'lastActive' => date('Y-m-d H:i:s'),
                ];
                $saved = Device::create($data);
                if ($saved) {
                    $response = new ResponseCreatorPresentationLayer(200, 'Device Successfully Added!', $saved);
                } else {
                    $response = new ResponseCreatorPresentationLayer(400, 'Failed to create', $deviceData);
                }
            } else {
                $response = new ResponseCreatorPresentationLayer(400, 'Device already registered', null);
            }
        } catch (\Error $e) {
            $response = new ResponseCreatorPresentationLayer(500, 'Internal Server Error', $e);
        }
        return $response->getResponse();
    }

    public function updateDeviceInfo(DeviceDTO $params)
    {
        try {
            $mac = $params->getMac();
            $secret = $params->getSecret();
            $sensorValue = $params->getSensorValue();
            $rainIntensity = $params->getRainIntensity();
            $lastActive = date('Y-m-d H:i:s');
            $deviceData = Device::where('mac', $mac)->first();
            if ($deviceData != null) {
                if ($deviceData->secret  == $secret) {
                    $deviceData->sensorValue = $sensorValue;
                    if (!$deviceData->isManual) {
                        if ($sensorValue == 1) {
                            $deviceData->valveStatus = '1|1';
                        } else {
                            $deviceData->valveStatus = '0|0';
                        }
                    }
                    $deviceData->rainIntensity = $rainIntensity;
                    $deviceData->lastActive = $lastActive;
                    $deviceData->lastUpdate = $lastActive;

                    if ($deviceData->save()) {
                        $logsData = [
                            'mac' => $mac,
                            'sensorValue' => $sensorValue,
                            'valveStatus' => $valveStatus,
                            'rainIntensity' => $params->getRainIntensity(),
                        ];
                        if (Logs::create($logsData)) {
                            $response = new ResponseCreatorPresentationLayer(200, 'Successfully Updated and logged!', $deviceData);
                        } else {
                            $response = new ResponseCreatorPresentationLayer(200, 'Successfully Updated only!', $deviceData);
                        }
                    } else {
                        $response = new ResponseCreatorPresentationLayer(400, 'Failed to Update', $deviceData);
                    }
                } else {
                    $response = new ResponseCreatorPresentationLayer(401, 'Wrong Secret Key', null);
                }
            } else {
                $response = new ResponseCreatorPresentationLayer(404, 'Device not registered', null);
            }
        } catch (\Error $e) {
            $response = new ResponseCreatorPresentationLayer(500, 'Internal Server Error', $e);
        }
        return $response->getResponse();
    }
}
