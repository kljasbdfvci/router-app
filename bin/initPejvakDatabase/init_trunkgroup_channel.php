#!/usr/bin/php

<?php
require_once __DIR__ . "/../../web/helper/DatabaseEditor.php";
//
$dbe = new app\helper\DatabaseEditor();
$tableName = "trunkgroup_channel";

// CREATE Table structure
if ($dbe->createTable($tableName, "
CREATE TABLE `{$tableName}` (
  `id` int(11) NOT NULL,
  `trunkgroup_id` int(11) NOT NULL,
  `dahdi_channel_id` int(11) NOT NULL
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
