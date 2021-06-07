<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%log}}".
 *
 * @property int $id
 * @property timestamp $datetime
 * @property string $level
 * @property string $process
 * @property string $message
 */
class Log extends \yii\db\ActiveRecord {

    private static $levelList = ['info' => 'Info', 'warning' => 'Warning',
        'error' => 'Error', 'debug' => 'Debug'];

    public static function getLevelList() {
        return self::$levelList;
    }

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return '{{%log}}';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
                [['level', 'process', 'message'], 'required'],
                [['level'], 'string', 'max' => 10],
                [['process'], 'string', 'max' => 50],
                ['level', 'in', 'range' => array_keys(self::$levelList)],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'datetime' => 'Date',
            'level' => 'Level',
            'process' => 'Process',
            'message' => 'Message',
        ];
    }

}
