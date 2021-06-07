#!/bin/bash

migrationPaths=('@vendor/dektrium/yii2-user/migrations' '')

for i in ${!migrationPaths[@]}
do
    migrationPath=${migrationPaths[$i]}
    if [ "$migrationPath" == "" ]
    then
        /memory/app/yii migrate/up --interactive=0
    else
        /memory/app/yii migrate/up --interactive=0 --migrationPath=$migrationPath
    fi
done
