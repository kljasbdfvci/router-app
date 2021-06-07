#!/usr/bin/php

<?php
require_once __DIR__ . "/../../web/helper/DatabaseEditor.php";
require_once __DIR__ . "/../../web/helper/File.php";
require_once __DIR__ . "/../../web/helper/Variable.php";
//
$dbe = new app\helper\DatabaseEditor(NULL, NULL, NULL, "");
$databaseName = "pejvak";

// CREATE DATABASE
if ($dbe->createDatabaseWithCheckFile($databaseName, "CREATE DATABASE IF NOT EXISTS `{$databaseName}` DEFAULT CHARACTER SET utf8 COLLATE utf8_bin")) {
    // print
    print "CREATE DATABASE `{$databaseName}`\n";
    // should change this if later
    if (TRUE) {
        $variable = new \app\helper\Variable();
        // stop service
        $dbe->serviceStop(1000000);
        // delete database folder
        $file1 = new app\helper\File($variable->getDiskMysqlPath() . "/{$databaseName}");
        $file1->delete(TRUE);
        // move database folder
        $file2 = new app\helper\File($variable->getVarLibMysqlPath() . "/{$databaseName}");
        $file2->moveTo($variable->getDiskMysqlPath(), TRUE);
        // Link database folder
        $file3 = new app\helper\File($variable->getDiskMysqlPath() . "/{$databaseName}");
        $file3->createLink($variable->getVarLibMysqlPath(), TRUE);
        // start service
        $dbe->serviceStart(1000000);
        print "Move Database `{$databaseName}` To /pejvak/mysql\n";
    }
} else {
    // log
}
