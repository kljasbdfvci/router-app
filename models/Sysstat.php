<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%sysstat}}".
 *
 * @property int $id
 * @property string $datetime
 * @property string $daemon
 * @property string $value
 */
class Sysstat extends \yii\db\ActiveRecord {

    public $hourly_value;
    public $hourly_datetime;

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return '{{%sysstat}}';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
                [['daemon', 'value'], 'required'],
                [['datetime'], 'datetime'],
                [['daemon'], 'string', 'max' => 50],
                [['value'], 'double'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'datetime' => 'Datetime',
            'daemon' => 'Daemon',
            'value' => 'Value',
        ];
    }

    public static function getDaemonHourlyLast24Hours($daemon) {
        //SELECT
        //AVG(value) as hourly_value,
        //DATE_FORMAT(datetime, "%Y-%m-%d %H:00:00") as hourly_datetime
        //FROM sysstat
        //WHERE daemon = 'cpu' AND datetime >= DATE_SUB(NOW(), INTERVAL 1 DAY)
        //GROUP BY date(datetime), hour(datetime)
        //ORDER BY hourly_datetime ASC
        return self::find()
                        ->select(
                                [
                                    'hourly_value' => 'AVG(value)',
                                    'hourly_datetime' => "UNIX_TIMESTAMP(DATE_FORMAT(datetime, '%Y-%m-%d %H:00:00'))"
                                ]
                        )
                        ->where(['AND',
                                ['daemon' => $daemon],
                            "datetime >= DATE_SUB(NOW(), INTERVAL 1 DAY)",
                        ])
                        ->groupBy("date(datetime), hour(datetime)")
                        ->orderBy(['hourly_datetime' => SORT_ASC])->all();
    }

    public static function getDaemonLast5Days($daemon) {
        $daemonLast5Days = array();
        $rows = self::find()
                        ->where(['AND',
                                ['daemon' => $daemon],
                            "datetime >= DATE_SUB(NOW(), INTERVAL 5 DAY)",
                        ])
                        ->orderBy(['datetime' => SORT_ASC])->all();
        foreach ($rows as $row) {
            array_push($daemonLast5Days, [strtotime($row->datetime) * 1000, floatval($row->value)]);
        }
        return $daemonLast5Days;
    }

}
