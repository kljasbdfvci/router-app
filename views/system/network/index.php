<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $data yii\data\ActiveDataProvider */

$this->title = 'Network';
$this->params['breadcrumbs'][] = ['label' => 'System'];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="network-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p class="btn-group">
        <?= Html::a('Edit Network', ['update'], ['class' => 'btn btn-primary']) ?>
        <?=
        Html::a('Apply Network', ['apply'], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want apply network?',
                'method' => 'post',
            ],
        ])
        ?>
    </p>

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
                                if (isset($data[$ip]) && isset($data[$netmask])) {
                            ?>
                                    <tr>
                                        <td><?= $j + 1 ?></td>
                                        <td><?= $data[$ip] ?></td>
                                        <td><?= $data[$netmask] ?></td>
                                    </tr>
                            <?php
                                }
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
                <p><b>Defualt Gateway:</b> <?= $data['network_gateway'] ?? '' ?></p>
            </div>
        </div>
    </div>

</div>