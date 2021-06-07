#!/usr/bin/php

<?php
require_once __DIR__ . "/../../web/helper/DatabaseEditor.php";
//
$dbe = new app\helper\DatabaseEditor();
$tableName = "extension";

// CREATE Table structure
if ($dbe->createTable($tableName, "
CREATE TABLE `{$tableName}` (
  `id` int(11) NOT NULL,
  `username` decimal(10,0) NOT NULL,
  `secret` varchar(50) COLLATE utf8_bin NOT NULL,
  `callerid` varchar(50) COLLATE utf8_bin NOT NULL,
  `dtmfmode` enum('inband','rfc2833','info','auto') COLLATE utf8_bin NOT NULL DEFAULT 'rfc2833',
  `allow` varchar(60) COLLATE utf8_bin NOT NULL DEFAULT 'ulaw,alaw,gsm',
  `disallow` varchar(60) COLLATE utf8_bin DEFAULT NULL,
  `description` varchar(100) COLLATE utf8_bin DEFAULT NULL
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

// ADD UNIQUE KEY `username` (`username`)
if ($dbe->setTableColumnUniqueKey($tableName, "username", "username")) {
    // log
    print "ADD UNIQUE KEY `username` (`username`) TABLE `{$tableName}`\n";
} else {
    // log
}
