<?php

/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\commands;

use Yii;
use yii\console\Controller;
use yii\console\ExitCode;

/**
 * This command echoes the first argument that you have entered.
 *
 * This command is provided as an example for you to learn how to create console commands.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class DatabaseController extends Controller
{
    public function actionCreate($name)
    {
        $temp = Yii::$app->components['db']['dsn'];
        $temp = explode(";", $temp);
        $dns = $temp[0];
        $username = Yii::$app->components['db']['username'];
        $password = Yii::$app->components['db']['password'];
        $connection = new \yii\db\Connection([
            'dsn' => $dns,
            'username' => $username,
            'password' => $password,
        ]);
        $connection->open();
        $command = $connection->createCommand("CREATE DATABASE IF NOT EXISTS $name");
        $command->execute();
        $connection->close();
        return ExitCode::OK;
    }
}
