<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\helper;

require_once __DIR__ . "/File.php";
require_once __DIR__ . "/Variable.php";

class Firmware
{

    // App
    private $appName;
    private $appCurrentVersionPath;
    private $appUpdatedFlagPath;
    // System
    private $osName;
    private $osCurrentVersionPath;
    private $osUpdatedFlagPath;

    public function __construct()
    {
        $variable = new Variable();
        // App
        $this->appName = $variable->getAppName();
        $this->appCurrentVersionPath = $variable->getAppPath() . '/version';
        $this->appUpdatedFlagPath = $variable->getTmpPath() . "/" . $this->appName . ".new";
        // Os
        $this->osName = $variable->getOsName();
        $this->osCurrentVersionPath = '/version';
        $this->osUpdatedFlagPath = $variable->getTmpPath() . "/" . $this->osName . ".new";
    }

    public function getAppCurrentVersion()
    {
        $file = new File($this->appCurrentVersionPath);
        if ($file->exists()) {
            return trim($file->read());
        } else {
            return "error";
        }
    }

    public function getAppNewVersion()
    {
        return shell_exec("serial -r {$this->appName} | tr -d '\n'");
    }

    public function appUpdate()
    {
        $variable = new Variable();
        exec("serial -u {$this->appName} {$variable->getFirmwarePath()} {$this->appCurrentVersionPath}  {$variable->getTmpPath()}  | tr -d '\n'", $output, $return_code);
        return $return_code;
    }

    public function setAppUpdated()
    {
        $file = new File($this->appUpdatedFlagPath);
        $file->write("");
        return;
    }

    public function isAppUpdated()
    {
        $file = new File($this->appUpdatedFlagPath);
        return $file->exists();
    }

    public function getOsCurrentVersion()
    {
        $file = new File($this->osCurrentVersionPath);
        if ($file->exists()) {
            return trim($file->read());
        } else {
            return "error";
        }
    }

    public function getOsNewVersion()
    {
        return shell_exec("serial -r {$this->osName} | tr -d '\n'");
    }

    public function osUpdate()
    {
        $variable = new Variable();
        exec("serial -u {$this->osName} {$variable->getFirmwarePath()} {$this->osCurrentVersionPath}  {$variable->getTmpPath()}  | tr -d '\n'", $output, $return_code);
        return $return_code;
    }

    public function setOsUpdated()
    {
        $file = new File($this->osUpdatedFlagPath);
        $file->write("");
        return;
    }

    public function isOsUpdated()
    {
        $file = new File($this->osUpdatedFlagPath);
        return $file->exists();
    }
}
