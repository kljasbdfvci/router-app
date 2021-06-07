<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use dektrium\user\filters\AccessRule;

class SystemController extends Controller {

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
                        'actions' => ['reboot', 'shutdown'],
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actionReboot() {
        $system = new \app\helper\System();
        $system->reboot();
        return $this->redirect(['site/index']);
    }

    public function actionShutdown() {
        $system = new \app\helper\System();
        $system->shutdown();
        return $this->redirect(['site/index']);
    }

}
