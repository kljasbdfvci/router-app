#!/usr/bin/php

<?php
require_once __DIR__ . "/../../web/helper/DatabaseEditor.php";
//
$dbe = new app\helper\DatabaseEditor();
$tableName = "social_account";

// CREATE Table structure
if ($dbe->createTable($tableName, "
CREATE TABLE `{$tableName}` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `provider` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `client_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `data` text COLLATE utf8_unicode_ci,
  `code` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci
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

// ADD UNIQUE KEY `account_unique` (`provider`,`client_id`)
if ($dbe->setTableColumnMultiUniqueKey($tableName, "account_unique", ["provider", "client_id"])) {
    // log
    print "ADD UNIQUE KEY `account_unique` (`provider`,`client_id`) TABLE `{$tableName}`\n";
} else {
    // log
}

// ADD UNIQUE KEY `account_unique_code` (`code`)
if ($dbe->setTableColumnUniqueKey($tableName, "account_unique_code", "code")) {
    // log
    print "ADD UNIQUE KEY `account_unique_code` (`code`) TABLE `{$tableName}`\n";
} else {
    // log
}
