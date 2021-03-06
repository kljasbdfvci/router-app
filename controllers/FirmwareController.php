<?php

namespace app\controllers;

use Yii;
use app\models\FirmwareForm;
use yii\web\Controller;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use dektrium\user\filters\AccessRule;
use yii\web\UploadedFile;

class FirmwareController extends Controller
{

    public function getViewPath()
    {
        return Yii::getAlias('@app/views/system/firmware');
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [],
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

    public function actionIndex()
    {
        $model = new FirmwareForm();

        if ($model->validate(Yii::$app->request->post()) && $model->load(Yii::$app->request->post())) {
            $model->updateSystem();
        }

        $firmware = new \app\helper\Firmware();
        return $this->render('index', [
            'model' => $model,
            'appCurrentVersion' => $firmware->getAppCurrentVersion(),
            'appNewVersion' => $firmware->getAppNewVersion(),
            'isAppUpdated' => $firmware->isAppUpdated(),
            'osCurrentVersion' => $firmware->getOsCurrentVersion(),
            'osNewVersion' => $firmware->getOsNewVersion(),
            'isOsUpdated' => $firmware->isOsUpdated(),
        ]);
    }
}
