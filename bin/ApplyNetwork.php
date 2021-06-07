#!/usr/bin/php

<?php
require_once __DIR__ . "/../web/helper/Api.php";
//
$api = new app\helper\Api();
$api->exec("/network/apply");
