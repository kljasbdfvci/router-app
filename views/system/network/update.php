<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Network */

$this->title = 'Edit';
$this->params['breadcrumbs'][] = ['label' => 'System'];
$this->params['breadcrumbs'][] = ['label' => 'Network', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="network-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="network-form">

        <?php $form = ActiveForm::begin(); ?>
        <div class="panel-group">
            <?php foreach ($adapters as $adapter) { ?>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            Network Interface <?= \app\helper\Network::adapterToName($adapter) ?>
                        </h4>
                    </div>
                    <div class="panel-body">
                        <table class="table table-condensed">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>IP</th>
                                    <th>Netmask</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                for ($j = 0; $j < $numberOfIp; $j++) {
                                    $ip = "network_" . $adapter . "_ip" . $j;
                                    $netmask = "network_" . $adapter . "_netmask" . $j;
                                ?>
                                    <tr>
                                        <td><?= $j + 1 ?></td>
                                        <td><?= Html::textInput($ip, $data[$ip] ?? '', ['class' => 'form-control']); ?></td>
                                        <td><?= Html::textInput($netmask, $data[$netmask] ?? '', ['class' => 'form-control']); ?></td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            <?php } ?>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        Network Gateway
                    </h4>
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <label class="control-label">Network Gateway</label>
                        <?= Html::textInput('network_gateway', $data['network_gateway'] ?? '', ['class' => 'form-control']); ?>
                    </div>
                </div>
            </div>
        </div>


        <div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>