<?php

namespace app\models;

use Yii;

class Network extends System {

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
                [['key'], 'required'],
                [['key', 'value'], 'string', 'max' => 50],
                [['value'], 'ip'],
        ];
    }

    public function getTableKeyValue() {
        $arrayHelper = new \yii\helpers\ArrayHelper();
        $query = Network::find()->where(['like', 'key', 'network%', false])->all();
        $data = $arrayHelper->map($query, 'key', 'value');
        return $data;
    }

}
