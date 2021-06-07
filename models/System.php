<?php

namespace app\models;

/**
 * This is the model class for table "{{%system}}".
 *
 * @property int $id
 * @property string $key
 * @property string $value
 */
class System extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return '{{%system}}';
    }

}
