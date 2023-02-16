<?php

namespace App\DTO;

class DeviceDTO extends GenericDTO
{
    private $id;
    private $mac;
    private $secret;
    private $isPump;
    private $isManual;
    private $wetLevel;
    private $lastActive;
    private $sensorNumber;
    private $valveNumber;
    private $sensorValue;
    private $valveStatus;
    private $rainIntensity;
    private $lastUpdate;

    public function getId()
    {
        return $this->id;
    }

    public function getMac()
    {
        return $this->mac;
    }

    public function getSecret()
    {
        return $this->secret;
    }

    public function getIsPump()
    {
        return $this->isPump;
    }

    public function getIsManual()
    {
        return $this->isManual;
    }

    public function getWetLevel()
    {
        return $this->wetLevel;
    }

    public function getLastActive()
    {
        return $this->lastActive;
    }

    public function getSensorNumber()
    {
        return $this->sensorNumber;
    }

    public function getValveNumber()
    {
        return $this->valveNumber;
    }

    public function getSensorValue()
    {
        return $this->sensorValue;
    }

    public function getValveStatus()
    {
        return $this->valveStatus;
    }

    public function getRainIntensity()
    {
        return $this->rainIntensity;
    }

    public function getLastUpdate()
    {
        return $this->lastUpdate;
    }

    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function setMac($mac)
    {
        $this->mac = $mac;
        return $this;
    }

    public function setSecret($secret)
    {
        $this->secret = $secret;
        return $this;
    }

    public function setIsPump($isPump)
    {
        $this->isPump = $isPump;
        return $this;
    }

    public function setIsManual($isManual)
    {
        $this->isManual = $isManual;
        return $this;
    }

    public function setWetLevel($wetLevel)
    {
        $this->wetLevel = $wetLevel;
        return $this;
    }

    public function setLastActive($lastActive)
    {
        $this->lastActive = $lastActive;
        return $this;
    }

    public function setSensorNumber($sensorNumber)
    {
        $this->sensorNumber = $sensorNumber;
        return $this;
    }

    public function setValveNumber($valveNumber)
    {
        $this->valveNumber = $valveNumber;
        return $this;
    }

    public function setSensorValue($sensorValue)
    {
        $this->sensorValue = $sensorValue;
        return $this;
    }

    public function setValveStatus($valveStatus)
    {
        $this->valveStatus = $valveStatus;
        return $this;
    }

    public function setRainIntensity($rainIntensity)
    {
        $this->rainIntensity = $rainIntensity;
        return $this;
    }

    public function setLastUpdate($lastUpdate)
    {
        $this->lastUpdate = $lastUpdate;
        return $this;
    }
}
