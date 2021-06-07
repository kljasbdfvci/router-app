#!/usr/bin/php

<?php
require_once __DIR__ . "/../../web/helper/DatabaseEditor.php";
//
$dbe = new app\helper\DatabaseEditor();
$tableName = "migration";

// CREATE Table structure
if ($dbe->createTable($tableName, "
CREATE TABLE `{$tableName}` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1
")) {
    // log
    print "CREATE TABLE `{$tableName}`\n";
} else {
    // log
}

// ADD PRIMARY KEY `version`
if ($dbe->setTableColumnPrimaryKey($tableName, "version")) {
    // log
    print "ADD PRIMARY KEY `version` TABLE `{$tableName}`\n";
} else {
    // log
}

// INSERT Default Rows
$query = "INSERT INTO `migration` (`version`, `apply_time`) VALUES (?, ?)";
$bindType = "si";
$bindRows = [
        ['m000000_000000_base', 1531493277],
        ['m140209_132017_init', 1531493283],
        ['m140403_174025_create_account_table', 1531493285],
        ['m140504_113157_update_tables', 1531493291],
        ['m140504_130429_create_token_table', 1531493293],
        ['m140830_171933_fix_ip_field', 1531493294],
        ['m140830_172703_change_account_table_name', 1531493294],
        ['m141222_110026_update_ip_field', 1531493295],
        ['m141222_135246_alter_username_length', 1531493296],
        ['m150614_103145_update_social_account_table', 1531493300],
        ['m150623_212711_fix_username_notnull', 1531493300],
        ['m151218_234654_add_timezone_to_profile', 1531493300],
        ['m160929_103127_add_last_login_at_to_user_table', 1531493301]
];
//
$insertedItems = $dbe->setInsert($query, $bindType, $bindRows, $tableName, "version", 0);
foreach ($insertedItems as $insertedItem) {
    print "INSERT {$insertedItem} INTO TABLE `{$tableName}`\n";
}
