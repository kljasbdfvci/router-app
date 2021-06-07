<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use dektrium\user\filters\AccessRule;

class StatusController extends Controller {

    public function getViewPath() {
        return Yii::getAlias('@app/views/system/status');
    }

    /**
     * {@inheritdoc}
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

    /**
     * {@inheritdoc}
     */
    public function actions() {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex() {
        //
        $cpuData = \app\models\Sysstat::getDaemonLast5Days("cpu");
        //
        $memoryData = \app\models\Sysstat::getDaemonLast5Days("memory");
        //
        $networksData = array();
        $network = new \app\helper\Network();
        $adapters = $network->getAdapters();
        foreach ($adapters as $adapter) {
            // rx
            $adapterRxData = \app\models\Sysstat::getDaemonLast5Days("networks_{$adapter}_rx");
            $networksData += ["networks_{$adapter}_rx" => $adapterRxData];
            // tx
            $adapterTxData = \app\models\Sysstat::getDaemonLast5Days("networks_{$adapter}_tx");
            $networksData += ["networks_{$adapter}_tx" => $adapterTxData];
        }
        //
        return $this->render('index', [
                    'cpuData' => $cpuData,
                    'memoryData' => $memoryData,
                    'adapters' => $adapters,
                    'networksData' => $networksData,
        ]);
    }

}
