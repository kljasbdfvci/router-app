#!/usr/bin/php

<?php
require_once __DIR__ . "/../../web/helper/DatabaseEditor.php";
//
$dbe = new app\helper\DatabaseEditor();
$tableName = "system";

// CREATE Table structure
if ($dbe->createTable($tableName, "
CREATE TABLE `{$tableName}` (
  `id` int(11) NOT NULL,
  `key` varchar(50) COLLATE utf8_bin NOT NULL,
  `value` varchar(50) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin
")) {
    // log
    print "CREATE TABLE `{$tableName}`\n";
} else {
    // log
}

// ADD PRIMARY KEY `id`
if ($dbe->setTableColumnPrimaryKey($tableName, "id")) {
    // log
    print "ADD PRIMARY KEY `id` TABLE `{$tableName}`\n";
} else {
    // log
}

// MODIFY `id` to AUTO_INCREMENT
if ($dbe->setTableColumnAutoIncrement($tableName, "id")) {
    // log
    print "MODIFY `id` to AUTO_INCREMENT TABLE `{$tableName}`\n";
} else {
    // log
}

// ADD UNIQUE KEY `key` (`key`)
if ($dbe->setTableColumnUniqueKey($tableName, "key", "key")) {
    // log
    print "ADD UNIQUE KEY `key` (`key`) TABLE `{$tableName}`\n";
} else {
    // log
}

// INSERT Default Rows
$query = "INSERT INTO `{$tableName}` (`key`, `value`) VALUES (?, ?)";
$bindType = "ss";
$bindRows = [
        ['network_gateway', '192.168.1.1'],
        ['network_eth0_ip0', '192.168.1.18'],
        ['network_eth0_netmask0', '255.255.255.0'],
        ['network_eth0_ip1', ''],
        ['network_eth0_netmask1', ''],
        ['network_eth0_ip2', ''],
        ['network_eth0_netmask2', ''],
        ['network_eth0_ip3', ''],
        ['network_eth0_netmask3', ''],
];
//
$insertedItems = $dbe->setInsert($query, $bindType, $bindRows, $tableName, "key", 0);
foreach ($insertedItems as $insertedItem) {
    print "INSERT {$insertedItem} INTO TABLE `{$tableName}`\n";
}
