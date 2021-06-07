#!/usr/bin/php

<?php
require_once __DIR__ . "/../../web/helper/DatabaseEditor.php";
//
$dbe = new app\helper\DatabaseEditor();

// Relation Between dahdi_channel -> dahdi_span
{
    $tableName = "dahdi_channel";
    $tableReferencesName = "dahdi_span";

    // ADD KEY `fk_span_channel` (`dahdi_span_id`)
    if ($dbe->setTableColumnKey($tableName, "fk_span_channel", "dahdi_span_id")) {
        print "ADD KEY `fk_span_channel` (`dahdi_span_id`) TABLE `{$tableName}`\n";
    }

    // Relation Between dahdi_channel(dahdi_span_id) -> dahdi_span(id)
    if ($dbe->setConstraint("fk_span_channel", $tableName, "dahdi_span_id", $tableReferencesName, "id", "CASCADE", "RESTRICT")) {
        print "Relation Between {$tableName}(dahdi_span_id) -> {$tableReferencesName}(id)\n";
    }
}

// Relation Between profile -> user
{
    $tableName = "profile";
    $tableReferencesName = "user";

    // ADD KEY `fk_user_profile` (`user_id`)
    if ($dbe->setTableColumnKey($tableName, "fk_user_profile", "user_id")) {
        print "ADD KEY `fk_user_profile` (`user_id`) TABLE `{$tableName}`\n";
    }

    // Relation Between profile(user_id) -> user(id)
    if ($dbe->setConstraint("fk_user_profile", $tableName, "user_id", $tableReferencesName, "id", "CASCADE", "RESTRICT")) {
        print "Relation Between {$tableName}(user_id) -> {$tableReferencesName}(id)\n";
    }
}

// Relation Between social_account -> user
{
    $tableName = "social_account";
    $tableReferencesName = "user";

    // ADD KEY `fk_user_account` (`user_id`)
    if ($dbe->setTableColumnKey($tableName, "fk_user_account", "user_id")) {
        print "ADD KEY `fk_user_account` (`user_id`) TABLE `{$tableName}`\n";
    }

    // Relation Between profile(user_id) -> user(id)
    if ($dbe->setConstraint("fk_user_account", $tableName, "user_id", $tableReferencesName, "id", "CASCADE", "RESTRICT")) {
        print "Relation Between {$tableName}(user_id) -> {$tableReferencesName}(id)\n";
    }
}

// Relation Between token -> user
{
    $tableName = "token";
    $tableReferencesName = "user";

    // ADD KEY `fk_user_token` (`user_id`)
    if ($dbe->setTableColumnKey($tableName, "fk_user_token", "user_id")) {
        print "ADD KEY `fk_user_token` (`user_id`) TABLE `{$tableName}`\n";
    }

    // Relation Between profile(user_id) -> user(id)
    if ($dbe->setConstraint("fk_user_token", $tableName, "user_id", $tableReferencesName, "id", "CASCADE", "RESTRICT")) {
        print "Relation Between {$tableName}(user_id) -> {$tableReferencesName}(id)\n";
    }
}

// Relation Between trunkgroup_channel -> trunkgroup
{
    $tableName = "trunkgroup_channel";
    $tableReferencesName = "trunkgroup";

    // ADD KEY `fk_trunkgroup_channel` (`trunkgroup_id`)
    if ($dbe->setTableColumnKey($tableName, "fk_trunkgroup_channel", "trunkgroup_id")) {
        print "ADD KEY `fk_trunkgroup_channel` (`trunkgroup_id`) TABLE `{$tableName}`\n";
    }

    // Relation Between trunkgroup_channel(trunkgroup_id) -> trunkgroup(id)
    if ($dbe->setConstraint("fk_trunkgroup_channel", $tableName, "trunkgroup_id", $tableReferencesName, "id", "CASCADE", "RESTRICT")) {
        print "Relation Between {$tableName}(trunkgroup_id) -> {$tableReferencesName}(id)\n";
    }
}
