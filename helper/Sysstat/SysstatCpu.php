<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\helper\Sysstat;

/**
 * Description of SysstatCpu
 *
 * @author armin
 */
class SysstatCpu {

    private $user;
    private $nice;
    private $system;
    private $iowait;
    private $steal;
    private $idle;
    //
    private $totalUsage;

    //07:36:09 PM     CPU     %user     %nice   %system   %iowait    %steal     %idle
    //07:36:10 PM     all      1.64      0.00      0.63      0.00      0.00     97.73
    //...
    //Average:        all      0.61      0.00      0.74      0.08      0.00     98.57    
    public function __construct($output) {
        $output = preg_replace('!\s+!', ' ', $output);
        $datas = explode(" ", $output);
        //
        $this->user = $datas[2];
        $this->nice = $datas[3];
        $this->system = $datas[4];
        $this->iowait = $datas[5];
        $this->steal = $datas[6];
        $this->idle = $datas[7];
        //
        $this->totalUsage = $this->user +
                $this->nice + $this->system +
                $this->iowait + $this->steal;
    }

    public function getTotalUsage() {
        return $this->totalUsage;
    }

}
