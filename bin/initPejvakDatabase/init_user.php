#!/usr/bin/php

<?php
require_once __DIR__ . "/../../web/helper/DatabaseEditor.php";
//
$dbe = new app\helper\DatabaseEditor();
$tableName = "user";

// CREATE Table structure
if ($dbe->createTable($tableName, "
CREATE TABLE `{$tableName}` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `confirmed_at` int(11) DEFAULT NULL,
  `unconfirmed_email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `blocked_at` int(11) DEFAULT NULL,
  `registration_ip` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `flags` int(11) NOT NULL DEFAULT '0',
  `last_login_at` int(11) DEFAULT NULL
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
    print "ADD PRIMARY KEY `id TABLE `{$tableName}`\n";
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

// ADD UNIQUE KEY `user_unique_username` (`username`)
if ($dbe->setTableColumnUniqueKey($tableName, "user_unique_username", "username")) {
    // log
    print "ADD UNIQUE KEY `user_unique_username` (`username`) TABLE `{$tableName}`\n";
} else {
    // log
}

// ADD UNIQUE KEY `user_unique_email` (`email`)
if ($dbe->setTableColumnUniqueKey($tableName, "user_unique_email", "email")) {
    // log
    print "ADD UNIQUE KEY `user_unique_email` (`email`) TABLE `{$tableName}`\n";
} else {
    // log
}

// INSERT Default Rows
$query = "INSERT INTO `user` "
        . "(`username`, `email`, `password_hash`, `auth_key`, `confirmed_at`, `unconfirmed_email`, `blocked_at`, `registration_ip`, `created_at`, `updated_at`, `flags`, `last_login_at`) "
        . "VALUES "
        . "(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
$bindType = "ssssisisiiii";
$bindRows = [
        ['admin', 'arminmokri@gmail.com', '$2y$08$mDqG8UM7WRDnr9nMaTImieWO.KmSVwOWSpj5SRT1vNB3JUQaVVAwu', '6XwprqzIHbhkb3jj536obVqsmhpGk7Yp', 1531493443, NULL, NULL, '::1', 1531493443, 1531547431, 0, 1539106733],
];
//
$insertedItems = $dbe->setInsert($query, $bindType, $bindRows, $tableName, "username", 0);
foreach ($insertedItems as $insertedItem) {
    print "INSERT {$insertedItem} INTO TABLE `{$tableName}`\n";
}
