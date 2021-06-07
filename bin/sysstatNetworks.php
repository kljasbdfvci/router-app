#!/usr/bin/php

<?php
require_once __DIR__ . "/../web/helper/Sysstat/Sysstat.php";

use app\helper\Sysstat\Sysstat;

// start
$sysstat = new Sysstat("networks", 5 * 60, 10, 10);
$sysstat->start();
