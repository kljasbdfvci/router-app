<?php

namespace app\helper;

class Info
{
    public function __construct()
    {
    }

    // Serial Number
    public function getSerialNumber()
    {
        return shell_exec("sudo serial -s serial | tr -d '\n'");
    }
}
