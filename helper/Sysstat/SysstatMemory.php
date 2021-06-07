<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\helper\Sysstat;

/**
 * Description of SysstatMemory
 *
 * @author armin
 */
class SysstatMemory {

    private $kbmemfree;
    private $kbavail;
    private $kbmemused;
    private $memused;
    private $kbbuffers;
    private $kbcached;
    private $kbcommit;
    private $commit;
    private $kbactive;
    private $kbinact;
    private $kbdirty;

    //04:57:48 PM kbmemfree   kbavail kbmemused  %memused kbbuffers  kbcached  kbcommit   %commit  kbactive   kbinact   kbdirty
    //04:57:49 PM   2993088   4592880   5079500     62.92    243444   1912348  10376316    102.03   3302212   1413340       132
    //...
    //Average:      2973636   4573487   5098952     63.16    243476   1911884  10588716    104.12   3320046   1412885       265   
    public function __construct($output) {
        $output = preg_replace('!\s+!', ' ', $output);
        $datas = explode(" ", $output);
        //
        $this->kbmemfree = $datas[1];
        $this->kbavail = $datas[2];
        $this->kbmemused = $datas[3];
        $this->memused = $datas[4];
        $this->kbbuffers = $datas[5];
        $this->kbcached = $datas[6];
        $this->kbcommit = $datas[7];
        $this->commit = $datas[8];
        $this->kbactive = $datas[9];
        $this->kbinact = $datas[10];
        $this->kbdirty = $datas[11];
    }

    public function getMemused() {
        return $this->memused;
    }

}
