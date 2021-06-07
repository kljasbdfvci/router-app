#!/usr/bin/php

<?php
require_once __DIR__ . '/../web/vendor/autoload.php';
require_once __DIR__ . "/../web/helper/Database.php";

use PhpAmqpLib\Connection\AMQPStreamConnection;

$connection = new AMQPStreamConnection('localhost', 5672, 'log_reader', 'UEGBZJr7jEgsf9kt');
$channel = $connection->channel();
$channel->queue_declare('log', false, false, false, false);

$callback = function($msg) { // use ($mysqli)
    // get msg body
    $json = $msg->body;
    $obj = json_decode($json, FALSE);
    $level = $obj->level;
    $process = strtolower($obj->process);
    $message = $obj->message;
    if (
            isset($level) && strlen($level) > 0 &&
            isset($process) && strlen($process) > 0 &&
            isset($message) && strlen($message) > 0
    ) {

        // now work correct
        if (!isset($database) || !$database->isAlive()) {
            $database = new app\helper\Database();
        }
        //
        $query = "INSERT INTO log (level, process, message) VALUES (?, ?, ?)";
        $bindType = "sss";
        $bindValues = array($level, $process, $message);
        //
        $database->insert($query, $bindType, $bindValues);
    }
};

$channel->basic_consume('log', '', false, true, false, false, $callback);
while (count($channel->callbacks)) {
    $channel->wait();
}
$channel->close();
$connection->close();
