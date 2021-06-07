#!/usr/bin/php

<?php
require_once __DIR__ . "/../../web/helper/DatabaseEditor.php";
//
$dbe = new app\helper\DatabaseEditor();
$tableName = "dahdi_span";

// CREATE Table structure
if ($dbe->createTable($tableName, "
CREATE TABLE `{$tableName}` (
  `id` int(11) NOT NULL,
  `type` enum('digital','analog') COLLATE utf8_bin NOT NULL,
  `span_num` int(11) DEFAULT NULL,
  `timing_source` int(11) DEFAULT NULL,
  `line_build_out` enum('0','1','2','3','4','5','6','7') COLLATE utf8_bin DEFAULT NULL,
  `framing` enum('d4','esf','cas','ccs') COLLATE utf8_bin DEFAULT NULL,
  `coding` enum('ami','b8zs','hdb3') COLLATE utf8_bin DEFAULT NULL,
  `crc4` tinyint(1) DEFAULT NULL,
  `yellow` tinyint(1) DEFAULT NULL,
  `switchtype` enum('national','dms100','4ess','5ess','euroisdn','ni1','qsig') COLLATE utf8_bin DEFAULT NULL,
  `signalling` enum('pri_cpe','pri_net') COLLATE utf8_bin DEFAULT NULL,
  `map_span_number` int(11) DEFAULT NULL
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
