<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\helper\Sysstat;

require __DIR__ . "/../Database.php";
require __DIR__ . "/../Network.php";
// Sysstat
require __DIR__ . "/SysstatCpu.php";
require __DIR__ . "/SysstatMemory.php";
require __DIR__ . "/SysstatNetwork.php";

class Sysstat {

    private $cpuDaemon;
    private $memoryDaemon;
    private $networksDaemon;
    private $networkAdapters;
    private $networkNumberOfAdapters;
    //
    private $isRunning;
    //
    private $daemon;
    private $period;
    private $interval;
    private $numberOfDays;
    private $numberOfSampling;

    public function __construct($daemon, $period, $interval, $numberOfDays) {
        $this->cpuDaemon = "cpu";
        $this->memoryDaemon = "memory";
        $this->networksDaemon = "networks";
        //
        $this->daemon = $daemon;
        $this->period = $period;
        $this->interval = $interval;
        $this->numberOfDays = $numberOfDays;
        //
        $this->numberOfSampling = $period / $interval;
        //
        if ($this->daemon == $this->networksDaemon) {
            $network = new \app\helper\Network();
            $this->networkAdapters = $network->getAdapters();
            $this->networkNumberOfAdapters = $network->getNumberOfAdapter();
        }
    }

    private function insertDB($daemon, $value) {
        $database = new \app\helper\Database();
        $query = "INSERT INTO sysstat (daemon, value) VALUES (?, ?)";
        $bindType = "sd";
        $bindValues = array($daemon, $value);
        $database->insert($query, $bindType, $bindValues);
    }

    public function start() {
        $this->isRunning = TRUE;
        while ($this->isRunning) {
            if ($this->daemon == $this->cpuDaemon) {
                $sysstatCpu = $this->getSysstatCpu();
                $this->insertDB($this->daemon, $sysstatCpu->getTotalUsage());
            } elseif ($this->daemon == $this->memoryDaemon) {
                $sysstatMemory = $this->getSysstatMemory();
                $this->insertDB($this->daemon, $sysstatMemory->getMemused());
            } elseif ($this->daemon == $this->networksDaemon) {
                $sysstatNetworks = $this->getSysstatNetworks();
                foreach ($sysstatNetworks as $sysstatNetwork) {
                    // rx
                    $daemon = $this->daemon . "_" . $sysstatNetwork->getIFACE() . "_rx";
                    $value = $sysstatNetwork->getRxkB_s();
                    $this->insertDB($daemon, $value);
                    // tx
                    $daemon = $this->daemon . "_" . $sysstatNetwork->getIFACE() . "_tx";
                    $value = $sysstatNetwork->getTxkB_s();
                    $this->insertDB($daemon, $value);
                }
            }
        }
    }

    public function stop() {
        $this->isRunning = FALSE;
    }

    private function getSysstatCpu() {
        $output = shell_exec("sar {$this->interval} {$this->numberOfSampling} | tail -n 1");
        $sysstatCpu = new SysstatCpu($output);
        return $sysstatCpu;
    }

    private function getSysstatMemory() {
        $output = shell_exec("sar -r {$this->interval} {$this->numberOfSampling} | tail -n 1");
        $sysstatMemory = new SysstatMemory($output);
        return $sysstatMemory;
    }

    private function getSysstatNetworks() {
        $sysstatNetworks = array();
        //
        $output = shell_exec("sar -n DEV {$this->interval} {$this->numberOfSampling} | grep Average | grep eth | tail -n {$this->networkNumberOfAdapters}");
        $rows = explode("\n", $output);
        foreach ($rows as $row) {
            if (strlen($row) > 0) {
                $sysstatNetwork = new SysstatNetwork($row);
                array_push($sysstatNetworks, $sysstatNetwork);
            }
        }
        return $sysstatNetworks;
    }

}
