#!/usr/bin/php

<?php
require_once __DIR__ . "/../../web/helper/DatabaseEditor.php";
//
$dbe = new app\helper\DatabaseEditor();
$tableName = "token";

// CREATE Table structure
if ($dbe->createTable($tableName, "
CREATE TABLE `{$tableName}` (
  `user_id` int(11) NOT NULL,
  `code` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) NOT NULL,
  `type` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci
")) {
    // log
    print "CREATE TABLE `{$tableName}`\n";
} else {
    // log
}

// ADD UNIQUE KEY `token_unique` (`user_id`,`code`,`type`)
if ($dbe->setTableColumnMultiUniqueKey($tableName, "token_unique", ["user_id", "code", "type"])) {
    // log
    print "ADD UNIQUE KEY `token_unique` (`user_id`,`code`,`type`) TABLE `{$tableName}`\n";
} else {
    // log
}
