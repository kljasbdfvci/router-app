<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\helper;

class System {

    public function __construct() {
        
    }

    public function shutdown() {
        $shutdown = shell_exec("(/usr/bin/nohup sleep 5 && sudo shutdown -h now) >/dev/null 2>&1 &");
        return;
    }

    public function reboot() {
        $reboot = shell_exec("(/usr/bin/nohup sleep 5 && sudo reboot) >/dev/null 2>&1 &");
        return;
    }

    public function isDataStorageMounted() {
        $variable = new Variable();
        $command = "mountpoint -q '{$variable->getDiskPath()}'";
        $return_var = NULL;
        exec($command, $output, $return_var);
        if (!$return_var) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

}
