<?php

namespace app\controllers;

use Yii;
use app\models\Network;
use yii\web\Controller;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use dektrium\user\filters\AccessRule;

/**
 * NetworkController implements the CRUD actions for Network model.
 */
class NetworkController extends Controller
{

    public function getViewPath()
    {
        return Yii::getAlias('@app/views/system/network');
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
                        'actions' => ['index', 'update', 'apply'],
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $data = Network::getTableKeyValue();
        $network = new \app\helper\Network();
        return $this->render('index', [
            'data' => $data,
            'adapters' => $network->getAdapters(),
            'numberOfIp' => $network->getNumberOfIp(),
        ]);
    }

    public function actionUpdate()
    {
        if (Yii::$app->request->isPost) {
            $post = Yii::$app->request->post();
            $network = new \app\helper\Network();
            foreach ($network->getAdapters() as $adapter) {

                for ($j = 0; $j < $network->getNumberOfIp(); $j++) {
                    // ip
                    $ip = "network_" . $adapter . "_ip" . $j;
                    $model_ip = $this->findModel($ip);
                    if ($model_ip != null) {
                        $model_ip->value = $post[$ip];
                        $model_ip->save();
                    } else {
                        $model_ip = new Network();
                        $model_ip->key = $ip;
                        $model_ip->value = $post[$ip];
                        $model_ip->save();
                    }
                    // netmask
                    $netmask = "network_" . $adapter . "_netmask" . $j;
                    $model_netmask = $this->findModel($netmask);
                    if ($model_netmask != null) {
                        $model_netmask->value = $post[$netmask];
                        $model_netmask->save();
                    } else {
                        $model_netmask = new Network();
                        $model_netmask->key = $netmask;
                        $model_netmask->value = $post[$netmask];
                        $model_netmask->save();
                    }
                }
                // gateway
                $gateway = "network_gateway";
                $model_gateway = $this->findModel($gateway);
                if ($model_gateway != null) {
                    $model_gateway->value = $post[$gateway];
                    $model_gateway->save();
                } else {
                    $model_gateway = new Network();
                    $model_gateway->key = $gateway;
                    $model_gateway->value = $post[$gateway];
                    $model_gateway->save();
                }
            }

            return $this->redirect(['index']);
        }

        $data = Network::getTableKeyValue();
        $network = new \app\helper\Network();
        return $this->render('update', [
            'data' => $data,
            'adapters' => $network->getAdapters(),
            'numberOfIp' => $network->getNumberOfIp(),
        ]);
    }

    public function actionApply()
    {
        $network = new \app\helper\Network();
        $network->apply();
        $this->redirect('index');
    }

    protected function findModel($key)
    {
        $model = Network::find()->where(['key' => $key])->one();
        return $model;
    }
}
