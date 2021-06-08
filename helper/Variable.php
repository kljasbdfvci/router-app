<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\helper;

class Variable
{
    // names
    private $appName;
    private $osName;
    // /tmp
    private $tmpPath;
    // /etc
    private $etcPath;
    private $etcSystemPath;
    // /var
    private $varPath;
    private $varLibPath;
    private $varLibMysqlPath;
    // /disk
    private $diskPath;
    private $firmwarePath;
    // /memory
    private $memoryPath;
    private $appPath;
    private $appBinPath;
    private $appWebPath;

    public function __construct()
    {
        // names
        $this->appName = "router-app";
        $this->osName = "router-os";
        // /tmp
        $this->tmpPath = "/tmp";
        // /etc
        $this->etcPath = '/etc';
        $this->etcSystemPath = $this->etcPath . "/system";
        // /var
        $this->varPath = "/var";
        $this->varLibPath = $this->varPath . "/lib";
        $this->varLibMysqlPath = $this->varLibPath . "/mysql";
        // /disk
        $this->diskPath = "/disk";
        $this->firmwarePath = $this->diskPath . "/firmware";
        // /memory
        $this->memoryPath = "/memory";
        $this->appPath = $this->memoryPath . "/app";
        $this->appBinPath = $this->appPath . "/bin";
        $this->appWebPath = $this->appPath . "/web";
    }

    // names
    public function getAppName()
    {
        return $this->appName;
    }

    public function getOsName()
    {
        return $this->osName;
    }

    // /tmp
    public function getTmpPath()
    {
        return $this->tmpPath;
    }

    // /etc
    public function getEtcPath()
    {
        return $this->etcPath;
    }

    public function getEtcSystemPath()
    {
        return $this->etcSystemPath;
    }

    // /var
    public function getVarPath()
    {
        return $this->varPath;
    }

    public function getVarLibPath()
    {
        return $this->varLibPath;
    }

    public function getVarLibMysqlPath()
    {
        return $this->varLibMysqlPath;
    }

    // /disk
    public function getDiskPath()
    {
        return $this->diskPath;
    }

    public function getFirmwarePath()
    {
        return $this->firmwarePath;
    }

    // /memory
    public function getMemoryPath()
    {
        return $this->memoryPath;
    }

    public function getAppPath()
    {
        return $this->appPath;
    }

    public function getAppBinPath()
    {
        return $this->appBinPath;
    }

    public function getAppWebPath()
    {
        return $this->appWebPath;
    }
}
