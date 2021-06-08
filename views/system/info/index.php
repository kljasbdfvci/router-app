<?php

use yii\helpers\Html;

/* @var $this yii\web\View */

$this->title = 'Info';
$this->params['breadcrumbs'][] = ['label' => 'System'];
$this->params['breadcrumbs'][] = ['label' => $this->title];
?>

<div class="info">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="panel-group">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    System Info
                </h4>
            </div>
            <div class="panel-body">
                <p>Serial Number: <?= $serialNumber ?></p>
            </div>
        </div>
    </div>

</div>