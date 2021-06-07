<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Network */

$this->title = 'Firmware';
$this->params['breadcrumbs'][] = ['label' => 'System'];
$this->params['breadcrumbs'][] = ['label' => $this->title];
?>

<div class="network-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="network-form">

        <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

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
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        Application
                        <?=
                        $isAppNewUploaded ?
                                "<span class='text-primary h4'>"
                                . "System Will Update After Reboot."
                                . "</span>" : ""
                        ?>
                    </h4>


                </div>
                <div class="panel-body">
                    <p>Current Verion: <?= $appCurrentVersion ?></p>
                    <?= $form->field($model, 'appFile')->fileInput() ?>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        System
                        <?=
                        $isSystemNewUploaded ?
                                "<span class='text-primary h4'>"
                                . "System Will Update After Reboot."
                                . "</span>" : ""
                        ?>
                    </h4>
                </div>
                <div class="panel-body"> 
                    <p>Current Verion: <?= $systemCurrentVersion ?></p>
                    <?= $form->field($model, 'systemFile')->fileInput() ?>
                </div>
            </div>
        </div>

        <div class="form-group">
            <?= Html::submitButton('Upload', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>
