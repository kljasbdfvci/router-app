<?php

namespace app\controllers;

use Yii;
use app\models\FirmwareForm;
use yii\web\Controller;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use dektrium\user\filters\AccessRule;
use yii\web\UploadedFile;

class FirmwareController extends Controller {

    public function getViewPath() {
        return Yii::getAlias('@app/views/system/firmware');
    }

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                ],
            ],
            'access' => [
                'class' => AccessControl::className(),
                'ruleConfig' => [
                    'class' => AccessRule::className(),
                ],
                'rules' => [
                        [
                        'allow' => true,
                        'actions' => ['index'],
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actionIndex() {
        $model = new FirmwareForm();

        if (Yii::$app->request->isPost) {
            // App
            $model->appFile = UploadedFile::getInstance($model, 'appFile');
            if (isset($model->appFile) && $model->appFile->size > 0) {
                if ($model->uploadAppFile()) {
                    // file is uploaded successfully                
                } else {
                    
                }
            }
            // System
            $model->systemFile = UploadedFile::getInstance($model, 'systemFile');
            if (isset($model->systemFile) && $model->systemFile->size > 0) {
                if ($model->uploadSystemFile()) {
                    // file is uploaded successfully                
                } else {
                    
                }
            }
        }

        $firmware = new \app\helper\Firmware();
        return $this->render('index', [
                    'model' => $model,
                    'serialNumber' => $firmware->getSerialNumber(),
                    'appCurrentVersion' => $firmware->getAppCurrentVersion(),
                    'isAppNewUploaded' => $firmware->isAppNewUploaded(),
                    'systemCurrentVersion' => $firmware->getSystemCurrentVersion(),
                    'isSystemNewUploaded' => $firmware->isSystemNewUploaded(),
        ]);
    }

}
