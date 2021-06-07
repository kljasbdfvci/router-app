<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\helper\Sysstat;

/**
 * Description of SysstatNetwork
 *
 * @author armin
 */
class SysstatNetwork {

    private $IFACE;
    private $rxpck_s;
    private $txpck_s;
    private $rxkB_s;
    private $txkB_s;
    private $rxcmp_s;
    private $txcmp_s;
    private $rxmcst_s;
    private $ifutil;

    //...
    //Average:        IFACE   rxpck/s   txpck/s    rxkB/s    txkB/s   rxcmp/s   txcmp/s  rxmcst/s   %ifutil
    //Average:         eth0      0.00      0.00      0.00      0.00      0.00      0.00      0.00      0.00
    //Average:        kvnet      0.30      0.30      0.03      0.02      0.00      0.00      0.00      0.00
    //Average:           lo      0.00      0.00      0.00      0.00      0.00      0.00      0.00      0.00
    //Average:        wlan0      0.80      0.30      0.07      0.04      0.00      0.00      0.00      0.00
    public function __construct($output) {
        $output = preg_replace('!\s+!', ' ', $output);
        $datas = explode(" ", $output);
        //
        $this->IFACE = $datas[1];
        $this->rxpck_s = $datas[2];
        $this->txpck_s = $datas[3];
        $this->rxkB_s = $datas[4];
        $this->txkB_s = $datas[5];
        $this->rxcmp_s = $datas[6];
        $this->txcmp_s = $datas[7];
        $this->rxmcst_s = $datas[8];
        $this->ifutil = $datas[9];
    }

    public function getIFACE() {
        return $this->IFACE;
    }

    public function getRxkB_s() {
        return $this->rxkB_s;
    }

    public function getTxkB_s() {
        return $this->txkB_s;
    }

}
