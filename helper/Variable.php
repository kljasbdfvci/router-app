<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\helper;

class Variable {

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
    private $diskMysqlPath;
    // /memory
    private $memoryPath;
    private $appRecoveryPath;
    private $appPath;
    private $appBinPath;
    private $appWebPath;
    private $initPejvakDatabase;

    public function __construct() {
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
        $this->diskMysqlPath = $this->diskPath . "/mysql";
        // /memory
        $this->memoryPath = "/memory";
        $this->appRecoveryPath = $this->memoryPath . "/app";
        $this->appPath = $this->memoryPath . "/app";
        $this->appBinPath = $this->appPath . "/bin";
        $this->appWebPath = $this->appPath . "/web";
        $this->initPejvakDatabase = $this->appBinPath . "/initPejvakDatabase";
    }

    // /tmp
    public function getTmpPath() {
        return $this->tmpPath;
    }

    // /etc
    public function getEtcPath() {
        return $this->etcPath;
    }

    public function getEtcSystemPath() {
        return $this->etcSystemPath;
    }

    // /var
    public function getVarPath() {
        return $this->varPath;
    }

    public function getVarLibPath() {
        return $this->varLibPath;
    }

    public function getVarLibMysqlPath() {
        return $this->varLibMysqlPath;
    }

    // /disk
    public function getDiskPath() {
        return $this->diskPath;
    }

    public function getDiskMysqlPath() {
        return $this->diskMysqlPath;
    }

    // /memory
    public function getMemoryPath() {
        return $this->memoryPath;
    }

    public function getAppRecoveryPath() {
        return $this->appRecoveryPath;
    }

    public function getAppPath() {
        return $this->appPath;
    }

    public function getAppBinPath() {
        return $this->appBinPath;
    }

    public function getAppWebPath() {
        return $this->appWebPath;
    }

    public function getInitPejvakDatabase() {
        return $this->initPejvakDatabase;
    }

}
