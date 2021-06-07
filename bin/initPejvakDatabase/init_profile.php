#!/usr/bin/php

<?php
require_once __DIR__ . "/../../web/helper/DatabaseEditor.php";
//
$dbe = new app\helper\DatabaseEditor();
$tableName = "profile";

// CREATE Table structure
if ($dbe->createTable($tableName, "
CREATE TABLE `{$tableName}` (
  `user_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `public_email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gravatar_email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gravatar_id` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `location` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `website` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bio` text COLLATE utf8_unicode_ci,
  `timezone` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci
")) {
    // log
    print "CREATE TABLE `{$tableName}`\n";
} else {
    // log
}

// ADD PRIMARY KEY `user_id`
if ($dbe->setTableColumnPrimaryKey($tableName, "user_id")) {
    // log
    print "ADD PRIMARY KEY `user_id` TABLE `{$tableName}`\n";
} else {
    // log
}

// INSERT Default Rows
$query = "INSERT INTO `profile` (`user_id`, `name`, `public_email`, `gravatar_email`, `gravatar_id`, `location`, `website`, `bio`, `timezone`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
$bindType = "issssssss";
$bindRows = [
        [1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL],
];
//
$insertedItems = $dbe->setInsert($query, $bindType, $bindRows, $tableName, "user_id", 0);
foreach ($insertedItems as $insertedItem) {
    print "INSERT {$insertedItem} INTO TABLE `{$tableName}`\n";
}
