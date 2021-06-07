<?php

namespace app\models;

use yii\base\Model;

class FirmwareForm extends Model {

    /**
     * @var UploadedFile
     */
    public $appFile;
    public $systemFile;

    public function rules() {
        return [
                [['appFile'], 'file',
                'skipOnEmpty' => TRUE,
                //'extensions' => 'tgz',
                'checkExtensionByMimeType' => FALSE,
            ],
                [['systemFile'], 'file',
                'skipOnEmpty' => TRUE,
                //'extensions' => 'tgz',
                'checkExtensionByMimeType' => FALSE,
            ],
        ];
    }

    public function uploadAppFile() {
        if ($this->validate()) {
            $firmware = new \app\helper\Firmware();
            $this->appFile->saveAs($firmware->getAppTmpFilePath());
            //$this->firmwareFile->baseName . '.' . $this->firmwareFile->extension
            $resCheckAppTmpFile = $firmware->checkAppTmpFile();
            return $resCheckAppTmpFile;
        } else {
            return false;
        }
    }

    public function uploadSystemFile() {
        if ($this->validate()) {
            $firmware = new \app\helper\Firmware();
            $this->systemFile->saveAs($firmware->getSystemTmpFilePath());
            //$this->firmwareFile->baseName . '.' . $this->firmwareFile->extension
            $resCheckSystemTmpFile = $firmware->checkSystemTmpFile();
            return $resCheckSystemTmpFile;
        } else {
            return false;
        }
    }

    public function attributeLabels() {
        return [
            'appFile' => "Application File",
            'systemFile' => "System File",
        ];
    }

}
