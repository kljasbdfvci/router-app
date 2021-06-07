#!/usr/bin/php

<?php
require_once __DIR__ . "/../../web/helper/DatabaseEditor.php";
//
$dbe = new app\helper\DatabaseEditor();
$tableName = "dahdi_channel";

// CREATE Table structure
if ($dbe->createTable($tableName, "
CREATE TABLE `{$tableName}` (
  `id` int(11) NOT NULL,
  `dahdi_span_id` int(11) NOT NULL,
  `device` enum('e&m','fxsls','fxsgs','fxsks','fxols','fxogs','fxoks','unused','clear','bchan','rawhdlc','dchan','hardhdlc','nethdlc','dacs','dacsrbs') COLLATE utf8_bin NOT NULL,
  `real_channel_number` int(11) NOT NULL,
  `echocanceller` enum('disable','mg2','kb1','sec2','sec','oslec') COLLATE utf8_bin NOT NULL DEFAULT 'mg2',
  `analog_type` enum('trunk','user') COLLATE utf8_bin DEFAULT NULL,
  `name` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `map_channel_number` int(11) NOT NULL,
  `rxgain` float DEFAULT NULL,
  `txgain` float DEFAULT NULL,
  `busydetect` enum('no','yes') COLLATE utf8_bin DEFAULT NULL,
  `busycount` int(11) DEFAULT NULL,
  `usecallerid` enum('no','yes') COLLATE utf8_bin DEFAULT NULL,
  `cidsignalling` enum('bell','v23','v23_jp','dtmf','smdi') COLLATE utf8_bin DEFAULT NULL,
  `cidstart` enum('ring','polarity','polarity_IN') COLLATE utf8_bin DEFAULT NULL,
  `ringtimeout` int(11) DEFAULT NULL,
  `pulsedial` enum('no','yes') COLLATE utf8_bin DEFAULT NULL,
  `flash` int(11) DEFAULT NULL,
  `rxwink` int(11) DEFAULT NULL
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

// ADD UNIQUE KEY `real_channel_number` (`real_channel_number`)
if ($dbe->setTableColumnUniqueKey($tableName, "real_channel_number", "real_channel_number")) {
    // log
    print "ADD UNIQUE KEY `real_channel_number` (`real_channel_number`) TABLE `{$tableName}`\n";
} else {
    // log
}
