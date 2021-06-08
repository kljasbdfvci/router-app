<?php

namespace app\models;

use yii\base\Model;

class FirmwareForm extends Model
{

    /**
     * @var UploadedFile
     */
    public $app;
    public $os;

    public function rules()
    {
        return [
            ['app', 'boolean'],
            ['os', 'boolean'],
        ];
    }

    public function updateSystem()
    {
        if ($this->app) {
            $firmware = new \app\helper\Firmware();
            if ($firmware->appUpdate() == 0) {
                $firmware->setAppUpdated();
            }
        }
        if ($this->os) {
            $firmware = new \app\helper\Firmware();
            if ($firmware->osUpdate() == 0) {
                $firmware->setOsUpdated();
            }
        }
    }

    public function attributeLabels()
    {
        return [
            'app' => "Application Update",
            'os' => "System Update",
        ];
    }
}
