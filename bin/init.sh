#!/bin/bash

### Service
service apache2 restart

### Create Database
/memory/app/yii database/create router 2>/disk/log/createDatabase.log

### Init Database
/memory/app/bin/initDatabase.sh &>>/disk/log/initDatabase.log

### Fix app permission
chown -R www-data:www-data /memory/app

### Fix firmware permission
chown -R www-data:www-data /disk/firmware

### Start Log Manager
#/memory/app/bin/LogManager.php 2>/tmp/LogManager.log &

### Start sysstatCpu, sysstatMemory, sysstatNetworks
#/memory/app/bin/sysstatCpu.php 2>/tmp/sysstatCpu.log &
#/memory/app/bin/sysstatMemory.php 2>/tmp/sysstatMemory.log &
#/memory/app/bin/sysstatNetworks.php 2>/tmp/sysstatNetworks.log &

### Apply Network
/memory/app/yii network/apply 2>/tmp/ApplyNetwork.log
